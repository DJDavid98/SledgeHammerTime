import {
  TimezoneSelection,
  TimezoneSelectionByOffset,
  TimeZoneSelectionType,
} from '@/model/timezone-selection';
import { pad } from '@/utils/pad';

export const offsetZoneRegex = /^(?:Etc\/)?(?:GMT|UTC)\+?(-?\d{1,2})(?::?(\d{2}))?$/i;

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

export const getUtcOffsetString = (zoneSelectionByOffset: TimezoneSelectionByOffset) => {
  return (zoneSelectionByOffset.hours < 0 ? '-' : '+')
    + pad(Math.abs(zoneSelectionByOffset.hours), 2)
    + ':'
    + pad(zoneSelectionByOffset.minutes, 2);
};

export const convertTimeZoneSelectionToString = (currentTimezone: TimezoneSelection) => {
  switch (currentTimezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return `GMT${getUtcOffsetString(currentTimezone)}`;
    case TimeZoneSelectionType.ZONE_NAME:
      return currentTimezone.name;
  }
};
