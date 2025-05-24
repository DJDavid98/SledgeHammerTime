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

export abstract class DateTimeLibraryValue<T = unknown> {
  constructor(protected value: T, protected _locale: string | null = null) {
  }

  abstract toString(): string;

  abstract setLocale(locale: string): DateTimeLibraryValue<T>;

  abstract getLocale(): string;

  abstract local(): DateTimeLibraryValue<T>;

  abstract fromNow(): string;

  abstract addDays(days: number): DateTimeLibraryValue<T>;

  abstract addYears(years: number): DateTimeLibraryValue<T>;

  abstract toDate(): Date;

  abstract formatDiscordTimestamp(format: MessageTimestampFormat): string;

  abstract formatCalendarDateDisplay(): string;

  abstract formatCalendarContext(): string;

  abstract formatDateInputDisplay(): string;

  abstract formatTimeInputDisplay(): string;

  abstract formatHoursDisplay(): string;

  abstract formatMinutesDisplay(): string;

  abstract formatSecondsDisplay(): string;

  abstract toISOString(): string;

  abstract toISODateString(): string;

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

  abstract replaceZone(zone: TimezoneSelection): DateTimeLibraryValue<T>;

  abstract setHours(hours: number): DateTimeLibraryValue<T>;

  abstract setMinutes(minutes: number): DateTimeLibraryValue<T>;

  abstract setSeconds(seconds: number): DateTimeLibraryValue<T>;


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
