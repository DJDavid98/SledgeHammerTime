<script setup lang="ts">

import { formControlId } from '@/injection-keys';
import { computed, inject, useTemplateRef } from 'vue';

const emit = defineEmits<{
  (e: 'click', ev: MouseEvent): void;
  (e: 'focus', ev: FocusEvent): void;
  (e: 'blur', ev: FocusEvent): void;
  (e: 'keydown', ev: KeyboardEvent): void;
}>();

const props = defineProps<{
  id?: string;
  readonly?: boolean;
  disabled?: boolean;
  hideSelection?: boolean;
  positionAnchorName?: string;
  type?: 'text' | 'number' | 'date' | 'time' | 'datetime-local';
  min?: string | number;
  max?: string | number;
  tabindex?: string | number;
  'class'?: string;
}>();

const model = defineModel<string | number | null>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');

const providedId = inject(formControlId);

const effectiveId = computed(() => props.id ?? providedId);

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
    :id="effectiveId"
    ref="input-el"
    v-model="model"
    :type="type"
    :class="['input-text', props.class, { 'hide-selection': hideSelection }]"
    :readonly="readonly"
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
