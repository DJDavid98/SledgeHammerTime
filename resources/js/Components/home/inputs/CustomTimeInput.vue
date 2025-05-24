<script setup lang="ts">
import TimePicker, { TimePickerPopupApi } from '@/Components/home/pickers/TimePicker.vue';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { DialMode } from '@/utils/dial';
import { DTL } from '@/utils/dtl';
import { keyboardOrMouseEventHandlerFactory } from '@/utils/events';
import { computed, getCurrentInstance, inject, provide, useTemplateRef } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const dateLibLocale = useDateLibraryLocale(getCurrentInstance());
const selectedTime = computed(() => {
  if (dateLibLocale.value) {
    const currentTimeValue = ts?.currentTime.value;
    if (currentTimeValue) {
      const currentTimezoneValue = ts?.currentTimezone.value;
      if (currentTimezoneValue) {
        return DTL.getValueForIsoZonedTime(
          currentTimeValue,
          currentTimezoneValue,
        ).setLocale(dateLibLocale.value.name).formatTimeInputDisplay();
      }
    }
  }

  return '';
});
const timepicker = useTemplateRef<TimePickerPopupApi>('time-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

const openPopup = keyboardOrMouseEventHandlerFactory((e: KeyboardEvent | MouseEvent, viaKeyboard) => {
  if (!ts) return;

  const currentTsWithTimezone = ts.currentTimestamp.value.replaceZone(ts.currentTimezone.value);
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
