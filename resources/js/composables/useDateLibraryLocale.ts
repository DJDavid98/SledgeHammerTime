import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { currentLanguageInject } from '@/injection-keys';
import { DTL } from '@/utils/dtl';
import { ComponentInternalInstance, computed, inject, readonly, ref, watch } from 'vue';

const isSsr = typeof window === 'undefined';

export const useDateLibraryLocale = (instance: ComponentInternalInstance | null) => {
  const currentLanguage = inject(currentLanguageInject);
  const localeName = computed(() => DTL.getLocaleNameFromLanguageConfig(currentLanguage?.value.locale, currentLanguage?.value.languageConfig));
  const localeRef = ref<DateTimeLibraryLocale | null>(null);

  watch(localeName, (currentLocaleName) => {
    DTL.localeLoader(currentLocaleName).then((value) => {

      localeRef.value = value;
      if (!isSsr) {
        instance?.proxy?.$forceUpdate();
      }
    });
  }, { immediate: true });

  return readonly(localeRef);
};
