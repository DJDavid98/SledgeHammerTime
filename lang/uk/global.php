<?php

return [
  'seoDescription' => 'Створення індикаторів часових позначок для повідомлень чату Discord',
  'changeLanguage' => 'Змінити мову',
  "notFound" => [
    "heading" => "Сторінку не знайдено",
    "content" => "Тут нічого не видно.",
    "suggestions" => [
      "heading" => "Шукаєте щось?",
      "description" => "Ось декілька сторінок, які можуть допомогти:",
      "picker" => "Timestamp Picker",
      "botInfoDescription" => "Інформація про застосунок Discord та доступні команди",
      "discordCta" => "Вам здається, що чогось не вистачає? Приєднуйтесь до сервера Discord і повідомте нам про це.",
      "discordButton" => "Приєднатися до сервера Discord",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Режим тех. обслуговування",
    "content" => [
      'pleaseWait' => "Додаток зараз оновлюється, будь ласка, спробуйте ще раз через кілька секунд.",
      'joinSupportServer' => "Якщо проблема не зникає більше кількох хвилин, будь ласка, приєднайтеся до сервера підтримки Discord і повідомте нам про це.",
      'contactDeveloper' => "If the issue persists for more than a few minutes, please contact the developer and let them know.",
    ],
    'autoReload' => 'The page will reload automatically <1/>',
    'reloadButton' => 'Reload manually',
    "supportServerButton" => "Сервер підтримки",
  ],
  'incompleteTranslations' => 'Переклади неповні',
  'contributeTranslations' => 'Зробити внесок',
  'timezoneBadge' => [
    'currently' => 'Observed currently',
    'atPickedDate' => 'Observed at picked time',
    'currentlyAndAtPickedDate' => 'Observed currently & at picked time',
  ],
  'copyToClipboard' => 'Копіювати в буфер обміну',
  'copiedToClipboard' => 'Скопійовано!',
  'jsDisabled' => [
    'title' => 'JavaScript необхідний',
    'body' => "Ваш браузер або не підтримує JavaScript, або він наразі вимкнений. Деякі браузери вимикають JavaScript за умовчанням з міркувань безпеки, але це необхідно для цієї програми. Увімкніть його та оновіть сторінку або скористайтеся іншим браузером.",
  ],
  'nav' => [
    'botSettings' => 'Налаштування',
    'profile' => 'Профіль',
    'legal' => 'Юридична інформація',
    'analytics' => 'Аналітика',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Налаштування введення',
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Замініть час за замовчуванням у браузері на власний. Це особливо корисно, якщо у вас виникають проблеми з вибором часу в мобільних браузерах.",
      ],
      'separateInputs' => [
        'label' => 'Окремі введення',
        'description' => "Відображення двох різних введень для дати та часу замість комбінованого (це не підтримується в деяких браузерах)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Timezone group headers',
        'description' => 'Show sticky group headers (e.g. America, Europe) in the timezone selector dropdown.',
      ],
      'hourCycle' => [
        'label' => 'Time format',
        'description' => 'Change how time is displayed across the app, including the custom time input and previews.',
        'options' => [
          'default' => 'Language default',
          'h12' => '12-hour',
          'h24' => '24-hour',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'First day of the week',
        'description' => 'Change which day should be considered the first day of the week in the calendar of the custom date input.',
        'options' => [
          'default' => 'Language default',
        ],
      ],
      'advancedSettings' => 'Advanced input settings',
    ],
    'timeSync' => [
      'title' => 'Time Synchronization',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'Your system clock is accurate.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'The difference between the local and server time is :offset.',
      ],
      'details' => 'Подробиці',
      'syncButtonLabel' => 'Synchronize',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => 'Локальні налаштування',
    ],
    'credits' => [
      'title' => 'Автори',
      'developedBy' => 'Розробивши <1></1>',
      'using' => 'Використовувати <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Перекладено <1></1>',
      'openSourceSoftware' => 'Програмне забезпечення з відкритим кодом',
      'viewSourceCode' => 'Переглянути початковий код',
      'notAffiliated' => 'Цей проєкт не пов’язаний з Discord.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
    ],
  ],
  'designEditor' => [
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Value',
  ],
];
