<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import TimestampDisplay from '@/Components/home/TimestampDisplay.vue';
import { computed, provide, ref, watch } from 'vue';
import moment from 'moment';
import { timestamp } from '@/injection-keys';
import { isoFormattingDateFormat, isoTimeFormat } from '@/utils/timezone';

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

const currentTimestamp = computed(() => moment.tz(`${dateString.value} ${timeString.value}`, currentTimezone.value));

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
  params.set('t', currentTimestamp.value.unix());
  params.set('tz', currentTimestamp.value.tz());
  history.replaceState({}, '', `${route('home')}?${params}`);
});
</script>

<template>
  <Head title="" />

  <Layout>
    <TimestampDisplay />
  </Layout>
</template>
