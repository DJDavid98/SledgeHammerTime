<script setup lang="ts">
import HtAvatar from '@/Reusable/HtAvatar.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import { DEVELOPER_AVATAR_URL, DEVELOPER_NAME, DEVELOPER_URL } from '@/utils/app';
</script>

<template>
  <HtExternalLink
    class="developer-credit"
    :href="DEVELOPER_URL"
  >
    <div class="developer-avatar">
      <HtAvatar :src="DEVELOPER_AVATAR_URL" />
    </div>
    <span class="developer-name">{{ DEVELOPER_NAME }}</span>
  </HtExternalLink>
</template>
