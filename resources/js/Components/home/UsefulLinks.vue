<script setup lang="ts">
import UsefulLinkItem from '@/Components/home/UsefulLinkItem.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
</script>

<template>
  <HtCard class="useful-links-card">
    <p class="lead-text">
      {{ $t('timestampPicker.usefulLinks.lead') }}
    </p>
    <div class="links">
      <UsefulLinkItem
        :name="$t('timestampPicker.usefulLinks.server.header')"
        :desc="$t('timestampPicker.usefulLinks.server.p')"
        href="discord"
        :is-local="true"
        image="/useful-links/server.png"
      />
      <UsefulLinkItem
        :name="$t('timestampPicker.usefulLinks.bot.header')"
        :desc="$t('timestampPicker.usefulLinks.bot.p')"
        href="addBot"
        :is-local="true"
        image="/useful-links/bot.png"
      />
      <UsefulLinkItem
        :desc="$t('timestampPicker.usefulLinks.textColor.p')"
        href="https://rebane2001.com/discord-colored-text-generator/"
        image="/useful-links/textcolor.png"
      >
        <template #name>
          <HtTranslate i18n-key="timestampPicker.usefulLinks.textColor.header">
            <template #1="slotProps">
              <span style="color: #7781ee">{{ slotProps.text }}</span>
            </template>
          </HtTranslate>
        </template>
      </UsefulLinkItem>
    </div>
  </HtCard>
</template>

<style scoped>

</style>
