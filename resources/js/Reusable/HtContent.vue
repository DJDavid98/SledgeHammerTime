<script setup lang="ts">
import HtSidebar from '@/Reusable/HtSidebar.vue';
</script>

<template>
  <HtSidebar>
    <div class="content-container">
      <main class="content">
        <slot />
      </main>
    </div>
  </HtSidebar>
</template>
