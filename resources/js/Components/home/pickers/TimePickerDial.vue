<script setup lang="ts">
import { theme } from '@/injection-keys';
import {
  DialColors,
  DialEnvironment,
  DialMode,
  DialRingSettings,
  DialSettings,
  drawIndividualDial,
} from '@/utils/dial';
import { getPositionAngleInElement, integerInRangeByAngle, Point2D } from '@/utils/math';
import { computed, inject, onMounted, onUnmounted, ref, watchEffect } from 'vue';

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
  isAm: boolean,
  twelveHourMode: boolean,
}>();

const emit = defineEmits<{
  (e: 'setHours', hours: number, isAm: boolean | undefined): void
  (e: 'setMinutes', hours: number): void
  (e: 'setSeconds', hours: number): void
  (e: 'changeFocus', mode: DialMode): void
  (e: 'select'): void
}>();

const themeData = inject(theme);

const colors = computed((): DialColors => ({
  numbers: themeData?.isLightTheme ? '#333' : '#ccc',
  secondsHand: themeData?.isLightTheme ? '#a00' : '#f00',
}));

const dialSetup = computed(() => {
  const hourRingMinValue = props.twelveHourMode ? 1 : 0;
  const hourRingMaxValue = props.twelveHourMode ? 13 : 12;
  const hourRingRotationOffset = props.twelveHourMode ? 1 : 0;
  const hourRingHandCircleRadius = 12;
  const hourRings: DialRingSettings[] = [{
    labelCount: 12,
    fontSize: 25,
    minValue: hourRingMinValue,
    maxValue: hourRingMaxValue,
    handCircleRadius: hourRingHandCircleRadius,
    rotationOffset: hourRingRotationOffset,
    isAm: props.twelveHourMode ? true : undefined,
    textGetter: (moment, value) => moment.hours(value).format('H'),
  }, {
    labelCount: 12,
    fontSize: 25,
    minValue: props.twelveHourMode ? hourRingMinValue : 12,
    maxValue: props.twelveHourMode ? hourRingMaxValue : 24,
    handCircleRadius: hourRingHandCircleRadius,
    rotationOffset: hourRingRotationOffset,
    isAm: props.twelveHourMode ? false : undefined,
    labelOffsetPercent: props.twelveHourMode ? .5 : .67,
    activationDistance: .5,
    textGetter: (moment, value) => moment.hours(value).format('H'),
  }];
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
        textGetter: (moment, value) => moment.minutes(value).format('m'),
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
        handCircleRadius: 12,
        textGetter: (moment, value) => moment.seconds(value).format('s'),
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
  const dialEnv: DialEnvironment = {
    mode,
    colors,
    isAm: props.isAm,
    twelveHourMode: props.twelveHourMode,
    minutes: props.minutes,
  };
  dialSetup.value.keys.forEach(key => {
    drawIndividualDial(dialEnv, {
      mode: key,
      ...dialSetup.value.settings[key],
    });
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

  const { minValue = 0, maxValue, rotationOffset = 0, isAm } = activeRing;
  const value = integerInRangeByAngle(minValue, maxValue, angle, rotationOffset);

  switch (mode.value) {
    case DialMode.Hours:
      emit('setHours', value, isAm);
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
    class="time-dial mt-3"
    :data-mode="mode"
    dir="ltr"
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
