<script setup lang="ts">

import LegalHeading from '@/Pages/Legal/LegalHeading.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { DEVELOPER_CONTACT_URL } from '@/utils/app';
import { LegalSectionIds } from '@/utils/legal';
</script>

<template>
  <HtCard class="legal-card">
    <template #header>
      <LegalHeading
        :id="LegalSectionIds.CONTACT"
        :level="2"
      >
        {{ $t('legal.contact.heading') }}
      </LegalHeading>
    </template>

    <section class="legal-section">
      <p>
        <HtTranslate i18n-key="legal.contact.whereToContact">
          <template #1="slotProps">
            <HtExternalLink :href="route('discord', route().params)">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
          <template #3="slotProps">
            <HtExternalLink :href="DEVELOPER_CONTACT_URL">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
    </section>
  </HtCard>
</template>
