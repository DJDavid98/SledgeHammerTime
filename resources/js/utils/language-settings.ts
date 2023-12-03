import { LanguageConfig } from '@/model/language-config';
import localeConfig from '../../../lang/config.json';

export type AvailableLanguage = keyof typeof localeConfig.languages;

type LanguagesConfig = Record<AvailableLanguage, LanguageConfig>;

export const LANGUAGES = localeConfig.languages as LanguagesConfig;
