<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { Head } from '@inertiajs/vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
  discordUsers: DiscordUserInfoProps[];
}>();
</script>

<template>
  <Head :title="$t('profile.title')" />

  <Layout>
    <HtCard>
      <h2>{{ $t('profile.title') }}</h2>
    </HtCard>

    <HtCard>
      <UpdateProfileInformationForm />
    </HtCard>

    <HtCard>
      <ConnectedAccounts :discord-users="discordUsers" />
    </HtCard>

    <HtCard>
      <DeleteUserForm />
    </HtCard>
  </Layout>
</template>
