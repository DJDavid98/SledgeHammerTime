<script setup lang="ts">
import { Moment } from 'moment-timezone';
import { getCurrentInstance, Ref, ref, watch } from 'vue';

const props = defineProps<{
  ts: Ref<Moment> | undefined,
  format?: string;
  fromNow?: boolean;
}>();

const updateInterval = ref<ReturnType<typeof setInterval> | null>(null);
const instance = getCurrentInstance();

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
</script>

<template>
    <span v-if="ts" :data-tooltip="ts.value.locale($page.props.app.locale).format('LLLL')">
        <template v-if="format">
            {{ ts.value.locale($page.props.app.locale).format(format) }}
        </template>
        <template v-if="fromNow">
            {{ ts.value.locale($page.props.app.locale).fromNow() }}
        </template>
    </span>
</template>
