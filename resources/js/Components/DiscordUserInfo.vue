<script setup lang="ts">
export interface DiscordUserInfoProps {
  id: string;
  name: string;
  avatar: string;
  discriminator: string;
}

const getAvatarLink = (du: DiscordUserInfoProps) => {
  if (du.avatar) {
    const avatarFileExtension = du.avatar.startsWith('a_') ? 'gif' : 'png';
    return `https://cdn.discordapp.com/avatars/${du.id}/${du.avatar}.${avatarFileExtension}`;
  }

  // Default avatar logic
  const defaultAvatarFileName =
    (du.discriminator === '0'
      ? // User is migrated to new username system
      parseInt(du.id, 10) >> 22
      : // User is on previous username system
      parseInt(du.discriminator, 10)) % 5;
  return `/embed/avatars/${defaultAvatarFileName}.png`;
};

defineProps<DiscordUserInfoProps>();
</script>

<template>
  <figure class="discord-user-info">
    <img
      :alt="`Avatar of ${name}`"
      :src="getAvatarLink($props)"
      class="user-image"
    >
    <span class="user-name">{{ name }}</span>
  </figure>
</template>
