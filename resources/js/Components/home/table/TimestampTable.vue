<script setup lang="ts">
import SyntaxDisplay from '@/Components/home/table/SyntaxDisplay.vue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { timestamp } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtTable from '@/Reusable/HtTable.vue';
import { getDateTimeMoment, isoFormat } from '@/utils/time';
import { faCalendar as faRegularCalendar } from '@fortawesome/free-regular-svg-icons';
import { faCalendar, faClock, faCode, faUserClock } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const ts = inject(timestamp);

const currentTimestamp = computed(() => ts?.currentTimezone.value && getDateTimeMoment(ts?.currentDate.value + ' ' + ts?.currentTime.value, isoFormat, ts.currentTimezone.value));

const unixTs = computed(() => currentTimestamp.value?.unix());
</script>

<template>
  <HtTable :responsive="true">
    <colgroup>
      <col style="width: 3rem">
      <col style="width: 16rem">
    </colgroup>
    <thead>
      <tr>
        <th colspan="2">
          {{ $t('timestampPicker.table.syntaxColumn') }}
        </th>
        <th>{{ $t('timestampPicker.table.resultColumn') }}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          rowspan="2"
          class="text-center"
        >
          <FontAwesomeIcon
            :icon="faCalendar"
            size="2x"
          />
        </td>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            :format="MessageTimestampFormat.SHORT_DATE"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="currentTimestamp"
            :format="MessageTimestampFormat.SHORT_DATE"
          />
        </td>
      </tr>
      <tr>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            :format="MessageTimestampFormat.LONG_DATE"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="currentTimestamp"
            :format="MessageTimestampFormat.LONG_DATE"
          />
        </td>
      </tr>
      <tr>
        <td
          rowspan="2"
          class="text-center"
        >
          <FontAwesomeIcon
            :icon="faClock"
            size="2x"
          />
        </td>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            :format="MessageTimestampFormat.SHORT_TIME"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="currentTimestamp"
            :format="MessageTimestampFormat.SHORT_TIME"
          />
        </td>
      </tr>
      <tr>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            :format="MessageTimestampFormat.LONG_TIME"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="currentTimestamp"
            :format="MessageTimestampFormat.LONG_TIME"
          />
        </td>
      </tr>
      <tr>
        <td
          rowspan="2"
          class="text-center"
        >
          <span class="fa-stack fa-1x">
            <FontAwesomeIcon
              :icon="faRegularCalendar"
              class="fa-stack-2x"
            />
            <FontAwesomeIcon
              :icon="faClock"
              class="fa-stack-1x"
              :transform="{ y: 4.5 }"
            />
          </span>
        </td>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            :format="MessageTimestampFormat.SHORT_FULL"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="currentTimestamp"
            :format="MessageTimestampFormat.SHORT_FULL"
          />
        </td>
      </tr>
      <tr>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            :format="MessageTimestampFormat.LONG_FULL"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="currentTimestamp"
            :format="MessageTimestampFormat.LONG_FULL"
          />
        </td>
      </tr>
      <tr>
        <td class="text-center">
          <FontAwesomeIcon
            :icon="faUserClock"
            size="2x"
          />
        </td>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            :format="MessageTimestampFormat.RELATIVE"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="currentTimestamp"
            :format="MessageTimestampFormat.RELATIVE"
          />
        </td>
      </tr>
      <tr>
        <td class="text-center">
          <FontAwesomeIcon
            :icon="faCode"
            size="2x"
          />
        </td>
        <td>
          <SyntaxDisplay :unix-ts="unixTs" />
        </td>
        <td>{{ unixTs }}</td>
      </tr>
    </tbody>
  </HtTable>
</template>
