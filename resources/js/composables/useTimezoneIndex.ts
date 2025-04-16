import { normalizeQueryValue } from '@/utils/combobox';
import levenshtein from 'js-levenshtein';
import { computed, Ref } from 'vue';

export interface DynamicIndexApi {
  find(input: string): string[];
}

const specialCharRegex = /\/(\w+)$/;
export const useTimezoneIndex = (dataSource: Ref<{ value: string }[]>): DynamicIndexApi => {
  const indexedData = computed<Record<string, string>>(() => dataSource.value.reduce((record, data) => {
    const lowerName = data.value.toLowerCase();
    const lowerKeys = [lowerName];
    const slashPart = lowerName.match(specialCharRegex);
    if (slashPart) {
      lowerKeys.push(slashPart[1]);
    }
    return {
      ...record,
      ...lowerKeys.reduce((part, lowerKey) => {
        const newAdditions = { [lowerKey]: data.value };
        if (lowerKey.includes('_')) {
          const lowerKeyNoUnderscore = lowerKey.replace(/_/g, '');
          newAdditions[lowerKeyNoUnderscore] = data.value;
        }
        return ({
          ...part,
          ...newAdditions,
        });
      }, {}),
    };
  }, {}));

  return {
    find(value: string): string[] {
      const normalizedQueryValue = normalizeQueryValue(value);
      let candidates: string[] = [];
      if (normalizedQueryValue in indexedData.value) {
        candidates.push(indexedData.value[normalizedQueryValue]);
      }

      const matchingKeys = Object.keys(indexedData.value).filter((key) => key.includes(normalizedQueryValue));
      if (matchingKeys.length > 0) {
        const distanceCache: Record<string, number> = {};
        const getCachedDistance = (key: string): number => {
          if (!(key in distanceCache)) {
            distanceCache[key] = levenshtein(key, normalizedQueryValue);
          }
          return distanceCache[key];
        };
        const sortedKeys = matchingKeys.sort((a, b) => getCachedDistance(a) - getCachedDistance(b));
        candidates = Array.from(new Set([...candidates, ...sortedKeys.map(key => indexedData.value[key])]));
      }

      return candidates;
    },
  };
};
