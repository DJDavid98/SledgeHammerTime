<script setup lang="ts">
import TimePicker, { TimePickerPopupApi } from '@/Components/home/pickers/TimePicker.vue';
import { useDateFnsLocale } from '@/composables/useDateFnsLocale';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { DialMode } from '@/utils/dial';
import { keyboardOrMouseEventHandlerFactory } from '@/utils/events';
import { getDiscordToUnicodeFormat } from '@/utils/get-discord-to-unicode-format';
import { createCurrentTsWithTimezone, fallbackIsoDate, fallbackIsoTime, getDateTimeTZDate } from '@/utils/time';
import { format } from 'date-fns';
import { computed, getCurrentInstance, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const dateFnsLocale = useDateFnsLocale(getCurrentInstance());
const selectedTime = computed(() => {
  return dateFnsLocale.value && ts?.currentTime.value && ts?.currentTimezone.value
    ? format(getDateTimeTZDate(fallbackIsoDate + 'T' + (ts?.currentTime.value ?? fallbackIsoTime), ts.currentTimezone.value), getDiscordToUnicodeFormat(MessageTimestampFormat.LONG_TIME, dateFnsLocale.value.code))
    : '';
});
const timepicker = useTemplateRef<TimePickerPopupApi>('time-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

const openPopup = keyboardOrMouseEventHandlerFactory((e: KeyboardEvent | MouseEvent, viaKeyboard) => {
  if (!ts) return;

  const currentTsWithTimezone = createCurrentTsWithTimezone(ts.currentTimestamp.value, ts.currentTimezone.value);
  timepicker.value?.open(currentTsWithTimezone, viaKeyboard ? inputEl.value?.inputEl : null);
  window.requestAnimationFrame(() => {
    timepicker.value?.changeFocus(DialMode.Hours, true);
  });
});

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
      :model-value="selectedTime"
      :readonly="true"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @keydown="openPopup"
    />
    <TimePicker
      ref="time-picker"
      @selected="changeTime"
    />
  </div>
</template>
