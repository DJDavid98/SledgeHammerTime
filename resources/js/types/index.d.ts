import { AvailableLanguage } from '@/utils/language-settings';

export interface User {
	id: number;
	name: string;
	email: string;
	email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
	app: {
		name: string;
		locale: string;
		// Mapping UI locales to laravel locales
		languages: Record<AvailableLanguage, string>;
	}
	auth: {
		user: User;
	};
};
