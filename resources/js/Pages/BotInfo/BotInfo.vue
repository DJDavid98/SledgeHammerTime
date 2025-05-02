<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import AddAppLinks from '@/Pages/AddApp/AddAppLinks.vue';
import { BotCommand } from '@/Pages/BotInfo/BotCommandInfo.vue';
import CommandsReference from '@/Pages/BotInfo/CommandsReference.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { BotCommandTranslation, getBotCommandTranslationKey } from '@/utils/translation';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
  commands: BotCommand[];
  translations: BotCommandTranslation[];
}>();

const flatTranslations = computed(() => props.translations.reduce((acc, translation) => {
  return ({
    ...acc,
    [getBotCommandTranslationKey(translation)]: translation.value,
  });
}, {} as Record<string, string>));
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
              :href="route('settings', route().params)"
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

    <CommandsReference
      :commands="commands"
      :translations="flatTranslations"
    />
  </Layout>
</template>
