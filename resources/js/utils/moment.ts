import { momentLocaleMap } from '@/moment';
import moment from 'moment-timezone';

export const loadMomentLocale = async (locale: string): Promise<void> => {
  if (!(locale in momentLocaleMap)) {
    console.warn(`No moment locale loader found by key ${locale}`);
    return;
  }
  await momentLocaleMap[locale as keyof typeof momentLocaleMap]();
  moment.locale(locale);
};
