<script setup lang="ts">
import DatePickerCalendar, { DatePickerCalendarApi } from '@/Components/home/popup/DatePickerCalendar.vue';
import Popup from '@/Components/Popup.vue';
import { pad } from '@/utils/pad';
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
  <Popup :show="show" @close="close">
    <div class="grid-flex">
      <input v-model="year" type="number" class="grid-flex-item flex-basis-40" />
      <input v-model="month" type="number" class="grid-flex-item flex-basis-30" min="1" max="12" />
      <input v-model="date" type="number" class="grid-flex-item flex-basis-30" min="1" max="31" />
    </div>
    <div class="grid">
      <button @click="selectAndClose" class="mb-0">{{ $t('global.form.select') }}</button>
      <button @click="close" class="mb-0 secondary">{{ $t('global.form.cancel') }}</button>
    </div>
    <hr />
    <DatePickerCalendar
        ref="calendar"
        v-if="show"
        :selectedYear="year"
        :selectedMonth="month"
        :selectedDate="date"
        @setDate="setDate"
    />
  </Popup>
</template>
