<script setup lang="ts">
import { getSortedNormalizedTimezoneNames, getTimezoneValue } from '@/utils/time';
import { defineModel } from 'vue';

defineProps<{
  id: string;
  className?: string;
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
  <select
    :id="id"
    :name="name"
    :class="className ?? 'mb-0'"
    @change="changeTimezone"
  >
    <option
      v-for="zone in timezones"
      :key="zone.label"
      :value="zone.value"
      :selected="zone.value === model"
    >
      {{ zone.label }}
    </option>
  </select>
</template>
