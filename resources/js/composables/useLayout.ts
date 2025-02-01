import { useIsLightTheme } from '@/composables/useIsLightTheme';
import { useLocalSettings } from '@/composables/useLocalSettings';
import { useSidebarState } from '@/composables/useSidebarState';
import {
  CurrentLanguageData,
  currentLanguageInject,
  localSettings,
  pagePropsInject,
  sidebarState,
  theme,
} from '@/injection-keys';
import { PageProps } from '@/types';
import { computeCurrentLanguage } from '@/utils/app';
import { loadMomentLocale } from '@/utils/moment';
import { router, usePage } from '@inertiajs/vue3';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { onMounted, onUnmounted, provide, readonly, ref, watch } from 'vue';

export const useLayout = () => {
  const pagePropsRef = ref<PageProps>(usePage().props);
  provide(pagePropsInject, pagePropsRef);
  let routerHandlerCleanup: VoidFunction | undefined;
  onMounted(() => {
    routerHandlerCleanup = router.on('success', (event) => {
      pagePropsRef.value = event.detail.page.props;
    });
  });
  onUnmounted(() => {
    routerHandlerCleanup?.();
  });

  const inertiaPage = usePage();
  watch(() => inertiaPage.props, newProps => {
    pagePropsRef.value = newProps;
  }, { immediate: true });

  const currentLanguage = ref<CurrentLanguageData>(computeCurrentLanguage(pagePropsRef.value));
  provide(currentLanguageInject, currentLanguage);
  watch(pagePropsRef, (currentPage) => {
    currentLanguage.value = computeCurrentLanguage(currentPage);
    const { locale, languageConfig } = currentLanguage.value;
    if (document.documentElement) {
      document.documentElement.dir = languageConfig?.rtl ? 'rtl' : 'ltr';
    }

    const momentLocale = languageConfig?.momentLocale ?? locale;
    if (momentLocale) {
      loadMomentLocale(momentLocale);
    }

    const laravelLocale = languageConfig?.laravelLocale ?? locale;
    if (laravelLocale) {
      loadLanguageAsync(laravelLocale);
    }
  }, {
    immediate: true,
  });

  const isLightTheme = useIsLightTheme();
  provide(theme, readonly({ isLightTheme }));

  const localSettingsValue = readonly(useLocalSettings(currentLanguage));
  provide(sidebarState, readonly(useSidebarState(localSettingsValue)));
  provide(localSettings, localSettingsValue);
};
