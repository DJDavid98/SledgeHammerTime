<script setup lang="ts">
defineProps<{
  align?: 'right';
}>();
</script>

<template>
  <span :class="['input-field hide-selection grid-flex-item flex-basis-auto', { [`text-${align}`]: align }]">
    <slot />
  </span>
</template>
