<script setup lang="ts">
import DatePickerPopup, { DatePickerPopupApi } from '@/Components/home/pickers/DatePicker.vue';
import { timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { computed, inject, ref } from 'vue';

defineProps<{
  id: string;
}>();

const ts = inject(timestamp);

const selectedDate = computed(() => ts?.currentTimestamp.value.format('LL'));
const showPopup = ref(false);
const datepicker = ref<DatePickerPopupApi>();

const openPopup = () => {
  showPopup.value = true;
  if (ts) {
    datepicker.value?.open(ts.currentTimestamp.value);
    window.requestAnimationFrame(() => {
      datepicker.value?.changeFocus('year', true);
    });
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
    <HtInput
      :id="id"
      v-model="selectedDate"
      :readonly="true"
      @click.prevent="openPopup"
      @focus="openPopup"
    />
    <DatePickerPopup
      ref="datepicker"
      :show="showPopup"
      @close="closePopup"
      @selected="changeDate"
    />
  </div>
</template>
