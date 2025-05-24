<script setup lang="ts">
import DateTimePicker, { DateTimePickerApi } from '@/Components/home/pickers/DateTimePicker.vue';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { DTL } from '@/utils/dtl';
import { keyboardOrMouseEventHandlerFactory } from '@/utils/events';
import { computed, getCurrentInstance, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const dateLibLocale = useDateLibraryLocale(getCurrentInstance());
const selectedDateTime = computed(() => {
  if (dateLibLocale.value) {
    const currentDateValue = ts?.currentDate.value;
    if (currentDateValue) {
      const currentTimeValue = ts?.currentTime.value;
      if (currentTimeValue) {
        return DTL.convertIsoToLocalizedDateTimeInputValue(
          currentDateValue,
          currentTimeValue,
          dateLibLocale.value.name,
        );
      }
    }
  }

  return '';
});
const datetimepicker = useTemplateRef<DateTimePickerApi>('date-time-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

const openPopup = keyboardOrMouseEventHandlerFactory((e: KeyboardEvent | MouseEvent, viaKeyboard: boolean) => {
  if (!ts) return;

  datetimepicker.value?.open(ts.currentTimestamp.value, viaKeyboard ? inputEl.value?.inputEl : null);
  window.requestAnimationFrame(() => {
    datetimepicker.value?.changeFocus('year', true);
  });
});

const changeDateTime = (value: string) => {
  ts?.changeDateTimeString(value);
};

const positionAnchorName = '--date-time-input';
provide(positionAnchor, positionAnchorName);
</script>

<template>
  <div>
    <HtInput
      :id="id"
      ref="input-el"
      :model-value="selectedDateTime"
      :readonly="true"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @keydown="openPopup"
    />
    <DateTimePicker
      ref="date-time-picker"
      @selected="changeDateTime"
    />
  </div>
</template>
