<?php

return [
  'title' => 'إعدادات البوت',
  'description' => 'يمكنك أدناه رؤية إعداداتك الحالية في HammerTime بوت لكل حساب متصل.',
  'fields' => [
    'rawData' => [
      'displayName' => 'البيانات الخام (لأغراض تصحيح الأخطاء)',
    ],
    'timezone' => [
      'displayName' => 'المنطقة الزمنية',
    ],
    'format' => [
      'displayName' => 'تنسيق',
      'option' => [
        'd' => 'تاريخ قصير',
        'f' => 'التاريخ و الوقت',
        't' => 'وقت قصير',
        'D' => 'تاريخ طويل',
        'F' => 'يوم الأسبوع، التاريخ والوقت',
        'R' => 'تناسبي',
        'T' => 'وقت طويل',
        'default' => 'افتراضي',
      ],
    ],
    'columns' => [
      'displayName' => 'أعمدة',
      'option' => [
        'syntax' => 'صيغة فقط',
        'preview' => 'معاينة فقط',
        'both' => 'كل من الصيغة والمعاينة',
        'default' => 'افتراضي',
      ],
    ],
    'ephemeral' => [
      'displayName' => 'سريع الزوال',
    ],
    'header' => [
      'displayName' => 'رأس',
    ],
  ],
  'saveSuccess' => 'تم حفظ إعداداتك بنجاح.',
];
