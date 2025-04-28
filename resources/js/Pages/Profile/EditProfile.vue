<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import { currentLanguageInject } from '@/injection-keys';
import Layout from '@/Layouts/DefaultLayout.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import LinkAdditionalAccounts from '@/Pages/Profile/Partials/LinkAdditionalAccounts.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { Head } from '@inertiajs/vue3';
import { computed, inject } from 'vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
  discordUsers: DiscordUserInfoProps[];
}>();

const currentLanguage = inject(currentLanguageInject);
const routeLocale = computed(() => currentLanguage?.value.locale ?? FALLBACK_LANGUAGE);
</script>

<template>
  <Head :title="$t('profile.title')" />

  <Layout>
    <HtCard>
      <template #header>
        <h2>{{ $t('profile.title') }}</h2>
      </template>
    </HtCard>

    <UpdateProfileInformationForm />

    <ConnectedAccounts :discord-users="discordUsers" />

    <LinkAdditionalAccounts :locale="routeLocale" />

    <DeleteUserForm />
  </Layout>
</template>
