<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';

defineProps<{
    discordUsers: DiscordUserInfoProps[]
}>();
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-100">Connected Accounts</h2>

            <p class="mt-1 text-sm text-gray-400">
                A Hammertime account is going to let you link multiple Discord accounts to be able to manage their resources in one place in the future.
            </p>

            <p class="mt-1 text-sm text-gray-400">
                Below you can find a list of all Discord accounts associated with this HammerTime account.
            </p>


            <DiscordUserInfo v-for="info of discordUsers" v-bind="info" />
        </header>
    </section>
</template>
