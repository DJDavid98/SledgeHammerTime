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
    class="indicator"
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

<style scoped lang="scss">
$full-revolution-time: 5s;

.indicator {
  fill-rule: evenodd;
  clip-rule: evenodd;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-miterlimit: 1.5;

  .minute,
  .hour {
    fill: currentColor;
    transform-origin: 32px 32px;
    animation-name: rotate-hand;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
  }

  .hour {
    animation-duration: $full-revolution-time;
  }

  .minute {
    animation-duration: calc($full-revolution-time / 12);
  }

  .base {
    opacity: 0.8;
  }

  .face,
  .ticking {
    fill: none;
    stroke: currentColor;
  }

  .face {
    stroke-width: 6px;
  }

  .ticking {
    stroke-width: 5px;
  }
}

@keyframes rotate-hand {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>
