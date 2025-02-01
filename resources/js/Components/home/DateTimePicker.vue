<script setup lang="ts">
import CustomDateInput from '@/Components/home/inputs/CustomDateInput.vue';
import CustomTimeInput from '@/Components/home/inputs/CustomTimeInput.vue';
import NativeDateInput from '@/Components/home/inputs/NativeDateInput.vue';
import NativeTimeInput from '@/Components/home/inputs/NativeTimeInput.vue';
import TimeZonePicker from '@/Components/home/inputs/TimeZoneInput.vue';
import { localSettings, timestamp } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import { faClockRotateLeft } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';

const ts = inject(timestamp);
const settings = inject(localSettings);
</script>

<template>
  <HtFormControlGroup>
    <HtFormControl
      id="datepicker"
      :label="$t('timestampPicker.picker.label.date')"
    >
      <CustomDateInput v-if="settings?.customInputEnabled" />
      <NativeDateInput v-else />
    </HtFormControl>
    <HtFormControl
      id="timepicker"
      :label="$t('timestampPicker.picker.label.time')"
    >
      <CustomTimeInput v-if="settings?.customInputEnabled" />
      <NativeTimeInput v-else />
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
