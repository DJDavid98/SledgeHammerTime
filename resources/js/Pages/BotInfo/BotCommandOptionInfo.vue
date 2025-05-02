<script setup lang="ts">
export interface BotCommandOption {
  id: string;
  name: string;
  description: string;
  required: boolean | null;
}

defineProps<{
  option: BotCommandOption,
}>();
</script>

<template>
  <dt :class="['bot-command-option-name', { required: option.required }]">
    {{ option.name }}
  </dt>
  <dd class="bot-command-option-description">
    {{ option.description }}
  </dd>
</template>
