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

const collapsibleRef = useTemplateRef('collapsibleRef');
const height = ref(0);
const isTransitioning = ref(false);

const resizeObserver = new ResizeObserver(() => {
  if (isTransitioning.value) return;

  if (collapsibleRef.value) {
    height.value = Math.min(props.maxHeight ?? Infinity, collapsibleRef.value.scrollHeight);
  }
});

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
  if (collapsibleRef.value) {
    resizeObserver.observe(collapsibleRef.value);
    collapsibleRef.value.addEventListener('transitionstart', handleTransitionStart);
    collapsibleRef.value.addEventListener('transitionend', handleTransitionEnd);
  }
});

onUnmounted(() => {
  if (collapsibleRef.value) {
    resizeObserver.unobserve(collapsibleRef.value);
    collapsibleRef.value.removeEventListener('transitionstart', handleTransitionStart);
    collapsibleRef.value.removeEventListener('transitionend', handleTransitionEnd);
  }
});
</script>

<template>
  <div
    ref="collapsibleRef"
    :class="['collapsible', { visible, 'limited-height': !!maxHeight }, props.class]"
    :style="`height: ${height}px`"
    :inert="!visible"
  >
    <slot />
  </div>
</template>
