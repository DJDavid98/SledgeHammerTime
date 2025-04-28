<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import HtCard from '@/Reusable/HtCard.vue';

defineProps<{
  discordUsers: DiscordUserInfoProps[]
}>();
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('profile.accounts.heading') }}</h2>
    </template>

    <p class="mt-1">
      {{ $t('profile.accounts.description.0') }}
    </p>

    <p class="mt-1 mb-3">
      {{ $t('profile.accounts.description.1') }}
    </p>

    <DiscordUserInfo
      v-for="info of discordUsers"
      v-bind="info"
      :key="info.id"
    />
  </HtCard>
</template>
