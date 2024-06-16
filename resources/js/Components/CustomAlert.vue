<script setup lang="ts">
withDefaults(defineProps<{
  type: 'info';
  title: string;
  text: string;
  icon?: string;
  closable?: boolean;
}>(), {
  closable: true,
});

const emit = defineEmits<{
  (on: 'close'): void;
}>();
</script>

<template>
  <article :class="['alert', type]">
    <header>
      <button
        v-if="closable"
        class="close-button ms-1 mb-1"
        @click.prevent="emit('close')"
      >
        &times;
      </button>
      <span v-if="icon">{{ icon }}</span>
      {{ title }}
    </header>
    <p>{{ text }}</p>
  </article>
</template>
