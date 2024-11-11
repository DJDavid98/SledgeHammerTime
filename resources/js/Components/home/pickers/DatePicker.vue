<script setup lang="ts">
import Popup from '@/Components/CustomPopup.vue';
import DatePickerCalendar, { DatePickerCalendarApi } from '@/Components/home/pickers/DatePickerCalendar.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { pad } from '@/utils/pad';
import { limitDate, limitMonth } from '@/utils/time';
import { Moment } from 'moment-timezone';
import { ref, watch } from 'vue';

const year = ref(0);
const month = ref(0);
const date = ref(0);
const calendar = ref<DatePickerCalendarApi>();
const yearInput = ref<HTMLInputElement>();
const monthInput = ref<HTMLInputElement>();
const dateInput = ref<HTMLInputElement>();

defineProps<{
  show: boolean;
}>();

const emit = defineEmits<{
  (e: 'selected', date: string): void
  (e: 'close'): void
}>();

const close = () => {
  emit('close');
};

const select = () => {
  const formattedDate = [year.value, month.value, date.value].map(n => pad(n, 2)).join('-');
  emit('selected', formattedDate); // Emit the selected date back to the MainDatepicker
};
const selectAndClose = () => {
  select();
  close();
};
const open = (initialValue: Moment) => {
  year.value = initialValue.year();
  month.value = initialValue.month() + 1;
  date.value = initialValue.date();
};
const setDate = (newYear: number, newMonth: number, newDate: number) => {
  year.value = newYear;
  month.value = newMonth;
  date.value = newDate;
  select();
};

const handleMonthBlur = inputRangeLimitBlurHandlerFactory(month);
const handleDateBlur = inputRangeLimitBlurHandlerFactory(date);

watch([year, month, date], () => {
  calendar.value?.setSelection(year.value, month.value, date.value);
});

const handleInputKeydown = (e: KeyboardEvent) => {
  if (e.key !== 'Enter') {
    return;
  }
  e.preventDefault();
  selectAndClose();
};

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

export interface DatePickerPopupApi {
  open: typeof open;
  changeFocus: typeof changeFocus;
}

defineExpose<DatePickerPopupApi>({
  open,
  changeFocus,
});
</script>


<template>
  <Popup
    :show="show"
    @close="close"
  >
    <fieldset role="group">
      <HtInput
        ref="yearInput"
        v-model="year"
        type="number"
        class="grid-flex-item flex-basis-40"
        @keydown="handleInputKeydown"
      />
      <HtInput
        ref="monthInput"
        v-model="month"
        type="number"
        class="grid-flex-item flex-basis-30"
        min="1"
        max="12"
        @blur="handleMonthBlur"
        @keydown="handleInputKeydown"
      />
      <HtInput
        ref="dateInput"
        v-model="date"
        type="number"
        class="grid-flex-item flex-basis-30"
        min="1"
        max="31"
        @blur="handleDateBlur"
        @keydown="handleInputKeydown"
      />
    </fieldset>
    <div class="grid">
      <HtButton
        color="primary"
        @click="selectAndClose"
      >
        {{ $t('global.form.select') }}
      </HtButton>
      <HtButton
        @click="close"
      >
        {{ $t('global.form.cancel') }}
      </HtButton>
    </div>
    <hr>
    <DatePickerCalendar
      v-if="show"
      ref="calendar"
      :selected-year="year"
      :selected-month="limitMonth(month)"
      :selected-date="limitDate(date)"
      @set-date="setDate"
    />
  </Popup>
</template>
