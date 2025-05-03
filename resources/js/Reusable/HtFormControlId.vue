<script setup lang="ts">
import { formControlId } from '@/injection-keys';
import { provide } from 'vue';

const props = defineProps<{
  id: string,
}>();

provide(formControlId, props.id);
</script>

<template>
  <slot />
</template>
