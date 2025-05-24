import { CurrentLanguageData } from '@/injection-keys';
import { LanguageConfig } from '@/model/language-config';
import { PageProps } from '@/types';
import { DTL } from '@/utils/dtl';
import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { rangeLimitInput } from '@/utils/time';
import { ModelRef, Ref } from 'vue';

export const getAppName = () => import.meta.env.VITE_APP_NAME || 'Laravel';
export const DEVELOPER_NAME = 'WentTheFox';
export const DEVELOPER_URL = 'https://went.tf';
export const DEVELOPER_CONTACT_URL = `${DEVELOPER_URL}/#contact`;
export const DEVELOPER_AVATAR_URL = 'https://gravatar.com/avatar/f341ebe7cfc73b35ff4ec66897b5c30d?size=64';

export const TERMS_UPDATE_DATE = DTL.fromIsoString("2025-05-11T04:15:14.251Z");
export const PRIVACY_UPDATE_DATE = DTL.fromIsoString("2025-05-11T04:15:14.251Z");

export const inputRangeLimitBlurHandlerFactory = (numberRef: Ref<number> | ModelRef<number>) => (e: FocusEvent): void => {
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
