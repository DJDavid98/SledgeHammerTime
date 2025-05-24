<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import LegalHeading from '@/Pages/Legal/LegalHeading.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { LegalSectionIds } from '@/utils/legal';

defineProps<{
  lastUpdated: DateTimeLibraryValue;
}>();
</script>

<template>
  <HtCard class="legal-card">
    <template #header>
      <LegalHeading
        :id="LegalSectionIds.TERMS_AND_CONDITIONS"
        :level="2"
      >
        {{ $t('legal.terms.heading') }}
      </LegalHeading>
      <p>
        <HtTranslate i18n-key="legal.lastUpdated">
          <template #1>
            <TimestampPreview
              :ts="lastUpdated"
              :format="MessageTimestampFormat.LONG_DATE"
            />
          </template>
        </HtTranslate>
      </p>
    </template>

    <section class="legal-section">
      <p>
        <ht-translate i18n-key="legal.terms.license">
          <template #1="slotProps">
            <HtExternalLink href="https://mit-license.org/">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
        </ht-translate>
      </p>
      <p>
        {{ $t('legal.terms.noAbuse') }}
      </p>
      <p>
        {{ $t('legal.terms.fuckWeb3') }}
      </p>
      <p>
        {{ $t('legal.terms.accessRevocation') }}
      </p>
    </section>
  </HtCard>
</template>
