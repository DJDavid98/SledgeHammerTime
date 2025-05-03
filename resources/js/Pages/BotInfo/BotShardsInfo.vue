<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTable from '@/Reusable/HtTable.vue';
import moment, { Moment } from 'moment-timezone';
import { computed } from 'vue';

export interface BotShard {
  id: number;
  serverCount: number;
  memberCount: number | null;
  startedAt: string | null;
  createdAt: string;
  updatedAt: string;
}

interface EnhancedBotShard {
  id: number;
  serverCount: number;
  startedAt: Moment | undefined;
  updatedAt: Moment | undefined;
}

const props = defineProps<{
  shards: BotShard[];
}>();

const enhancedShards = computed(() => props.shards.map((shard): EnhancedBotShard => {
  return {
    id: shard.id,
    serverCount: shard.serverCount,
    startedAt: shard.startedAt ? moment(shard.startedAt) : undefined,
    updatedAt: shard.updatedAt ? moment(shard.updatedAt) : undefined,
  };
}));
</script>

<template>
  <HtCard v-if="shards && shards.length > 0">
    <template #header>
      <h2>{{ $t('botInfo.shardStats.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.shardStats.description') }}
    </p>

    <HtTable :responsive="true">
      <thead>
        <tr>
          <th>
            {{ $t('botInfo.shardStats.shardId') }}
          </th>
          <th>
            {{ $t('botInfo.shardStats.serverCount') }}
          </th>
          <th>
            {{ $t('botInfo.shardStats.startupTime') }}
          </th>
          <th>
            {{ $t('botInfo.shardStats.lastUpdateTime') }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="shard in enhancedShards"
          :key="shard.id"
        >
          <td>{{ shard.id }}</td>
          <td>{{ shard.serverCount }}</td>
          <td>
            <TimestampPreview
              :ts="shard.startedAt"
              :from-now="true"
            />
          </td>
          <td>
            <TimestampPreview
              :ts="shard.updatedAt"
              :from-now="true"
            />
          </td>
        </tr>
      </tbody>
    </HtTable>
  </HtCard>
</template>
