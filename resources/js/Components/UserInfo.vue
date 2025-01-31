<script setup lang="ts">
import { currentLanguageInject, pagePropsInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { faCaretDown, faCaretUp, faUser } from '@fortawesome/free-solid-svg-icons';
import { Link } from '@inertiajs/vue3';
import { computed, inject, ref } from 'vue';

const page = inject(pagePropsInject);
const currentLanguage = inject(currentLanguageInject);
const userInfo = computed(() => page?.value?.auth?.user);

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
          :href="route('settings', { locale: currentLanguage?.locale ?? FALLBACK_LANGUAGE })"
        >
          {{ $t('global.nav.botSettings') }}
        </Link>
      </li>
      <li>
        <Link
          :href="route('profile.edit', { locale: currentLanguage?.locale ?? FALLBACK_LANGUAGE })"
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
      :href="route('login', { locale: currentLanguage?.locale ?? FALLBACK_LANGUAGE })"
      :external="true"
      :target-blank="false"
    >
      {{ $t('actions.log_in') }}
    </HtLinkButton>
  </div>
</template>
