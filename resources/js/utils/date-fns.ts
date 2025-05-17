import { dateFnsLocaleMap } from '@/date-fns';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { Locale } from 'date-fns';

const dateFnsLocaleCache: Record<string, Locale> = {};

export const loadDateFnsLocale = async (locale: string): Promise<Locale | undefined> => {
  if (locale === FALLBACK_LANGUAGE) {
    return;
  }

  if (locale in dateFnsLocaleCache) {
    return dateFnsLocaleCache[locale];
  }

  if (!(locale in dateFnsLocaleMap)) {
    console.warn(`No date-fns locale loader found by key ${locale}`);
    return;
  }

  const localeData = await dateFnsLocaleMap[locale as keyof typeof dateFnsLocaleMap]();
  dateFnsLocaleCache[locale] = localeData;

  return localeData;
};
