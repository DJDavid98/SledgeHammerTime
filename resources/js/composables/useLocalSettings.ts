import { CurrentLanguageData } from '@/injection-keys';
import { computed, onMounted, Ref, ref, watch } from 'vue';

const splitPrefKey = 'split-input';
const customPrefKey = 'custom-input';
const sidebarPrefKey = 'sidebar-right';
const sidebarOffDesktopPrefKey = 'sidebar-off-desktop';

export const useLocalSettings = (currentLanguage?: Ref<CurrentLanguageData>) => {
  const customInputEnabled = ref<boolean | null>(null);
  const combinedInputsEnabled = ref<boolean | null>(null);
  const sidebarOnRight = ref<boolean | null>(null);
  const sidebarOffDesktop = ref<boolean | null>(null);

  const effectiveSidebarOnRight = computed(() => (
    currentLanguage?.value.languageConfig?.rtl ? !sidebarOnRight.value : sidebarOnRight.value
  ));

  watch(customInputEnabled, (newValue) => {
    localStorage.setItem(customPrefKey, newValue ? 'true' : 'false');
  });
  watch(combinedInputsEnabled, (newValue) => {
    localStorage.setItem(splitPrefKey, newValue ? 'false' : 'true');
  });
  watch(sidebarOnRight, (newValue) => {
    localStorage.setItem(sidebarPrefKey, newValue ? 'true' : 'false');
  });
  watch(sidebarOffDesktop, (newValue) => {
    localStorage.setItem(sidebarOffDesktopPrefKey, newValue ? 'true' : 'false');
  });

  const setInitialCombinedInput = () => {
    const storedPref = localStorage.getItem(splitPrefKey);
    if (storedPref !== null) {
      combinedInputsEnabled.value = storedPref !== 'true';
      return;
    }

    // Feature detection for datetime-local input
    const testInput = document.createElement('input');
    testInput.setAttribute('type', 'datetime-local');
    const testValue = '1)';
    testInput.value = testValue;
    combinedInputsEnabled.value = testInput.value !== testValue;
  };
  const setInitialCustomInput = () => {
    const storedPref = localStorage.getItem(customPrefKey);
    // Enable custom input by default
    customInputEnabled.value = storedPref !== 'false';
  };
  const setInitialSidebarOnRight = () => {
    const storedPref = localStorage.getItem(sidebarPrefKey);
    // Sidebar is on the left by default
    sidebarOnRight.value = storedPref === 'true';
  };
  const setInitialSidebarOffDesktop = () => {
    const storedPref = localStorage.getItem(sidebarOffDesktopPrefKey);
    // Sidebar is on the left by default
    sidebarOffDesktop.value = storedPref === 'true';
  };

  onMounted(() => {
    setInitialCombinedInput();
    setInitialCustomInput();
    setInitialSidebarOnRight();
    setInitialSidebarOffDesktop();
  });

  return {
    customInputEnabled,
    combinedInputsEnabled,
    sidebarOnRight: effectiveSidebarOnRight,
    rawSidebarOnRight: sidebarOnRight,
    sidebarOffDesktop,
    toggleCustomInput(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      customInputEnabled.value = e.target.checked;
    },
    toggleSeparateInputs(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      combinedInputsEnabled.value = !e.target.checked;
    },
    toggleSidebarOnRight() {
      sidebarOnRight.value = !sidebarOnRight.value;
    },
    toggleSidebarOffDesktop() {
      sidebarOffDesktop.value = !sidebarOffDesktop.value;
    },
    setSidebarOffDesktop(value: boolean) {
      sidebarOffDesktop.value = value;
    },
  };
};
