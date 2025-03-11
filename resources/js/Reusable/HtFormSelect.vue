<script setup lang="ts">
import { formControlId } from '@/injection-keys';
import { faChevronDown } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject, useTemplateRef } from 'vue';

const id = inject(formControlId);
const model = defineModel<unknown>();

const props = defineProps<{
  name?: string,
  'class'?: string,
}>();

const emit = defineEmits<{
  (e: 'keydown', ev: KeyboardEvent): void;
  (e: 'change', ev: Event): void;
  (e: 'focus', ev: FocusEvent): void;
}>();

const selectRef = useTemplateRef<HTMLSelectElement>('select-el');

const focus = () => {
  selectRef.value?.focus();
};

export interface FormSelectApi {
  focus: typeof focus;
}

defineExpose<FormSelectApi>({
  focus,
});
</script>

<template>
  <div class="form-control-select">
    <select
      :id="id"
      ref="select-el"
      v-model="model"
      :name="name"
      :class="['form-select-input input-text hide-selection', props.class]"
      @keydown="emit('keydown', $event)"
      @change="emit('change', $event)"
      @focus.passive="emit('focus', $event)"
    >
      <slot />
    </select>
    <span class="form-select-icon">
      <FontAwesomeIcon
        :icon="faChevronDown"
        :fixed-width="true"
      />
    </span>
  </div>
</template>
