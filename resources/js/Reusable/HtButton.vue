<script setup lang="ts">

import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';

const props = withDefaults(defineProps<{
  type?: 'button' | 'submit',
  color?: 'primary',
  'class'?: string,
  disabled?: boolean,
  loading?: boolean,
}>(), {
  type: 'button',
  color: undefined,
  'class': undefined,
  disabled: false,
  loading: false,
});

const emit = defineEmits<{
  (e: 'click', event: MouseEvent): void;
}>();
</script>

<template>
  <button
    :type="type"
    :class="['button', props.class, { [`color-${props.color}`]: props.color }]"
    :disabled="props.disabled || props.loading"
    @click="emit('click', $event)"
  >
    <span
      v-if="loading"
      class="loading-icon"
    >
      <HtLoadingIndicator size="1em" />
    </span>
    <span class="button-content">
      <span class="button-text">
        <slot />
      </span>
    </span>
  </button>
</template>
