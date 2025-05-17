<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtCard from '@/Reusable/HtCard.vue';
import HtTable from '@/Reusable/HtTable.vue';
import { TZDate } from '@date-fns/tz';
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
  startedAt: TZDate | undefined;
  updatedAt: TZDate | undefined;
}

const props = defineProps<{
  shards: BotShard[];
}>();

const enhancedShards = computed(() => props.shards.map((shard): EnhancedBotShard => {
  return {
    id: shard.id,
    serverCount: shard.serverCount,
    startedAt: shard.startedAt ? new TZDate(shard.startedAt) : undefined,
    updatedAt: shard.updatedAt ? new TZDate(shard.updatedAt) : undefined,
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
              :ts-format="MessageTimestampFormat.RELATIVE"
            />
          </td>
          <td>
            <TimestampPreview
              :ts="shard.updatedAt"
              :ts-format="MessageTimestampFormat.RELATIVE"
            />
          </td>
        </tr>
      </tbody>
    </HtTable>
  </HtCard>
</template>
