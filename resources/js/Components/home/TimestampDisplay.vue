<script setup lang="ts">
import DateTimePicker from '@/Components/home/DateTimePicker.vue';
import TimestampTable from '@/Components/home/table/TimestampTable.vue';
import { dateTimeLibraryInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { AvailableLanguage } from '@/utils/language-settings';
import { usePage } from '@inertiajs/vue3';
import Cookies from 'js-cookie';
import { wTrans } from 'laravel-vue-i18n';
import { computed, inject, onMounted, ref } from 'vue';

const dtl = inject(dateTimeLibraryInject);
const page = usePage();
const locale = computed(() => page.props.app.locale as AvailableLanguage);
const showHowTo = ref(false);
const howToCookieName = 'how-to-dismiss';
const howToCookieValue = 'how-to-dismiss';

const handleHowToClose = () => {
  Cookies.set(howToCookieName, howToCookieValue, {
    expires: dtl?.value.now().addYears(2).toDate(),
  });
  showHowTo.value = false;
};

const syntaxColName = computed(() => {
  const originalText = wTrans('timestampPicker.table.syntaxColumn');
  // Lowercase column name in text only for this language
  if (locale.value === 'pt-BR') {
    return originalText.value.toLowerCase();
  }
  return originalText.value;
});

onMounted(() => {
  showHowTo.value = Cookies.get(howToCookieName) !== howToCookieValue;
});
</script>

<template>
  <HtAlert
    v-if="showHowTo"
    type="info"
    @close="handleHowToClose"
  >
    <template #title>
      {{ $t('global.seoDescription') }}
    </template>
    <template #text>
      {{ $t('timestampPicker.howTo', { syntaxColName }) }}
    </template>
  </HtAlert>

  <HtCard>
    <DateTimePicker />

    <TimestampTable />
  </HtCard>
</template>
