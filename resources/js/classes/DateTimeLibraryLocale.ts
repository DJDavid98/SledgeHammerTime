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

// eslint-disable-next-line @typescript-eslint/no-explicit-any -- Required for type compatibility
export abstract class DateTimeLibraryLocale<L = any> {
  abstract readonly name: string;
  abstract readonly lowLevelValue: L | undefined;

  abstract getWeekInfo(): WeekInfo;

  abstract getHourCycleInfo(): HourCycleInfo;

  abstract getShortWeekdays(): string[];
}
