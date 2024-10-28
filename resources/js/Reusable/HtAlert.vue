<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { faInfo, faTimes, faWarning } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, ComputedRef } from 'vue';

export type AlertType = 'info' | 'warning' | string;

const props = withDefaults(defineProps<{
  type: AlertType;
  closable?: boolean;
}>(), {
  closable: true,
});

const icon: ComputedRef<IconDefinition | null> = computed(() => {
  switch (props.type) {
    case "info":
      return faInfo;
    case "warning":
      return faWarning;
  }
  return null;
});

const emit = defineEmits<{
  (on: 'close'): void;
}>();
</script>

<template>
  <article :class="['alert', type]">
    <div
      v-if="icon"
      class="alert-icon"
    >
      <FontAwesomeIcon
        :icon="icon"
        :fixed-width="true"
      />
    </div>
    <div class="alert-content">
      <div class="alert-title">
        <slot name="title" />
      </div>
      <div class="alert-text">
        <slot name="text" />
      </div>
    </div>
    <div class="alert-close">
      <HtButton
        v-if="closable"
        class="close-button"
        @click.prevent="emit('close')"
      >
        <FontAwesomeIcon :icon="faTimes" />
      </HtButton>
    </div>
  </article>
</template>
