export const suggestionItemClass = 'combobox-suggestion-item';
export const selectedClass = 'selected';
export const selectedSelector = `.${selectedClass}`;
export const highlightedClass = 'highlighted';
export const highlightedSelector = `.${highlightedClass}`;

export interface ComboboxOption {
  label: string;
  value: string;
}

export const normalizeQueryValue = (value: string) => value.trim().toLowerCase().replace(/\s+/g, '_');
