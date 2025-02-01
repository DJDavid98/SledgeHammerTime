<script setup lang="ts">
const props = defineProps<{
  dir?: 'ltr' | 'rtl';
  class?: string;
}>();
</script>

<template>
  <fieldset
    :class="['form-input-group', props.class]"
    :dir="dir"
  >
    <slot />
  </fieldset>
</template>
