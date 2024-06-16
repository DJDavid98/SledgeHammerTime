<script setup lang="ts">
import DatePickerPopup, { DatePickerPopupApi } from '@/Components/home/pickers/DatePicker.vue';
import { timestamp } from '@/injection-keys';
import { computed, inject, ref } from 'vue';

defineProps<{
  id: string;
}>();

const ts = inject(timestamp);

const selectedDate = computed(() => ts?.currentTimestamp.value.format('LL'));
const showPopup = ref(false);
const datepicker = ref<DatePickerPopupApi | null>(null);

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
    <input
      :id="id"
      :value="selectedDate"
      class="mb-0"
      readonly
      @click="openPopup"
    >
    <DatePickerPopup
      ref="datepicker"
      :show="showPopup"
      @close="closePopup"
      @selected="changeDate"
    />
  </div>
</template>
