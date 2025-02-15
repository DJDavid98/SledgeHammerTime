<script setup lang="ts">
import { useMomentLocaleForceUpdate } from '@/composables/useMomentLocaleForceUpdate';
import { Moment } from 'moment-timezone';
import { computed, getCurrentInstance, ref, watch } from 'vue';

const props = defineProps<{
  ts: Moment | undefined,
  format?: string;
  fromNow?: boolean;
}>();

const updateInterval = ref<ReturnType<typeof setInterval> | null>(null);
const instance = getCurrentInstance();

const momentLocale = useMomentLocaleForceUpdate(instance);

watch(() => props.fromNow, (fromNow) => {
  if (updateInterval.value !== null) {
    clearInterval(updateInterval.value);
  }

  if (fromNow) {
    if (typeof window !== 'undefined') {
      updateInterval.value = setInterval(() => {
        instance?.proxy?.$forceUpdate();
      }, 1e3);
    }
  } else {
    updateInterval.value = null;
  }
}, { immediate: true });

const localTimestamp = computed(() => props.ts?.local());
</script>

<template>
  <span
    v-if="localTimestamp && momentLocale"
    :data-tooltip="localTimestamp.locale(momentLocale).format('LLLL')"
  >
    <template v-if="format">
      {{ localTimestamp.locale(momentLocale).format(format) }}
    </template>
    <template v-if="fromNow">
      {{ localTimestamp.locale(momentLocale).fromNow() }}
    </template>
  </span>
</template>
