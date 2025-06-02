<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { currentLanguageInject, dateTimeLibraryInject, devModeInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { faCubesStacked, faHashtag, faPlay, faRefresh } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

export interface EnhancedBotShard {
  id: number;
  serverCount: number;
  startedAt: DateTimeLibraryValue | undefined;
  updatedAt: DateTimeLibraryValue | undefined;
}

const props = defineProps<{
  shard: EnhancedBotShard;
  totalServerCount: number;
}>();

const dtl = inject(dateTimeLibraryInject);
const maxUpdateTimeBeforeIdleSeconds = 1.5 * 60 * 60;

const idle = computed(() => {
  if (!props.shard.updatedAt || !dtl) return false;

  const nowTs = dtl.value.now().getUnixSeconds();
  const updatedAtTs = props.shard.updatedAt.getUnixSeconds();
  const timeDiff = nowTs - updatedAtTs;
  return timeDiff > maxUpdateTimeBeforeIdleSeconds;
});

const serversShareMultiplier = computed(() => (props.shard.serverCount / props.totalServerCount).toFixed(2));

const isDev = inject(devModeInject);

const currentLanguage = inject(currentLanguageInject);
const nf = computed(() => {
  return new Intl.NumberFormat(currentLanguage?.value?.locale ?? 'en-US');
});
</script>

<template>
  <div
    :class="['bot-shard', { idle }]"
    :style="`--shard-servers-share-multiplier: ${serversShareMultiplier}`"
  >
    <p
      class="bot-shard-info"
      :title="$t('botInfo.shardStats.shardId')"
    >
      <FontAwesomeIcon :icon="faHashtag" />
      <span>{{ shard.id }}</span>
    </p>
    <p
      class="bot-shard-info"
      :title="$t('botInfo.shardStats.serverCount')"
    >
      <FontAwesomeIcon :icon="faCubesStacked" />
      <span>{{ nf.format(shard.serverCount) }}</span>
    </p>
    <p
      v-if="isDev"
      class="bot-shard-info"
      :title="$t('botInfo.shardStats.startupTime')"
    >
      <FontAwesomeIcon :icon="faPlay" />
      <span><TimestampPreview
        :ts="shard.startedAt"
        :format="MessageTimestampFormat.RELATIVE"
      /></span>
    </p>
    <p
      class="bot-shard-info"
      :title="$t('botInfo.shardStats.lastUpdateTime')"
    >
      <FontAwesomeIcon :icon="faRefresh" />
      <span><TimestampPreview
        :ts="shard.updatedAt"
        :format="MessageTimestampFormat.RELATIVE"
      /></span>
    </p>
  </div>
</template>

<style scoped>

</style>
