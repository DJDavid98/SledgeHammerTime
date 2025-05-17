import { DatePickerCalendarApi } from '@/Components/home/pickers/controls/DatePickerCalendar.vue';
import { pad } from '@/utils/pad';
import { TZDate } from '@date-fns/tz';
import { ref } from 'vue';

export const useDatePicker = () => {
  const year = ref(new Date(0).getUTCFullYear());
  const month = ref(1);
  const date = ref(1);
  const calendar = ref<DatePickerCalendarApi>();
  const yearInput = ref<HTMLInputElement>();
  const monthInput = ref<HTMLInputElement>();
  const dateInput = ref<HTMLInputElement>();

  const datePickerOpen = (initialValue: TZDate) => {
    year.value = initialValue.getFullYear();
    month.value = initialValue.getMonth() + 1;
    date.value = initialValue.getDate();
  };

  const setDate = (newYear: number, newMonth: number, newDate: number) => {
    year.value = newYear;
    month.value = newMonth;
    date.value = newDate;
  };

  const getSelectedDate = (): string => {
    return [year.value, month.value, date.value].map(n => pad(n, 2)).join('-');
  };

  const changeDateFocus = (input: 'year' | 'month' | 'date', setSelection: boolean = false) => {
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

  return {
    year,
    month,
    date,
    calendar,
    yearInput,
    monthInput,
    dateInput,
    changeDateFocus,
    datePickerOpen,
    setDate,
    getSelectedDate,
  };
};
