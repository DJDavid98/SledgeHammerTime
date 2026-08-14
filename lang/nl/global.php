<?php

return [
  'seoDescription' => 'Genereer tijdsaanduidingen voor Discord chatberichten',
  'changeLanguage' => 'Wijzig taal',
  "notFound" => [
    "heading" => "Pagina Niet Gevonden",
    "content" => "Niets te zien hier.",
    "suggestions" => [
      "heading" => "Ergens naar op zoek?",
      "description" => "Hier zijn enkele pagina's die wellicht kunnen helpen:",
      "picker" => "Tijdstempel Kiezer",
      "botInfoDescription" => "Informatie over de Discord app en de beschikbare commando’s",
      "discordCta" => "Denk je dat er iets ontbreekt? Word dan lid van de Discord server en laat het ons weten.",
      "discordButton" => "Word lid van de Discord server",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Onderhoudsmodus",
    "content" => [
      'pleaseWait' => "De applicatie wordt momenteel bijgewerkt, probeer het over een paar seconden opnieuw.",
      'joinSupportServer' => "Als het probleem langer dan een paar minuten aanhoudt, laat het ons dan weten in de supportserver op Discord.",
      'contactDeveloper' => "Als het probleem langer dan een paar minuten aanhoudt, neem dan contact op met de ontwikkelaar.",
    ],
    'autoReload' => 'De pagina wordt automatisch herladen <1/>',
    'reloadButton' => 'Handmatig herladen',
    "supportServerButton" => "Support Server",
  ],
  'incompleteTranslations' => 'Vertalingen zijn onvolledig',
  'contributeTranslations' => 'Draag bij',
  'timezoneBadge' => [
    'currently' => 'Momenteel waargenomen',
    'atPickedDate' => 'Waargenomen op de gekozen tijd',
    'currentlyAndAtPickedDate' => 'Momenteel waargenomen & op de gekozen tijd',
  ],
  'copyToClipboard' => 'Kopiëren naar klembord',
  'copiedToClipboard' => 'Naar klembord gekopieerd!',
  'jsDisabled' => [
    'title' => 'JavaScript is noodzakelijk',
    'body' => "Uw browser ondersteunt JavaScript niet of het is momenteel uitgeschakeld. Sommige browsers deactiveren JavaScript standaard om veiligheidsredenen, maar het is noodzakelijk voor de werking van deze webapplicatie. Activeer JavaScript en ververs de pagina of gebruik een andere browser.",
  ],
  'nav' => [
    'botSettings' => 'App-instellingen',
    'profile' => 'Profiel',
    'legal' => 'Juridische informatie',
    'analytics' => 'Statistieken',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Input instellingen',
      'naturalLanguageInput' => [
        'label' => '@time invoerveld',
        'description' => 'Maak het mogelijk om de geselecteerde tijdstempel te manipuleren met natuurlijke taal (bijv. "over 5 uur") via een extra vrije tekstinvoer. Vergelijkbaar met de nieuwe Discord @time tag. Slechts een beperkt aantal talen wordt ondersteund.',
      ],
      'customDateInput' => [
        'label' => 'Aangepaste datum input',
        'description' => "Vervang de standaard datum input door een aangepaste variant.",
      ],
      'customTimeInput' => [
        'label' => 'Aangepaste tijd input',
        'description' => "Vervang de standaard tijd input door een aangepaste variant. Dit is vooral handig als je problemen hebt met het selecteren van de tijd op mobiele apparaten.",
      ],
      'separateInputs' => [
        'label' => 'Gescheiden inputs',
        'description' => "Toon twee gescheiden inputs voor datum en tijd in plaats van één gecombineerde (sommige browsers ondersteunen de gecombineerde input niet)",
      ],
      'flatUi' => [
        'label' => 'Platte interface gebruiken',
        'description' => "Zet schaduw- en hoogte effecten uit op inputs en knoppen",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Kopteksten voor groepen van tijdzones',
        'description' => 'Laat kopteksten zien voor groepen van tijdzones (bijv. "America" of "Europe") in het dropdown selectiemenu van de tijdzones.',
      ],
      'hourCycle' => [
        'label' => 'Tijdnotatie',
        'description' => 'Change how time is displayed across the app, including the custom time input and previews.',
        'options' => [
          'default' => 'Taal standaard',
          'h12' => '12-uurs',
          'h24' => '24-uurs',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Eerste dag van de week',
        'description' => 'Verander welke dag moet worden beschouwd als de eerste dag van de week in de kalender van de aangepaste datuminvoer.',
        'options' => [
          'default' => 'Taal standaard',
        ],
      ],
      'advancedSettings' => 'Geavanceerde input instellingen',
    ],
    'timeSync' => [
      'title' => 'Tijdsynchronisatie',
      'status' => [
        'syncing' => 'Uw systeemklok wordt momenteel gesynchroniseerd met onze servers. Een moment geduld a.u.b.',
        'accurate' => 'Uw systeemklok is accuraat.',
        'potentiallyWrong' => 'Het kan zijn dat uw systeemklok fout is.',
        'value' => 'Het verschil tussen uw lokale tijd en de servertijd is :offset.',
      ],
      'details' => 'Details',
      'syncButtonLabel' => 'Synchroniseer',
      'roundTripDuration' => 'Heen-en-terugtijd',
      't0' => 'De tijdstempel van de client op het moment van het verzenden van het verzoek',
      't1' => 'De tijdstempel van de server bij ontvangst van het verzoek',
      't2' => 'De tijdstempel van de server bij het verzenden van de respons',
      't3' => 'De tijdstempel van de client bij ontvangst van de respons',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Gedetecteerd verschil (via Netwerk)',
    ],
    'localSettings' => [
      'title' => 'Lokale Instellingen',
    ],
    'credits' => [
      'title' => 'Met dank aan',
      'developedBy' => 'Ontwikkeld door <1></1>',
      'using' => 'Met behulp van <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Vertalingen door <1></1>',
      'openSourceSoftware' => 'Open-source software',
      'viewSourceCode' => 'Bekijk de source code',
      'notAffiliated' => 'Dit project is niet geassocieerd met Discord.',
    ],
    'themeButton' => [
      'dark' => 'Donker Thema',
      'light' => 'Licht Thema',
      'system' => 'Systeemthema gebruiken',
    ],
  ],
  'designEditor' => [
    'title' => 'Ontwerp-editor',
    'description' => 'U kunt veel aspecten van het uiterlijk van de website aanpassen met behulp van de invoervelden in de onderstaande tabel. Variabelenamen zijn gebaseerd op identificatoren in de code en kunnen daarom niet worden vertaald. Waarden worden teruggezet bij het vernieuwen van de pagina.',
    'designPageLink' => 'Ontwerp Pagina',
    'exportInfo' => 'U kunt uw aanpassingen exporteren naar een UserStyle-bestand, dat kan worden gebruikt met een extensie zoals <1>Stylus</1> om het uiterlijk van de app permanent aan te passen. Houd er echter rekening mee dat deze variabelen op elk moment kunnen veranderen, waardoor u uw aangepaste stijlen handmatig moet bijwerken.',
    'export' => 'Exporteren als UserStyle',
    'variableColumnHeader' => 'CSS Variabele',
    'valueColumnHeader' => 'Waarde',
  ],
];
