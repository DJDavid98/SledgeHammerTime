<script setup lang="ts">
import { computed } from 'vue';
import CountryFlag from 'vue-country-flag-next';


const props = withDefaults(defineProps<{
  country: string;
  size?: number;
  customFlag?: boolean;
  altText?: string;
}>(), {
  customFlag: false,
  altText: undefined,
  size: 16,
});

const fontSize = computed(() => props.size / 16);
</script>

<template>
  <template v-if="customFlag">
    <img
      class="flag custom-flag"
      :src="`/flags/${country}.svg`"
      :alt="altText"
      :style="`font-size: ${fontSize}rem`"
    >
  </template>
  <CountryFlag
    v-else
    :country="country.toLowerCase()"
    :alt="altText"
    :style="`font-size: ${fontSize}rem`"
  />
</template>

<style>
.custom-flag {
  background: none;
  margin: 0 -0.9em -0.2em -0.7em;
  transform: scale(0.5);
  max-width: unset;
}
</style>
