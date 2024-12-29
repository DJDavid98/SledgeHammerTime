<script setup lang="ts">
import TimePickerPopup, { TimePickerPopupApi } from '@/Components/home/pickers/TimePicker.vue';
import { formControlId, positionAnchor, timestamp } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { DialMode } from '@/utils/dial';
import moment from 'moment-timezone';
import { computed, inject, provide, ref } from 'vue';

const ts = inject(timestamp);
const id = inject(formControlId);

const selectedTime = computed(() => ts?.currentTimestamp.value.format('LTS'));
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

const positionAnchorName = '--time-input';
provide(positionAnchor, positionAnchorName);
</script>


<template>
  <div>
    <HtInput
      :id="id"
      v-model="selectedTime"
      :readonly="true"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @focus="openPopup"
    />
    <TimePickerPopup
      ref="timepicker"
      :show="showPopup"
      @close="closePopup"
      @selected="changeTime"
    />
  </div>
</template>
