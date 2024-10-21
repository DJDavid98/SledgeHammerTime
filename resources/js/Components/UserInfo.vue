<script setup lang="ts">
import { AvailableLanguage } from '@/utils/language-settings';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const locale = computed(() => page.props.app.locale as AvailableLanguage);
</script>

<template>
  <template v-if="$page.props.auth.user">
    <details class="dropdown user-dropdown">
      <summary>
        <span class="user-icon">👤</span>
        <span class="user-name">{{ $page.props.auth.user.name }}</span>
      </summary>
      <ul role="listbox">
        <li>
          <Link :href="route('settings', { locale })">
            {{ $t('global.nav.botSettings') }}
          </Link>
        </li>
        <li>
          <Link :href="route('profile.edit', { locale })">
            {{ $t('global.nav.profile') }}
          </Link>
        </li>
        <li>
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            role="button"
            class="outline"
          >
            {{ $t('global.nav.logout') }}
          </Link>
        </li>
      </ul>
    </details>
  </template>

  <template v-else>
    <a
      :href="route('login', { locale })"
      role="button"
    >{{ $t('global.nav.login') }}</a>
  </template>
</template>
