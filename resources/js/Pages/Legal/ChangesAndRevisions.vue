<script setup lang="ts">
import LegalHeading from '@/Pages/Legal/LegalHeading.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { LegalSectionIds } from '@/utils/legal';
</script>

<template>
  <HtCard class="legal-card">
    <template #header>
      <LegalHeading
        :id="LegalSectionIds.CHANGES"
        :level="2"
      >
        {{ $t('legal.changes.heading') }}
      </LegalHeading>
    </template>

    <p class="mb-2">
      {{ $t('legal.changes.effectiveFrom') }}
    </p>
    <p class="mb-2">
      {{ $t('legal.changes.rightToChange') }}
    </p>
    <p class="mb-2">
      {{ $t('legal.changes.willNotify') }}
    </p>
  </HtCard>
</template>

<style scoped>

</style>
