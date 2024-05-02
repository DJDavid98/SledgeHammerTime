<script setup lang="ts">
import Button from '@/Components/Button.vue';
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import TimeZoneInput from '@/Components/TimeZoneInput.vue';
import Layout from '@/Layouts/Layout.vue';
import { UserSettings } from '@/model/user-settings';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
  userSettings: Array<{
    user: DiscordUserInfoProps,
    settings: Partial<UserSettings>
  }>;
  formatOptions?: string[];
  columnsOptions?: Record<string, string>;
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

    <article v-for="(entry, i) in userSettings">
      <DiscordUserInfo v-bind="entry.user" />
      <form @submit.prevent="forms[i].put(route('settings.set', { discordUserId: entry.user.id }))">
        <div>
          <label :for="'timezone-'+i">{{ $t('botSettings.fields.timezone.displayName') }}</label>

          <TimeZoneInput :id="'timezone-'+i" name="timezone" className="mt-1" v-model="forms[i].timezone" />

          <FormMessage type="error" class="mt-2" :message="forms[i].errors.timezone" />

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

            <FormMessage type="error" class="mt-2" :message="forms[i].errors.format" />
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

            <FormMessage type="error" class="mt-2" :message="forms[i].errors.columns" />
          </template>

          <p>
            <input type="checkbox" name="ephemeral" v-model="forms[i].ephemeral" :id="'ephemeral-'+i">
            <label :for="'ephemeral-'+i"> {{ $t('botSettings.fields.ephemeral.displayName') }}</label>
          </p>
          <FormMessage type="error" class="mt-2" :message="forms[i].errors.ephemeral" />

          <p>
            <input type="checkbox" name="header" v-model="forms[i].header" :id="'header-'+i">
            <label :for="'header-'+i"> {{ $t('botSettings.fields.header.displayName') }}</label>
          </p>
          <FormMessage type="error" class="mt-2" :message="forms[i].errors.header" />
        </div>

        <div>
          <Button
            :disabled="forms[i].processing"
            :aria-busy="forms[i].processing ? 'true' : undefined"
            type="submit"
          >
            {{ $t('global.form.save') }}
          </Button>

          <FormMessage type="success" :message="forms[i].recentlySuccessful ? $t('global.form.saved') : undefined" />
        </div>
      </form>
      <details class="mb-0">
        <summary>{{ $t('botSettings.fields.rawData.displayName') }}</summary>
        <pre><code>{{ JSON.stringify(entry.settings, null, 4) }}</code></pre>
      </details>
    </article>
  </Layout>
</template>
