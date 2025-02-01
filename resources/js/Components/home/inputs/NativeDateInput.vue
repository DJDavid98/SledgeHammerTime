<script setup lang="ts">
import { formControlId, timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { isoFormattingDateFormat } from '@/utils/time';
import { inject, ref, watch } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedDate = ref('');

const changeDate = () => {
  ts?.changeDateString(selectedDate.value);
};

watch(() => ts?.currentTimestamp, (currentTimestamp) => {
  if (!currentTimestamp) {
    selectedDate.value = '';
    return;
  }

  selectedDate.value = currentTimestamp.value.format(isoFormattingDateFormat);
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
