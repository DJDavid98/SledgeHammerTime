<script setup lang="ts">
import CountryFlag from 'vue-country-flag-next';

withDefaults(defineProps<{
  country: string;
  customFlag?: boolean;
  altText?: string;
}>(), {
  customFlag: false,
  altText: undefined,
});
</script>

<template>
  <template v-if="customFlag">
    <img
      class="flag custom-flag"
      :src="`/flags/${country}.svg`"
      :alt="altText"
    >
  </template>
  <CountryFlag
    v-else
    :country="country.toLowerCase()"
    :alt="altText"
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
