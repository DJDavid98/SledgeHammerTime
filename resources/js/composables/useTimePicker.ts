import { TimePickerDialAPI } from '@/Components/home/pickers/controls/TimePickerDial.vue';
import { DialMode } from '@/utils/dial';
import { AvailableLanguage } from '@/utils/language-settings';
import { pad } from '@/utils/pad';
import { toTwelveHours, toTwentyFourHours } from '@/utils/time';
import { usePage } from '@inertiajs/vue3';
import moment, { Moment } from 'moment-timezone';
import { computed, ref } from 'vue';

export const useTimePicker = () => {
  const hours = ref(0);
  const minutes = ref(0);
  const seconds = ref(0);
  const isAm = ref(false);
  const hoursInput = ref<HTMLInputElement>();
  const minutesInput = ref<HTMLInputElement>();
  const secondsInput = ref<HTMLInputElement>();
  const dial = ref<TimePickerDialAPI>();
  const renderDial = ref(false);

  const page = usePage();
  const locale = computed(() => page.props.app.locale as AvailableLanguage);
  const twelveHourMode = computed(() => {
    const longTimeFormat = moment.localeData(locale.value).longDateFormat('LT');
    return /A$/i.test(longTimeFormat);
  });

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

  const timePickerOpen = (initialValue: Moment) => {
    const initialHours = initialValue.hours();
    hours.value = twelveHourMode.value ? toTwelveHours(initialHours) : initialHours;
    minutes.value = initialValue.minutes();
    seconds.value = initialValue.seconds();
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
