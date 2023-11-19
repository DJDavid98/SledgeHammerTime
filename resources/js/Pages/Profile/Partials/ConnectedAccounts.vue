<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';

defineProps<{
    discordUsers: DiscordUserInfoProps[]
}>();
</script>

<template>
    <header>
        <h2>{{ $t('profile.accounts.heading') }}</h2>

        <p class="mt-1">
            {{ $t('profile.accounts.description.0') }}
        </p>

        <p class="mt-1 mb-3">
            {{ $t('profile.accounts.description.1') }}
        </p>
    </header>

    <DiscordUserInfo v-for="info of discordUsers" v-bind="info" />
</template>
