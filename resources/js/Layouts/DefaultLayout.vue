<script setup lang="ts">
import Navbar from '@/Components/CustomNavbar.vue';
import { useLayout } from '@/composables/useLayout';
import HtContent from '@/Reusable/HtContent.vue';

useLayout();
</script>

<template>
  <Navbar />

  <HtContent>
    <slot />
  </HtContent>
</template>
