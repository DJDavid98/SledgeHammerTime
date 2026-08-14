<?php

return [
  'seoDescription' => 'Generer tidsstempler til Discord beskeder',
  'changeLanguage' => 'Skift sprog',
  "notFound" => [
    "heading" => "Siden blev ikke fundet",
    "content" => "Der er ikke noget at se her.",
    "suggestions" => [
      "heading" => "Leder du efter noget?",
      "description" => "Her er nogle sider, der måske kan være til hjælp:",
      "picker" => "Tidspunkts vælger",
      "botInfoDescription" => "Oplysninger om Discord appen og de tilgængelige kommandoer",
      "discordCta" => "Synes du, der mangler noget? Tilmeld dig Discord serveren og giv os besked.",
      "discordButton" => "Bliv medlem af Discord serveren",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Vedligeholdelsestilstand",
    "content" => [
      'pleaseWait' => "Applikationen opdateres i øjeblikket. Prøv venligst igen om et par sekunder.",
      'joinSupportServer' => "Hvis problemet fortsætter i mere end et par minutter, bedes du deltage i Discord support serveren og lade os vide.",
      'contactDeveloper' => "Hvis problemet varer længere end et par minutter, bedes du kontakte udvikleren.",
    ],
    'autoReload' => 'Siden genindlæses automatisk <1/>',
    'reloadButton' => 'Genindlæs manuelt',
    "supportServerButton" => "Supportserver",
  ],
  'incompleteTranslations' => 'Oversættelserne er ufuldstændige',
  'contributeTranslations' => 'Bidrage',
  'timezoneBadge' => [
    'currently' => 'Observeres i øjeblikket',
    'atPickedDate' => 'Observeret på det valgte tidspunkt',
    'currentlyAndAtPickedDate' => 'Observeret nu og på det valgte tidspunkt',
  ],
  'copyToClipboard' => 'Kopier til udklipsholder',
  'copiedToClipboard' => 'Kopieret til udklipsholderen!',
  'jsDisabled' => [
    'title' => 'JavaScript er nødvendigt',
    'body' => "Din browser understøtter enten ikke JavaScript, eller også er det deaktiveret i øjeblikket. Nogle browsere deaktiverer JavaScript som standard af sikkerhedsmæssige årsager, men det er nødvendigt for denne applikation. Aktivér det, og opdater siden, eller brug en anden browser.",
  ],
  'nav' => [
    'botSettings' => 'App indstillinger',
    'profile' => 'Profil',
    'legal' => 'Juridisk information',
    'analytics' => 'Analyse',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Input indstillinger',
      'naturalLanguageInput' => [
        'label' => '@tids input felt',
        'description' => 'Gør det muligt at ændre det valgte tidspunkt ved hjælp af naturligt sprog (f.eks. »om 5 timer«) via et ekstra fritekstfelt. Ligesom det nye @time-tag på Discord. Der understøttes kun et begrænset antal sprog.',
      ],
      'customDateInput' => [
        'label' => 'Brugerdefineret datoindtastning',
        'description' => "Erstat browserens standardfelt til indtastning af dato med et brugerdefineret felt.",
      ],
      'customTimeInput' => [
        'label' => 'Brugerdefineret tidsindtastning',
        'description' => "Erstat browserens standardtidspunkt med en brugerdefineret. Dette er især nyttigt, hvis du har problemer med at vælge klokkeslættet i mobilbrowsere.",
      ],
      'separateInputs' => [
        'label' => 'Separer input',
        'description' => "Vis to forskellige inputs for dato og tid i stedet for en kombineret (som ikke understøttes i nogle browsere)",
      ],
      'flatUi' => [
        'label' => 'Flad grænseflade',
        'description' => "Deaktiver skygge- og højdeeffekter på indtastningsfelter og knapper",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Overskrifter for tidszoner',
        'description' => 'Vis faste gruppeoverskrifter (f.eks. Amerika, Europa) i rullemenuen til valg af tidszone.',
      ],
      'hourCycle' => [
        'label' => 'Tidsformat',
        'description' => 'Du kan ændre, hvordan klokkeslættet vises i hele appen, herunder i felterne til indtastning af brugerdefineret klokkeslæt og i forhåndsvisningerne.',
        'options' => [
          'default' => 'Standardsprog',
          'h12' => '12 timer',
          'h24' => '24 timer',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Første ugedag',
        'description' => 'Ændr, hvilken dag der skal betragtes som ugens første dag i kalenderen for den brugerdefinerede datoindtastning.',
        'options' => [
          'default' => 'Standardsprog',
        ],
      ],
      'advancedSettings' => 'Avancerede indstillinger for indtastning',
    ],
    'timeSync' => [
      'title' => 'Tidssynkronisering',
      'status' => [
        'syncing' => 'Dit systemur synkroniseres i øjeblikket med vores servere. Vent venligst.',
        'accurate' => 'Dit systemur er korrekt.',
        'potentiallyWrong' => 'Dit systemur er muligvis forkert indstillet.',
        'value' => 'Forskellen mellem den lokale tid og servertiden er :offset.',
      ],
      'details' => 'detaljer',
      'syncButtonLabel' => 'Synkroniser',
      'roundTripDuration' => 'Synkroniserings tid',
      't0' => 'Klientens tidspunkt for afsendelsen af anmodningen',
      't1' => 'Serverens tidspunkt for modtagelsen af anmodningen',
      't2' => 'Serverens tidspunkt for afsendelsen af svaret',
      't3' => 'Kundens tidspunkt for modtagelsen af svaret',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Registreret forskydning (via netværket)',
    ],
    'localSettings' => [
      'title' => 'Lokale indstillinger',
    ],
    'credits' => [
      'title' => 'Krediteringer',
      'developedBy' => 'Udviklet af <1></1>',
      'using' => 'Indeholder <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Oversættelser af <1></1>',
      'openSourceSoftware' => 'Open source software',
      'viewSourceCode' => 'Se kildekoden',
      'notAffiliated' => 'Dette projekt er ikke forbundet med Discord.',
    ],
    'themeButton' => [
      'dark' => 'Mørkt tema',
      'light' => 'Lyst Tema',
      'system' => 'Brug systemtema',
    ],
  ],
  'designEditor' => [
    'title' => 'Ændre udseende',
    'description' => 'Du kan tilpasse mange aspekter af hjemmesidens udseende ved hjælp af indtastningsfelterne i tabellen nedenfor. Variabelnavnene er baseret på identifikatorer i koden og kan derfor ikke oversættes. Værdierne nulstilles, når siden opdateres.',
    'designPageLink' => 'Designside',
    'exportInfo' => 'Du kan eksportere dine ændringer til en UserStyle-fil, som kan bruges sammen med et tilføjelsesprogram som f.eks. <1>Stylus</1> for at tilpasse appens udseende permanent. Vær dog opmærksom på, at disse variabler kan ændres når som helst, hvilket betyder, at du bliver nødt til manuelt at opdatere dine brugerdefinerede stilarter.',
    'export' => 'Eksporter som brugerstil',
    'variableColumnHeader' => 'CSS variabel',
    'valueColumnHeader' => 'Værdi',
  ],
];
