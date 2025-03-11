import levenshtein from 'js-levenshtein';
import { computed, Ref } from 'vue';

export interface DynamicIndexApi {
  find(input: string): string[];
}

const specialCharRegex = /\/(\w+)$/g;
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
      ...lowerKeys.reduce((part, lowerKey) => ({ ...part, [lowerKey]: data.value }), {}),
    };
  }, {}));

  return {
    find(value: string): string[] {
      const lowerValue = value.toLowerCase().replace(/\s+/g, '_');
      let candidates: string[] = [];
      if (lowerValue in indexedData.value) {
        candidates.push(indexedData.value[lowerValue]);
      }

      const matchingKeys = Object.keys(indexedData.value).filter((key) => key.includes(lowerValue));
      if (matchingKeys.length > 0) {
        const distanceCache: Record<string, number> = {};
        const getCachedDistance = (key: string): number => {
          if (!(key in distanceCache)) {
            distanceCache[key] = levenshtein(key, lowerValue);
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
