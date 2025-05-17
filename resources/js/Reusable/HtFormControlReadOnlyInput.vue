<script setup lang="ts">

import { formControlId } from '@/injection-keys';
import { inject, useTemplateRef } from 'vue';

const emit = defineEmits<{
  (e: 'click', ev: MouseEvent): void;
  (e: 'focus', ev: FocusEvent): void;
  (e: 'blur', ev: FocusEvent): void;
  (e: 'keydown', ev: KeyboardEvent): void;
}>();

const props = defineProps<{
  value?: string;
  disabled?: boolean;
  hideSelection?: boolean;
  positionAnchorName?: string;
  type?: 'text' | 'number' | 'date' | 'time' | 'datetime-local' | 'color';
  min?: string | number;
  max?: string | number;
  tabindex?: string | number;
  'class'?: string;
}>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');

const id = inject(formControlId);

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
    :value="value"
    :type="type"
    :class="['input-field', props.class, { 'hide-selection': hideSelection }]"
    :readonly="true"
    :disabled="disabled"
    :min="min"
    :max="max"
    :tabindex="tabindex"
    :style="positionAnchorName ? `anchor-name: ${positionAnchorName}` : undefined"
    @click="emit('click', $event)"
    @focus="emit('focus', $event)"
    @blur="emit('blur', $event)"
    @keydown="emit('keydown', $event)"
  >
</template>
