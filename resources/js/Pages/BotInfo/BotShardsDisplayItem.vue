<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { useNumberFormatter } from '@/composables/useNumberFormatter';
import { dateTimeLibraryInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { faCubesStacked, faHashtag, faPlay, faRefresh } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';
import { Tippy } from 'vue-tippy';

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

const serversShareMultiplier = computed(() => (props.shard.serverCount / props.totalServerCount).toFixed(3));

const nf = useNumberFormatter();

const shardClass = computed(() => idle.value ? 'bot-shard-inactive' : 'bot-shard-active');
</script>

<template>
  <Tippy
    :class="`bot-shard-tick ${shardClass}`"
    :style="`--shard-servers-share-multiplier: ${serversShareMultiplier}`"
    :content-class="`bot-shard-tooltip ${shardClass}`"
    :follow-cursor="true"
    theme="shard-tooltip"
  >
    <template #content>
      <p class="bot-shard-info">
        <strong>
          <FontAwesomeIcon
            :icon="faHashtag"
            :fixed-width="true"
          />
          {{ $t('botInfo.shardStats.shardId') }}
        </strong>
        <span>{{ shard.id }}</span>
      </p>
      <p
        class="bot-shard-info"
      >
        <strong>
          <FontAwesomeIcon
            :icon="faCubesStacked"
            :fixed-width="true"
          />
          {{ $t('botInfo.shardStats.serversOnShard') }}
        </strong>
        <span>{{ nf.format(shard.serverCount) }}</span>
      </p>
      <p class="bot-shard-info">
        <strong>
          <FontAwesomeIcon
            :icon="faPlay"
            :fixed-width="true"
          />
          {{ $t('botInfo.shardStats.startupTime') }}
        </strong>
        <span><TimestampPreview
          :ts="shard.startedAt"
          :format="MessageTimestampFormat.RELATIVE"
        /></span>
      </p>
      <p class="bot-shard-info">
        <strong>
          <FontAwesomeIcon
            :icon="faRefresh"
            :fixed-width="true"
          />
          {{ $t('botInfo.shardStats.lastUpdateTime') }}
        </strong>
        <span><TimestampPreview
          :ts="shard.updatedAt"
          :format="MessageTimestampFormat.RELATIVE"
        /></span>
      </p>
    </template>
  </Tippy>
</template>

<style scoped>

</style>
