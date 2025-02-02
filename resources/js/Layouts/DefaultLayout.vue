<script setup lang="ts">
import Navbar from '@/Components/CustomNavbar.vue';
import { useLayout } from '@/composables/useLayout';
import HtContent from '@/Reusable/HtContent.vue';
import { faExclamationTriangle } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

useLayout();
</script>

<template>
  <Navbar />

  <HtContent>
    <noscript>
      <div class="alert warning mb-3">
      <div class="alert-content">
      <div class="alert-title">
      <font-awesome-icon :icon="faExclamationTriangle" :fixed-width="true" size="1x" class="me-2" />
      {{ $t('global.jsDisabled.title') }}
      </div>
      <div class="alert-text">
      {{ $t('global.jsDisabled.body') }}
      </div>
      </div>
      </div>
    </noscript>

    <slot />
  </HtContent>
</template>
