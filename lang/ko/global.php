<?php

return [
  'seoDescription' => 'Discord용 타임스탬프를 생성할 수 있습니다.',
  'changeLanguage' => '언어 변경',
  "notFound" => [
    "heading" => "페이지를 찾을 수 없습니다",
    "content" => "표시할 콘텐츠가 없습니다",
    "suggestions" => [
      "heading" => "찾으시는게 있으신가요?",
      "description" => "도움이 될 만한 몇 가지 페이지입니다:",
      "picker" => "Timestamp 선택기",
      "botInfoDescription" => "Discord 봇 및 사용 가능한 명령어에 대한 정보",
      "discordCta" => "무언가 빠진 것이 있다고 생각되시나요? 디스코드 서버에 가입하여 알려주세요.",
      "discordButton" => "디스코드 서버 참여하기",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "관리 모드",
    "content" => [
      'pleaseWait' => "현재 업데이트가 진행 중 입니다. 몇 초 후에 다시 시도해 주세요.",
      'joinSupportServer' => "문제가 수 분 동안 계속 된다면, Discord 지원 서버에 참가 후에 문의 해 주세요.",
      'contactDeveloper' => "문제가 수 분 동안 계속 된다면, 개발자에게 연락하여 문제를 알려주세요.",
    ],
    'autoReload' => '페이지가 자동으로 다시 새로고침됩니다. <1/>',
    'reloadButton' => '수동으로 새로고침',
    "supportServerButton" => "지원 서버",
  ],
  'incompleteTranslations' => '번역 미완료',
  'contributeTranslations' => '기여하기',
  'timezoneBadge' => [
    'currently' => '현재 기준',
    'atPickedDate' => '지정된 시점 기준',
    'currentlyAndAtPickedDate' => '현재 및 지정된 시점 기준',
  ],
  'copyToClipboard' => '클립보드에 복사',
  'copiedToClipboard' => '클립보드에 복사했습니다!',
  'jsDisabled' => [
    'title' => 'JavaScript가 필요합니다',
    'body' => "현재 사용하고 계시는 브라우저가 JavaScript를 지원하지 않거나, JavaScript를 끄고 있습니다. 일부 브라우저는 보안상의 이유로 기본값으로 JavaScript를 끄지만, 이 앱은 JavaScript를 사용합니다. JavaScript를 키고 페이지를 새로고침하거나, 다른 브라우저를 사용해 주세요.",
  ],
  'nav' => [
    'botSettings' => '앱 설정',
    'profile' => '프로필',
    'legal' => '법률 정보',
    'analytics' => '분석',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '입력 설정',
      'naturalLanguageInput' => [
        'label' => '@시간 입력 필드',
        'description' => '선택한 타임스탬프를 자유 텍스트 입력을 통해 자연어(예: "5시간 후")로 수정할 수 있습니다. Discord의 @time 태그와 비슷합니다. 이 기능은 몇몇 언어에서만 지원합니다.',
      ],
      'customDateInput' => [
        'label' => '사용자 날짜 입력',
        'description' => "브라우저의 기본 날짜를 사용자 지정 날짜로 변경합니다.",
      ],
      'customTimeInput' => [
        'label' => '사용자 시간 입력',
        'description' => "브라우저의 기본 시간 입력을 사용자 지정 시간으로 변경합니다. 모바일 브라우저에서 시간 선택에 문제가 있는 경우에 유용합니다.",
      ],
      'separateInputs' => [
        'label' => '별개 입력',
        'description' => "한 입력창 대신, 날짜와 시간으로 나뉜 두 입력창을 표시합니다 (일부 브라우저에서 지원하지 않음)",
      ],
      'flatUi' => [
        'label' => '인터페이스 평면화',
        'description' => "입력 창과 버튼의 그림자와 높이 효과 비활성화",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Timezone group headers',
        'description' => 'Show sticky group headers (e.g. America, Europe) in the timezone selector dropdown.',
      ],
      'hourCycle' => [
        'label' => '시간 형식',
        'description' => '사용자 지정 시간 입력 및 미리 보기 등을 포함하여 앱 전체에서 시간이 표시되는 방식을 변경합니다.',
        'options' => [
          'default' => '기본 언어',
          'h12' => '12시간',
          'h24' => '24시간',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => '일주일의 첫날',
        'description' => '사용자 시간 입력 창의 일주일의 첫 번째 날이 무슨 요일인지 변경합니다.',
        'options' => [
          'default' => '기본 언어',
        ],
      ],
      'advancedSettings' => '고급 입력 설정',
    ],
    'timeSync' => [
      'title' => '시간 동기화',
      'status' => [
        'syncing' => '당신의 시스템 시간이 우리의 서버와 동기화 중 입니다. 
잠시만 기다려 주십시오.',
        'accurate' => '당신의 시스템 시각은 정확합니다.',
        'potentiallyWrong' => '시스템 시간이 틀릴 수 있습니다.',
        'value' => '현재 지역 시간과 서버 시간 사이의 차이는 :offset입니다.',
      ],
      'details' => '세부',
      'syncButtonLabel' => '동기화',
      'roundTripDuration' => '왕복 시간',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'timestampValue' => ':value 초',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => '감지된 차감 (네트워크)',
    ],
    'localSettings' => [
      'title' => '로컬 설정',
    ],
    'credits' => [
      'title' => '개발진',
      'developedBy' => '개발: <1></1>',
      'using' => '사용 중: <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => '번역: <1></1>',
      'openSourceSoftware' => '오픈 소스 소프트웨어',
      'viewSourceCode' => '소스 코드 보기',
      'notAffiliated' => '이 프로젝트는 Discord와 관련이 없습니다.',
    ],
    'themeButton' => [
      'dark' => '다크 모드',
      'light' => '라이트 모드',
      'system' => '시스템 설정 사용',
    ],
  ],
  'designEditor' => [
    'title' => '디자인 변경',
    'description' => '이 웹사이트의 디자인을 아래의 테이블을 사용하여 변경 할 수 있습니다. 변수의 이름들은 코드의 식별자이기에 번역되지 않습니다. 변경된 값은 새로 고침 시에 초기화 됩니다.',
    'designPageLink' => '디자인 페이지',
    'exportInfo' => '변경 된 값을 UserStyle 파일로 저장 할 수 있으며 <1>Stylus</1> 같은 확장 프로그램을 사용하면 디자인을 영구 변경 할 수 있습니다.
하지만 만약에 이 변수들이 언젠가 바뀐다면 사용자가 직접 변경해야 할 수 있습니다.',
    'export' => 'UserStyle 파일 저장',
    'variableColumnHeader' => 'CSS 변수',
    'valueColumnHeader' => '값',
  ],
];
