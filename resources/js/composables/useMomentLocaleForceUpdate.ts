import { currentLanguageInject } from '@/injection-keys';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { loadMomentLocale } from '@/utils/moment';
import { ComponentInternalInstance, computed, ComputedRef, inject, watch } from 'vue';

export const useMomentLocaleForceUpdate = (instance: ComponentInternalInstance | null): ComputedRef<string | undefined> => {
  const currentLanguage = inject(currentLanguageInject);
  const momentLocale = computed(() => currentLanguage?.value.languageConfig?.momentLocale || currentLanguage?.value.locale || FALLBACK_LANGUAGE);

  if (typeof window !== 'undefined') {
    watch(momentLocale, (currentMomentLocale) => {
      loadMomentLocale(currentMomentLocale).then(() => {

        instance?.proxy?.$forceUpdate();
      });
    }, { immediate: true });
  }

  return momentLocale;
};
