<script setup lang="ts">
import TimestampDisplay from '@/Components/home/TimestampDisplay.vue';
import UsefulLinks from '@/Components/home/UsefulLinks.vue';
import { dateTimeLibraryInject, timestamp } from '@/injection-keys';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { convertTimeZoneSelectionToString } from '@/utils/time';
import { router, usePage } from '@inertiajs/vue3';
import { computed, inject, provide, readonly, Ref, ref, watch } from 'vue';

const page = usePage();
const dtl = inject(dateTimeLibraryInject);

const props = computed(() => {
  const url = new URL(page.url, typeof window !== 'undefined' ? window.location.href : page.props.ziggy.location);
  const dtParam = url.searchParams.get('dt');
  const tzParam = url.searchParams.get('tz');
  return {
    defaultDateTime: dtParam,
    defaultTimezone: typeof tzParam === 'string' ? tzParam : undefined,
  };
});

const currentTimezone: Ref<TimezoneSelection> = ref(dtl?.value.getDefaultInitialTimezoneSelection(props.value.defaultTimezone) ?? {
  type: TimeZoneSelectionType.ZONE_NAME,
  name: 'Etc/UTC',
});
const [initialDate, initialTime] = dtl?.value.getDefaultInitialDateTime(currentTimezone.value, props.value.defaultDateTime) ?? ['', ''];
const dateString = ref(initialDate);
const timeString = ref(initialTime);

const currentTimestamp = computed(() => dtl?.value.getValueForIsoZonedDateTime(dateString.value, timeString.value, currentTimezone.value) ?? null);

const changeDateString = (value: string) => {
  dateString.value = value;
};
const changeTimeString = (value: string) => {
  timeString.value = value;
};
const changeDateTimeString = (value: string) => {
  const [newDateString, newTimeString] = value.split(/[ T]/);
  dateString.value = newDateString;
  timeString.value = newTimeString;
};
const changeTimezone = (value: TimezoneSelection) => {
  currentTimezone.value = value;
};
const setCurrentTime = () => {
  if (!dtl?.value) {
    console.error('setCurrentTime: dtl missing');
    return;
  }
  const [newDateString, newTimeString] = dtl.value.getInitialDateTime(currentTimezone.value);
  changeDateString(newDateString);
  changeTimeString(newTimeString);
};
const locale = computed(() => page.props.app.locale);

provide(timestamp, {
  currentTimestamp,
  currentDate: readonly(dateString),
  currentTime: readonly(timeString),
  currentTimezone,
  changeDateString,
  changeTimeString,
  changeDateTimeString,
  changeTimezone,
  setCurrentTime,
});

watch([dateString, timeString, currentTimezone], () => {
  const params = new URLSearchParams();
  params.set('dt', (dateString.value + '.' + timeString.value).replace(/[^\d.]/g, ''));
  params.set('tz', convertTimeZoneSelectionToString(currentTimezone.value));
  router.get(`${route('home', { locale: locale.value })}?${params}`, undefined, { replace: true });
});
</script>

<template>
  <TimestampDisplay />

  <UsefulLinks />
</template>
