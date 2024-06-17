<script setup lang="ts">
import nativeLocaleNames from '@/../../vendor/laravel-lang/native-locale-names/locales/_native/json.json';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { LanguageConfig } from '@/model/language-config';
import { getAppName } from '@/utils/app';
import { AvailableLanguage, LANGUAGES } from '@/utils/language-settings';
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import CountryFlag from 'vue-country-flag-next';


const searchParams = ref<URLSearchParams>(new URLSearchParams(window.location.search));

const page = usePage();

const locale = computed(() => page.props.app.locale as AvailableLanguage);
const languages = computed(() => page.props.app.languages);
const languageConfig = computed(() => LANGUAGES[locale.value]);
const appName = getAppName();

const extendedNativeLocaleNames: Record<AvailableLanguage, string> = {
  ...nativeLocaleNames,
  'en-US': 'English, US',
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
  <nav class="container-fluid backdrop sticky">
    <ul>
      <li>
        <Link
          :href="route('home')"
          class="brand fs-15"
        >
          <ApplicationLogo />
          <span class="ms-2">{{ appName }}</span>
        </Link>
      </li>
    </ul>
    <ul class="actions-wrapper">
      <li class="p-0">
        <details class="dropdown">
          <summary
            class="language-button"
            :dir="languageConfig.rtl ? 'rtl' : 'ltr'"
          >
            <span class="language-flag">
              <CountryFlag :country="LANGUAGES[locale]?.countryCode.toLowerCase()" />
            </span>
            <span class="language-name">{{ extendedNativeLocaleNames[locale] }}</span>
          </summary>
          <ul
            role="listbox"
            class="language-dropdown"
            dir="ltr"
          >
            <template v-for="[supportedLocale, config] in sortedLanguages">
              <li
                v-if="supportedLocale !== locale"
                :key="supportedLocale"
              >
                <a
                  :href="route('home', { locale: supportedLocale })+(searchParams.size > 0 ? `?${searchParams}` : '')"
                  class="language-link"
                  :dir="config.rtl ? 'rtl' : 'ltr'"
                >
                  <span class="language-flag">
                    <CountryFlag :country="config.countryCode.toLowerCase()" />
                  </span>
                  <span class="language-name">{{ extendedNativeLocaleNames[supportedLocale] }}</span>
                </a>
              </li>
            </template>
          </ul>
        </details>
      </li>
      <li class="p-0">
        <template v-if="$page.props.auth.user">
          <details class="dropdown user-dropdown">
            <summary>
              <span class="user-icon">👤</span>
              <span class="user-name">{{ $page.props.auth.user.name }}</span>
            </summary>
            <ul role="listbox">
              <li>
                <Link :href="route('settings', { locale })">
                  {{ $t('global.nav.botSettings') }}
                </Link>
              </li>
              <li>
                <Link :href="route('profile.edit', { locale })">
                  {{ $t('global.nav.profile') }}
                </Link>
              </li>
              <li>
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  role="button"
                  class="outline"
                >
                  {{ $t('global.nav.logout') }}
                </Link>
              </li>
            </ul>
          </details>
        </template>

        <template v-else>
          <a
            :href="route('login', { locale })"
            role="button"
          >{{ $t('global.nav.login') }}</a>
        </template>
      </li>
    </ul>
  </nav>
</template>
