<script setup lang="ts">
import { formControlId } from '@/injection-keys';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import { provide } from 'vue';

const props = withDefaults(defineProps<{
  id: string,
  label: string,
  comboBox?: boolean,
}>(), {
  comboBox: false,
});

provide(formControlId, props.id);
</script>

<template>
  <HtFormControlWrap :combo-box="comboBox">
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
