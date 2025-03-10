<script setup lang="ts">
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';

defineProps<{
  id: string,
  label: string,
  name?: string,
  checked: boolean;
}>();

const emit = defineEmits<{
  (e: 'change', event: Event): void;
}>();
</script>

<template>
  <HtFormCheckbox
    :id="id"
    :label="label"
  >
    <template #input>
      <input
        :id="id"
        type="checkbox"
        :checked="checked"
        :name="name"
        class="form-checkbox-input"
        @change="emit('change', $event)"
      >
    </template>
    <template #message>
      <slot name="message" />
    </template>
  </HtFormCheckbox>
</template>
