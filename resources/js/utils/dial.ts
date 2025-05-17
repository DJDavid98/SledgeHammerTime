import { getPositionAngleInElement, Point2D } from '@/utils/math';
import { getMeridiemLabel } from '@/utils/time';
import { TZDate } from '@date-fns/tz';
import { Ref } from 'vue';

export enum DialMode {
  Hours = 'hours',
  Minutes = 'minutes',
  Seconds = 'seconds'
}

export const drawTextAt = (ctx: CanvasRenderingContext2D, point: Point2D, text: string, fontSize: number) => {
  const textMetrics = ctx.measureText(text);
  const textPosition = new DOMMatrix()
    .translate(-textMetrics.width * .5, (fontSize / 2) * .8)
    .transformPoint(point);
  ctx.fillText(text, textPosition.x, textPosition.y);
};

export const drawHollowCircleAt = (ctx: CanvasRenderingContext2D, point: Point2D, diameter: number) => {
  ctx.arc(point.x, point.y, diameter, 0, Math.PI * 2, true);
  ctx.stroke();
};

export interface DialRingSettings {
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
  /**
   * When defined, determines if the ring will result in an AM/PM output value
   */
  isAm?: boolean;
  textGetter: (date: TZDate, value: number) => string;
}

export interface DialSettings {
  mode: DialMode;
  canvasRef: Ref<HTMLCanvasElement | undefined>,
  rings: DialRingSettings[];
  currentValueGetter: () => number;
  handStrokeStyle: string;
  handLineWidth: number;
}

export interface DialColors {
  numbers: string;
  secondsHand: string;
}

export interface DialEnvironment {
  mode: Ref<DialMode>;
  colors: Ref<DialColors>;
  isAm: boolean;
  twelveHourMode: boolean;
  minutes: number;
}

export const drawIndividualDial = (env: DialEnvironment, settings: DialSettings, debugResolutionMultiplier = 0) => {
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
    // Draw debug graphic showing the distance from the origin as opacity and value as hue
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
  const isCurrentMode = settings.mode === env.mode.value;
  const currentValue = settings.currentValueGetter();
  const isTwelveHourMode = settings.mode === DialMode.Hours && env.twelveHourMode;
  settings.rings.forEach(ring => {
    const rotationOffset = ring.rotationOffset ?? 0;
    const {
      labelOffsetPercent = .85,
      fontSize = 30,
      minValue = 0,
      maxValue,
      labelCount,
      handCircleRadius,
      textGetter,
    } = ring;
    const degreesPerLabel = 360 / labelCount;
    const labelCenterOffset = (height * labelOffsetPercent) / 2;
    const labelPoints = Array.from({ length: labelCount }, (_, i) =>
      new DOMMatrix()
        .translate(origin.x, origin.y)
        .rotate((i + rotationOffset) * degreesPerLabel)
        .translate(0, -labelCenterOffset)
        .transformPoint(transformOrigin),
    );
    const tempDate = new TZDate();
    labelPoints.forEach((point, i) => {
      const ringProgressPercent = (i / labelCount);
      const value = Math.round((minValue + ((maxValue - minValue) * ringProgressPercent)) * 100) / 100;
      const text = textGetter(tempDate, value);
      ctx.font = `${fontSize}px ${fontFamily}`;
      ctx.fillStyle = env.colors.value.numbers;
      drawTextAt(ctx, point, text, fontSize);
    });

    // Draw hand when current mode
    if (isCurrentMode && currentValue >= minValue && currentValue < maxValue) {
      const currentMeridianRing = ring.isAm === env.isAm;
      const meridiemCirceDiameter = 35;
      if (isTwelveHourMode) {
        if (!currentMeridianRing) {
          // Avoid drawing double hands in 12-hour mode
          return;
        }
      }

      const degreesPerValue = 360 / (maxValue - minValue);
      ctx.beginPath();
      ctx.strokeStyle = settings.handStrokeStyle;
      ctx.lineWidth = settings.handLineWidth;

      if (isTwelveHourMode) {
        // Draw AM/PM indicator
        drawHollowCircleAt(ctx, origin, meridiemCirceDiameter);
        ctx.closePath();
        ctx.font = `bold ${fontSize}px ${fontFamily}`;
        ctx.fillStyle = env.colors.value.numbers;
        drawTextAt(ctx, origin, getMeridiemLabel(env.isAm, env.minutes), fontSize);
        ctx.beginPath();
      }

      // Draw hand circle
      const handCirceRotation = currentValue * degreesPerValue;
      const handCircleMatrix = new DOMMatrix()
        .translate(origin.x, origin.y)
        .rotate(handCirceRotation)
        .translate(0, -labelCenterOffset);
      const handCirclePosition = handCircleMatrix.transformPoint(transformOrigin);
      const handCircleDiameter = handCircleRadius * 2;
      drawHollowCircleAt(ctx, handCirclePosition, handCircleDiameter);

      // Draw hand
      let handStartMatrix = new DOMMatrix()
        .translate(origin.x, origin.y);
      if (isTwelveHourMode) {
        handStartMatrix = handStartMatrix
          .rotate(handCirceRotation)
          .translate(0, -meridiemCirceDiameter);
      }
      const handStartPosition = handStartMatrix.transformPoint(transformOrigin);
      ctx.moveTo(handStartPosition.x, handStartPosition.y);
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
