<?php

return [
  'seoDescription' => 'Genera marques de temps per a missatges de Discord',
  'changeLanguage' => 'Canvia l\'idioma',
  "notFound" => [
    "heading" => "Pàgina no trobada",
    "content" => "No hi ha res a veure ací.",
    "suggestions" => [
      "heading" => "Busques alguna cosa?",
      "description" => "Aquí teniu algunes pàgines que us poden ajudar:",
      "picker" => "Selector de segell de temps",
      "botInfoDescription" => "Informació sobre l'aplicació Discord i les comandes disponibles",
      "discordCta" => "Creus que falta alguna cosa? Uneix-te al servidor de Discord i fes-nos-ho saber.",
      "discordButton" => "Uneix-te al servidor de Discord",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Mode de manteniment",
    "content" => [
      'pleaseWait' => "L'aplicació s'està actualitzant actualment, si us plau, torneu a provar d'aquí a uns segons.",
      'joinSupportServer' => "Si el problema persisteix durant més d'uns minuts, si us plau, uniu-vos al servidor de suport de Discord i feu-nos-ho saber.",
      'contactDeveloper' => "Si el problema persisteix durant més d'uns minuts, si us plau, poseu-vos en contacte amb el desenvolupador i informeu-lo.",
    ],
    'autoReload' => 'La pàgina es recarregarà automàticament <1/>',
    'reloadButton' => 'Recarregar manualment',
    "supportServerButton" => "Servei de suport",
  ],
  'incompleteTranslations' => 'Traducció incompleta',
  'contributeTranslations' => 'Contribuïu',
  'timezoneBadge' => [
    'currently' => 'Observat actualment',
    'atPickedDate' => 'Observat a l\'hora escollida',
    'currentlyAndAtPickedDate' => 'Observat actualment i en el moment escollit',
  ],
  'copyToClipboard' => 'Copia al porta-retalls',
  'copiedToClipboard' => 'Copiat al porta-retalls!',
  'jsDisabled' => [
    'title' => 'No s\'ha trobat JavaScript',
    'body' => "El vostre navegador no és compatible amb JavaScript o està desactivat. Alguns navegadors desactiven JavaScript per defecte per motius de seguretat, però és necessari per a aquesta aplicació. Per favor, activeu-la i refresqueu la pàgina, o utilitzeu un navegador diferent.",
  ],
  'nav' => [
    'botSettings' => 'Configuració de l\'aplicació',
    'profile' => 'Perfil',
    'legal' => 'Informacio legal',
    'analytics' => 'Anàlisi',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Configuració d\'entrada',
      'naturalLanguageInput' => [
        'label' => '@time camp d\'entrada',
        'description' => 'Permet manipular el segell de temps seleccionat amb llenguatge natural (p. ex. «d\'aquí a 5 hores») mitjançant una entrada de text lliure addicional. De manera similar a la nova etiqueta @time de Discord. Només es suporten un nombre limitat de llengües.',
      ],
      'customDateInput' => [
        'label' => 'Introducció de data personalitzada',
        'description' => "Substitueix el camp de data per defecte del navegador per un de personalitzat.",
      ],
      'customTimeInput' => [
        'label' => 'Introducció de temps personalitzada',
        'description' => "Substitueix el camp de selecció d'hora per defecte del navegador per un de personalitzat. Això és especialment útil si tens problemes per seleccionar l'hora als navegadors mòbils.",
      ],
      'separateInputs' => [
        'label' => 'Entrades separades',
        'description' => "Mostra dues entrades diferents per a la data i l'hora en vegada d'una combinada (cosa que no és compatible amb alguns navegadors)",
      ],
      'flatUi' => [
        'label' => 'Aplanar la interfície',
        'description' => "Desactiva els efectes d'ombra i d'alçada als controls i botons",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Encapçalaments del grup de zones horàries',
        'description' => 'Mostra els encapçalaments de grup fixos (p. ex. Amèrica, Europa) al menú desplegable del selector de fus horari.',
      ],
      'hourCycle' => [
        'label' => 'Format de l\'hora',
        'description' => 'Canvia la manera com es mostra l\'hora a tota l\'aplicació, incloent-hi l\'entrada d\'hora personalitzada i les previsualitzacions.',
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
      'title' => 'Sincronització Del Temps',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'El teu rellotge es exacte.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'La diferència entra al temps local i el temps del servidor es :offset.',
      ],
      'details' => 'Detalls',
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
      'title' => 'Local Settings',
    ],
    'credits' => [
      'title' => 'Crèdits',
      'developedBy' => 'Desenvolupat per <1></1>',
      'using' => 'Utilitzant <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Traducció per <1></1>',
      'openSourceSoftware' => 'Programari de codi obert',
      'viewSourceCode' => 'Vore codi font',
      'notAffiliated' => 'Aquest projecte no està afiliat amb Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema fosc',
      'light' => 'Tema clar',
      'system' => 'Utilitzeu el tema del sistema',
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
