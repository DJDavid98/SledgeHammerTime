<script setup lang="ts">
import { dateTimeLibraryInject } from '@/injection-keys';
import HtFormCombobox, { FormComboboxApi } from '@/Reusable/HtFormCombobox.vue';
import { ComboboxOption } from '@/utils/combobox';
import { getTimezoneValue } from '@/utils/time';
import { computed, inject, useTemplateRef } from 'vue';

const props = defineProps<{
  'class'?: string;
  name?: string;
  tabindex?: string | number;
}>();


const dtl = inject(dateTimeLibraryInject);
const timezones = computed(() => dtl?.value.timezoneNames.map(getTimezoneValue) ?? []);

const model = defineModel<string>();
const emit = defineEmits<{
  (e: 'change', value: string): void;
  (e: 'focus'): void;
}>();

const formComboboxRef = useTemplateRef<FormComboboxApi>('form-combobox');

const changeTimezone = (option: ComboboxOption) => {
  model.value = option.value;
  emit('change', option.value);
};

const focus = () => {
  formComboboxRef.value?.focus();
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
    ref="form-combobox"
    v-model="model"
    :name="name"
    :class="props.class ?? 'mb-0'"
    :tabindex="tabindex"
    :options="timezones"
    @change="changeTimezone"
    @focus="emit('focus')"
  />
</template>
