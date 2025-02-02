import moment from 'moment-timezone';
import latestTimezoneData from 'moment-timezone/data/packed/latest.json';

export const momentLocaleMap = {
  // @ts-expect-error (Import is correct)
  'ar': () => import('moment/dist/locale/ar'),
  // @ts-expect-error (Import is correct)
  'bg': () => import('moment/dist/locale/bg'),
  // @ts-expect-error (Import is correct)
  'ca': () => import('moment/dist/locale/ca'),
  // @ts-expect-error (Import is correct)
  'cs': () => import('moment/dist/locale/cs'),
  // @ts-expect-error (Import is correct)
  'da': () => import('moment/dist/locale/da'),
  // @ts-expect-error (Import is correct)
  'de': () => import('moment/dist/locale/de'),
  // @ts-expect-error (Import is correct)
  'el': () => import('moment/dist/locale/el'),
  // @ts-expect-error (Import is correct)
  'en-gb': () => import('moment/dist/locale/en-gb'),
  // @ts-expect-error (Import is correct)
  'es': () => import('moment/dist/locale/es'),
  // @ts-expect-error (Import is correct)
  'fa': () => import('moment/dist/locale/fa'),
  // @ts-expect-error (Import is correct)
  'fr': () => import('moment/dist/locale/fr'),
  // @ts-expect-error (Import is correct)
  'he': () => import('moment/dist/locale/he'),
  // @ts-expect-error (Import is correct)
  'hi': () => import('moment/dist/locale/hi'),
  // @ts-expect-error (Import is correct)
  'hr': () => import('moment/dist/locale/hr'),
  // @ts-expect-error (Import is correct)
  'hu': () => import('moment/dist/locale/hu'),
  // @ts-expect-error (Import is correct)
  'id': () => import('moment/dist/locale/id'),
  // @ts-expect-error (Import is correct)
  'it': () => import('moment/dist/locale/it'),
  // @ts-expect-error (Import is correct)
  'ja': () => import('moment/dist/locale/ja'),
  // @ts-expect-error (Import is correct)
  'ko': () => import('moment/dist/locale/ko'),
  // @ts-expect-error (Import is correct)
  'lt': () => import('moment/dist/locale/lt'),
  // @ts-expect-error (Import is correct)
  'lv': () => import('moment/dist/locale/lv'),
  // @ts-expect-error (Import is correct)
  'ms': () => import('moment/dist/locale/ms'),
  // @ts-expect-error (Import is correct)
  'nl': () => import('moment/dist/locale/nl'),
  // @ts-expect-error (Import is correct)
  'pl': () => import('moment/dist/locale/pl'),
  // @ts-expect-error (Import is correct)
  'pt': () => import('moment/dist/locale/pt'),
  // @ts-expect-error (Import is correct)
  'pt-br': () => import('moment/dist/locale/pt-br'),
  // @ts-expect-error (Import is correct)
  'ro': () => import('moment/dist/locale/ro'),
  // @ts-expect-error (Import is correct)
  'ru': () => import('moment/dist/locale/ru'),
  // @ts-expect-error (Import is correct)
  'sr': () => import('moment/dist/locale/sr'),
  // @ts-expect-error (Import is correct)
  'sv': () => import('moment/dist/locale/sv'),
  // @ts-expect-error (Import is correct)
  'th': () => import('moment/dist/locale/th'),
  // @ts-expect-error (Import is correct)
  'tr': () => import('moment/dist/locale/tr'),
  // @ts-expect-error (Import is correct)
  'uk': () => import('moment/dist/locale/uk'),
  // @ts-expect-error (Import is correct)
  'ur': () => import('moment/dist/locale/ur'),
  // @ts-expect-error (Import is correct)
  'vi': () => import('moment/dist/locale/vi'),
  // @ts-expect-error (Import is correct)
  'zh-cn': () => import('moment/dist/locale/zh-cn'),
  // @ts-expect-error (Import is correct)
  'zh-tw': () => import('moment/dist/locale/zh-tw'),
};

moment.tz.load(latestTimezoneData);
moment.relativeTimeThreshold('s', 60);
moment.relativeTimeThreshold('ss', 0);
