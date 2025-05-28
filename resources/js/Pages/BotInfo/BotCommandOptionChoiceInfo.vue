<script setup lang="ts">
import HtBadge from '@/Reusable/HtBadge.vue';
import { getBotCommandTranslationKey } from '@/utils/translation';
import { computed } from 'vue';

export interface BotCommandOptionChoice {
  id: string;
  name: string;
  value: string;
}

const props = defineProps<{
  commandId: string;
  optionId: string;
  choice: BotCommandOptionChoice;
  translations: Record<string, string>,
}>();


const localizedName = computed(() => {
  const key = getBotCommandTranslationKey({
    commandId: props.commandId,
    optionId: props.optionId,
    choiceId: props.choice.id,
    field: 'name',
  });

  return props.translations[key] ?? props.choice.name;
});
</script>

<template>
  <li>
    <span class="bot-command-option-choice-name">{{ localizedName }}</span>
    <HtBadge
      color="muted"
      class="ms-2"
    >
      <code>{{ choice.value }}</code>
    </HtBadge>
  </li>
</template>
