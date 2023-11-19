import moment from 'moment/moment';
import { momentLocaleMap } from '@/moment';

export const useMomentLocale = async (locale: string): Promise<void> => {
  if (locale in momentLocaleMap) {
    await momentLocaleMap[locale as keyof typeof momentLocaleMap]();
    moment.locale(locale);
  }
};
