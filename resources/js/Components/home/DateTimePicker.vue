<script setup lang="ts">
import Button from '@/Components/Button.vue';
import DatePicker from '@/Components/home/pickers/DatePicker.vue';
import TimePicker from '@/Components/home/pickers/TimePicker.vue';
import TimeZonePicker from '@/Components/home/pickers/TimeZonePicker.vue';
import { timestamp } from '@/injection-keys';
import { inject } from 'vue';

const ts = inject(timestamp);
</script>

<template>
  <div class="grid">
    <div>
      <label for="datepicker">{{ $t('timestampPicker.picker.label.date') }}</label>
      <DatePicker id="datepicker" />
    </div>
    <div>
      <label for="timepicker">{{ $t('timestampPicker.picker.label.time') }}</label>
      <TimePicker id="timepicker" />
    </div>
    <div>
      <label for="timezonepicker">{{ $t('timestampPicker.picker.label.timezone') }}</label>
      <TimeZonePicker id="timezonepicker" />
    </div>
    <div>
      <Button
          @click="ts?.setCurrentTime"
          :data-tooltip="$t('timestampPicker.picker.tooltip.setToCurrent')"
          class="mt-4 mb-0 secondary outline"
          role="button"
      >
        ⌚
      </Button>
    </div>
  </div>
</template>
