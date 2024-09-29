import moment from 'moment-timezone';
import { computed, onUnmounted, ref } from 'vue';

export function useCurrentDate() {
  const currentDate = ref(moment());

  const intervalId = setInterval(() => {
    currentDate.value = moment();
  }, 60e3);

  onUnmounted(() => {
    clearInterval(intervalId);
  });

  return computed(() => ({
    year: currentDate.value.year(),
    month: currentDate.value.month(),
    date: currentDate.value.date(),
  }));
}
