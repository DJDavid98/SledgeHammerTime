import { onMounted, onUnmounted, ref, watch } from 'vue';

export function useIsLightTheme() {
  const isLightTheme = ref<boolean>(false);

  const themeWatcher = (value: boolean) => {
    document.documentElement.dataset.theme = value ? 'light' : 'dark';
  };
  watch(isLightTheme, themeWatcher, { immediate: true });

  const colorSchemeMedia = window.matchMedia('(prefers-color-scheme: dark)');
  const handleMediaChange = (e: Pick<MediaQueryListEvent, 'matches'>) => {
    isLightTheme.value = !e.matches;
  };

  onMounted(() => {
    handleMediaChange(colorSchemeMedia);
    colorSchemeMedia.addEventListener('change', handleMediaChange);
  });

  onUnmounted(() => {
    colorSchemeMedia.removeEventListener('change', handleMediaChange);
  });

  return isLightTheme;
}
