<script setup lang="ts">
import { scrollToAnchorInject } from '@/injection-keys';
import { LegalSectionIds } from '@/utils/legal';
import { faLink } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { inject } from 'vue';

const props = defineProps<{
  level: 2 | 3 | 4,
  id: LegalSectionIds;
}>();

const scrollToAnchor = inject(scrollToAnchorInject);
const handleClick = (e: Event) => {
  if (e instanceof MouseEvent && e.button === 1) {
    e.preventDefault();

    scrollToAnchor?.(props.id);
  }
};
</script>

<template>
  <component
    :is="'h'+level"
    :id="id"
  >
    <slot />
    <Link
      :href="`#${id}`"
      class="heading-link ms-2"
      @click="handleClick"
    >
      <FontAwesomeIcon :icon="faLink" />
    </Link>
  </component>
</template>

<style scoped>

</style>
