<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { getAppName } from '@/utils/app';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const appName = getAppName();
const page = usePage();
const nonStick = computed(() => page.props.ziggy.location === route('legal', route().params));
</script>

<template>
  <div :class="['header', {'non-stick': nonStick}]">
    <div class="header-left">
      <slot name="left" />
    </div>
    <Link
      :href="route('home', route().params)"
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
