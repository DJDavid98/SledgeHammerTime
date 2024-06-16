import { DayOfWeek } from '@/utils/calendar';
import { TranslationCredit } from './translation-credit';

export type WeekendDays = Partial<Record<DayOfWeek, string>>;

export interface LanguageConfig {
  /**
   * Language name in English
   */
  name: string;
  /**
   * Native name key from the `laravel-lang/native-locale-names` package
   */
  nativeNameKey?: string;
  countryCode: string;
  emoji?: string;
  customFlag?: boolean;
  rtl?: boolean;
  momentLocale?: string;
  crowdinLocale?: string;
  percent?: number;
  calendarLabelFormat?: string;
  calendarYearLabelFormat?: string;
  calendarWeekdayFormat?: string;
  weekendDays: WeekendDays;
  firstDayOfWeek?: DayOfWeek;
  credits?: TranslationCredit[];
}
