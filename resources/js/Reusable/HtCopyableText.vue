<script setup lang="ts">
import HtCopyButton from '@/Reusable/HtCopyButton.vue';

withDefaults(defineProps<{
  data: string | number | undefined;
  monospace?: boolean
}>(), {
  monospace: true,
});
</script>

<template>
  <div
    v-if="data"
    class="copyable-text"
  >
    <HtCopyButton
      class="copyable-text-button"
      :text="data"
    />
    <component
      :is="monospace ? 'code' : 'span'"
      class="copyable-text-data"
    >
      {{ data }}
    </component>
  </div>
</template>
