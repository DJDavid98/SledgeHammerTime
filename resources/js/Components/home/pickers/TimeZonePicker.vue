<script setup lang="ts">
import { timestamp } from '@/injection-keys';
import { getSortedNormalizedTimezoneNames, getTimezoneValue } from '@/utils/timezone';
import { inject } from 'vue';

defineProps<{
  id: string;
}>();

const ts = inject(timestamp);

const timezones = getSortedNormalizedTimezoneNames().map(getTimezoneValue);

const changeTimezone = (e: Event) => {
  const { target } = e;
  if (target instanceof HTMLSelectElement) {
    ts?.changeTimezone(target.value);
  }
};
</script>

<template>
  <select :id="id" @change="changeTimezone" class="mb-0">
    <option v-for="zone in timezones" :value="zone.value" :selected="zone.value === ts?.currentTimezone.value">
      {{ zone.label }}
    </option>
  </select>
</template>
