<script setup lang="ts">
import AddLink from '@/Pages/AddApp/AddLink.vue';
import { faSquarePlus, faUserPlus } from '@fortawesome/free-solid-svg-icons';

withDefaults(defineProps<{
  horizontal?: boolean;
  openInNewTab?: boolean;
}>(), {
  horizontal: false,
  openInNewTab: false,
});
</script>

<template>
  <div
    :class="['add-app-links',{horizontal}]"
  >
    <AddLink
      install-type="user"
      :start-icon="faUserPlus"
      :title="$t('addApp.user.title')"
      :description="$t('addApp.user.description')"
      :open-in-new-tab="openInNewTab"
    />
    <AddLink
      install-type="guild"
      :start-icon="faSquarePlus"
      :title="$t('addApp.guild.title')"
      :description="$t('addApp.guild.description')"
      :open-in-new-tab="openInNewTab"
    />
  </div>
</template>

