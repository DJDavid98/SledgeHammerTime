export interface Point2D {
  x: number;
  y: number;
}

export type RequiredDomRectInit = Required<DOMRectInit>;

enum PointQuadrant {
  PosXNegY,
  PosXPosY,
  NegXNegY,
  NegXPosY,
}

const translateOrigin = (originalPoint: Point2D, newOrigin: Point2D, previousOrigin: Point2D = {
  x: 0,
  y: 0,
}) => {
  const offsetX = newOrigin.x - previousOrigin.x;
  const offsetY = newOrigin.y - previousOrigin.y;

  return { x: originalPoint.x - offsetX, y: originalPoint.y - offsetY };
};

export const getPointQuadrant = (point: Point2D): PointQuadrant => {
  if (point.x > 0) {
    if (point.y > 0) {
      return PointQuadrant.PosXPosY;
    }

    return PointQuadrant.PosXNegY;
  }

  if (point.y > 0) {
    return PointQuadrant.NegXPosY;
  }

  return PointQuadrant.NegXNegY;
};

const radiansToDegrees = (radians: number) => radians * (180 / Math.PI);

const calculateAngle = (a: Point2D, b: Point2D, c: Point2D): number => {
  const ab = Math.sqrt(Math.pow(b.x - a.x, 2) + Math.pow(b.y - a.y, 2));
  const bc = Math.sqrt(Math.pow(b.x - c.x, 2) + Math.pow(b.y - c.y, 2));
  const ac = Math.sqrt(Math.pow(c.x - a.x, 2) + Math.pow(c.y - a.y, 2));
  const angleInRadians = Math.acos((Math.pow(ab, 2) + Math.pow(bc, 2) - Math.pow(ac, 2)) / (2 * ab * bc));
  return radiansToDegrees(angleInRadians);
};

/**
 * Calculate the angle the position is in relative to a circle at origin (0,0),
 * where 0 degrees is pointing north
 *
 * @return angle (0-359)
 */
export const getPositionAngle = (point: Point2D): number => {
  const pointQuadrant = getPointQuadrant(point);
  switch (pointQuadrant) {
    case PointQuadrant.NegXPosY:
      if (point.x === 0) {
        return 180;
      }
      break;
    case PointQuadrant.NegXNegY:
      if (point.x === 0) {
        return 0;
      }
      if (point.y === 0) {
        return 270;
      }
      break;
    case PointQuadrant.PosXNegY:
      if (point.y === 0) {
        return 90;
      }
      break;
  }

  const otherVertex: Point2D = {
    x: point.x,
    y: 0,
  };
  const rightAngleVertex: Point2D = {
    x: 0,
    y: point.y,
  };
  const angle = calculateAngle(point, rightAngleVertex, otherVertex);
  switch (pointQuadrant) {
    case PointQuadrant.PosXNegY:
      return 90 - angle;
    case PointQuadrant.PosXPosY:
      return angle + 90;
    case PointQuadrant.NegXPosY:
      return 90 - angle + 180;
    case PointQuadrant.NegXNegY:
      return angle + 270;
  }
};

export const calculateFractionalDistance = (point: Point2D, maxWidth: number = 1): number => {
  // Calculate the distance from the origin to the point
  const distance = Math.sqrt(Math.pow(point.x, 2) + Math.pow(point.y, 2));

  return distance / maxWidth;
};

export interface PositionData {
  angle: number;
  distancePercent: number;
}

/**
 * Given the bounding box & position of an element on the page and
 * a specific point on the page, calculate the angle the position
 * is in relative to the circle with a diameter and origin matching
 * the element
 *
 * @return angle (0-359)
 */
export const getPositionAngleInElement = (elementRect: RequiredDomRectInit, originalPoint: Point2D): PositionData => {
  const elementWidthHalf = elementRect.width / 2;
  const elementHeightHalf = elementRect.height / 2;
  const elementCenterPosition: Point2D = {
    x: Math.round(elementRect.x + elementWidthHalf),
    y: Math.round(elementRect.y + elementHeightHalf),
  };
  const point = translateOrigin(originalPoint, elementCenterPosition);
  const maxDistance = calculateFractionalDistance({
    x: elementWidthHalf,
    y: elementHeightHalf,
  }, 1);
  return {
    angle: getPositionAngle(point),
    distancePercent: calculateFractionalDistance(point, maxDistance),
  };
};

export const integerInRangeByAngle = (minValue: number, maxValue: number, angle: number) => {
  const value = Math.round(minValue + (angle / 360) * (maxValue - minValue));
  // If value exceeds maximum, wrap around intentionally
  return value > maxValue - 1 ? minValue : value;
};
