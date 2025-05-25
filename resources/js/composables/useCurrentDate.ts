import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryMonth } from '@/classes/DateTimeLibraryValue';
import { computed, ComputedRef, DeepReadonly, onUnmounted, ref } from 'vue';

export type CurrentDateRef = ComputedRef<{
  year: number;
  month: number;
  date: number;
}>

export function useCurrentDate(dtl: DeepReadonly<ComputedRef<DateTimeLibrary>> | undefined): CurrentDateRef {
  const currentDate = ref(dtl?.value.now());

  const intervalId = setInterval(() => {
    currentDate.value = dtl?.value.now();
  }, 60e3);

  onUnmounted(() => {
    clearInterval(intervalId);
  });

  return computed(() => ({
    year: currentDate.value?.getFullYear() ?? 1970,
    month: currentDate.value?.getMonth() ?? DateTimeLibraryMonth.January,
    date: currentDate.value?.getDayOfMonth() ?? 1,
  }));
}
