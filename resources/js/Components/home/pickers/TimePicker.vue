<script setup lang="ts">
import Popup from '@/Components/CustomPopup.vue';
import TimePickerDial, { TimePickerDialAPI } from '@/Components/home/pickers/TimePickerDial.vue';
import { DialMode } from '@/utils/dial';
import { AvailableLanguage } from '@/utils/language-settings';
import { pad } from '@/utils/pad';
import { toTwelveHours, toTwentyFourHours } from '@/utils/timezone';
import { usePage } from '@inertiajs/vue3';
import moment from 'moment';
import { Moment } from 'moment-timezone';
import { computed, onUpdated, ref } from 'vue';

const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);
const isAm = ref(false);
const focusFirstInput = ref(false);
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

defineProps<{
  show: boolean;
}>();

const emit = defineEmits<{
  (e: 'selected', time: string): void
  (e: 'close'): void
  (e: 'open'): void
}>();

const openPicker = () => {
  renderDial.value = true;
  emit('open');
};
const closePicker = () => {
  renderDial.value = false;
  emit('close');
};

const select = () => {
  const actualHours = twelveHourMode.value ? toTwentyFourHours(hours.value, isAm.value) : hours.value;
  const formattedTime = [actualHours, minutes.value, seconds.value].map(n => pad(n, 2)).join(':');
  emit('selected', formattedTime); // Emit the selected date back to the MainDatepicker
  closePicker();
};
const open = (initialValue: Moment) => {
  const initialHours = initialValue.hours();
  hours.value = twelveHourMode.value ? toTwelveHours(initialHours) : initialHours;
  minutes.value = initialValue.minutes();
  seconds.value = initialValue.seconds();
  isAm.value = initialHours < 12;
  focusFirstInput.value = true;
};

const hoursFocused = () => dial.value?.setMode(DialMode.Hours);
const minutesFocused = () => dial.value?.setMode(DialMode.Minutes);
const secondsFocused = () => dial.value?.setMode(DialMode.Seconds);

const setHours = (value: number) => {
  hours.value = value;
};
const setMinutes = (value: number) => {
  minutes.value = value;
};
const setSeconds = (value: number) => {
  seconds.value = value;
};
const changeFocus = (mode: DialMode) => {
  switch (mode) {
    case DialMode.Hours:
      hoursInput.value?.focus();
      break;
    case DialMode.Minutes:
      minutesInput.value?.focus();
      break;
    case DialMode.Seconds:
      secondsInput.value?.focus();
      break;
  }
};

const handleHoursBlur = () => {
  if (!twelveHourMode.value) return;

  if (hours.value > 12) {
    const newValue = hours.value - 12;
    hours.value = Math.max(newValue, 1);
    isAm.value = false;
  } else if (hours.value < 1) {
    const newValue = 12;
    hours.value = 12;
    isAm.value = true;
  }
};

const handleAmPmSelectKeydown = (e: KeyboardEvent) => {
  switch (e.key.toLowerCase()) {
    case 'a':
      isAm.value = true;
      break;
    case 'p':
      isAm.value = false;
      break;
  }
};

export interface TimePickerPopupApi {
  open: typeof open;
}

defineExpose<TimePickerPopupApi>({
  open,
});

onUpdated(() => {
  if (focusFirstInput.value) {
    changeFocus(DialMode.Hours);
    focusFirstInput.value = false;
  }
});
</script>


<template>
  <Popup
    :show="show"
    @close="closePicker"
    @open="openPicker"
  >
    <fieldset role="group">
      <input
        ref="hoursInput"
        v-model="hours"
        type="number"
        min="0"
        max="23"
        @focus="hoursFocused"
        @blur="handleHoursBlur"
      >
      <input
        ref="minutesInput"
        v-model="minutes"
        type="number"
        min="0"
        max="59"
        @focus="minutesFocused"
      >
      <input
        ref="secondsInput"
        v-model="seconds"
        type="number"
        min="0"
        max="59"
        @focus="secondsFocused"
      >
      <select
        v-if="twelveHourMode"
        v-model="isAm"
        @keydown="handleAmPmSelectKeydown"
      >
        <option :value="true">
          {{ moment.localeData().meridiem(10, minutes, false) }}
        </option>
        <option :value="false">
          {{ moment.localeData().meridiem(22, minutes, false) }}
        </option>
      </select>
    </fieldset>
    <div class="grid">
      <button
        class="mb-0"
        @click="select"
      >
        {{ $t('global.form.select') }}
      </button>
      <button
        class="mb-0 secondary"
        @click="closePicker"
      >
        {{ $t('global.form.cancel') }}
      </button>
    </div>
    <TimePickerDial
      v-if="renderDial"
      ref="dial"
      :hours="hours"
      :minutes="minutes"
      :seconds="seconds"
      :twelve-hour-mode="twelveHourMode"
      @set-hours="setHours"
      @set-minutes="setMinutes"
      @set-seconds="setSeconds"
      @change-focus="changeFocus"
    />
  </Popup>
</template>
