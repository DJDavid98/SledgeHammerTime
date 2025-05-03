<script setup lang="ts">
import CustomDateInput from '@/Components/home/inputs/CustomDateInput.vue';
import CustomDateTimeInput from '@/Components/home/inputs/CustomDateTimeInput.vue';
import CustomTimeInput from '@/Components/home/inputs/CustomTimeInput.vue';
import NativeDateInput from '@/Components/home/inputs/NativeDateInput.vue';
import NativeDateTimeInput from '@/Components/home/inputs/NativeDateTimeInput.vue';
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
    <template v-if="settings?.combinedInputsEnabled">
      <HtFormControl
        id="datetimepicker"
        :label="$t('timestampPicker.picker.label.dateAndTime')"
      >
        <CustomDateTimeInput v-if="settings?.customInputEnabled" />
        <NativeDateTimeInput v-else />
      </HtFormControl>
    </template>
    <template v-else>
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
    </template>
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
        :title="$t('timestampPicker.picker.tooltip.setToCurrent')"
        class="mt-4 mb-0 secondary outline"
        role="button"
        @click="ts.setCurrentTime"
      >
        <FontAwesomeIcon :icon="faClockRotateLeft" />
      </HtButton>
    </div>
  </HtFormControlGroup>
</template>
