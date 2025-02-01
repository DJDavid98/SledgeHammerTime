<script setup lang="ts">
import { formControlId, timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { isoTimeFormat } from '@/utils/time';
import { inject, ref, watch } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedTime = ref('');

const changeTime = () => {
  ts?.changeTimeString(selectedTime.value);
};

watch(() => ts?.currentTimestamp, (currentTimestamp) => {
  if (!currentTimestamp) {
    selectedTime.value = '';
    return;
  }

  selectedTime.value = currentTimestamp.value.format(isoTimeFormat);
}, { immediate: true });
</script>

<template>
  <div>
    <HtInput
      :id="id"
      v-model="selectedTime"
      type="time"
      @change="changeTime"
    />
  </div>
</template>
