<script setup lang="ts">
import SyntaxDisplay from '@/Components/home/table/SyntaxDisplay.vue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { timestamp } from '@/injection-keys';
import HtTable from '@/Reusable/HtTable.vue';
import { faCalendar as faRegularCalendar } from '@fortawesome/free-regular-svg-icons';
import { faCalendar, faClock, faCode, faUserClock } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const ts = inject(timestamp);

const unixTs = computed(() => ts?.currentTimestamp.value.unix());
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
            format="d"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="ts?.currentTimestamp"
            format="L"
          />
        </td>
      </tr>
      <tr>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            format="D"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="ts?.currentTimestamp"
            format="LL"
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
            format="t"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="ts?.currentTimestamp"
            format="LT"
          />
        </td>
      </tr>
      <tr>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            format="T"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="ts?.currentTimestamp"
            format="LTS"
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
            format="f"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="ts?.currentTimestamp"
            format="LLL"
          />
        </td>
      </tr>
      <tr>
        <td>
          <SyntaxDisplay
            :unix-ts="unixTs"
            format="F"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="ts?.currentTimestamp"
            format="LLLL"
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
            format="R"
          />
        </td>
        <td>
          <TimestampPreview
            :ts="ts?.currentTimestamp"
            :from-now="true"
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
