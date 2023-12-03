import moment from 'moment-timezone';
import latestTimezoneData from 'moment-timezone/data/packed/latest.json';

export const momentLocaleMap = {
	// @ts-ignore
	'ar': () => import('moment/dist/locale/ar'),
	// @ts-ignore
	'bg': () => import('moment/dist/locale/bg'),
	// @ts-ignore
	'ca': () => import('moment/dist/locale/ca'),
	// @ts-ignore
	'cs': () => import('moment/dist/locale/cs'),
	// @ts-ignore
	'da': () => import('moment/dist/locale/da'),
	// @ts-ignore
	'de': () => import('moment/dist/locale/de'),
	// @ts-ignore
	'el': () => import('moment/dist/locale/el'),
	// @ts-ignore
	'en-GB': () => import('moment/dist/locale/en-gb'),
	// @ts-ignore
	'es': () => import('moment/dist/locale/es'),
	// @ts-ignore
	'fa': () => import('moment/dist/locale/fa'),
	// @ts-ignore
	'fr': () => import('moment/dist/locale/fr'),
	// @ts-ignore
	'he': () => import('moment/dist/locale/he'),
	// @ts-ignore
	'hi': () => import('moment/dist/locale/hi'),
	// @ts-ignore
	'hr': () => import('moment/dist/locale/hr'),
	// @ts-ignore
	'hu': () => import('moment/dist/locale/hu'),
	// @ts-ignore
	'id': () => import('moment/dist/locale/id'),
	// @ts-ignore
	'it': () => import('moment/dist/locale/it'),
	// @ts-ignore
	'ja': () => import('moment/dist/locale/ja'),
	// @ts-ignore
	'ko': () => import('moment/dist/locale/ko'),
	// @ts-ignore
	'lt': () => import('moment/dist/locale/lt'),
	// @ts-ignore
	'lv': () => import('moment/dist/locale/lv'),
	// @ts-ignore
	'ms': () => import('moment/dist/locale/ms'),
	// @ts-ignore
	'nl': () => import('moment/dist/locale/nl'),
	// @ts-ignore
	'pl': () => import('moment/dist/locale/pl'),
	// @ts-ignore
	'pt': () => import('moment/dist/locale/pt'),
	// @ts-ignore
	'pt-BR': () => import('moment/dist/locale/pt-br'),
	// @ts-ignore
	'ro': () => import('moment/dist/locale/ro'),
	// @ts-ignore
	'ru': () => import('moment/dist/locale/ru'),
	// @ts-ignore
	'sr': () => import('moment/dist/locale/sr'),
	// @ts-ignore
	'sv': () => import('moment/dist/locale/sv'),
	// @ts-ignore
	'th': () => import('moment/dist/locale/th'),
	// @ts-ignore
	'tr': () => import('moment/dist/locale/tr'),
	// @ts-ignore
	'uk': () => import('moment/dist/locale/uk'),
	// @ts-ignore
	'ur': () => import('moment/dist/locale/ur'),
	// @ts-ignore
	'vi': () => import('moment/dist/locale/vi'),
	// @ts-ignore
	'zh-CN': () => import('moment/dist/locale/zh-cn'),
	// @ts-ignore
	'zh-TW': () => import('moment/dist/locale/zh-tw'),
};

moment.tz.load(latestTimezoneData);
moment.relativeTimeThreshold('s', 60);
moment.relativeTimeThreshold('ss', 0);
