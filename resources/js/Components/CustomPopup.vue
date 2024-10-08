<script setup lang="ts">
import { ref, watch } from 'vue';

const props = defineProps<{
  show: boolean;
}>();

const emit = defineEmits<{
  (e: 'close'): void
  (e: 'open'): void
}>();

const dialog = ref<HTMLDialogElement>();
const closeOnMouseup = ref(false);

const isSelf = (target: EventTarget | HTMLElement | null) => target !== null && target === dialog.value;
const handleMousedown = (e: MouseEvent): void => {
  // Store whether the target was the popup on mousedown
  closeOnMouseup.value = isSelf(e.target);
};
const handleMouseup = (e: MouseEvent): void => {
  if (isSelf(e.target) && closeOnMouseup.value) {
    // Only close the popup if both the down and up targets are the popup
    // Prevents accidentally closing the popup when dragging something inside
    close();
  }
  closeOnMouseup.value = false;
};

const close = () => {
  dialog.value?.close();
  emit('close');
};
const open = () => {
  dialog.value?.showModal();
  emit('open');
};

watch(() => props.show, (value) => {
  if (value) {
    open();
  } else {
    close();
  }
});

defineExpose({
  close,
  open,
});
</script>


<template>
  <dialog
    ref="dialog"
    :class="['popup', {visible: show}]"
    @mousedown="handleMousedown"
    @mouseup="handleMouseup"
    @close="close"
  >
    <slot />
  </dialog>
</template>
