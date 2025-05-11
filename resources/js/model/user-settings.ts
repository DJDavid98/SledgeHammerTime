export interface UserSettings {
  timezone: string | null;
  ephemeral: boolean | null;
  header: boolean | null;
  boldPreview: boolean | null;
  columns: string | null;
  format: string | null;
  formatMinimalReply: boolean | null;
  telemetry: boolean | null;
  defaultAtHour: number | null;
  defaultAtMinute: number | null;
  defaultAtSecond: number | null;
}
