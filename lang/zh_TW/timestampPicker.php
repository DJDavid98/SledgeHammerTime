<?php

return [
  'howTo' => '選擇一個日期，從 :syntaxColName 列複製所需的時間戳，並將其貼上到聊天訊息的任何位置。 結果將是一個動態時間戳，每個人都會根據他們的時區以不同的方式顯示。',
  'picker' => [
    'label' => [
      'date' => '日期',
      'time' => '時間',
      'dateAndTime' => '日期和時間',
      'timezone' => '時區',
      'naturalLanguageInput' => '@時間輸入',
      'modeOffset' => '絕對位移',
      'modeZoneName' => '區域名稱',
    ],
    'button' => [
      'jumpToToday' => '跳至目前月份',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => '設定為目前時間',
      'lock' => '通過 url 鎖定時間戳。',
      'unlock' => '解鎖時間戳',
      'previousYear' => '去年',
      'previousMonth' => '上個月',
      'previousDecade' => '前十年',
      'nextMonth' => '下個月',
      'nextYear' => '明年',
      'nextDecade' => '下一個十年',
    ],
    'validation' => [
      'naturalLanguageParseError' => '無法解析自然語言輸入'
    ]
  ],
  'table' => [
    'syntaxColumn' => '聊天語法',
    'resultColumn' => '結果範例',
    'editFormats' => '自訂格式',
    'resetFormats' => '還原為預設值',
    'hideFormat' => '隱藏此格式',
    'showFormat' => '顯示此格式',
    'unhideInProfile' => '在個人檔案設定中取消隱藏',
  ],
  'faq' => [
    'title' => '常見問題',
    'description' => '本節目前僅提供英文版本，內容主要參考自 <1>我們的 Discord 伺服器</1> 。除非您是該伺服器的成員，否則部分連結可能無法正常運作。',
  ],
  'usefulLinks' => [
    'lead' => '您可能也會發現這些資訊很有用：',
    'server' => [
      'header' => '官方 HammerTime 服務器',
      'p' => '討論網站、測試語法並建議功能',
    ],
    'bot' => [
      'header' => 'HammerTime 機器人',
      'p' => '在 Discord 中使用斜線指令生成時間戳記',
    ],
    'oldSite' => [
      'header' => 'HammerTime 測試版網站',
      'p' => '該專案的舊版網站，在另行通知前仍可繼續使用',
    ],
    'textColor' => [
      'header' => 'Rebane 的<1>彩色</1>文字產生器',
      'p' => '使用 ANSI 顏色代碼建立彩色 Discord 訊息的簡單應用程式',
    ],
    "subreddit" => [
      "p" => "這個專案的靈感來源，是一個社群為一款被低估的賽車遊戲每週舉辦挑戰賽",
    ],
    'competitors' => [
      'lead' => [
        'p1' => '您知道 HammerTime 不是產生時間戳記的唯一工具嗎？',
        'p2' => '您不妨參考以下其他 Discord 時間戳記產生器，找出最適合您的那一個：',
      ],
      '3vfi' => [
        'header' => '',
        'p' => '由 3ventic 開發的簡易且快速的時間戳記產生器',
      ],
      'dabric' => [
        'header' => '',
        'p' => '由 dabric 開發的自然語言 Discord 時間戳記產生器',
      ],
      'discordtimestampCom' => [
        'p' => '由 Sellframe Ltd. 提供的免費 Discord 時間戳記產生器，支援本地時區。',
      ],
      'discordtimestampOrg' => [
        'p' => '由 DiscordTimestamp.org 提供的 Discord 時間戳記產生器與時間轉換器',
      ],
      'sesh' => [
        'p' => '透過 Tunks 開發的 Sesh 排程機器人生態系統，在系統內部建立 Discord Markdown 時間戳記',
      ],
    ],
  ],
];
