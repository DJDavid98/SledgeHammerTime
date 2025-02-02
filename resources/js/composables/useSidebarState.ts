import { LocalSettingsValue } from '@/injection-keys';
import { computed, onMounted, onUnmounted, Ref, ref } from 'vue';

export function useSidebarState(localSettingsValue: LocalSettingsValue) {
  const defaultIsOpen: Ref<boolean> = ref(true);
  const openState: Ref<boolean | null> = ref(null);
  const isOpen = computed(() => openState.value ?? defaultIsOpen.value);

  const setIsOpen = (value: boolean) => {
    openState.value = value;
    if (screenSizeMediaMatch?.matches) {
      localSettingsValue.setSidebarOffDesktop(!value);
    }
  };

  let screenSizeMediaMatch: MediaQueryList | undefined;
  const handleMediaChange = (e: Pick<MediaQueryListEvent, 'matches'>) => {
    defaultIsOpen.value = e.matches && !localSettingsValue.sidebarOffDesktop;
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
    setIsOpen,
  };
}
