<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import { UserSettings } from '@/model/user-settings';
import UserSettingsForm from '@/Pages/Settings/UserSettingsForm.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { Head, Link } from '@inertiajs/vue3';

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
    <HtCard class="app-settings-card">
      <template #header>
        <h2>{{ $t('botSettings.title') }}</h2>
      </template>

      <p class="mt-1 mb-3">
        {{ $t('botSettings.description') }}
      </p>

      <HtAlert
        :closable="false"
        type="info"
      >
        <template #text>
          <p class="mb-3">
            <HtTranslate i18n-key="botSettings.learnMore">
              <template #1="slotProps">
                <Link :href="route('botInfo', route().params)">
                  {{ slotProps.text }}
                </Link>
              </template>
            </HtTranslate>
          </p>
        </template>
      </HtAlert>
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

<style lang="scss">
@use "../../../css/design";

.app-settings-card {
  @include design.content-link-style;
}
</style>
