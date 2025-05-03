<script setup lang="ts">
import HtFormControlId from '@/Reusable/HtFormControlId.vue';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';

withDefaults(defineProps<{
  id: string,
  label: string,
  comboBox?: boolean,
}>(), {
  comboBox: false,
});
</script>

<template>
  <HtFormControlWrap :combo-box="comboBox">
    <HtFormControlId :id="id">
      <div class="form-control">
        <label
          class="form-control-label"
          :for="id"
        >{{ label }}</label>
        <slot />
      </div>
      <slot name="message" />
    </HtFormControlId>
  </HtFormControlWrap>
</template>
