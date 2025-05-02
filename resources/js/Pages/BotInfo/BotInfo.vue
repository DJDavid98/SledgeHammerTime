<script setup lang="ts">
import { currentLanguageInject } from '@/injection-keys';
import Layout from '@/Layouts/DefaultLayout.vue';
import AddAppLinks from '@/Pages/AddApp/AddAppLinks.vue';
import BotCommandInfo, { BotCommand } from '@/Pages/BotInfo/BotCommandInfo.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { Head, Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

defineProps<{
  commands: BotCommand[];
}>();

const currentLanguage = inject(currentLanguageInject);
const routeLocale = computed(() => currentLanguage?.value.locale ?? FALLBACK_LANGUAGE);
</script>

<template>
  <Head :title="$t('botInfo.heading')" />

  <Layout>
    <HtCard class="bot-info">
      <template #header>
        <h2>{{ $t('botInfo.heading') }}</h2>
      </template>

      <p class="mb-3">
        {{ $t('botInfo.description') }}
      </p>
      <p class="mb-3">
        <HtTranslate i18n-key="botInfo.customizeSettings">
          <template #1="slotProps">
            <Link
              :href="route('settings', { locale: routeLocale })"
              :async="false"
            >
              {{ slotProps.text }}
            </Link>
          </template>
        </HtTranslate>
      </p>
      <p class="mb-3">
        {{ $t('botInfo.addBotLead') }}
      </p>

      <AddAppLinks
        :horizontal="true"
        :open-in-new-tab="true"
      />
    </HtCard>
    <HtCard>
      <template #header>
        <h2>{{ $t('botInfo.commandsReference.title') }}</h2>
      </template>

      <p class="mb-3">
        {{ $t('botInfo.commandsReference.description') }}
      </p>

      <BotCommandInfo
        v-for="command in commands"
        :key="command.id"
        :command="command"
      />
    </HtCard>
  </Layout>
</template>
