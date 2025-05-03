<script setup lang="ts">

import { pagePropsInject } from '@/injection-keys';
import AddAppLinks from '@/Pages/AddApp/AddAppLinks.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

const page = inject(pagePropsInject);
const userInfo = computed(() => page?.value?.auth?.user);
</script>

<template>
  <HtCard class="bot-info">
    <template #header>
      <img
        class="bot-info-image"
        src="/useful-links/bot.png"
        alt=""
      >
      <h2>{{ $t('botInfo.heading') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.description') }}
    </p>
    <p class="mb-3">
      <HtTranslate
        v-if="userInfo"
        i18n-key="botInfo.customizeSettingsAuthenticated"
      >
        <template #1="slotProps">
          <Link
            :href="route('settings', route().params)"
            :async="false"
          >
            {{ slotProps.text }}
          </Link>
        </template>
      </HtTranslate>
      <HtTranslate
        v-else
        i18n-key="botInfo.customizeSettingsGuest"
      >
        <template #1="slotProps">
          <a :href="route('login', route().params)">
            {{ slotProps.text }}
          </a>
        </template>
        <template #3="slotProps">
          <a :href="route('settings', route().params)">
            {{ slotProps.text }}
          </a>
        </template>
      </HtTranslate>
    </p>
    <p class="mb-3">
      {{ $t('botInfo.addAppLead') }}
    </p>

    <AddAppLinks
      :horizontal="true"
      :open-in-new-tab="true"
    />
    <p class="mt-3 mb-3">
      {{ $t('botInfo.shareableLink') }}
    </p>
    <HtCopyableText
      :data="route('addBotNoLocale')"
      :monospace="false"
    />
  </HtCard>
</template>
