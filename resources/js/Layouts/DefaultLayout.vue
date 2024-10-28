<script setup lang="ts">
import Navbar from '@/Components/CustomNavbar.vue';
import { useIsLightTheme } from '@/hooks/useIsLightTheme';
import { useSidebarState } from '@/hooks/useSidebarState';
import { sidebarState, theme } from '@/injection-keys';
import HtContent from '@/Reusable/HtContent.vue';
import { useMomentLocale } from '@/utils/moment';
import { usePage } from '@inertiajs/vue3';
import { provide } from 'vue';

useMomentLocale(usePage().props.app.locale);

const isLightTheme = useIsLightTheme();
provide(theme, { isLightTheme });

provide(sidebarState, useSidebarState());
</script>

<template>
  <Navbar />

  <HtContent>
    <slot />
  </HtContent>
</template>
