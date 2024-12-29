<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import TimeZoneInput from '@/Components/TimeZoneSelect.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import { UserSettings } from '@/model/user-settings';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import { faSave } from '@fortawesome/free-solid-svg-icons';
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
    <HtCard>
      <h2>{{ $t('botSettings.title') }}</h2>

      <p class="mt-1">
        {{ $t('botSettings.description') }}
      </p>
    </HtCard>

    <HtCard
      v-for="(entry, i) in userSettings"
      :key="entry.user.id"
    >
      <header>
        <DiscordUserInfo v-bind="entry.user" />
      </header>
      <form @submit.prevent="forms[i].put(route('settings.set', { discordUserId: entry.user.id }))">
        <HtFormControlGroup :vertical="true">
          <HtFormControl
            :id="'timezone-'+i"
            :label="$t('botSettings.fields.timezone.displayName')"
          >
            <TimeZoneInput
              v-model="forms[i].timezone"
              name="timezone"
              class-name="mt-1"
            />
            <template #message>
              <FormMessage
                type="error"
                class="mt-2"
                :message="forms[i].errors.timezone"
              />
            </template>
          </HtFormControl>

          <HtFormControl
            v-if="formatOptions"
            :id="'format'+i"
            :label="$t('botSettings.fields.format.displayName')"
          >
            <HtFormSelect
              v-model="forms[i].format"
              name="format"
              class="mt-1"
            >
              <option
                v-for="formatLetter in formatOptions"
                :key="formatLetter"
                :value="formatLetter"
              >
                {{ $t(`botSettings.fields.format.option.${formatLetter}`) }}
              </option>
            </HtFormSelect>
            <template #message>
              <FormMessage
                type="error"
                class="mt-2"
                :message="forms[i].errors.format"
              />
            </template>
          </HtFormControl>

          <HtFormControl
            v-if="columnsOptions"
            :id="'columns'+i"
            :label="$t('botSettings.fields.columns.displayName')"
          >
            <HtFormSelect
              v-model="forms[i].columns"
              name="columns"
              class="mt-1"
            >
              <option
                v-for="columnsOption in columnsOptions"
                :key="columnsOption"
                :value="columnsOption"
              >
                {{ $t(`botSettings.fields.columns.option.${columnsOption}`) }}
              </option>
            </HtFormSelect>
            <template #message>
              <FormMessage
                type="error"
                class="mt-2"
                :message="forms[i].errors.columns"
              />
            </template>
          </HtFormControl>

          <HtFormCheckbox
            :id="'ephemeral-'+i"
            v-model="forms[i].ephemeral"
            name="ephemeral"
            :label="$t('botSettings.fields.ephemeral.displayName')"
          >
            <template #message>
              <FormMessage
                type="error"
                class="mt-2"
                :message="forms[i].errors.ephemeral"
              />
            </template>
          </HtFormCheckbox>

          <HtFormCheckbox
            :id="'header-'+i"
            v-model="forms[i].header"
            name="header"
            :label="$t('botSettings.fields.header.displayName')"
          >
            <template #message>
              <FormMessage
                type="error"
                class="mt-2"
                :message="forms[i].errors.header"
              />
            </template>
          </HtFormCheckbox>
        </HtFormControlGroup>

        <div>
          <HtButton
            color="primary"
            :loading="forms[i].processing"
            type="submit"
            :icon-start="faSave"
          >
            {{ $t('global.form.save') }}
          </HtButton>

          <FormMessage
            type="success"
            :message="forms[i].recentlySuccessful ? $t('global.form.saved') : undefined"
          />
        </div>
      </form>
    </HtCard>
  </Layout>
</template>
