import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export const useCurrentLanguage = () => {
  const page = usePage();
  const locale = computed(() => page.props.app.locale as AvailableLanguage);
  const languageConfig = computed(() => LANGUAGES[locale.value]);

  return {
    locale,
    languageConfig,
  };
};
