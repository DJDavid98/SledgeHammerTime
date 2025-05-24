import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryMonth } from '@/classes/DateTimeLibraryValue';
import { MomentDTL } from '@/classes/MomentDTL';
import { LanguageConfig } from '@/model/language-config';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { AvailableLanguage, FALLBACK_LANGUAGE, LANGUAGES } from '@/utils/language-settings';
import { describe, expect, it, vi } from 'vitest';

describe('DateTimeLibrary', () => {
  const implementations: [string, DateTimeLibrary][] = [['MomentDTL', new MomentDTL()]];
  const testLanguages = ['en', 'en-GB', 'hu'] as const satisfies AvailableLanguage[];

  describe.each(implementations)('Implementation: %s', (_, dtl) => {
    describe('Constants', () => {
      it('should have the correct constants', () => {
        expect(dtl.isoTimeFormat).toBeDefined();
        expect(dtl.isoFormattingDateFormat).toBeDefined();
        expect(dtl.isoParsingDateFormat).toBeDefined();
        expect(dtl.isoFormat).toBeDefined();
        expect(dtl.urlFormat).toBeDefined();
        expect(dtl.timezoneNames).toBeDefined();
        expect(dtl.timezoneNames.length).toBeGreaterThan(0);
      });
    });

    describe('getLocaleNameFromLanguage', () => {
      it('should return the correct locale name for a language', () => {
        const language: AvailableLanguage = 'en';
        const result = dtl.getLocaleNameFromLanguage(language);
        expect(result).toBe('en');
      });

      it('should return the correct locale name for different languages', () => {
        expect(dtl.getLocaleNameFromLanguage('en-GB')).toBe('en-gb');
        expect(dtl.getLocaleNameFromLanguage('hu')).toBe('hu');
        expect(dtl.getLocaleNameFromLanguage('pt-BR')).toBe('pt-br');
      });
    });

    describe('getLocaleNameFromLanguageConfig', () => {
      it('should return the correct locale name for a language config', () => {
        const language: AvailableLanguage = 'pt-BR';
        const languageConfig: LanguageConfig = LANGUAGES[language];
        const result = dtl.getLocaleNameFromLanguageConfig(language, languageConfig);
        expect(result).toBe('pt-br');
      });

      it('should return the language when no config is provided', () => {
        const language: AvailableLanguage = 'en';
        const result = dtl.getLocaleNameFromLanguageConfig(language, undefined);
        expect(result).toBe(language);
      });

      it('should return the fallback language when no language or config is provided', () => {
        const result = dtl.getLocaleNameFromLanguageConfig(undefined, undefined);
        expect(result).toEqual(FALLBACK_LANGUAGE);
      });
    });

    describe('loadLocaleLowLevel', () => {
      it('should load a locale', async () => {
        const localeName = 'en';
        const result = await dtl.loadLocaleLowLevel(localeName);
        expect(result).toBeDefined();
      });

      it('should return undefined for an invalid locale', async () => {
        const consoleSpy = vi.spyOn(console, 'warn').mockImplementation(() => {
        });
        try {
          const localeName = 'invalid-locale';
          const result = await dtl.loadLocaleLowLevel(localeName);
          expect(result).toBeUndefined();
          expect(consoleSpy).toHaveBeenCalled();
        } finally {
          consoleSpy.mockRestore();
        }
      });
    });

    describe('localeLoader', () => {
      it('should load a locale and return a DateTimeLibraryLocale', async () => {
        const localeName = 'en';
        const result = await dtl.localeLoader(localeName);
        expect(result).toBeDefined();
        expect(result.name).toBe(localeName);
        expect(result.getShortWeekdays()).toBeDefined();
        expect(result.getShortWeekdays().length).toBe(7);
        expect(result.getHourCycleInfo()).toBeDefined();
        expect(result.getHourCycleInfo().hourCycle).toEqual('h12');
        expect(result.getWeekInfo()).toBeDefined();
        expect(typeof result.getWeekInfo().firstDay).toBe('number');
      });
    });

    describe('guessInitialTimezoneName', () => {
      it('should return a valid timezone name', () => {
        const result = dtl.guessInitialTimezoneName();
        // Should return a string like "America/New_York" or "Europe/London"
        expect(result).toMatch(/^[a-z/_]+$/i);
        // Verify it's in the list of valid timezone names
        expect(dtl.timezoneNames).toContain(result);
      });
    });

    describe('getDefaultInitialTimezoneSelection', () => {
      it('should return a timezone selection', () => {
        const result = dtl.getDefaultInitialTimezoneSelection();
        expect(result).toBeDefined();
        expect(result.type).toBe(TimeZoneSelectionType.ZONE_NAME);
        if (result.type === TimeZoneSelectionType.ZONE_NAME) {
          expect(result.name).toBeDefined();
        }
      });

      it('should use the hint if provided', () => {
        const hint = 'Europe/London';
        const result = dtl.getDefaultInitialTimezoneSelection(hint);
        expect(result).toBeDefined();
        expect(result.type).toBe(TimeZoneSelectionType.ZONE_NAME);
        if (result.type === TimeZoneSelectionType.ZONE_NAME) {
          expect(result.name).toBe(hint);
        }
      });

      it('should handle offset hints', () => {
        const hint = 'GMT+1';
        const result = dtl.getDefaultInitialTimezoneSelection(hint);
        expect(result).toBeDefined();
        expect(result.type).toBe(TimeZoneSelectionType.OFFSET);
        if (result.type === TimeZoneSelectionType.OFFSET) {
          expect(result.hours).toBe(1);
          expect(result.minutes).toBe(0);
        }
      });
    });

    describe('getMeridiemLabel', () => {
      const expectedLabels = {
        am: {
          en: 'AM',
          'en-GB': 'AM',
          hu: 'DE',
        },
        pm: {
          en: 'PM',
          'en-GB': 'PM',
          hu: 'DU',
        },
      };

      it.each(testLanguages)('should return AM/PM labels for locale %s', (locale) => {
        const amLabel = dtl.getMeridiemLabel(true, 0, locale);
        const pmLabel = dtl.getMeridiemLabel(false, 0, locale);
        expect(amLabel).toEqual(expectedLabels.am[locale]);
        expect(pmLabel).toEqual(expectedLabels.pm[locale]);
        expect(amLabel).not.toBe(pmLabel);
      });

      it('should handle minutes parameter', () => {
        const amLabel = dtl.getMeridiemLabel(true, 30);
        expect(amLabel).toBeDefined();
      });
    });

    describe('getDefaultInitialDateTime', () => {
      it('should return a date and time', () => {
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const result = dtl.getDefaultInitialDateTime(timezone, null);
        expect(result).toHaveLength(2);
        expect(result[0]).toMatch(/^\d{4}-\d{2}-\d{2}$/); // Date format YYYY-MM-DD
        expect(result[1]).toMatch(/^\d{2}:\d{2}:\d{2}$/); // Time format HH:MM:SS
      });

      it('should use the provided default date time', () => {
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const defaultDateTime = '20250101.120000'; // January 1, 2025, 12:00:00
        const result = dtl.getDefaultInitialDateTime(timezone, defaultDateTime);
        expect(result).toHaveLength(2);
        expect(result[0]).toBe('2025-01-01');
        expect(result[1]).toBe('12:00:00');
      });
    });

    describe('getInitialDateTime', () => {
      it('should return a date and time with zone offset', () => {
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const result = dtl.getInitialDateTime(timezone);
        expect(result).toHaveLength(2);
        expect(result[0]).toMatch(/^\d{4}-\d{2}-\d{2}$/); // Date format YYYY-MM-DD
        expect(result[1]).toMatch(/^\d{2}:\d{2}:\d{2}$/); // Time format HH:MM:SS
      });

      it('should return a date and time with UTC offset', () => {
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.OFFSET,
          hours: 1,
          minutes: 0,
        };
        const result = dtl.getInitialDateTime(timezone);
        expect(result).toHaveLength(2);
        expect(result[0]).toMatch(/^\d{4}-\d{2}-\d{2}$/); // Date format YYYY-MM-DD
        expect(result[1]).toMatch(/^\d{2}:\d{2}:\d{2}$/); // Time format HH:MM:SS
      });

      it('should use the provided default date time with zone offset', () => {
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const defaultDateTime = '20250101.120000'; // January 1, 2025, 12:00:00
        const result = dtl.getInitialDateTime(timezone, defaultDateTime);
        expect(result).toHaveLength(2);
        expect(result[0]).toBe('2025-01-01');
        expect(result[1]).toBe('12:00:00');
      });

      it('should use the provided default date time with UTC offset', () => {
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.OFFSET,
          hours: 1,
          minutes: 0,
        };
        const defaultDateTime = '20250101.120000'; // January 1, 2025, 12:00:00
        const result = dtl.getInitialDateTime(timezone, defaultDateTime);
        expect(result).toHaveLength(2);
        expect(result[0]).toBe('2025-01-01');
        expect(result[1]).toBe('12:00:00');
      });

      it('should zero seconds when requested', () => {
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const defaultDateTime = '20250101.120030'; // January 1, 2025, 12:00:30
        const result = dtl.getInitialDateTime(timezone, defaultDateTime, true);
        expect(result).toHaveLength(2);
        expect(result[0]).toBe('2025-01-01');
        expect(result[1]).toBe('12:00:00');
      });
    });

    describe('now', () => {
      it('should return the current date and time', () => {
        const before = new Date();
        const result = dtl.now();
        const after = new Date();

        // Convert to timestamps for comparison
        const beforeTimestamp = before.getTime();
        const resultTimestamp = result.toDate().getTime();
        const afterTimestamp = after.getTime();

        // Result should be between before and after
        expect(resultTimestamp).toBeGreaterThanOrEqual(beforeTimestamp);
        expect(resultTimestamp).toBeLessThanOrEqual(afterTimestamp);

        // Verify that the returned object has the right structure
        expect(result.getFullYear()).toBe(before.getFullYear());
        expect(result.getMonth()).toBe(dtl.fromTimestampMsUtc(before.getTime()).getMonth());
      });
    });

    describe('convertIsoToLocalizedDateTimeInputValue', () => {
      const expectedFormats = {
        'en': 'January 1, 2025 12:00 PM',
        'en-GB': '1 January 2025 12:00',
        'hu': '2025. január 1. 12:00',
      };

      it.each(testLanguages)('should convert ISO date and time to localized format for %s locale', (locale) => {
        const date = '2025-01-01';
        const time = '12:00:00';
        const result = dtl.convertIsoToLocalizedDateTimeInputValue(date, time, locale);

        // Different locales have different formatting, so check against expected values
        expect(result).toBe(expectedFormats[locale]);
      });
    });

    describe('convertIsoToLocalizedTimeInputValue', () => {
      const expectedFormats = {
        'en': '12:00:00 PM',
        'en-GB': '12:00:00',
        'hu': '12:00:00',
      };

      it.each(testLanguages)('should convert ISO time to localized format for %s locale', (locale) => {
        const time = '12:00:00';
        const result = dtl.convertIsoToLocalizedTimeInputValue(time, locale);

        // Different locales have different time formatting
        expect(result).toBe(expectedFormats[locale]);
      });
    });

    describe('convertIsoToLocalizedDateInputValue', () => {
      const expectedFormats = {
        'en': 'January 2, 1970',
        'en-GB': '2 January 1970',
        'hu': '1970. január 2.',
      };

      it.each(testLanguages)('should convert ISO date to localized format for %s locale', (locale) => {
        const date = '1970-01-02';
        const result = dtl.convertIsoToLocalizedDateInputValue(date, locale);

        // Different locales have different time formatting
        expect(result).toBe(expectedFormats[locale]);
      });
    });

    describe('getValueForIsoZonedDate', () => {
      it('should return a DateTimeLibraryValue for a date', () => {
        const date = '2025-01-01';
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const result = dtl.getValueForIsoZonedDate(date, timezone);
        expect(result).toBeDefined();
        expect(result.toISODateString()).toBe(date);
      });
    });

    describe('getValueForIsoZonedTime', () => {
      it('should return a DateTimeLibraryValue for a time', () => {
        const time = '12:00:00';
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const result = dtl.getValueForIsoZonedTime(time, timezone);
        expect(result).toBeDefined();
        expect(result.getHours()).toBe(12);
        expect(result.getMinutes()).toBe(0);
        expect(result.getSeconds()).toBe(0);
      });
    });

    describe('getValueForIsoZonedDateTime', () => {
      it('should return a DateTimeLibraryValue for a date and time', () => {
        const date = '2025-01-01';
        const time = '12:00:00';
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'UTC',
        };
        const result = dtl.getValueForIsoZonedDateTime(date, time, timezone);
        expect(result).toBeDefined();
        expect(result.toISODateString()).toBe(date);
        expect(result.getHours()).toBe(12);
        expect(result.getMinutes()).toBe(0);
        expect(result.getSeconds()).toBe(0);
      });

      it('should handle offset timezones', () => {
        const date = '2025-01-01';
        const time = '12:00:00';
        const timezone: TimezoneSelection = {
          type: TimeZoneSelectionType.OFFSET,
          hours: 1,
          minutes: 0,
        };
        const result = dtl.getValueForIsoZonedDateTime(date, time, timezone);
        expect(result).toBeDefined();
        expect(result.toISODateString()).toBe(date);
        expect(result.getHours()).toBe(12);
        expect(result.getMinutes()).toBe(0);
        expect(result.getSeconds()).toBe(0);
        expect(result.getUtcOffsetMinutes()).toBe(60);
      });
    });

    describe('getValueForDate', () => {
      it('should return a DateTimeLibraryValue for year, month, and date', () => {
        const year = 2025;
        const month = DateTimeLibraryMonth.January;
        const date = 1;
        const result = dtl.getValueForDate(year, month, date);
        expect(result).toBeDefined();
        expect(result.getFullYear()).toBe(year);
        expect(result.getMonth()).toBe(month);
        expect(result.getDayOfMonth()).toBe(date);
      });
    });

    describe('fromIsoString', () => {
      it('should return a DateTimeLibraryValue from an ISO string', () => {
        const iso = '2025-01-01T12:00:00Z';
        const result = dtl.fromIsoString(iso);
        expect(result).toBeDefined();
        expect(result.getFullYear()).toBe(2025);
        expect(result.getMonth()).toBe(DateTimeLibraryMonth.January);
        expect(result.getDayOfMonth()).toBe(1);
        expect(result.getHours()).toBe(12);
        expect(result.getMinutes()).toBe(0);
        expect(result.getSeconds()).toBe(0);
      });
    });

    describe('fromTimestampMsUtc', () => {
      it('should return a DateTimeLibraryValue from a UTC timestamp', () => {
        const timestamp = 1735732800e3; // 2025-01-01T12:00:00Z
        const result = dtl.fromTimestampMsUtc(timestamp);
        expect(result).toBeDefined();
        expect(result.getFullYear()).toBe(2025);
        expect(result.getMonth()).toBe(DateTimeLibraryMonth.January);
        expect(result.getDayOfMonth()).toBe(1);
        expect(result.getHours()).toBe(12);
        expect(result.getMinutes()).toBe(0);
        expect(result.getSeconds()).toBe(0);
      });
    });
  });
});
