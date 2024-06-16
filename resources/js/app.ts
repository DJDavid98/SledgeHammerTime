import { getAppName } from '@/utils/app';
import { useMomentLocale } from '@/utils/moment';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { i18nVue } from 'laravel-vue-i18n';

import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import '../css/app.scss';
import './bootstrap';

const appName = getAppName();
const getLangJsonPath = (lang: string) => `../../lang/php_${lang.replace(/^php_/, '')}.json`;

createInertiaApp({
  title: (title) => title ? `${title} - ${appName}` : appName,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    useMomentLocale(props.initialPage.props.app.locale).then(() => {
      createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(ZiggyVue, Ziggy)
        .use(i18nVue, {
          fallbackLang: 'en',
          fallbackMissingTranslations: true,
          resolve: async (lang: string) => {
            const langJsons = import.meta.glob('../../lang/*.json');
            const jsonPathForLocale = getLangJsonPath(lang);
            return await langJsons[jsonPathForLocale]();
          },
        })
        .mount(el);
    });
  },
  progress: {
    color: '#5865F2',
  },
});
