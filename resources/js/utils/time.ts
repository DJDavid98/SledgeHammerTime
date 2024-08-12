import { Moment } from 'moment';
import moment from 'moment-timezone';

export const isoTimeFormat = 'HH:mm:ss';
export const isoFormattingDateFormat = 'YYYY-MM-DD';
export const isoParsingDateFormat = 'Y-MM-DD';

export const gmtZoneRegex = /^Etc\/(GMT([+-]\d+)?)$/;

const formatGmtZoneLabel = (offset = '') => `GMT${offset} (UTC${offset})`;

export const transformGmtZoneName = (value: string): string =>
  value.replace(gmtZoneRegex, (_, extractedIdentifier: string) =>
    // eslint-disable-next-line @typescript-eslint/naming-convention
    extractedIdentifier.replace(/^GMT(?:([+-])(\d+))?$/, (__, sign: string, offset: string) => {
      const newSign = sign ? (sign === '+' ? '-' : '+') : '';
      return formatGmtZoneLabel(`${newSign}${offset ?? ''}`);
    }),
  );

const compareGmtStrings = (a: string, b: string) =>
  parseInt(a.replace(gmtZoneRegex, '$2'), 10) - parseInt(b.replace(gmtZoneRegex, '$2'), 10);

export const getSortedNormalizedTimezoneNames = (): string[] =>
  moment.tz
    .names()
    .filter((name) => !/^(?:Etc\/)?GMT[+-]?0$/.test(name) && name !== 'GMT')
    .sort((a, b) => {
      const isAGmt = gmtZoneRegex.test(a);
      const isBGmt = gmtZoneRegex.test(b);
      if (isAGmt) return isBGmt ? compareGmtStrings(a, b) : -1;
      if (isBGmt) return isAGmt ? compareGmtStrings(a, b) : 1;
      return a.localeCompare(b);
    });

export const getTimezoneLabel = (timezone: string): string => {
  if (!gmtZoneRegex.test(timezone)) return timezone;
  return transformGmtZoneName(timezone);
};

export const getTimezoneValue = (timezone: string) => ({
  value: timezone,
  label: getTimezoneLabel(timezone),
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
    console.warn(`Number between ${min} and ${max} is expected, got ${value}`);
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

export const getDefaultInitialDate = (): Date => {
  const value = new Date();
  value.setSeconds(0);
  return value;
};

export const getDefaultInitialTimezone = (): string => {
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
