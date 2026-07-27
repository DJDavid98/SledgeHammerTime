<?php

return [
  'seoDescription' => 'Discordメッセージのタイムスタンプを生成できる',
  'changeLanguage' => '言語を変える',
  "notFound" => [
    "heading" => "ページが見つかりませんでした",
    "content" => "ここは何もありません",
    "suggestions" => [
      "heading" => "何かお探しですか？",
      "description" => "以下のページがお役に立つかもしれません：",
      "picker" => "タイムスタンプピッカー",
      "botInfoDescription" => "Discordアプリと利用可能なコマンドに関する情報",
      "discordCta" => "追加すべきものがあるとお考えの場合は、Discordサーバーに参加してお知らせください。",
      "discordButton" => "Discordサーバーに参加",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "メンテナンスモード",
    "content" => [
      'pleaseWait' => "アプリケーションは現在更新中です。しばらくしてからもう一度お試しください。",
      'joinSupportServer' => "問題が数分以上続く場合は、Discordサポートサーバーに参加してご連絡ください。",
      'contactDeveloper' => "問題が数分以上続く場合は、開発者に連絡し、その旨をお知らせください。",
    ],
    'autoReload' => 'このページは<1/>に自動的に再読み込みされます',
    'reloadButton' => '手動で再読み込み',
    "supportServerButton" => "サポートサーバー",
  ],
  'incompleteTranslations' => '翻訳は未完成です',
  'contributeTranslations' => '貢献',
  'timezoneBadge' => [
    'currently' => '現在実施中',
    'atPickedDate' => '指定の時刻で実施期間内',
    'currentlyAndAtPickedDate' => '現在・指定時刻ともに実施期間内',
  ],
  'copyToClipboard' => 'クリップボードにコピー',
  'copiedToClipboard' => 'クリップボードにコピーしました！',
  'jsDisabled' => [
    'title' => 'JavaScriptが必要です',
    'body' => "お使いのブラウザはJavaScriptをサポートしないか、無効化されています。一部ブラウザではセキュリティ上の理由でJavaScriptをデフォルトで無効化しますが、このアプリには必要です。有効にしてページを再読み込みするか、違うブラウザを使用してください。",
  ],
  'nav' => [
    'botSettings' => 'アカウント設定',
    'profile' => 'プロフィール',
    'legal' => '法的情報',
    'analytics' => 'アナリティクス',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '入力設定',
      'naturalLanguageInput' => [
        'label' => '@time 入力フィールド',
        'description' => '選択したタイムスタンプを自然言語（例：「５時間後」）で操作できるようにするため、追加の自由入力フィールドを提供します。Discordの新しい@timeタグと同様の機能です。対応言語は限定されています。',
      ],
      'customDateInput' => [
        'label' => 'カスタム日付入力',
        'description' => "ブラウザの既定の日付入力フィールドをカスタム入力フィールドに置き換える。",
      ],
      'customTimeInput' => [
        'label' => 'カスタム時刻入力',
        'description' => "ブラウザのデフォルトの時間入力フィールドをカスタム入力フィールドに置き換えます。特にモバイルブラウザで時間を選択しづらい場合に便利です。",
      ],
      'separateInputs' => [
        'label' => '分離入力',
        'description' => "日付と時刻の入力を分離させます（一部ブラウザではサポートされていません）",
      ],
      'flatUi' => [
        'label' => 'インターフェースをフラット化する',
        'description' => "入力項目とボタンで影と高さの立体エフェクトを無効にする",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'タイムゾーングループのヘッダー',
        'description' => 'タイムゾーンのドロップダウンに、追従するグループ名ヘッダー（例：アメリカ、ヨーロッパ）を表示する。',
      ],
      'hourCycle' => [
        'label' => '時刻表示形式',
        'description' => '時刻の表示形式を変更します。カスタム時刻の入力やプレビューを含め、アプリ全体に適用されます。',
        'options' => [
          'default' => 'デフォルトの言語',
          'h12' => '12時間',
          'h24' => '24時間',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => '週の初めの日',
        'description' => 'カスタム日付入力のカレンダーにおいて、週の最初の日をどの曜日に設定するか変更する。',
        'options' => [
          'default' => 'デフォルトの言語',
        ],
      ],
      'advancedSettings' => '高度な入力設定',
    ],
    'timeSync' => [
      'title' => '時刻更新',
      'status' => [
        'syncing' => 'システム時計が現在、当社のサーバーと同期中です。しばらくお待ちください。',
        'accurate' => '時計は正確です。',
        'potentiallyWrong' => 'システム時計が正確でない可能性があります。',
        'value' => 'ローカル時間とサーバー時間の差が :offset あります。',
      ],
      'details' => '詳細',
      'syncButtonLabel' => '同期',
      'roundTripDuration' => '往復の所要時間',
      't0' => 'クライアントのリクエスト送信時刻',
      't1' => 'リクエスト受信時のサーバーのタイムスタンプ',
      't2' => 'サーバーの応答送信時刻',
      't3' => 'クライアントの応答受信時刻',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => '検出されたオフセット（ネットワーク経由）',
    ],
    'localSettings' => [
      'title' => '局所設定',
    ],
    'credits' => [
      'title' => 'クレジット',
      'developedBy' => '開発: <1></1>',
      'using' => '使用: <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => '翻訳: <1></1>',
      'openSourceSoftware' => 'オープンソース',
      'viewSourceCode' => 'ソースコードを見る',
      'notAffiliated' => 'このサイトとDiscordは関係していません。',
    ],
    'themeButton' => [
      'dark' => 'ダークモード',
      'light' => 'ライトモード',
      'system' => 'システム設定カラー',
    ],
  ],
  'designEditor' => [
    'title' => 'デザイン編集',
    'description' => '以下の表の入力項目を使用して、ウェブサイトの表示に関する多くの要素を調整できます。変数名はコード内の識別子に基づいているため、翻訳できません。ページを更新すると値がリセットされます。',
    'designPageLink' => 'デザインページ',
    'exportInfo' => '変更内容をUserStyleファイルにエクスポートできます。このファイルは<1>Stylus</1>などの拡張機能で使用でき、アプリの外観を恒久的にカスタマイズできます。ただし、これらの変数は随時変更される可能性があるため、カスタムスタイルを手動で更新する必要が生じる点に注意してください。',
    'export' => 'ユーザースタイルとして書き出す',
    'variableColumnHeader' => 'CSS 変数',
    'valueColumnHeader' => '評価',
  ],
];
