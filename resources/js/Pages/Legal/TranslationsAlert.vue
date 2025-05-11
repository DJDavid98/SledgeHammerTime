<script setup lang="ts">
import { currentLanguageInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { Link } from '@inertiajs/vue3';
import { inject } from 'vue';

defineProps<{
  fallbackLocale: string;
}>();

const currentLanguage = inject(currentLanguageInject);
</script>

<template>
  <HtAlert
    v-if="currentLanguage?.locale !== fallbackLocale"
    type="warning"
    :closable="false"
    class="translations-alert"
  >
    <template #title>
      {{ $t('legal.translations.title') }}
    </template>
    <template #text>
      <HtTranslate i18n-key="legal.translations.text">
        <template #1="slotProps">
          <Link :href="route('legal', { locale: fallbackLocale })">
            {{ slotProps.text }}
          </Link>
        </template>
      </HtTranslate>
    </template>
  </HtAlert>
</template>

<style scoped>

</style>
