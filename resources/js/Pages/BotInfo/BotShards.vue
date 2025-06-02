<script setup lang="ts">
import { useNumberFormatter } from '@/composables/useNumberFormatter';
import BotShardsDisplay, { BotShard } from '@/Pages/BotInfo/BotShardsDisplay.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { computed } from 'vue';

export type BotShardData = BotShard[];

const props = defineProps<{
  shards: BotShardData;
}>();
const nf = useNumberFormatter();
const totalServerCount = computed(() => nf.value.format(props.shards.reduce((total, shard) => total + shard.serverCount, 0)));
</script>

<template>
  <HtCard v-if="shards && shards.length > 0">
    <template #header>
      <h2>{{ $t('botInfo.shardStats.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.shardStats.description') }}
    </p>

    <p class="mb-3">
      {{ $t('botInfo.shardStats.boxesDescription', { totalServerCount }) }}
    </p>

    <BotShardsDisplay :shards="shards" />
  </HtCard>
</template>
