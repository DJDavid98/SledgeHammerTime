<script setup lang="ts">
import Popup, { CustomPopupApi, Focusable } from '@/Components/CustomPopup.vue';
import TimeZoneSelect from '@/Components/TimeZoneSelect.vue';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import HtFormRadio from '@/Reusable/HtFormRadio.vue';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import HtInputGropupText from '@/Reusable/HtInputGropupText.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { guessInitialTimezoneName } from '@/utils/time';
import { ref, useTemplateRef } from 'vue';

const defaultZoneName = guessInitialTimezoneName();
const offsetHours = ref(0);
const offsetMinutes = ref(0);
const zoneName = ref<string>(defaultZoneName);
const mode = ref<TimeZoneSelectionType | null>(null);

const emit = defineEmits<{
  (e: 'change', timezone: TimezoneSelection): void;
}>();

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const offsetHoursRef = useTemplateRef<InputApi>('offset-hours');
const timezoneSelectRef = useTemplateRef<InputApi>('timezone-select');
const formRef = useTemplateRef<HTMLFormElement>('form-el');

const select = () => {
  switch (mode.value) {
    case TimeZoneSelectionType.OFFSET:
      emit('change', { type: TimeZoneSelectionType.OFFSET, hours: offsetHours.value, minutes: offsetMinutes.value });
      break;
    case TimeZoneSelectionType.ZONE_NAME:
      emit('change', { type: TimeZoneSelectionType.ZONE_NAME, name: zoneName.value });
      break;
  }
};
const selectAndClose = () => {
  const focusedEl = formRef.value?.querySelector<HTMLElement>(':focus');
  if (focusedEl) {
    focusedEl.blur();
  }
  select();
  close();
};
const open = (initialValue: TimezoneSelection, focusOnClose?: Focusable | null) => {
  popupRef.value?.open(focusOnClose);
  mode.value = initialValue.type;
  window.requestAnimationFrame(() => {
    switch (initialValue.type) {
      case TimeZoneSelectionType.OFFSET:
        offsetHours.value = initialValue.hours;
        offsetMinutes.value = initialValue.minutes;
        zoneName.value = defaultZoneName;
        // @ts-expect-error The options syntax is not widely supported yet
        offsetHoursRef.value?.focus({ focusVisible: focusOnClose != null });
        break;
      case TimeZoneSelectionType.ZONE_NAME:
        offsetHours.value = 0;
        offsetMinutes.value = 0;
        zoneName.value = initialValue.name;
        // @ts-expect-error The options syntax is not widely supported yet
        timezoneSelectRef.value?.focus({ focusVisible: focusOnClose != null });
        break;
    }
  });
};
const close = () => {
  popupRef.value?.close();
};

const handleOffsetHoursBlur = inputRangeLimitBlurHandlerFactory(offsetHours);
const handleOffsetMinutesBlur = inputRangeLimitBlurHandlerFactory(offsetMinutes);

const handleModeRadioChange = (e: InputEvent, newType: TimeZoneSelectionType) => {
  if (e.target instanceof HTMLInputElement) {
    if (e.target.checked) {
      mode.value = newType;
    }
  }
};

export interface TimeZonePickerApi {
  open: typeof open;
}

defineExpose<TimeZonePickerApi>({
  open,
});
</script>

<template>
  <Popup
    ref="popup-el"
    :allow-overflow="true"
  >
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <HtFormControlGroup :vertical="true">
        <HtFormRadio
          id="mode-offset"
          name="mode"
          :checked="mode === TimeZoneSelectionType.OFFSET"
          :label="$t('timestampPicker.picker.label.modeOffset')"
          :checkboxes="true"
          @change="handleModeRadioChange($event, TimeZoneSelectionType.OFFSET)"
        />
      </HtFormControlGroup>
      <HtFormInputGroup dir="ltr">
        <HtInputGropupText>GMT (UTC)</HtInputGropupText>
        <HtInput
          ref="offset-hours"
          v-model="offsetHours"
          type="number"
          min="-14"
          max="14"
          class="grid-flex-item flex-basis-30"
          @blur="handleOffsetHoursBlur"
          @change.passive="mode = TimeZoneSelectionType.OFFSET"
        />
        <HtInput
          ref="offset-minutes"
          v-model="offsetMinutes"
          type="number"
          class="grid-flex-item flex-basis-30"
          min="0"
          max="59"
          @blur="handleOffsetMinutesBlur"
          @change.passive="mode = TimeZoneSelectionType.OFFSET"
        />
      </HtFormInputGroup>
      <HtFormControlGroup :vertical="true">
        <HtFormRadio
          id="mode-zone-name"
          name="mode"
          :checked="mode === TimeZoneSelectionType.ZONE_NAME"
          :label="$t('timestampPicker.picker.label.modeZoneName')"
          :checkboxes="true"
          @change="handleModeRadioChange($event, TimeZoneSelectionType.ZONE_NAME)"
        />
        <TimeZoneSelect
          ref="timezone-select"
          v-model="zoneName"
          @change.passive="mode = TimeZoneSelectionType.ZONE_NAME"
        />
      </HtFormControlGroup>
      <HtButtonGroup>
        <HtButton
          color="primary"
          :justify-center="true"
          type="submit"
        >
          {{ $t('actions.save_and_close') }}
        </HtButton>
        <HtButton
          :justify-center="true"
          @click="close"
        >
          {{ $t('actions.close') }}
        </HtButton>
      </HtButtonGroup>
    </form>
  </Popup>
</template>
