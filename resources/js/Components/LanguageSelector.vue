<script setup lang="ts">
import CustomFlag from '@/Components/CustomFlag.vue';
import { CROWDIN_URL } from '@/config';
import { LanguageConfig } from '@/model/language-config';
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { faCaretDown, faCaretUp, faGlobe, faLifeRing } from '@fortawesome/free-solid-svg-icons';
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import nativeLocaleNames from '../../../vendor/laravel-lang/native-locale-names/locales/_native/json.json';

const searchParams = ref<URLSearchParams>(new URLSearchParams(window.location.search));

const page = usePage();

const locale = computed(() => page.props.app.locale as AvailableLanguage);
const languages = computed(() => page.props.app.languages);
const supportedLanguages = computed(() => new Set(page.props.app.supportedLanguages));
const languageConfig = computed(() => LANGUAGES[locale.value]);

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
    .filter(([key]) => key in languages.value)
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
      class="language-info"
      :dir="languageConfig.rtl ? 'rtl' : 'ltr'"
    >
      <div class="language-flag">
        <CustomFlag
          :country="languageConfig.countryCode"
          :custom-flag="languageConfig.customFlag"
        />
      </div>
      <div class="language-name">
        {{ extendedNativeLocaleNames[locale] }}
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
            v-if="sortedLocale !== locale"
            :key="sortedLocale"
          >
            <Link
              :href="route('home', { locale: sortedLocale })+searchParamsString"
              :class="['language-link', { disabled: !supportedLanguages.has(sortedLocale) }]"
              :dir="config.rtl ? 'rtl' : 'ltr'"
            >
              <span class="language-flag">
                <CustomFlag
                  :country="config.countryCode"
                  :custom-flag="config.customFlag"
                />
              </span>
              <span class="language-name">{{ extendedNativeLocaleNames[sortedLocale] }}</span>
            </Link>
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
        v-if="!noTranslationsNeededLocales.has(locale)"
        color="success"
        class="contribute-button"
        :icon-only="true"
        :icon-start="faLifeRing"
        :href="`${CROWDIN_URL}/${languageConfig?.crowdinLocale || locale}`"
        :external="true"
        :target-blank="true"
      />
    </div>
  </div>
</template>
