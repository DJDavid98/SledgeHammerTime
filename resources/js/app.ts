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

createInertiaApp({
	title: (title) => title ? `${title} - ${appName}` : appName,
	resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
	setup({ el, App, props, plugin }) {
		useMomentLocale(props.initialPage.props.app.locale).then(() => {
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
		});
	},
	progress: {
		color: '#FFC735',
	},
});
