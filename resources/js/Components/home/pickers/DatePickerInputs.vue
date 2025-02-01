<script setup lang="ts">
import HtInput from '@/Reusable/HtInput.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  halveBases?: boolean;
}>(), {
  halveBases: false,
});

const year = defineModel<number>('year', { required: true });
const month = defineModel<number>('month', { required: true });
const date = defineModel<number>('date', { required: true });
const dateInput = defineModel<HTMLInputElement | null>('dateInput');
const monthInput = defineModel<HTMLInputElement | null>('monthInput');
const yearInput = defineModel<HTMLInputElement | null>('yearInput');

const handleYearBlur = inputRangeLimitBlurHandlerFactory(year);
const handleMonthBlur = inputRangeLimitBlurHandlerFactory(month);
const handleDateBlur = inputRangeLimitBlurHandlerFactory(date);

const flexBasisMultiplier = computed(() => props.halveBases ? 0.5 : 1);
</script>

<template>
  <HtInput
    ref="yearInput"
    v-model="year"
    type="number"
    :class="'grid-flex-item flex-basis-' + (40 * flexBasisMultiplier)"
    @blur="handleYearBlur"
  />
  <HtInput
    ref="monthInput"
    v-model="month"
    type="number"
    :class="'grid-flex-item flex-basis-' + (30 * flexBasisMultiplier)"
    min="1"
    max="12"
    @blur="handleMonthBlur"
  />
  <HtInput
    ref="dateInput"
    v-model="date"
    type="number"
    :class="'grid-flex-item flex-basis-' + (30 * flexBasisMultiplier)"
    min="1"
    max="31"
    @blur="handleDateBlur"
  />
</template>
