<script setup lang="ts">

import { currentLanguageInject } from '@/injection-keys';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { Link } from '@inertiajs/vue3';
import { inject } from 'vue';

defineProps<{
  href: string;
  image: string;
  name?: string;
  desc?: string;
  isLocal?: boolean;
}>();

const currentLanguage = inject(currentLanguageInject);
</script>

<template>
  <div class="useful-link">
    <component
      :is="isLocal ? Link : 'a'"
      :href="isLocal ? route(href, { locale: currentLanguage?.locale ?? FALLBACK_LANGUAGE }) : href"
      :target="isLocal ? undefined : '_blank'"
      :rel="isLocal ? undefined : 'noopener noreferrer'"
      class="link-wrap"
    >
      <div class="link-card">
        <div class="card-top-half">
          <img
            :src="image"
            alt=""
          >
        </div>

        <div class="card-bottom-half">
          <span class="link-name">
            <slot name="name">{{ name }}</slot>
          </span>

          <span class="link-desc">
            <slot name="desc">{{ desc }}</slot>
          </span>
        </div>
      </div>
    </component>
  </div>
</template>
