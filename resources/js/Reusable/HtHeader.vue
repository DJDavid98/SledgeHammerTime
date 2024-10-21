<script setup lang="ts">

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { getAppName } from '@/utils/app';
import { Link } from '@inertiajs/vue3';

const appName = getAppName();
</script>

<template>
  <div class="header">
    <div class="header-left">
      <slot name="left" />
    </div>
    <Link
      :href="route('home')"
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
