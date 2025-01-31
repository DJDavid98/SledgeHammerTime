<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { currentLanguageInject } from '@/injection-keys';
import { getAppName } from '@/utils/app';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { Link } from '@inertiajs/vue3';
import { inject } from 'vue';

const appName = getAppName();
const currentLanguage = inject(currentLanguageInject);
</script>

<template>
  <div class="header">
    <div class="header-left">
      <slot name="left" />
    </div>
    <Link
      :href="route('home', { locale: currentLanguage?.locale ?? FALLBACK_LANGUAGE })"
      class="header-brand"
    >
      <ApplicationLogo :size="10" />
      <span class="header-brand-text">
        {{ appName }}
      </span>
    </Link>
    <div class="header-right">
      <slot name="right" />
    </div>
  </div>
</template>
