<script setup lang="ts">
import TimestampDisplay from '@/Components/home/TimestampDisplay.vue';
import { timestamp } from '@/injection-keys';
import Layout from '@/Layouts/DefaultLayout.vue';
import { isoFormattingDateFormat, isoParsingDateFormat, isoTimeFormat } from '@/utils/timezone';
import { Head, router, usePage } from '@inertiajs/vue3';
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
const page = usePage();
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
