<script setup lang="ts">
import DeveloperCredit from '@/Components/sidebar/DeveloperCredit.vue';
import TranslationCredits from '@/Components/sidebar/TranslationCredits.vue';
import { currentLanguageInject, localSettings } from '@/injection-keys';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { reportData } from '@/utils/crowdin';
import { normalizeCredit } from '@/utils/translation';
import { faGithub, faOsi } from '@fortawesome/free-brands-svg-icons';
import { faBan, faCode, faFileContract, faInfo, faLanguage, faUser } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

const currentLanguage = inject(currentLanguageInject);

const translationCredits = computed(() => {
  if (!currentLanguage?.value?.languageConfig?.credits) return null;

  return currentLanguage?.value?.languageConfig?.credits
    .map((c) => normalizeCredit(c, reportData))
    .sort((cr1, cr2) => cr1.displayName.localeCompare(cr2.displayName));
});

const settings = inject(localSettings);
</script>

<template>
  <section class="credits-section">
    <header>
      <FontAwesomeIcon
        :icon="faInfo"
        :fixed-width="true"
      />
      <span class="ms-1">{{ $t('global.sidebar.credits.title') }}</span>
    </header>
    <div class="credits-block">
      <div class="credits-block-icon">
        <FontAwesomeIcon
          :icon="faUser"
          :fixed-width="true"
        />
      </div>
      <div class="credits-block-content">
        <HtTranslate i18n-key="global.sidebar.credits.developedBy">
          <template #1>
            <DeveloperCredit />
          </template>
        </HtTranslate>
      </div>
    </div>
    <div class="credits-block">
      <div class="credits-block-icon">
        <FontAwesomeIcon
          :icon="faCode"
          :fixed-width="true"
        />
      </div>
      <div class="credits-block-content">
        <HtTranslate i18n-key="global.sidebar.credits.using">
          <template #1>
            <ul class="external-libraries-credit">
              <li>
                <HtExternalLink href="https://fontawesome.com/license/free">
                  {{ $t('global.sidebar.credits.fontAwesomeFree') }}
                </HtExternalLink>
              </li>
              <li>
                <HtExternalLink href="https://laravel.com/">
                  {{ $t('global.sidebar.credits.laravel') }}
                </HtExternalLink>
              </li>
              <li>
                <HtExternalLink href="https://vuejs.org/">
                  {{ $t('global.sidebar.credits.vueJs') }}
                </HtExternalLink>
              </li>
              <li v-if="settings?.dateFnsEnabled">
                <HtExternalLink href="https://date-fns.org/">
                  {{ $t('global.sidebar.credits.dateFns') }}
                </HtExternalLink>
              </li>
              <li v-else>
                <HtExternalLink href="https://momentjs.com/">
                  {{ $t('global.sidebar.credits.momentJs') }}
                </HtExternalLink>
              </li>
              <li>
                <HtExternalLink href="https://vue-tippy.netlify.app/">
                  {{ $t('global.sidebar.credits.vueTippy') }}
                </HtExternalLink>
              </li>
            </ul>
          </template>
        </HtTranslate>
      </div>
    </div>
    <div
      v-if="translationCredits && translationCredits.length > 0"
      class="credits-block"
    >
      <div class="credits-block-icon">
        <FontAwesomeIcon
          :icon="faLanguage"
          :fixed-width="true"
        />
      </div>
      <div class="credits-block-content">
        <HtTranslate i18n-key="global.sidebar.credits.translatedBy">
          <template #1>
            <TranslationCredits :credits="translationCredits" />
          </template>
        </HtTranslate>
      </div>
    </div>
    <p class="open-source mb-3">
      <FontAwesomeIcon
        :icon="faOsi"
        class="me-1"
      />
      {{ $t('global.sidebar.credits.openSourceSoftware') }}
    </p>
    <p class="view-source mb-3">
      <HtExternalLink href="https://github.com/WentTheFox/SledgeHammerTime">
        <FontAwesomeIcon
          :icon="faGithub"
          class="me-1"
        />
        {{ $t('global.sidebar.credits.viewSourceCode') }}
      </HtExternalLink>
    </p>
    <p class="not-affiliated mb-3">
      <FontAwesomeIcon
        :icon="faBan"
        class="me-1"
      />
      {{ $t('global.sidebar.credits.notAffiliated') }}
    </p>
    <p>
      <Link :href="route('legal', route().params)">
        <FontAwesomeIcon
          :icon="faFileContract"
          class="me-1"
        />
        {{ $t('global.nav.legal') }}
      </Link>
    </p>
  </section>
</template>
