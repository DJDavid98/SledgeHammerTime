<script setup lang="ts">
defineProps<{
    unixTs: number | undefined;
    format?: string;
}>();
</script>

<template>
    <template v-if="unixTs !== undefined">
        <code>
            <template v-if="format">&lt;t:{{ unixTs }}:{{ format }}&gt;</template>
            <template v-else>{{ unixTs }}</template>
        </code>
    </template>
</template>
