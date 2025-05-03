<script setup lang="ts">
import HtCode from '@/Reusable/HtCode.vue';
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
    <HtCode
      :base-font="!monospace"
      class="copyable-text-data"
    >
      {{ data }}
    </HtCode>
  </div>
</template>
