<script setup lang="ts">
import AddLink from '@/Pages/AddApp/AddLink.vue';
import { faSquarePlus, faUserPlus } from '@fortawesome/free-solid-svg-icons';

withDefaults(defineProps<{
  horizontal?: boolean;
  openInNewTab?: boolean;
}>(), {
  horizontal: false,
  openInNewTab: false,
});
</script>

<template>
  <div
    :class="['add-links-wrap',{horizontal}]"
  >
    <AddLink
      install-type="user"
      :start-icon="faUserPlus"
      :title="$t('addApp.user.title')"
      :description="$t('addApp.user.description')"
      :open-in-new-tab="openInNewTab"
    />
    <AddLink
      install-type="guild"
      :start-icon="faSquarePlus"
      :title="$t('addApp.guild.title')"
      :description="$t('addApp.guild.description')"
      :open-in-new-tab="openInNewTab"
    />
  </div>
</template>

<style lang="scss">
@use "../../../css/design";

.add-links-wrap {
  gap: 0.15em;
  display: flex;
  flex-direction: column;

  &.horizontal {
    flex-flow: row;
    justify-content: stretch;
    width: 100%;
  }

  &:not(.horizontal) {
    .add-link {
      &:first-child {
        border-top-left-radius: 0.5em;
        border-top-right-radius: 0.5em;
      }

      &:last-child {
        border-bottom-left-radius: 0.5em;
        border-bottom-right-radius: 0.5em;
      }
    }
  }

  &.horizontal {
    .add-link {
      flex: 1 1 auto;

      @include design.if-ltr {
        &:first-child {
          border-top-left-radius: 0.5em;
          border-bottom-left-radius: 0.5em;
        }

        &:last-child {
          border-top-right-radius: 0.5em;
          border-bottom-right-radius: 0.5em;
        }
      }

      @include design.if-rtl {
        &:first-child {
          border-top-right-radius: 0.5em;
          border-bottom-right-radius: 0.5em;
        }

        &:last-child {
          border-top-left-radius: 0.5em;
          border-bottom-left-radius: 0.5em;
        }
      }
    }
  }
}

.add-link {
  display: flex;
  flex-flow: row nowrap;
  align-items: center;
  gap: 1em;
  padding: 0.5em 1em;
  background-color: design.app-color-light('add-app-link-bg');
  text-decoration: none;

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
