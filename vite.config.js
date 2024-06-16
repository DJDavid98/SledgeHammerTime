import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';
import i18n from 'laravel-vue-i18n/vite';


export default defineConfig({
  resolve: {
    alias: {
      '~@picocss': resolve(__dirname, 'node_modules/@picocss'),
    },
  },
  plugins: [
    laravel({
      input: 'resources/js/app.ts',
      ssr: 'resources/js/ssr.ts',
      refresh: true,
    }),
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
