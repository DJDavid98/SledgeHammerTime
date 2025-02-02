import moment from 'moment-timezone';
import latestTimezoneData from 'moment-timezone/data/packed/latest.json';

const isSsr = typeof window === 'undefined';

export const momentLocaleMap = {
  // @ts-expect-error (Import is correct)
  'ar': () => isSsr ? import('moment/locale/ar') : import('moment/dist/locale/ar'),
  // @ts-expect-error (Import is correct)
  'bg': () => isSsr ? import('moment/locale/bg') : import('moment/dist/locale/bg'),
  // @ts-expect-error (Import is correct)
  'ca': () => isSsr ? import('moment/locale/ca') : import('moment/dist/locale/ca'),
  // @ts-expect-error (Import is correct)
  'cs': () => isSsr ? import('moment/locale/cs') : import('moment/dist/locale/cs'),
  // @ts-expect-error (Import is correct)
  'da': () => isSsr ? import('moment/locale/da') : import('moment/dist/locale/da'),
  // @ts-expect-error (Import is correct)
  'de': () => isSsr ? import('moment/locale/de') : import('moment/dist/locale/de'),
  // @ts-expect-error (Import is correct)
  'el': () => isSsr ? import('moment/locale/el') : import('moment/dist/locale/el'),
  // @ts-expect-error (Import is correct)
  'en-gb': () => isSsr ? import('moment/locale/en-gb') : import('moment/dist/locale/en-gb'),
  // @ts-expect-error (Import is correct)
  'es': () => isSsr ? import('moment/locale/es') : import('moment/dist/locale/es'),
  // @ts-expect-error (Import is correct)
  'fa': () => isSsr ? import('moment/locale/fa') : import('moment/dist/locale/fa'),
  // @ts-expect-error (Import is correct)
  'fr': () => isSsr ? import('moment/locale/fr') : import('moment/dist/locale/fr'),
  // @ts-expect-error (Import is correct)
  'he': () => isSsr ? import('moment/locale/he') : import('moment/dist/locale/he'),
  // @ts-expect-error (Import is correct)
  'hi': () => isSsr ? import('moment/locale/hi') : import('moment/dist/locale/hi'),
  // @ts-expect-error (Import is correct)
  'hr': () => isSsr ? import('moment/locale/hr') : import('moment/dist/locale/hr'),
  // @ts-expect-error (Import is correct)
  'hu': () => isSsr ? import('moment/locale/hu') : import('moment/dist/locale/hu'),
  // @ts-expect-error (Import is correct)
  'id': () => isSsr ? import('moment/locale/id') : import('moment/dist/locale/id'),
  // @ts-expect-error (Import is correct)
  'it': () => isSsr ? import('moment/locale/it') : import('moment/dist/locale/it'),
  // @ts-expect-error (Import is correct)
  'ja': () => isSsr ? import('moment/locale/ja') : import('moment/dist/locale/ja'),
  // @ts-expect-error (Import is correct)
  'ko': () => isSsr ? import('moment/locale/ko') : import('moment/dist/locale/ko'),
  // @ts-expect-error (Import is correct)
  'lt': () => isSsr ? import('moment/locale/lt') : import('moment/dist/locale/lt'),
  // @ts-expect-error (Import is correct)
  'lv': () => isSsr ? import('moment/locale/lv') : import('moment/dist/locale/lv'),
  // @ts-expect-error (Import is correct)
  'ms': () => isSsr ? import('moment/locale/ms') : import('moment/dist/locale/ms'),
  // @ts-expect-error (Import is correct)
  'nl': () => isSsr ? import('moment/locale/nl') : import('moment/dist/locale/nl'),
  // @ts-expect-error (Import is correct)
  'pl': () => isSsr ? import('moment/locale/pl') : import('moment/dist/locale/pl'),
  // @ts-expect-error (Import is correct)
  'pt': () => isSsr ? import('moment/locale/pt') : import('moment/dist/locale/pt'),
  // @ts-expect-error (Import is correct)
  'pt-br': () => isSsr ? import('moment/locale/pt-br') : import('moment/dist/locale/pt-br'),
  // @ts-expect-error (Import is correct)
  'ro': () => isSsr ? import('moment/locale/ro') : import('moment/dist/locale/ro'),
  // @ts-expect-error (Import is correct)
  'ru': () => isSsr ? import('moment/locale/ru') : import('moment/dist/locale/ru'),
  // @ts-expect-error (Import is correct)
  'sr': () => isSsr ? import('moment/locale/sr') : import('moment/dist/locale/sr'),
  // @ts-expect-error (Import is correct)
  'sv': () => isSsr ? import('moment/locale/sv') : import('moment/dist/locale/sv'),
  // @ts-expect-error (Import is correct)
  'th': () => isSsr ? import('moment/locale/th') : import('moment/dist/locale/th'),
  // @ts-expect-error (Import is correct)
  'tr': () => isSsr ? import('moment/locale/tr') : import('moment/dist/locale/tr'),
  // @ts-expect-error (Import is correct)
  'uk': () => isSsr ? import('moment/locale/uk') : import('moment/dist/locale/uk'),
  // @ts-expect-error (Import is correct)
  'ur': () => isSsr ? import('moment/locale/ur') : import('moment/dist/locale/ur'),
  // @ts-expect-error (Import is correct)
  'vi': () => isSsr ? import('moment/locale/vi') : import('moment/dist/locale/vi'),
  // @ts-expect-error (Import is correct)
  'zh-cn': () => isSsr ? import('moment/locale/zh-cn') : import('moment/dist/locale/zh-cn'),
  // @ts-expect-error (Import is correct)
  'zh-tw': () => isSsr ? import('moment/locale/zh-tw') : import('moment/dist/locale/zh-tw'),
};

moment.tz.load(latestTimezoneData);
moment.relativeTimeThreshold('s', 60);
moment.relativeTimeThreshold('ss', 0);
