<script setup lang="ts">
import { formControlId } from '@/injection-keys';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import { provide } from 'vue';

const props = defineProps<{
  id: string,
  label: string,
}>();

provide(formControlId, props.id);
</script>

<template>
  <HtFormControlWrap>
    <div class="form-control">
      <label
        class="form-control-label"
        :for="id"
      >{{ label }}</label>
      <slot />
    </div>
    <slot name="message" />
  </HtFormControlWrap>
</template>
