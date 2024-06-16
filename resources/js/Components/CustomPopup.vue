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
    @click.self="close"
  >
    <slot />
  </dialog>
</template>
