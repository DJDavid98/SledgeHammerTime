<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import LegalInfoSections from '@/Pages/Legal/LegalInfoSections.vue';
import TranslationsAlert from '@/Pages/Legal/TranslationsAlert.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
  fallbackLocale: string;
}>();
</script>

<template>
  <Head :title="$t('global.nav.legal')" />

  <Layout>
    <TranslationsAlert :fallback-locale="fallbackLocale" />

    <LegalInfoSections />
  </Layout>
</template>

