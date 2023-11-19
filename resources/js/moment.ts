import moment from 'moment-timezone';
import latestTimezoneData from 'moment-timezone/data/packed/latest.json';

export const momentLocaleMap = {
  'ar': () => import('moment/dist/locale/ar'),
  'bg': () => import('moment/dist/locale/bg'),
  'ca': () => import('moment/dist/locale/ca'),
  'cs': () => import('moment/dist/locale/cs'),
  'da': () => import('moment/dist/locale/da'),
  'de': () => import('moment/dist/locale/de'),
  'el': () => import('moment/dist/locale/el'),
  'en-GB': () => import('moment/dist/locale/en-gb'),
  'es': () => import('moment/dist/locale/es'),
  'fa': () => import('moment/dist/locale/fa'),
  'fr': () => import('moment/dist/locale/fr'),
  'he': () => import('moment/dist/locale/he'),
  'hi': () => import('moment/dist/locale/hi'),
  'hr': () => import('moment/dist/locale/hr'),
  'hu': () => import('moment/dist/locale/hu'),
  'id': () => import('moment/dist/locale/id'),
  'it': () => import('moment/dist/locale/it'),
  'ja': () => import('moment/dist/locale/ja'),
  'ko': () => import('moment/dist/locale/ko'),
  'lt': () => import('moment/dist/locale/lt'),
  'lv': () => import('moment/dist/locale/lv'),
  'ms': () => import('moment/dist/locale/ms'),
  'nl': () => import('moment/dist/locale/nl'),
  'pl': () => import('moment/dist/locale/pl'),
  'pt': () => import('moment/dist/locale/pt'),
  'pt-BR': () => import('moment/dist/locale/pt-br'),
  'ro': () => import('moment/dist/locale/ro'),
  'ru': () => import('moment/dist/locale/ru'),
  'sr': () => import('moment/dist/locale/sr'),
  'sv': () => import('moment/dist/locale/sv'),
  'th': () => import('moment/dist/locale/th'),
  'tr': () => import('moment/dist/locale/tr'),
  'uk': () => import('moment/dist/locale/uk'),
  'ur': () => import('moment/dist/locale/ur'),
  'vi': () => import('moment/dist/locale/vi'),
  'zh-CN': () => import('moment/dist/locale/zh-cn'),
  'zh-TW': () => import('moment/dist/locale/zh-tw'),
};

moment.tz.load(latestTimezoneData);
moment.relativeTimeThreshold('s', 60);
moment.relativeTimeThreshold('ss', 0);
