<script setup lang="ts">
import LanguageSelector from '@/Components/LanguageSelector.vue';
import UserInfo from '@/Components/UserInfo.vue';
import { localSettings, sidebarState } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import { faAlignLeft, faAlignRight, faTimes } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const state = inject(sidebarState);
const localSettingsValue = inject(localSettings);
const isOnRight = computed(() => Boolean(localSettingsValue?.sidebarOnRight));
const isOpen = computed(() => Boolean(state?.isOpen));
</script>


<template>
  <aside :class="['sidebar', `position-${isOnRight ? 'right' : 'left'}`, { 'is-open': isOpen }]">
    <div
      v-if="state"
      class="sidebar-top"
    >
      <HtButton @click="state.setIsOpen(false)">
        <FontAwesomeIcon :icon="faTimes" />
      </HtButton>
      <HtButton @click="localSettingsValue?.toggleSidebarOnRight()">
        <FontAwesomeIcon :icon="isOnRight ? faAlignLeft : faAlignRight" />
      </HtButton>
    </div>
    <hr class="sidebar-divider">
    <div class="sidebar-content" />
    <hr class="sidebar-divider">
    <div class="sidebar-bottom">
      <ul class="actions-wrapper">
        <li class="p-0">
          <LanguageSelector />
        </li>
        <li class="p-0">
          <UserInfo />
        </li>
      </ul>
    </div>
  </aside>
  <div class="sidebar-spacing-wrapper">
    <slot />
  </div>
</template>
