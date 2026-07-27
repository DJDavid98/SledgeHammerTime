<?php

return [
  'howTo' => '日付を選び、 メッセージの :syntaxColName 列文からタイムスタンプを自由にコピーし、あなたのメッセージにどこにでも貼り付ける事ができます。 みんなのタイムゾーンに基づいて表示される動的タイムスタンプになります。',
  'picker' => [
    'label' => [
      'date' => '日付',
      'time' => '時刻',
      'dateAndTime' => '日付と時刻',
      'timezone' => 'タイムゾーン',
      'naturalLanguageInput' => '@time 入力',
      'modeOffset' => '協定世界時',
      'modeZoneName' => 'ゾーンネーム',
    ],
    'button' => [
      'jumpToToday' => '現在の月へ移動',
      'contextRange' => '<0/>〜<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => '現在時刻にする',
      'lock' => 'リンクでタイムスタンプをセーブ',
      'unlock' => 'タイムスタンプをアンロック',
      'previousYear' => '前の年',
      'previousMonth' => '前の月',
      'previousDecade' => '10年前',
      'nextMonth' => '次の月',
      'nextYear' => '次の年',
      'nextDecade' => '次の10年',
    ],
    'validation' => [
      'naturalLanguageParseError' => '自然言語入力の解析ができませんでした'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'メッセージの構文',
    'resultColumn' => '例',
    'editFormats' => 'フォーマットをカスタマイズ',
    'resetFormats' => 'デフォルトに戻す',
    'hideFormat' => 'このフォーマットを非表示',
    'showFormat' => 'このフォーマットを表示',
    'unhideInProfile' => 'プロフィール設定で非表示を解除',
  ],
  'faq' => [
    'title' => 'よくある質問',
    'description' => 'この節は現在英語のみとなっており、またこれは<1>私たちのDiscordサーバー</1> の上の内容に基づいています。メンバーでない場合、一部のリンクが正しく機能しない場合があります。',
  ],
  'usefulLinks' => [
    'lead' => '関連するもの',
    'server' => [
      'header' => 'HammerTime公式サーバー',
      'p' => 'サイトについての議論・タイムスタンプのテスト・機能のリクエストができます',
    ],
    'bot' => [
      'header' => 'HammerTimeアプリ',
      'p' => 'Discord内からコマンドでタイムスタンプを生成できます',
    ],
    'oldSite' => [
      'header' => '旧Hammer Timeサイト',
      'p' => '古いプロジェクトウェブサイトは、追って通知があるまで引き続き利用可能です',
    ],
    'textColor' => [
      'header' => 'Rebaneの<1>色付き</1>テキストジェネレーター',
      'p' => 'ANSIカラーコードを使って、色を付けたDiscordメッセージを作るアプリ',
    ],
    "subreddit" => [
      "p" => "このプロジェクトのきっかけとなった、過小評価されているレースゲームを対象に、週次チャレンジを開催しているコミュニティ",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'HammarTime以外のタイムスタンプ生成ツールはご存知ですか？',
        'p2' => '以下のDiscordのタイムスタンプ生成ツールから、最適なものを探してみてください：',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'シンプルで高速なタイムスタンプ生成ツール（開発：3ventic）',
      ],
      'dabric' => [
        'header' => '',
        'p' => '自然言語形式のDiscordタイムスタンプ生成ツール（開発：dabric）',
      ],
      'discordtimestampCom' => [
        'p' => 'ローカルのタイムゾーンに対応した無料のDiscordタイムスタンプ生成ツール（開発：Sellframe Ltd）',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discordのタイムスタンプ生成・時刻変換ツール（開発：DiscordTimestamp.org）',
      ],
      'sesh' => [
        'p' => '日程調整ボットSeshと同開発元のタイムスタンプ生成ツール（開発：Tunks）',
      ],
    ],
  ],
];
