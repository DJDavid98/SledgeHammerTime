<script setup lang="ts">
import { useDateFnsLocale } from '@/composables/useDateFnsLocale';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { getDiscordToUnicodeFormat } from '@/utils/get-discord-to-unicode-format';
import { TZDate } from '@date-fns/tz';
import { format, formatDistanceToNow } from 'date-fns';
import { computed, getCurrentInstance, ref, watch } from 'vue';

const props = defineProps<{
  ts: TZDate | undefined,
  tsFormat?: MessageTimestampFormat;
}>();

const updateInterval = ref<ReturnType<typeof setInterval> | null>(null);
const instance = getCurrentInstance();

const dateFnsLocale = useDateFnsLocale(instance);

const fromNow = computed(() => props.tsFormat === MessageTimestampFormat.RELATIVE);

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
</script>

<template>
  <time
    v-if="ts && dateFnsLocale && tsFormat"
    :title="format(ts, getDiscordToUnicodeFormat(MessageTimestampFormat.LONG_FULL, dateFnsLocale.code), { locale: dateFnsLocale })"
    :datetime="ts.toISOString()"
  >
    <template v-if="fromNow">
      {{ formatDistanceToNow(ts, { includeSeconds: true, addSuffix: true, locale: dateFnsLocale }) }}
    </template>
    <template v-else-if="tsFormat">
      {{ format(ts, getDiscordToUnicodeFormat(tsFormat, dateFnsLocale.code), { locale: dateFnsLocale }) }}
    </template>
  </time>
</template>
