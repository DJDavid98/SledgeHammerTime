<script setup lang="ts">
import TimestampDisplay from '@/Components/home/TimestampDisplay.vue';
import UsefulLinks from '@/Components/home/UsefulLinks.vue';
import { timestamp } from '@/injection-keys';
import Layout from '@/Layouts/DefaultLayout.vue';
import { TimezoneSelection } from '@/model/timezone-selection';
import {
  convertTimeZoneSelectionToString,
  getDateTimeMoment,
  getDefaultInitialDateTime,
  getDefaultInitialTimezone,
  getInitialDateTime,
  isoParsingDateFormat,
  isoTimeFormat,
} from '@/utils/time';
import { Head, router, usePage } from '@inertiajs/vue3';
import { computed, provide, readonly, Ref, ref, watch } from 'vue';

const page = usePage();

const props = computed(() => {
  const url = new URL(page.url, window.location.href);
  const dtParam = url.searchParams.get('dt');
  const tzParam = url.searchParams.get('tz');
  return {
    defaultDateTime: dtParam,
    defaultTimezone: typeof tzParam === 'string' ? tzParam : undefined,
  };
});

const currentTimezone: Ref<TimezoneSelection> = ref(getDefaultInitialTimezone(props.value.defaultTimezone));
const [initialDate, initialTime] = getDefaultInitialDateTime(props.value.defaultDateTime, currentTimezone.value);
const dateString = ref(initialDate);
const timeString = ref(initialTime);

const currentTimestamp = computed(() => getDateTimeMoment(`${dateString.value} ${timeString.value}`, `${isoParsingDateFormat} ${isoTimeFormat}`, currentTimezone.value));

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
  const [newDateString, newTimeString] = getInitialDateTime(currentTimezone.value);
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
  <Head title="" />

  <Layout>
    <TimestampDisplay />

    <UsefulLinks />
  </Layout>
</template>
