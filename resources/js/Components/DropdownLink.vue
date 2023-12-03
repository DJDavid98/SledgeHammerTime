<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
  href: string;
}>();
</script>

<template>
  <li>
    <Link :href="href">
      <slot />
    </Link>
  </li>
</template>
