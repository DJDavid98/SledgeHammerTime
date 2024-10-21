<script setup lang="ts">
import Navbar from '@/Components/CustomNavbar.vue';
import { useIsLightTheme } from '@/hooks/useIsLightTheme';
import { theme } from '@/injection-keys';
import HtContent from '@/Reusable/HtContent.vue';
import { useMomentLocale } from '@/utils/moment';
import { usePage } from '@inertiajs/vue3';
import { provide } from 'vue';

useMomentLocale(usePage().props.app.locale);

const isLightTheme = useIsLightTheme();
provide(theme, { isLightTheme });
</script>

<template>
  <Navbar />

  <HtContent>
    <slot />
  </HtContent>
</template>
