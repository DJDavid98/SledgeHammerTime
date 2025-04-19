export interface UserSettings {
  timezone: string | null;
  ephemeral: boolean | null;
  header: boolean | null;
  boldPreview: boolean | null;
  columns: string | null;
  format: string | null;
  defaultAtHour: number | null;
  defaultAtMinute: number | null;
  defaultAtSecond: number | null;
}
