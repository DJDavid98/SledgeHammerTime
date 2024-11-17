<script setup lang="ts">
import { localSettings, sidebarState } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtHeader from '@/Reusable/HtHeader.vue';
import { faBars } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const localSettingsValue = inject(localSettings);
const sidebarStateValue = inject(sidebarState);
const isOnRight = computed(() => Boolean(localSettingsValue?.rawSidebarOnRight));
const isOpen = computed(() => Boolean(sidebarStateValue?.isOpen));
</script>

<template>
  <HtHeader>
    <template #left>
      <HtButton
        v-if="sidebarStateValue"
        :class="{ 'visually-hidden': isOnRight }"
        :disabled="isOpen"
        @click="sidebarStateValue.setIsOpen(true)"
      >
        <FontAwesomeIcon :icon="faBars" />
      </HtButton>
    </template>
    <template #right>
      <HtButton
        v-if="sidebarStateValue"
        :class="{ 'visually-hidden': !isOnRight }"
        :disabled="isOpen"
        @click="sidebarStateValue.setIsOpen(true)"
      >
        <FontAwesomeIcon :icon="faBars" />
      </HtButton>
    </template>
  </HtHeader>
</template>
