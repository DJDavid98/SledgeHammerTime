import { DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';

interface WithFallbackIndicator {
  fallback?: true;
}

export interface WeekInfo extends WithFallbackIndicator {
  firstDay: DateTimeLibraryWeekday;
  weekend: DateTimeLibraryWeekday[];
}

/**
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/Locale/hourCycle
 */
export interface HourCycleInfo extends WithFallbackIndicator {
  hourCycle: Intl.LocaleOptions['hourCycle'];
}

export abstract class DateTimeLibraryLocale {
  abstract readonly name: string;

  abstract getWeekInfo(): WeekInfo;

  abstract getHourCycleInfo(): HourCycleInfo;

  abstract getShortWeekdays(): string[];
}
