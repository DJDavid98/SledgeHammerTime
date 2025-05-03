<script setup lang="ts">
const props = withDefaults(defineProps<{
  baseFont?: boolean;
  small?: boolean;
  class?: string;
}>(), {
  baseFont: false,
  small: false,
  class: undefined,
});
</script>

<template>
  <code :class="['code-span', props.class, { 'base-font': baseFont, small }]">
    <slot />
  </code>
</template>
