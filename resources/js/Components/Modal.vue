<script setup lang="ts">
import { onMounted, onUnmounted, watch } from 'vue';

const props = withDefaults(
    defineProps<{
        show?: boolean;
        maxWidth?: 'sm' | 'md' | 'lg' | 'xl' | '2xl';
        closeable?: boolean;
    }>(),
    {
        show: false,
        closeable: true,
    },
);

const emit = defineEmits(['close']);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'visible';
        }
    },
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e: KeyboardEvent) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = '';
});

</script>

<template>
    <Teleport to="body">
        <dialog :open="show">
            <article>
                <header>
                    <slot name="header" />
                    <a href="#close" aria-label="Close" class="close" @click="close"></a>
                </header>
                <slot v-if="show" />
                <footer>
                    <slot name="footer" />
                </footer>
            </article>
        </dialog>
    </Teleport>
</template>
