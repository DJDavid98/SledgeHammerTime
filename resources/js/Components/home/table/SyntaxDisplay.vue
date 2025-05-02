<script setup lang="ts">
import HtCopyableCode from '@/Reusable/HtCopyableCode.vue';
import { computed } from 'vue';

const props = defineProps<{
  unixTs: number | undefined;
  format?: string;
}>();

const data = computed(() => props.format ? `<t:${props.unixTs}:${props.format}>` : props.unixTs);
</script>

<template>
  <HtCopyableCode :data="data" />
</template>
