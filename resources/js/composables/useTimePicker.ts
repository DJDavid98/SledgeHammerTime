import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { TimePickerDialAPI } from '@/Components/home/pickers/controls/TimePickerDial.vue';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { DialMode } from '@/utils/dial';
import { pad } from '@/utils/pad';
import { toTwelveHours, toTwentyFourHours } from '@/utils/time';
import { computed, ComputedRef, DeepReadonly, getCurrentInstance, ref } from 'vue';

export const useTimePicker = (dtl: DeepReadonly<ComputedRef<DateTimeLibrary>> | undefined) => {
  const hours = ref(0);
  const minutes = ref(0);
  const seconds = ref(0);
  const isAm = ref(false);
  const hoursInput = ref<HTMLInputElement>();
  const minutesInput = ref<HTMLInputElement>();
  const secondsInput = ref<HTMLInputElement>();
  const dial = ref<TimePickerDialAPI>();
  const renderDial = ref(false);

  const instance = getCurrentInstance();
  const dateLibLocale = useDateLibraryLocale(dtl, instance);
  const twelveHourMode = computed(() => dateLibLocale.value?.getHourCycleInfo().hourCycle === 'h12');

  const setHours = (value: number, isAmValue?: boolean) => {
    hours.value = value;
    if (isAmValue !== undefined) {
      isAm.value = isAmValue;
    }
  };
  const setMinutes = (value: number) => {
    minutes.value = value;
  };
  const setSeconds = (value: number) => {
    seconds.value = value;
  };

  const changeTimeFocus = (mode: DialMode, setSelection: boolean = false) => {
    switch (mode) {
      case DialMode.Hours:
        hoursInput.value?.focus();
        if (setSelection) {
          hoursInput.value?.select();
        }
        break;
      case DialMode.Minutes:
        minutesInput.value?.focus();
        if (setSelection) {
          minutesInput.value?.select();
        }
        break;
      case DialMode.Seconds:
        secondsInput.value?.focus();
        if (setSelection) {
          secondsInput.value?.select();
        }
        break;
    }
  };

  const timePickerOpen = (initialValue: DateTimeLibraryValue) => {
    const initialHours = initialValue.getHours();
    hours.value = twelveHourMode.value ? toTwelveHours(initialHours) : initialHours;
    minutes.value = initialValue.getMinutes();
    seconds.value = initialValue.getSeconds();
    isAm.value = initialHours < 12;
  };

  const getSelectedTime = (): string => {
    const actualHours = twelveHourMode.value ? toTwentyFourHours(hours.value, isAm.value) : hours.value;
    return [actualHours, minutes.value, seconds.value].map(n => pad(n, 2)).join(':');
  };

  const openTimePicker = () => {
    renderDial.value = true;
  };
  const closeTimePicker = () => {
    renderDial.value = false;
  };

  return {
    hours,
    minutes,
    seconds,
    isAm,
    dial,
    renderDial,
    twelveHourMode,
    hoursInput,
    minutesInput,
    secondsInput,
    setHours,
    setMinutes,
    setSeconds,
    changeTimeFocus,
    timePickerOpen,
    getSelectedTime,
    openTimePicker,
    closeTimePicker,
  };
};
