<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
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
    <header>
      <h2>{{ $t('profile.title') }}</h2>
    </header>

    <article>
      <UpdateProfileInformationForm />
    </article>

    <article>
      <ConnectedAccounts :discord-users="discordUsers" />
    </article>

    <article>
      <DeleteUserForm />
    </article>
  </Layout>
</template>
