<script setup lang="ts">
import { scrollToAnchorInject } from '@/injection-keys';
import ChangesAndRevisions from '@/Pages/Legal/ChangesAndRevisions.vue';
import LegalContact from '@/Pages/Legal/LegalContact.vue';
import PrivacyPolicy from '@/Pages/Legal/PrivacyPolicy.vue';
import TermsAndConditions from '@/Pages/Legal/TermsAndConditions.vue';
import { PRIVACY_UPDATE_DATE, TERMS_UPDATE_DATE } from '@/utils/app';
import { router } from '@inertiajs/vue3';
import { inject, onMounted, onUnmounted } from 'vue';

const scrollToAnchor = inject(scrollToAnchorInject);

const handleHashChange = () => {
  if (!document || !window) return;

  const anchor = window.location.hash;
  if (!anchor || anchor.length < 2) return;

  scrollToAnchor?.(anchor.substring(1));
};

let cleanupRouterOnHashChange: VoidFunction | undefined;
onMounted(() => {
  window.addEventListener('load', handleHashChange);
  window.addEventListener('popstate', handleHashChange);
  cleanupRouterOnHashChange = router.on('success', handleHashChange);
});

onUnmounted(() => {
  window.removeEventListener('load', handleHashChange);
  cleanupRouterOnHashChange?.();
});
</script>

<template>
  <PrivacyPolicy :last-updated="PRIVACY_UPDATE_DATE" />

  <TermsAndConditions :last-updated="TERMS_UPDATE_DATE" />

  <ChangesAndRevisions />

  <LegalContact />
</template>
