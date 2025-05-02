import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { AxiosInstance } from 'axios';
import { Config as ZiggyConfig, route } from 'ziggy-js';
import { PageProps as AppPageProps } from './';

declare global {
  interface Window {
    axios: AxiosInstance;
  }

  const route: typeof ziggyRoute;
  const Ziggy: ZiggyConfig;
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    route: typeof route;
  }
}

declare module '@inertiajs/core' {
  interface PageProps extends InertiaPageProps, AppPageProps {
  }
}

export {};
