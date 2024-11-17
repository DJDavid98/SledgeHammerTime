<script setup lang="ts">
import HtButtonContent, { HtButtonContentProps } from '@/Reusable/HtButtonContent.vue';
import { ButtonColors, getButtonClasses } from '@/utils/buttons';
import { Link } from '@inertiajs/vue3';
import { Method } from 'axios';
import { computed } from 'vue';

interface CommonLinkButtonProps {
  /**
   * Defaults to gray when not provided
   */
  color?: ButtonColors,
  'class'?: string | Record<string, boolean>,
  href: string,
  block?: boolean,
  pressed?: boolean,
}

type ConditionalLinkButtonProps = {
  external?: false,
  method: Method | undefined,
  as?: 'button',
  targetBlank?: undefined,
} | {
  external: true,
  as?: undefined,
  method?: undefined,
  targetBlank?: boolean,
};

const props = withDefaults(defineProps<CommonLinkButtonProps & ConditionalLinkButtonProps & Partial<HtButtonContentProps>>(), {
  color: undefined,
  'class': undefined,
  loading: false,
  block: false,
  as: undefined,
  pressed: false,
  iconOnly: false,
  iconStart: undefined,
  iconEnd: undefined,
  external: false,
  method: undefined,
  targetBlank: undefined,
});

const buttonClasses = computed(() => getButtonClasses(props));
</script>

<template>
  <a
    v-if="external"
    :class="buttonClasses"
    :href="href"
    :target="!targetBlank ? undefined : '_blank'"
    rel="noreferrer noopener"
  >
    <HtButtonContent
      :loading="loading"
      :icon-only="iconOnly"
      :icon-start="iconStart"
      :icon-end="iconEnd"
    >
      <slot />
    </HtButtonContent>
  </a>
  <Link
    v-else
    :class="buttonClasses"
    :href="href"
    :method="method"
    :as="as"
  >
    <HtButtonContent
      :loading="loading"
      :icon-only="iconOnly"
      :icon-start="iconStart"
      :icon-end="iconEnd"
    >
      <slot />
    </HtButtonContent>
  </Link>
</template>
