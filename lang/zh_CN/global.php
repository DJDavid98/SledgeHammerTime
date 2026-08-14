<?php

return [
  'seoDescription' => '为 Discord 聊天消息生成时间戳',
  'changeLanguage' => '更改语言',
  "notFound" => [
    "heading" => "页面不存在",
    "content" => "这里空无一物。",
    "suggestions" => [
      "heading" => "在找什么吗？",
      "description" => "以下页面可能对您有帮助：",
      "picker" => "时间戳生成器",
      "botInfoDescription" => "关于 Discord 应用和可用命令的信息",
      "discordCta" => "觉得缺了什么？加入 Discord 服务器告诉我们吧。",
      "discordButton" => "加入 Discord 服务器",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "服务不可用",
    "content" => [
      'pleaseWait' => "应用程序正在更新，请稍后再试。",
      'joinSupportServer' => "如果问题持续几分钟以上，请加入 Discord 支持服务器并告知我们。",
      'contactDeveloper' => "如果问题持续几分钟以上，请联系开发人员并告知他们。",
    ],
    'autoReload' => '页面将在 <1/> 秒后自动重新加载',
    'reloadButton' => '手动重新加载',
    "supportServerButton" => "支持服务器",
  ],
  'incompleteTranslations' => '翻译内容不完整',
  'contributeTranslations' => '参与贡献',
  'timezoneBadge' => [
    'currently' => '当前使用此时区',
    'atPickedDate' => '所选时间使用此时区',
    'currentlyAndAtPickedDate' => '当前和所选时间均使用此时区',
  ],
  'copyToClipboard' => '复制到剪切板',
  'copiedToClipboard' => '已复制到复制到剪切板！',
  'jsDisabled' => [
    'title' => '需要启用 JavaScript',
    'body' => "您的浏览器不支持 JavaScript 或当前已禁用了该功能。部分浏览器出于安全考虑会默认禁用 JavaScript，但本应用需启用 JavaScript 才能正常运行。请启用后刷新页面，或更换其他浏览器。",
  ],
  'nav' => [
    'botSettings' => 'App 设置',
    'profile' => '个人资料',
    'legal' => '法律信息',
    'analytics' => '统计数据',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '输入设置',
      'naturalLanguageInput' => [
        'label' => '@time 输入字段',
        'description' => '允许通过附加的自由文本输入，用自然语言（如 "5 小时后"）操作所选的时间戳。类似于新的 Discord @time 标签。仅支持有限的几种语言。',
      ],
      'customDateInput' => [
        'label' => '自定义日期输入',
        'description' => "用自定义日期输入替换浏览器默认日期输入。",
      ],
      'customTimeInput' => [
        'label' => '自定义时间输入',
        'description' => "用自定义时间输入替换浏览器默认时间输入。如果在手机浏览器上选择时间有困难，这将尤其有用。",
      ],
      'separateInputs' => [
        'label' => '独立输入',
        'description' => "分别显示日期和时间的独立输入框，而非合并显示（部分浏览器不支持此功能）",
      ],
      'flatUi' => [
        'label' => '扁平化界面',
        'description' => "禁用输入和按钮上的阴影和高度效果",
      ],
      'timezoneStickyHeaders' => [
        'label' => '时区分组标题',
        'description' => '在时区选择器下拉菜单中显示会固定在顶部的分组标题（例如美洲、欧洲）。',
      ],
      'hourCycle' => [
        'label' => '时间格式',
        'description' => '更改整个应用中时间的显示方式，包括自定义时间输入和预览。',
        'options' => [
          'default' => '语言默认设置',
          'h12' => '12小时制',
          'h24' => '24小时制',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => '一周的起始日',
        'description' => '更改自定义日期输入的日历中，哪一天应被视为一周的第一天。',
        'options' => [
          'default' => '语言默认设置',
        ],
      ],
      'advancedSettings' => '高级输入设置',
    ],
    'timeSync' => [
      'title' => '时间同步',
      'status' => [
        'syncing' => '您的系统时钟正在与我们的服务器同步，请稍候。',
        'accurate' => '您的系统时钟是准确的。',
        'potentiallyWrong' => '您的系统时钟可能有误。',
        'value' => '本地时间和服务器时间的差值为 :offset。',
      ],
      'details' => '细节',
      'syncButtonLabel' => '同步',
      'roundTripDuration' => '往返耗时',
      't0' => '客户端发送请求的时间戳',
      't1' => '服务器接收请求的时间戳',
      't2' => '服务器发送请求的时间戳',
      't3' => '客户端接收请求的时间戳',
      'timestampValue' => ':value 秒',
      'offsetAmount' => ':offset 毫秒',
      'networkOffsetCell' => '检测到的偏移量（通过网络）',
    ],
    'localSettings' => [
      'title' => '本地设置',
    ],
    'credits' => [
      'title' => '鸣谢',
      'developedBy' => '开发者 <1></1>',
      'using' => '使用 <1></1>',
      'fontAwesomeFree' => 'Font Awesome 免费版',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => '翻译者 <1></1>',
      'openSourceSoftware' => '开源软件',
      'viewSourceCode' => '查看源代码',
      'notAffiliated' => '此项目不隶属于 Discord。',
    ],
    'themeButton' => [
      'dark' => '深色主题',
      'light' => '浅色主题',
      'system' => '使用系统主题',
    ],
  ],
  'designEditor' => [
    'title' => '设计编辑器',
    'description' => '您可以通过下方表格中的输入项调整网站外观的多个方面。变量名基于代码中的标识符，因此无法进行翻译。刷新页面时，所有键值都将被重置。',
    'designPageLink' => '设计页面',
    'exportInfo' => '您可以将修改导出至 UserStyle 文件，通过<1>Stylus</1>等扩展程序实现应用外观的永久自定义。请注意：相关变量可能随时发生变更，届时需手动更新自定义样式。',
    'export' => '导出为 UserStyle',
    'variableColumnHeader' => 'CSS 变量',
    'valueColumnHeader' => '价值',
  ],
];
