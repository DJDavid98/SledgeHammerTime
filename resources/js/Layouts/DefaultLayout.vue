<script setup lang="ts">
import Navbar from '@/Components/CustomNavbar.vue';
import { useCurrentLanguage } from '@/composables/useCurrentLanguage';
import { useIsLightTheme } from '@/composables/useIsLightTheme';
import { useLocalSettings } from '@/composables/useLocalSettings';
import { useSidebarState } from '@/composables/useSidebarState';
import { localSettings, sidebarState, theme } from '@/injection-keys';
import HtContent from '@/Reusable/HtContent.vue';
import { loadMomentLocale } from '@/utils/moment';
import { provide, readonly, watch } from 'vue';

const { locale, languageConfig } = useCurrentLanguage();
watch(locale, (newLocale) => {
  loadMomentLocale(newLocale);
}, {
  immediate: true,
});
watch(languageConfig, (currentLanguageConfig) => {
  if (!document.documentElement) return;

  document.documentElement.dir = currentLanguageConfig?.rtl ? 'rtl' : 'ltr';
}, {
  immediate: true,
});

const isLightTheme = useIsLightTheme();
provide(theme, readonly({ isLightTheme }));

const localSettingsValue = readonly(useLocalSettings());
provide(sidebarState, readonly(useSidebarState(localSettingsValue)));
provide(localSettings, localSettingsValue);
</script>

<template>
  <Navbar />

  <HtContent>
    <slot />
  </HtContent>
</template>
