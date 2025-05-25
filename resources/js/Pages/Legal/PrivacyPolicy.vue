<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import LegalHeading from '@/Pages/Legal/LegalHeading.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { DEVELOPER_NAME, DEVELOPER_URL } from '@/utils/app';
import { LegalSectionIds } from '@/utils/legal';
import { Link } from '@inertiajs/vue3';

defineProps<{
  lastUpdated: DateTimeLibraryValue | undefined;
}>();
</script>

<template>
  <HtCard class="legal-card">
    <template #header>
      <LegalHeading
        :id="LegalSectionIds.PRIVACY_POLICY"
        :level="2"
      >
        {{ $t('legal.privacy.heading') }}
      </LegalHeading>
      <p v-if="lastUpdated">
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
        <HtTranslate i18n-key="legal.privacy.operator">
          <template #0>
            <HtExternalLink :href="DEVELOPER_URL">
              {{ DEVELOPER_NAME }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.notAffiliated">
          <template #1>
            <HtExternalLink href="https://discord.com/company">
              <sup>[*]</sup>
            </HtExternalLink>
          </template>
          <template #3>
            <HtExternalLink href="https://en.wikipedia.org/wiki/U_Can%27t_Touch_This">
              <sup>[**]</sup>
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.INFO_COLLECTION"
        :level="3"
      >
        {{ $t('legal.privacy.infoCollection.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.infoCollection.pii') }}
      </p>
      <p>
        {{ $t('legal.privacy.infoCollection.auth') }}
      </p>
      <p>
        {{ $t('legal.privacy.infoCollection.removal') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.LOG_DATA"
        :level="3"
      >
        {{ $t('legal.privacy.logData.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.logData.browserInfo') }}
      </p>
      <p>
        {{ $t('legal.privacy.logData.thirdParty') }}
      </p>
      <p>
        {{ $t('legal.privacy.logData.debugging') }}
      </p>
      <p>
        {{ $t('legal.privacy.logData.noPii') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.TELEMETRY_STATISTICS"
        :level="3"
      >
        {{ $t('legal.privacy.telemetry.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.telemetry.statsCollection') }}
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.telemetry.telemetryOptOut">
          <template #1>
            <Link :href="route('settings', route().params)">
              {{ $t('global.nav.botSettings') }}
            </Link>
          </template>
        </HtTranslate>
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.COOKIES"
        :level="3"
      >
        {{ $t('legal.privacy.cookies.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.cookies.intro') }}
      </p>
      <p>
        {{ $t('legal.privacy.cookies.disable') }}
      </p>
      <p>
        {{ $t('legal.privacy.cookies.session') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.SECURITY"
        :level="3"
      >
        {{ $t('legal.privacy.security.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.security.noGuarantee') }}
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.security.httpsCloudFlare">
          <template #1="slotProps">
            <HtExternalLink href="https://www.cloudflare.com/security-policy/">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
      <p>
        {{ $t('legal.privacy.security.breachNotify') }}
      </p>
    </section>
  </HtCard>
</template>
