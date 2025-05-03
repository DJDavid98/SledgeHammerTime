<script setup lang="ts">
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import { computed } from 'vue';

const props = defineProps<{
  unixTs: number | undefined;
  format?: string;
}>();

const data = computed(() => props.format ? `<t:${props.unixTs}:${props.format}>` : props.unixTs);
</script>

<template>
  <HtCopyableText :data="data" />
</template>
