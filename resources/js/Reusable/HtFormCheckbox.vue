<script setup lang="ts">

import { faCheck } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

defineProps<{
  id: string,
  label: string,
  name?: string,
  checked?: boolean;
}>();

const model = defineModel<boolean>();
</script>

<template>
  <div class="form-control-wrap">
    <div class="form-control-checkbox">
      <span class="form-checkbox-input-wrap">
        <input
          :id="id"
          type="checkbox"
          :checked="checked ?? model"
          :name="name"
          class="form-checkbox-input"
        >
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
  </div>
</template>
