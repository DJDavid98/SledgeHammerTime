<script setup lang="ts">
import { currentLanguageInject } from '@/injection-keys';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { faChevronLeft, faChevronRight } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';

withDefaults(defineProps<{
  installType: 'user' | 'guild';
  startIcon: IconDefinition;
  title: string;
  description: string;
  openInNewTab: boolean;
}>(), {
  openInNewTab: false,
});
const currentLanguage = inject(currentLanguageInject);
</script>

<template>
  <a
    :href="route('addBotRedirect', { locale: currentLanguage?.locale ?? FALLBACK_LANGUAGE, installType })"
    :target="openInNewTab ? '_blank' : undefined"
    :rel="openInNewTab ? 'noopener noreferrer' : undefined"
    class="add-link"
  >
    <FontAwesomeIcon
      :icon="startIcon"
      :fixed-width="true"
      class="me-2 add-link-icon"
    />
    <div class="add-link-text">
      <h2 class="add-link-title">{{ title }}</h2>
      <p class="add-link-description">{{ description }}</p>
    </div>
    <FontAwesomeIcon
      :icon="currentLanguage?.languageConfig?.rtl ? faChevronLeft : faChevronRight"
      class="ms-2 add-link-icon"
    />
  </a>
</template>
