import { CurrentLanguageData } from '@/injection-keys';
import { computed, onMounted, Ref, ref, watch } from 'vue';

const splitPrefKey = 'split-input';
const customPrefKey = 'custom-input';
const sidebarPrefKey = 'sidebar-right';
const sidebarOffDesktopPrefKey = 'sidebar-off-desktop';
const legacyDateLibPrefKey = 'legacy-date-lib';

export const useLocalSettings = (currentLanguage?: Ref<CurrentLanguageData>) => {
  const customInputEnabled = ref<boolean | null>(null);
  const combinedInputsEnabled = ref<boolean | null>(null);
  const sidebarOnRight = ref<boolean | null>(null);
  const sidebarOffDesktop = ref<boolean | null>(null);
  const dateFnsEnabled = ref<boolean | null>(null);

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
  watch(dateFnsEnabled, (newValue) => {
    localStorage.setItem(legacyDateLibPrefKey, newValue ? 'true' : 'false');
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
    // Sidebar is shown on desktop by default
    sidebarOffDesktop.value = storedPref === 'true';
  };
  const setInitialDateFnsEnabled = () => {
    const storedPref = localStorage.getItem(legacyDateLibPrefKey);
    // Feature is enabled by default
    dateFnsEnabled.value = storedPref === 'true';
  };

  onMounted(() => {
    setInitialCombinedInput();
    setInitialCustomInput();
    setInitialSidebarOnRight();
    setInitialSidebarOffDesktop();
    setInitialDateFnsEnabled();
  });

  return {
    customInputEnabled,
    combinedInputsEnabled,
    sidebarOnRight: effectiveSidebarOnRight,
    rawSidebarOnRight: sidebarOnRight,
    sidebarOffDesktop,
    dateFnsEnabled,
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
    setSidebarOffDesktop(value: boolean) {
      sidebarOffDesktop.value = value;
    },
    toggleDateFnsEnabled(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      dateFnsEnabled.value = e.target.checked;
    },
  };
};
