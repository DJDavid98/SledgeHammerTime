<script setup lang="ts">
const props = defineProps<{
  class?: string;
  id?: string;
}>();
</script>

<template>
  <article
    :id="id"
    :class="['card', props.class]"
  >
    <header class="card-header">
      <slot name="header" />
    </header>
    <slot />
  </article>
</template>
