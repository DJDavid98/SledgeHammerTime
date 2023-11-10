<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <Head title="Timestamp Picker" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-slate-950 selection:bg-indigo-600 selection:text-white"
    >
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <template v-if="$page.props.auth.user">
                <Link
                    :href="route('settings')"
                    class="font-semibold text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500"
                >Settings
                </Link>
                <a
                    :href="route('logout')"
                    class="font-semibold text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500"
                >Log out</a>
            </template>

            <template v-else>
                <a
                    href="/oauth/redirect/discord"
                    class="font-semibold text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500"
                >Log in</a>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center text-gray-400">
                <figure class="flex items-center">
                    <ApplicationLogo class="w-10 h-10 me-3" />
                    <span class="font-bold text-[1.5em]">HammerTime</span>
                </figure>
            </div>
        </div>
    </div>
</template>
