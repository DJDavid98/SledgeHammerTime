<script setup lang="ts">
import { TimePickerDialAPI } from '@/Components/home/pickers/controls/TimePickerDial.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { DialMode } from '@/utils/dial';
import { coerceToTwelveHours, getMeridiemLabel } from '@/utils/time';

const hours = defineModel<number>('hours', { required: true });
const minutes = defineModel<number>('minutes', { required: true });
const seconds = defineModel<number>('seconds', { required: true });
const isAm = defineModel<boolean>('isAm', { required: true });
const twelveHourMode = defineModel<boolean>('twelveHourMode', { required: true });
const dial = defineModel<TimePickerDialAPI | undefined>('dial', { required: true });
const hoursInput = defineModel<HTMLInputElement | null>('hoursInput');
const minutesInput = defineModel<HTMLInputElement | null>('minutesInput');
const secondsInput = defineModel<HTMLInputElement | null>('secondsInput');

const hoursFocused = () => dial.value?.setMode(DialMode.Hours);
const minutesFocused = () => dial.value?.setMode(DialMode.Minutes);
const secondsFocused = () => dial.value?.setMode(DialMode.Seconds);

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
</script>

<template>
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
</template>
