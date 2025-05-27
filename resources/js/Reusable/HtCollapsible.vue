<script setup lang="ts">
import { onMounted, onUnmounted, ref, useTemplateRef, watch } from 'vue';

const props = withDefaults(defineProps<{
  visible: boolean,
  'class'?: string,
  maxHeight?: number;
}>(), {
  'class': undefined,
  maxHeight: undefined,
});

const isSsr = typeof window === 'undefined';
const collapsibleRef = useTemplateRef('collapsibleRef');
const height = ref(props.maxHeight);
const isTransitioning = ref(false);

const handleResize = () => {
  if (isTransitioning.value) return;

  if (collapsibleRef.value) {
    height.value = Math.min(props.maxHeight ?? Infinity, collapsibleRef.value.scrollHeight);
  }
};
const resizeObserver = !isSsr ? new ResizeObserver(handleResize) : undefined;

const handleTransitionStart = () => {
  isTransitioning.value = true;
};

const handleTransitionEnd = () => {
  isTransitioning.value = false;
};

watch(() => props.visible, (newVisible) => {
  if (newVisible) {
    if (collapsibleRef.value) {
      // Reset scroll position on opening
      collapsibleRef.value.scrollTop = 0;
    }
  }
});

onMounted(() => {
  handleResize();
  if (resizeObserver && collapsibleRef.value) {
    resizeObserver.observe(collapsibleRef.value);
    collapsibleRef.value.addEventListener('transitionstart', handleTransitionStart);
    collapsibleRef.value.addEventListener('transitionend', handleTransitionEnd);
  }
});

onUnmounted(() => {
  if (resizeObserver && collapsibleRef.value) {
    resizeObserver.unobserve(collapsibleRef.value);
    collapsibleRef.value.removeEventListener('transitionstart', handleTransitionStart);
    collapsibleRef.value.removeEventListener('transitionend', handleTransitionEnd);
  }
});
</script>

<template>
  <div
    ref="collapsibleRef"
    :class="['collapsible', { visible: visible, 'limited-height': !!maxHeight }, props.class]"
    :style="`height: ${height}px`"
    :inert="!visible"
  >
    <slot />
  </div>
</template>
