import { Moment } from 'moment-timezone';
import { InjectionKey, Ref } from 'vue';

export const timestamp = Symbol() as InjectionKey<{
	currentTimestamp: Ref<Moment>,
	currentTimezone: Ref<string>,
	changeDateString: (value: string) => void,
	changeTimeString: (value: string) => void,
	changeTimezone: (value: string) => void,
	setCurrentTime: () => void,
}>;
