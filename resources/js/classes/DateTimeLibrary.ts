import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { LanguageConfig } from '@/model/language-config';
import { TimezoneSelection } from '@/model/timezone-selection';
import { AvailableLanguage } from '@/utils/language-settings';

// eslint-disable-next-line @typescript-eslint/no-explicit-any -- Needed for testing
export interface DateTimeLibrary<T = any, L = any> {
  isoTimeFormat: string;
  isoFormattingDateFormat: string;
  isoParsingDateFormat: string;
  isoFormat: string;
  urlFormat: string;
  timezoneNames: string[];

  getLocaleNameFromLanguage(language: AvailableLanguage): string;

  getLocaleNameFromLanguageConfig(language: AvailableLanguage | undefined, languageConfig: LanguageConfig | undefined): string;

  loadLocaleLowLevel(localeName: string): Promise<L | undefined>;

  localeLoader(localeName: string): Promise<DateTimeLibraryLocale>;

  guessInitialTimezoneName(): string;

  getDefaultInitialTimezoneSelection(hint?: string): TimezoneSelection;

  getMeridiemLabel(isAm: boolean, minutes?: number, locale?: string): string;

  getDefaultInitialDateTime(
    timezone: TimezoneSelection,
    defaultDateTime: string | undefined | null,
  ): [string, string];

  getInitialDateTime(
    timezone: TimezoneSelection,
    defaultDateTime?: string | null,
    zeroSeconds?: boolean,
  ): [string, string];

  now(): DateTimeLibraryValue<T>;

  convertIsoToLocalizedDateTimeInputValue(
    date: string,
    time: string,
    locale: string,
  ): string;

  convertIsoToLocalizedDateInputValue(
    date: string,
    locale: string,
  ): string;

  convertIsoToLocalizedTimeInputValue(
    time: string,
    locale: string,
  ): string;

  getValueForIsoZonedDate(
    date: string,
    timezone: TimezoneSelection,
  ): DateTimeLibraryValue<T>;

  getValueForIsoZonedTime(
    time: string,
    timezone: TimezoneSelection,
  ): DateTimeLibraryValue<T>;

  getValueForIsoZonedDateTime(
    date: string,
    time: string,
    timezone: TimezoneSelection,
  ): DateTimeLibraryValue<T>;

  /**
   * Months are 0-indexed
   */
  getValueForDate(year: number, month: number, date: number): DateTimeLibraryValue<T>;

  fromIsoString(iso: string): DateTimeLibraryValue<T>;

  fromTimestampMsUtc(number: number): DateTimeLibraryValue<T>;
}


export type LocaleLoader = DateTimeLibrary['localeLoader'];
