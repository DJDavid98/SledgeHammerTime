<script setup lang="ts">
import HtTextHighlighter from '@/Reusable/HtTextHighlighter.vue';
import { ComboboxOption, highlightedClass, selectedClass, suggestionItemClass } from '@/utils/combobox';
import { onMounted } from 'vue';

const props = defineProps<{
  option: ComboboxOption;
  inputValue: string | null;
  selectedOption?: string;
  isHighlighted: boolean;
}>();

const emit = defineEmits<{
  (e: 'click', option: ComboboxOption): void;
  (e: 'scrollToSelected'): void;
}>();

onMounted(() => {
  if (props.selectedOption === props.option.value) {
    emit('scrollToSelected');
  }
});
</script>

<template>
  <button
    :class="[suggestionItemClass, {[selectedClass]: option.value === selectedOption, [highlightedClass]: isHighlighted}]"
    type="button"
    :data-value="option.value"
    @click.prevent="emit('click', option)"
  >
    <HtTextHighlighter
      :text="option.label"
      :query="inputValue"
    />
  </button>
</template>
