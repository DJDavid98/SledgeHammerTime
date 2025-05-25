<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import Popup, { CustomPopupApi, Focusable } from '@/Components/CustomPopup.vue';
import DatePickerCalendar from '@/Components/home/pickers/controls/DatePickerCalendar.vue';
import PickerFormActions from '@/Components/home/pickers/controls/PickerFormActions.vue';
import TimePickerDial from '@/Components/home/pickers/controls/TimePickerDial.vue';
import DatePickerInputs from '@/Components/home/pickers/DatePickerInputs.vue';
import TimePickerInputs from '@/Components/home/pickers/TimePickerInputs.vue';
import { useDatePicker } from '@/composables/useDatePicker';
import { useTimePicker } from '@/composables/useTimePicker';
import { dateTimeLibraryInject } from '@/injection-keys';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import { DialMode } from '@/utils/dial';
import { limitDate, limitHours, limitMinutesSeconds, limitMonth, limitToTwelveHours } from '@/utils/time';
import { inject, useTemplateRef, watch } from 'vue';

const dtl = inject(dateTimeLibraryInject);
const {
  year,
  month,
  date,
  calendar,
  changeDateFocus,
  datePickerOpen,
  setDate,
  getSelectedDate,
  dateInput,
  monthInput,
  yearInput,
} = useDatePicker();
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
} = useTimePicker(dtl);

const emit = defineEmits<{
  (e: 'selected', date: string): void;
}>();

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const formRef = useTemplateRef<HTMLFormElement>('form-el');

const select = () => {
  emit('selected', `${getSelectedDate()}T${getSelectedTime()}`);
};
const selectAndClose = () => {
  const focusedEl = formRef.value?.querySelector<HTMLElement>(':focus');
  if (focusedEl) {
    focusedEl.blur();
  }
  select();
  close();
};
const open = (initialValue: DateTimeLibraryValue, focusOnClose?: Focusable | null) => {
  datePickerOpen(initialValue);
  timePickerOpen(initialValue);
  popupRef.value?.open(focusOnClose);
};
const close = () => {
  popupRef.value?.close();
};

const changeFocus = (input: 'year' | 'month' | 'date' | DialMode, setSelection: boolean = false) => {
  switch (input) {
    case 'year':
    case 'month':
    case 'date':
      changeDateFocus(input, setSelection);
      break;
    case DialMode.Hours:
    case DialMode.Minutes:
    case DialMode.Seconds:
      changeTimeFocus(input, setSelection);
      break;
  }
};

watch([year, month, date], () => {
  calendar.value?.setSelection(year.value, month.value, date.value);
});

export interface DateTimePickerApi {
  open: typeof open;
  changeFocus: typeof changeFocus;
}

defineExpose<DateTimePickerApi>({
  open,
  changeFocus,
});
</script>

<template>
  <Popup
    ref="popup-el"
    :wide="true"
    @close="closeTimePicker"
    @open="openTimePicker"
  >
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <HtFormInputGroup
        dir="ltr"
        class="picker-date-control"
      >
        <DatePickerInputs
          v-model:date-input="dateInput"
          v-model:month-input="monthInput"
          v-model:year-input="yearInput"
          v-model:year="year"
          v-model:month="month"
          v-model:date="date"
          :halve-bases="true"
        />
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
    <div class="datetime-picker-controls">
      <div class="picker-date-control">
        <DatePickerCalendar
          ref="calendar"
          :selected-year="year"
          :selected-month="limitMonth(month)"
          :selected-date="limitDate(date)"
          @set-date="setDate"
        />
      </div>
      <div class="picker-time-control">
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
      </div>
    </div>
  </Popup>
</template>

<style lang="scss">
.datetime-picker-controls {
  display: flex;
  flex-flow: row nowrap;
  box-sizing: border-box;

  .picker-date-control {
    flex: 1 1 auto;
  }

  .picker-time-control {
    flex: 0 1 260px;
  }
}
</style>
