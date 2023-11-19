<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
  unixTs: number | undefined;
  format?: string;
}>();

const data = computed(() => props.format ? `<t:${props.unixTs}:${props.format}>` : props.unixTs);

const copy = () => {
  if (data.value) {
    navigator.clipboard.writeText(data.value.toString());
  }
};
</script>

<template>
  <template v-if="unixTs !== undefined">
    <code :data-tooltip="$t('timestampPicker.table.clickToCopy')" @click="copy" class="cursor-pointer">
      {{ data }}
    </code>
  </template>
</template>
