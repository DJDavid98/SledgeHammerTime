<script setup lang="ts">
import { formControlId } from '@/injection-keys';
import { faChevronDown } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';

const id = inject(formControlId);
const model = defineModel<unknown>();

const props = defineProps<{
  name?: string,
  'class'?: string,
}>();

const emit = defineEmits<{
  (e: 'keydown', ev: KeyboardEvent): void;
  (e: 'change', ev: Event): void;
}>();
</script>

<template>
  <div class="form-control-select">
    <select
      :id="id"
      v-model="model"
      :name="name"
      :class="['input-text hide-selection', props.class]"
      @keydown="emit('keydown', $event)"
      @change="emit('change', $event)"
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
