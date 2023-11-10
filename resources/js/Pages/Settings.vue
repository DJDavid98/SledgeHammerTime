<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';

defineProps<{
    userSettings: Array<{
        user: DiscordUserInfoProps,
        settings: Record<string, string | number | null>
    }>
}>();
</script>

<template>
    <Head title="Bot Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">Bot Settings</h2>

            <p class="mt-1 text-sm text-gray-400">
                Below you can see your current settings in the HammerTime Bot for each connected account.
            </p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="entry in userSettings" class="p-6 text-gray-100">
                        <DiscordUserInfo v-bind="entry.user" />
                        <pre><code class="font-mono">{{ JSON.stringify(entry.settings, null, 4) }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
