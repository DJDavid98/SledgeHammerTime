<script setup lang="ts">
import { formControlId, timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { inject, ref, watch } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedDateTime = ref('');

const changeDateTime = () => {
  ts?.changeDateTimeString(selectedDateTime.value);
};

watch(() => [ts?.currentDate, ts?.currentTime], ([currentDate, currentTime]) => {
  if (!currentDate || !currentTime) {
    selectedDateTime.value = '';
    return;
  }

  selectedDateTime.value = currentDate.value + 'T' + currentTime.value;
}, { immediate: true });
</script>

<template>
  <div>
    <HtInput
      :id="id"
      v-model="selectedDateTime"
      type="datetime-local"
      @change="changeDateTime"
    />
  </div>
</template>
