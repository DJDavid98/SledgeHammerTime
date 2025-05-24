import {
  DateTimeLibraryMonth,
  DateTimeLibraryValue,
  DateTimeLibraryWeekday,
} from '@/classes/DateTimeLibraryValue';
import { DTL } from '@/utils/dtl';

export interface GenerateCalendarOptions {
  year: number;
  month: DateTimeLibraryMonth | number;
  firstDayOfWeek?: DateTimeLibraryWeekday;
}

export interface CalendarDay {
  date: number;
  month: number;
  display: string;
  /**
   * Optional metadata used for display purposes only
   */
  weekday?: DateTimeLibraryWeekday;
}

export interface Calendar {
  // 2D array of [week][weekday]
  days: CalendarDay[][];
  firstDayOfWeek: DateTimeLibraryWeekday | number;
}

type WeekendDays = Partial<Record<DateTimeLibraryWeekday, string>>;

const redSundayWeekendDays: WeekendDays = {
  [DateTimeLibraryWeekday.Sunday]: 'red',
};
const redSaturdayWeekendDays: WeekendDays = {
  [DateTimeLibraryWeekday.Saturday]: 'red',
};
const redSaturdayAndSundayWeekendDays = { ...redSaturdayWeekendDays, ...redSundayWeekendDays };

export const WEEKEND_DAYS: Partial<Record<string, WeekendDays>> = {
  hr: redSundayWeekendDays,
  nl: { ...redSaturdayWeekendDays, ...redSundayWeekendDays },
  he: {
    ...redSaturdayWeekendDays,
    [DateTimeLibraryWeekday.Friday]: 'red',
  },
  hu: redSaturdayAndSundayWeekendDays,
  it: redSaturdayAndSundayWeekendDays,
  ms: {
    ...redSundayWeekendDays,
    [DateTimeLibraryWeekday.Saturday]: 'blue',
  },
  pl: redSundayWeekendDays,
  sr: redSundayWeekendDays,
  sv: redSundayWeekendDays,
};

export const LENGTH_OF_WEEK = 7;
const FIRST_DAY_OF_MONTH = 1;

/**
 * Convert a JS-based weekday to a human-readable value
 */
const normalizeWeekday = (weekday: DateTimeLibraryWeekday | number): number => {
  if (weekday > 6) throw new Error('Weekday must be a valid JS weekday');
  if (weekday === 0) return 7;
  return weekday;
};

export const getFirstDayOfWeekOffset = (firstDayOfMonthDateTime: DateTimeLibraryValue, firstDayOfWeek: DateTimeLibraryWeekday | number): number => {
  const firstDayWeekday = firstDayOfMonthDateTime.getWeekday();
  if (firstDayWeekday === firstDayOfWeek) {
    return 0;
  }
  const firstDayWeekdayNormalized = normalizeWeekday(firstDayWeekday);
  const firstDayOfWeekNormalized = normalizeWeekday(firstDayOfWeek);
  const offset = firstDayWeekdayNormalized < firstDayOfWeekNormalized ? LENGTH_OF_WEEK : 0;
  return firstDayOfWeekNormalized - firstDayWeekdayNormalized - offset;
};

export const getCalendarRows = (firstDayOfMonthDateTime: DateTimeLibraryValue, firstDayOfWeekOffset: number) => {
  const daysInMonth = firstDayOfMonthDateTime.daysInMonth();
  return Math.ceil((daysInMonth + Math.abs(firstDayOfWeekOffset)) / LENGTH_OF_WEEK);
};

export interface WeekdayItem {
  index: DateTimeLibraryWeekday;
  name: string;
}

export const getWeekdayItems = (weekdays: string[] | undefined, firstDayOfWeek: DateTimeLibraryWeekday): WeekdayItem[] => {
  if (!weekdays) {
    return [];
  }

  const items = weekdays.map((weekday, index) => ({
    index,
    name: weekday,
  }));

  if (firstDayOfWeek === DateTimeLibraryWeekday.Sunday) {
    return items;
  }

  return items.slice(firstDayOfWeek).concat(items.slice(0, firstDayOfWeek));
};

export const generateCalendar = ({
  year,
  month,
  firstDayOfWeek = DateTimeLibraryWeekday.Monday,
}: GenerateCalendarOptions): Calendar => {
  if (month < DateTimeLibraryMonth.January || month > DateTimeLibraryMonth.December) {
    throw new Error('Month is out of bounds');
  }
  const firstDayOfMonthDateTime = DTL.getValueForDate(year, month, FIRST_DAY_OF_MONTH);

  const firstDayOfWeekOffset = getFirstDayOfWeekOffset(firstDayOfMonthDateTime, firstDayOfWeek);
  const gridSize = {
    columns: LENGTH_OF_WEEK,
    rows: getCalendarRows(firstDayOfMonthDateTime, firstDayOfWeekOffset),
  };
  // Pre-allocate the array, map is used instead of fill to avoid pass-by-reference errors
  const days = Array.from<CalendarDay[]>({ length: gridSize.rows }).map(() => new Array(gridSize.columns) as CalendarDay[]);
  let dayOffset = firstDayOfWeekOffset;
  for (let weekIndex = 0; weekIndex < gridSize.rows; weekIndex++) {
    for (let dayIndex = 0; dayIndex < gridSize.columns; dayIndex++) {
      const weekDayDateTime = firstDayOfMonthDateTime.addDays(dayOffset);
      days[weekIndex][dayIndex] = {
        date: weekDayDateTime.getDayOfMonth(),
        weekday: weekDayDateTime.getWeekday(),
        month: weekDayDateTime.getMonth(),
        display: weekDayDateTime.formatCalendarDateDisplay(),
      };
      dayOffset++;
    }
  }

  return {
    days,
    firstDayOfWeek,
  };
};
