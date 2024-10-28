<script setup lang="ts">
import { sidebarState } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtHeader from '@/Reusable/HtHeader.vue';
import { faBars } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const sbState = inject(sidebarState);
const isOnLeft = computed(() => Boolean(sbState?.isOnLeft));
const isOpen = computed(() => Boolean(sbState?.isOpen));
</script>

<template>
  <HtHeader>
    <template #left>
      <HtButton
        :class="{ 'visually-hidden': !isOnLeft }"
        :disabled="isOpen"
        @click="sbState.setIsOpen(true)"
      >
        <FontAwesomeIcon :icon="faBars" />
      </HtButton>
    </template>
    <template #right>
      <HtButton
        :class="{ 'visually-hidden': isOnLeft }"
        :disabled="isOpen"
        @click="sbState.setIsOpen(true)"
      >
        <FontAwesomeIcon :icon="faBars" />
      </HtButton>
    </template>
  </HtHeader>
</template>
