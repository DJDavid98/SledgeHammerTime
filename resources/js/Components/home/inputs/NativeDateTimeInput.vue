<script setup lang="ts">
import { formControlId, timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { isoFormattingDateFormat, isoTimeFormat } from '@/utils/time';
import { inject, ref, watch } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedDateTime = ref('');

const changeDateTime = () => {
  ts?.changeDateTimeString(selectedDateTime.value);
};

watch(() => ts?.currentTimestamp, (currentTimestamp) => {
  if (!currentTimestamp) {
    selectedDateTime.value = '';
    return;
  }

  selectedDateTime.value = currentTimestamp.value.format(isoFormattingDateFormat + 'T' + isoTimeFormat);
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
