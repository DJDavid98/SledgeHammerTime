<script setup lang="ts">
import { theme } from '@/injection-keys';
import { DialMode } from '@/utils/dial';
import { getPositionAngleInElement, integerInRangeByAngle, Point2D } from '@/utils/math';
import { computed, inject, onMounted, onUnmounted, Ref, ref, watchEffect } from 'vue';

const wrapper = ref<HTMLDivElement>();
const hoursCanvas = ref<HTMLCanvasElement>();
const minutesCanvas = ref<HTMLCanvasElement>();
const secondsCanvas = ref<HTMLCanvasElement>();
const lastCanvasIo = ref<IntersectionObserver | null>(null);
const mode = ref<DialMode>(DialMode.Hours);

const CANVAS_SIZE = 420;

const props = defineProps<{
  hours: number,
  minutes: number,
  seconds: number,
  twelveHourMode: boolean,
}>();

const emit = defineEmits<{
  (e: 'setHours', hours: number): void
  (e: 'setMinutes', hours: number): void
  (e: 'setSeconds', hours: number): void
  (e: 'changeFocus', mode: DialMode): void
  (e: 'select'): void
}>();

const themeData = inject(theme);

const colors = computed(() => ({
  numbers: themeData?.isLightTheme.value ? 'black' : 'white',
  secondsHand: themeData?.isLightTheme.value ? '#a00' : '#f00',
}));

interface DialRingSettings {
  minValue?: number;
  maxValue: number;
  labelCount: number;
  labelOffsetPercent?: number;
  fontSize?: number;
  handCircleRadius: number;
  handMinValueOffset?: number;
  /**
   * Indicates how far away the mouse must be from the origin to activate this ring
   */
  activationDistance?: number;
  /**
   * Offset the drawn image by this many degrees from the origin
   */
  rotationOffset?: number;
}

interface DialSettings {
  mode: DialMode;
  canvasRef: Ref<HTMLCanvasElement | undefined>,
  rings: DialRingSettings[];
  currentValueGetter: () => number;
  handStrokeStyle: string;
  handLineWidth: number;
}

const drawSingleDial = (settings: DialSettings, debugResolutionMultiplier = 0) => {
  const ctx = settings.canvasRef.value?.getContext('2d');
  if (!ctx) return;

  const fontFamily = window.getComputedStyle(document.body).fontFamily;

  const { width, height } = ctx.canvas;
  ctx.clearRect(0, 0, width, height);
  ctx.fillStyle = '';
  ctx.strokeStyle = '';
  const canvasRect = new DOMRect(
    0,
    0,
    width,
    height,
  );
  if (debugResolutionMultiplier > 0) {
    const widthIncrements = width / (width / debugResolutionMultiplier);
    const heightIncrements = height / (height / debugResolutionMultiplier);
    // Draw debug graphic showing the distance from the origin as opacity and value as color
    for (let x = 0; x < width; x += widthIncrements) {
      for (let y = 0; y < height; y += heightIncrements) {
        const { angle, distancePercent } = getPositionAngleInElement(canvasRect, { x, y });
        const hue = angle.toFixed(2);
        ctx.fillStyle = `hsl(${hue}, 50%, 50%, ${(1 - distancePercent).toFixed(2)})`;
        ctx.fillRect(x, y, debugResolutionMultiplier, debugResolutionMultiplier);
      }
    }
  }

  const origin = new DOMPoint(width / 2, height / 2);
  const transformOrigin = new DOMPoint(0, 0);
  const isCurrentMode = settings.mode === mode.value;
  const currentValue = settings.currentValueGetter();
  settings.rings.forEach(ring => {
    const rotationOffset = ring.rotationOffset ?? 0;
    const { labelOffsetPercent = .85, fontSize = 30, minValue = 0, maxValue, labelCount, handCircleRadius } = ring;
    const degreesPerLabel = 360 / labelCount;
    const labelCenterOffset = (height * labelOffsetPercent) / 2;
    const labelPoints = Array.from({ length: labelCount }, (_, i) =>
      new DOMMatrix()
        .translate(origin.x, origin.y)
        .rotate((i + rotationOffset) * degreesPerLabel)
        .translate(0, -labelCenterOffset)
        .transformPoint(transformOrigin),
    );
    labelPoints.forEach((point, i) => {
      const ringProgressPercent = (i / labelCount);
      const value = Math.round((minValue + ((maxValue - minValue) * ringProgressPercent)) * 100) / 100;
      const text = value.toString();
      ctx.font = `${fontSize}px ${fontFamily}`;
      ctx.fillStyle = colors.value.numbers;
      const textMetrics = ctx.measureText(text);
      const textPosition = new DOMMatrix()
        .translate(-textMetrics.width * .5, (fontSize / 2) * .8)
        .transformPoint(point);
      ctx.fillText(text, textPosition.x, textPosition.y);
    });

    // Draw hand when current mode
    if (isCurrentMode && currentValue >= minValue && currentValue < maxValue) {
      const degreesPerValue = 360 / (maxValue - minValue);
      ctx.beginPath();
      ctx.strokeStyle = settings.handStrokeStyle;
      ctx.lineWidth = settings.handLineWidth;

      // Draw hand circle
      const handCircleMatrix = new DOMMatrix()
        .translate(origin.x, origin.y)
        .rotate(currentValue * degreesPerValue)
        .translate(0, -labelCenterOffset);
      const handCirclePosition = handCircleMatrix.transformPoint(transformOrigin);
      const handCircleDiameter = handCircleRadius * 2;
      ctx.arc(handCirclePosition.x, handCirclePosition.y, handCircleDiameter, 0, Math.PI * 2, true);

      // Draw hand
      ctx.moveTo(origin.x, origin.y);
      const handPosition = DOMMatrix.fromMatrix(handCircleMatrix)
        .translate(0, handCircleDiameter)
        .transformPoint(transformOrigin);
      ctx.lineTo(handPosition.x, handPosition.y);
      ctx.stroke();
      ctx.strokeStyle = '';
      ctx.lineWidth = 0;
    }
  });
};

const dialSetup = computed(() => {
  const hourRings: DialRingSettings[] = [{
    labelCount: 12,
    fontSize: 25,
    minValue: props.twelveHourMode ? 1 : 0,
    maxValue: props.twelveHourMode ? 13 : 12,
    handCircleRadius: 12,
    rotationOffset: props.twelveHourMode ? 1 : 0,
  }];
  if (!props.twelveHourMode) {
    hourRings.push({
      minValue: 12,
      labelCount: 12,
      labelOffsetPercent: .67,
      fontSize: 25,
      maxValue: 24,
      handCircleRadius: 12,
      activationDistance: .5,
    });
  }
  const settings: Record<DialMode, Omit<DialSettings, 'mode'>> = {
    [DialMode.Hours]: {
      canvasRef: hoursCanvas,
      rings: hourRings,
      currentValueGetter: () => props.hours,
      handStrokeStyle: colors.value.numbers,
      handLineWidth: 5,
    },
    [DialMode.Minutes]: {
      canvasRef: minutesCanvas,
      rings: [{
        labelCount: 12,
        maxValue: 60,
        handCircleRadius: 12,
      }],
      currentValueGetter: () => props.minutes,
      handStrokeStyle: colors.value.numbers,
      handLineWidth: 3,
    },
    [DialMode.Seconds]: {
      canvasRef: secondsCanvas,
      rings: [{
        labelCount: 12,
        maxValue: 60,
        handCircleRadius: 10,
      }],
      currentValueGetter: () => props.seconds,
      handStrokeStyle: colors.value.secondsHand,
      handLineWidth: 2,
    },
  };
  const keys = Object.keys(settings) as DialMode[];
  /**
   * Make sure ring array elements are sorted ascending by `activationDistance` otherwise pointer
   * event tracking will not work properly (due to avoiding the manual re-sort of this array
   * for performance reasons)
   */
  keys.forEach(key => {
    const { rings } = settings[key];
    if (rings.length > 1) {
      rings.sort(({ activationDistance: distA = 0 }, { activationDistance: distB = 0 }) => distA - distB);
    }
  });
  return { settings, keys };
});

const draw = () => {
  dialSetup.value.keys.forEach(key => {
    drawSingleDial({ mode: key, ...dialSetup.value.settings[key] });
  });
};

watchEffect(draw);
onMounted(draw);

const handlePointerPositionChange = (pointerPoint: Point2D) => {
  if (!mode.value) return;

  const { canvasRef, rings } = dialSetup.value.settings[mode.value];
  const canvasBounds = canvasRef.value?.getBoundingClientRect();
  if (!canvasBounds) return;

  const { distancePercent, angle } = getPositionAngleInElement(canvasBounds, pointerPoint);
  let activeRing = rings[0];
  if (rings.length > 1) {
    const furtherRing = rings.find(({ activationDistance = 0 }) => activationDistance >= distancePercent);
    if (furtherRing) {
      activeRing = furtherRing;
    }
  }

  const { minValue = 0, maxValue, rotationOffset = 0 } = activeRing;
  const value = integerInRangeByAngle(minValue, maxValue, angle, rotationOffset);

  switch (mode.value) {
    case DialMode.Hours:
      emit('setHours', value);
      break;
    case DialMode.Minutes:
      emit('setMinutes', value);
      break;
    case DialMode.Seconds:
      emit('setSeconds', value);
      break;
  }
};

let mousemoveAnimationFrameRequest: ReturnType<Window['requestAnimationFrame']> | undefined;
const onMousemove = (e: MouseEvent) => {
  if (mousemoveAnimationFrameRequest) {
    window.cancelAnimationFrame(mousemoveAnimationFrameRequest);
  }

  mousemoveAnimationFrameRequest = window.requestAnimationFrame(() => {
    handlePointerPositionChange({
      x: e.pageX, y: e.pageY,
    });
    mousemoveAnimationFrameRequest = undefined;
  });
};
let touchmoveAnimationFrameRequest: ReturnType<Window['requestAnimationFrame']> | undefined;
const onTouchmove = (e: TouchEvent) => {
  if (touchmoveAnimationFrameRequest) {
    window.cancelAnimationFrame(touchmoveAnimationFrameRequest);
  }

  touchmoveAnimationFrameRequest = window.requestAnimationFrame(() => {
    if (e.touches.length < 1) return;
    const [touch] = e.touches;
    handlePointerPositionChange({
      x: touch.pageX, y: touch.pageY,
    });
    touchmoveAnimationFrameRequest = undefined;
  });
};

// Starters
const startMovementTracking = () => {
  window.addEventListener('blur', stopMouseMovementTracking, { passive: true });
};
const startMouseMovementTracking = (e: MouseEvent) => {
  onMousemove(e);
  document.body.addEventListener('mousemove', onMousemove, { passive: true });
  document.body.addEventListener('mouseup', stopMouseMovementTracking, { passive: true });
  document.body.addEventListener('contextmenu', stopMouseMovementTracking, { passive: true });
  startMovementTracking();
};
const startTouchMovementTracking = (e: TouchEvent) => {
  onTouchmove(e);
  document.body.addEventListener('touchmove', onTouchmove, { passive: true });
  document.body.addEventListener('touchend', stopTouchMovementTracking, { passive: true });
  document.body.addEventListener('touchcancel', stopTouchMovementTracking, { passive: true });
  startMovementTracking();
};

// Cleanups
const stopMovementTracking = () => {
  window.removeEventListener('blur', stopMouseMovementTracking);
  switch (mode.value) {
    case DialMode.Hours:
      emit('changeFocus', DialMode.Minutes);
      break;
    case DialMode.Minutes:
      emit('changeFocus', DialMode.Seconds);
      break;
    case DialMode.Seconds:
      emit('select');
      break;
  }
};
const stopMouseMovementTracking = () => {
  document.body.removeEventListener('mousemove', onMousemove);
  document.body.removeEventListener('mouseup', stopMouseMovementTracking);
  document.body.removeEventListener('contextmenu', stopMouseMovementTracking);
  stopMovementTracking();
};
const stopTouchMovementTracking = () => {
  document.body.removeEventListener('mousemove', onMousemove);
  document.body.removeEventListener('mouseup', stopMouseMovementTracking);
  document.body.removeEventListener('contextmenu', stopMouseMovementTracking);
  stopMovementTracking();
};

const setMode = (newMode: DialMode) => {
  mode.value = newMode;
};

export interface TimePickerDialAPI {
  setMode: typeof setMode,
}

defineExpose({
  setMode,
});

onUnmounted(() => {
  stopMouseMovementTracking();
  if (mousemoveAnimationFrameRequest) {
    window.cancelAnimationFrame(mousemoveAnimationFrameRequest);
  }
  if (touchmoveAnimationFrameRequest) {
    window.cancelAnimationFrame(touchmoveAnimationFrameRequest);
  }
  if (lastCanvasIo.value) {
    lastCanvasIo.value.disconnect();
  }
});
</script>

<template>
  <div
    ref="wrapper"
    class="time-dial mt-3"
    :data-mode="mode"
  >
    <canvas
      ref="hoursCanvas"
      class="hours-canvas"
      :width="CANVAS_SIZE"
      :height="CANVAS_SIZE"
      @mousedown.passive="startMouseMovementTracking"
      @touchstart.passive="startTouchMovementTracking"
    />
    <canvas
      ref="minutesCanvas"
      class="minutes-canvas"
      :width="CANVAS_SIZE"
      :height="CANVAS_SIZE"
      @mousedown.passive="startMouseMovementTracking"
      @touchstart.passive="startTouchMovementTracking"
    />
    <canvas
      ref="secondsCanvas"
      class="seconds-canvas"
      :width="CANVAS_SIZE"
      :height="CANVAS_SIZE"
      @mousedown.passive="startMouseMovementTracking"
      @touchstart.passive="startTouchMovementTracking"
    />
  </div>
</template>
