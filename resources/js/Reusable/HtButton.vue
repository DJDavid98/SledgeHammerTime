<script setup lang="ts">
const props = withDefaults(defineProps<{
  type?: 'button' | 'submit',
  color?: 'primary' | 'secondary',
  'class'?: string,
}>(), {
  type: 'button',
  color: undefined,
  'class': undefined,
});

const emit = defineEmits<{
  (e: 'click', event: MouseEvent): void;
}>();
</script>

<template>
  <button
    :type="type"
    :class="['button', props.class, { [`color-${props.color}`]: props.color }]"
    @click="emit('click', $event)"
  >
    <span class="button-content">
      <span class="button-text">
        <slot />
      </span>
    </span>
  </button>
</template>
