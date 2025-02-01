<script setup lang="ts">
import MinimalLayout from '@/Layouts/MinimalLayout.vue';
import AddLink from '@/Pages/AddApp/AddLink.vue';
import { getAppName } from '@/utils/app';
import { faSquarePlus, faUserPlus } from '@fortawesome/free-solid-svg-icons';
import { Head } from '@inertiajs/vue3';

const appName = getAppName();
</script>

<template>
  <Head :title="$t('timestampPicker.usefulLinks.bot.header')" />
  <MinimalLayout>
    <div class="page">
      <img
        src="/logos/logo.png"
        alt=""
        class="logo"
      >
      <h1 class="title">
        {{ appName }}
      </h1>
      <p class="subtitle">
        {{ $t('addApp.title') }}
      </p>
      <div
        class="add-links-wrap"
      >
        <AddLink
          install-type="user"
          :start-icon="faUserPlus"
          :title="$t('addApp.user.title')"
          :description="$t('addApp.user.description')"
        />
        <AddLink
          install-type="guild"
          :start-icon="faSquarePlus"
          :title="$t('addApp.guild.title')"
          :description="$t('addApp.guild.description')"
        />
      </div>
    </div>
  </MinimalLayout>
</template>

<style lang="scss">
@use "../../../css/design";

.page {
  color: design.app-color-light('add-app-color');
  background-color: design.app-color-light('add-app-bg');
  padding: 1em;
  width: 100%;
  min-height: 100vh;
  display: flex;
  flex-flow: column;
  justify-content: center;
  align-items: center;

  @include design.if-dark {
    background-color: design.app-color-dark('add-app-bg');
    color: design.app-color-dark('add-app-color');
  }
}

.logo {
  width: 80px;
  height: 80px;
  border-radius: 20px;
  background-color: #000;
  border: 1px solid design.app-color-light('add-app-logo-border');

  @include design.if-dark {
    border-color: design.app-color-dark('add-app-logo-border');
  }
}

.title {
  font-size: 1.4rem;
  margin: 0.5em 0;
}

.subtitle {
  font-size: 0.9rem;
  margin: 0 0 1em;
}

.title,
.subtitle {
  text-align: center;
}

.add-links-wrap {
  gap: 0.15em;
  display: flex;
  flex-direction: column;
}

.add-link {
  display: flex;
  flex-flow: row nowrap;
  align-items: center;
  gap: 1em;
  padding: 0.5em 1em;
  background-color: design.app-color-light('add-app-link-bg');
  text-decoration: none;

  &:first-child {
    border-top-left-radius: 0.5em;
    border-top-right-radius: 0.5em;
  }

  &:last-child {
    border-bottom-left-radius: 0.5em;
    border-bottom-right-radius: 0.5em;
  }

  &:hover {
    background-color: design.app-color-light('add-app-link-hover-bg');
  }

  @include design.if-dark {
    background-color: design.app-color-dark('add-app-link-bg');

    &:hover {
      background-color: design.app-color-dark('add-app-link-hover-bg');
    }
  }
}

.add-link-icon {
  color: design.app-color-light('add-app-link-icon');
  font-size: 1.4em;

  @include design.if-dark {
    color: design.app-color-dark('add-app-link-icon');
  }
}

.add-link-text {
  flex-grow: 1;
  display: flex;
  flex-flow: column nowrap;
  gap: 0.15em;

  .add-link-title {
    font-size: 1rem;
    color: design.app-color-light('add-app-link-title');
    margin: 0;

    @include design.if-dark {
      color: design.app-color-dark('add-app-link-title');
    }
  }

  .add-link-description {
    font-size: 0.8rem;
    color: design.app-color-light('add-app-link-description');
    margin: 0;

    @include design.if-dark {
      color: design.app-color-dark('add-app-link-description');
    }
  }
}
</style>
