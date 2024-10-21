<script setup lang="ts">
withDefaults(defineProps<{
  type?: 'button' | 'submit',
}>(), {
  type: 'button',
});

const emit = defineEmits<{
  (e: 'click', event: MouseEvent): void;
}>();
</script>

<template>
  <button
    :type="type"
    class="button"
    @click="emit('click', $event)"
  >
    <span class="button-text">
      <slot />
    </span>
  </button>
</template>
