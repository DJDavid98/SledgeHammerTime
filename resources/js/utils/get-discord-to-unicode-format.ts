import { MessageTimestampFormat } from '@/model/message-timestamp-format';

export const getDiscordToUnicodeFormat = (format: MessageTimestampFormat, language: string | undefined): string => {
  switch (format) {
    case MessageTimestampFormat.SHORT_DATE:
      switch (language) {
        default:
          return 'P';
      }
    case MessageTimestampFormat.SHORT_TIME:
      switch (language) {
        case 'en-GB':
          return 'HH:mm';
        default:
          return 'p';
      }
    case MessageTimestampFormat.SHORT_FULL:
      switch (language) {
        default:
          return `PPP ${getDiscordToUnicodeFormat(MessageTimestampFormat.SHORT_TIME, language)}`;
      }
    case MessageTimestampFormat.LONG_DATE:
      switch (language) {
        default:
          return 'PPP';
      }
    case MessageTimestampFormat.LONG_TIME:
      switch (language) {
        case 'en-GB':
          return 'HH:mm:ss';
        default:
          return 'pp';
      }
    case MessageTimestampFormat.LONG_FULL:
      switch (language) {
        default:
          return `PPPP ${getDiscordToUnicodeFormat(MessageTimestampFormat.SHORT_TIME, language)}`;
      }
    default:
      throw new Error(`Unsupported format: ${format}`);
  }
};
