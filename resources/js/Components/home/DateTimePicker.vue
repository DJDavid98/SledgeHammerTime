<script setup lang="ts">
import DatePicker from '@/Components/home/inputs/DateInput.vue';
import TimePicker from '@/Components/home/inputs/TimeInput.vue';
import TimeZonePicker from '@/Components/home/inputs/TimeZoneInput.vue';
import { timestamp } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import { faClockRotateLeft } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';

const ts = inject(timestamp);
</script>

<template>
  <HtFormControlGroup>
    <HtFormControl
      id="datepicker"
      :label="$t('timestampPicker.picker.label.date')"
    >
      <DatePicker />
    </HtFormControl>
    <HtFormControl
      id="timepicker"
      :label="$t('timestampPicker.picker.label.time')"
    >
      <TimePicker />
    </HtFormControl>
    <HtFormControl
      id="timezonepicker"
      :label="$t('timestampPicker.picker.label.timezone')"
    >
      <TimeZonePicker />
    </HtFormControl>
    <div
      v-if="ts"
      class="form-control"
    >
      <HtButton
        :data-tooltip="$t('timestampPicker.picker.tooltip.setToCurrent')"
        class="mt-4 mb-0 secondary outline"
        role="button"
        @click="ts.setCurrentTime"
      >
        <FontAwesomeIcon :icon="faClockRotateLeft" />
      </HtButton>
    </div>
  </HtFormControlGroup>
</template>
