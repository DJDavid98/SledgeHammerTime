<script setup lang="ts">
defineProps<{
  responsive?: boolean,
}>();
</script>

<template>
  <div :class="['table-wrap', { responsive }]">
    <table class="table">
      <slot />
    </table>
  </div>
</template>
