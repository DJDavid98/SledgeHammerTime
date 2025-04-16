<script setup lang="ts">
withDefaults(defineProps<{
  comboBox?: boolean,
}>(), {
  comboBox: false,
});
</script>

<template>
  <div :class="['form-control-wrap', { 'combo-box': comboBox }]">
    <slot />
  </div>
</template>
