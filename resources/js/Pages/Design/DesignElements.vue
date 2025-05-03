<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { localSettings, sidebarState } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { faClipboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { loremIpsum } from 'lorem-ipsum';
import { inject } from 'vue';

const placeholderText = loremIpsum();

const sidebarStateValue = inject(sidebarState);
const localSettingsValue = inject(localSettings);
</script>

<template>
  <HtAlert type="info">
    <template #title>
      Info Alert
    </template>
    <template #text>
      {{ placeholderText }}
    </template>
  </HtAlert>
  <HtAlert type="warning">
    <template #title>
      Warning Alert
    </template>
    <template #text>
      {{ placeholderText }}
    </template>
  </HtAlert>
  <HtAlert type="unknown">
    <template #title>
      Unknown Alert
    </template>
    <template #text>
      {{ placeholderText }}
    </template>
  </HtAlert>
  <HtAlert
    type="unknown"
    :closable="false"
  >
    <template #title>
      Un-closable Alert
    </template>
  </HtAlert>
  <HtAlert
    type="unknown"
    :closable="false"
  >
    <template #text>
      Text-only
    </template>
  </HtAlert>

  <HtCard>
    <template #header>
      <h2>2nd Level Card header</h2>
    </template>

    <p class="mb-3">
      Logo
    </p>

    <ApplicationLogo :size="100" />

    <p class="mb-3">
      Components
    </p>

    <div>
      <HtButton>Simple button</HtButton>
      &nbsp;
      <HtButton :disabled="true">
        Disabled default button
      </HtButton>
      &nbsp;
      <HtButton :loading="true">
        Loading default button
      </HtButton>
      &nbsp;
      <HtButton>
        <FontAwesomeIcon :icon="faClipboard" />
      </HtButton>
      &nbsp;
      <HtButton :disabled="true">
        <FontAwesomeIcon :icon="faClipboard" />
      </HtButton>
      &nbsp;
      <HtButton :loading="true">
        <FontAwesomeIcon :icon="faClipboard" />
      </HtButton>
    </div>
    <div>&nbsp;</div>
    <div>
      <HtButton color="primary">
        Primary button
      </HtButton>
      &nbsp;
      <HtButton
        color="primary"
        :disabled="true"
      >
        Disabled primary button
      </HtButton>
      &nbsp;
      <HtButton
        color="primary"
        :loading="true"
      >
        Loading primary button
      </HtButton>
      &nbsp;
      <HtButton color="primary">
        <FontAwesomeIcon :icon="faClipboard" />
      </HtButton>
      &nbsp;
      <HtButton
        color="primary"
        :disabled="true"
      >
        <FontAwesomeIcon :icon="faClipboard" />
      </HtButton>
      &nbsp;
      <HtButton
        color="primary"
        :loading="true"
      >
        <FontAwesomeIcon :icon="faClipboard" />
      </HtButton>
    </div>
  </HtCard>
  <HtCard>
    <template #header>
      Sidebar control
    </template>

    <dl class="mb-3">
      <dt>isOpen</dt>
      <dd>{{ sidebarStateValue?.isOpen }}</dd>
      <dt>isOnRight</dt>
      <dd>{{ localSettingsValue?.sidebarOnRight }}</dd>
    </dl>

    <div>
      <HtButton
        color="success"
        @click="sidebarStateValue?.setIsOpen(true)"
      >
        Open
      </HtButton>
      &nbsp;
      <HtButton
        color="danger"
        @click="sidebarStateValue?.setIsOpen(false)"
      >
        Close
      </HtButton>
      &nbsp;
      <HtButton @click="localSettingsValue?.toggleSidebarOnRight()">
        Toggle Left/Right
      </HtButton>
    </div>
  </HtCard>
</template>

