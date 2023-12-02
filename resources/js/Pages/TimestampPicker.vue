<script setup lang="ts">
import TimestampDisplay from '@/Components/home/TimestampDisplay.vue';
import { timestamp } from '@/injection-keys';
import Layout from '@/Layouts/Layout.vue';
import { isoFormattingDateFormat, isoParsingDateFormat, isoTimeFormat } from '@/utils/timezone';
import { Head, usePage } from '@inertiajs/vue3';
import moment from 'moment';
import { computed, provide, ref, watch } from 'vue';

const props = defineProps<{
  defaultTs?: number,
  defaultTimezone?: string,
}>();

const getDefaultInitialDate = () => {
  const value = new Date();
  value.setSeconds(0);
  return value;
};

const currentTimezone = ref(props.defaultTimezone || moment.tz.guess());
const initialDate = moment.tz(props.defaultTs ? new Date(props.defaultTs * 1e3) : getDefaultInitialDate(), currentTimezone.value);
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

const locale = computed(() => {
  const pageLocale = usePage().props.app.locale;
  if (pageLocale === 'en') return undefined;
  return pageLocale;
});

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
  history.replaceState({}, '', `${route('home', { locale: locale.value })}?${params}`);
});
</script>

<template>
  <Head title="" />

  <Layout>
    <TimestampDisplay />
  </Layout>
</template>
