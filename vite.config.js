import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';
import i18n from 'laravel-vue-i18n/vite';

export default defineConfig(({ mode }) => {
  const isTest = process.env.NODE_ENV === 'test' || mode === 'test';

  const conditionalPlugins = [];
  if (!isTest) {
    conditionalPlugins.push(laravel({
      input: 'resources/js/app.ts',
      ssr: 'resources/js/ssr.ts',
      refresh: true,
    }));
  }

  return ({
    resolve: {
      alias: {
        '~@picocss': resolve(__dirname, 'node_modules/@picocss'),
        '~the-new-css-reset': resolve(__dirname, 'node_modules/the-new-css-reset'),
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
});
