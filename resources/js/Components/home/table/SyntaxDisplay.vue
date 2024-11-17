<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import { faCheck, faClipboard } from '@fortawesome/free-solid-svg-icons';
import { computed, ref } from 'vue';

const props = defineProps<{
  unixTs: number | undefined;
  format?: string;
}>();

const copied = ref<boolean>(false);
const releaseTimeout = ref<ReturnType<typeof setTimeout> | null>(null);

const data = computed(() => props.format ? `<t:${props.unixTs}:${props.format}>` : props.unixTs);

const copy = () => {
  if (data.value) {
    copied.value = true;
    navigator.clipboard.writeText(data.value.toString());

    if (releaseTimeout.value !== null) {
      clearTimeout(releaseTimeout.value);
    }
    releaseTimeout.value = setTimeout(() => {
      copied.value = false;
      releaseTimeout.value = null;
    }, 1e3);
  }
};
</script>

<template>
  <div
    v-if="unixTs !== undefined"
    class="syntax-display"
  >
    <HtButton
      :color="copied ? 'success' : 'primary'"
      class="cursor-pointer"
      :title="$t('timestampPicker.table.clickToCopy')"
      :pressed="copied"
      :icon-only="true"
      :icon-start="copied ? faCheck : faClipboard"
      @click="copy"
    />
    <code class="syntax-display-code">
      {{ data }}
    </code>
  </div>
</template>
