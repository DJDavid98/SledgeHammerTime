import {
  TimezoneSelection,
  TimezoneSelectionByOffset,
  TimeZoneSelectionType,
} from '@/model/timezone-selection';
import { pad } from '@/utils/pad';
import moment, { Moment } from 'moment-timezone';

export const isoTimeFormat = 'HH:mm:ss';
export const isoFormattingDateFormat = 'YYYY-MM-DD';
export const isoParsingDateFormat = 'Y-MM-DD';

export const gmtZoneRegex = /^Etc\/(GMT([+-]\d+)?)$/;
export const offsetZoneRegex = /^(?:Etc\/)?(?:GMT|UTC)\+?(-?\d{1,2})(?::?(\d{2}))?$/i;

const formatGmtZoneLabel = (offset = '') => `GMT${offset} (UTC${offset})`;

export const transformGmtZoneName = (value: string): string =>
  value.replace(gmtZoneRegex, (_, extractedIdentifier: string) =>
    // eslint-disable-next-line @typescript-eslint/naming-convention
    extractedIdentifier.replace(/^GMT(?:([+-])(\d+))?$/, (__, sign: string, offset: string) => {
      const newSign = sign ? (sign === '+' ? '-' : '+') : '';
      return formatGmtZoneLabel(`${newSign}${offset ?? ''}`);
    }),
  );

export const getSortedNormalizedTimezoneNames = (): string[] =>
  moment.tz
    .names()
    .filter((name) => !name.startsWith('Etc/GMT'))
    .sort((a, b) => a.localeCompare(b));

export const getTimezoneValue = (timezone: string) => ({
  value: timezone,
  label: timezone,
});

export const momentToTimeInputValue = (time: Moment = moment(), format = `${isoFormattingDateFormat}\\T${isoTimeFormat}`): string =>
  // Force English locale so values are always in the expected format
  time.clone().locale('en').format(format);

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

export const getMeridiemLabel = (isAm: boolean, minutes = 0) => moment.localeData().meridiem(isAm ? 10 : 22, minutes, false);

export const getInitialMoment = (timezone: TimezoneSelection, defaultTs?: number): Moment => {
  const hasDefaultTs = typeof defaultTs === 'number';
  const value = hasDefaultTs
    ? moment.tz(new Date(defaultTs * 1e3), 'UTC')
    : moment();
  switch (timezone.type) {
    case TimeZoneSelectionType.OFFSET:
      value.utcOffset(getUtcOffsetString(timezone));
      break;
    case TimeZoneSelectionType.ZONE_NAME:
      value.tz(timezone.name);
      break;
  }
  return value;
};
export const getCurrentTimestampMoment = (inputString: string, formatString: string, timezone: TimezoneSelection): Moment => {
  switch (timezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return moment.tz(inputString, formatString, 'UTC').utcOffset(convertTimeZoneSelectionToString(timezone));
    case TimeZoneSelectionType.ZONE_NAME:
      return moment.tz(inputString, formatString, timezone.name);
  }
};

export const getDefaultInitialMoment = (defaultTs: number | undefined, timezone: TimezoneSelection): Moment => {
  const hasDefaultTs = typeof defaultTs === 'number';
  const value = getInitialMoment(timezone, defaultTs);
  if (!hasDefaultTs) {
    value.seconds(0);
  }
  return value;
};

export const guessInitialTimezoneName = (): string => {
  try {
    const intlTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    // Check if we have the zone data loaded in moment.js
    if (moment.tz.zone(intlTimezone) !== null) {
      return intlTimezone;
    }
  } catch (e) {
    console.error(e);
  }
  return moment.tz.guess();
};

export const getDefaultInitialTimezone = (defaultTimezoneProp?: string): TimezoneSelection => {
  if (defaultTimezoneProp) {
    const offsetZoneMatch = defaultTimezoneProp.match(offsetZoneRegex);
    if (offsetZoneMatch !== null) {
      const hours = rangeLimit(parseInt(offsetZoneMatch[1], 10), -14, 14);
      const minutes = rangeLimit(parseInt(offsetZoneMatch[2], 10), 0, 59);
      if (!isNaN(hours)) {
        return {
          type: TimeZoneSelectionType.OFFSET,
          // Handle negative zero case consistently
          hours: hours === 0 ? 0 : hours,
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

export const createCurrentTsWithTimezone = (currentTimestamp: Moment, currentTimezone: TimezoneSelection) => {
  switch (currentTimezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return moment(currentTimestamp).utcOffset(getUtcOffsetString(currentTimezone));
    case TimeZoneSelectionType.ZONE_NAME:
      // TODO Figure out why `ts.currentTimestamp` does not have a timezone to begin with???
      console.debug('currentTimestamp.value.tz()', currentTimestamp.tz());
      return moment.tz(currentTimestamp, currentTimezone.name);
  }
};

export const convertTimeZoneSelectionToString = (currentTimezone: TimezoneSelection) => {
  switch (currentTimezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return `GMT${getUtcOffsetString(currentTimezone)}`;
    case TimeZoneSelectionType.ZONE_NAME:
      return currentTimezone.name;
  }
};
