<?php

return [
  'translations' => [
    'title' => 'Translated Content',
    'text' => 'This project contains translations by volunteer translators and other members of the community. These translations are provided for users\' convenience, and may not always be fully up-to-date. In all matters, the <1>original language version</1> of this page is considered effective.',
  ],
  'lastUpdated' => 'Last updated: <1/>',
  'privacy' => [
    'heading' => 'Privacy Policy',
    'operator' => '<0/> ("us", "we", "our", or "Developer") operates the HammerTime website (the "Site"), and HammerTimeBot (the "Bot", or "App"), collectively the HammerTime Project (the "Project"). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Project ("you", "User", or collectively "Users").',
    'notAffiliated' => 'Although the "HammerTime" name ("Project Name") is derived from the former name "Hammer & Chisel" of Discord, Inc. ("Discord")<1/> the Project is not affiliated in any way, shape, or form, with Discord, nor M.C. Hammer, whose song<3/> features this phrase prominently. The Developer holds no trademark or copyright over the Project Name.',
    'infoCollection' => [
      'heading' => 'Information Collection And Use',
      'pii' => 'While using the Project we do not ask nor encourage you to provide us with any Personally Identifiable Information ("PII", "Personal Information") that can be used to identify you as an individual. PII may include, but is not limited to: your name, birth date, national identification numbers, location, phone number.',
      'auth' => 'Sign in is provided using Discord\'s OAuth 2 API ("API") which is also secured using HTTPS. During the OAuth authentication process our Site does not receive the username or password, only a token that can be used to verify the user\'s identity using this API. For performance reasons we store the basic information provided by the API (user ID, current username, display name, avatar link) locally.',
      'removal' => 'This information is not removed from our database automatically if you deactivate your Discord account, so be sure to reach out to us if you would like your data removed.',
    ],
    'logData' => [
      'heading' => 'Log Data',
      'browserInfo' => 'We collect information that your browser sends whenever you visit our Site ("Log Data"). This Log Data may include information such as your computer\'s IP address, operating system, browser type, browser version, the pages of our Site that you visit, the time and date of your visit.',
      'thirdParty' => 'This Log Data is stored only within our server and is not shared with any third party. Log Data is used for diagnostic purposes, and shared with law enforcement agencies if explicitly requested. It is kept for up to 14 days and discarded afterwards.',
      'debugging' => 'The Bot can receive interactions from Users via the Discord client, which includes slash commands and context menu commands ("Action", "Command", or collectively "Commands"). Slash commands can additionally be executed with User-supplied structured key-value pairs ("Options"). The Bot records Command executions for debugging purposes, namely: the Discord username and Snowflake identifier ("ID") of the User that executed the Command, the name of the Command (including all Options) and the ID of the Server the Command was executed in. This data is stored on the Project server for up to 30 days, and is only accessible by the Developer.',
      'noPii' => 'When executing Commands you should avoid including any Personal Information. Some information may still be retained in our Application Log, so please contact us using the methods described at the end of this document to notify us if our intervention is needed.',
    ],
    'telemetry' => [
      'heading' => 'Telemetry & Statistics',
      'statsCollection' => 'In order to assess the Bot\'s usage and thereby drive development decisions (e.g. the addition/removal of features) a specific set of data about Commands and their usage may be collected ("Telemetry"). Telemetry information is limited to which command and options were used, and when they were used, without any identifying information (therefore it never includes server or user IDs, nor any user-supplied values, and is fully anonymous). Telemetry is stored indefinitely and statistics derived from it are intended to be displayed and shared publicly in aggregate form.',
      'telemetryOptOut' => 'By using the Project, Users agree to the collection of Telemetry by default. If a User wishes to opt out of Telemetry collection, they may indicate their preference via the appropriate option on the <1/> page.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies are files with small amount of data. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.',
      'disable' => 'We use "cookies" to retain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Site.',
      'session' => 'For logged in users a persistent cookie is used to remember the logged in status across browser sessions for 30 days. If you want to stop being remembered you can either sign out or clear the cookies set by our Site.',
    ],
    'security' => [
      'heading' => 'Security',
      'noGuarantee' => 'The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.',
      'httpsCloudFlare' => 'The Site makes use of HTTPS using modern TLS encryption suites to protect the integrity and secure transport of data between the browser and our Site. However, we make use of CloudFlare\'s Reverse Proxy service, meaning some portion of the data sent to our Site passes through their servers. CloudFlare operates under their own <1>privacy policy</1>.',
      'breachNotify' => 'In the event of a security breach all users will be notified within 24 hours of discovery through a notice posted on this website, in replies posted by the Bot and via an announcement in the Bot\'s Discord support server.',
    ],
  ],
  'terms' => [
    'heading' => 'Terms & Conditions',
    'license' => 'All of the Project\'s source code is provided on GitHub as-is, without any warranty or liability. For the full license terms, please see the <1>MIT license</1>, a copy of which can be found in each repository. The terms outlined below apply to the version of the Project hosted by the Developer ("Instance") and the limitations imposed within are not to be treated as  restrictions on the usage of the Project source code.',
    'noAbuse' => 'You must not set up automations to run Commands via the Instance repeatedly. This Bot is not meant to be used by automated tools, such as other bots, or any other software designed to mimic legitimate user activity. Instead of relying on our Bot\'s output for automation purposes, please refer to the documentation of the programming language used by your bot on how to generate and manipulate UNIX timestamps.',
    'fuckWeb3' => 'This Instance shall not be used to aid in the process of training generative AI models, nor to help facilitate any events and/or transactions related to non-fungible tokens ("NFTs") or any form of cryptocurrency (e.g. Ethereum, Bitcoin).',
    'accessRevocation' => 'Your access to the Instance may be revoked for any reason (including no reason) at the Developer\'s discretion. Reasons can include, but are not limited to: violation of these terms, intentional abuse of the Instance\'s features, threats of violence towards the Developer or any of the Project\'s contributors, use of the Instance for malicious purposes.',
  ],
  'changes' => [
    'heading' => 'Changes & Revisions',
    'effectiveFrom' => 'The Terms & Conditions and Privacy Policy, collectively "Documents", are effective as of their last update date and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.',
    'rightToChange' => 'We reserve the right to update or change these Documents at any time and you should check this page periodically. Your continued use of the Project after we post any modifications to the Documents on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Documents.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Contact Us',
    'whereToContact' => 'If you have any questions about these Documents or want to ask for the removal of any PII we store please contact us via <1>the Bot\'s Discord server</1> or using any of the methods listed on the <3>Developer\'s website</3>.',
  ],
];
