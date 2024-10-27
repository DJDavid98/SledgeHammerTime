<script setup lang="ts">

</script>

<template>
  <div class="content-wrap">
    <slot name="sidebar" />
    <main class="content">
      <slot />
    </main>
  </div>
</template>
