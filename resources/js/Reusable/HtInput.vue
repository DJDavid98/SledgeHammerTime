<script setup lang="ts">

import { useTemplateRef } from 'vue';

const emit = defineEmits<{
  (e: 'click', ev: MouseEvent): void;
  (e: 'focus', ev: FocusEvent): void;
  (e: 'blur', ev: FocusEvent): void;
  (e: 'keydown', ev: KeyboardEvent): void;
}>();

const props = defineProps<{
  id?: string;
  readonly?: boolean;
  hideSelection?: boolean;
  positionAnchorName?: string;
  type?: 'text' | 'number';
  min?: string | number;
  max?: string | number;
  'class'?: string;
}>();

const model = defineModel<string | number>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');

export interface InputApi {
  focus: () => void;
  select: () => void;
  inputEl: HTMLInputElement | null;
}

defineExpose({
  focus: () => inputRef?.value?.focus(),
  select: () => inputRef?.value?.select(),
  inputEl: inputRef,
});
</script>

<template>
  <input
    :id="id"
    ref="input-el"
    :type="type"
    :value="model"
    :class="['input-text', props.class, { 'hide-selection': hideSelection }]"
    :readonly="readonly"
    :min="min"
    :max="max"
    :style="positionAnchorName ? `anchor-name: ${positionAnchorName}` : undefined"
    @click="emit('click', $event)"
    @focus="emit('focus', $event)"
    @blur="emit('blur', $event)"
    @keydown="emit('keydown', $event)"
  >
</template>
