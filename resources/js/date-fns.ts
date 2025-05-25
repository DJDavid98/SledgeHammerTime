import { Locale } from 'date-fns';

export const dateFnsLocaleMap: Record<string, () => Promise<{ default: Locale }>> = {
  // @ts-expect-error (Import is correct)
  'ar': () => import('date-fns/locale/ar'),
  // @ts-expect-error (Import is correct)
  'bg': () => import('date-fns/locale/bg'),
  // @ts-expect-error (Import is correct)
  'ca': () => import('date-fns/locale/ca'),
  // @ts-expect-error (Import is correct)
  'cs': () => import('date-fns/locale/cs'),
  // @ts-expect-error (Import is correct)
  'da': () => import('date-fns/locale/da'),
  // @ts-expect-error (Import is correct)
  'de': () => import('date-fns/locale/de'),
  // @ts-expect-error (Import is correct)
  'el': () => import('date-fns/locale/el'),
  // @ts-expect-error (Import is correct)
  'en': () => import('date-fns/locale/en-US'),
  // @ts-expect-error (Import is correct)
  'en-GB': () => import('date-fns/locale/en-GB'),
  // @ts-expect-error (Import is correct)
  'es': () => import('date-fns/locale/es'),
  // @ts-expect-error (Import is correct)
  'fa': () => import('date-fns/locale/fa-IR'),
  // @ts-expect-error (Import is correct)
  'fr': () => import('date-fns/locale/fr'),
  // @ts-expect-error (Import is correct)
  'he': () => import('date-fns/locale/he'),
  // @ts-expect-error (Import is correct)
  'hi': () => import('date-fns/locale/hi'),
  // @ts-expect-error (Import is correct)
  'hr': () => import('date-fns/locale/hr'),
  // @ts-expect-error (Import is correct)
  'hu': () => import('date-fns/locale/hu'),
  // @ts-expect-error (Import is correct)
  'id': () => import('date-fns/locale/id'),
  // @ts-expect-error (Import is correct)
  'it': () => import('date-fns/locale/it'),
  // @ts-expect-error (Import is correct)
  'ja': () => import('date-fns/locale/ja'),
  // @ts-expect-error (Import is correct)
  'ko': () => import('date-fns/locale/ko'),
  // @ts-expect-error (Import is correct)
  'lt': () => import('date-fns/locale/lt'),
  // @ts-expect-error (Import is correct)
  'lv': () => import('date-fns/locale/lv'),
  // @ts-expect-error (Import is correct)
  'ms': () => import('date-fns/locale/ms'),
  // @ts-expect-error (Import is correct)
  'nl': () => import('date-fns/locale/nl'),
  // @ts-expect-error (Import is correct)
  'pl': () => import('date-fns/locale/pl'),
  // @ts-expect-error (Import is correct)
  'pt': () => import('date-fns/locale/pt'),
  // @ts-expect-error (Import is correct)
  'pt-BR': () => import('date-fns/locale/pt-BR'),
  // @ts-expect-error (Import is correct)
  'ro': () => import('date-fns/locale/ro'),
  // @ts-expect-error (Import is correct)
  'ru': () => import('date-fns/locale/ru'),
  // @ts-expect-error (Import is correct)
  'sr': () => import('date-fns/locale/sr'),
  // @ts-expect-error (Import is correct)
  'sv': () => import('date-fns/locale/sv'),
  // @ts-expect-error (Import is correct)
  'th': () => import('date-fns/locale/th'),
  // @ts-expect-error (Import is correct)
  'tr': () => import('date-fns/locale/tr'),
  // @ts-expect-error (Import is correct)
  'uk': () => import('date-fns/locale/uk'),
  // @ts-expect-error (Import is correct)
  'vi': () => import('date-fns/locale/vi'),
  // @ts-expect-error (Import is correct)
  'zh-CN': () => import('date-fns/locale/zh-CN'),
  // @ts-expect-error (Import is correct)
  'zh-TW': () => import('date-fns/locale/zh-TW'),
};
