<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { AvailableLanguage } from '@/utils/language-settings';
import { faCaretDown, faCaretUp, faUser } from '@fortawesome/free-solid-svg-icons';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();

const locale = computed(() => page.props.app.locale as AvailableLanguage);
const userInfo = computed(() => page.props.auth?.user);

const userDropdownVisible = ref(false);

const toggleUserDropdown = (e: MouseEvent) => {
  e.preventDefault();

  if (!userInfo.value) return;

  userDropdownVisible.value = !userDropdownVisible.value;
};
</script>

<template>
  <HtCollapsible :visible="userDropdownVisible">
    <ul
      v-if="userInfo"
      :class="['user-dropdown', { visible: userDropdownVisible }]"
    >
      <li>
        <Link
          :href="route('settings', { locale })"
        >
          {{ $t('global.nav.botSettings') }}
        </Link>
      </li>
      <li>
        <Link
          :href="route('profile.edit', { locale })"
        >
          {{ $t('global.nav.profile') }}
        </Link>
      </li>
      <li>
        <Link
          :href="route('logout')"
          method="post"
          as="button"
          class="cursor-pointer"
        >
          {{ $t('actions.log_out') }}
        </Link>
      </li>
    </ul>
  </HtCollapsible>
  <div class="user-info">
    <HtButton
      v-if="userInfo"
      color="primary"
      :icon-start="faUser"
      :icon-end="userDropdownVisible ? faCaretDown : faCaretUp"
      :pressed="userDropdownVisible"
      @click="toggleUserDropdown"
    >
      {{ userInfo?.name ?? $t('global.guest') }}
    </HtButton>

    <HtLinkButton
      v-else
      color="primary"
      :href="route('login', { locale })"
      :external="true"
      :target-blank="false"
    >
      {{ $t('actions.log_in') }}
    </HtLinkButton>
  </div>
</template>
