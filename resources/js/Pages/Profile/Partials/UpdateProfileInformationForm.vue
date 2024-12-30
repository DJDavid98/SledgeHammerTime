<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { faSave } from '@fortawesome/free-solid-svg-icons';
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
    <HtFormControlGroup :vertical="true">
      <HtFormControl
        id="name"
        :label="$t('profile.information.displayName')"
      >
        <HtInput
          v-model="form.name"
          type="text"
          class="mt-1"
          required
          autofocus
          autocomplete="name"
        />
        <template #message>
          <FormMessage
            type="error"
            class="mt-2"
            :message="form.errors.name"
          />
        </template>
      </HtFormControl>
    </HtFormControlGroup>

    <div>
      <HtButton
        color="primary"
        :loading="form.processing"
        type="submit"
        :icon-start="faSave"
      >
        {{ $t('actions.save') }}
      </HtButton>

      <p v-if="form.recentlySuccessful">
        {{ $t('profile.information.saveSuccess') }}
      </p>
    </div>
  </form>
</template>
