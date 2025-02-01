<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';

const emit = defineEmits<{
  (e: 'close'): void;
}>();
</script>

<template>
  <HtButtonGroup>
    <HtButton
      color="primary"
      :justify-center="true"
      type="submit"
    >
      {{ $t('actions.save_and_close') }}
    </HtButton>
    <HtButton
      :justify-center="true"
      @click="emit('close')"
    >
      {{ $t('actions.close') }}
    </HtButton>
  </HtButtonGroup>
</template>
