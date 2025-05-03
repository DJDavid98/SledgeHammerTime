<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  size?: number | string;
  color?: string;
}>(), {
  size: 32,
  color: undefined,
});

const style = computed(() => {
  const sizeRem = typeof props.size === 'number' ? `${props.size / 16}rem` : props.size;
  return `width: ${sizeRem}; height: ${sizeRem}${props.color ? `; color: ${props.color}` : ''}`;
});
</script>

<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    xml:space="preserve"
    viewBox="0 0 64 64"
    :style="style"
    class="loading-indicator"
  >
    <path
      d="M35 32a3.001 3.001 0 0 1-6 0l3-26.074L35 32Z"
      class="minute"
    />
    <path
      d="M35 32a3.001 3.001 0 0 1-6 0l3-13.037L35 32Z"
      class="hour"
    />
    <g class="base">
      <circle
        cx="32"
        cy="32"
        r="29"
        class="face"
      />
      <path
        d="M32 3v7m0 44v7m22-29h7M3 32h7"
        class="ticking"
      />
    </g>
  </svg>
</template>
