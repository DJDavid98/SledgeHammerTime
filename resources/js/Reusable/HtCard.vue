<script setup lang="ts">
const props = defineProps<{
  class?: string;
}>();
</script>

<template>
  <article :class="['card', props.class]">
    <header class="card-header">
      <slot name="header" />
    </header>
    <slot />
  </article>
</template>
