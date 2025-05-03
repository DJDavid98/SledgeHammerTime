<script setup lang="ts">
import { useMomentLocaleForceUpdate } from '@/composables/useMomentLocaleForceUpdate';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { Moment } from 'moment-timezone';
import { computed, getCurrentInstance, ref, watch } from 'vue';

const props = defineProps<{
  ts: Moment | undefined,
  format?: MessageTimestampFormat;
  fromNow?: boolean;
}>();

const formatMap: Record<MessageTimestampFormat, string> = {
  [MessageTimestampFormat.SHORT_DATE]: 'L',
  [MessageTimestampFormat.LONG_DATE]: 'LL',
  [MessageTimestampFormat.SHORT_TIME]: 'LT',
  [MessageTimestampFormat.LONG_TIME]: 'LTS',
  [MessageTimestampFormat.SHORT_FULL]: 'LLL',
  [MessageTimestampFormat.LONG_FULL]: 'LLLL',
  [MessageTimestampFormat.RELATIVE]: '',
};

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
  <time
    v-if="localTimestamp && momentLocale"
    :title="localTimestamp.locale(momentLocale).format('LLLL')"
    :datetime="localTimestamp.toISOString()"
  >
    <template v-if="fromNow">
      {{ localTimestamp.locale(momentLocale).fromNow() }}
    </template>
    <template v-else-if="format">
      {{ localTimestamp.locale(momentLocale).format(formatMap[format]) }}
    </template>
  </time>
</template>
