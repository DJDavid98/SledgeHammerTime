<script setup lang="ts">
import HtCopyButton from '@/Reusable/HtCopyButton.vue';

defineProps<{
  data: string | number | undefined;
}>();
</script>

<template>
  <div
    v-if="data"
    class="copyable-code"
  >
    <HtCopyButton :text="data" />
    <code class="copyable-code-data">
      {{ data }}
    </code>
  </div>
</template>
