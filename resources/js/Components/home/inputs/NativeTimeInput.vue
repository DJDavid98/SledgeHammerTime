<script setup lang="ts">
import { formControlId, timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { inject, ref, watch } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedTime = ref('');

const changeTime = () => {
  ts?.changeTimeString(selectedTime.value);
};

watch(() => ts?.currentTime, (currentTime) => {
  if (!currentTime) {
    selectedTime.value = '';
    return;
  }

  selectedTime.value = currentTime.value;
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
