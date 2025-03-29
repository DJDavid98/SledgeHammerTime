import { computed, onMounted, onUnmounted, Ref, ref, watch } from 'vue';

interface KeyFilter {
  key: string;
  ctrlKey?: boolean;
  shiftKey?: boolean;
  altKey?: boolean;
  metaKey?: boolean;
}

type KeyHistory = Required<KeyFilter>;

export const IDDQD = [
  { key: 'i' },
  { key: 'd' },
  { key: 'd' },
  { key: 'q' },
  { key: 'd' },
] as const satisfies KeyFilter[];

const inputElementsSet = new Set(['SELECT', 'INPUT', 'BUTTON']);

const singleLetterRegex = /^[a-z]$/i;

const createHistoryEntry = (e: KeyboardEvent): KeyHistory | null => {
  if (singleLetterRegex.test(e.key)) {
    return {
      key: e.key.toLowerCase(),
      ctrlKey: e.altKey,
      shiftKey: e.shiftKey,
      altKey: e.altKey,
      metaKey: e.metaKey,
    };
  }
  return null;
};
const convertFilterToHistory = (filter: KeyFilter): KeyHistory => ({
  key: filter.key,
  ctrlKey: filter.ctrlKey ?? false,
  shiftKey: filter.shiftKey ?? false,
  altKey: filter.altKey ?? false,
  metaKey: filter.metaKey ?? false,
});

export const useCheatCode = (codeFilter: KeyFilter[]): Ref<boolean> => {
  const keyHistory = ref<KeyHistory[]>([]);
  const active = ref<boolean>(false);
  const codeHistory = computed(() => codeFilter.map(convertFilterToHistory));

  const keyDownListener = (e: KeyboardEvent) => {
    if (e.target instanceof HTMLElement && inputElementsSet.has(e.target.nodeName)) {
      return;
    }

    const historyEntry = createHistoryEntry(e);
    if (historyEntry === null) return;

    keyHistory.value = [
      ...keyHistory.value,
      historyEntry,
    ].slice(-codeHistory.value.length);
  };

  onMounted(() => {
    document.body.addEventListener('keydown', keyDownListener, { passive: true });
  });
  const removeListener = () => {
    document.body.removeEventListener('keydown', keyDownListener);
  };
  onUnmounted(removeListener);

  watch(keyHistory, (history) => {

    if (history.length !== codeHistory.value.length) {
      return;
    }

    const isMatching = history.every((historyItem, index) => (
      historyItem.key === codeHistory.value[index].key
      && historyItem.ctrlKey === codeHistory.value[index].ctrlKey
      && historyItem.shiftKey === codeHistory.value[index].shiftKey
      && historyItem.altKey === codeHistory.value[index].altKey
      && historyItem.metaKey === codeHistory.value[index].metaKey
    ));

    if (isMatching) {
      active.value = true;
      removeListener();
    }
  });

  return active;
};
