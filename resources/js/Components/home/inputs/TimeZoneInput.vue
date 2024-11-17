<script setup lang="ts">
import TimeZoneInput from '@/Components/TimeZoneInput.vue';
import { timestamp } from '@/injection-keys';
import { computed, inject } from 'vue';

const ts = inject(timestamp);

const changeTimezone = (value: string) => {
  ts?.changeTimezone(value);
};

const currentTimezone = computed(() => ts?.currentTimezone.value);
</script>

<template>
  <TimeZoneInput
    v-if="ts"
    v-model="currentTimezone"
    @change="changeTimezone"
  />
</template>
