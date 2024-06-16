<script setup lang="ts">
import Button from '@/Components/CustomButton.vue';
import FormMessage from '@/Components/FormMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
  name: user.name,
});
</script>

<template>
  <header>
    <h2>{{ $t('profile.information.heading') }}</h2>

    <p class="mt-1">
      {{ $t('profile.information.description') }}
    </p>
  </header>

  <form @submit.prevent="form.patch(route('profile.update'))">
    <div>
      <label for="name">{{ $t('profile.information.displayName') }}</label>

      <TextInput
        id="name"
        v-model="form.name"
        type="text"
        class="mt-1"
        required
        autofocus
        autocomplete="name"
      />

      <FormMessage
        type="error"
        class="mt-2"
        :message="form.errors.name"
      />
    </div>

    <div>
      <Button
        :disabled="form.processing"
        :aria-busy="form.processing ? 'true' : undefined"
        type="submit"
      >
        {{ $t('global.form.save') }}
      </Button>

      <p v-if="form.recentlySuccessful">
        {{ $t('global.form.saved') }}
      </p>
    </div>
  </form>
</template>
