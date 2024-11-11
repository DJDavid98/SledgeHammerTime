<script setup lang="ts">

import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';

const props = withDefaults(defineProps<{
  type?: 'button' | 'submit',
  /**
   * Defaults to gray when not provided
   */
  color?: 'primary' | 'success' | 'danger',
  'class'?: string | Record<string, boolean>,
  disabled?: boolean,
  loading?: boolean,
  block?: boolean,
  pressed?: boolean,
  iconOnly?: boolean,
}>(), {
  type: 'button',
  color: undefined,
  'class': undefined,
  disabled: false,
  loading: false,
  block: false,
  pressed: false,
  iconOnly: false,
});

const emit = defineEmits<{
  (e: 'click', event: MouseEvent): void;
}>();
</script>

<template>
  <button
    :type="type"
    :class="['button', props.class, { [`color-${props.color}`]: props.color, block: props.block, pressed: props.pressed,'icon-only': props.iconOnly }]"
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
