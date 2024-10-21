<script setup lang="ts">

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
  <div class="header">
    <div class="header-left">
      <slot name="left" />
    </div>
    <div class="header-brand">
      <ApplicationLogo :size="10" />
      <span class="header-brand-text">
        <slot name="brand" />
      </span>
    </div>
    <div class="header-right">
      <slot name="right" />
    </div>
  </div>
</template>
