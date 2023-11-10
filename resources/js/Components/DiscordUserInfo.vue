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
    <figure class="flex items-center">
        <img :alt="`Avatar of ${name}`" v-bind:src="getAvatarLink($props)" class="w-10 h-10 me-3 rounded-full" />
        <span class="font-medium text-xl">{{ name }}</span>
    </figure>
</template>
