<script setup lang="ts">
import { formControlId } from '@/injection-keys';
import { provide } from 'vue';

const props = defineProps<{
  dir?: 'ltr' | 'rtl';
  class?: string;
  id?: string;
}>();

if (props.id) {
  provide(formControlId, props.id);
}
</script>

<template>
  <fieldset
    :class="['form-input-group', props.class]"
    :dir="dir"
  >
    <slot />
  </fieldset>
</template>
