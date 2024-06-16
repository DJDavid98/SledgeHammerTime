<script setup lang="ts">
import Popup from '@/Components/CustomPopup.vue';
import TimePickerDial, { TimePickerDialAPI } from '@/Components/home/popup/TimePickerDial.vue';
import { DialMode } from '@/utils/dial';
import { pad } from '@/utils/pad';
import { Moment } from 'moment-timezone';
import { onUpdated, ref } from 'vue';

const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);
const focusFirstInput = ref(false);
const hoursInput = ref<HTMLInputElement>();
const minutesInput = ref<HTMLInputElement>();
const secondsInput = ref<HTMLInputElement>();
const dial = ref<TimePickerDialAPI>();

defineProps<{
  show: boolean;
}>();

const emit = defineEmits<{
  (e: 'selected', time: string): void
  (e: 'close'): void
}>();

const close = () => {
  emit('close');
};

const select = () => {
  const formattedTime = [hours.value, minutes.value, seconds.value].map(n => pad(n, 2)).join(':');
  emit('selected', formattedTime); // Emit the selected date back to the MainDatepicker
  close();
};
const open = (initialValue: Moment) => {
  hours.value = initialValue.hours();
  minutes.value = initialValue.minutes();
  seconds.value = initialValue.seconds();
  // TODO 12h clock AM/PM selector
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
    @close="close"
  >
    <div class="grid">
      <input
        ref="hoursInput"
        v-model="hours"
        type="number"
        min="0"
        max="23"
        @focus="hoursFocused"
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
    </div>
    <div class="grid">
      <button
        class="mb-0"
        @click="select"
      >
        {{ $t('global.form.select') }}
      </button>
      <button
        class="mb-0 secondary"
        @click="close"
      >
        {{ $t('global.form.cancel') }}
      </button>
    </div>
    <TimePickerDial
      v-if="show"
      ref="dial"
      :hours="hours"
      :minutes="minutes"
      :seconds="seconds"
      @set-hours="setHours"
      @set-minutes="setMinutes"
      @set-seconds="setSeconds"
      @change-focus="changeFocus"
    />
  </Popup>
</template>
