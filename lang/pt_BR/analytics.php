<?php

return [
  'heading' => 'Visualizar Estatísticas',
  'description' => 'Essa página contém estatísticas (armazenadas e exibidas sem quaisquer dados pessoais identificáveis), que contabilizam o número de visualizações da página no aplicativo durante os últimos :days dias.',
  'collectionMethod' => 'Os dados são coletados no servidor, baseando-se em respostas enviadas para uma quantia limitada de páginas. O número de visualizações é gravado individualmente, mas reunido diariamente por processos em segundo plano.',
  'lastUpdated' => 'As informações nessa página são armazenadas em memória transitória por um curto período para reduzir a carga do servidor. Os dados visualizados foram atualizados pela última vez<1/>.',
  'charts' => [
    'dailyTotal' => 'Visualizações Diárias Totais',
    'breakdown' => 'Detalhes de Visualizações da Página',
    'byPage' => 'Por páginas',
    'byLanguage' => 'Por idioma',
  ],
  'values' => [
    'unknown' => 'Desconhecido',
  ],
];
