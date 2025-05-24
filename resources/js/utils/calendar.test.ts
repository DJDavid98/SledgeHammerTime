import { DateTimeLibraryMonth, DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { generateCalendar, getFirstDayOfWeekOffset } from '@/utils/calendar';
import { DTL } from '@/utils/dtl';
import { describe, expect, it } from 'vitest';

describe('Calendar Utils', () => {
  const year = 2023;
  const month = DateTimeLibraryMonth.May;

  describe('DTL.getValueForDate', () => {
    it('should get the correct value for a date', () => {
      expect(DTL.getValueForDate(2022, DateTimeLibraryMonth.December, 1).toISODateString()).to.eql('2022-12-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.January, 1).toISODateString()).to.eql('2023-01-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.February, 1).toISODateString()).to.eql('2023-02-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.March, 1).toISODateString()).to.eql('2023-03-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.April, 1).toISODateString()).to.eql('2023-04-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.May, 1).toISODateString()).to.eql('2023-05-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.June, 1).toISODateString()).to.eql('2023-06-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.July, 1).toISODateString()).to.eql('2023-07-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.August, 1).toISODateString()).to.eql('2023-08-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.September, 1).toISODateString()).to.eql('2023-09-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.October, 1).toISODateString()).to.eql('2023-10-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.November, 1).toISODateString()).to.eql('2023-11-01');
      expect(DTL.getValueForDate(2023, DateTimeLibraryMonth.December, 1).toISODateString()).to.eql('2023-12-01');
    });
  });

  describe('getFirstDayOfWeekOffset', () => {
    it('should return the correct offset for a month that starts on Monday and the first day of week is Monday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, month, 1), DateTimeLibraryWeekday.Monday)).to.eql(0);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Tuesday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, month, 1), DateTimeLibraryWeekday.Tuesday)).to.eql(-6);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Wednesday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, month, 1), DateTimeLibraryWeekday.Wednesday)).to.eql(-5);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Thursday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, month, 1), DateTimeLibraryWeekday.Thursday)).to.eql(-4);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Friday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, month, 1), DateTimeLibraryWeekday.Friday)).to.eql(-3);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Saturday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, month, 1), DateTimeLibraryWeekday.Saturday)).to.eql(-2);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Sunday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, month, 1), DateTimeLibraryWeekday.Sunday)).to.eql(-1);
    });
    it('should return the correct offset for a month that starts on Friday and the first day of week is Monday', () => {
      expect(getFirstDayOfWeekOffset(DTL.getValueForDate(year, DateTimeLibraryMonth.December, 1), DateTimeLibraryWeekday.Monday)).to.eql(-4);
    });
  });

  describe('generateCalendar', () => {
    it('should generate the correct calendar for a month that starts on Monday and the first day of week is Monday', () => {
      const actual = generateCalendar({
        year, month, firstDayOfWeek: DateTimeLibraryWeekday.Monday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Friday and the first day of week is Monday', () => {
      const actual = generateCalendar({
        year: 2023,
        month: DateTimeLibraryMonth.December,
        firstDayOfWeek: DateTimeLibraryWeekday.Monday,
      });
      expect(actual).to.matchSnapshot();
    });


    it('should generate the correct calendar for a month that starts on Thursday and the first day of week is Monday', () => {
      const actual = generateCalendar({
        year: 2022,
        month: DateTimeLibraryMonth.December,
        firstDayOfWeek: DateTimeLibraryWeekday.Monday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Monday and the first day of week is Sunday', () => {
      const actual = generateCalendar({
        year, month, firstDayOfWeek: DateTimeLibraryWeekday.Sunday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Monday and the first day of week is Saturday', () => {
      const actual = generateCalendar({
        year, month, firstDayOfWeek: DateTimeLibraryWeekday.Saturday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Saturday and the first day of week is Sunday', () => {
      const actual = generateCalendar({
        year: 2023,
        month: DateTimeLibraryMonth.April,
        firstDayOfWeek: DateTimeLibraryWeekday.Sunday,
      });
      expect(actual).to.matchSnapshot();
    });
  });
});
