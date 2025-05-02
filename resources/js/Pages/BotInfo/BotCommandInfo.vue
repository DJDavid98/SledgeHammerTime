<script setup lang="ts">

import BotCommandOptionInfo, { BotCommandOption } from '@/Pages/BotInfo/BotCommandOptionInfo.vue';
import { wTrans } from 'laravel-vue-i18n';
import { computed } from 'vue';

enum DiscordBotCommandType {
  /**
   * Slash commands
   */
  ChatInput = 1,
  /**
   * User right-click menu
   */
  User = 2,
  /**
   * Message right-click menu
   */
  Message = 3,
}

export interface BotCommand {
  id: number;
  name: string;
  description: string;
  options?: BotCommandOption[];
  type: DiscordBotCommandType;
}

const props = defineProps<{
  command: BotCommand
}>();

const additionalDescriptionI18nKey = `botInfo.commandsReference.additionalDescription.commands.${props.command.name}`;
const additionalDescription = wTrans(additionalDescriptionI18nKey);
const hasDescription = computed(() => props.command.description || additionalDescription.value !== additionalDescriptionI18nKey);
</script>

<template>
  <div class="bot-command-info">
    <h3 class="bot-command-name">
      {{ (command.type === DiscordBotCommandType.ChatInput ? '/' : '') + command.name }}
      <small class="bot-command-type">
        ({{ $t('botInfo.commandsReference.commandType.' + command.type) }})
      </small>
    </h3>

    <template v-if="hasDescription">
      <h4 class="sr-only">
        {{ $t('botInfo.commandsReference.commandDescription') }}
      </h4>
      <p v-if="command.description">
        {{ command.description }}
      </p>
      <p v-if="additionalDescription !== additionalDescriptionI18nKey">
        {{ additionalDescription }}
      </p>
    </template>

    <template v-if="command.options && command.options.length > 0">
      <h4>{{ $t('botInfo.commandsReference.commandOptions') }}</h4>

      <dl class="bot-command-options">
        <BotCommandOptionInfo
          v-for="option in command.options"
          :key="option.id"
          :option="option"
        />
      </dl>
    </template>
  </div>
</template>
