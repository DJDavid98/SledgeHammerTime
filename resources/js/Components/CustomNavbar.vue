<script setup lang="ts">
import nativeLocaleNames from '@/../../vendor/laravel-lang/native-locale-names/locales/_native/json.json';
import CustomFlag from '@/Components/CustomFlag.vue';
import UserInfo from '@/Components/UserInfo.vue';
import { sidebarState } from '@/injection-keys';
import { LanguageConfig } from '@/model/language-config';
import HtButton from '@/Reusable/HtButton.vue';
import HtHeader from '@/Reusable/HtHeader.vue';
import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { faBars } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { router, usePage } from '@inertiajs/vue3';
import { computed, inject, onMounted, ref } from 'vue';

const searchParams = ref<URLSearchParams>(new URLSearchParams(window.location.search));

const page = usePage();

const locale = computed(() => page.props.app.locale as AvailableLanguage);
const languages = computed(() => page.props.app.languages);
const supportedLanguages = computed(() => new Set(page.props.app.supportedLanguages));
const languageConfig = computed(() => LANGUAGES[locale.value]);
const sbState = inject(sidebarState);

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

const navigateListener = () => {
  searchParams.value = new URLSearchParams(window.location.search);
};
onMounted(router.on('success', navigateListener));
</script>

<template>
  <HtHeader>
    <template #right>
      <template v-if="sbState?.isOnLeft.value === false">
        <HtButton @click="sbState.isOnLeft.value = true">
          <FontAwesomeIcon :icon="faBars" />
        </HtButton>
      </template>
      <ul class="actions-wrapper">
        <li class="p-0">
          <details class="dropdown">
            <summary
              class="language-button"
              :dir="languageConfig.rtl ? 'rtl' : 'ltr'"
            >
              <span class="language-flag">
                <CustomFlag
                  :country="LANGUAGES[locale]?.countryCode"
                  :custom-flag="LANGUAGES[locale]?.customFlag"
                />
              </span>
              <span class="language-name">{{ extendedNativeLocaleNames[locale] }}</span>
            </summary>
            <ul
              role="listbox"
              class="language-dropdown"
              dir="ltr"
            >
              <template v-for="[sortedLocale, config] in sortedLanguages">
                <li
                  v-if="sortedLocale !== locale"
                  :key="sortedLocale"
                >
                  <a
                    :href="route('home', { locale: sortedLocale })+(searchParams.size > 0 ? `?${searchParams}` : '')"
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
                  </a>
                </li>
              </template>
            </ul>
          </details>
        </li>
        <li class="p-0">
          <UserInfo />
        </li>
      </ul>
    </template>
    <template #left>
      <template v-if="sbState?.isOnLeft.value === true">
        <HtButton @click="sbState.isOnLeft.value = false">
          <FontAwesomeIcon :icon="faBars" />
        </HtButton>
      </template>
    </template>
  </HtHeader>
</template>
