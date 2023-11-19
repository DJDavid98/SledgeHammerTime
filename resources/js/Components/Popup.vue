<script setup lang="ts">
defineProps<{
  show: boolean;
}>();

const emit = defineEmits<{
  (e: 'close'): void
}>();

const close = () => {
  emit('close');
};

defineExpose({
  close,
});
</script>


<template>
  <div class="popup" :hidden="!show">
    <slot />
  </div>
  <Teleport to="body">
    <div v-if="show" class="popup-close-backdrop cursor-default" @click="close" />
  </Teleport>
</template>
