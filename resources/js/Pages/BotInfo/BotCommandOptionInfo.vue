<script setup lang="ts">
import { getBotCommandTranslationKey } from '@/utils/translation';
import { computed } from 'vue';

export interface BotCommandOption {
  id: string;
  name: string;
  description: string;
  required: boolean | null;
}

const props = defineProps<{
  commandId: string,
  option: BotCommandOption,
  translations: Record<string, string>,
}>();

const localizedName = computed(() => {
  const key = getBotCommandTranslationKey({
    command_id: props.commandId,
    option_id: props.option.id,
    field: 'name',
  });

  return props.translations[key] ?? props.option.name;
});
const localizedDescription = computed(() => {
  const key = getBotCommandTranslationKey({
    command_id: props.commandId,
    option_id: props.option.id,
    field: 'description',
  });

  return props.translations[key] ?? props.option.description;
});
</script>

<template>
  <dt :class="['bot-command-option-name', { required: option.required }]">
    {{ localizedName }}
  </dt>
  <dd class="bot-command-option-description">
    {{ localizedDescription }}
  </dd>
</template>
