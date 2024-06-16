import { rangeLimitInput } from '@/utils/time';
import { Ref } from 'vue';

export const getAppName = () => import.meta.env.VITE_APP_NAME || 'Laravel';

export const inputRangeLimitBlurHandlerFactory = (numberRef: Ref<number>) => (e: FocusEvent): void => {
  const limitedValue = rangeLimitInput(e.target);
  if (limitedValue === numberRef.value)
    return;

  numberRef.value = limitedValue;
};
