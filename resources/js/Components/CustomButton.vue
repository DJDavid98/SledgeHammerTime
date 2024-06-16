<script setup lang="ts">
withDefaults(
  defineProps<{
    type?: 'button' | 'submit' | 'reset';
    variant?: 'secondary' | 'contrast';
  }>(),
  {
    type: 'button',
    variant: undefined,
  },
);
</script>

<template>
  <button
    :type="type"
    :class="variant"
  >
    <slot />
  </button>
</template>
