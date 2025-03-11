<script setup lang="ts">
import { useTimezoneIndex } from '@/composables/useTimezoneIndex';
import { formControlId } from '@/injection-keys';
import { faChevronDown } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { throttle } from 'throttle-debounce';
import { computed, inject, ref, toRef, useTemplateRef, watch } from 'vue';

const id = inject(formControlId);
const suggestionsClass = 'combobox-suggestions';
const suggestionItemClass = 'combobox-suggestion-item';
const selectedClass = 'selected';
const selectedSelector = `.${selectedClass}`;
const highlightedClass = 'highlighted';
const highlightedSelector = `.${highlightedClass}`;
const model = defineModel<string>();

export interface ComboboxOption {
  label: string;
  value: string;
}

const props = defineProps<{
  name?: string,
  'class'?: string,
  options: ComboboxOption[],
}>();

const emit = defineEmits<{
  (e: 'change', option: ComboboxOption): void;
  (e: 'focus', ev: FocusEvent): void;
}>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');
const suggestionsRef = useTemplateRef<HTMLDivElement>('suggestions-el');
const inputValue = ref<string>('');
const inputValueBeforeSuggestionsHighlighted = ref<string>();
const inputFocused = ref<boolean>(false);
const showSuggestions = ref<boolean>(false);
const highlightedOption = ref<string>();

const suggestionsOpen = computed(() => inputFocused.value && showSuggestions.value);

const optionsRecord = computed(() => props.options.reduce((acc: Record<string, string>, option) => ({
  ...acc,
  [option.value]: option.label,
}), {}));
const timezoneIndex = useTimezoneIndex(toRef(() => props.options));
const filteredOptions = ref<ComboboxOption[]>(props.options);
const updateFilteredOptions = throttle(200, (newInputValue: string) => {
  const normalizedInputValue = newInputValue.trim();
  if (normalizedInputValue.length === 0) {
    filteredOptions.value = props.options;
  } else {
    filteredOptions.value = timezoneIndex.find(normalizedInputValue).map(value => ({
      value,
      label: optionsRecord.value[value],
    }));
  }
  highlightedOption.value = model.value;
});

const effectiveModelValue = computed<string>(() => typeof model.value === 'undefined' ? '' : (optionsRecord.value[model.value] ?? ''));

const getFirstSuggestion = (): Element | null => {
  if (!suggestionsRef.value) return null;
  return suggestionsRef.value.querySelector<HTMLButtonElement>(`.${suggestionItemClass}`);
};
const getMatchingSuggestion = (filterSelector: string): Element | null => {
  if (!suggestionsRef.value) return null;
  return suggestionsRef.value.querySelector<HTMLButtonElement>(`.${suggestionItemClass}${filterSelector}`);
};
const getMatchingOrFirstSuggestion = (filterSelector: string): Element | null => {
  const matchingSuggestion = getMatchingSuggestion(filterSelector);
  return matchingSuggestion ?? getFirstSuggestion();
};
const scrollSelectedSuggestionIntoView = () => {
  let firstSuggestion = getMatchingOrFirstSuggestion(selectedSelector);
  scrollSuggestionIntoView(firstSuggestion);
};
const scrollNextSuggestionIntoView = () => {
  let firstSuggestion = getMatchingOrFirstSuggestion(highlightedSelector);
  if (!firstSuggestion) return;
  const target = firstSuggestion.matches(highlightedSelector)
    ? firstSuggestion?.nextElementSibling ?? firstSuggestion
    : firstSuggestion;
  scrollSuggestionIntoView(target, false);
};
const scrollPreviousSuggestionIntoView = () => {
  let firstSuggestion = getFirstSuggestion();
  if (!firstSuggestion || firstSuggestion.matches(highlightedSelector)) {
    highlightedOption.value = undefined;
    restoreInputValue();
    return;
  }
  const target = firstSuggestion.matches(highlightedSelector)
    ? firstSuggestion?.previousElementSibling ?? firstSuggestion
    : firstSuggestion;
  scrollSuggestionIntoView(target, false);
};
const scrollSuggestionIntoView = (targetSuggestion: Element | undefined | null, observer = true) => {
  if (!targetSuggestion || !(targetSuggestion instanceof HTMLElement)) return;

  highlightedOption.value = targetSuggestion.dataset.value;
  inputValue.value = targetSuggestion.innerText;

  const performScroll = () => {
    if (!targetSuggestion.offsetParent) return;
    const parentHeightHalf = targetSuggestion.offsetParent.getBoundingClientRect().height / 2;
    const targetOffsetHeightHalf = targetSuggestion.offsetHeight / 2;
    targetSuggestion.offsetParent.scrollTo(0, Math.max(0, targetSuggestion.offsetTop - parentHeightHalf + targetOffsetHeightHalf));
  };
  if (!observer) {
    performScroll();
    return;
  }
  const io = new IntersectionObserver(() => {
    performScroll();
    io.disconnect();
  });
  io.observe(targetSuggestion);
};
const restoreInputValue = () => {
  if (typeof inputValueBeforeSuggestionsHighlighted.value !== 'undefined') {
    inputValue.value = inputValueBeforeSuggestionsHighlighted.value;
    inputValueBeforeSuggestionsHighlighted.value = undefined;
  }
};
const closeSuggestionAndRestoreInputValue = () => {
  showSuggestions.value = false;
  restoreInputValue();
};
const handleInputKeydown = (e: KeyboardEvent) => {
  switch (e.key) {
    case "ArrowDown": {
      if (e.shiftKey || e.ctrlKey || e.altKey) return;
      e.preventDefault();
      if (!showSuggestions.value) {
        const currentOptionIndex = props.options.findIndex(option => option.value === model.value);
        if (currentOptionIndex !== -1) {
          handleOptionSelect(props.options[Math.max(0, currentOptionIndex - 1)]);
        }
        return;
      }
      const highlightedElement = getMatchingSuggestion(highlightedSelector);
      if (!highlightedElement && typeof inputValueBeforeSuggestionsHighlighted.value === 'undefined') {
        inputValueBeforeSuggestionsHighlighted.value = inputValue.value;
      }
      scrollNextSuggestionIntoView();
    }
      break;
    case "ArrowUp": {
      if (e.shiftKey || e.ctrlKey || e.altKey) return;
      e.preventDefault();
      if (!showSuggestions.value) {
        const currentOptionIndex = props.options.findIndex(option => option.value === model.value);
        if (currentOptionIndex !== -1) {
          handleOptionSelect(props.options[Math.min(currentOptionIndex + 1, props.options.length - 1)]);
        }
        return;
      }
      const highlightedElement = getMatchingSuggestion(highlightedSelector);
      if (!highlightedElement && typeof inputValueBeforeSuggestionsHighlighted.value === 'undefined') {
        inputValueBeforeSuggestionsHighlighted.value = inputValue.value;
      }
      scrollPreviousSuggestionIntoView();
    }
      break;
    case " ":
      if (e.shiftKey || e.ctrlKey || e.altKey) return;

      if (showSuggestions.value) return;

      e.preventDefault();
      inputValueBeforeSuggestionsHighlighted.value = inputValue.value;
      showSuggestions.value = true;
      scrollSelectedSuggestionIntoView();
      break;
    case "Enter":
      if (e.shiftKey || e.ctrlKey || e.altKey || !showSuggestions.value) return;

      e.preventDefault();
      e.stopPropagation();
      if (highlightedOption.value) {
        handleOptionSelect({
          label: optionsRecord.value[highlightedOption.value],
          value: highlightedOption.value,
        });
        return;
      }

      closeSuggestionAndRestoreInputValue();
      break;
    case "Escape":
      if (e.shiftKey || e.ctrlKey || e.altKey) return;
      if (showSuggestions.value) {
        e.preventDefault();
        e.stopPropagation();
        closeSuggestionAndRestoreInputValue();
      }
      break;
    default:
      if (e.ctrlKey || e.altKey) return;
      if (/^[\da-z\/]$/.test(e.key)) {
        showSuggestions.value = true;
      }
  }
};
const handleInputFocus = (e: FocusEvent) => {
  emit('focus', e);
  inputFocused.value = true;
  if (showSuggestions.value) return;
  showSuggestions.value = false;
};
const handleInputBlur = () => {
  inputFocused.value = false;
};

const handleOptionSelect = (option: ComboboxOption) => {
  showSuggestions.value = false;
  model.value = option.value;
  emit('change', option);
};

const focus = () => {
  inputRef.value?.focus();
  inputRef.value?.select();
};

export interface FormSelectApi {
  focus: typeof focus;
}

defineExpose<FormSelectApi>({
  focus,
});

watch(effectiveModelValue, (newModelValue) => {
  if (newModelValue !== inputValue.value) {
    inputValue.value = newModelValue;
  }
}, { immediate: true });
watch([inputValue, inputValueBeforeSuggestionsHighlighted, highlightedOption], ([newInputValue, existingInputValue, newHighlightedOption]) => {
  const highlightedOptionDefined = typeof newHighlightedOption !== 'undefined';
  if (highlightedOptionDefined && model.value && existingInputValue === optionsRecord.value[model.value]) {
    updateFilteredOptions('');
    return;
  }
  updateFilteredOptions(highlightedOptionDefined ? (existingInputValue ?? newInputValue) : newInputValue);
}, { immediate: true });
watch(suggestionsOpen, (newSuggestionsOpen) => {
  if (newSuggestionsOpen && suggestionsRef.value && inputValue.value === '') {
    const selectedOption = suggestionsRef.value.querySelector<HTMLButtonElement>(`.${suggestionItemClass}${selectedSelector}`);
    if (selectedOption) {
      scrollSuggestionIntoView(selectedOption);
    }
  }
}, { flush: "post" });
</script>

<template>
  <div :class="['form-control-combobox form-control-select', {'suggestions-open': suggestionsOpen}]">
    <input
      :id="id"
      ref="input-el"
      v-model="inputValue"
      type="text"
      :name="name"
      :class="['form-select-input input-text', props.class]"
      @keydown="handleInputKeydown"
      @focus.passive="handleInputFocus"
      @blur.passive="handleInputBlur"
    >
    <span class="form-select-icon">
      <FontAwesomeIcon
        :icon="faChevronDown"
        :fixed-width="true"
      />
    </span>
    <div
      ref="suggestions-el"
      :class="[suggestionsClass,{ open: suggestionsOpen }]"
    >
      <button
        v-for="option in filteredOptions"
        :key="option.value"
        :class="[suggestionItemClass, {[selectedClass]: option.value === model, [highlightedClass]: highlightedOption === option.value}]"
        type="button"
        :data-value="option.value"
        @click.prevent="handleOptionSelect(option)"
      >
        {{ option.label }}
      </button>
    </div>
  </div>
</template>
