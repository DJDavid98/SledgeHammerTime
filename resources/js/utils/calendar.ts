import moment, { Moment } from 'moment-timezone';

export interface GenerateCalendarOptions {
  year: number;
  month: Month | number;
  firstDayOfWeek?: DayOfWeek;
}

export enum DayOfWeek {
  Sunday,
  Monday,
  Tuesday,
  Wednesday,
  Thursday,
  Friday,
  Saturday,
}

export enum Month {
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

export interface CalendarDay {
  date: number;
  month: number;
  display: string;
  /**
   * Optional metadata used for display purposes only
   */
  weekday?: DayOfWeek;
}

export interface Calendar {
  // 2D array of [week][weekday]
  days: CalendarDay[][];
  firstDayOfWeek: DayOfWeek | number;
}

type WeekendDays = Partial<Record<DayOfWeek, string>>;

const redSundayWeekendDays: WeekendDays = {
  [DayOfWeek.Sunday]: 'red',
};
const redSaturdayWeekendDays: WeekendDays = {
  [DayOfWeek.Saturday]: 'red',
};
const redSaturdayAndSundayWeekendDays = { ...redSaturdayWeekendDays, ...redSundayWeekendDays };

export const WEEKEND_DAYS: Partial<Record<string, WeekendDays>> = {
  hr: redSundayWeekendDays,
  nl: { ...redSaturdayWeekendDays, ...redSundayWeekendDays },
  he: {
    ...redSaturdayWeekendDays,
    [DayOfWeek.Friday]: 'red',
  },
  hu: redSaturdayAndSundayWeekendDays,
  it: redSaturdayAndSundayWeekendDays,
  ms: {
    ...redSundayWeekendDays,
    [DayOfWeek.Saturday]: 'blue',
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
const normalizeWeekday = (weekday: DayOfWeek | number): number => {
  if (weekday > 6) throw new Error('Weekday must be a valid JS weekday');
  if (weekday === 0) return 7;
  return weekday;
};

/**
 * Months are 0-indexed
 */
export const getMomentForDate = (year: number, month: number, date: number) => moment({
  year,
  month,
  date,
  hour: 0,
  minute: 0,
  second: 0,
  milliseconds: 0,
});

export const getFirstDayOfWeekOffset = (firstDayOfMonthMoment: Moment, firstDayOfWeek: DayOfWeek | number): number => {
  const firstDayWeekday = firstDayOfMonthMoment.day();
  if (firstDayWeekday === firstDayOfWeek) {
    return 0;
  }
  const firstDayWeekdayNormalized = normalizeWeekday(firstDayWeekday);
  const firstDayOfWeekNormalized = normalizeWeekday(firstDayOfWeek);
  const offset = firstDayWeekdayNormalized < firstDayOfWeekNormalized ? LENGTH_OF_WEEK : 0;
  return firstDayOfWeekNormalized - firstDayWeekdayNormalized - offset;
};

export const getCalendarRows = (firstDayOfMonthMoment: Moment, firstDayOfWeekOffset: number) => {
  const daysInMonth = firstDayOfMonthMoment.daysInMonth();
  return Math.ceil((daysInMonth + Math.abs(firstDayOfWeekOffset)) / LENGTH_OF_WEEK);
};

export interface WeekdayItem {
  index: DayOfWeek;
  name: string;
}

export const getWeekdayItems = (weekdays: string[] | undefined, firstDayOfWeek: DayOfWeek): WeekdayItem[] => {
  if (!weekdays) {
    return [];
  }

  const items = weekdays.map((weekday, index) => ({
    index,
    name: weekday,
  }));

  if (firstDayOfWeek === DayOfWeek.Sunday) {
    return items;
  }

  return items.slice(firstDayOfWeek).concat(items.slice(0, firstDayOfWeek));
};

export const generateCalendar = ({
  year,
  month,
  firstDayOfWeek = DayOfWeek.Monday,
}: GenerateCalendarOptions): Calendar => {
  if (month < Month.January || month > Month.December) {
    throw new Error('Month is out of bounds');
  }
  const firstDayOfMonthMoment = getMomentForDate(year, month, FIRST_DAY_OF_MONTH);

  const firstDayOfWeekOffset = getFirstDayOfWeekOffset(firstDayOfMonthMoment, firstDayOfWeek);
  const gridSize = {
    columns: LENGTH_OF_WEEK,
    rows: getCalendarRows(firstDayOfMonthMoment, firstDayOfWeekOffset),
  };
  // Pre-allocate the array, map is used instead of fill to avoid pass-by-reference errors
  const days = Array.from<CalendarDay[]>({ length: gridSize.rows }).map(() => new Array(gridSize.columns) as CalendarDay[]);
  let dayOffset = firstDayOfWeekOffset;
  for (let weekIndex = 0; weekIndex < gridSize.rows; weekIndex++) {
    for (let dayIndex = 0; dayIndex < gridSize.columns; dayIndex++) {
      const weekDayMoment = moment(firstDayOfMonthMoment).add(dayOffset, 'days');
      days[weekIndex][dayIndex] = {
        date: weekDayMoment.date(),
        weekday: weekDayMoment.day(),
        month: weekDayMoment.month(),
        display: weekDayMoment.format('D'),
      };
      dayOffset++;
    }
  }

  return {
    days,
    firstDayOfWeek,
  };
};
