<script setup lang="ts">
import TimeZonePicker, { TimeZonePickerApi } from '@/Components/home/pickers/TimeZonePicker.vue';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import { TimezoneSelection } from '@/model/timezone-selection';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { convertTimeZoneSelectionToString } from '@/utils/time';
import { computed, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const timezonepicker = useTemplateRef<TimeZonePickerApi>('timezone-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

const changeTimezone = (value: TimezoneSelection) => {
  ts?.changeTimezone(value);
};

const inputValue = computed(() => ts ? convertTimeZoneSelectionToString(ts.currentTimezone.value) : '');

const openPopup = (e: KeyboardEvent | MouseEvent) => {
  let viaKeyboard = false;
  if ('key' in e) {
    if (e.key === 'Tab' || e.key === 'Shift') {
      return;
    }
    viaKeyboard = true;
  }

  e.preventDefault();
  if (ts) {
    timezonepicker.value?.open(ts.currentTimezone.value, viaKeyboard ? inputEl.value : null);
  }
};

const positionAnchorName = '--timezone-input';
provide(positionAnchor, positionAnchorName);
</script>

<template>
  <div>
    <HtInput
      :id="id"
      ref="input-el"
      v-model="inputValue"
      :readonly="true"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @keydown="openPopup"
    />
    <TimeZonePicker
      ref="timezone-picker"
      @change="changeTimezone"
    />
  </div>
</template>
