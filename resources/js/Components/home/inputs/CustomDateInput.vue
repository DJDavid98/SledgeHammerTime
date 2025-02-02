<script setup lang="ts">
import DatePicker, { DatePickerApi } from '@/Components/home/pickers/DatePicker.vue';
import { useMomentLocaleForceUpdate } from '@/composables/useMomentLocaleForceUpdate';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { keyboardOrMouseEventHandlerFactory } from '@/utils/events';
import { getDateTimeMoment, isoParsingDateFormat } from '@/utils/time';
import { computed, getCurrentInstance, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const momentLocale = useMomentLocaleForceUpdate(getCurrentInstance());
const selectedDate = computed(() => {
  return momentLocale.value && ts?.currentDate.value && ts?.currentTimezone.value
    ? getDateTimeMoment(ts?.currentDate.value, isoParsingDateFormat, ts.currentTimezone.value)
      .locale(momentLocale.value).format('LL')
    : '';
});
const datepicker = useTemplateRef<DatePickerApi>('date-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

const openPopup = keyboardOrMouseEventHandlerFactory((e: KeyboardEvent | MouseEvent, viaKeyboard: boolean) => {
  if (!ts) return;

  datepicker.value?.open(ts.currentTimestamp.value, viaKeyboard ? inputEl.value?.inputEl : null);
  window.requestAnimationFrame(() => {
    datepicker.value?.changeFocus('year', true);
  });
});

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
      :model-value="selectedDate"
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
