import { computed, onMounted, onUnmounted, Ref, ref } from 'vue';

export function useSidebarState() {
  const defaultIsOpen: Ref<boolean> = ref(false);
  const openState: Ref<boolean | null> = ref(null);
  const isOnLeft: Ref<boolean> = ref(true);
  const isOpen = computed(() => openState.value ?? defaultIsOpen.value);

  const setIsOpen = (value: boolean) => {
    openState.value = value;
  };
  const setIsOnLeft = (value: boolean) => {
    isOnLeft.value = value;
  };

  let screenSizeMediaMatch: MediaQueryList | undefined;
  const handleMediaChange = (e: Pick<MediaQueryListEvent, 'matches'>) => {
    defaultIsOpen.value = e.matches;
  };
  onMounted(() => {
    screenSizeMediaMatch = window.matchMedia('(min-width: 1024px)');
    handleMediaChange(screenSizeMediaMatch);

    screenSizeMediaMatch.addEventListener('change', handleMediaChange);
  });
  onUnmounted(() => {
    screenSizeMediaMatch?.removeEventListener('change', handleMediaChange);
  });

  return {
    isOpen,
    isOnLeft,
    setIsOpen,
    setIsOnLeft,
  };
}
