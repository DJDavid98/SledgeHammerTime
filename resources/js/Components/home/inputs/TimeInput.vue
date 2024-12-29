<script setup lang="ts">
import TimePickerPopup, { TimePickerPopupApi } from '@/Components/home/pickers/TimePicker.vue';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { DialMode } from '@/utils/dial';
import moment from 'moment-timezone';
import { computed, inject, provide, ref, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedTime = computed(() => ts?.currentTimestamp.value.format('LTS'));
const timepicker = ref<TimePickerPopupApi>();
const inputEl = useTemplateRef<InputApi>('input-el');

const openPopup = (e: KeyboardEvent | MouseEvent) => {
  if ('key' in e && (e.key === 'Tab' || e.key === 'Shift')) {
    return;
  }

  e.preventDefault();
  if (ts) {
    const currentTsWithTimezone = moment.tz(ts.currentTimestamp.value, ts.currentTimezone.value);
    // TODO Figure out why `ts.currentTimestamp` does not have a timezone to begin with???
    console.debug('ts.currentTimestamp.value.tz()', ts.currentTimestamp.value.tz());
    timepicker.value?.open(currentTsWithTimezone, inputEl.value?.inputEl);
    window.requestAnimationFrame(() => {
      timepicker.value?.changeFocus(DialMode.Hours, true);
    });
  }
};

const changeTime = (value: string) => {
  ts?.changeTimeString(value);
};

const positionAnchorName = '--time-input';
provide(positionAnchor, positionAnchorName);
</script>


<template>
  <div>
    <HtInput
      :id="id"
      ref="input-el"
      v-model="selectedTime"
      :readonly="true"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @keydown="openPopup"
    />
    <TimePickerPopup
      ref="timepicker"
      @selected="changeTime"
    />
  </div>
</template>
