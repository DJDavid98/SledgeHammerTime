<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtContent from '@/Reusable/HtContent.vue';
import HtHeader from '@/Reusable/HtHeader.vue';
import { faClipboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head } from '@inertiajs/vue3';
import { loremIpsum } from 'lorem-ipsum';

const placeholderText = loremIpsum();
</script>

<template>
  <Head :title="$t('design.title')" />

  <HtHeader>
    <template #left>
      Left
    </template>
    <template #brand>
      Brand
    </template>
    <template #right>
      Right
    </template>
  </HtHeader>

  <HtContent>
    <HtAlert type="info">
      <template #title>
        Info Alert
      </template>
      <template #text>
        {{ placeholderText }}
      </template>
    </HtAlert>
    <HtAlert type="success">
      <template #title>
        Success Alert
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
    <HtAlert type="error">
      <template #title>
        Error Alert
      </template>
      <template #text>
        {{ placeholderText }}
      </template>
    </HtAlert>

    <HtCard>
      <p>Logo</p>

      <ApplicationLogo :size="100" />

      <p>Components</p>

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
      </div>
    </HtCard>
    <HtCard>
      Second card content
    </HtCard>
  </HtContent>
</template>

<style scoped>

</style>
