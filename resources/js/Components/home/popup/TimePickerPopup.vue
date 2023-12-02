<script setup lang="ts">
import Popup from '@/Components/Popup.vue';
import { pad } from '@/utils/pad';
import { Moment } from 'moment-timezone';
import { ref } from 'vue';

const hours = ref('');
const minutes = ref('');
const seconds = ref('');

defineProps<{
  show: boolean;
}>();

const emit = defineEmits<{
  (e: 'selected', time: string): void
  (e: 'close'): void
}>();

const close = () => {
  emit('close');
};

const select = () => {
  const formattedTime = [hours.value, minutes.value, seconds.value].map(n => pad(n, 2)).join(':');
  emit('selected', formattedTime); // Emit the selected date back to the MainDatepicker
  close();
};
const open = (initialValue: Moment) => {
  hours.value = initialValue.format('H');
  minutes.value = initialValue.format('m');
  seconds.value = initialValue.format('s');
};

export interface TimePickerPopupApi {
  open: typeof open;
}

defineExpose<TimePickerPopupApi>({
  open,
});
</script>


<template>
  <Popup :show="show" @close="close">
    <div class="grid">
      <input v-model="hours" type="number" min="0" max="23" />
      <input v-model="minutes" type="number" min="0" max="59" />
      <input v-model="seconds" type="number" min="0" max="59" />
    </div>
    <div class="grid">
      <button @click="select" class="mb-0">{{ $t('global.form.select') }}</button>
      <button @click="close" class="mb-0 secondary">{{ $t('global.form.cancel') }}</button>
    </div>
  </Popup>
</template>
