<script setup lang="ts">
import Popup, { CustomPopupApi, Focusable } from '@/Components/CustomPopup.vue';
import DatePickerCalendar, { DatePickerCalendarApi } from '@/Components/home/pickers/DatePickerCalendar.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { pad } from '@/utils/pad';
import { limitDate, limitMonth } from '@/utils/time';
import { Moment } from 'moment-timezone';
import { ref, useTemplateRef, watch } from 'vue';

const year = ref(new Date(0).getUTCFullYear());
const month = ref(1);
const date = ref(1);
const calendar = ref<DatePickerCalendarApi>();
const yearInput = ref<HTMLInputElement>();
const monthInput = ref<HTMLInputElement>();
const dateInput = ref<HTMLInputElement>();

const emit = defineEmits<{
  (e: 'selected', date: string): void;
}>();

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const formRef = useTemplateRef<HTMLFormElement>('form-el');

const select = () => {
  const formattedDate = [year.value, month.value, date.value].map(n => pad(n, 2)).join('-');
  emit('selected', formattedDate); // Emit the selected date back to the MainDatepicker
};
const selectAndClose = () => {
  const focusedEl = formRef.value?.querySelector<HTMLElement>(':focus');
  if (focusedEl) {
    focusedEl.blur();
  }
  select();
  close();
};
const open = (initialValue: Moment, focusOnClose?: Focusable | null) => {
  year.value = initialValue.year();
  month.value = initialValue.month() + 1;
  date.value = initialValue.date();
  popupRef.value?.open(focusOnClose);
};
const setDate = (newYear: number, newMonth: number, newDate: number) => {
  year.value = newYear;
  month.value = newMonth;
  date.value = newDate;
  select();
};
const close = () => {
  popupRef.value?.close();
};

const handleYearBlur = inputRangeLimitBlurHandlerFactory(year);
const handleMonthBlur = inputRangeLimitBlurHandlerFactory(month);
const handleDateBlur = inputRangeLimitBlurHandlerFactory(date);

watch([year, month, date], () => {
  calendar.value?.setSelection(year.value, month.value, date.value);
});

const changeFocus = (input: 'year' | 'month' | 'date', setSelection: boolean = false) => {
  switch (input) {
    case 'year':
      yearInput.value?.focus();
      if (setSelection) {
        yearInput.value?.select();
      }
      break;
    case 'month':
      monthInput.value?.focus();
      if (setSelection) {
        monthInput.value?.select();
      }
      break;
    case 'date':
      dateInput.value?.focus();
      if (setSelection) {
        dateInput.value?.select();
      }
      break;
  }
};

export interface DatePickerApi {
  open: typeof open;
  changeFocus: typeof changeFocus;
}

defineExpose<DatePickerApi>({
  open,
  changeFocus,
});
</script>

<template>
  <Popup ref="popup-el">
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <HtFormInputGroup>
        <HtInput
          ref="yearInput"
          v-model="year"
          type="number"
          class="grid-flex-item flex-basis-40"
          @blur="handleYearBlur"
        />
        <HtInput
          ref="monthInput"
          v-model="month"
          type="number"
          class="grid-flex-item flex-basis-30"
          min="1"
          max="12"
          @blur="handleMonthBlur"
        />
        <HtInput
          ref="dateInput"
          v-model="date"
          type="number"
          class="grid-flex-item flex-basis-30"
          min="1"
          max="31"
          @blur="handleDateBlur"
        />
      </HtFormInputGroup>
      <HtButtonGroup>
        <HtButton
          color="primary"
          :justify-center="true"
          type="submit"
        >
          {{ $t('global.form.select') }}
        </HtButton>
        <HtButton
          :justify-center="true"
          @click="close"
        >
          {{ $t('global.form.cancel') }}
        </HtButton>
      </HtButtonGroup>
    </form>
    <hr>
    <DatePickerCalendar
      ref="calendar"
      :selected-year="year"
      :selected-month="limitMonth(month)"
      :selected-date="limitDate(date)"
      @set-date="setDate"
    />
  </Popup>
</template>
