<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { computed, getCurrentInstance, ref, watch } from 'vue';

const props = defineProps<{
  ts: DateTimeLibraryValue | undefined,
  format?: MessageTimestampFormat;
}>();

const updateInterval = ref<ReturnType<typeof setInterval> | null>(null);
const instance = getCurrentInstance();

const dateLibLocale = useDateLibraryLocale(instance);

const fromNow = computed(() => props.format === MessageTimestampFormat.RELATIVE);

watch(fromNow, (fromNowValue) => {
  if (updateInterval.value !== null) {
    clearInterval(updateInterval.value);
  }

  if (fromNowValue) {
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
    v-if="localTimestamp && dateLibLocale"
    :title="localTimestamp.setLocale(dateLibLocale.name).formatDiscordTimestamp(MessageTimestampFormat.LONG_FULL)"
    :datetime="localTimestamp.toISOString()"
  >
    <template v-if="fromNow">
      {{ localTimestamp.setLocale(dateLibLocale.name).fromNow() }}
    </template>
    <template v-else-if="format">
      {{ localTimestamp.setLocale(dateLibLocale.name).formatDiscordTimestamp(format) }}
    </template>
  </time>
</template>
