<script setup lang="ts">
import Navbar from '@/Components/Navbar.vue';
import { useMomentLocale } from '@/utils/moment';
import { usePage } from '@inertiajs/vue3';

useMomentLocale(usePage().props.app.locale);
</script>

<template>
  <Navbar />

  <main class="container">
    <slot />
  </main>
</template>
