<script setup lang="ts">
import Popup, { CustomPopupApi, Focusable } from '@/Components/CustomPopup.vue';
import PickerFormActions from '@/Components/home/pickers/controls/PickerFormActions.vue';
import TimePickerDial from '@/Components/home/pickers/controls/TimePickerDial.vue';
import TimePickerInputs from '@/Components/home/pickers/TimePickerInputs.vue';
import { useTimePicker } from '@/composables/useTimePicker';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import { limitHours, limitMinutesSeconds, limitToTwelveHours } from '@/utils/time';
import { Moment } from 'moment-timezone';
import { useTemplateRef } from 'vue';

const {
  hours,
  minutes,
  seconds,
  isAm,
  dial,
  renderDial,
  twelveHourMode,
  hoursInput,
  minutesInput,
  secondsInput,
  setHours,
  setMinutes,
  setSeconds,
  changeTimeFocus,
  timePickerOpen,
  getSelectedTime,
  openTimePicker,
  closeTimePicker,
} = useTimePicker();

const emit = defineEmits<{
  (e: 'selected', time: string): void
}>();

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const formRef = useTemplateRef<HTMLFormElement>('form-el');


const selectAndClose = () => {
  const focusedEl = formRef.value?.querySelector<HTMLElement>(':focus');
  if (focusedEl) {
    focusedEl.blur();
  }
  emit('selected', getSelectedTime());
  close();
};
const open = (initialValue: Moment, focusOnClose?: Focusable | null) => {
  timePickerOpen(initialValue);
  popupRef.value?.open(focusOnClose);
};
const close = () => {
  popupRef.value?.close();
};

export interface TimePickerPopupApi {
  open: typeof open;
  changeFocus: typeof changeTimeFocus,
}

defineExpose<TimePickerPopupApi>({
  open,
  changeFocus: changeTimeFocus,
});
</script>


<template>
  <Popup
    ref="popup-el"
    @close="closeTimePicker"
    @open="openTimePicker"
  >
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <HtFormInputGroup dir="ltr">
        <TimePickerInputs
          v-model:hours-input="hoursInput"
          v-model:minutes-input="minutesInput"
          v-model:seconds-input="secondsInput"
          v-model:hours="hours"
          v-model:minutes="minutes"
          v-model:seconds="seconds"
          v-model:is-am="isAm"
          v-model:twelve-hour-mode="twelveHourMode"
          v-model:dial="dial"
        />
      </HtFormInputGroup>
      <PickerFormActions @close="close" />
    </form>
    <hr>
    <TimePickerDial
      v-if="renderDial"
      ref="dial"
      :hours="twelveHourMode ? limitToTwelveHours(hours) : limitHours(hours)"
      :minutes="limitMinutesSeconds(minutes)"
      :seconds="limitMinutesSeconds(seconds)"
      :is-am="isAm"
      :twelve-hour-mode="twelveHourMode"
      @set-hours="setHours"
      @set-minutes="setMinutes"
      @set-seconds="setSeconds"
      @change-focus="changeTimeFocus"
      @select="selectAndClose"
    />
  </Popup>
</template>
