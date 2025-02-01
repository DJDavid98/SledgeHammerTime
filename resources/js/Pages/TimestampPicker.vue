<script setup lang="ts">
import TimestampDisplay from '@/Components/home/TimestampDisplay.vue';
import UsefulLinks from '@/Components/home/UsefulLinks.vue';
import { timestamp } from '@/injection-keys';
import Layout from '@/Layouts/DefaultLayout.vue';
import { TimezoneSelection } from '@/model/timezone-selection';
import {
  convertTimeZoneSelectionToString,
  getCurrentTimestampMoment,
  getDefaultInitialMoment,
  getDefaultInitialTimezone,
  getInitialMoment,
  isoFormattingDateFormat,
  isoParsingDateFormat,
  isoTimeFormat,
} from '@/utils/time';
import { Head, router, usePage } from '@inertiajs/vue3';
import { computed, provide, Ref, ref, watch } from 'vue';

const page = usePage();

const props = computed(() => {
  const url = new URL(page.url, window.location.href);
  const tParam = url.searchParams.get('t');
  const tParamNumber = typeof tParam === 'string' ? parseInt(tParam, 10) : undefined;
  const tzParam = url.searchParams.get('tz');
  return {
    defaultTs: tParamNumber,
    defaultTimezone: typeof tzParam === 'string' ? tzParam : undefined,
  };
});

const currentTimezone: Ref<TimezoneSelection> = ref(getDefaultInitialTimezone(props.value.defaultTimezone));
const initialDate = getDefaultInitialMoment(props.value.defaultTs, currentTimezone.value);
const dateString = ref(initialDate.format(isoFormattingDateFormat));
const timeString = ref(initialDate.format(isoTimeFormat));

const currentTimestamp = computed(() => getCurrentTimestampMoment(`${dateString.value} ${timeString.value}`, `${isoParsingDateFormat} ${isoTimeFormat}`, currentTimezone.value));

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
  const now = getInitialMoment(currentTimezone.value);
  changeDateString(now.format(isoFormattingDateFormat));
  changeTimeString(now.format(isoTimeFormat));
};
const locale = computed(() => page.props.app.locale);

provide(timestamp, {
  currentTimestamp,
  currentTimezone,
  changeDateString,
  changeTimeString,
  changeDateTimeString,
  changeTimezone,
  setCurrentTime,
});

watch(currentTimestamp, () => {
  const params = new URLSearchParams();
  params.set('t', currentTimestamp.value.unix().toString());
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
