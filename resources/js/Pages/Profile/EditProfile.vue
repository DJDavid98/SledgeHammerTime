<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { getHtmlTitle } from '@/utils/app';
import { Head } from '@inertiajs/vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
  discordUsers: DiscordUserInfoProps[];
}>();
</script>

<template>
  <Head :title="getHtmlTitle($t('profile.title'))" />

  <Layout>
    <HtCard>
      <template #header>
        <h2>{{ $t('profile.title') }}</h2>
      </template>
    </HtCard>

    <UpdateProfileInformationForm />

    <ConnectedAccounts :discord-users="discordUsers" />

    <DeleteUserForm />
  </Layout>
</template>
