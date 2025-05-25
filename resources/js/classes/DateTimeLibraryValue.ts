import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { TimezoneSelection } from '@/model/timezone-selection';

export enum DateTimeLibraryWeekday {
  Sunday,
  Monday,
  Tuesday,
  Wednesday,
  Thursday,
  Friday,
  Saturday
}

export enum DateTimeLibraryMonth {
  January,
  February,
  March,
  April,
  May,
  June,
  July,
  August,
  September,
  October,
  November,
  December,
}

// eslint-disable-next-line @typescript-eslint/no-explicit-any -- Required to allow extension
export abstract class DateTimeLibraryValue<T = any, L = any> {
  constructor(protected value: T, protected locale: DateTimeLibraryLocale<L> | null = null) {
  }

  abstract toString(): string;

  abstract setLocale(locale: DateTimeLibraryLocale<L>): DateTimeLibraryValue<T, L>;

  abstract getLocale(): DateTimeLibraryLocale<L>;

  abstract local(): DateTimeLibraryValue<T, L>;

  abstract fromNow(): string;

  abstract addDays(days: number): DateTimeLibraryValue<T, L>;

  abstract addYears(years: number): DateTimeLibraryValue<T, L>;

  abstract toDate(): Date;

  abstract formatDiscordTimestamp(mtf: MessageTimestampFormat): string;

  abstract formatCalendarDateDisplay(): string;

  abstract formatCalendarContext(): string;

  abstract formatHoursDisplay(): string;

  abstract formatMinutesDisplay(): string;

  abstract formatSecondsDisplay(): string;

  abstract toISOString(): string;

  abstract toISODateString(): string;

  abstract toISOTimeString(): string;

  abstract getWeekday(): DateTimeLibraryWeekday;

  abstract getDayOfMonth(): number;

  abstract getMonth(): DateTimeLibraryMonth;

  abstract getFullYear(): number;

  abstract getHours(): number;

  abstract getMinutes(): number;

  abstract getSeconds(): number;

  abstract getUnixSeconds(): number;

  abstract getUtcOffsetMinutes(): number;

  abstract daysInMonth(): number;

  abstract replaceZone(zone: TimezoneSelection): DateTimeLibraryValue<T, L>;

  abstract setHours(hours: number): DateTimeLibraryValue<T, L>;

  abstract setMinutes(minutes: number): DateTimeLibraryValue<T, L>;

  abstract setSeconds(seconds: number): DateTimeLibraryValue<T, L>;

  protected mapDefaultWeekday(weekday: number) {
    if (weekday >= 0 && weekday <= 6) {
      return weekday as DateTimeLibraryWeekday;
    }

    throw new Error(`Unhandled weekday ${weekday}`);
  }

  protected mapDefaultMonth(month: number) {
    if (month >= 0 && month <= 11) {
      return month as DateTimeLibraryMonth;
    }

    throw new Error(`Unhandled month ${month}`);
  }
}
