<script setup lang="ts">
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import { faCheck } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

defineProps<{
  id: string,
  label: string,
}>();
</script>

<template>
  <HtFormControlWrap>
    <div class="form-control-checkbox">
      <span class="form-checkbox-input-wrap">
        <slot name="input" />
        <FontAwesomeIcon
          :icon="faCheck"
          class="form-checkbox-check-icon"
          :fixed-width="true"
        />
      </span>
      <label
        class="form-checkbox-label"
        :for="id"
      >{{ label }}</label>
    </div>
    <slot name="message" />
  </HtFormControlWrap>
</template>
