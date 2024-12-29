<script setup lang="ts">
import HtFormSelect, { FormSelectApi } from '@/Reusable/HtFormSelect.vue';
import { getSortedNormalizedTimezoneNames, getTimezoneValue } from '@/utils/time';
import { useTemplateRef } from 'vue';

const props = defineProps<{
  'class'?: string;
  name?: string;
  tabindex?: string | number;
}>();

const timezones = getSortedNormalizedTimezoneNames().map(getTimezoneValue);

const model = defineModel<string>();
const emit = defineEmits<{
  (e: 'change', value: string): void;
  (e: 'focus'): void;
}>();

const formSelectRef = useTemplateRef<FormSelectApi>('form-select');

const changeTimezone = (e: Event) => {
  const { target } = e;
  if (target instanceof HTMLSelectElement) {
    model.value = target.value;
    emit('change', target.value);
  }
};

const focus = () => {
  formSelectRef.value?.focus();
};

export interface TimeZoneSelectApi {
  focus: typeof focus;
}

defineExpose<TimeZoneSelectApi>({
  focus,
});
</script>

<template>
  <HtFormSelect
    ref="form-select"
    v-model="model"
    :name="name"
    :class="props.class ?? 'mb-0'"
    :tabindex="tabindex"
    @change="changeTimezone"
    @focus="emit('focus')"
  >
    <option
      v-for="zone in timezones"
      :key="zone.label"
      :value="zone.value"
    >
      {{ zone.label }}
    </option>
  </HtFormSelect>
</template>
