<script setup lang="ts">
import UsefulLinkItem from '@/Components/home/UsefulLinkItem.vue';
import UsefulLinksCard from '@/Components/home/UsefulLinksCard.vue';
import { currentLanguageInject } from '@/injection-keys';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import usefulLinksBot from '@img/useful-links/bot.png';
import dabric from '@img/useful-links/dabric.png';
import discordTimestampCom from '@img/useful-links/discordTimestampCom.png';
import discordTimestampOrg from '@img/useful-links/discordTimestampOrg.png';
import discordTimestampGenerator from '@img/useful-links/discordTimestampGenerator.png';
import usefulLinksOldsite from '@img/useful-links/oldsite.png';
import r3vfi from '@img/useful-links/r3vfi.png';
import usefulLinksServer from '@img/useful-links/server.png';
import seshFyi from '@img/useful-links/seshFyi.png';
import usefulLinksSubreddit from '@img/useful-links/subreddit.png';
import usefulLinksTextcolor from '@img/useful-links/textcolor.png';
import { inject } from 'vue';

const currentLanguage = inject(currentLanguageInject);
</script>

<template>
  <UsefulLinksCard>
    <template #header>
      <p class="lead-text">
        {{ $t('timestampPicker.usefulLinks.lead') }}
      </p>
    </template>

    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.server.header')"
      :desc="$t('timestampPicker.usefulLinks.server.p')"
      href="/discord"
      :image="usefulLinksServer"
    />
    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.bot.header')"
      :desc="$t('timestampPicker.usefulLinks.bot.p')"
      href="botInfo"
      :is-local="true"
      :image="usefulLinksBot"
    />
    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.oldSite.header')"
      :desc="$t('timestampPicker.usefulLinks.oldSite.p')"
      :href="'https://old.hammertime.cyou' + (!currentLanguage || currentLanguage.locale === 'en' ? '' : '/' + currentLanguage.locale)"
      :image="usefulLinksOldsite"
    />
    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.textColor.p')"
      href="https://rebane2001.com/discord-colored-text-generator/"
      :image="usefulLinksTextcolor"
    >
      <template #name>
        <HtTranslate i18n-key="timestampPicker.usefulLinks.textColor.header">
          <template #1="slotProps">
            <span style="color: #7781ee">{{ slotProps.text }}</span>
          </template>
        </HtTranslate>
      </template>
    </UsefulLinkItem>
    <UsefulLinkItem
      name="r/SplitSecond"
      :desc="$t('timestampPicker.usefulLinks.subreddit.p')"
      href="https://reddit.com/r/SplitSecond"
      :image="usefulLinksSubreddit"
    />
  </UsefulLinksCard>

  <UsefulLinksCard>
    <template #header>
      <p class="lead-text mb-2">
        {{ $t('timestampPicker.usefulLinks.competitors.lead.p1') }}
      </p>
      <p class="lead-text">
        {{ $t('timestampPicker.usefulLinks.competitors.lead.p2') }}
      </p>
    </template>

    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.competitors.3vfi.p')"
      href="https://r.3v.fi/discord-timestamps/"
      :image="r3vfi"
      :allow-referrer="true"
    />
    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.competitors.dabric.p')"
      href="https://timestamp.dabric.xyz/"
      :image="dabric"
      :allow-referrer="true"
    />
    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.competitors.discordtimestampCom.p')"
      href="https://discordtimestamp.com/"
      :image="discordTimestampCom"
      :allow-referrer="true"
    />
    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.competitors.discordtimestampOrg.p')"
      href="https://discordtimestamp.org/"
      :image="discordTimestampOrg"
      :allow-referrer="true"
    />
    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.competitors.sesh.p')"
      href="https://sesh.fyi/timestamp/"
      :image="seshFyi"
      :allow-referrer="true"
    />
    <UsefulLinkItem
        :desc="$t('timestampPicker.usefulLinks.competitors.discordTimestampGenerator.p')"
        href="https://discordtimestampgenerator.com/"
        :image="discordTimestampGenerator"
        :allow-referrer="true"
     />
  </UsefulLinksCard>
</template>

<style scoped>

</style>
