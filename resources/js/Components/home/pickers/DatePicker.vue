<script setup lang="ts">
import { computed, inject, ref } from 'vue';
import DatePickerPopup from '@/Components/home/popup/DatePickerPopup.vue';
import { timestamp } from '@/injection-keys';
import { Moment } from 'moment-timezone';

defineProps<{
  id: string;
}>();

const ts = inject(timestamp);

const selectedDate = computed(() => ts?.currentTimestamp.value.format('YYYY-MM-DD'));
const showPopup = ref(false);
const datepicker = ref<{ open: (initialValue: Moment) => void } | null>(null);

const openPopup = () => {
  showPopup.value = true;
  if (ts) {
    datepicker.value?.open(ts.currentTimestamp.value);
  }
};

const closePopup = () => {
  showPopup.value = false;
};

const changeDate = (value: string) => {
  ts?.changeDateString(value);
};
</script>


<template>
  <div>
    <input :id="id" v-model="selectedDate" @click="openPopup" class="mb-0" readonly />
    <DatePickerPopup :show="showPopup" @close="closePopup" @selected="changeDate" ref="datepicker" />
  </div>
</template>
