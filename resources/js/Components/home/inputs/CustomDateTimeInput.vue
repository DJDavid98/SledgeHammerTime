<script setup lang="ts">
import DateTimePicker, { DateTimePickerApi } from '@/Components/home/pickers/DateTimePicker.vue';
import { useDateFnsLocale } from '@/composables/useDateFnsLocale';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { keyboardOrMouseEventHandlerFactory } from '@/utils/events';
import { getDiscordToUnicodeFormat } from '@/utils/get-discord-to-unicode-format';
import { isoFormat } from '@/utils/time';
import { format, parse } from 'date-fns';
import { computed, getCurrentInstance, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const dateFnsLocale = useDateFnsLocale(getCurrentInstance());
const selectedDateTime = computed(() => dateFnsLocale.value ? format(parse(`${ts?.currentDate.value} ${ts?.currentTime.value}`, isoFormat, new Date()), getDiscordToUnicodeFormat(MessageTimestampFormat.LONG_DATE, dateFnsLocale.value.code) + ' ' + getDiscordToUnicodeFormat(MessageTimestampFormat.LONG_TIME, dateFnsLocale.value.code)) : '');
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
