import { DateFnsDTL } from '@/classes/DateFnsDTL';
import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import {
  DateTimeLibraryMonth,
  DateTimeLibraryValue,
  DateTimeLibraryWeekday,
} from '@/classes/DateTimeLibraryValue';
import { MomentDTL } from '@/classes/MomentDTL';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { DefaultDTL } from '@/utils/dtl';
import { beforeEach, describe, expect, it } from 'vitest';

describe('DateTimeLibraryValue', () => {
  const implementations = [
    ['moment', new MomentDTL()],
    ['date-fns', new DateFnsDTL()],
  ] as const satisfies [string, DateTimeLibrary][];

  // Test implementations
  describe.each(implementations)('Implementation: %s', async (dtlName, dtl) => {
    // Create a fixed timestamp for testing
    const testTimestamp = new Date('2025-01-15T12:30:45Z').getTime();
    const utcTimezone: TimezoneSelection = {
      type: TimeZoneSelectionType.ZONE_NAME,
      name: 'Etc/UTC',
    };
    const enLocale = await dtl.localeLoader('en');

    describe('Initialization and Basic Methods', () => {
      it('should create a value instance correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const expected = {
          'date-fns': '2025-01-15T12:30:45.000+00:00',
          'moment': '2025-01-15T12:30:45.000Z',
        };
        expect(value.toISOString()).toBe(expected[dtlName]);
      });

      it('should have proper string representation', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.toString()).toMatch(/\[object [A-Za-z]+DTLValue\(2025-01-15T12:30:45\.000(Z|\+00:00)\)/);
      });

      it('should convert to Date object correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const date = value.toDate();
        expect(date).toBeInstanceOf(Date);
        expect(date.getUTCFullYear()).toBe(2025);
        expect(date.getUTCMonth()).toBe(0); // January is 0
        expect(date.getUTCDate()).toBe(15);
        expect(date.getUTCHours()).toBe(12);
        expect(date.getUTCMinutes()).toBe(30);
        expect(date.getUTCSeconds()).toBe(45);
      });
    });

    describe('getLocale and setLocale', () => {
      it('should initialize with null locale by default', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(() => value.getLocale()).toThrow('locale is needed but not set');
      });

      it('should allow setting and getting locale', async () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newInstance = value.setLocale(enLocale);
        expect(newInstance.getLocale()).toBe(enLocale);
      });
    });

    describe('getFullYear', () => {
      it('should return correct year', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.getFullYear()).toBe(2025);
      });
    });

    describe('getMonth', () => {
      it('should return correct month', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.getMonth()).toBe(DateTimeLibraryMonth.January);
      });
    });

    describe('getDayOfMonth', () => {
      it('should return correct day of month', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.getDayOfMonth()).toBe(15);
      });
    });

    describe('getWeekday', () => {
      it('should return correct weekday', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        // January 15, 2025, is a Wednesday
        expect(value.getWeekday()).toBe(DateTimeLibraryWeekday.Wednesday);
      });
    });

    describe('daysInMonth', () => {
      it('should calculate correct days in month', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.daysInMonth()).toBe(31); // January has 31 days
      });
    });

    describe('getHours and setHours', () => {
      it('should return correct hours', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.getHours()).toBe(12);
      });

      it('should allow setting hours', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newValue = value.setHours(15);
        expect(newValue.getHours()).toBe(15);
      });
    });

    describe('getMinutes and setMinutes', () => {
      it('should return correct minutes', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.getMinutes()).toBe(30);
      });

      it('should allow setting minutes', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newValue = value.setMinutes(10);
        expect(newValue.getMinutes()).toBe(10);
      });
    });

    describe('getSeconds and setSeconds', () => {
      it('should return correct seconds', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        expect(value.getSeconds()).toBe(45);
      });

      it('should allow setting seconds', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newValue = value.setSeconds(20);
        expect(newValue.getSeconds()).toBe(20);
      });
    });

    describe('Time Component Setters Chaining', () => {
      it('should support chaining time component setters', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newValue = value
          .setHours(15)
          .setMinutes(10)
          .setSeconds(20);

        expect(newValue.getHours()).toBe(15);
        expect(newValue.getMinutes()).toBe(10);
        expect(newValue.getSeconds()).toBe(20);
      });
    });

    describe('toISOString', () => {
      it('should format ISO string correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        expect(value.toISOString()).toMatch(/2025-01-15T12:30:45\.000(Z|\+00:00)/);
      });
    });

    describe('toISODateString', () => {
      it('should format ISO date string correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        expect(value.toISODateString()).toBe('2025-01-15');
      });
    });

    describe('formatHoursDisplay', () => {
      it('should format hours display correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        expect(value.formatHoursDisplay()).toBe('12');
      });
    });

    describe('formatMinutesDisplay', () => {
      it('should format minutes display correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        expect(value.formatMinutesDisplay()).toBe('30');
      });
    });

    describe('formatSecondsDisplay', () => {
      it('should format seconds display correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        expect(value.formatSecondsDisplay()).toBe('45');
      });
    });

    describe('formatDiscordTimestamp', () => {
      let value: DateTimeLibraryValue;

      beforeEach(() => {
        value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
      });

      it('should format Discord short date timestamp correctly', () => {
        const result = value.formatDiscordTimestamp(MessageTimestampFormat.SHORT_DATE);
        // Format should be something like "01/15/2025" or "15/01/2025" depending on locale
        expect(result).toMatch(/^\d{1,2}[/\-.]\d{1,2}[/\-.]\d{4}$/);
      });

      it('should format Discord short time timestamp correctly', () => {
        const result = value.formatDiscordTimestamp(MessageTimestampFormat.SHORT_TIME);
        // Format should be like "12:30"
        expect(result).toMatch(/^\d{1,2}:\d{2}(\s[ap]m)?$/i);
      });

      it('should format Discord long date timestamp correctly', () => {
        const result = value.formatDiscordTimestamp(MessageTimestampFormat.LONG_DATE);
        // Format should contain the month name, day, and year
        expect(result).toContain('January');
        expect(result).toContain('15');
        expect(result).toContain('2025');
      });
    });

    describe('formatCalendarDateDisplay', () => {
      it('should format calendar date display correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        const result = value.formatCalendarDateDisplay();
        // Expect something like "15" or locale equivalent
        expect(result).toContain('15');
      });
    });

    describe('formatCalendarContext', () => {
      it('should format calendar context correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        const result = value.formatCalendarContext();
        // Calendar context usually includes month and year
        expect(result).toContain('January');
        expect(result).toContain('2025');
      });
    });

    describe('addDays', () => {
      it('should add days correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newValue = value.addDays(5);
        expect(newValue.getDayOfMonth()).toBe(20); // 15 + 5 = 20
        expect(newValue.getMonth()).toBe(DateTimeLibraryMonth.January);
        expect(newValue.getFullYear()).toBe(2025);
      });

      it('should handle month rollover when adding days', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newValue = value.addDays(20);
        expect(newValue.getDayOfMonth()).toBe(4); // 15 + 20 = 35, which is Feb 4
        expect(newValue.getMonth()).toBe(DateTimeLibraryMonth.February);
        expect(newValue.getFullYear()).toBe(2025);
      });
    });

    describe('addYears', () => {
      it('should add years correctly', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp);
        const newValue = value.addYears(2);
        expect(newValue.getFullYear()).toBe(2027); // 2025 + 2 = 2027
        expect(newValue.getMonth()).toBe(DateTimeLibraryMonth.January);
        expect(newValue.getDayOfMonth()).toBe(15);
      });
    });

    describe('replaceZone', () => {
      let value: DateTimeLibraryValue;

      beforeEach(() => {
        value = dtl.fromTimestampMsUtc(testTimestamp);
      });

      it('should support timezone operations with offset timezones', () => {
        const newTimezone: TimezoneSelection = {
          type: TimeZoneSelectionType.OFFSET,
          hours: 1,
          minutes: 0,
        };

        const newValue = value.replaceZone(newTimezone);
        expect(newValue.getUtcOffsetMinutes()).toBe(60); // 1 hour = 60 minutes

        // Time should now be in the new timezone
        expect(newValue.getHours()).toBe(13);
        expect(newValue.getMinutes()).toBe(30);
        expect(newValue.getSeconds()).toBe(45);
      });

      it('should support timezone operations with named timezones', () => {
        const newTimezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'Europe/London',
        };

        const newValue = value.replaceZone(newTimezone);

        // Timezone offset for Europe/London varies by DST
        // We just verify it's a valid timezone offset
        expect(typeof newValue.getUtcOffsetMinutes()).toBe('number');

        // Time should remain the same but now be in the new timezone
        expect(newValue.getHours()).toBe(12);
        expect(newValue.getMinutes()).toBe(30);
        expect(newValue.getSeconds()).toBe(45);
      });
    });

    describe('fromNow', () => {
      it('should provide relative time with fromNow for past dates', () => {
        // Create a date in the past (1 day ago)
        const pastValue = dtl.now().addDays(-1).setLocale(enLocale);

        // When running tests, pastValue will always be in the past relative to the current time
        const result = pastValue.fromNow();
        // Should contain some indicator that it's in the past
        expect(result).toMatch(/ago|day|yesterday/i);
      });

      it('should provide relative time with fromNow for future dates', () => {
        // Create a date in the future (1 day ahead)
        const futureValue = dtl.now().addDays(1).setLocale(enLocale);

        // When running tests, futureValue will always be in the future relative to the current time
        const result = futureValue.fromNow();
        // Should contain some indicator that it's in the future
        expect(result).toMatch(/from now|in|day/i);
      });
    });

    describe('local', () => {
      it('should provide local time representation', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);

        // First set a non-local timezone
        const europeTimezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'Europe/Paris',
        };
        const parisValue = value.replaceZone(europeTimezone);

        // Then convert to local
        const localValue = parisValue.local();

        // Verify it's different from the Paris timezone value
        // Local timezone depends on the test environment, so we can't assert exact values
        expect(localValue).not.toBe(parisValue);

        // But we can verify it returns a valid DateTimeLibraryValue
        expect(localValue.getFullYear()).toBe(2025);
        expect(localValue.getMonth()).toBe(DateTimeLibraryMonth.January);
        expect(localValue.getDayOfMonth()).toBe(15);
      });
    });

    describe('getUnixSeconds', () => {
      it('should return Unix timestamp in seconds', () => {
        const value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
        const unixSeconds = value.getUnixSeconds();
        expect(unixSeconds).toBe(Math.floor(testTimestamp / 1000));
      });
    });

    describe('getUtcOffsetMinutes', () => {
      let value: DateTimeLibraryValue;
      beforeEach(() => {
        value = dtl.fromTimestampMsUtc(testTimestamp).setLocale(enLocale);
      });

      it('should return UTC offset minutes for UTC timezone', () => {
        // For UTC timezone, the offset should be 0
        const utcValue = value.replaceZone(utcTimezone);
        expect(utcValue.getUtcOffsetMinutes()).toBe(0);
      });

      it('should return UTC offset minutes for positive offset timezone', () => {
        const plusOneTimezone: TimezoneSelection = {
          type: TimeZoneSelectionType.OFFSET,
          hours: 1,
          minutes: 0,
        };
        const plusOneValue = value.replaceZone(plusOneTimezone);
        expect(plusOneValue.getUtcOffsetMinutes()).toBe(60); // +1 hour = +60 minutes
      });

      it('should return UTC offset minutes for negative offset timezone', () => {
        const minusOneTimezone: TimezoneSelection = {
          type: TimeZoneSelectionType.OFFSET,
          hours: -1,
          minutes: 0,
        };
        const minusOneValue = value.replaceZone(minusOneTimezone);
        expect(minusOneValue.getUtcOffsetMinutes()).toBe(-60); // -1 hour = -60 minutes
      });
    });
  });
});

describe('DateTimeLibraryValue Direct Tests', () => {
  // Create a fixed date for testing
  const testDate = new Date('2025-01-15T12:30:45Z');
  let instance: DateTimeLibraryValue;

  beforeEach(() => {
    instance = new MomentDTL().fromIsoString(testDate.toISOString());
  });

  describe('Initialization and toDate', () => {
    it('should be properly initialized with a value', () => {
      expect(instance.toDate()).toEqual(testDate);
    });
  });

  describe('getLocale and setLocale', () => {
    it('should initialize with null locale by default', () => {
      expect(() => instance.getLocale()).toThrow('locale is needed but not set');
    });

    it('should allow setting and getting locale', async () => {
      const locale = await DefaultDTL.localeLoader('en');
      expect(locale).toBeDefined();
      const newInstance = instance.setLocale(locale);
      expect(newInstance.getLocale()).toBe(locale);
    });
  });

  describe('addDays', () => {
    it('should add days correctly', () => {
      const result = instance.addDays(5);
      expect(result.getDayOfMonth()).toBe(20); // 15 + 5 = 20
    });
  });

  describe('addYears', () => {
    it('should add years correctly', () => {
      const result = instance.addYears(2);
      expect(result.getFullYear()).toBe(2027); // 2025 + 2 = 2027
    });
  });

  describe('toISOString', () => {
    it('should return ISO string', () => {
      expect(instance.toISOString()).toBe(testDate.toISOString());
    });
  });

  describe('toISODateString', () => {
    it('should return ISO date string', () => {
      expect(instance.toISODateString()).toBe('2025-01-15');
    });
  });

  describe('getWeekday', () => {
    it('should return correct weekday', () => {
      // January 15, 2025, is a Wednesday
      expect(instance.getWeekday()).toBe(DateTimeLibraryWeekday.Wednesday);
    });
  });

  describe('getMonth', () => {
    it('should return correct month', () => {
      expect(instance.getMonth()).toBe(DateTimeLibraryMonth.January);
    });
  });

  describe('getDayOfMonth', () => {
    it('should return correct day of month', () => {
      expect(instance.getDayOfMonth()).toBe(15);
    });
  });

  describe('getFullYear', () => {
    it('should return correct full year', () => {
      expect(instance.getFullYear()).toBe(2025);
    });
  });

  describe('getHours and setHours', () => {
    it('should return correct hours', () => {
      expect(instance.getHours()).toBe(12);
    });

    it('should set hours correctly', () => {
      instance.setHours(15);
      expect(instance.getHours()).toBe(15);
    });
  });

  describe('getMinutes and setMinutes', () => {
    it('should return correct minutes', () => {
      expect(instance.getMinutes()).toBe(30);
    });

    it('should set minutes correctly', () => {
      instance.setMinutes(10);
      expect(instance.getMinutes()).toBe(10);
    });
  });

  describe('getSeconds and setSeconds', () => {
    it('should return correct seconds', () => {
      expect(instance.getSeconds()).toBe(45);
    });

    it('should set seconds correctly', () => {
      instance.setSeconds(20);
      expect(instance.getSeconds()).toBe(20);
    });
  });

  describe('formatHoursDisplay', () => {
    it('should correctly format hours display', () => {
      expect(instance.formatHoursDisplay()).toBe('12');
    });
  });

  describe('formatMinutesDisplay', () => {
    it('should correctly format minutes display', () => {
      expect(instance.formatMinutesDisplay()).toBe('30');
    });
  });

  describe('formatSecondsDisplay', () => {
    it('should correctly format seconds display', () => {
      expect(instance.formatSecondsDisplay()).toBe('45');
    });
  });

  describe('daysInMonth', () => {
    it('should calculate correct days in month', () => {
      expect(instance.daysInMonth()).toBe(31); // January has 31 days
    });
  });

  describe('Time Component Setters Chaining', () => {
    it('should chain method calls for setting time components', () => {
      instance.setHours(14).setMinutes(25).setSeconds(10);
      expect(instance.getHours()).toBe(14);
      expect(instance.getMinutes()).toBe(25);
      expect(instance.getSeconds()).toBe(10);
    });
  });
});
