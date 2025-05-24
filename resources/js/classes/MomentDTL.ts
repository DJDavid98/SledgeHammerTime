import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryLocale, WeekInfo } from '@/classes/DateTimeLibraryLocale';
import { DateTimeLibraryValue, DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { LanguageConfig } from '@/model/language-config';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { momentLocaleMap } from '@/moment';
import { AvailableLanguage, FALLBACK_LANGUAGE, LANGUAGES } from '@/utils/language-settings';
import { getUtcOffsetString, offsetZoneRegex, rangeLimit } from '@/utils/time';
import moment, { Moment } from 'moment-timezone';

const isoTimeFormat = 'HH:mm:ss';
const isoFormattingDateFormat = 'YYYY-MM-DD';
const isoParsingDateFormat = 'Y-MM-DD';
const isoFormat = `${isoParsingDateFormat} ${isoTimeFormat}`;
const urlFormat = `YYYYMMDD.HHmmss`;
const calendarDateDisplayFormat = 'D';
const calendarContextFormat = 'MMMM YYYY';
const defaultDate = '1970-01-01';
const defaultTime = '00:00:00';

const discordFormatMap: Record<MessageTimestampFormat, string> = {
  [MessageTimestampFormat.SHORT_DATE]: 'L',
  [MessageTimestampFormat.LONG_DATE]: 'LL',
  [MessageTimestampFormat.SHORT_TIME]: 'LT',
  [MessageTimestampFormat.LONG_TIME]: 'LTS',
  [MessageTimestampFormat.SHORT_FULL]: 'LLL',
  [MessageTimestampFormat.LONG_FULL]: 'LLLL',
  [MessageTimestampFormat.RELATIVE]: '',
};

class MomentDTLValue extends DateTimeLibraryValue<Moment> {
  toString(): string {
    return `[object MomentDTLValue(${this.toISOString()})}]`;
  }

  setLocale(locale: string) {
    return new MomentDTLValue(this.value, locale);
  }

  getLocale() {
    if (this._locale == null) {
      throw new Error('locale is needed but not set');
    }
    return this._locale;
  }

  local() {
    return new MomentDTLValue(this.value.local());
  }

  fromNow() {
    return this.value.locale(this.getLocale()).fromNow();
  }

  addDays(days: number) {
    return new MomentDTLValue(moment(this.value).add(days, 'days'));
  }

  addYears(years: number) {
    return new MomentDTLValue(moment(this.value).add(years, 'years'));
  }

  toDate() {
    return this.value.toDate();
  }

  formatDiscordTimestamp(format: MessageTimestampFormat) {
    return this.value.format(discordFormatMap[format]);
  }

  toISOString() {
    return this.value.toISOString();
  }

  toISODateString() {
    return this.value.format(isoFormattingDateFormat);
  }

  getWeekday() {
    return this.mapDefaultWeekday(this.value.day());
  }

  getMonth() {
    return this.mapDefaultMonth(this.value.month());
  }

  getFullYear() {
    return this.value.year();
  }

  getHours() {
    return this.value.hours();
  }

  getMinutes() {
    return this.value.minutes();
  }

  getSeconds() {
    return this.value.seconds();
  }

  getUnixSeconds() {
    return this.value.unix();
  }

  getUtcOffsetMinutes() {
    return this.value.utcOffset();
  }

  getDayOfMonth() {
    return this.value.date();
  }

  formatCalendarDateDisplay() {
    return this.value.format(calendarDateDisplayFormat);
  }

  formatCalendarContext() {
    return this.value.format(calendarContextFormat);
  }

  formatHoursDisplay() {
    return this.value.format('H');
  }

  formatMinutesDisplay() {
    return this.value.format('m');
  }

  formatSecondsDisplay() {
    return this.value.format('s');
  }

  daysInMonth() {
    return this.value.daysInMonth();
  }

  replaceZone(zone: TimezoneSelection) {
    switch (zone.type) {
      case TimeZoneSelectionType.OFFSET:
        return new MomentDTLValue(moment.utc(this.value).utcOffset(getUtcOffsetString(zone)));
      case TimeZoneSelectionType.ZONE_NAME:
        return new MomentDTLValue(moment.tz(this.value, zone.name));
    }
  }

  setHours(hours: number) {
    this.value.hours(hours);
    return this;
  }

  setMinutes(minutes: number) {
    this.value.minutes(minutes);
    return this;
  }

  setSeconds(seconds: number) {
    this.value.seconds(seconds);
    return this;
  }
}

const timezoneNames = moment.tz
  .names()
  .filter((name) => !name.startsWith('Etc/GMT'))
  .sort((a, b) => a.localeCompare(b));

export class MomentDTL implements DateTimeLibrary<Moment, moment.Locale> {
  readonly isoTimeFormat = isoTimeFormat;
  readonly isoFormattingDateFormat = isoFormattingDateFormat;
  readonly isoParsingDateFormat = isoParsingDateFormat;
  readonly isoFormat = isoFormat;
  readonly urlFormat = urlFormat;
  readonly timezoneNames = timezoneNames;

  getLocaleNameFromLanguage(language: AvailableLanguage): string {
    const languageConfig = LANGUAGES[language];
    return this.getLocaleNameFromLanguageConfig(language, languageConfig);
  }

  getLocaleNameFromLanguageConfig(language: AvailableLanguage | undefined, languageConfig: LanguageConfig | undefined): string {
    return languageConfig?.momentLocale ?? language ?? FALLBACK_LANGUAGE;
  }

  async loadLocaleLowLevel(locale: string): Promise<moment.Locale | undefined> {
    if (!(locale in momentLocaleMap)) {
      console.warn(`No moment locale loader found by key ${locale}`);
      return;
    }
    await momentLocaleMap[locale as keyof typeof momentLocaleMap]();
    return moment.localeData(locale);
  }

  async localeLoader(localeName: string): Promise<DateTimeLibraryLocale> {
    await this.loadLocaleLowLevel(localeName);

    return {
      name: localeName,
      getShortWeekdays() {
        return moment.localeData(localeName).weekdaysShort();
      },
      getHourCycleInfo() {
        const longTimeFormat = moment.localeData(localeName).longDateFormat('LT');
        return {
          hourCycle: /A$/i.test(longTimeFormat) ? 'h12' : 'h24',
        };
      },
      getWeekInfo(): WeekInfo {
        return {
          firstDay: moment.localeData(localeName).firstDayOfWeek() as DateTimeLibraryWeekday,
          weekend: [],
        };
      },
    };
  }

  guessInitialTimezoneName(): string {
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
  }

  getDefaultInitialTimezoneSelection(hint?: string): TimezoneSelection {
    if (hint) {
      const offsetZoneMatch = hint.match(offsetZoneRegex);
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
        return { type: TimeZoneSelectionType.ZONE_NAME, name: hint };
      }
    }
    return { type: TimeZoneSelectionType.ZONE_NAME, name: this.guessInitialTimezoneName() };
  }

  getDefaultInitialDateTime(timezone: TimezoneSelection, defaultDateTime: string | undefined | null): [string, string] {
    const hasDefaultTs = typeof defaultDateTime === 'string';
    return this.getInitialDateTime(timezone, defaultDateTime, !hasDefaultTs);
  }

  getInitialDateTime(timezone: TimezoneSelection, defaultDateTime?: string | null, zeroSeconds?: boolean): [string, string] {
    if (typeof defaultDateTime === 'string') {
      const parseResult = moment(defaultDateTime, urlFormat);
      if (zeroSeconds) {
        parseResult.seconds(0);
      }
      const dateString = parseResult.format(isoFormattingDateFormat);
      const timeString = parseResult.format(isoTimeFormat);
      return [dateString, timeString];
    }
    let localMoment: Moment;
    switch (timezone.type) {
      case TimeZoneSelectionType.OFFSET:
        localMoment = moment.utc().utcOffset(getUtcOffsetString(timezone));
        break;
      case TimeZoneSelectionType.ZONE_NAME:
        localMoment = moment.tz(timezone.name);
        break;
    }
    if (zeroSeconds) {
      localMoment.seconds(0);
    }
    const [dateString, timeString] = localMoment.format(isoFormat).split(/[T ]/);
    return [dateString, timeString];
  }

  getMeridiemLabel(isAm: boolean, minutes = 0, locale?: string): string {
    return moment.localeData(locale).meridiem(isAm ? 10 : 22, minutes, false);
  }

  now(): DateTimeLibraryValue<Moment> {
    return new MomentDTLValue(moment());
  }

  convertIsoToLocalizedDateTimeInputValue(date: string, time: string, locale: string): string {
    return moment(`${date} ${time}`, isoFormat).locale(locale).format('LLL');
  }

  convertIsoToLocalizedDateInputValue(date: string, locale: string): string {
    return moment(date, isoParsingDateFormat).locale(locale).format('LL');
  }

  convertIsoToLocalizedTimeInputValue(time: string, locale: string): string {
    return moment(time, isoTimeFormat).locale(locale).format('LTS');
  }

  getValueForIsoZonedDate(date: string, timezone: TimezoneSelection): DateTimeLibraryValue<Moment> {
    return this.getValueForIsoZonedDateTime(date, defaultTime, timezone);
  }

  getValueForIsoZonedTime(time: string, timezone: TimezoneSelection): DateTimeLibraryValue<Moment> {
    return this.getValueForIsoZonedDateTime(defaultDate, time, timezone);
  }

  getValueForIsoZonedDateTime(date: string, time: string, timezone: TimezoneSelection): DateTimeLibraryValue<Moment> {
    const inputString = `${date} ${time}`;
    switch (timezone.type) {
      case TimeZoneSelectionType.OFFSET:
        return new MomentDTLValue(moment.utc(inputString, isoFormat).utcOffset(getUtcOffsetString(timezone), true));
      case TimeZoneSelectionType.ZONE_NAME:
        return new MomentDTLValue(moment.tz(inputString, isoFormat, timezone.name));
    }
  }

  getValueForDate(year: number, month: number, date: number): DateTimeLibraryValue<Moment> {
    return new MomentDTLValue(moment({
      year,
      month,
      date,
      hour: 0,
      minute: 0,
      second: 0,
      milliseconds: 0,
    }));
  }

  fromIsoString(iso: string): DateTimeLibraryValue<Moment> {
    return new MomentDTLValue(moment(iso));
  }

  fromTimestampMsUtc(timestamp: number): DateTimeLibraryValue<Moment> {
    return new MomentDTLValue(moment.utc(timestamp));
  }
}
