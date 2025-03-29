<script setup lang="ts">
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';

defineProps<{
  id: string,
  label: string,
  name?: string,
  value?: string,
  checked?: boolean,
  tabindex?: string | number,
  /**
   * For non-sequential radio buttons the tab order gets messed up if actual `<input type="radio">` elements are used
   *
   * Ths can be set to `true` to use `type="checkbox"` instead, which improves the tab behaviour significantly
   * while retaining the visual appearance of radio buttons.
   */
  checkboxes?: boolean,
}>();

const emit = defineEmits<{
  (e: 'change', $event: InputEvent): void;
}>();
</script>

<template>
  <HtFormControlWrap>
    <div class="form-control-radio">
      <span class="form-radio-input-wrap">
        <input
          :id="id"
          :type="checkboxes ? 'checkbox' : 'radio'"
          :name="name"
          :value="value"
          :checked="checked"
          :tabindex="tabindex"
          class="form-radio-input"
          @change.passive="emit('change', $event as InputEvent)"
        >
        <span class="form-radio-select-icon" />
      </span>
      <label
        class="form-radio-label"
        :for="id"
      >{{ label }}</label>
    </div>
    <slot name="message" />
  </HtFormControlWrap>
</template>
