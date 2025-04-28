<script setup lang="ts">
import Modal from '@/Components/CustomModal.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  nextTick(() => passwordInput.value?.focus());
};

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onFinish: () => {
      form.reset();
    },
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('profile.deletion.heading') }}</h2>
    </template>

    <p class="mt-1">
      {{ $t('profile.deletion.description') }}
    </p>

    <HtButton
      color="danger"
      @click="confirmUserDeletion"
    >
      {{ $t('profile.deletion.deleteButton') }}
    </HtButton>
  </HtCard>

  <Modal
    :show="confirmingUserDeletion"
    @close="closeModal"
  >
    <template #header>
      {{ $t('profile.deletion.confirmDialog.header') }}
    </template>

    <p class="mt-1">
      {{ $t('profile.deletion.confirmDialog.body') }}
    </p>

    <template #footer>
      <HtButton @click="closeModal">
        {{ $t('actions.cancel') }}
      </HtButton>

      <HtButton
        color="danger"
        :disabled="form.processing"
        :aria-busy="form.processing ? 'true' : undefined"
        @click="deleteUser"
      >
        {{ $t('actions.confirm') }}
      </HtButton>
    </template>
  </Modal>
</template>
