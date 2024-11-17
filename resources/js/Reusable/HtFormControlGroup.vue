<script setup lang="ts">
defineProps<{
  vertical?: boolean;
}>();
</script>

<template>
  <div :class="['form-control-group', { vertical }]">
    <slot />
  </div>
</template>
