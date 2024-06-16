<script setup lang="ts">
import { computed } from 'vue';

export type AlertType = 'info'

const props = withDefaults(defineProps<{
  type: AlertType;
  title: string;
  text: string;
  closable?: boolean;
}>(), {
  closable: true,
});

const iconsMap: Partial<Record<AlertType, string>> = {
  info: 'ℹ️',
};

const icon = computed(() => iconsMap[props.type]);

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
