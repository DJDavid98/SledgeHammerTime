<script setup lang="ts">
import Popup, { CustomPopupApi, Focusable } from '@/Components/CustomPopup.vue';
import DatePickerCalendar from '@/Components/home/pickers/controls/DatePickerCalendar.vue';
import PickerFormActions from '@/Components/home/pickers/controls/PickerFormActions.vue';
import DatePickerInputs from '@/Components/home/pickers/DatePickerInputs.vue';
import { useDatePicker } from '@/composables/useDatePicker';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import { limitDate, limitMonth } from '@/utils/time';
import { TZDate } from '@date-fns/tz';
import { useTemplateRef, watch } from 'vue';

const {
  year,
  month,
  date,
  calendar,
  dateInput, monthInput, yearInput,
  changeDateFocus,
  datePickerOpen,
  setDate,
  getSelectedDate,
} = useDatePicker();

const emit = defineEmits<{
  (e: 'selected', date: string): void;
}>();

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const formRef = useTemplateRef<HTMLFormElement>('form-el');

const select = () => {
  emit('selected', getSelectedDate());
};
const selectAndClose = () => {
  const focusedEl = formRef.value?.querySelector<HTMLElement>(':focus');
  if (focusedEl) {
    focusedEl.blur();
  }
  select();
  close();
};
const open = (initialValue: TZDate, focusOnClose?: Focusable | null) => {
  datePickerOpen(initialValue);
  popupRef.value?.open(focusOnClose);
};
const setDateAndSelect = (newYear: number, newMonth: number, newDate: number) => {
  setDate(newYear, newMonth, newDate);
  select();
};
const close = () => {
  popupRef.value?.close();
};

watch([year, month, date], () => {
  calendar.value?.setSelection(year.value, month.value, date.value);
});

export interface DatePickerApi {
  open: typeof open;
  changeFocus: typeof changeDateFocus;
}

defineExpose<DatePickerApi>({
  open,
  changeFocus: changeDateFocus,
});
</script>

<template>
  <Popup ref="popup-el">
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <HtFormInputGroup dir="ltr">
        <DatePickerInputs
          v-model:date-input="dateInput"
          v-model:month-input="monthInput"
          v-model:year-input="yearInput"
          v-model:year="year"
          v-model:month="month"
          v-model:date="date"
        />
      </HtFormInputGroup>
      <PickerFormActions @close="close" />
    </form>
    <hr>
    <DatePickerCalendar
      ref="calendar"
      :selected-year="year"
      :selected-month="limitMonth(month)"
      :selected-date="limitDate(date)"
      @set-date="setDateAndSelect"
    />
  </Popup>
</template>
