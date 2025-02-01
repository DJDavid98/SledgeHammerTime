<script setup lang="ts">
withDefaults(defineProps<{
  progress: number;
  min?: number;
  max?: number;
}>(), {
  min: 0,
  max: 100,
});
</script>

<template>
  <div class="progress">
    <div
      class="progress-bar"
      role="progressbar"
      :aria-valuemax="max"
      :aria-valuemin="min"
      :aria-valuenow="progress"
      :style="`width: ${progress}%`"
    />
  </div>
</template>

<style scoped>

</style>
