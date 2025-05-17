type WeekdayNumber = 1 | 2 | 3 | 4 | 5 | 6 | 7;
type IntlLocaleParams = ConstructorParameters<typeof Intl.Locale>;

export interface WithFallbackIndicator {
  fallback?: true;
}

/**
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/Locale/getWeekInfo
 */
export interface WeekInfo extends WithFallbackIndicator {
  firstDay: WeekdayNumber;
  weekend: WeekdayNumber[];
  minimalDays: WeekdayNumber;
}

export interface HourCycleInfo extends WithFallbackIndicator {
  hourCycle: Intl.LocaleOptions['hourCycle'];
}

export class SafeIntlLocale {
  protected internalValue: Intl.Locale;

  constructor(tag: IntlLocaleParams[0], options?: IntlLocaleParams[1]) {
    this.internalValue = new Intl.Locale((tag as string).replace('_', '-'), options);
  }

  getWeekInfo(): WeekInfo {
    if ('getWeekInfo' in this.internalValue && typeof this.internalValue.getWeekInfo === 'function') {
      return this.internalValue.getWeekInfo() as WeekInfo;
    }

    return {
      fallback: true,
      firstDay: 1,
      weekend: [6, 7],
      minimalDays: 1,
    };
  }

  getHourCycle(): HourCycleInfo {
    if ('hourCycle' in this.internalValue) {
      return {
        hourCycle: this.internalValue.hourCycle,
      };
    }

    return {
      fallback: true,
      hourCycle: 'h24',
    };
  }
}
