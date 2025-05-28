<script setup lang="ts">
import BotCommandOptionChoiceInfo, { BotCommandOptionChoice } from '@/Pages/BotInfo/BotCommandOptionChoiceInfo.vue';

export type BotCommandOptionChoiceList = BotCommandOptionChoice[];

defineProps<{
  commandId: string;
  optionId: string;
  choices: BotCommandOptionChoiceList;
  translations: Record<string, string>;
}>();
</script>

<template>
  <p>{{ $t('botInfo.commandsReference.choices') }}</p>
  <ul class="bot-command-option-choices">
    <BotCommandOptionChoiceInfo
      v-for="choice in choices"
      :key="choice.id"
      :command-id="commandId"
      :option-id="optionId"
      :choice="choice"
      :translations="translations"
    />
  </ul>
</template>
