<script setup lang="ts">

import { useNumberFormatter } from '@/composables/useNumberFormatter';
import BotCommandOptionInfo, { BotCommandOption } from '@/Pages/BotInfo/BotCommandOptionInfo.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import { getBotCommandTranslationKey } from '@/utils/translation';
import { faChartLine } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
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
  id: string;
  name: string;
  description: string;
  options?: BotCommandOption[];
  type: DiscordBotCommandType;
  total_executions: number | null;
}

const props = defineProps<{
  command: BotCommand,
  translations: Record<string, string>,
}>();

const nf = useNumberFormatter();

const localizedName = computed(() => {
  const key = getBotCommandTranslationKey({
    commandId: props.command.id,
    field: 'name',
  });

  return props.translations[key] ?? props.command.name;
});
const localizedDescription = computed(() => {
  const key = getBotCommandTranslationKey({
    commandId: props.command.id,
    field: 'description',
  });

  return props.translations[key] ?? props.command.description;
});
const additionalDescriptionI18nKey = `botInfo.commandsReference.additionalDescription.commands.${props.command.name}`;
const additionalDescription = wTrans(additionalDescriptionI18nKey);
const hasDescription = computed(() => localizedDescription.value || additionalDescription.value !== additionalDescriptionI18nKey);
const totalExecutions = computed(() => props.command.total_executions ?? 0);
</script>

<template>
  <div class="bot-command-info">
    <h3 class="bot-command-name">
      {{ (command.type === DiscordBotCommandType.ChatInput ? '/' : '') + localizedName }}
      <small class="bot-command-type" />
    </h3>

    <HtBadgeGroup>
      <HtBadge
        color="purple"
        :prefix="$t('botInfo.commandsReference.commandType')"
      >
        {{ $t('botInfo.commandsReference.commandTypeNames.' + command.type) }}
      </HtBadge>
      <HtBadge
        :color="totalExecutions > 0 ? undefined : 'muted'"
        :title="$t('botInfo.commandsReference.totalExecutions')"
      >
        <FontAwesomeIcon :icon="faChartLine" />
        {{ nf.format(totalExecutions) }}
      </HtBadge>
    </HtBadgeGroup>

    <template v-if="hasDescription">
      <template v-if="localizedDescription">
        <h4>
          {{ $t('botInfo.commandsReference.shortDescription') }}
        </h4>
        <p>
          {{ localizedDescription }}
        </p>
      </template>
      <HtAlert
        v-if="additionalDescription !== additionalDescriptionI18nKey"
        :closable="false"
        type="info"
      >
        <template #text>
          {{ additionalDescription }}
        </template>
      </HtAlert>
    </template>

    <template v-if="command.options && command.options.length > 0">
      <h4>{{ $t('botInfo.commandsReference.commandOptions') }}</h4>

      <dl class="bot-command-options">
        <BotCommandOptionInfo
          v-for="option in command.options"
          :key="option.id"
          :command-id="command.id"
          :option="option"
          :translations="translations"
        />
      </dl>
    </template>
  </div>
</template>
