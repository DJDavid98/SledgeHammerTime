<script setup lang="ts">

import { currentLanguageInject } from '@/injection-keys';
import HtAvatar from '@/Reusable/HtAvatar.vue';
import { reportData } from '@/utils/crowdin';
import { normalizeCredit } from '@/utils/translation';
import { computed, inject } from 'vue';

const currentLanguage = inject(currentLanguageInject);

const translationCredits = computed(() => {
  if (!currentLanguage?.value?.languageConfig?.credits) return null;

  return currentLanguage?.value?.languageConfig?.credits
    .map((c) => normalizeCredit(c, reportData))
    .sort((cr1, cr2) => cr1.displayName.localeCompare(cr2.displayName));
});
</script>

<template>
  <div
    class="translation-credits"
  >
    <a
      v-for="(credit, i) in translationCredits"
      :key="i"
      class="translator-item"
      :href="credit.url"
    >
      <div class="translator-avatar">
        <HtAvatar :src="credit.avatarUrl" />
      </div>
      <span class="translator-name">{{ credit.displayName }}</span>
    </a>
  </div>
</template>
