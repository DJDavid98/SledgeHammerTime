<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import { faCheck, faClipboard } from '@fortawesome/free-solid-svg-icons';
import { computed, ref } from 'vue';

const props = defineProps<{
  text: string | number | undefined;
  class?: string;
}>();

const copied = ref<boolean>(false);
const releaseTimeout = ref<ReturnType<typeof setTimeout> | null>(null);
const isDisabled = computed(() => typeof props.text === 'undefined');

const handleClick = () => {
  if (typeof props.text === 'undefined') return;
  copied.value = true;
  navigator.clipboard.writeText(props.text.toString());

  if (releaseTimeout.value !== null) {
    clearTimeout(releaseTimeout.value);
  }
  releaseTimeout.value = setTimeout(() => {
    copied.value = false;
    releaseTimeout.value = null;
  }, 1e3);
};
</script>

<template>
  <HtButton
    :color="copied ? 'success' : 'primary'"
    :class="['cursor-pointer', props.class]"
    :title="$t('timestampPicker.table.clickToCopy')"
    :pressed="copied"
    :icon-only="true"
    :icon-start="copied ? faCheck : faClipboard"
    :disabled="isDisabled"
    @click="handleClick"
  />
</template>
