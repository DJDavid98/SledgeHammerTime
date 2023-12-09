import {
	getPositionAngleInElement,
	integerInRangeByAngle,
	Point2D,
	RequiredDomRectInit,
} from '@/utils/math';
import { describe, expect, it } from 'vitest';

describe('Math Utils', () => {
	describe('getPositionAngleInElement', () => {
		const closeToDelta = 0.001;
		it('should calculate the correct angle for values on the x axis', () => {
			/*
			 * 500,500 - p0 - 600,500
			 *    |      p1      |
			 *    |      p2      |
			 *    |      p3      |
			 * 600,500 - p4 - 600,600
			 */
			const mockElementRect: RequiredDomRectInit = {
				width: 100,
				height: 100,
				x: 500,
				y: 500,
			};
			const p0: Point2D = {
				x: 550,
				y: 500,
			};
			const p1: Point2D = {
				x: 550,
				y: 525,
			};
			const p2: Point2D = {
				x: 550,
				y: 550,
			};
			const p3: Point2D = {
				x: 550,
				y: 575,
			};
			const p4: Point2D = {
				x: 550,
				y: 600,
			};
			expect(getPositionAngleInElement(mockElementRect, p0).angle).to.be.closeTo(0, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p1).angle).to.be.closeTo(0, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p2).angle).to.be.closeTo(0, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p3).angle).to.be.closeTo(180, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p4).angle).to.be.closeTo(180, closeToDelta);
		});

		it('should calculate the correct angle for values on the Y axis', () => {
			/*
			 * 500,500 ------ 600,500
			 *    |              |
			 *   p0  p1  p2  p3  p4
			 *    |              |
			 * 600,500 ------ 600,600
			 */
			const mockElementRect: RequiredDomRectInit = {
				width: 100,
				height: 100,
				x: 500,
				y: 500,
			};
			const p0: Point2D = {
				x: 500,
				y: 550,
			};
			const p1: Point2D = {
				x: 525,
				y: 550,
			};
			const p2: Point2D = {
				x: 550,
				y: 550,
			};
			const p3: Point2D = {
				x: 575,
				y: 550,
			};
			const p4: Point2D = {
				x: 600,
				y: 550,
			};
			expect(getPositionAngleInElement(mockElementRect, p0).angle).to.be.closeTo(270, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p1).angle).to.be.closeTo(270, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p2).angle).to.be.closeTo(0, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p3).angle).to.be.closeTo(90, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p4).angle).to.be.closeTo(90, closeToDelta);
		});

		it('should calculate the correct angle for values on the diagonal from top left to bottom right', () => {
			/*
			 *   p0 --------- 600,500
			 *    |  p1          |
			 *    |      p2      |
			 *    |          p3  |
			 * 600,500 --------- p4
			 */
			const mockElementRect: RequiredDomRectInit = {
				width: 100,
				height: 100,
				x: 500,
				y: 500,
			};
			const p0: Point2D = {
				x: 500,
				y: 500,
			};
			const p1: Point2D = {
				x: 525,
				y: 525,
			};
			const p2: Point2D = {
				x: 550,
				y: 550,
			};
			const p3: Point2D = {
				x: 575,
				y: 575,
			};
			const p4: Point2D = {
				x: 600,
				y: 600,
			};
			expect(getPositionAngleInElement(mockElementRect, p0).angle).to.be.closeTo(315, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p1).angle).to.be.closeTo(315, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p2).angle).to.be.closeTo(0, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p3).angle).to.be.closeTo(135, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p4).angle).to.be.closeTo(135, closeToDelta);
		});

		it('should calculate the correct angle for values on the diagonal from bottom left to top right', () => {
			/*
			 * 500,500 --------- p4
			 *    |          p3  |
			 *    |      p2      |
			 *    |  p1          |
			 *   p0 --------- 600,600
			 */
			const mockElementRect: RequiredDomRectInit = {
				width: 100,
				height: 100,
				x: 500,
				y: 500,
			};
			const p0: Point2D = {
				x: 500,
				y: 600,
			};
			const p1: Point2D = {
				x: 525,
				y: 575,
			};
			const p2: Point2D = {
				x: 550,
				y: 550,
			};
			const p3: Point2D = {
				x: 575,
				y: 525,
			};
			const p4: Point2D = {
				x: 600,
				y: 500,
			};
			expect(getPositionAngleInElement(mockElementRect, p0).angle).to.be.closeTo(225, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p1).angle).to.be.closeTo(225, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p2).angle).to.be.closeTo(0, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p3).angle).to.be.closeTo(45, closeToDelta);
			expect(getPositionAngleInElement(mockElementRect, p4).angle).to.be.closeTo(45, closeToDelta);
		});
	});

	describe('integerInRangeByAngle', () => {
		it('should return correct value for hour clock positions', () => {
			const maxHours = 12;
			const anglesPerHour = 360 / maxHours;
			for (let hours = 0; hours < maxHours; hours++) {
				expect(integerInRangeByAngle(0, maxHours, anglesPerHour * hours), `correct value for hour ${hours}`).to.eql(hours);
			}
		});
		it('should return correct value for minute clock positions', () => {
			const maxMinutes = 60;
			const anglesPerHour = 360 / maxMinutes;
			for (let minutes = 0; minutes < maxMinutes; minutes++) {
				expect(integerInRangeByAngle(0, maxMinutes, anglesPerHour * minutes), `correct value for minute ${minutes}`).to.eql(minutes);
			}
		});
	});
});
