import { CurrentLanguageData } from '@/injection-keys';
import { LanguageConfig } from '@/model/language-config';
import { PageProps } from '@/types';
import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { rangeLimitInput } from '@/utils/time';
import { Ref } from 'vue';

export const getAppName = () => import.meta.env.VITE_APP_NAME || 'Laravel';

export const inputRangeLimitBlurHandlerFactory = (numberRef: Ref<number>) => (e: FocusEvent): void => {
  const limitedValue = rangeLimitInput(e.target);
  if (limitedValue === numberRef.value)
    return;

  numberRef.value = limitedValue;
};

export const computeCurrentLanguage = (page: PageProps): CurrentLanguageData => {
  const languages = page.app.languages as Record<string, AvailableLanguage>;
  const locale = languages[page.app.locale];
  const languageConfig: LanguageConfig | undefined = LANGUAGES[locale];
  const supportedLanguages = new Set(page.app.supportedLanguages);
  const crowdinProjectId = page.app.crowdinProjectId;

  return {
    locale,
    languages,
    languageConfig,
    supportedLanguages,
    crowdinProjectId,
  };
};
