<script setup lang="ts">

import Layout from '@/Layouts/DefaultLayout.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import { getHtmlTitle } from '@/utils/app';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head :title="getHtmlTitle($t('global.notFound.heading'))" />

  <Layout>
    <HtAlert
      type="warning"
      :closable="false"
    >
      <template #title>
        {{ $t('global.notFound.heading') }}
      </template>
      <template #text>
        {{ $t('global.notFound.content') }}
      </template>
    </HtAlert>
  </Layout>
</template>

<style scoped>
</style>
