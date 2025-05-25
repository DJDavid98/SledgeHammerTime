import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { currentLanguageInject } from '@/injection-keys';
import {
  ComponentInternalInstance,
  computed,
  ComputedRef,
  DeepReadonly,
  inject,
  readonly,
  ref,
  watch,
} from 'vue';

const isSsr = typeof window === 'undefined';

export const useDateLibraryLocale = (dtl: DeepReadonly<ComputedRef<DateTimeLibrary>> | undefined, instance: ComponentInternalInstance | null) => {
  const currentLanguage = inject(currentLanguageInject);
  const localeName = computed(() => dtl?.value.getLocaleNameFromLanguageConfig(currentLanguage?.value.locale, currentLanguage?.value.languageConfig));
  const localeRef = ref<DateTimeLibraryLocale | null>(null);

  const loadLocale = (initialName: string, initialLib: DateTimeLibrary): Promise<void> =>
    initialLib.localeLoader(initialName).then(async (value) => {
      if (!dtl?.value) {
        throw new Error('dtl disappeared while loading locale data');
      }
      const localeValue = value;
      if (dtl.value !== initialLib || localeName.value !== initialName) {
        if (localeName.value) {
          // DateTime libraries changed, re-request locale data
          await loadLocale(localeName.value, dtl.value as unknown as DateTimeLibrary);
        }
        return;
      }

      localeRef.value = localeValue;
      if (!isSsr) {
        instance?.proxy?.$forceUpdate();
      }
    });

  watch([localeName, dtl], (watchValues) => {
    const initialName = watchValues[0] as typeof localeName.value;
    const initialLib = watchValues[1] as unknown as DateTimeLibrary;
    if (!initialName || !initialLib) return;

    void loadLocale(initialName, initialLib);
  }, { immediate: true });

  return readonly(localeRef);
};
