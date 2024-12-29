import { getAppName } from '@/utils/app';
import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { i18nVue } from 'laravel-vue-i18n';
import { createSSRApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import './moment';

const appName = getAppName();

createServer((page) =>
  createInertiaApp({
    page,
    render: renderToString,
    title: (title) => title ? `${title} - ${appName}` : appName,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ App, props, plugin }) {
      return createSSRApp({ render: () => h(App, props) })
        .use(plugin)
        .use(ZiggyVue, {
          // @ts-expect-error (Types do not like this)
          ...page.props.ziggy,
          // @ts-expect-error (Types do not like this)
          location: new URL(page.props.ziggy.location),
        }).use(i18nVue, {
          // eslint-disable-next-line @typescript-eslint/no-require-imports
          resolve: (lang: string) => require(`../../lang/${lang}.json`),
        });
    },
  }),
);
