import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export const useCurrentLanguage = () => {
  const page = usePage();
  const languages = computed(() => page.props.app.languages as Record<string, AvailableLanguage>);
  const locale = computed(() => languages.value[page.props.app.locale]);
  const languageConfig = computed(() => LANGUAGES[locale.value]);
  const supportedLanguages = computed(() => new Set(page.props.app.supportedLanguages));
  const crowdinProjectId = computed(() => page.props.app.crowdinProjectId);

  return {
    locale,
    languages,
    languageConfig,
    supportedLanguages,
    crowdinProjectId,
  };
};
