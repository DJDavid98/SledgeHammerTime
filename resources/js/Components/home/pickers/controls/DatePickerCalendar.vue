<script setup lang="ts">
import { DateTimeLibraryMonth, DateTimeLibraryValue, DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { useCurrentDate } from '@/composables/useCurrentDate';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { dateTimeLibraryInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import { CalendarDay, generateCalendar, getWeekdayItems, WeekdayItem, WEEKEND_DAYS } from '@/utils/calendar';
import { faBackwardFast, faChevronLeft, faChevronRight, faForwardFast } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { usePage } from '@inertiajs/vue3';
import classNames from 'classnames';
import { computed, getCurrentInstance, inject, ref } from 'vue';

const props = defineProps<{
  selectedYear: number,
  selectedMonth: number,
  selectedDate: number,
}>();

const emit = defineEmits<{
  (e: 'setDate', year: number, month: number, date: number): void
}>();

const year = ref(props.selectedYear);
const month = ref(props.selectedMonth);
const date = ref(props.selectedDate);

const locale = computed(() => usePage().props.app.locale);
const dtl = inject(dateTimeLibraryInject);
const dateLibLocale = useDateLibraryLocale(dtl, getCurrentInstance());

const firstDayOfWeek = computed(() => {
  switch (locale.value) {
    case 'ms':
      return DateTimeLibraryWeekday.Sunday;
    default:
      return dateLibLocale.value?.getWeekInfo().firstDay ?? DateTimeLibraryWeekday.Monday;
  }
});

const weekdaysItems = computed(() => getWeekdayItems(dateLibLocale.value?.getShortWeekdays() ?? [], firstDayOfWeek.value));

const calendar = computed(() => generateCalendar({
  dtl: dtl?.value,
  locale: dateLibLocale.value,
  year: year.value,
  month: month.value - 1,
  firstDayOfWeek: firstDayOfWeek.value,
}));

const dateTime = computed((): DateTimeLibraryValue | null => {
  return dtl?.value.getValueForDate(year.value, month.value - 1, date.value) ?? null;
});

const currentDate = useCurrentDate(dtl);

const isShowingCurrentMonth = computed(() => {
  return month.value === currentDate.value.month + 1 && year.value === currentDate.value.year;
});

const getDayClasses = (calendarDay: CalendarDay) => {
  const weekendDaysData = WEEKEND_DAYS[locale.value];
  const weekdayClass = typeof calendarDay.weekday === 'number' ? weekendDaysData?.[calendarDay.weekday] : undefined;
  return classNames('calendar-day contrast outline', weekdayClass, {
    selected: calendarDay.date === props.selectedDate && calendarDay.month === props.selectedMonth - 1 && year.value === props.selectedYear,
    'different-month': calendarDay.month !== month.value - 1,
    current: calendarDay.date === currentDate.value.date && calendarDay.month === currentDate.value.month && year.value === currentDate.value.year,
  });
};

const getWeekdayClasses = (weekdayItem: WeekdayItem) => {
  const weekendDaysData = WEEKEND_DAYS[locale.value];
  const weekdayClass = weekendDaysData?.[weekdayItem.index];
  return classNames(weekdayClass);
};

const stepDate = (direction: -1 | 1, add: 'month' | 'year') => {
  switch (add) {
    case 'month':
      if (direction > 0) {
        if (month.value - 1 === DateTimeLibraryMonth.December) {
          month.value = DateTimeLibraryMonth.January + 1;
          year.value++;
        } else {
          month.value++;
        }
      } else {
        if (month.value - 1 === DateTimeLibraryMonth.January) {
          month.value = DateTimeLibraryMonth.December + 1;
          year.value--;
        } else {
          month.value--;
        }
      }
      break;
    case 'year':
      year.value += direction;
      break;
  }
};

const setDate = (calendarDay: CalendarDay) => {
  month.value = calendarDay.month + 1;
  date.value = calendarDay.date;
  emit('setDate', year.value, month.value, date.value);
};

const setSelection = (newYear: number, newMonth: number, newDate: number) => {
  year.value = newYear;
  month.value = newMonth;
  date.value = newDate;
};

const jumpToToday = () => {
  setSelection(currentDate.value.year, currentDate.value.month + 1, currentDate.value.date);
};

export interface DatePickerCalendarApi {
  setSelection: typeof setSelection;
}

defineExpose<DatePickerCalendarApi>({
  setSelection,
});
</script>

<template>
  <div class="calendar-controls">
    <HtButtonGroup>
      <HtButton
        :aria-label="$t('timestampPicker.picker.tooltip.previousYear')"
        @click="stepDate(-1, 'year')"
      >
        <FontAwesomeIcon
          :icon="faBackwardFast"
          class="icon-ltr"
        />
        <FontAwesomeIcon
          :icon="faForwardFast"
          class="icon-rtl"
        />
      </HtButton>
      <HtButton
        :aria-label="$t('timestampPicker.picker.tooltip.previousMonth')"
        @click="stepDate(-1, 'month')"
      >
        <FontAwesomeIcon
          :icon="faChevronLeft"
          class="icon-ltr"
        />
        <FontAwesomeIcon
          :icon="faChevronRight"
          class="icon-rtl"
        />
      </HtButton>
    </HtButtonGroup>
    <span
      v-if="dateLibLocale && dateTime"
      class="calendar-context"
    >{{
      dateTime.setLocale(dateLibLocale).formatCalendarContext()
    }}</span>
    <HtButtonGroup>
      <HtButton
        :aria-label="$t('timestampPicker.picker.tooltip.nextMonth')"
        @click="stepDate(1, 'month')"
      >
        <FontAwesomeIcon
          :icon="faChevronRight"
          class="icon-ltr"
        />
        <FontAwesomeIcon
          :icon="faChevronLeft"
          class="icon-rtl"
        />
      </HtButton>
      <HtButton
        :aria-label="$t('timestampPicker.picker.tooltip.nextYear')"
        @click="stepDate(1, 'year')"
      >
        <FontAwesomeIcon
          :icon="faForwardFast"
          class="icon-ltr"
        />
        <FontAwesomeIcon
          :icon="faBackwardFast"
          class="icon-rtl"
        />
      </HtButton>
    </HtButtonGroup>
  </div>
  <HtFormControlGroup :vertical="true">
    <HtButton
      :disabled="isShowingCurrentMonth"
      :block="true"
      @click="jumpToToday"
    >
      {{ $t('timestampPicker.picker.button.jumpToToday') }}
    </HtButton>
  </HtFormControlGroup>
  <div class="calendar">
    <div class="calendar-weekdays">
      <div
        v-for="weekdayItem in weekdaysItems"
        :key="weekdayItem.index"
        :class="getWeekdayClasses(weekdayItem)"
      >
        {{ weekdayItem.name }}
      </div>
    </div>
    <div
      v-for="(calendarWeek, index) in calendar.days"
      :key="index"
      class="calendar-week"
    >
      <button
        v-for="calendarDay in calendarWeek"
        :key="`${calendarDay.month}/${calendarDay.date}`"
        :class="getDayClasses(calendarDay)"
        @click="setDate(calendarDay)"
      >
        {{ calendarDay.display }}
      </button>
    </div>
  </div>
</template>
