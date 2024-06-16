<script setup lang="ts">
import Popup from '@/Components/CustomPopup.vue';
import DatePickerCalendar, { DatePickerCalendarApi } from '@/Components/home/pickers/DatePickerCalendar.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { pad } from '@/utils/pad';
import { limitDate, limitMonth } from '@/utils/time';
import { Moment } from 'moment-timezone';
import { ref, watch } from 'vue';

const year = ref(0);
const month = ref(0);
const date = ref(0);
const calendar = ref<DatePickerCalendarApi>();

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

export interface DatePickerPopupApi {
  open: typeof open;
}

defineExpose<DatePickerPopupApi>({
  open,
});
</script>


<template>
  <Popup
    :show="show"
    @close="close"
  >
    <fieldset role="group">
      <input
        v-model="year"
        type="number"
        class="grid-flex-item flex-basis-40"
      >
      <input
        v-model="month"
        type="number"
        class="grid-flex-item flex-basis-30"
        min="1"
        max="12"
        @blur="handleMonthBlur"
      >
      <input
        v-model="date"
        type="number"
        class="grid-flex-item flex-basis-30"
        min="1"
        max="31"
        @blur="handleDateBlur"
      >
    </fieldset>
    <div class="grid">
      <button
        class="mb-0"
        @click="selectAndClose"
      >
        {{ $t('global.form.select') }}
      </button>
      <button
        class="mb-0 secondary"
        @click="close"
      >
        {{ $t('global.form.cancel') }}
      </button>
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
