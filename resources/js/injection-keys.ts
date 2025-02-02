import { LanguageConfig } from '@/model/language-config';
import { TimezoneSelection } from '@/model/timezone-selection';
import { PageProps } from '@/types';
import { AvailableLanguage } from '@/utils/language-settings';
import { Moment } from 'moment-timezone';
import { ComputedRef, InjectionKey, Ref } from 'vue';

export const timestamp = Symbol() as InjectionKey<{
  currentTimestamp: ComputedRef<Moment>,
  currentDate: Readonly<Ref<string>>,
  currentTime: Readonly<Ref<string>>,
  currentTimezone: Ref<TimezoneSelection>,
  changeDateString: (value: string) => void,
  changeTimeString: (value: string) => void,
  changeDateTimeString: (value: string) => void,
  changeTimezone: (value: TimezoneSelection) => void,
  setCurrentTime: () => void,
}>;

export const theme = Symbol() as InjectionKey<{
  readonly isLightTheme: boolean
}>;

export const sidebarState = Symbol() as InjectionKey<{
  readonly isOpen: boolean | null,
  readonly setIsOpen: (value: boolean) => void;
}>;

export interface LocalSettingsValue {
  readonly customInputEnabled: boolean | null;
  readonly combinedInputsEnabled: boolean | null;
  /**
   * This value will not be flipped on RTL layouts
   */
  readonly rawSidebarOnRight: boolean | null;
  readonly sidebarOnRight: boolean | null;
  readonly sidebarOffDesktop: boolean | null;
  readonly toggleCustomInput: (e: Event & { target: HTMLInputElement }) => void;
  readonly toggleSeparateInputs: (e: Event & { target: HTMLInputElement }) => void;
  readonly toggleSidebarOnRight: VoidFunction;
  readonly toggleSidebarOffDesktop: VoidFunction;
  readonly setSidebarOffDesktop: (value: boolean) => void;
}

export const localSettings = Symbol() as InjectionKey<LocalSettingsValue>;

export const formControlId = Symbol() as InjectionKey<string>;

export const positionAnchor = Symbol() as InjectionKey<`--${string}`>;

export const pagePropsInject = Symbol() as InjectionKey<Ref<PageProps>>;

export interface CurrentLanguageData {
  locale: AvailableLanguage;
  languages: Record<string, AvailableLanguage>;
  languageConfig: LanguageConfig | undefined;
  supportedLanguages: Set<string>;
  crowdinProjectId: string;
}

export const currentLanguageInject = Symbol() as InjectionKey<Ref<CurrentLanguageData>>;
