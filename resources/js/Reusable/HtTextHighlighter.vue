<script setup lang="ts">
import { normalizeQueryValue } from '@/utils/combobox';
import { computed } from 'vue';

const props = defineProps<{
  text: string;
  query: string | null;
}>();

const normalizedQuery = computed(() => props.query ? normalizeQueryValue(props.query) : '');
const splitInput = computed(() => (
  /^[a-z\d/_]+$/i.test(normalizedQuery.value)
    ? props.text.replace(new RegExp(`(${normalizedQuery.value.replace(/(.)/g, '$1_?')})`, 'ig'), '|$1|').split(/\|+/g)
    : null
));
</script>

<template>
  <template v-if="splitInput">
    <template
      v-for="(part, i) in splitInput"
      :key="i"
    >
      <template v-if="i % 2 === 0">
        {{ part }}
      </template>
      <mark v-else>{{ part }}</mark>
    </template>
  </template>
  <template v-else>
    {{ text }}
  </template>
</template>
