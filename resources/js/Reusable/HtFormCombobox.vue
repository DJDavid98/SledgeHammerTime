<script setup lang="ts">
import { useTimezoneIndex } from '@/composables/useTimezoneIndex';
import { formControlId } from '@/injection-keys';
import HtFormComboboxSuggestion from '@/Reusable/HtFormComboboxSuggestion.vue';
import { ComboboxOption, suggestionItemClass } from '@/utils/combobox';
import { faChevronDown, faChevronUp, faKeyboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject, nextTick, onMounted, onUnmounted, ref, toRef, useTemplateRef, watch } from 'vue';

const id = inject(formControlId);
const model = defineModel<string>();

const props = defineProps<{
  options: ComboboxOption[];
  name?: string;
  class?: string;
  tabindex?: number | string;
}>();

const emit = defineEmits<{ (e: 'change', option: ComboboxOption): void; (e: 'focus', ev: FocusEvent): void }>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');
const suggestionsRef = useTemplateRef<HTMLInputElement>('suggestions-el');
const inputValue = ref<string>('');
const typingModeValue = ref<string | null>(null);
const typingModeSelectionStart = ref<number>(0);
const typingModeSelectionEnd = ref<number>(0);
const highlightedIndex = ref<number>(-1);
const mode = ref<'typing' | 'select'>('typing');
const showSuggestions = ref<boolean>(false);
const isInteractingWithSuggestions = ref(false);

const timezoneIndex = useTimezoneIndex(toRef(() => props.options));
const optionsRecord = computed(() => props.options.reduce((acc: Record<string, string>, option) => ({
  ...acc,
  [option.value]: option.label,
}), {}));
const filteredOptions = computed<ComboboxOption[]>(() => {
    const normalizedInputValue = (mode.value === 'select' ? (typingModeValue.value ?? '') : inputValue.value).trim();
    return normalizedInputValue
      ? timezoneIndex.find(normalizedInputValue).map(value => ({
        value,
        label: optionsRecord.value[value],
      }))
      : props.options;
  },
);
const optionMatchingInputIndex = computed<number>(() =>
  filteredOptions.value.findIndex(option => option.label === inputValue.value),
);
const inputMatchesOption = computed<boolean>(() => optionMatchingInputIndex.value !== -1);

const scrollHighlightedOptionIntoView = () => {
  nextTick(() => {
    if (!suggestionsRef.value) {
      return;
    }
    const targetSuggestion = suggestionsRef.value.children[highlightedIndex.value] as HTMLElement;
    if (!targetSuggestion || !targetSuggestion.offsetParent) return;

    const parentHeightHalf = targetSuggestion.offsetParent.getBoundingClientRect().height / 2;
    const targetOffsetHeightHalf = targetSuggestion.offsetHeight / 2;
    targetSuggestion.offsetParent.scrollTo(0, Math.max(0, targetSuggestion.offsetTop - parentHeightHalf + targetOffsetHeightHalf));
  });
};
const setInputValueFromModelValue = (newModelValue: string | undefined) => {
  inputValue.value = props.options.find(opt => opt.value === newModelValue)?.label ?? '';
  detectSelectMode();
};

// Detect manual user input & show suggestions
const handleInput = () => {
  if (mode.value === 'select') {
    mode.value = 'typing';
    typingModeValue.value = inputValue.value;
    highlightedIndex.value = -1;
  }
  showSuggestions.value = true;
};

const isModifiedKeyboardEvent = (event: KeyboardEvent) =>
  isModifiedKeyboardEventWithoutShift(event) || event.shiftKey;

const isModifiedKeyboardEventWithoutShift = (event: KeyboardEvent) =>
  event.altKey || event.ctrlKey || event.metaKey;

const handleKeyDown = (event: KeyboardEvent) => {
  switch (event.key) {
    case 'Home':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (mode.value === 'select' && showSuggestions.value && filteredOptions.value.length > 0) {
        highlightedIndex.value = filteredOptions.value.length - 1;
      }
      break;
    case 'End':
      if (mode.value === 'select' && showSuggestions.value && filteredOptions.value.length > 0) {
        highlightedIndex.value = filteredOptions.value.length - 1;
      }
      break;

    case ' ':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (inputMatchesOption.value) {
        showSuggestions.value = true; // Show suggestions only if input matches an option
        event.preventDefault();
      }
      break;

    case 'ArrowDown':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (mode.value === 'typing' && filteredOptions.value.length > 0) {
        typingModeValue.value = inputValue.value;
        typingModeSelectionStart.value = inputRef.value?.selectionStart ?? 0;
        typingModeSelectionEnd.value = inputRef.value?.selectionStart ?? 0;
        highlightedIndex.value = optionMatchingInputIndex.value === -1
          ? 0
          : optionMatchingInputIndex.value;
        mode.value = 'select';
        inputValue.value = filteredOptions.value[0].label;
        showSuggestions.value = true;
        event.preventDefault();
      } else if (mode.value === 'select') {
        const currentIndex = highlightedIndex.value;
        if (currentIndex < filteredOptions.value.length - 1) {
          highlightedIndex.value = currentIndex + 1;
          inputValue.value = filteredOptions.value[highlightedIndex.value].label;
        }
        event.preventDefault();
      }

      scrollHighlightedOptionIntoView();
      break;

    case 'ArrowUp':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (mode.value === 'select') {
        event.preventDefault();
        const currentIndex = highlightedIndex.value;
        if (currentIndex > 0) {
          highlightedIndex.value = currentIndex - 1;
          inputValue.value = filteredOptions.value[highlightedIndex.value].label;
          scrollHighlightedOptionIntoView();
        } else {
          if (typingModeValue.value !== null) {
            mode.value = 'typing';
            inputValue.value = typingModeValue.value;
            if (inputRef.value) {
              inputRef.value.selectionStart = typingModeSelectionStart.value;
              inputRef.value.selectionStart = typingModeSelectionEnd.value;
            }
          } else {
            setInputValueFromModelValue(model.value);
          }
          highlightedIndex.value = -1;
        }
      }
      break;

    case 'Enter':
    case 'Tab':
      if (event.key === 'Tab' ? isModifiedKeyboardEventWithoutShift(event) : isModifiedKeyboardEvent(event)) {
        return;
      }
      if (event.key === 'Enter') {
        event.preventDefault();
      }
      if (mode.value === 'select' && showSuggestions.value && highlightedIndex.value !== -1) {
        const selectedOption = filteredOptions.value[highlightedIndex.value];
        if (selectedOption) {
          model.value = selectedOption.value;
          inputValue.value = selectedOption.label;
          typingModeValue.value = '';
          emit('change', selectedOption);
        }
      } else {
        highlightedIndex.value = optionMatchingInputIndex.value;
        mode.value = highlightedIndex.value !== -1 ? 'select' : 'typing';
        setInputValueFromModelValue(model.value);
      }
      showSuggestions.value = false;
      break;

    case "PageDown":
    case "PageUp":
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (mode.value === 'select' && showSuggestions.value) {
        const suggestionsRefValue = suggestionsRef.value;
        if (!suggestionsRefValue || !suggestionsRefValue.offsetParent) {
          return;
        }
        event.preventDefault();

        const scrollAmount = suggestionsRefValue.getBoundingClientRect().height / 2;
        const scrollDirection = event.key === 'PageDown' ? 1 : -1;
        suggestionsRefValue.scrollTop += scrollAmount * scrollDirection;

        nextTick(() => {
          const children = Array.from(suggestionsRefValue.children) as HTMLElement[];
          const containerRect = suggestionsRefValue.getBoundingClientRect();
          let firstVisible: HTMLElement | null = null;
          for (let i = scrollDirection > 0 ? children.length - 1 : 0; scrollDirection > 0 ? i > -1 : i < children.length; i -= scrollDirection) {
            const child = children[i];
            const rect = child.getBoundingClientRect();
            const visible = rect.bottom <= containerRect.bottom && rect.top >= containerRect.top;
            if (visible) {
              firstVisible = child;
              break;
            }
          }
          if (firstVisible) {
            highlightedIndex.value = children.indexOf(firstVisible);
            inputValue.value = filteredOptions.value[highlightedIndex.value].label;
            scrollHighlightedOptionIntoView();
          }
        });
      }
      break;

    case 'Escape':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      event.preventDefault();
      if (mode.value === 'select' && typingModeValue.value !== null) {
        if (!inputMatchesOption.value) {
          mode.value = 'typing';
          inputValue.value = typingModeValue.value;
          highlightedIndex.value = -1;
        }
      } else {
        highlightedIndex.value = optionMatchingInputIndex.value;
        setInputValueFromModelValue(model.value);
      }
      showSuggestions.value = false;
      break;
  }
};

const handleSuggestionClick = (option: ComboboxOption, index: number) => {
  inputValue.value = option.label;
  model.value = option.value;
  highlightedIndex.value = index;
  emit('change', option);
  showSuggestions.value = false;
};

// Handle focus & blur correctly
const handleFocus = (event: FocusEvent) => {
  emit('focus', event);
  if (!isInteractingWithSuggestions.value) {
    showSuggestions.value = false; // Prevent showing suggestions immediately
  }
  detectSelectMode();
};
const detectSelectMode = () => {
  nextTick(() => {
    if (inputMatchesOption.value) {
      mode.value = 'select';
      typingModeValue.value = null;
      highlightedIndex.value = optionMatchingInputIndex.value;
    }
  });
};

const handleIconClick = (event: MouseEvent) => {
  event.preventDefault();
  event.stopPropagation();
  const currentShowSuggestionsValue = showSuggestions.value;
  inputRef.value?.focus();
  nextTick(() => {
    showSuggestions.value = !currentShowSuggestionsValue;
  });
};

const formSelectIconClass = 'form-select-icon';
const handleBlur = (event: FocusEvent) => {
  // Check if focus is moving to a suggestion
  const relatedTarget = event.relatedTarget as HTMLElement | null;
  if (relatedTarget) {
    if (isInteractingWithSuggestions.value) {
      return;
    }
    const targetClasses = relatedTarget.classList;
    if (targetClasses.contains(suggestionItemClass) || targetClasses.contains(formSelectIconClass)) {
      return;
    }
  }
  showSuggestions.value = false;
  if (!inputMatchesOption.value) {
    setInputValueFromModelValue(model.value);
  }
};

const handleMouseDown = () => {
  isInteractingWithSuggestions.value = true;
};

const focus = () => {
  inputRef.value?.focus();
  inputRef.value?.select();
};

export interface FormComboboxApi {
  focus: typeof focus;
}

defineExpose<FormComboboxApi>({
  focus,
});

const globalMouseupHandler = () => {
  if (isInteractingWithSuggestions.value && showSuggestions.value) {
    inputRef.value?.focus();
  }
  nextTick(() => {
    isInteractingWithSuggestions.value = false;
  });
};
onMounted(() => {
  if (document) {
    document.body.addEventListener('mouseup', globalMouseupHandler, { passive: true });
  }
});
onUnmounted(() => {
  if (document) {
    document.body.removeEventListener('mouseup', globalMouseupHandler);
  }
});

watch(model, (newModelValue) => {
  setInputValueFromModelValue(newModelValue);
}, { immediate: true });
</script>

<template>
  <div :class="['form-control-combobox form-control-select', {'suggestions-open': showSuggestions}]">
    <input
      :id="id"
      ref="input-el"
      v-model="inputValue"
      :name="props.name"
      :class="['form-select-input input-field', props.class]"
      :tabindex="props.tabindex"
      autocomplete="off"
      @keydown="handleKeyDown"
      @input="handleInput"
      @focus="handleFocus"
      @blur="handleBlur"
    >
    <button
      type="button"
      :class="formSelectIconClass"
      tabindex="-1"
      @click="handleIconClick"
      @mousedown="isInteractingWithSuggestions = true"
    >
      <FontAwesomeIcon
        :icon="mode === 'typing' ? faKeyboard : (showSuggestions ? faChevronUp : faChevronDown)"
        :fixed-width="true"
      />
    </button>
    <div
      v-if="showSuggestions && filteredOptions.length"
      ref="suggestions-el"
      class="combobox-suggestions"
      @mousedown.passive="handleMouseDown"
    >
      <HtFormComboboxSuggestion
        v-for="(option, i) in filteredOptions"
        :key="option.value"
        :option="option"
        :selected-option="model"
        :is-highlighted="highlightedIndex === i"
        :input-value="mode === 'typing' ? inputValue : typingModeValue"
        @click.passive="handleSuggestionClick(option, i)"
        @mouseenter.passive="highlightedIndex = i"
        @scroll-to-selected="scrollHighlightedOptionIntoView"
      />
    </div>
  </div>
</template>
