<script setup lang="ts">
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';

defineProps<{
  id: string,
  label: string,
  name?: string,
}>();

const model = defineModel<boolean>({ required: true });
</script>

<template>
  <HtFormCheckbox
    :id="id"
    :label="label"
  >
    <template #input>
      <input
        :id="id"
        v-model="model"
        type="checkbox"
        :name="name"
        class="form-checkbox-input"
      >
    </template>
    <template #message>
      <slot name="message" />
    </template>
  </HtFormCheckbox>
</template>
