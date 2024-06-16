<script setup lang="ts">
import Button from '@/Components/CustomButton.vue';
import Modal from '@/Components/CustomModal.vue';
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
  <h2>{{ $t('profile.deletion.heading') }}</h2>

  <p class="mt-1">
    {{ $t('profile.deletion.description') }}
  </p>

  <Button @click="confirmUserDeletion">
    {{ $t('profile.deletion.deleteButton') }}
  </Button>

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
      <Button @click="closeModal">
        {{ $t('global.form.cancel') }}
      </Button>

      <Button
        :disabled="form.processing"
        :aria-busy="form.processing ? 'true' : undefined"
        @click="deleteUser"
      >
        {{ $t('global.form.confirm') }}
      </Button>
    </template>
  </Modal>
</template>
