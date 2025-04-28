<script setup lang="ts">
import { devModeInject } from '@/injection-keys';
import HtCard from '@/Reusable/HtCard.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { inject } from 'vue';

defineProps<{
  locale: string;
}>();

const devMode = inject(devModeInject);
</script>

<template>
  <HtCard v-if="devMode">
    <template #header>
      <h2>
        {{ $t('profile.accounts.linkAdditional.heading') }}
      </h2>
    </template>

    <p class="mt-1 mb-3">
      {{ $t('profile.accounts.linkAdditional.description') }}
    </p>

    <HtLinkButton
      color="primary"
      :icon-start="faDiscord"
      :href="route('login', { locale })"
      :external="true"
    >
      {{ $t('profile.accounts.linkAdditional.authorize') }}
    </HtLinkButton>
  </HtCard>
</template>
