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
  isLightTheme: Ref<boolean>
}>;

export const sidebarState = Symbol() as InjectionKey<{
  defaultIsOpen: Ref<boolean>,
  isOpen: Ref<boolean | null>,
  isOnLeft: Ref<boolean>,
}>;
