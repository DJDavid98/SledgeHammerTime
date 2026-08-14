<?php

return [
  'howTo' => 'Escolha uma data, copie o timestamp desejado da coluna da :syntaxColName, e cole em qualquer lugar em uma mensagem. O resultado será um timestamp dinâmico que mostra diferentes datas e horários para todos com base no seu próprio fuso horário.',
  'picker' => [
    'label' => [
      'date' => 'Data',
      'time' => 'Horário',
      'dateAndTime' => 'Data e hora',
      'timezone' => 'Fuso horário',
      'naturalLanguageInput' => '@time campo',
      'modeOffset' => 'Diferença absoluta',
      'modeZoneName' => 'Nome da Zona',
    ],
    'button' => [
      'jumpToToday' => 'Ir para o mês atual',
      'contextRange' => '<0/>-<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Definir para hora atual',
      'lock' => 'Trancar timestamp via URL',
      'unlock' => 'Destrancar timestamp',
      'previousYear' => 'Ano anterior',
      'previousMonth' => 'Mês anterior',
      'previousDecade' => 'Década anterior',
      'nextMonth' => 'Próximo mês',
      'nextYear' => 'Próximo ano',
      'nextDecade' => 'Próxima década',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Não foi possível analisar a entrada em linguagem natural'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaxe do chat',
    'resultColumn' => 'Exemplo do resultado',
    'editFormats' => 'Personalizar formatos',
    'resetFormats' => 'Redefinir padrões',
    'hideFormat' => 'Ocultar este formato',
    'showFormat' => 'Mostrar este formato',
    'unhideInProfile' => 'Reexibir nas configurações de perfil',
  ],
  'faq' => [
    'title' => 'Preguntas frequentes',
    'description' => 'Por enquanto, esta seção está disponível apenas em inglês e é baseada, em grande parte, no conteúdo do <1>nosso servidor do Discord</1>. Alguns links podem não funcionar como esperado caso você não seja membro.',
  ],
  'usefulLinks' => [
    'lead' => 'Você também pode achar isto útil:',
    'server' => [
      'header' => 'Servidor Oficial do HammerTime',
      'p' => 'Discuta sobre o site, teste a sintaxe e sugira funções',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Gere timestamps dentro do Discord usando slash commands',
    ],
    'oldSite' => [
      'header' => 'Site antigo do "Hammer" "Time"',
      'p' => 'O antigo site do projeto, ainda disponível até segunda ordem',
    ],
    'textColor' => [
      'header' => 'Gerador de Texto <1>Colorido</1> do Rebane',
      'p' => 'Um aplicativo simples que cria mensagens coloridas no Discord usando o código de cores ANSI',
    ],
    "subreddit" => [
      "p" => "A comunidade apresentando desafios semanais para um jogo de corrida subestimado que inspirou a criação deste projeto",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Você sabia que HammerTime não é a única ferramenta para gerar timestamps?',
        'p2' => 'Você pode querer conferir estes outros geradores de timestamp do Discord para encontrar um que funcione melhor para você:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'Um gerador simples e rápido de timestamp por 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Gerador de timestamp de linguagem natural do Discord por dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Gerador gratuito de timestamp do Discord com suporte para fuso horário local por Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Gerador e conversor de tempo para o timestamp do Discord por DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Crie carimbos de timestamps no formato Markdown do Discord a partir do ecossistema de bots de agendamento Sesh, da Tunks',
      ],
    ],
  ],
];
