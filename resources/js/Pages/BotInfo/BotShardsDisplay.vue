<script setup lang="ts">
import { dateTimeLibraryInject } from '@/injection-keys';
import BotShardsDisplayItem, { EnhancedBotShard } from '@/Pages/BotInfo/BotShardsDisplayItem.vue';
import { computed, inject } from 'vue';
import { TippySingleton } from 'vue-tippy';

export interface BotShard {
  id: number;
  serverCount: number;
  memberCount: number | null;
  startedAt: string | null;
  createdAt: string;
  updatedAt: string;
}

const props = defineProps<{
  shards: BotShard[],
}>();

const dtl = inject(dateTimeLibraryInject);

const enhancedShards = computed(() => props.shards.map((shard): EnhancedBotShard => {
  return {
    id: shard.id,
    serverCount: shard.serverCount,
    startedAt: shard.startedAt && dtl?.value ? dtl.value.fromIsoString(shard.startedAt) : undefined,
    updatedAt: shard.updatedAt && dtl?.value ? dtl.value.fromIsoString(shard.updatedAt) : undefined,
  };
}));

const totalServerCount = computed(() => props.shards.reduce((totalCount, shard) => totalCount + shard.serverCount, 0));
</script>

<template>
  <div class="bot-shards-display">
    <TippySingleton>
      <BotShardsDisplayItem
        v-for="(shard, i) in enhancedShards"
        :key="i"
        :shard="shard"
        :total-server-count="totalServerCount"
      />
    </TippySingleton>
  </div>
</template>

<style scoped>

</style>
