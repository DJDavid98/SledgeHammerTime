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
const loadingImage = ref(new Image());

const currentSrc = computed(() => loadedUrl.value ?? fallbackImage);

watch(() => props.src, (newSrc) => {
  if (loadedUrl.value === newSrc) return;

  loadedUrl.value = null;
  if (newSrc) {
    loadingImage.value.src = newSrc;
  }
}, { immediate: true });

const handleImageLoaded = (e: Event) => {
  loadedUrl.value = (e.target as HTMLImageElement).src;
};
onMounted(() => {
  loadingImage.value.addEventListener('load', handleImageLoaded);
});
onUnmounted(() => {
  loadingImage.value.removeEventListener('load', handleImageLoaded);
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
