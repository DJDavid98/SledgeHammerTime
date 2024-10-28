<script setup lang="ts">
import LanguageSelector from '@/Components/LanguageSelector.vue';
import UserInfo from '@/Components/UserInfo.vue';
import { sidebarState } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import { faAlignLeft, faAlignRight, faTimes } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const state = inject(sidebarState);
const isOnLeft = computed(() => Boolean(state?.isOnLeft));
const isOpen = computed(() => Boolean(state?.isOpen));
</script>


<template>
  <aside :class="['sidebar', `position-${isOnLeft ? 'left' : 'right'}`, { 'is-open': isOpen }]">
    <div
      v-if="state"
      class="sidebar-top"
    >
      <HtButton @click="state.setIsOpen(false)">
        <FontAwesomeIcon :icon="faTimes" />
      </HtButton>
      <HtButton @click="state.setIsOnLeft(!isOnLeft)">
        <FontAwesomeIcon :icon="isOnLeft ? faAlignRight : faAlignLeft" />
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
</template>
