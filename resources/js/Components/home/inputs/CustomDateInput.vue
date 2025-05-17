<script setup lang="ts">
import DatePicker, { DatePickerApi } from '@/Components/home/pickers/DatePicker.vue';
import { useDateFnsLocale } from '@/composables/useDateFnsLocale';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { keyboardOrMouseEventHandlerFactory } from '@/utils/events';
import { getDiscordToUnicodeFormat } from '@/utils/get-discord-to-unicode-format';
import { fallbackIsoDate, fallbackIsoTime, getDateTimeTZDate } from '@/utils/time';
import { format } from 'date-fns';
import { computed, getCurrentInstance, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const dateFnsLocale = useDateFnsLocale(getCurrentInstance());
const selectedDate = computed(() => {
  if (dateFnsLocale.value && ts?.currentDate.value && ts?.currentTimezone.value) {
    const date = getDateTimeTZDate((ts?.currentDate.value ?? fallbackIsoDate) + 'T' + fallbackIsoTime, ts.currentTimezone.value);
    return format(date, getDiscordToUnicodeFormat(MessageTimestampFormat.LONG_DATE, dateFnsLocale.value.code), { locale: dateFnsLocale.value });
  } else {
    return '';
  }
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
