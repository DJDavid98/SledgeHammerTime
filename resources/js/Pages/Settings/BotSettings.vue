<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import { UserSettings } from '@/model/user-settings';
import UserSettingsForm from '@/Pages/Settings/UserSettingsForm.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
  userSettings: Array<{
    user: DiscordUserInfoProps,
    settings: Partial<UserSettings>
  }>;
  defaultSettings: UserSettings;
  formatOptions?: string[];
  columnsOptions?: Record<string, string>;
}>();
</script>

<template>
  <Head :title="$t('botSettings.title')" />

  <Layout>
    <HtCard>
      <template #header>
        <h2>{{ $t('botSettings.title') }}</h2>
      </template>

      <p class="mt-1">
        {{ $t('botSettings.description') }}
      </p>
    </HtCard>

    <UserSettingsForm
      v-for="entry in userSettings"
      :key="entry.user.id"
      :entry="entry"
      :default-settings="defaultSettings"
      :format-options="formatOptions"
      :columns-options="columnsOptions"
    />
  </Layout>
</template>
