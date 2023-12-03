<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
  userSettings: Array<{
    user: DiscordUserInfoProps,
    settings: Record<string, string | number | null>
  }>
}>();
</script>

<template>
  <Head :title="$t('botSettings.title')" />

  <Layout>
    <header>
      <h2>{{ $t('botSettings.title') }}</h2>

      <p class="mt-1">{{ $t('botSettings.description') }}</p>
    </header>

    <article v-for="entry in userSettings">
      <DiscordUserInfo v-bind="entry.user" />
      <pre><code>{{ JSON.stringify(entry.settings, null, 4) }}</code></pre>
    </article>
  </Layout>
</template>
