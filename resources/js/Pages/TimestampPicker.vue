<script setup lang="ts">
import TimestampDisplay from '@/Components/home/TimestampDisplay.vue';
import { timestamp } from '@/injection-keys';
import Layout from '@/Layouts/DefaultLayout.vue';
import {
  getDefaultInitialDate,
  getDefaultInitialTimezone,
  isoFormattingDateFormat,
  isoParsingDateFormat,
  isoTimeFormat,
} from '@/utils/time';
import { Head, router, usePage } from '@inertiajs/vue3';
import moment from 'moment-timezone';
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

const currentTimezone: Ref<string> = ref(props.value.defaultTimezone || getDefaultInitialTimezone());
const initialDate = getDefaultInitialDate(props.value.defaultTs, currentTimezone.value);
const dateString = ref(initialDate.format(isoFormattingDateFormat));
const timeString = ref(initialDate.format(isoTimeFormat));

const currentTimestamp = computed(() => moment.tz(`${dateString.value} ${timeString.value}`, `${isoParsingDateFormat} ${isoTimeFormat}`, currentTimezone.value));

const changeDateString = (value: string) => {
  dateString.value = value;
};
const changeTimeString = (value: string) => {
  timeString.value = value;
};
const changeTimezone = (value: string) => {
  currentTimezone.value = value;
};
const setCurrentTime = () => {
  const now = moment.tz(currentTimezone.value);
  changeDateString(now.format(isoFormattingDateFormat));
  changeTimeString(now.format(isoTimeFormat));
};
const locale = computed(() => page.props.app.locale);

provide(timestamp, {
  currentTimestamp,
  currentTimezone,
  changeDateString,
  changeTimeString,
  changeTimezone,
  setCurrentTime,
});

watch(currentTimestamp, () => {
  const params = new URLSearchParams();
  params.set('t', currentTimestamp.value.unix().toString());
  params.set('tz', currentTimezone.value.toString());
  router.get(`${route('home', { locale: locale.value })}?${params}`, undefined, { replace: true });
});
</script>

<template>
  <Head title="" />

  <Layout>
    <TimestampDisplay />
  </Layout>
</template>
