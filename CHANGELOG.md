# Form 0.0.1 (2020.07.24)
- alap html keret felállítva
- kezdeti css kinézet (cegalapitas.css)
    - form kialakítása
        - input mezők kialakítása
        - fájl kezdeti fázisa

---

# Form 0.0.2 (2020.07.25)
- Jquery 3.5.1 hozzá lett adva
- Dropzone hozzá lett adva
- Javascript funkciók bővültek
    - form további változásai
        - fájl feltöltés része elkészítve
        - dinamikus telephely hozzáadás és elvétel
        - dinamikus tag hozzáadás és elvétel
- Több nyelv támogatás lehetősége hozzáadva (language.php)

---

# Form 0.0.3 (2020.07.26)
- form további változásai
    - digitális aláírás
    - tag szekciók összecsukós
    - egyszemélyes cégeknél az új tag hozzáadása lehetőség eltűnik

---

## Back end (2020.07.27)
- ajax.php ő kezeli az összes kommunikációt a front end és a back end között
- alap keretrendszer felállítva
- email küldés
- adatbázis csatlakozás kezelés
- adatbázis Modellek elkészítése (későbbiekben ezek bőven módosulni fognak)
- handler ő kezeli a kéréseket

## Admin panel 0.0.1 (2020.07.27)
- alap html keret felállítva
- Jquery 3.5.1 hozzá lett adva
- side navbar animációval

---

## Admin panel 0.0.2 (2020.07.28)
- php mvc model felállítva
- dokumentum szerkesztés kezdeti fázis
- bejelentkezési rendszer
- szerkesztett dokumentum mentés kezdeti fázis
- dokumentum konvertálás kezdeti automatizálás

## Back end (2020.07.28)
- adatbázis csatlakozás tesztelve
- tábla írási funkció tesztelve
- Model a formhoz felállítva
- adatok adatbázisba való mentése dinamikusan JSON formátumban

---

# Form 0.0.4 (2020.07.29)
- Jquery Validation hozzáadva
- Javascript funkciók bővültek

## Admin panel 0.0.3 (2020.07.29)
- Beérkező kérelmek listázása
- Amiket éppen vizsgálnak kérelmek azokat a többiek nem látják ha viszont mégse szeretné kezelni az éppen adott kérvényt akkor visszadobja és a többiek újra látják
- Kérvény form felépítve

## Back end (2020.07.29)
- bővült a model
- php mvc admin panelhez biztonsági problémák javítása

---

# Form 0.0.5 (2020.07.30)
- Javascript funkciók bővültek
- Dropzone duplikáció megoldva és most már lehet törölni nem kívánt fájlokat
- A feltöltött fájlok userenként kapnak egy unique id-t abba kerülnek a feltöltött csatolmányok submit után pedig átkerül az admin panelhez és az adatbázisban van tárolva a mappa név
- Jquery validation magyar nyelv hozzáadva emellett sok ezer másik nyelv nézdmeg (form/js/jquery-validation/localization)
- Automatikus mentés hozzáadva ha esetleg véletlen frissíteni az oldalon nem az összes adatot de a nagy részét megőrzi és visszatölti

## Admin panel 0.0.4 (2020.07.30)
- amikor kezelés alá vesznek egy kérelmet akkor az alapadatok listázva összefoglalás képpen
- Fájlkezelő ami megjeleníti a kérelemhez csatolt dokumentumokat képeket és a pdf-eket külön ablakban jeleníti meg a szerkeszthető dokumentumokat majd megnyitja a szerkesztővel
- Jquery redirect hozzáadva

## Back end (2020.07.30)
- fájl feltöltés unique id mappába user-hez kötve adatbázisban
- fájl törlése ha véletlen esetleg a legújabb családi albumot pakolta volna fel
- dokumentum szerkesztés és konvertálás

---

# Form 0.0.6 (2020.07.30)
- validation keret befejezve viszont még nem teljesen jó!!

## Admin panel 0.0.5 (2020.07.31)
- dokumentum szerkesztésnél amikor be akarunk tölteni egy dokumentumot nem konvertál folyamatosan minden egyes megnyitásnál hanem ellenőrzi, hogy megvolt e már a konvertálás ha megvolt megnyitja a már létező konvertált dokumentumot
- a módosított dokumentumokat lehet menteni amiket egy olyan nevű mappába pakolja a script ami tartalmazza a fájl eredeti nevét és a mappát ohonnan ki lett húzva

## Back end (2020.07.31)
- egy kis backend optimalizálás volt foreach helyett sima if else használat a cég betöltésnél (ami azért sokat jelent)
- automata dokumentum kitöltés megvan de még nem volt a rendszerrel tesztelve!!!!

---

# Form 0.0.7 (2020.08.01)
- validation: üres user dir esetén errort kapunk
- ha valaki nem submitel és nem csinál semmit csak elhagyja az oldalt a neki készült mappa törlődik automatikusan egy nap után
- validation: üres aláírás esetén errort kapunk
- form: jó pár új elemet beépítettem
- nem lehet azokat az elemeket pipa nélkül ahol mindenképpen kell egy elemet választani
- nemsokára érkezik a place api

## Admin panel 0.0.6 (2020.08.01)
- automatikusan frissül a kezdőlap, hogyha új kérelem érkezik be akkor az most már megjelenik

## Back end (2020.08.01)
- teljes validation a formhoz készen áll csak a jquery validation kell majd még rendezni

---

# Form 0.0.8 (2020.08.02)
- székhely cím validálás ha nem magyar hibát dob, hogy magyar legyen ha nem talál semmit akkor meg errort dob, hogy nem létezik
- Jquery validation törölve
- Bootstrap 4.5 hozzáadva
- Validation ha üres a form a bootstrap megfogja nem engedi át üresen a többit saját JavaScript validation funkciók veszik át és persze a back end

## Admin panel 0.0.7 (2020.08.02)
- a teljes php mvc model át lett írva nginx web szerverhez

## Back end (2020.08.02)
- permission hibák kijavítva linuxhoz
- optimalizálás
- nagyobb hibák javítása

---

# Form 0.0.9 (2020.08.03)
- kinézet update most már valmivel jobb talán de nem sokkal legalább a grid system valamennyire rendben
- a címek beírása egyszerűsítve lett egy keveset ami azért is jó mert annyival kevesebb mezőt kell kezelni
- telephely fióktelep mindegyik külön kap fájl feltöltést dinamikusan
- tagoknál a fájl feltöltés három részre szedve
- a feltöltött fájlokat feltöltés hely szerint nevezi el pl: Név.azonosítóOkmány.okmany.valami
- front end újdonságok :3

---

# Form 0.1.0 (2020.08.04)
- Igazoló doksit lelehet tölteni ha nem töltöttük ki a fölötte lévő adatokat akkor megkérdez, hogy biztosan letöltöm e az adatok kitöltése nélkül
- Automatikusan kitölti a címet és a cég nevet az Igazoló doksiba
- Szép telefonszám választós hozzáadva ami inputra ellenőriz realtime (A többi input is tervezem a realtime dolgot :D)
- Az kitöltött igazoló doksikat automatikusan törli ha öregebbek egy óránál

---

# Form 0.1.1 (2020.08.05)
- Igazoló doksihoz most már ki kell tölteni az adatokat fölötte
- Igazoló doksik most már elérhetőek a többi székhely típusnál
- Saját javascript validation funkciók
- Custom validation funkció ami minden egyes elemet lefuttat tesztre ha nem jó szépen kijelzi, hogy nem jó
- Szám formázás pénz inputoknál
- Custom validation system kisebb hibák javítva

---

# Form 0.1.2 (2020.08.06)
- Szám formázás kijavítva most már normálisan duplikálható
- Custom validation funkciók kijavítva
- Tevékenységi körök megvannak :3
- Elektronikus aláírás dinamikus duplikálás már lehetséges
- lényegés front end változtatások lassan kész a form kft alapításhoz :3

# Admin panel 0.0.8 (2020.08.06)
- Bootstrap átvette a front end uralmat

---

# Form 0.1.3 (2020.08.07)
- Ügyvezető nyilatkozat letöltés
- Ügyvezető nyilatkozat automatikus kitöltés
- Ügyvezető nyilatkozathoz ki kell választani egy személyt aki ügyvezető és ha annál a személynél minden adat helyes akkor megy a letöltés
- Aláírásnál működik a mentés gomb viszont nem a fájlokba menti akkor még hanem csak egy rejtett input mezőbe
- csatolmány nevek bő leírása egyszóval tudni lehet mi micsoda :3
- keretdokumentum részleges kitöltés egyszemélyes kft-hez
- upload backend és a remove backend továbbfejlesztve az upload backend most már tud duplikációkat kezelni sajnos még törölni a nem kívánt duplikációt a felhasználó még nem tudja
- a Handler egy ici picit át lett alakítva most már dinamikusan tud fogadni aláírásokat és nevekhez tudja kötni
- a Handler most már megtudja különböztetni milyen cégformátum alapján kellene dokumentumot kitölteni (KEEP IN MIND: a többszemélyes doksi még nincs felállítva kitöltésre!)

---

# Form 0.1.4 (2020.08.09)
- email küldés tesztelve és működik normálisan ahogyan kell

# Admin panel 0.0.9 (2020.08.09)
- csatolmányok elrejtése gomb hozzáadva
- iroda regisztráció most már lehetséges
- itt vannak a permission cuccok amiket így elsőre találtam ki, hogy legyen példa (permission: 1 béna, 2 nem annyira, 3 iroda, 4 über mindent lát) de egyenlőre nincs külön hatása a permissionnek annyi, hogy csak a permission 3 tud invitálni meg kezelni azokat akik konkrétan hozzá tartoznak
- iroda panel csak azoknak akik permission 3 vagy a feletti joggal rendelkeznek
- meghívást lehet küldeni új tagok bevételéhez irodákhoz
- meghívás után jelszót kell neki megadni aztán be kell jelentkeznie és utána már mehet is a buli
- iroda regisztráció elkészült amikor regisztrál akkor kap egy emailt egy jelszóval és már egyből is be tud lépni és meg hívogatni embereket
- jelszó változtatás most már lehetséges az admin panelen belül a profil fülnél azon kívül az iroda tudja megváltoztatni tehát ha elfelejti a jelszavát akkor tud az irodának hisztizni, hogy kapjon egy új jelszavacskát amit az iroda panelben tud majd állítani
- nagyon minimális turbózást kapott a front end admin panelen

---

# Form 0.1.5 (2020.08.010)
- egy kettő finomítás funkciókon és bug javítás

# Admin panel 0.1.0 (2020.08.10)
- Iroda fülben ha te vagy az aki regizte az irodát akkor most már látod és lassan kezelni is tudod az irodához tartozó fiókokat
- Meghívósdi rendszer nem küld újra jelszavas linket ha már a fiók létezik
- Most már az iroda fülben működik az összes kezelési gombocska (jelszó változtatás, jog változtatás, irodából való törlés)
- Hiba kezelés implementálás optimalizálás

---

# Form 0.1.6 (2020.08.11)
- Modulokra szét lettek szedve a fontosabb javascript funkciók
- Újra lett írva most már teljesen dinamikus a validációs rendszer
- bugok javítása
- nevek és placeholderek átírása
- most már amikor betölt a form nem jelöl ki minden mezőt pirossal ami kötelező
- Validáció egyszerűsítve lett
- Jquery ui hozzáadva
- Jquery ui datepicker felváltotta a date inputot
- most már nem lehet azokon a helyeken ahol nem kéne előre vagy vissza menni az időben
- jquery datetimepicker hozzáadva
- időpont választásnál most már lehet órát választani
- form backend validáció a userdirhez át lett írva most már felismeri ha nem adtunk le egy vagy több fajta dokumentumot
- a tevékenységeknél most már lehet választani többet is egyszerre és el is lehet távolítani amit nem szeretnénk
- a kötelező mezőkhöz hozzá lett adva a *

# Admin panel 0.1.1 (2020.08.11)
- Kisebb hibák kijavítva még van egy kettő ami van de azok is meg lesznek javítva

--

# Form 0.1.7 (2020.08.13)
- szövegmódosítások
- hibajavítások
- front end kiegészítés
- most már ha nincs bejelölve egy központi ügyintézési hely akkor üvölt a validáció, hogy na tessék egyet bejelölni
- cégnév ellenőrzés de csak saját adatbázisban ellenőriz viszont még maga az automatikus input ürítés nem működik
- az upload.php kiszedi az összes feltöltött fájlból a space-t (Linux végett)

# Admin panel 0.1.2 (2020.08.13)
- szövegmódosítások
- hibajavítások
- szövegszerkesztő optimalizálás admin panelen mostmár nem akad össze a html emellett a toolbar gomb funkciók megjavítva

--

# Form 0.1.8 (2020.08.14)
- Google autofill kiszedve végre :3
- most már tényleg csak a submit-nél állít meg ha kötelező mezőt hagytál ki!

# Admin panel 0.1.3 (2020.08.14)
- működő képernyő felvétel készítő funkció hozzáadva a felvétel indítása gombra nyomva ki lehet választani melyik képernyőt vagy alkalmazást vagy böngésző ablakot akarjuk megosztani és, hogy szeretnénk e hangot is megosztani ezután a rögzítés elindul amint rányomnak a rögzítés megállítására a rögzítés megáll és a felvétel amit a rögzítő felvett letölthető a Felvétel letöltése gomb segítségével
- telefonszám update most már működik iroda típusú fiókoknál
- postázási cím update mot már működik iroda típusú fiókoknál
- csatolmányok módosítás egy darab csatolmány egy sort foglal és a neve hosszabban van kiírva
- a csatolmányokat most már le lehet tölteni zip állományként

--

# Admin panel 0.1.3 (2020.08.15)
- most már el lehet fogadni és utasítani a kérvényeket
- az elutasított kérvények vagy az elfogadott kérvények nem jelennek meg az ügyvéd típusú fiókoknál

--

# Form 0.1.9 (2020.08.17)
- hibajavítások
- Telephelyek és fióktelepek most már tagolva vannak
- Alap telefonszám országnak Magyarország van beállítva
- Ha submitel a validáció ellenőrzi, hogy az összeg ami összesen be van írva az egyenlő e vagy nagyobb 3 milliónál ha nem akkor üvölt, hogy nem jó
- Mostantól realtime validation van arra, hogy ezerrel osztható számot írt e be

# Admin panel 0.1.4 (2020.08.17)
- dokumentum szerkesztő kinézet módosítás és méretezés
- betöltési módszer optimalizálás
- hibajavítások
- a kérelem elfogadásnál/elutasításnál a kérvényező az értesítési email címre kap emailt ha elfogadták akkor a csatolmányokat megkapja és a megjegyzést is

--

# Form 0.2.0 (2020.08.18)
- front end kiegészítés

# Admin panel 0.1.5 (2020.08.18)
- hibajavítás
- optimalizálás
- a szerkesztett doksik helyet cserélnek az eredeti doksik-kal ha a kérvényt elfogadják
- felvétel rögzítő hang hiba kijavítva

--

# Form 0.2.0 (2020.08.19)
- front end kiegészítés
- ügyvezetőt most már hozzá lehet adni úgy is, hogy nem tag az illető (Jogi személy/Magánszemély)
- ügyvezető nyilatkozat kitöltés átkerült a tag szekcióba
- backend adatfeldolgozás átalakítása

--

# Form 0.2.1 (2020.08.20)
- hibajavítás
- front end kiegészítés
- front end módosítás
- dátumválasztó lecserélve végre működik és szép :3
- most már percre pontosan meg lehet mondani mikor lesz neki jó az ellenjegyzés
- cégvezetőt hozzá lehet adni dinamikusan ha sor kerülhet cégvezető kinevezésére aki csak magánszemély lehet
- back end módosítás adatfeldolgozáshoz még úton van :3

--

# Form 0.2.2 (2020.08.24)
- hibajavítás
- front end módosítás
- új adatfeldolgozás tisztább lett sokkal az adatszerkezet ami bekerül az adatbázisba
- adatszerkezet model külön szétszedve cégformátumokra
- az új adatszerkezetek dinamikusak ami annyit jelent, hogy egy adatszerkezet egyszemélyes és többszemélyes formátumra is felhasználható egy cégformán belül

--

# Form 0.2.3 (2020.08.26)
- hibajavítás

# Admin panel 0.1.6 (2020.08.26)
- új adatfeldolgozáshoz refaktorálva lett az összes lekérdezési modell
- hibajavítás
- a videóhívásnál most már kiírja azokat az időpontokat azokhoz a cégekhez amiket a felhasználó éppen kezel
- a fölösleges zip állományokat egy óra elteltével törli

# Form 0.2.4 (2020.09.01)
- hibajavítások
- dokumentum generálás a kitöltés helyett így sokkal több formázási lehetőség van ami kell főleg aláhúzásnál