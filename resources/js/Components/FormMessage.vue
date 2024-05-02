<script setup lang="ts">
defineProps<{
  type: 'error' | 'success';
  message?: string;
}>();
</script>

<template>
  <div v-show="message">
    <p :class="['form-message', type]">
      {{ message }}
    </p>
  </div>
</template>
