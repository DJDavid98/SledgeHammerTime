<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

const props = withDefaults(defineProps<{
  src?: string;
  alt?: string;
  size?: number;
}>(), {
  size: 24,
  alt: '',
  src: undefined,
});

const fallbackImage = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";

const loadedUrl = ref<null | string>(null);
const loadingImage = ref<HTMLImageElement | null>(null);
const isSsr = typeof window === 'undefined';

const currentSrc = computed(() => isSsr ? props.src : (loadedUrl.value ?? fallbackImage));

watch(() => props.src, (newSrc) => {
  if (isSsr || loadedUrl.value === newSrc) return;

  loadedUrl.value = null;
  if (newSrc) {
    loadingImage.value ??= new Image();
    loadingImage.value.src = newSrc;
  }
}, { immediate: true });

const handleImageLoaded = (e: Event) => {
  loadedUrl.value = (e.target as HTMLImageElement).src;
};
onMounted(() => {
  if (isSsr) return;

  loadingImage.value ??= new Image();
  loadingImage.value.addEventListener('load', handleImageLoaded);
});
onUnmounted(() => {
  loadingImage.value?.removeEventListener('load', handleImageLoaded);
});
</script>

<template>
  <img
    class="avatar"
    :style="`--size: ${size}px`"
    :src="currentSrc"
    :alt="alt"
  >
</template>
