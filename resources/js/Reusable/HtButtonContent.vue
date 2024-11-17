<script setup lang="ts">

import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

export interface HtButtonContentProps {
  loading: boolean;
  iconOnly: boolean;
  iconStart: IconDefinition | undefined;
  iconEnd: IconDefinition | undefined;
}

defineProps<HtButtonContentProps>();
</script>

<template>
  <span
    v-if="loading"
    class="loading-icon"
  >
    <HtLoadingIndicator size="1em" />
  </span>
  <span class="button-content">
    <span
      v-if="iconStart"
      class="button-icon button-icon-start"
    >
      <FontAwesomeIcon
        :icon="iconStart"
        :fixed-width="iconOnly"
      />
    </span>

    <span
      v-if="!iconOnly"
      class="button-text"
    >
      <slot />
    </span>

    <span
      v-if="iconEnd"
      class="button-icon button-icon-end"
    >
      <FontAwesomeIcon
        :icon="iconEnd"
        :fixed-width="iconOnly"
      />
    </span>
  </span>
</template>
