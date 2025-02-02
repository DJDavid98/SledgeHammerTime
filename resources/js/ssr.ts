import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { i18nVue } from 'laravel-vue-i18n';
import { createSSRApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import './moment';

createServer((page) =>
  createInertiaApp({
    page,
    render: renderToString,
    title: (title) => title ? `${title} - ${page.props.app.name}` : page.props.app.name,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ App, props, plugin }) {
      return createSSRApp({ render: () => h(App, props) })
        .use(plugin)
        .use(ZiggyVue, {
          ...page.props.ziggy,
          location: new URL(page.props.ziggy.location),
        })
        .use(i18nVue, {
          lang: page.props.app.locale,
          fallbackLang: 'en',
          fallbackMissingTranslations: true,
          resolve: (lang: string) => {
            const langJsonImporters = import.meta.glob(`../../lang/php_*.json`, { eager: true });
            const result = langJsonImporters[`../../lang/php_${lang}.json`];
            if (typeof result !== 'object' || result === null || !('default' in result)) {
              throw new Error(`Missing default export in json for lang ${lang}`);
            }
            return result.default;
          },
        });
    },
  }),
);
