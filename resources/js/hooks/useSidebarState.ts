import { onMounted, onUnmounted, Ref, ref } from 'vue';

export function useSidebarState() {
  const defaultIsOpen = ref(false);
  const isOpen: Ref<boolean | null> = ref(null);
  const isOnLeft = ref(true);

  let screenSizeMediaMatch: MediaQueryList | undefined;
  const handleMediaChange = (e: MediaQueryListEvent) => {
    defaultIsOpen.value = e.matches;
  };
  onMounted(() => {
    screenSizeMediaMatch = window.matchMedia('(min-width: 1024px)');

    screenSizeMediaMatch.addEventListener('change', handleMediaChange);
  });
  onUnmounted(() => {
    screenSizeMediaMatch?.removeEventListener('change', handleMediaChange);
  });

  return {
    defaultIsOpen,
    isOpen,
    isOnLeft,
  };
}
