<script setup lang="ts">
import { BadgeColor } from '@/utils/badges';

const props = defineProps<{
  prefix?: string;
  suffix?: string;
  class?: string;
  color?: BadgeColor;
}>();
</script>

<template>
  <span :class="['badge', { [`badge-${color}`]: color }, props.class]">
    <span
      v-if="prefix"
      class="badge-prefix"
    >{{ prefix }}</span>
    <span class="badge-content"><slot /></span>
    <span
      v-if="suffix"
      class="badge-suffix"
    >{{ suffix }}</span>
  </span>
</template>
