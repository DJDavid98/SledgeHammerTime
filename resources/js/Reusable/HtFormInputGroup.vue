<script setup lang="ts">
defineProps<{
  dir?: 'ltr' | 'rtl';
}>();
</script>

<template>
  <fieldset
    class="form-input-group"
    :dir="dir"
  >
    <slot />
  </fieldset>
</template>
