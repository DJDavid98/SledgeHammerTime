<script setup lang="ts">
import { wTrans } from 'laravel-vue-i18n';
import { computed } from 'vue';

const props = defineProps<{
  i18nKey: string;
}>();

const textRef = wTrans(props.i18nKey);

const tags = computed(() => {
  const regex = /<(\d+)>(.*)<\/\1>/g;
  let match: RegExpExecArray | null = null;
  const tagsObject: Record<number, string> = {};
  while ((match = regex.exec(textRef.value)) !== null) {
    tagsObject[parseInt(match[1], 10)] = match[2];
  }
  return tagsObject;
});

const parts = computed(() => {
  let indexAdd = 0;
  const partsValue = textRef.value.replace(/<(\d+)>.*<\/\1>/g, '<$1/>').split(/<\d+\/>/g);
  return partsValue.reduce((acc: string[], v, i): string[] => {
    indexAdd++;
    const tagIndex = i + indexAdd;
    if (tagIndex in tags.value) {
      return [...acc, v, tags.value[tagIndex]];
    }
    return [...acc, v];
  }, []);
});
</script>

<template>
  <template
    v-for="(part, i) in parts"
    :key="i"
  >
    <slot
      v-if="i in tags"
      :name="i"
      :text="part"
    />
    <template v-else-if="part.length > 0">
      {{ part }}
    </template>
  </template>
</template>

<style scoped>

</style>
