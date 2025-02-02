<script setup lang="ts">
import { formControlId, timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { inject, ref, watch } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedDate = ref('');

const changeDate = () => {
  ts?.changeDateString(selectedDate.value);
};

watch(() => ts?.currentDate, (currentDate) => {
  if (!currentDate) {
    selectedDate.value = '';
    return;
  }

  selectedDate.value = currentDate.value;
}, { immediate: true });
</script>

<template>
  <div>
    <HtInput
      :id="id"
      v-model="selectedDate"
      type="date"
      @change="changeDate"
    />
  </div>
</template>
