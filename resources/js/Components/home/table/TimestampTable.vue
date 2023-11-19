<script setup lang="ts">
import { computed, inject } from 'vue';
import { timestamp } from '@/injection-keys';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import SyntaxDisplay from '@/Components/home/table/SyntaxDisplay.vue';

const ts = inject(timestamp);

const unixTs = computed(() => ts?.currentTimestamp.value.unix());
</script>

<template>
    <figure>
        <table>
            <thead>
                <tr>
                    <th colspan="2">{{ $t('timestampPicker.table.syntaxColumn') }}</th>
                    <th>{{ $t('timestampPicker.table.resultColumn') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2" class="fs-20 text-center">
                        📅
                    </td>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" format="d" />
                    </td>
                    <td>
                        <TimestampPreview :ts="ts?.currentTimestamp" format='L' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" format="D" />
                    </td>
                    <td>
                        <TimestampPreview :ts="ts?.currentTimestamp" format='LL' />
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="fs-20 text-center">
                        🕓
                    </td>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" format="t" />
                    </td>
                    <td>
                        <TimestampPreview :ts="ts?.currentTimestamp" format='LT' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" format="T" />
                    </td>
                    <td>
                        <TimestampPreview :ts="ts?.currentTimestamp" format='LTS' />
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="fs-20 text-center">
                        📅🕓
                    </td>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" format="f" />
                    </td>
                    <td>
                        <TimestampPreview :ts="ts?.currentTimestamp" format='LLL' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" format="F" />
                    </td>
                    <td>
                        <TimestampPreview :ts="ts?.currentTimestamp" format='LLLL' />
                    </td>
                </tr>
                <tr>
                    <td class="fs-20 text-center">
                        👤🕓
                    </td>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" format="R" />
                    </td>
                    <td>
                        <TimestampPreview :ts="ts?.currentTimestamp" :fromNow="true" />
                    </td>
                </tr>
                <tr>
                    <td class="fs-20 text-center">
                        🏷️
                    </td>
                    <td>
                        <SyntaxDisplay :unix-ts="unixTs" />
                    </td>
                    <td>{{ unixTs }}</td>
                </tr>
            </tbody>
        </table>
    </figure>
</template>
