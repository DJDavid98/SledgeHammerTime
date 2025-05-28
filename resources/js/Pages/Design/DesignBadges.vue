<script setup lang="ts">
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import { badgeColors } from '@/utils/badges';

defineProps<{
  prefix?: string;
  suffix?: string;
}>();

const ucfirst = (value: string) => value[0].toUpperCase() + value.substring(1);
</script>

<template>
  <HtBadgeGroup>
    <template
      v-for="color in [undefined, ...badgeColors]"
      :key="color ?? 'default'"
    >
      <HtBadge
        :prefix="prefix"
        :suffix="suffix"
        :color="color"
      >
        {{ color ? ucfirst(color) : 'Default' }} Badge
      </HtBadge>
    </template>
  </HtBadgeGroup>
</template>

<style scoped>

</style>
