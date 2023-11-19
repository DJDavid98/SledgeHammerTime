<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
  <nav class="container-fluid backdrop sticky">
    <ul>
      <li>
        <Link :href="route('home')" class="brand fs-15">
          <ApplicationLogo />
          <span class="ms-2">{{ $page.props.app.name }}</span>
        </Link>
      </li>
    </ul>
    <ul>
      <template v-if="$page.props.auth.user">
        <li>
          <Link :href="route('settings')">{{ $t('global.nav.botSettings') }}</Link>
        </li>
        <li role="list" dir="rtl">
          <a href="#" aria-haspopup="listbox">{{ $page.props.auth.user.name }}</a>
          <ul role="listbox">
            <li>
              <Link :href="route('profile.edit')">{{ $t('global.nav.profile') }}</Link>
            </li>
            <li>
              <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  role="button"
                  class="outline"
              >{{ $t('global.nav.logout') }}
              </Link>
            </li>
          </ul>
        </li>
      </template>

      <template v-else>
        <li>
          <a href="/oauth/redirect/discord" role="button">{{ $t('global.nav.login') }}</a>
        </li>
      </template>
    </ul>
  </nav>
</template>
