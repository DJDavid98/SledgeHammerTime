<script setup lang="ts">
import BotShardsDisplay, { BotShard } from '@/Pages/BotInfo/BotShardsDisplay.vue';
import HtCard from '@/Reusable/HtCard.vue';

export type BotShardData = BotShard[];

defineProps<{
  shards: BotShardData;
}>();
</script>

<template>
  <HtCard v-if="shards && shards.length > 0">
    <template #header>
      <h2>{{ $t('botInfo.shardStats.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.shardStats.description') }}
    </p>

    <BotShardsDisplay :shards="shards" />
  </HtCard>
</template>
