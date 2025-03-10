<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import TimeZoneInput from '@/Components/TimeZoneSelect.vue';
import { UserSettings } from '@/model/user-settings';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import { faSave } from '@fortawesome/free-solid-svg-icons';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
  entry: {
    user: DiscordUserInfoProps,
    settings: Partial<UserSettings>
  };
  formatOptions?: string[];
  columnsOptions?: Record<string, string>;
}>();


const form = useForm({
  timezone: props.entry.settings.timezone ?? '',
  format: props.entry.settings.format ?? props.formatOptions?.[0] ?? null,
  ephemeral: props.entry.settings.ephemeral ?? true,
  header: props.entry.settings.header ?? true,
  columns: props.entry.settings.columns ?? props.formatOptions?.[0] ?? null,
});
</script>

<template>
  <HtCard>
    <header>
      <DiscordUserInfo v-bind="entry.user" />
    </header>
    <form @submit.prevent="form.put(route('settings.set', { discordUserId: entry.user.id }))">
      <HtFormControlGroup :vertical="true">
        <HtFormControl
          :id="'timezone-'+entry.user.id"
          :label="$t('botSettings.fields.timezone.displayName')"
        >
          <TimeZoneInput
            v-model="form.timezone"
            name="timezone"
            class-name="mt-1"
          />
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.timezone"
            />
          </template>
        </HtFormControl>

        <HtFormControl
          v-if="formatOptions"
          :id="'format-'+entry.user.id"
          :label="$t('botSettings.fields.format.displayName')"
        >
          <HtFormSelect
            v-model="form.format"
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
              :message="form.errors.format"
            />
          </template>
        </HtFormControl>

        <HtFormControl
          v-if="columnsOptions"
          :id="'columns'+entry.user.id"
          :label="$t('botSettings.fields.columns.displayName')"
        >
          <HtFormSelect
            v-model="form.columns"
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
              :message="form.errors.columns"
            />
          </template>
        </HtFormControl>

        <HtFormCheckboxModelled
          :id="'ephemeral-'+entry.user.id"
          v-model="form.ephemeral"
          name="ephemeral"
          :label="$t('botSettings.fields.ephemeral.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.ephemeral"
            />
          </template>
        </HtFormCheckboxModelled>

        <HtFormCheckboxModelled
          :id="'header-'+entry.user.id"
          v-model="form.header"
          name="header"
          :label="$t('botSettings.fields.header.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.header"
            />
          </template>
        </HtFormCheckboxModelled>
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

        <FormMessage
          type="success"
          :message="form.recentlySuccessful ? $t('botSettings.saveSuccess') : undefined"
        />
      </div>
    </form>
  </HtCard>
</template>

<style scoped>

</style>
