<script setup lang="ts">
import Popup, { CustomPopupApi, Focusable } from '@/Components/CustomPopup.vue';
import TimePickerDial, { TimePickerDialAPI } from '@/Components/home/pickers/TimePickerDial.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { DialMode } from '@/utils/dial';
import { AvailableLanguage } from '@/utils/language-settings';
import { pad } from '@/utils/pad';
import {
  coerceToTwelveHours,
  getMeridiemLabel,
  limitHours,
  limitMinutesSeconds,
  limitToTwelveHours,
  toTwelveHours,
  toTwentyFourHours,
} from '@/utils/time';
import { usePage } from '@inertiajs/vue3';
import moment, { Moment } from 'moment-timezone';
import { computed, ref, useTemplateRef } from 'vue';

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

const emit = defineEmits<{
  (e: 'selected', time: string): void
}>();

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const formRef = useTemplateRef<HTMLFormElement>('form-el');

const openPicker = () => {
  renderDial.value = true;
};
const closePicker = () => {
  renderDial.value = false;
};

const selectAndClose = () => {
  const focusedEl = formRef.value?.querySelector<HTMLElement>(':focus');
  if (focusedEl) {
    focusedEl.blur();
  }
  const actualHours = twelveHourMode.value ? toTwentyFourHours(hours.value, isAm.value) : hours.value;
  const formattedTime = [actualHours, minutes.value, seconds.value].map(n => pad(n, 2)).join(':');
  emit('selected', formattedTime); // Emit the selected date back to the MainDatepicker
  close();
};
const open = (initialValue: Moment, focusOnClose?: Focusable | null) => {
  const initialHours = initialValue.hours();
  hours.value = twelveHourMode.value ? toTwelveHours(initialHours) : initialHours;
  minutes.value = initialValue.minutes();
  seconds.value = initialValue.seconds();
  isAm.value = initialHours < 12;
  popupRef.value?.open(focusOnClose);
};
const close = () => {
  popupRef.value?.close();
};

const hoursFocused = () => dial.value?.setMode(DialMode.Hours);
const minutesFocused = () => dial.value?.setMode(DialMode.Minutes);
const secondsFocused = () => dial.value?.setMode(DialMode.Seconds);

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
const changeFocus = (mode: DialMode, setSelection: boolean = false) => {
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

/** Not for use in the template */
const _handleTwentyFourHoursBlur = inputRangeLimitBlurHandlerFactory(hours);
const handleHoursBlur = (e: FocusEvent) => {
  if (!twelveHourMode.value) {
    _handleTwentyFourHoursBlur(e);
    return;
  }

  const result = coerceToTwelveHours(hours.value);
  if (!result) return;

  hours.value = result.hours;
  isAm.value = result.isAm;
};

const handleMinutesBlur = inputRangeLimitBlurHandlerFactory(minutes);
const handleSecondsBlur = inputRangeLimitBlurHandlerFactory(seconds);

const handleAmPmSelectKeydown = (e: KeyboardEvent) => {
  switch (e.key.toLowerCase()) {
    case 'a':
      isAm.value = true;
      break;
    case 'p':
      isAm.value = false;
      break;
    case 'arrowup':
    case 'arrowdown':
      isAm.value = !isAm.value;
      break;
  }
};

export interface TimePickerPopupApi {
  open: typeof open;
  changeFocus: typeof changeFocus,
}

defineExpose<TimePickerPopupApi>({
  open,
  changeFocus,
});
</script>


<template>
  <Popup
    ref="popup-el"
    @close="closePicker"
    @open="openPicker"
  >
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <HtFormInputGroup dir="ltr">
        <HtInput
          ref="hoursInput"
          v-model="hours"
          type="number"
          min="0"
          max="23"
          @focus.passive="hoursFocused"
          @blur.passive="handleHoursBlur"
        />
        <HtInput
          ref="minutesInput"
          v-model="minutes"
          type="number"
          min="0"
          max="59"
          @focus.passive="minutesFocused"
          @blur.passive="handleMinutesBlur"
        />
        <HtInput
          ref="secondsInput"
          v-model="seconds"
          type="number"
          min="0"
          max="59"
          @focus.passive="secondsFocused"
          @blur.passive="handleSecondsBlur"
        />
        <HtFormSelect
          v-if="twelveHourMode"
          v-model="isAm"
          @keydown="handleAmPmSelectKeydown"
        >
          <option :value="true">
            {{ getMeridiemLabel(true, minutes) }}
          </option>
          <option :value="false">
            {{ getMeridiemLabel(false, minutes) }}
          </option>
        </HtFormSelect>
      </HtFormInputGroup>
      <HtButtonGroup>
        <HtButton
          color="primary"
          :justify-center="true"
          type="submit"
        >
          {{ $t('actions.select') }}
        </HtButton>
        <HtButton
          :justify-center="true"
          @click="close"
        >
          {{ $t('actions.cancel') }}
        </HtButton>
      </HtButtonGroup>
    </form>
    <TimePickerDial
      v-if="renderDial"
      ref="dial"
      :hours="twelveHourMode ? limitToTwelveHours(hours) : limitHours(hours)"
      :minutes="limitMinutesSeconds(minutes)"
      :seconds="limitMinutesSeconds(seconds)"
      :is-am="isAm"
      :twelve-hour-mode="twelveHourMode"
      @set-hours="setHours"
      @set-minutes="setMinutes"
      @set-seconds="setSeconds"
      @change-focus="changeFocus"
      @select="selectAndClose"
    />
  </Popup>
</template>
