export type TimezoneSelection = TimezoneSelectionByOffset | TimezoneSelectionByName;

export enum TimeZoneSelectionType {
  OFFSET = 'offset',
  ZONE_NAME = 'name',
}

export interface TimezoneSelectionByOffset {
  type: TimeZoneSelectionType.OFFSET;
  hours: number;
  minutes: number;
}

export interface TimezoneSelectionByName {
  type: TimeZoneSelectionType.ZONE_NAME;
  name: string;
}
