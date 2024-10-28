<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import { faClipboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
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
    <HtButton
      color="primary"
      class="cursor-pointer"
      :title="$t('timestampPicker.table.clickToCopy')"
      @click="copy"
    >
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    <code>
      {{ data }}
    </code>
  </template>
</template>
