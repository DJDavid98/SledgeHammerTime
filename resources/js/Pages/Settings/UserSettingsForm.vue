<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { devModeInject } from '@/injection-keys';
import { UserSettings } from '@/model/user-settings';
import TimeZoneInputModelled from '@/Pages/Settings/ControlledTimeZoneInput.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import HtInput from '@/Reusable/HtInput.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { LegalSectionIds } from '@/utils/legal';
import { faChevronDown, faChevronUp, faExclamationTriangle, faSave } from '@fortawesome/free-solid-svg-icons';
import { Link, useForm } from '@inertiajs/vue3';
import { inject, ref } from 'vue';

const props = defineProps<{
  entry: {
    user: DiscordUserInfoProps,
    settings: Partial<UserSettings>
  };
  defaultSettings: UserSettings;
  formatOptions?: string[];
  columnsOptions?: Record<string, string>;
}>();

const devMode = inject(devModeInject);
const showAdvancedSettings = ref(false);

const form = useForm({
  timezone: props.entry.settings.timezone ?? props.defaultSettings.timezone ?? '',
  format: props.entry.settings.format ?? props.formatOptions?.[0] ?? props.defaultSettings.format,
  formatMinimalReply: props.entry.settings.formatMinimalReply ?? props.defaultSettings.formatMinimalReply ?? true,
  ephemeral: props.entry.settings.ephemeral ?? props.defaultSettings.ephemeral ?? true,
  header: props.entry.settings.header ?? props.defaultSettings.header ?? true,
  boldPreview: props.entry.settings.boldPreview ?? props.defaultSettings.boldPreview ?? true,
  columns: props.entry.settings.columns ?? props.formatOptions?.[0] ?? props.defaultSettings.columns,
  telemetry: props.entry.settings.telemetry ?? props.defaultSettings.telemetry ?? true,
  defaultAtHour: props.entry.settings.defaultAtHour ?? props.defaultSettings.defaultAtHour,
  defaultAtMinute: props.entry.settings.defaultAtMinute ?? props.defaultSettings.defaultAtMinute,
  defaultAtSecond: props.entry.settings.defaultAtSecond ?? props.defaultSettings.defaultAtSecond,
});
</script>

<template>
  <HtCard>
    <template #header>
      <DiscordUserInfo v-bind="entry.user" />
    </template>
    <form @submit.prevent="form.put(route('settings.set', { discordUserId: entry.user.id }))">
      <HtFormControlGroup :vertical="true">
        <HtFormControl
          :id="'timezone-'+entry.user.id"
          :label="$t('botSettings.fields.timezone.displayName')"
          :combo-box="true"
        >
          <TimeZoneInputModelled
            v-model="form.timezone"
            name="timezone"
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

        <HtFormCheckboxModelled
          :id="'formatMinimalReply-'+entry.user.id"
          v-model="form.formatMinimalReply"
          name="formatMinimalReply"
          :label="$t('botSettings.fields.formatMinimalReply.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.formatMinimalReply"
            />
          </template>
        </HtFormCheckboxModelled>

        <HtFormControl
          v-if="columnsOptions"
          :id="'columns-'+entry.user.id"
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

        <HtFormCheckboxModelled
          :id="'boldPreview-'+entry.user.id"
          v-model="form.boldPreview"
          name="boldPreview"
          :label="$t('botSettings.fields.boldPreview.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.boldPreview"
            />
          </template>
        </HtFormCheckboxModelled>

        <HtAlert
          type="info"
          :closable="false"
        >
          <template #text>
            <p class="mb-2">
              <HtTranslate i18n-key="botSettings.fields.telemetry.explanation">
                <template #1>
                  <Link :href="`${route('legal', route().params)}#${LegalSectionIds.TELEMETRY_STATISTICS}`">
                    {{ $t('global.nav.legal') }}
                  </Link>
                </template>
              </HtTranslate>
            </p>
            <HtFormCheckboxModelled
              :id="'telemetry-'+entry.user.id"
              v-model="form.telemetry"
              name="telemetry"
              :label="$t('botSettings.fields.telemetry.displayName')"
            >
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="form.errors.telemetry"
                />
              </template>
            </HtFormCheckboxModelled>
          </template>
        </HtAlert>

        <HtFormControlWrap>
          <HtButton
            color="warning"
            :pressed="showAdvancedSettings"
            :icon-start="faExclamationTriangle"
            :icon-end="showAdvancedSettings ? faChevronUp : faChevronDown"
            @click="showAdvancedSettings = !showAdvancedSettings"
          >
            {{ $t('botSettings.advancedSettings.toggleText') }}
          </HtButton>
          <HtCollapsible :visible="showAdvancedSettings">
            <HtFormControl
              :id="'defaultAtHour-'+entry.user.id"
              :label="$t('botSettings.fields.defaultAtHour.displayName', {
                atCommandName: $t('botSettings.advancedSettings.atCommandName'),
                hourOptionName: $t('botSettings.advancedSettings.hourOptionName'),
              })"
            >
              <HtInput
                v-model="form.defaultAtHour"
                name="defaultAtHour"
                class="mt-1"
                type="number"
                :min="0"
                :max="23"
              />
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="form.errors.defaultAtHour"
                />
              </template>
            </HtFormControl>
            <HtFormControl
              :id="'defaultAtMinute-'+entry.user.id"
              :label="$t('botSettings.fields.defaultAtMinute.displayName', {
                atCommandName: $t('botSettings.advancedSettings.atCommandName'),
                minuteOptionName: $t('botSettings.advancedSettings.minuteOptionName'),
              })"
            >
              <HtInput
                v-model="form.defaultAtMinute"
                name="defaultAtMinute"
                class="mt-1"
                type="number"
                :min="0"
                :max="59"
              />
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="form.errors.defaultAtMinute"
                />
              </template>
            </HtFormControl>
            <HtFormControl
              :id="'defaultAtSecond-'+entry.user.id"
              :label="$t('botSettings.fields.defaultAtSecond.displayName', {
                atCommandName: $t('botSettings.advancedSettings.atCommandName'),
                secondOptionName: $t('botSettings.advancedSettings.secondOptionName'),
              })"
            >
              <HtInput
                v-model="form.defaultAtSecond"
                name="defaultAtSecond"
                class="mt-1"
                type="number"
                :min="0"
                :max="59"
              />
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="form.errors.defaultAtSecond"
                />
              </template>
            </HtFormControl>
          </HtCollapsible>
        </HtFormControlWrap>
      </HtFormControlGroup>

      <pre v-if="devMode"><code>{{ JSON.stringify(form.data(), null, 2) }}</code></pre>

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
          class="mt-2"
        />
      </div>
    </form>
  </HtCard>
</template>

<style scoped>

</style>
