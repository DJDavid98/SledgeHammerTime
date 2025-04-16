<script setup lang="ts">
import { positionAnchor } from '@/injection-keys';
import { inject, ref, watch } from 'vue';

export interface Focusable {
  focus: () => void;
}

const props = withDefaults(defineProps<{
  show?: boolean;
  wide?: boolean;
  allowOverflow?: boolean;
}>(), {
  show: false,
  wide: false,
  allowOverflow: false,
});

const emit = defineEmits<{
  (e: 'close'): void
  (e: 'open'): void
}>();

const dialogEl = ref<HTMLDialogElement>();
const closeOnMouseup = ref(false);
const focusElementOnClose = ref<Focusable | null>(null);
const positionAnchorName = inject(positionAnchor);

const isSelf = (target: EventTarget | HTMLElement | null) => target !== null && target === dialogEl.value;
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
  dialogEl.value?.close();
};
const handleDialogClose = () => {
  focusElementOnClose.value?.focus();
  focusElementOnClose.value = null;
  emit('close');
};
const open = (focusOnClose?: Focusable | null) => {
  focusElementOnClose.value = focusOnClose || null;
  dialogEl.value?.showModal();
  emit('open');
};

watch(() => props.show, (value) => {
  switch (value) {
    case true:
      open();
      break;
    case false:
      close();
      break;
  }
});

export interface CustomPopupApi {
  close: typeof close;
  open: typeof open;
}

defineExpose<CustomPopupApi>({
  close,
  open,
});
</script>


<template>
  <dialog
    ref="dialogEl"
    :class="['popup', {visible: show, wide, 'has-anchor': Boolean(positionAnchorName), 'allow-overflow': allowOverflow}]"
    :style="positionAnchorName ? `position-anchor: ${positionAnchorName}` : undefined"
    @mousedown="handleMousedown"
    @mouseup="handleMouseup"
    @close="handleDialogClose"
  >
    <slot />
  </dialog>
</template>
