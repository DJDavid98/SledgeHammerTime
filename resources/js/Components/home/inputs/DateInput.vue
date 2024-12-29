<script setup lang="ts">
import DatePicker, { DatePickerApi } from '@/Components/home/pickers/DatePicker.vue';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { computed, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedDate = computed(() => ts?.currentTimestamp.value.format('LL'));
const datepicker = useTemplateRef<DatePickerApi>('date-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

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
    datepicker.value?.open(ts.currentTimestamp.value, viaKeyboard ? inputEl.value?.inputEl : null);
    window.requestAnimationFrame(() => {
      datepicker.value?.changeFocus('year', true);
    });
  }
};

const changeDate = (value: string) => {
  ts?.changeDateString(value);
};

const positionAnchorName = '--date-input';
provide(positionAnchor, positionAnchorName);
</script>

<template>
  <div>
    <HtInput
      :id="id"
      ref="input-el"
      v-model="selectedDate"
      :readonly="true"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @keydown="openPopup"
    />
    <DatePicker
      ref="date-picker"
      @selected="changeDate"
    />
  </div>
</template>
