<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';

defineProps<{
    discordUsers: DiscordUserInfoProps[];
}>();
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                    <UpdateProfileInformationForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                    <ConnectedAccounts class="max-w-xl" :discord-users="discordUsers" />
                </div>

                <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
