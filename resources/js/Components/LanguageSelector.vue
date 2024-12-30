<script setup lang="ts">
import CustomFlag from '@/Components/CustomFlag.vue';
import { currentLanguageInject } from '@/injection-keys';
import { LanguageConfig } from '@/model/language-config';
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { faCaretDown, faCaretUp, faGlobe, faLifeRing } from '@fortawesome/free-solid-svg-icons';
import { router } from '@inertiajs/vue3';
import { computed, inject, onMounted, ref } from 'vue';
import nativeLocaleNames from '../../../vendor/laravel-lang/native-locale-names/data/_native.json';

const searchParams = ref<URLSearchParams>(new URLSearchParams(window.location.search));

const currentLanguage = inject(currentLanguageInject);

const extendedNativeLocaleNames: Record<AvailableLanguage, string> = {
  ...nativeLocaleNames,
  'en': 'English, US',
  'en-GB': 'English, UK',
  'zh': nativeLocaleNames['zh_CN'],
  'zh-TW': nativeLocaleNames['zh_TW'],
  'pt-BR': nativeLocaleNames['pt_BR'],
  'sr': nativeLocaleNames['sr_Latn'],
};

const sortedLanguages = computed(() =>
  (Object.entries(LANGUAGES) as [AvailableLanguage, LanguageConfig][])
    .filter(([key, config]) => {
      if (!currentLanguage?.value.languages) return true;
      if (config.laravelLocale) {
        return config.laravelLocale in currentLanguage.value.languages;
      }
      return key in currentLanguage.value.languages;
    })
    .sort(([a], [b]) => extendedNativeLocaleNames[a].localeCompare(extendedNativeLocaleNames[b])),
);

const searchParamsString = computed(() => {
  return searchParams.value.size > 0 ? `?${searchParams.value}` : '';
});

const noTranslationsNeededLocales = new Set(['en', 'en-GB', 'hu']);
const languagesDropdownVisible = ref(false);

const navigateListener = () => {
  searchParams.value = new URLSearchParams(window.location.search);
};
onMounted(router.on('success', navigateListener));
</script>

<template>
  <div class="language-selector">
    <div
      v-if="currentLanguage?.languageConfig"
      class="language-info"
      :dir="currentLanguage.languageConfig.rtl ? 'rtl' : 'ltr'"
    >
      <div class="language-flag">
        <CustomFlag
          :country="currentLanguage.languageConfig.countryCode"
          :custom-flag="currentLanguage.languageConfig.customFlag"
        />
      </div>
      <div class="language-name">
        {{ extendedNativeLocaleNames[currentLanguage.locale] }}
      </div>
    </div>
    <div class="translation-progress" />
    <HtCollapsible
      :visible="languagesDropdownVisible"
      class="language-list"
      :max-height="200"
    >
      <div
        dir="ltr"
      >
        <template v-for="[sortedLocale, config] in sortedLanguages">
          <li
            v-if="sortedLocale !== currentLanguage?.locale"
            :key="sortedLocale"
          >
            <a
              :href="route('home', { locale: sortedLocale })+searchParamsString"
              :class="['language-link', { disabled: !currentLanguage?.supportedLanguages?.has(sortedLocale) }]"
              :dir="config.rtl ? 'rtl' : 'ltr'"
            >
              <span class="language-flag">
                <CustomFlag
                  :country="config.countryCode"
                  :custom-flag="config.customFlag"
                />
              </span>
              <span class="language-name">{{ extendedNativeLocaleNames[sortedLocale] }}</span>
            </a>
          </li>
        </template>
      </div>
    </HtCollapsible>
    <div class="language-controls">
      <HtButton
        :block="true"
        class="change-language-button"
        :icon-start="faGlobe"
        :icon-end="languagesDropdownVisible ? faCaretDown : faCaretUp"
        :justify-center="true"
        :pressed="languagesDropdownVisible"
        @click.prevent="languagesDropdownVisible = !languagesDropdownVisible"
      >
        <span>{{ $t('global.changeLanguage') }}</span>
      </HtButton>
      <HtLinkButton
        v-if="currentLanguage?.locale && !noTranslationsNeededLocales.has(currentLanguage.locale)"
        color="success"
        class="contribute-button"
        :icon-only="true"
        :icon-start="faLifeRing"
        :href="`https://crowdin.com/project/${currentLanguage?.crowdinProjectId}/${currentLanguage?.languageConfig?.crowdinLocale || currentLanguage?.locale}`"
        :external="true"
        :target-blank="true"
      />
    </div>
  </div>
</template>
