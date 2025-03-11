<script setup lang="ts">
import HtFormCombobox, { ComboboxOption } from '@/Reusable/HtFormCombobox.vue';
import { FormSelectApi } from '@/Reusable/HtFormSelect.vue';
import { getTimezoneValue, timezoneNames } from '@/utils/time';
import { useTemplateRef } from 'vue';

const props = defineProps<{
  'class'?: string;
  name?: string;
  tabindex?: string | number;
}>();

const timezones = timezoneNames.map(getTimezoneValue);

const model = defineModel<string>();
const emit = defineEmits<{
  (e: 'change', value: string): void;
  (e: 'focus'): void;
}>();

const formSelectRef = useTemplateRef<FormSelectApi>('form-select');

const changeTimezone = (option: ComboboxOption) => {
  model.value = option.value;
  emit('change', option.value);
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
  <HtFormCombobox
    ref="form-select"
    v-model="model"
    :name="name"
    :class="props.class ?? 'mb-0'"
    :tabindex="tabindex"
    :options="timezones"
    @change="changeTimezone"
    @focus="emit('focus')"
  />
</template>
