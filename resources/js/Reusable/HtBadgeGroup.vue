<script setup lang="ts">
const props = defineProps<{
  class?: string;
}>();
</script>

<template>
  <div :class="['badge-group', props.class]">
    <slot />
  </div>
</template>
