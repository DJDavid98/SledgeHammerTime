<?php

return [
  'translations' => [
    'title' => 'Fordított Tartalom',
    'text' => 'Ez a projekt önkéntes fordítók és a közösség más tagjai által készített fordításokat tartalmaz. Ezek a fordítások a felhasználók kényelmét szolgálják, és nem mindig teljesen naprakészek. Minden esetben az oldal <1>eredeti nyelvi változata</1> tekintendő hatályosnak.',
  ],
  'lastUpdated' => 'Utóljára frissítve: <1/>',
  'privacy' => [
    'heading' => 'Adatvédelmi irányelvek',
    'operator' => '<0/> (továbbiakban "mi", "miénk" vagy "Fejlesztő") üzemelteti a HammerTime weboldalt (továbbiakban "Webhely") és a HammerTimeBotot (továbbiakban "Bot" vagy "Alkalmazás"), együttesen a HammerTime Projektet (továbbiakban "Projekt"). Ez az oldal tájékoztatja Önt a Projekt felhasználóitól ("Ön", "Felhasználó", vagy együttesen "Felhasználók") kapott Személyes Adatok gyűjtésére, felhasználására és közzétételére vonatkozó irányelveinkről.',
    'notAffiliated' => 'Bár a "HammerTime" név ("Projektnév") a Discord, Inc. ("Discord")<1/> korábbi "Hammer & Chisel" nevéből származik, a Projekt semmilyen módon vagy formában nem kötődik a Discordhoz, sem M.C. Hammerhez, akinek a dalában<3/> ez a kifejezés kiemelkedően szerepel. A Fejlesztő nem rendelkezik a Projektnévre vonatkozó védjeggyel vagy szerzői joggal.',
    'infoCollection' => [
      'heading' => 'Információgyűjtés és -felhasználás',
      'pii' => 'A Projekt használata során nem kérjük és nem is ösztönözzük Önt arra, hogy olyan személyazonosításra alkalmas információkat ("PII", "Személyes adatok") adjon meg nekünk, amelyek alapján Önt, mint személyt, azonosítani lehetne. A személyes adatok közé tartozhatnak többek között: az Ön neve, születési dátuma, személyazonosító okmány száma, tartózkodási helye, telefonszáma.',
      'auth' => 'A bejelentkezés a Discord OAuth 2 API ("API") segítségével történik, amely szintén HTTPS használatával biztosított. Az OAuth-hitelesítési folyamat során a Webhely nem kapja meg a felhasználónevet vagy jelszót, csak egy tokent, amely az API segítségével a felhasználó személyazonosságának ellenőrzésére használható. Gyorsasági okokból az API által biztosított alapvető információkat (felhasználói azonosító, aktuális felhasználónév, megjelenített név, avatár link) helyben tároljuk.',
      'removal' => 'Ezek az információk nem kerülnek automatikusan eltávolításra az adatbázisunkból amikor Ön deaktiválja a Discord fiókját, ezért mindenképpen vegye fel velünk a kapcsolatot, ha szeretné, hogy az adataidat eltávolítsuk.',
    ],
    'logData' => [
      'heading' => 'Naplóadatok',
      'browserInfo' => 'Gyűjtjük azokat az információkat, amelyeket az Ön böngészője küld, amikor meglátogatja a Webhelyünket ("Naplóadatok"). Ezek a Naplóadatok olyan információkat tartalmazhatnak, mint a számítógép IP-címe, operációs rendszere, böngésző típusa, böngésző verziója, a Webhelyünk meglátogatott oldalai, a látogatás időpontja és dátuma.',
      'thirdParty' => 'Ezeket a naplóadatokat csak a szerverünkön tároljuk, és nem osztjuk meg harmadik féllel. A naplóadatokat diagnosztikai célokra használjuk, és kifejezett kérés esetén megosztjuk a hatósági szervekkel. Az adatokat legfeljebb 14 napig tároljuk, mielőtt megsemmisítjük.',
      'debugging' => 'A Bot a Discord kliensen keresztül interakciókat fogadhat a Felhasználóktól, amelyek magukban foglalják a slash parancsokat és a környezeti menü parancsaokat (továbbiakban "Művelet", "Parancs", vagy együttesen "Parancsok"). A slash parancsok ezen felül a Felhasználó által megadott strukturált kulcs-érték párokkal (továbbiakban "Paraméterek") is végrehajthatók. A Bot hibakeresési célokra rögzíti a Parancsok végrehajtását, nevezetesen: a Parancsot végrehajtó Felhasználó Discord felhasználónevét és Snowflake azonosítóját (továbbiakban "ID"), a Parancs nevét (beleértve az összes Paramétert) és annak a szervernek az ID-ját, amelyen a Parancsot végrehajtották. Ezeket az adatokat a Projekt szerverén legfeljebb 30 napig tároljuk, és csak a Fejlesztő számára hozzáférhetőek.',
      'noPii' => 'A parancsok végrehajtásakor kerülje a személyes adatok megadását. Egyes információk továbbra is megmaradhatnak az Alkalmazás naplójában, ezért kérjük, ha beavatkozásunkra van szükség, értesítsen minket a jelen dokumentum végén leírt módszerek egyikén.',
    ],
    'telemetry' => [
      'heading' => 'Telemetria és statisztikák',
      'statsCollection' => 'A bot használatának felmérése és ezáltal a fejlesztési döntések (pl. a funkciók hozzáadása/eltávolítása) segítése érdekében a parancsokról és azok használatáról meghatározott adatok kerülhetnek gyűjtésre ("Telemetria"). A Telemetriai információk arra korlátozódnak, hogy melyik parancsot és opciót használták, illetve mikor használták, bármiféle azonosító információ nélkül (ezért soha nem tartalmaznak szerver- vagy felhasználói ID-t, sem a felhasználó által megadott értékeket, és teljesen anonimak). A telemetriát korlátlan ideig tároljuk, és a belőle származó statisztikákat összesített formában kívánjuk megjeleníteni és nyilvánosan megosztani.',
      'telemetryOptOut' => 'A Projekt használatával a Felhasználók alapértelmezetten beleegyeznek a Telemetria gyűjtésébe. Ha a Felhasználó nem kíván hozzájárnulni a Telemetria gyűjtéséhez, akkor a <1/> oldalon található megfelelő opcióval jelezheti ezt.',
    ],
    'cookies' => [
      'heading' => 'Sütik',
      'intro' => 'A sütik kis mennyiségű adatot tartalmazó fájlok. A sütiket egy weboldal küldi el az Ön böngészőjének, és a számítógépe merevlemezén vanna tárolva.',
      'disable' => 'A "sütiket" információ megőrzésére használjuk. Ön utasíthatja böngészőjét, hogy utasítsa el az összes sütit, vagy jelezze, ha mi sütit küldünk. Viszont, ha nem fogadja el a sütiket, előfordulhat, hogy nem tudja használni Webhely egyes részeit.',
      'session' => 'Bejelentkezett felhasználók számára egy maradandó süti segítségével 30 napig megjegyzésre kerül a bejelentkezett státusz a böngésző munkamenetek között. Ha nem szeretne bejeletkezve maradni, akkor kijelentkezhet, vagy törölheti a Webhelyünk által beállított sütiket.',
    ],
    'security' => [
      'heading' => 'Biztonság',
      'noGuarantee' => 'Személyes adatainak biztonsága fontos számunkra, de ne feledje, hogy egyetlen, az interneten keresztül történő továbbítási vagy elektronikus tárolási módszer sem 100%-ig biztonságos. Bár törekszünk arra, hogy kereskedelmi szempontból elfogadható eszközöket alkalmazzunk az Ön Személyes adatainak védelme érdekében, nem tudjuk garantálni azok abszolút biztonságát.',
      'httpsCloudFlare' => 'A Webhely HTTPS-t használ, amely modern TLS titkosítással védi a böngésző és a Webhely közötti adatátvitel integritását és biztonságos szállítását. Ugyanakkor a CloudFlare fordított proxy szolgáltatását használjuk, ami azt jelenti, hogy a Webhelyünkre küldött adatok egy része az ő szervereiken halad át. A CloudFlare saját <1>adatvédelmi irányelvek</1> alapján működik.',
      'breachNotify' => 'Biztonsági incidens esetén minden felhasználó a felfedezéstől számított 24 órán belül értesítést kap a weboldalon közzétett értesítésben, a Bot által közzétett válaszokban és a Bot Discord támogatási szerverén közzétett bejelentésen keresztül.',
    ],
  ],
  'terms' => [
    'heading' => 'Általános Szerződési Feltételek',
    'license' => 'A Projekt teljes forráskódja a GitHubon található, ahogy van, mindenféle garancia vagy felelősség nélkül. A teljes licencfeltételekér lásd az <1>MIT licencet</1>, amelynek egy példánya megtalálható az egyes repository-kban. Az alábbiakban ismertetett feltételek a Projektnek a Fejlesztő által üzemeltetett változatára ("Példány") vonatkoznak, és az abban foglalt korlátozások nem tekinthetők a Projekt forráskódjának felhasználására vonatkozó korlátozásoknak.',
    'noAbuse' => 'Nem állíthat be automatizálásokat a Parancsok ismételt futtatására a Példányon keresztül. Ez a Bot nem arra szolgál, hogy automatizált eszközök, például más botok vagy más, a valós felhasználói tevékenység utánzására szolgáló szoftverek használják. Ahelyett, hogy automatizálási célokból a Botunk kimenetére hagyatkozna, kérjük, hivatkozzon a botja által használt programozási nyelv dokumentációjára a UNIX időbélyegek generálását és manipulálását illetően.',
    'fuckWeb3' => 'Ez a Példány nem használható a generatív mesterséges intelligencia (AI) modellek képzési folyamatának támogatására, sem pedig a nem-fungible tokenekkel ("NFT-k") vagy a kriptovaluták bármely formájával (pl. Ethereum, Bitcoin) kapcsolatos események és/vagy tranzakciók elősegítésére.',
    'accessRevocation' => 'Az Ön hozzáférése a Példányhoz a Fejlesztő belátása szerint bármilyen okból (vagy akár ok nélküli is) visszavonható. A lehetésges okok közé tartozhat többek között: a jelen feltételek megsértése, a Példány funkcióival való szándékos visszaélés, a Fejlesztő vagy a Projekt bármely közreműködője elleni erőszakos fenyegetés, a Példány rosszindulatú célokra való használata.',
  ],
  'changes' => [
    'heading' => 'Változások és újabb verziók',
    'effectiveFrom' => 'Az Általános Szerződési Feltételek és az Adatvédelmi irányelvek, együttesen "Dokumentumok", az utolsó frissítésük időpontjától érvényesek, és továbbra is hatályban maradnak, kivéve a rendelkezések jövőbeni módosításait, amelyek az ezen az oldalon történő közzétételt követően azonnal hatályba lépnek.',
    'rightToChange' => 'Fenntartjuk a jogot, hogy ezeket a Dokumentumokat bármikor frissítsük vagy módosítsuk, ezért rendszeresen ellenőrizze ezt az oldalt. A Projekt további használata azt követően, hogy a Dokumentumok bármely módosítását közzétesszük ezen az oldalon, a módosítások tudomásul vételének, valamint a módosított Dokumentumok betartásához való hozzájárulásának minősül.',
    'willNotify' => 'Ha lényeges változtatásokat eszközlünk a jelen Dokumentumokban, erről a weboldalunkon elhelyezett, jól látható közleményben, valamint a Bot Discord támogatási szerverén közzétett közleményben értesítjük Önt.',
  ],
  'contact' => [
    'heading' => 'Kapcsolatfelvétel',
    'whereToContact' => 'Ha bármilyen kérdése van ezekkel a Dokumentumokkal kapcsolatban, vagy kérni szeretné az általunk tárolt PII eltávolítását, kérjük, lépjen kapcsolatba velünk <1>a Bot Discord szerverén</1> keresztül vagy a <3>Fejlesztő weboldalán</3> felsorolt módszerek bármelyikén.',
  ],
];
