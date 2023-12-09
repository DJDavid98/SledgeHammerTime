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
  'en': 'English, US',
  'en-GB': 'English, UK',
  'zh': nativeLocaleNames['zh_CN'],
  'zh-TW': nativeLocaleNames['zh_TW'],
  'pt-BR': nativeLocaleNames['pt_BR'],
  'sr': nativeLocaleNames['sr_Latn'],
};

const sortedLanguages = (Object.entries(LANGUAGES) as [AvailableLanguage, LanguageConfig][]).filter(([key]) => key in languages.value).sort(([a], [b]) => extendedNativeLocaleNames[a].localeCompare(extendedNativeLocaleNames[b]));

const navigateListener = () => {
  searchParams.value = new URLSearchParams(window.location.search);
};
onMounted(router.on('success', navigateListener));
</script>

<template>
  <nav class="container-fluid backdrop sticky">
    <ul>
      <li>
        <Link :href="route('home')" class="brand fs-15">
          <ApplicationLogo />
          <span class="ms-2">{{ appName }}</span>
        </Link>
      </li>
    </ul>
    <ul>
      <li role="list" dir="rtl">
        <a href="#" aria-haspopup="listbox" class="language-link" :dir="languageConfig.rtl ? 'rtl' : 'ltr'">
          <CountryFlag :country="LANGUAGES[locale]?.countryCode.toLowerCase()" />
          <span class="language-name">{{ extendedNativeLocaleNames[locale] }}</span>
        </a>
        <ul role="listbox" class="language-dropdown" dir="ltr">
          <li v-for="[supportedLocale, config] in sortedLanguages">
            <a
                :href="route('home', { locale: supportedLocale })+(searchParams.size > 0 ? `?${searchParams}` : '')"
                class="language-link"
                :dir="config.rtl ? 'rtl' : 'ltr'"
            >
              <CountryFlag :country="config.countryCode.toLowerCase()" />
              <span class="language-name">{{ extendedNativeLocaleNames[supportedLocale] }}</span>
            </a>
          </li>
        </ul>
      </li>
      <template v-if="$page.props.auth.user">
        <li role="list" dir="rtl">
          <a href="#" aria-haspopup="listbox">{{ $page.props.auth.user.name }}</a>
          <ul role="listbox">
            <li>
              <Link :href="route('settings', { locale })">{{ $t('global.nav.botSettings') }}</Link>
            </li>
            <li>
              <Link :href="route('profile.edit', { locale })">{{ $t('global.nav.profile') }}</Link>
            </li>
            <li>
              <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  role="button"
                  class="outline"
              >{{ $t('global.nav.logout') }}
              </Link>
            </li>
          </ul>
        </li>
      </template>

      <template v-else>
        <li>
          <a :href="route('login', { locale })" role="button">{{ $t('global.nav.login') }}</a>
        </li>
      </template>
    </ul>
  </nav>
</template>
