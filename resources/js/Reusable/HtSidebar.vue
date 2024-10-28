<script setup lang="ts">
import { sidebarState } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import { faAlignLeft, faAlignRight, faTimes } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const state = inject(sidebarState);
const isOpen = computed(() => Boolean(state?.isOpen ?? state?.defaultIsOpen));
// TODO Does not seem to work
const isOnLeft = computed(() => Boolean(state?.isOnLeft));
</script>


<template>
  <aside :class="['sidebar', `position-${isOnLeft ? 'left' : 'right'}`, { 'is-open': isOpen }]">
    <div
      v-if="state"
      class="sidebar-top"
    >
      <HtButton @click="state.isOpen.value = !isOpen">
        <FontAwesomeIcon :icon="faTimes" />
      </HtButton>
      <HtButton @click="state.isOnLeft.value = !state.isOnLeft.value">
        <FontAwesomeIcon :icon="state.isOnLeft.value ? faAlignRight : faAlignLeft" />
      </HtButton>
    </div>
    <hr class="sidebar-divider">
    <div class="sidebar-content" />
    <hr class="sidebar-divider">
    <div class="sidebar-bottom" />
  </aside>
</template>
