import { currentLanguageInject } from '@/injection-keys';
import { loadMomentLocale } from '@/utils/moment';
import { ComponentInternalInstance, computed, ComputedRef, inject, watch } from 'vue';

export const useMomentLocaleForceUpdate = (instance: ComponentInternalInstance): ComputedRef<string | undefined> => {
  const currentLanguage = inject(currentLanguageInject);
  const momentLocale = computed(() => currentLanguage?.value.languageConfig?.momentLocale || currentLanguage?.value.locale || 'en');
  watch(momentLocale, (currentMomentLocale) => {
    loadMomentLocale(currentMomentLocale).then(() => {
      instance.proxy.$forceUpdate();
    });
  });

  return momentLocale;
};
