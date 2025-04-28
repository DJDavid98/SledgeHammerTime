<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import { faTimes, faTrash } from '@fortawesome/free-solid-svg-icons';
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

    <p class="mt-1 mb-3">
      {{ $t('profile.deletion.description') }}
    </p>

    <HtButton
      color="danger"
      :pressed="confirmingUserDeletion"
      :disabled="confirmingUserDeletion"
      @click="confirmUserDeletion"
    >
      {{ $t('profile.deletion.deleteButton') }}
    </HtButton>
    <HtCollapsible :visible="confirmingUserDeletion">
      <p class="mb-2">
        {{ $t('profile.deletion.confirmDialog.header') }}
      </p>

      <p class="mb-2">
        {{ $t('profile.deletion.confirmDialog.body') }}
      </p>

      <div>
        <HtButton
          class="me-3"
          :icon-start="faTimes"
          @click="closeModal"
        >
          {{ $t('actions.cancel') }}
        </HtButton>

        <HtButton
          color="danger"
          :disabled="form.processing"
          :aria-busy="form.processing ? 'true' : undefined"
          :icon-start="faTrash"
          @click="deleteUser"
        >
          {{ $t('actions.confirm') }}
        </HtButton>
      </div>
    </HtCollapsible>
  </HtCard>
</template>
