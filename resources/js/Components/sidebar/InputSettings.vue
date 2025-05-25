<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import { localSettings } from '@/injection-keys';
import HtFormCheckboxControlled from '@/Reusable/HtFormCheckboxControlled.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import { faGear } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';

const settings = inject(localSettings);
</script>

<template>
  <section>
    <header>
      <FontAwesomeIcon
        :icon="faGear"
        :fixed-width="true"
      />
      <span class="ms-1">{{ $t('global.sidebar.inputSettings.title') }}</span>
    </header>
    <HtFormControlGroup>
      <HtFormCheckboxControlled
        id="custom-inputs"
        :label="$t('global.sidebar.inputSettings.customInputs.label')"
        :checked="Boolean(settings?.customInputEnabled)"
        @change="settings?.toggleCustomInput"
      >
        <template #message>
          <FormMessage
            :message="$t('global.sidebar.inputSettings.customInputs.description')"
            class="mt-1"
          />
        </template>
      </HtFormCheckboxControlled>
      <HtFormCheckboxControlled
        id="separate-inputs"
        :label="$t('global.sidebar.inputSettings.separateInputs.label')"
        :checked="!settings?.combinedInputsEnabled"
        @change="settings?.toggleSeparateInputs"
      >
        <template #message>
          <FormMessage
            :message="$t('global.sidebar.inputSettings.separateInputs.description')"
            class="mt-1"
          />
        </template>
      </HtFormCheckboxControlled>
      <HtFormCheckboxControlled
        id="date-time-library"
        :label="$t('global.sidebar.inputSettings.newDateTimeLibrary.label')"
        :checked="Boolean(settings?.dateFnsEnabled)"
        @change="settings?.toggleDateFnsEnabled"
      >
        <template #message>
          <FormMessage
            :message="$t('global.sidebar.inputSettings.newDateTimeLibrary.description')"
            class="mt-1"
          />
        </template>
      </HtFormCheckboxControlled>
    </HtFormControlGroup>
  </section>
</template>

<style scoped>

</style>
