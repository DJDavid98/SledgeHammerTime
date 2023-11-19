<script setup lang="ts">
import { ref } from 'vue';
import { Moment } from 'moment-timezone';
import { pad } from '@/utils/pad';
import Popup from '@/Components/Popup.vue';

const year = ref('');
const month = ref('');
const day = ref('');

defineProps<{
  show: boolean;
}>();

const emit = defineEmits<{
  (e: 'selected', date: string): void
  (e: 'close'): void
}>();

const close = () => {
  emit('close');
};

const select = () => {
  const formattedDate = [year.value, month.value, day.value].map(n => pad(n, 2)).join('-');
  emit('selected', formattedDate); // Emit the selected date back to the MainDatepicker
  close();
};
const open = (initialValue: Moment) => {
  year.value = initialValue.format('YYYY');
  month.value = initialValue.format('M');
  day.value = initialValue.format('D');
};

defineExpose({
  open,
});
</script>


<template>
  <Popup :show="show" @close="close">
    <div class="grid">
      <input v-model="year" type="number" placeholder="Year" />
      <input v-model="month" type="number" placeholder="Month" />
      <input v-model="day" type="number" placeholder="Day" />
    </div>
    <div class="grid">
      <button @click="select" class="mb-0">{{ $t('global.form.select') }}</button>
      <button @click="close" class="mb-0">{{ $t('global.form.cancel') }}</button>
    </div>
  </Popup>
</template>
