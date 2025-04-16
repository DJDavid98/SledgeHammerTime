<script setup lang="ts">
const props = defineProps<{
  type?: 'error' | 'success';
  'class'?: string;
  message?: string;
}>();
</script>

<template>
  <div v-show="message">
    <p :class="['form-message', type, props.class]">
      {{ message }}
    </p>
  </div>
</template>
