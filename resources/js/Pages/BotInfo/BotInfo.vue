<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import { BotCommand } from '@/Pages/BotInfo/BotCommandInfo.vue';
import BotInfoCard from '@/Pages/BotInfo/BotInfoCard.vue';
import BotShards, { BotShardData } from '@/Pages/BotInfo/BotShards.vue';
import CommandsReference from '@/Pages/BotInfo/CommandsReference.vue';
import { BotCommandTranslation, getBotCommandTranslationKey } from '@/utils/translation';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
  discordAppId: string;
  commands: BotCommand[];
  translations: BotCommandTranslation[];
  shards: BotShardData;
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
    <BotInfoCard :discord-app-id="discordAppId" />

    <BotShards :shards="shards" />

    <CommandsReference
      :commands="commands"
      :translations="flatTranslations"
    />
  </Layout>
</template>
