import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';
import i18n from 'laravel-vue-i18n/vite';

const isCI = process.env.CI === 'true';

const conditionalPlugins = [];
if (!isCI) {
  conditionalPlugins.push(laravel({
    input: 'resources/js/app.ts',
    ssr: 'resources/js/ssr.ts',
    refresh: true,
  }));
}

export default defineConfig({
  resolve: {
    alias: {
      '~@picocss': resolve(__dirname, 'node_modules/@picocss'),
      '@': resolve(__dirname, 'resources/js'),
    },
  },
  plugins: [
    ...conditionalPlugins,
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    i18n(),
  ],
  test: {
    sequence: {
      shuffle: true,
    },
  },
});
