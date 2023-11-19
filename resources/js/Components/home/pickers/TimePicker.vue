<script setup lang="ts">
import { computed, inject, ref } from 'vue';
import { timestamp } from '@/injection-keys';
import TimePickerPopup from '@/Components/home/popup/TimePickerPopup.vue';
import { Moment } from 'moment-timezone';

defineProps<{
  id: string;
}>();

const ts = inject(timestamp);

const selectedDate = computed(() => ts?.currentTimestamp.value.format('HH:mm:ss'));
const showPopup = ref(false);
const timepicker = ref<{ open: (initialValue: Moment) => void } | null>(null);

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
    <input :id="id" v-model="selectedDate" @click="openPopup" class="mb-0" readonly />
    <TimePickerPopup :show="showPopup" @close="closePopup" @selected="changeTime" ref="timepicker" />
  </div>
</template>
