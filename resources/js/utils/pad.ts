export const pad = (value: number | string, digits: number) => {
  const valueString = typeof value === 'number' ? value.toString() : value;
  if (valueString.length < digits) {
    return '0'.repeat(digits - valueString.length) + valueString;
  }
  return valueString;
};
