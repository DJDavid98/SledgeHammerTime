<?php

return [
  'seoDescription' => 'Gerar indicadores de timestamp para mensagens de chat Discord',
  'changeLanguage' => 'Mudar idioma',
  "notFound" => [
    "heading" => "Página não encontrada",
    "content" => "Nada para visualizar aqui.",
    "suggestions" => [
      "heading" => "Procurando por algo?",
      "description" => "Aqui estão algumas páginas que podem ajudar:",
      "picker" => "Seletor de Timestamp",
      "botInfoDescription" => "Informações sobre o aplicativo do Discord e comandos disponíveis",
      "discordCta" => "Está pensando que algo está faltando? Entre no servidor do Discord e nos avise.",
      "discordButton" => "Junte-se ao nosso servidor de Discord",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Modo de Manutenção",
    "content" => [
      'pleaseWait' => "O aplicativo está sendo atualizado no momento, por favor tente novamente em alguns segundos.",
      'joinSupportServer' => "Se o problema persistir por mais de alguns minutos, entre no servidor de suporte do Discord e nos avise.",
      'contactDeveloper' => "Se o problema persistir por mais de alguns minutos, entre em contato com o desenvolvedor e avise-o.",
    ],
    'autoReload' => 'A página irá recarregar automaticamente <1/>',
    'reloadButton' => 'Recarregar manualmente',
    "supportServerButton" => "Servidor de Suporte",
  ],
  'incompleteTranslations' => 'As traduções estão incompletas',
  'contributeTranslations' => 'Contribuir',
  'timezoneBadge' => [
    'currently' => 'Observado atualmente',
    'atPickedDate' => 'Observado na hora selecionada',
    'currentlyAndAtPickedDate' => 'Observado atualmente e na hora selecionada',
  ],
  'copyToClipboard' => 'Copiar para a área de transferência',
  'copiedToClipboard' => 'Copiado para a área de transferência!',
  'jsDisabled' => [
    'title' => 'JavaScript é necessário',
    'body' => "O seu browser ou não suporta JavaScript, ou está atualmente desativado. Alguns navegadores desativam o JavaScript por padrão por razões de segurança, mas é necessário para esta aplicação. Por favor, ative-o e atualize a página, ou utilize um navegador diferente.",
  ],
  'nav' => [
    'botSettings' => 'Configurações do Aplicativo',
    'profile' => 'Perfil',
    'legal' => 'Informações Legais',
    'analytics' => 'Estatísticas',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Configurações de Entrada',
      'naturalLanguageInput' => [
        'label' => 'Campo de entrada @time',
        'description' => 'Permitir manipulação do timestamp selecionado com linguagem natural (por exemplo, "em 5 horas") através de uma entrada adicional de texto livre. Semelhante à nova tag do Discord @time. Somente um número limitado de idiomas é suportado.',
      ],
      'customDateInput' => [
        'label' => 'Entrada personalizada de datas',
        'description' => "Substitua a data padrão do navegador por uma personalizada.",
      ],
      'customTimeInput' => [
        'label' => 'Entrada de horário personalizada',
        'description' => "Substitua a entrada de hora padrão do navegador por uma personalizada. Isso é especialmente útil caso tenha problemas ao selecionar o tempo nos navegadores móveis.",
      ],
      'separateInputs' => [
        'label' => 'Entradas separadas',
        'description' => "Mostra dois inputs diferentes para data e hora em vez de um combinado (que não é suportado em alguns browsers)",
      ],
      'flatUi' => [
        'label' => 'Interface Flatten',
        'description' => "Desativar efeitos de sombra e altura em botões e entradas",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Cabeçalhos dos grupos de fusos horários',
        'description' => 'Mostrar os cabeçalhos fixos dos grupos (por exemplo, América, Europa) no menu de seleção do fuso horário.',
      ],
      'hourCycle' => [
        'label' => 'Formato da hora',
        'description' => 'Altere a forma como o tempo é exibido em todo o aplicativo, incluindo as pré-visualizações de horário personalizado.',
        'options' => [
          'default' => 'Idioma padrão',
          'h12' => '12 horas',
          'h24' => '24 horas',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Primeiro dia da semana',
        'description' => 'Altere qual dia deve ser considerado como o primeiro dia da semana no calendário da entrada de data personalizada.',
        'options' => [
          'default' => 'Idioma padrão',
        ],
      ],
      'advancedSettings' => 'Configurações avançadas de entrada',
    ],
    'timeSync' => [
      'title' => 'Sincronização de Hora',
      'status' => [
        'syncing' => 'O relógio do seu sistema está atualmente sendo sincronizado com nossos servidores, por favor aguarde.',
        'accurate' => 'O relógio do seu sistema está correto.',
        'potentiallyWrong' => 'O relógio do seu sistema pode estar errado.',
        'value' => 'A diferença entre a hora local e a hora do servidor é: offset.',
      ],
      'details' => 'Detalhes',
      'syncButtonLabel' => 'Sincronizar',
      'roundTripDuration' => 'Duração da viagem de ida e volta',
      't0' => 'O timestamp do cliente da transmissão do pedido',
      't1' => 'O timestamp do servidor da recepção do pedido',
      't2' => 'O timestamp do servidor da transmissão da resposta',
      't3' => 'O timestamp do cliente da recepção de resposta',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Deslocamento Detetado (via Rede)',
    ],
    'localSettings' => [
      'title' => 'Configurações locais',
    ],
    'credits' => [
      'title' => 'Créditos',
      'developedBy' => 'Desenvolvido por <1></1>',
      'using' => 'A utilizar <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Tradução por <1></1>',
      'openSourceSoftware' => 'Programa com código aberto',
      'viewSourceCode' => 'Ver código fonte',
      'notAffiliated' => 'Este projeto não é afiliado ao Discord.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Tema Claro',
      'system' => 'Utilizar o tema do sistema',
    ],
  ],
  'designEditor' => [
    'title' => 'Editor de Design',
    'description' => 'Você pode ajustar muitos aspectos da aparência do site usando as entradas na tabela abaixo. Os nomes de variáveis são baseados em identificadores no código e, portanto, não podem ser traduzidos. Os valores serão redefinidos quando a página for atualizada.',
    'designPageLink' => 'Página de Design',
    'exportInfo' => 'Você pode exportar suas alterações para um arquivo UserStyle que pode ser usado com uma extensão como <1>Stylus</1> para personalizar a aparência do aplicativo permanentemente. Note, no entanto, que essas variáveis podem mudar a qualquer momento, exigindo que você atualize manualmente seus estilos personalizados.',
    'export' => 'Exportar como UserStyle',
    'variableColumnHeader' => 'Variável CSS',
    'valueColumnHeader' => 'Valor',
  ],
];
