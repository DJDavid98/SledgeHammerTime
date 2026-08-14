<?php

return [
  'seoDescription' => '為 Discord 聊天訊息生成時間戳指示符',
  'changeLanguage' => '變更語言',
  "notFound" => [
    "heading" => "頁面不存在",
    "content" => "這裡沒什麼好看的。",
    "suggestions" => [
      "heading" => "正在找東西嗎？",
      "description" => "以下是一些可能對你有幫助的頁面：",
      "picker" => "時間戳選擇器",
      "botInfoDescription" => "關於 Discord 應用程式及其可用命令的信息",
      "discordCta" => "覺得缺了什麼？加入我們的Discord伺服器告訴我們吧。",
      "discordButton" => "加入 Discord 伺服器",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "維護模式",
    "content" => [
      'pleaseWait' => "應用程式正在更新，請稍後再試。",
      'joinSupportServer' => "如果問題持續超過幾分鐘，請加入 Discord 支援伺服器並告知我們。",
      'contactDeveloper' => "如果問題持續超過幾分鐘，請聯絡開發者並告知他們。",
    ],
    'autoReload' => '頁面將自動重新載入 <1/>',
    'reloadButton' => '手動重新加載',
    "supportServerButton" => "支援伺服器",
  ],
  'incompleteTranslations' => '翻譯內容不完整',
  'contributeTranslations' => '貢獻',
  'timezoneBadge' => [
    'currently' => '目前觀察到',
    'atPickedDate' => '在選定的時間進行觀察',
    'currentlyAndAtPickedDate' => '目前及選定時間均已觀察到',
  ],
  'copyToClipboard' => '複製到剪貼簿',
  'copiedToClipboard' => '已複製到剪貼簿！',
  'jsDisabled' => [
    'title' => '必須啟用 JavaScript',
    'body' => "您的瀏覽器不支援 JavaScript，或是目前已停用 JavaScript。部分瀏覽器基於安全考量，預設會停用 JavaScript，但此應用程式需要啟用 JavaScript 才能運作。請啟用 JavaScript 並重新整理頁面，或改用其他瀏覽器。",
  ],
  'nav' => [
    'botSettings' => '應用程式設定',
    'profile' => '輪廓',
    'legal' => '法律資訊',
    'analytics' => '分析',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '輸入設定',
      'naturalLanguageInput' => [
        'label' => '@時間輸入字段',
        'description' => '允許透過額外的自由文字輸入框，使用自然語言（例如「5 小時後」）來操作選定的時間戳記。類似於 Discord 的新 @time 標籤。目前僅支援有限數量的語言。',
      ],
      'customDateInput' => [
        'label' => '自訂日期輸入',
        'description' => "將瀏覽器預設日期輸入框替換為自訂日期輸入框。",
      ],
      'customTimeInput' => [
        'label' => '自訂時間輸入',
        'description' => "將瀏覽器預設時間輸入框替換為自訂時間輸入框。如果您在使用行動瀏覽器選擇時間時遇到問題，這將特別有用。",
      ],
      'separateInputs' => [
        'label' => '獨立輸入',
        'description' => "顯示兩個分別用於日期和時間的輸入欄位，而非合併為一個（因為某些瀏覽器不支援此功能）",
      ],
      'flatUi' => [
        'label' => '扁平化介面',
        'description' => "停用輸入框和按鈕的陰影和高度效果",
      ],
      'timezoneStickyHeaders' => [
        'label' => '時區組標題',
        'description' => '在時區選擇器下拉式選單中顯示固定組標題（例如：美洲、歐洲）。',
      ],
      'hourCycle' => [
        'label' => '時間格式',
        'description' => '變更應用程式中時間的顯示方式，包括自訂時間輸入和預覽。',
        'options' => [
          'default' => '語言預設',
          'h12' => '12小時',
          'h24' => '24小時',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => '一週的第一天',
        'description' => '變更自訂日期輸入日曆中一週的第一天。',
        'options' => [
          'default' => '語言預設',
        ],
      ],
      'advancedSettings' => '進階輸入設定',
    ],
    'timeSync' => [
      'title' => '時間同步',
      'status' => [
        'syncing' => '您的系統時鐘正在與我們的伺服器同步，請稍候。',
        'accurate' => '您的系統時鐘準確無誤。',
        'potentiallyWrong' => '您的系統時鐘可能不準確。',
        'value' => '本地時間和伺服器時間之差為:offset。',
      ],
      'details' => '詳細資訊',
      'syncButtonLabel' => '同步',
      'roundTripDuration' => '往返時長',
      't0' => '客戶端請求傳輸的時間戳',
      't1' => '伺服器接收請求的時間戳',
      't2' => '伺服器回應傳輸的時間戳',
      't3' => '伺服器接收請求的時間戳',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => '偵測到的偏移量（透過網路）',
    ],
    'localSettings' => [
      'title' => '地區設定',
    ],
    'credits' => [
      'title' => '製作人員名單',
      'developedBy' => '由 <1> 開發</1>',
      'using' => '使用 <1></1>',
      'fontAwesomeFree' => 'Font Awesome 免費版',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => '譯者：<1></1>',
      'openSourceSoftware' => '開源軟體',
      'viewSourceCode' => '檢視原始碼',
      'notAffiliated' => '本專案與 Discord 並無任何關聯。',
    ],
    'themeButton' => [
      'dark' => '深色主題',
      'light' => '淺色主題',
      'system' => '使用系統主題',
    ],
  ],
  'designEditor' => [
    'title' => '設計編輯',
    'description' => '您可以使用下表中的輸入項目調整網站外觀的多個方面。變數名稱基於程式碼中的標識符，因此無法翻譯。頁面刷新後，所有值都將被重設。',
    'designPageLink' => '設計頁面',
    'exportInfo' => '您可以將變更內容匯出至 UserStyle 檔案，並搭配 <1>Stylus</1> 等擴充功能使用，以永久自訂應用程式的外觀。但請注意，這些變數隨時可能變更，屆時您將需要手動更新自訂樣式。',
    'export' => '匯出為 UserStyle',
    'variableColumnHeader' => 'CSS 變數',
    'valueColumnHeader' => '價值',
  ],
];
