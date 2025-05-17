import { currentLanguageInject } from '@/injection-keys';
import { loadDateFnsLocale } from '@/utils/date-fns';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { Locale } from 'date-fns';
import { ComponentInternalInstance, computed, inject, readonly, ref, watch } from 'vue';

export const useDateFnsLocale = (instance: ComponentInternalInstance | null) => {
  const currentLanguage = inject(currentLanguageInject);
  const dateFnsLocale = ref<Locale | undefined>();
  const languageLocale = computed(() => currentLanguage?.value.languageConfig?.dateFnsLocale || currentLanguage?.value.locale || FALLBACK_LANGUAGE);

  if (typeof window !== 'undefined') {
    watch(languageLocale, (currentLanguageLocale) => {
      loadDateFnsLocale(currentLanguageLocale).then((localeData: Locale | undefined) => {

        dateFnsLocale.value = localeData;
        instance?.proxy?.$forceUpdate();
      });
    }, { immediate: true });
  }

  return readonly(dateFnsLocale);
};
