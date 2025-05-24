import { DTL } from '@/utils/dtl';
import { computed, ComputedRef, onUnmounted, ref } from 'vue';

export type CurrentDateRef = ComputedRef<{
  year: number;
  month: number;
  date: number;
}>

export function useCurrentDate(): CurrentDateRef {
  const currentDate = ref(DTL.now());

  const intervalId = setInterval(() => {
    currentDate.value = DTL.now();
  }, 60e3);

  onUnmounted(() => {
    clearInterval(intervalId);
  });

  return computed(() => ({
    year: currentDate.value.getFullYear(),
    month: currentDate.value.getMonth(),
    date: currentDate.value.getDayOfMonth(),
  }));
}
