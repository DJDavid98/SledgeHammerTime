import {
  TimezoneSelection,
  TimezoneSelectionByOffset,
  TimeZoneSelectionType,
} from '@/model/timezone-selection';
import { pad } from '@/utils/pad';
import { TZDate } from '@date-fns/tz';
import { format, parse, setHours, setMinutes, setSeconds } from 'date-fns';

export const isoTimeFormat = 'HH:mm:ss';
export const isoFormattingDateFormat = 'y-MM-dd';
export const isoParsingDateFormat = 'Y-MM-d';
export const isoFormat = `${isoFormattingDateFormat} ${isoTimeFormat}`;
export const urlFormat = `yMMdd.HHmmss`;

export const fallbackIsoDate = '1970-01-01';
export const fallbackIsoTime = '00:00:00';

export const offsetZoneRegex = /^(?:(Etc\/)?(?:GMT|UTC))?\+?(-?\d{1,2})(?::?(\d{2}))?$/i;

export const getSortedNormalizedTimezoneNames = (): string[] =>
  Intl.supportedValuesOf('timeZone')
    .filter((name) => !name.startsWith('Etc/GMT'))
    .sort((a, b) => a.localeCompare(b));

export const timezoneNames = getSortedNormalizedTimezoneNames();

export const getTimezoneValue = (timezone: string) => ({
  value: timezone,
  label: timezone,
});

export const rangeLimit = (value: number, min: number, max: number): number => {
  let log = false;
  let result = value;

  if (!isNaN(min) && value < min) {
    result = min;
    log = true;
  } else if (!isNaN(max) && value > max) {
    result = max;
    log = true;
  }

  if (log) {
    console.warn(new RangeError(`Number between ${min} and ${max} is expected, got ${value}`));
  }
  return result;
};

export const rangeLimitInput = (target: unknown): number => {
  if (!(target instanceof HTMLInputElement)) {
    console.warn(`target must be an input, received ${typeof target}`);
    return NaN;
  }

  const value = parseInt(target.value, 10);
  const min = parseInt(target.min, 10);
  const max = parseInt(target.max, 10);
  return rangeLimit(value, min, max);
};

export const toTwentyFourHours = (value: number, isAm: boolean) => {
  const twelveHourValue = rangeLimit(value, 1, 12);

  const baseValue = isAm ? 0 : 12;
  return twelveHourValue === 12 ? baseValue : twelveHourValue + baseValue;
};

export const toTwelveHours = (value: number) => {
  const twentyFourHourValue = rangeLimit(value, 0, 23);

  const modResult = twentyFourHourValue % 12;
  return modResult === 0 ? 12 : modResult;
};

interface HoursCoercionResult {
  hours: number;
  isAm: boolean;
}

export const coerceToTwelveHours = (value: number): HoursCoercionResult | null => {
  const twentyFourHours = rangeLimit(value, 0, 23);

  if (twentyFourHours > 12) {
    return {
      hours: limitToTwelveHours(twentyFourHours),
      isAm: false,
    };
  }

  if (twentyFourHours < 1) {
    return {
      hours: limitToTwelveHours(twentyFourHours),
      isAm: true,
    };
  }

  // No coercion needed
  return null;
};


export const limitToTwelveHours = (value: number): number => {
  const twentyFourHours = rangeLimit(value, 0, 23);

  if (twentyFourHours > 12) {
    return twentyFourHours - 12;
  }

  return twentyFourHours < 1 ? 12 : twentyFourHours;
};

export const limitHours = (value: number): number => {
  return rangeLimit(value, 0, 23);
};
export const limitMinutesSeconds = (value: number): number => {
  return rangeLimit(value, 0, 59);
};
export const limitMonth = (value: number): number => {
  return rangeLimit(value, 1, 12);
};
export const limitDate = (value: number): number => {
  return rangeLimit(value, 1, 31);
};

export const getMeridiemLabel = (isAm: boolean, minutes = 0) => format(setMinutes(setHours(new Date(), isAm ? 10 : 22), minutes), 'a');

export const getInitialDateTime = (timezone: TimezoneSelection, defaultDateTime?: string | null, zeroSeconds = false): [string, string] => {
  if (typeof defaultDateTime === 'string') {
    const parseResult = parse(defaultDateTime, urlFormat, new Date());
    const dateString = format(parseResult, isoFormattingDateFormat);
    let timeString = format(parseResult, isoTimeFormat);
    if (zeroSeconds) {
      timeString = timeString.replace(/:\d{2}$/, ':00');
    }
    return [dateString, timeString];
  }
  let localDate: TZDate;
  switch (timezone.type) {
    case TimeZoneSelectionType.OFFSET:
      localDate = TZDate.tz(getUtcOffsetString(timezone));
      break;
    case TimeZoneSelectionType.ZONE_NAME:
      localDate = TZDate.tz(timezone.name);
      break;
  }
  if (zeroSeconds) {
    localDate = setSeconds(localDate, 0);
  }
  const [dateString, timeString] = format(localDate, isoFormat).split(/[T ]/);
  return [dateString, timeString];
};
export const getDateTimeTZDate = (inputString: string, timezone: TimezoneSelection): TZDate => {
  switch (timezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return TZDate.tz(getUtcOffsetString(timezone), inputString);
    case TimeZoneSelectionType.ZONE_NAME:
      return TZDate.tz(timezone.name, inputString);
  }
};

export const getDefaultInitialDateTime = (defaultDateTime: string | undefined | null, timezone: TimezoneSelection): [string, string] => {
  const hasDefaultTs = typeof defaultDateTime === 'string';
  return getInitialDateTime(timezone, defaultDateTime, !hasDefaultTs);
};

export const guessInitialTimezoneName = (): string => {
  try {
    return Intl.DateTimeFormat().resolvedOptions().timeZone;
  } catch (e) {
    console.error(e);
  }
  return 'UTC';
};

export const getDefaultInitialTimezone = (defaultTimezoneProp?: string): TimezoneSelection => {
  if (defaultTimezoneProp) {
    const offsetZoneMatch = defaultTimezoneProp.match(offsetZoneRegex);
    if (offsetZoneMatch !== null) {
      const hoursMultiplier = offsetZoneMatch[1] ? -1 : 1;
      const hours = rangeLimit(parseInt(offsetZoneMatch[2], 10), -14, 14);
      const minutes = rangeLimit(parseInt(offsetZoneMatch[3], 10), 0, 59);
      if (!isNaN(hours)) {
        return {
          type: TimeZoneSelectionType.OFFSET,
          // Handle negative zero case consistently
          hours: hours === 0 ? 0 : hours * hoursMultiplier,
          minutes: isNaN(minutes) ? 0 : minutes,
        };
      }
    } else {
      return { type: TimeZoneSelectionType.ZONE_NAME, name: defaultTimezoneProp };
    }
  }
  return { type: TimeZoneSelectionType.ZONE_NAME, name: guessInitialTimezoneName() };
};

export const getUtcOffsetString = (zoneSelectionByOffset: TimezoneSelectionByOffset) => {
  return (zoneSelectionByOffset.hours < 0 ? '-' : '+')
    + pad(Math.abs(zoneSelectionByOffset.hours), 2)
    + ':'
    + pad(zoneSelectionByOffset.minutes, 2);
};

export const createCurrentTsWithTimezone = (currentTimestamp: TZDate, currentTimezone: TimezoneSelection) => {
  switch (currentTimezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return TZDate.tz(getUtcOffsetString(currentTimezone), currentTimestamp);
    case TimeZoneSelectionType.ZONE_NAME:
      return TZDate.tz(currentTimezone.name, currentTimestamp);
  }
};

export const convertTimeZoneSelectionToString = (currentTimezone: TimezoneSelection) => {
  switch (currentTimezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return getUtcOffsetString(currentTimezone);
    case TimeZoneSelectionType.ZONE_NAME:
      return currentTimezone.name;
  }
};
