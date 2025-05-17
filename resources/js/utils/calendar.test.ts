import {
  DayOfWeek,
  generateCalendar,
  getFirstDayOfWeekOffset,
  getTZDateForDate,
  Month,
} from '@/utils/calendar';
import { isoParsingDateFormat } from '@/utils/time';
import { format } from 'date-fns';
import { describe, expect, it } from 'vitest';

describe('Calendar Utils', () => {
  const year = 2023;
  const month = Month.May;

  describe('getTZDateForDate', () => {
    it('should get the correct value for a date', () => {
      expect(format(getTZDateForDate(2022, Month.December, 1), isoParsingDateFormat)).to.eql('2022-12-01');
      expect(format(getTZDateForDate(2023, Month.January, 1), isoParsingDateFormat)).to.eql('2023-01-01');
      expect(format(getTZDateForDate(2023, Month.February, 1), isoParsingDateFormat)).to.eql('2023-02-01');
      expect(format(getTZDateForDate(2023, Month.March, 1), isoParsingDateFormat)).to.eql('2023-03-01');
      expect(format(getTZDateForDate(2023, Month.April, 1), isoParsingDateFormat)).to.eql('2023-04-01');
      expect(format(getTZDateForDate(2023, Month.May, 1), isoParsingDateFormat)).to.eql('2023-05-01');
      expect(format(getTZDateForDate(2023, Month.June, 1), isoParsingDateFormat)).to.eql('2023-06-01');
      expect(format(getTZDateForDate(2023, Month.July, 1), isoParsingDateFormat)).to.eql('2023-07-01');
      expect(format(getTZDateForDate(2023, Month.August, 1), isoParsingDateFormat)).to.eql('2023-08-01');
      expect(format(getTZDateForDate(2023, Month.September, 1), isoParsingDateFormat)).to.eql('2023-09-01');
      expect(format(getTZDateForDate(2023, Month.October, 1), isoParsingDateFormat)).to.eql('2023-10-01');
      expect(format(getTZDateForDate(2023, Month.November, 1), isoParsingDateFormat)).to.eql('2023-11-01');
      expect(format(getTZDateForDate(2023, Month.December, 1), isoParsingDateFormat)).to.eql('2023-12-01');
    });
  });

  describe('getFirstDayOfWeekOffset', () => {
    it('should return the correct offset for a month that starts on Monday and the first day of week is Monday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, month, 1), DayOfWeek.Monday)).to.eql(0);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Tuesday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, month, 1), DayOfWeek.Tuesday)).to.eql(-6);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Wednesday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, month, 1), DayOfWeek.Wednesday)).to.eql(-5);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Thursday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, month, 1), DayOfWeek.Thursday)).to.eql(-4);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Friday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, month, 1), DayOfWeek.Friday)).to.eql(-3);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Saturday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, month, 1), DayOfWeek.Saturday)).to.eql(-2);
    });
    it('should return the correct offset for a month that starts on Monday and the first day of week is Sunday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, month, 1), DayOfWeek.Sunday)).to.eql(-1);
    });
    it('should return the correct offset for a month that starts on Friday and the first day of week is Monday', () => {
      expect(getFirstDayOfWeekOffset(getTZDateForDate(year, Month.December, 1), DayOfWeek.Monday)).to.eql(-4);
    });
  });

  describe('generateCalendar', () => {
    it('should generate the correct calendar for a month that starts on Monday and the first day of week is Monday', () => {
      const actual = generateCalendar({
        year, month, firstDayOfWeek: DayOfWeek.Monday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Friday and the first day of week is Monday', () => {
      const actual = generateCalendar({
        year: 2023, month: Month.December, firstDayOfWeek: DayOfWeek.Monday,
      });
      expect(actual).to.matchSnapshot();
    });


    it('should generate the correct calendar for a month that starts on Thursday and the first day of week is Monday', () => {
      const actual = generateCalendar({
        year: 2022, month: Month.December, firstDayOfWeek: DayOfWeek.Monday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Monday and the first day of week is Sunday', () => {
      const actual = generateCalendar({
        year, month, firstDayOfWeek: DayOfWeek.Sunday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Monday and the first day of week is Saturday', () => {
      const actual = generateCalendar({
        year, month, firstDayOfWeek: DayOfWeek.Saturday,
      });
      expect(actual).to.matchSnapshot();
    });

    it('should generate the correct calendar for a month that starts on Saturday and the first day of week is Sunday', () => {
      const actual = generateCalendar({
        year: 2023, month: Month.April, firstDayOfWeek: DayOfWeek.Sunday,
      });
      expect(actual).to.matchSnapshot();
    });
  });
});
