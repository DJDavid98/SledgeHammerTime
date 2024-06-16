<script setup lang="ts">
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps<{
  checked: boolean;
  value?: unknown;
}>();

const proxyChecked = computed({
  get() {
    return props.checked;
  },

  set(val) {
    emit('update:checked', val);
  },
});
</script>

<template>
  <input
    v-model="proxyChecked"
    type="checkbox"
    :value="value"
    class="rounded bg-gray-900 border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-600 focus:ring-offset-gray-800"
  >
</template>
