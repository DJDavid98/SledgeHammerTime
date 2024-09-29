<script setup lang="ts">
import TimePickerPopup, { TimePickerPopupApi } from '@/Components/home/pickers/TimePicker.vue';
import { timestamp } from '@/injection-keys';
import { DialMode } from '@/utils/dial';
import moment from 'moment-timezone';
import { computed, inject, ref } from 'vue';

defineProps<{
  id: string;
}>();

const ts = inject(timestamp);

const selectedDate = computed(() => ts?.currentTimestamp.value.format('LTS'));
const showPopup = ref(false);
const timepicker = ref<TimePickerPopupApi>();

const openPopup = () => {
  showPopup.value = true;
  if (ts) {
    const currentTsWithTimezone = moment.tz(ts.currentTimestamp.value, ts.currentTimezone.value);
    // TODO Figure out why `ts.currentTimestamp` does not have a timezone to begin with???
    console.debug('ts.currentTimestamp.value.tz()', ts.currentTimestamp.value.tz());
    timepicker.value?.open(currentTsWithTimezone);
    window.requestAnimationFrame(() => {
      timepicker.value?.changeFocus(DialMode.Hours, true);
    });
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
      @click.prevent="openPopup"
      @focus="openPopup"
    >
    <TimePickerPopup
      ref="timepicker"
      :show="showPopup"
      @close="closePopup"
      @selected="changeTime"
    />
  </div>
</template>
