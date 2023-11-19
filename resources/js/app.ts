import './bootstrap';
import '../css/app.scss';

import { createApp, DefineComponent, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { i18nVue } from 'laravel-vue-i18n';
import { useMomentLocale } from '@/utils/moment';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
  title: (title) => title ? `${title} - ${appName}` : appName,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
  async setup({ el, App, props, plugin }) {
    await useMomentLocale(props.initialPage.props.app.locale);
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(i18nVue, {
        resolve: async (lang: string) => {
          const langs = import.meta.glob('../../lang/*.json');
          return await langs[`../../lang/php_${lang}.json`]();
        },
      })
      .mount(el);
  },
  progress: {
    color: '#FFC735',
  },
});
