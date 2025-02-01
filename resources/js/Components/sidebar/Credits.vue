<script setup lang="ts">
import DeveloperCredit from '@/Components/sidebar/DeveloperCredit.vue';
import TranslationCredits from '@/Components/sidebar/TranslationCredits.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { faGithub, faOsi } from '@fortawesome/free-brands-svg-icons';
import { faBan, faCode, faInfo, faLanguage, faUser } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
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
                <a href="https://fontawesome.com/license/free">{{ $t('global.sidebar.credits.fontAwesomeFree') }}</a>
              </li>
              <li><a href="https://laravel.com/">{{ $t('global.sidebar.credits.laravel') }}</a></li>
              <li><a href="https://vuejs.org/">{{ $t('global.sidebar.credits.vueJs') }}</a></li>
            </ul>
          </template>
        </HtTranslate>
      </div>
    </div>
    <div class="credits-block">
      <div class="credits-block-icon">
        <FontAwesomeIcon
          :icon="faLanguage"
          :fixed-width="true"
        />
      </div>
      <div class="credits-block-content">
        <HtTranslate i18n-key="global.sidebar.credits.translatedBy">
          <template #1>
            <TranslationCredits />
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
      <a
        href="https://github.com/DJDavid98/SledgeHammerTime"
        rel="noopener noreferrer"
        target="_blank"
      >
        <FontAwesomeIcon
          :icon="faGithub"
          class="me-1"
        />
        {{ $t('global.sidebar.credits.viewSourceCode') }}
      </a>
    </p>
    <p class="not-affiliated">
      <FontAwesomeIcon
        :icon="faBan"
        class="me-1"
      />
      {{ $t('global.sidebar.credits.notAffiliated') }}
    </p>
  </section>
</template>
