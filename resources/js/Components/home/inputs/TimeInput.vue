<script setup lang="ts">
import TimePickerPopup, { TimePickerPopupApi } from '@/Components/home/pickers/TimePicker.vue';
import { timestamp } from '@/injection-keys';
import { computed, inject, ref } from 'vue';

defineProps<{
  id: string;
}>();

const ts = inject(timestamp);

const selectedDate = computed(() => ts?.currentTimestamp.value.format('LTS'));
const showPopup = ref(false);
const timepicker = ref<TimePickerPopupApi | null>(null);

const openPopup = () => {
  showPopup.value = true;
  if (ts) {
    timepicker.value?.open(ts.currentTimestamp.value);
  }
};

const closePopup = () => {
  showPopup.value = false;
};

const changeTime = (value: string) => {
  ts?.changeTimeString(value);
};
</script>


<template>
  <div>
    <input
      :id="id"
      v-model="selectedDate"
      class="mb-0"
      readonly
      @click="openPopup"
    >
    <TimePickerPopup
      ref="timepicker"
      :show="showPopup"
      @close="closePopup"
      @selected="changeTime"
    />
  </div>
</template>
