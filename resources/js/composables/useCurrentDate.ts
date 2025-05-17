import { TZDate } from '@date-fns/tz';
import { getDate, getMonth, getYear } from 'date-fns';
import { computed, onUnmounted, ref } from 'vue';

export function useCurrentDate() {
  const currentDate = ref(new TZDate());

  const intervalId = setInterval(() => {
    currentDate.value = new TZDate();
  }, 60e3);

  onUnmounted(() => {
    clearInterval(intervalId);
  });

  return computed(() => ({
    year: getYear(currentDate.value),
    month: getMonth(currentDate.value),
    date: getDate(currentDate.value),
  }));
}
