<script setup lang="ts">

const props = withDefaults(defineProps<{
  href: string;
  class?: string;
  targetBlank?: boolean,
  target?: never,
  rel?: never,
}>(), {
  targetBlank: true,
  'class': undefined,
  target: undefined,
  rel: undefined,
});
</script>

<template>
  <a
    :class="props.class"
    :target="targetBlank ? '_blank' : undefined"
    :rel="targetBlank ? 'noopener noreferrer' : undefined"
    :href="href"
  >
    <slot />
  </a>
</template>

