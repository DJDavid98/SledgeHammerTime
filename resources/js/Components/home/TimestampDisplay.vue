<script setup lang="ts">
import CustomAlert from '@/Components/CustomAlert.vue';
import DateTimePicker from '@/Components/home/DateTimePicker.vue';
import TimestampTable from '@/Components/home/table/TimestampTable.vue';
import { AvailableLanguage } from '@/utils/language-settings';
import { usePage } from '@inertiajs/vue3';
import Cookies from 'js-cookie';
import { wTrans } from 'laravel-vue-i18n';
import moment from 'moment';
import { computed, onMounted, ref } from 'vue';

const page = usePage();
const locale = computed(() => page.props.app.locale as AvailableLanguage);
const showHowTo = ref(false);
const howToCookieName = 'how-to-dismiss';
const howToCookieValue = 'how-to-dismiss';

const handleHowToClose = () => {
  Cookies.set(howToCookieName, howToCookieValue, {
    expires: moment().add(2, 'years').toDate(),
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
  <CustomAlert
    v-if="showHowTo"
    type="info"
    :title="$t('global.seoDescription')"
    :text="$t('timestampPicker.howTo', { syntaxColName })"
    @close="handleHowToClose"
  />

  <article class="my-0">
    <DateTimePicker />

    <TimestampTable />
  </article>
</template>
