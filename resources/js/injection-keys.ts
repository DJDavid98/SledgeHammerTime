import { Moment } from 'moment-timezone';
import { ComputedRef, InjectionKey, Ref } from 'vue';

export const timestamp = Symbol() as InjectionKey<{
  currentTimestamp: ComputedRef<Moment>,
  currentTimezone: Ref<string>,
  changeDateString: (value: string) => void,
  changeTimeString: (value: string) => void,
  changeTimezone: (value: string) => void,
  setCurrentTime: () => void,
}>;

export const theme = Symbol() as InjectionKey<{
  readonly isLightTheme: boolean
}>;

export const sidebarState = Symbol() as InjectionKey<{
  readonly isOpen: boolean | null,
  readonly isOnLeft: boolean,
  readonly setIsOpen: (value: boolean) => void;
  readonly setIsOnLeft: (value: boolean) => void;
}>;
