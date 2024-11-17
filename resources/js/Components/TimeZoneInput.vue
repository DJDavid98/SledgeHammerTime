<script setup lang="ts">
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import { getSortedNormalizedTimezoneNames, getTimezoneValue } from '@/utils/time';
import { defineModel } from 'vue';

const props = defineProps<{
  'class'?: string;
  name?: string;
}>();

const timezones = getSortedNormalizedTimezoneNames().map(getTimezoneValue);

const model = defineModel<string>();
const emit = defineEmits<{
  (e: 'change', value: string): void;
}>();

const changeTimezone = (e: Event) => {
  const { target } = e;
  if (target instanceof HTMLSelectElement) {
    model.value = target.value;
    emit('change', target.value);
  }
};
</script>

<template>
  <HtFormSelect
    v-model="model"
    :name="name"
    :class="props.class ?? 'mb-0'"
    @change="changeTimezone"
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
