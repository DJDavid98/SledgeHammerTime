<script setup lang="ts">
import { formControlId } from '@/injection-keys';
import { provide } from 'vue';

const props = defineProps<{
  id: string,
  label: string,
}>();

provide(formControlId, props.id);
</script>

<template>
  <div class="form-control-wrap">
    <div class="form-control">
      <label
        class="form-control-label"
        :for="id"
      >{{ label }}</label>
      <slot />
    </div>
    <slot name="message" />
  </div>
</template>
