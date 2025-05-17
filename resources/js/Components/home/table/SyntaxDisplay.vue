<script setup lang="ts">
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import { computed } from 'vue';

const props = defineProps<{
  unixTs: number | undefined;
  tsFormat?: string;
}>();

const data = computed(() => props.tsFormat ? `<t:${props.unixTs}:${props.tsFormat}>` : props.unixTs);
</script>

<template>
  <HtCopyableText :data="data" />
</template>
