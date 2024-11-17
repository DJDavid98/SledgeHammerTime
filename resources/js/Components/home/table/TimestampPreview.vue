<script setup lang="ts">
import { loadMomentLocale } from '@/utils/moment';
import { usePage } from '@inertiajs/vue3';
import { Moment } from 'moment-timezone';
import { computed, getCurrentInstance, Ref, ref, watch } from 'vue';

const props = defineProps<{
  ts: Ref<Moment> | undefined,
  format?: string;
  fromNow?: boolean;
}>();

const updateInterval = ref<ReturnType<typeof setInterval> | null>(null);
const instance = getCurrentInstance();

const locale = computed(() => usePage().props.app.locale);
loadMomentLocale(locale.value).then(() => {
  instance?.proxy?.$forceUpdate();
});

watch(() => props.fromNow, (fromNow) => {
  if (updateInterval.value !== null) {
    clearInterval(updateInterval.value);
  }

  if (fromNow) {
    updateInterval.value = setInterval(() => {
      instance?.proxy?.$forceUpdate();
    }, 1e3);
  } else {
    updateInterval.value = null;
  }
}, { immediate: true });

const localTimestamp = computed(() => props.ts?.value.local());
</script>

<template>
  <span
    v-if="localTimestamp"
    :data-tooltip="localTimestamp.locale($page.props.app.locale).format('LLLL')"
  >
    <template v-if="format">
      {{ localTimestamp.locale(locale).format(format) }}
    </template>
    <template v-if="fromNow">
      {{ localTimestamp.locale(locale).fromNow() }}
    </template>
  </span>
</template>
