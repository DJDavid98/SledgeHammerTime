<script setup lang="ts">
import Button from '@/Components/Button.vue';
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import Layout from '@/Layouts/Layout.vue';
import { UserSettings } from '@/model/user-settings';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
  userSettings: Array<{
    user: DiscordUserInfoProps,
    settings: Partial<UserSettings>
  }>
  availableTimezones?: string[],
  formatOptions?: string[],
  columnsOptions?: Record<string, string>,
}>();

const forms = props.userSettings.map(userSetting => useForm({
  timezone: userSetting.settings.timezone ?? '',
  format: userSetting.settings.format ?? props.formatOptions?.[0] ?? null,
  ephemeral: userSetting.settings.ephemeral ?? true,
  header: userSetting.settings.header ?? true,
  columns: userSetting.settings.columns ?? props.formatOptions?.[0] ?? null,
}));
</script>

<template>
  <Head :title="$t('botSettings.title')" />

  <Layout>
    <header>
      <h2>{{ $t('botSettings.title') }}</h2>

      <p class="mt-1">{{ $t('botSettings.description') }}</p>
    </header>

    <datalist v-if="availableTimezones" id="timezones">
      <option v-for="zoneIdentifier in availableTimezones" :value="zoneIdentifier" />
    </datalist>

    <article v-for="(entry, i) in userSettings">
      <DiscordUserInfo v-bind="entry.user" />
      <form @submit.prevent="forms[i].put(route('settings.set', { discordUserId: entry.user.id }))">
        <div>
          <label :for="'timezone-'+i">{{ $t('botSettings.fields.timezone.displayName') }}</label>

          <TextInput
            :id="'timezone-'+i"
            name="timezone"
            type="text"
            class="mt-1"
            v-model="forms[i].timezone"
            list="timezones"
            placeholder="GMT"
          />

          <InputError class="mt-2" :message="forms[i].errors.timezone" />

          <template v-if="formatOptions">
            <label :for="'format'+i">{{ $t('botSettings.fields.format.displayName') }}</label>

            <select
              :id="'format-'+i"
              name="format"
              class="mt-1"
              v-model="forms[i].format"
            >
              <option v-for="formatLetter in formatOptions" :value="formatLetter">
                {{ $t(`botSettings.fields.format.option.${formatLetter}`) }}
              </option>
            </select>

            <InputError class="mt-2" :message="forms[i].errors.format" />
          </template>

          <template v-if="columnsOptions">
            <label :for="'columns'+i">{{ $t('botSettings.fields.columns.displayName') }}</label>

            <select
              :id="'columns-'+i"
              name="columns"
              class="mt-1"
              v-model="forms[i].columns"
            >
              <option v-for="columnsOption in columnsOptions" :value="columnsOption">
                {{ $t(`botSettings.fields.columns.option.${columnsOption}`) }}
              </option>
            </select>

            <InputError class="mt-2" :message="forms[i].errors.columns" />
          </template>

          <p>
            <input type="checkbox" name="ephemeral" v-model="forms[i].ephemeral" :id="'ephemeral-'+i">
            <label :for="'ephemeral-'+i"> {{ $t('botSettings.fields.ephemeral.displayName') }}</label>
          </p>
          <InputError class="mt-2" :message="forms[i].errors.ephemeral" />

          <p>
            <input type="checkbox" name="header" v-model="forms[i].header" :id="'header-'+i">
            <label :for="'header-'+i"> {{ $t('botSettings.fields.header.displayName') }}</label>
          </p>
          <InputError class="mt-2" :message="forms[i].errors.header" />
        </div>

        <div>
          <Button
            :disabled="forms[i].processing"
            :aria-busy="forms[i].processing ? 'true' : undefined"
            type="submit"
          >
            {{ $t('global.form.save') }}
          </Button>

          <p v-if="forms[i].recentlySuccessful">{{ $t('global.form.saved') }}</p>
        </div>
      </form>
      <details class="mb-0">
        <summary>{{ $t('botSettings.fields.rawData.displayName') }}</summary>
        <pre><code>{{ JSON.stringify(entry.settings, null, 4) }}</code></pre>
      </details>
    </article>
  </Layout>
</template>
