<?php

return [
  'seoDescription' => 'Generujte časová razítka pro zprávy v chatu na Discordu',
  'changeLanguage' => 'Změnit jazyk',
  "notFound" => [
    "heading" => "Stránka nenalezena",
    "content" => "Není zde nic k zobrazení.",
    "suggestions" => [
      "heading" => "Looking for something?",
      "description" => "Here are some pages that might help:",
      "picker" => "Timestamp Picker",
      "botInfoDescription" => "Information about the Discord app and available commands",
      "discordCta" => "Think something is missing? Join the Discord server and let us know.",
      "discordButton" => "Join the Discord Server",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Režim údržby",
    "content" => [
      'pleaseWait' => "Aplikace se momentálně aktualizuje, zkuste to prosím znovu za několik sekund.",
      'joinSupportServer' => "Pokud problém přetrvává déle než pár minut, připojte se prosím na Discord server podpory a dejte nám vědět.",
      'contactDeveloper' => "Pokud problém přetrvává déle než pár minut, kontaktujte prosím vývojáře a dejte jim vědět.",
    ],
    'autoReload' => 'The page will reload automatically <1/>',
    'reloadButton' => 'Reload manually',
    "supportServerButton" => "Server podpory",
  ],
  'incompleteTranslations' => 'Překlad není úplný',
  'contributeTranslations' => 'Přispět',
  'timezoneBadge' => [
    'currently' => 'Observed currently',
    'atPickedDate' => 'Observed at picked time',
    'currentlyAndAtPickedDate' => 'Observed currently & at picked time',
  ],
  'copyToClipboard' => 'Zkopírovat do schránky',
  'copiedToClipboard' => 'Zkopírováno do schránky!',
  'jsDisabled' => [
    'title' => 'JavaScript je nezbytný',
    'body' => "Váš prohlížeč buď nepodporuje JavaScript, nebo je momentálně vypnutý. Některé prohlížeče JavaScript z bezpečnostních důvodů vypínají ve výchozím nastavení, ale pro tuto aplikaci je nezbytný. Prosím, povolte jej a obnovte stránku, případně použijte jiný prohlížeč.",
  ],
  'nav' => [
    'botSettings' => 'Nastavení aplikace',
    'profile' => 'Můj účet',
    'legal' => 'Právní informace',
    'analytics' => 'Analytika',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Nastavení vstupu',
      'naturalLanguageInput' => [
        'label' => 'Vstupní pole pro @time',
        'description' => 'Umožněte manipulaci s vybraným časovým razítkem pomocí přirozené řeči (např. „za 5 hodin“) prostřednictvím dodatečného zadání v podobě vlastního textu. Podobně jako u nové Discord funkce @time tag. K dispozici je pouze omezený počet jazyků.',
      ],
      'customDateInput' => [
        'label' => 'Formátované vstupní pole data',
        'description' => "Nahradí výchozí vstupní pole prohlížeče formátovaným.",
      ],
      'customTimeInput' => [
        'label' => 'Formátované vstupní pole času',
        'description' => "Nahradí výchozí vstupní pole prohlížeče formátovaným. To je obzvlášť užitečné, pokud máte problém s výběrem času na mobilních prohlížečích.",
      ],
      'separateInputs' => [
        'label' => 'Samostatná vstupní pole',
        'description' => "Zobrazí dvě samostatná vstupní pole pro datum a čas namísto jednoho kombinovaného (které nemusí být podporováno v některých prohlížečích)",
      ],
      'flatUi' => [
        'label' => 'Zjednodušené rozhraní',
        'description' => "Odstraní stíny a výškové efekty u vstupních polí a tlačítek",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Timezone group headers',
        'description' => 'Show sticky group headers (e.g. America, Europe) in the timezone selector dropdown.',
      ],
      'hourCycle' => [
        'label' => 'Time format',
        'description' => 'Change how time is displayed across the app, including the custom time input and previews.',
        'options' => [
          'default' => 'Standard vašeho jazyka',
          'h12' => '12-hodinový',
          'h24' => '24-hodinový',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'První den v týdnu',
        'description' => 'Změňte, který den by měl být považován za první den v týdnu v kalendáři vstupního pole data.',
        'options' => [
          'default' => 'Standard vašeho jazyka',
        ],
      ],
      'advancedSettings' => 'Rozšířená nastavení vstupu',
    ],
    'timeSync' => [
      'title' => 'Synchronizace času',
      'status' => [
        'syncing' => 'Váš systémový čas se právě synchronizuje s našimi servery, vyčkejte prosím.',
        'accurate' => 'Váš systémový čas je přesný.',
        'potentiallyWrong' => 'Váš systémový čas může být nepřesný.',
        'value' => 'Rozdíl mezi časem na vašem počítači a časem serveru je :offset.',
      ],
      'details' => 'Podrobnosti',
      'syncButtonLabel' => 'Synchronizovat',
      'roundTripDuration' => 'Doba přenosu tam a zpět',
      't0' => 'Časové razítko klienta při odeslání požadavku',
      't1' => 'Časové razítko serveru při přijetí požadavku',
      't2' => 'Časové razítko serveru při odeslání odpovědi',
      't3' => 'Časové razítko klienta při přijetí odpovědi',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Zjištěný posun (přes síť)',
    ],
    'localSettings' => [
      'title' => 'Lokální nastavení',
    ],
    'credits' => [
      'title' => 'Zásluhy',
      'developedBy' => 'Vytvořili <1></1>',
      'using' => 'Použitím <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Přeložili <1></1>',
      'openSourceSoftware' => 'Otevřený software',
      'viewSourceCode' => 'Zobrazit zdrojový kód',
      'notAffiliated' => 'Tento projekt není nijak přidružen k společnosti Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tmavý motiv',
      'light' => 'Světlý motiv',
      'system' => 'Použít motiv systému',
    ],
  ],
  'designEditor' => [
    'title' => 'Editor vzhledu',
    'description' => 'Pomocí políček v tabulce níže můžete upravit mnoho aspektů vzhledu webu. Názvy proměnných vycházejí z identifikátorů v kódu, a proto nejsou přeloženy. Hodnoty budou resetovány po obnovení stránky.',
    'designPageLink' => 'Stránka se vzhledem',
    'exportInfo' => 'Své změny můžete exportovat do souboru UserStyle, který lze použít s rozšířením, jako je <1>Stylus</1>, k trvalému přizpůsobení vzhledu aplikace. Upozorňujeme však, že tyto proměnné se mohou kdykoli změnit, což bude vyžadovat manuální aktualizaci vašich vlastních stylů.',
    'export' => 'Exportovat jako UserStyle',
    'variableColumnHeader' => 'Proměnná v CSS',
    'valueColumnHeader' => 'Hodnota',
  ],
];
