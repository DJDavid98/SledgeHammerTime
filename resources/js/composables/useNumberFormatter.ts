import { currentLanguageInject } from '@/injection-keys';
import { computed, inject } from 'vue';

export const useNumberFormatter = () => {
  const currentLanguage = inject(currentLanguageInject);

  return computed(() => {
    return new Intl.NumberFormat(currentLanguage?.value?.locale ?? 'en-US');
  });
};
