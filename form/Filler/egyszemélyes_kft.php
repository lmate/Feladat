<?php
require_once "PhpWord/autoload.php";
require_once "config.php";

$sites = "";
// Getting all site
if ($this->data["sites"] != 0)
{
    foreach ($this->data["sites"] as $site)
    {
        $zip = $site["zip"];
        $city = $site["city"];
        $address = $site["address"];
        $address2 = $site["address2"];

        $sites .= $zip . " " . $city . " " . $address . " " . $address2 . ", ";
    }
}

$branches = "";
// Getting all branch
if ($this->data["branches"] != 0)
{
    foreach ($this->data["branches"] as $branch)
    {
        $zip = $branch["zip"];
        $city = $branch["city"];
        $address = $branch["address"];
        $address2 = $branch["address2"];

        $branches .= $zip . " " . $city . " " . $address . " " . $address2  . ", ";
    }
}

$company_seat = $this->data["basic"]["zip"] . " " . $this->data["basic"]["city"] . " " . $this->data["basic"]["address"] . " " . $this->data["basic"]["address2"];

$main_seat = "";
if ($this->company["company_main_place"] != "seat")
{
    $main = $this->company["company_main_place"];
    $mainType = explode("_", $main);
    $mainType = $mainType[0] . "s";

    $main_seat = $this->data[$mainType][$main]["zip"] . " " . $this->data[$mainType][$main]["city"] . " " . $this->data[$mainType][$main]["address"] . " " . $this->data[$mainType][$main]["address2"];
}

$fulladdress1 = $this->data["members"]["member_1"]["country"] . " " . $this->data["members"]["member_1"]["zip"] . " " . $this->data["members"]["member_1"]["city"] . " " . $this->data["members"]["member_1"]["address"] . " " . $this->data["members"]["member_1"]["address2"];

$company_number = "";
$company_seat2 = "";
$fulladdress2 = "";
if (isset($this->data["members"]["member_1"]["company_number"]))
{
    $company_number = $this->data["members"]["member_1"]["company_number"];
    $company_seat2 = $this->data["members"]["member_1"]["zip"] . " " . $this->data["members"]["member_1"]["city"] . " " . $this->data["members"]["member_1"]["address"] . " " . $this->data["members"]["member_1"]["address2"];
    $fulladdress2 = $this->data["members"]["member_1"]["country"] . " " . $this->data["members"]["member_1"]["zip2"] . " " . $this->data["members"]["member_1"]["city2"] . " " . $this->data["members"]["member_1"]["address2"] . " " . $this->data["members"]["member_1"]["address2-2"];
}

$money2Name = "";
if (isset($this->company["company_member_money2_name_1"]))
{
    $money2Name = $this->company["company_member_money2_name_1"];
}

$IsBank = true;
if (isset($this->company["company_member_pay_notbank_1"]))
{
    $IsBank = false;
}

$supervisor_name1 = "";
$supervisor_name2 = "";
$supervisor_name3 = "";
$supervisor_address1 = "";
$supervisor_address2 = "";
$supervisor_address3 = "";
if ($this->data["options"]["option10"]["yesOrNo"] == 1)
{
    $supervisor_name1 = $this->data["supervisors"]["supervisor_1"]["fullName"];
    $supervisor_name2 = $this->data["supervisors"]["supervisor_2"]["fullName"];
    $supervisor_name3 = $this->data["supervisors"]["supervisor_3"]["fullName"];
    $supervisor_address1 = $this->data["supervisors"]["supervisor_1"]["zip"] . " " . $this->data["supervisors"]["supervisor_1"]["city"] . " " . $this->data["supervisors"]["supervisor_1"]["address"] . " " . $this->data["supervisors"]["supervisor_1"]["address2"];
    $supervisor_address2 = $this->data["supervisors"]["supervisor_2"]["zip"] . " " . $this->data["supervisors"]["supervisor_2"]["city"] . " " . $this->data["supervisors"]["supervisor_2"]["address"] . " " . $this->data["supervisors"]["supervisor_2"]["address2"];
    $supervisor_address3 = $this->data["supervisors"]["supervisor_3"]["zip"] . " " . $this->data["supervisors"]["supervisor_3"]["city"] . " " . $this->data["supervisors"]["supervisor_3"]["address"] . " " . $this->data["supervisors"]["supervisor_3"]["address2"];
}

$company_time = ($this->data["basic"]["time"] == "határozatlan") ? "" : $this->data["basic"]["time"];

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Setting the document language
//$phpWord->getSettings()->setThemeFontLang(new Language(Language::FR_BE)); There is no hu-HU option...

// Adding an empty Section to the document...
$section = $phpWord->addSection();

/**
 * Document writing
 */

// Adding Text element to the Section having font styled by default...
$section->addText(
    "7. számú melléklet a 21/2006. (V. 18.) IM rendelethez *",
    $mainTitleStyle,
    $AlignCenter
);
$section->addTextBreak(1);
$section->addText(
    "AZ EGYSZEMÉLYES KORLÁTOLT FELELŐSSÉGŰ TÁRSASÁG ALAPÍTÓ OKIRAT MINTÁJA",
    $titleStyle,
    $AlignCenter
);
$section->addText(
    "Alapító okirat",
    $titleStyle,
    $AlignCenter
);
$section->addTextBreak(1);
$section->addText(
    "Alulírott alapító, szerződésminta *  alkalmazásával, a következők szerint állapítja meg az alábbi korlátolt felelősségű társaság alapító okiratát:",
    $AlignLeft
);
$section->addText(
    "1. A társaság cégneve, székhelye, telephelye(i), fióktelepe(i)",
    $titleStyle,
    $AlignCenter
);

$textBlock1 = "1.1. A társaság cégneve: " . $this->data["basic"]["name"] . " Korlátolt Felelősségű Társaság\n
A társaság rövidített cégneve: *  " . $this->data["basic"]["sName"] . " Kft.\n
1.2. A társaság idegen nyelvű cégneve: *  " . $this->data["basic"]["fName"] . "\n
A társaság idegen nyelvű rövidített cégneve: *  " . $this->data["basic"]["sfName"] . "\n
1.3. A társaság székhelye: " . $company_seat . "\n
A társaság székhelye * \n
a) egyben a központi ügyintézés helye is.\n
b) nem azonos a központi ügyintézés helyével * : " . $main_seat . "\n
1.4. A társaság telephelye(i): *  " . $sites . "\n
1.5. A társaság fióktelepe(i): *  " . $branches . "";

$textBlockLines = explode("\n", $textBlock1);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    if ($line == "a) egyben a központi ügyintézés helye is." && $main_seat == "")
    {
        $textrun->addTextBreak();
        $textrun->addText($line, $underlinedChoise);
    }
    else
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

$section->addText(
    "2. A társaság alapítója",
    $titleStyle,
    $AlignCenter
);

$textBlock2 = "Név: *  " . $this->data["members"]["member_1"]["fullName"] . "\n
Lakcím: " . $fulladdress1 . "\n
Cégnév (név): *  " . $this->data["basic"]["name"] . "\n
Cégjegyzékszám (nyilvántartási szám): *  " . $company_number . "\n
Székhely: " . $company_seat2 . "\n
Képviseletre jogosult neve: " . $this->data["members"]["member_1"]["fullName"] . "\n
Lakcím: " . $fulladdress2 . "";

$textBlockLines = explode("\n", $textBlock2);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

$section->addText(
    "3. A társaság tevékenységi köre(i) * ",
    $titleStyle,
    $AlignCenter
);

$textBlock3 = "3.1. Főtevékenység: " . $this->data["basic"]["business"][0] . "\n
3.2. Egyéb tevékenységi kör(ök): *  " . $this->data["basic"]["business"][1] . "";

$textBlockLines = explode("\n", $textBlock3);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

$section->addText(
    "4. A társaság működésének időtartama",
    $titleStyle,
    $AlignCenter
);

$textBlock4 = "A társaság időtartama: *\n
a) határozatlan.\n
b) határozott * " . $company_time . ""; // -ig.

$textBlockLines = explode("\n", $textBlock4);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    if ($line == "a) határozatlan." && $this->data["basic"]["time"] == "határozatlan")
    {
        $textrun->addTextBreak();
        $textrun->addText($line, $underlinedChoise);
    }
    else
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

$section->addText(
    "5. A társaság törzstőkéje",
    $titleStyle,
    $AlignCenter
);

$textBlock5 = "5.1. A társaság törzstőkéje " . $this->data["basic"]["money"] . " Ft,\n
azaz " . $this->data["basic"]["money"] . " forint, amely\n
a) " . $this->data["members"]["member_1"]["money"] . " Ft, azaz " . $this->data["members"]["member_1"]["money"] . " forint készpénzből,\n
b) *  " . $this->data["members"]["member_1"]["money2"] . " Ft, azaz " . $this->data["members"]["member_1"]["money2"] . " forint nem pénzbeli vagyoni hozzájárulásból áll.\n
5.2. Ha a pénzbeli vagyoni hozzájárulás szolgáltatása körében a 6. pont lehetőséget ad arra, hogy a cégbejegyzési kérelem benyújtásáig a tag a pénzbetétjének felénél kisebb összeget fizessen meg, vagy a cégbejegyzési kérelem benyújtásáig be nem fizetett pénzbeli vagyoni betétjét a tag egy éven túli határidőig szolgáltassa, a társaság mindaddig nem fizet osztalékot a tagnak, amíg a ki nem fizetett és a tag törzsbetétére az osztalékfizetés szabályai szerint elszámolt nyereség a tag által teljesített pénzbeli vagyoni hozzájárulással együtt el nem éri a törzstőke mértékét. A tag a még nem teljesített pénzbeli vagyoni hozzájárulása összegének erejéig helytáll a társaság tartozásaiért.\n
5.3. A törzstőke teljesítésének megtörténtét az ügyvezető köteles a cégbíróságnak bejelenteni.";

$textBlockLines = explode("\n", $textBlock5);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

$section->addText(
    "6. A tag törzsbetétje",
    $titleStyle,
    $AlignCenter
);

$textBlock6 = "Név (Cégnév): " . $this->data["basic"]["name"] . "\n
A törzsbetét összege: " . $this->data["basic"]["money"] . " Ft\n
A törzsbetét összetétele:\n
a) Készpénz: " . $this->data["members"]["member_1"]["money"] . " Ft.\n
Cégbejegyzésig szolgáltatandó összeg: " . $this->data["members"]["member_1"]["moneyHalf"] . " Ft, mértéke a tag pénzbetétjének " . $this->data["members"]["member_1"]["paymentPercent"] . " %-a * ,\n a szolgáltatás módja: befizetés a társaság pénzforgalmi számlájára /\n a társaság házipénztárába * .\n
A fennmaradó összeget: " . $this->data["members"]["member_1"]["paymentTime"] . " -ig *  a társaság pénzforgalmi számlájára fizeti be.\n
b) *  Nem pénzbeli vagyoni hozzájárulás:\n
megnevezése: " . $money2Name . " értéke: " . $this->data["members"]["member_1"]["money2"] . " Ft.\n
A bejegyzési kérelem cégbírósághoz történő benyújtásáig a nem pénzbeli vagyoni hozzájárulást teljes egészében a társaság rendelkezésére kell bocsátani.";

$textBlockLines = explode("\n", $textBlock6);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    if ($line == " a szolgáltatás módja: befizetés a társaság pénzforgalmi számlájára /")
    {
        if ($IsBank == true)
        {
            $textrun->addText($line, $underlinedChoise);
        }
        else
        {
            $textrun->addText($line);
        }
    }
    else if ($line == " a társaság házipénztárába * .")
    {
        if ($IsBank == false)
        {
            $textrun->addText($line, $underlinedChoise);
        }
        else
        {
            $textrun->addText($line);
        }
    }
    else
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

$section->addText(
    "7. Üzletrész",
    $titleStyle,
    $AlignCenter
);

$section->addText(
    "A törzsbetéthez kapcsolódó tagsági jogok és kötelezettségek összessége az üzletrész, amely a társaság bejegyzésével keletkezik."
);

$section->addText(
    "8. Az egyszemélyes társaság működése",
    $titleStyle,
    $AlignCenter
);

$textBlock8 = "8.1. Az egyszemélyes társaság a saját üzletrészét nem szerezheti meg\n.
8.2. Ha az egyszemélyes társaság az üzletrész felosztása vagy a törzstőke felemelése folytán új tagokkal egészül ki és így többszemélyessé válik, a tagok kötelesek az alapító okiratot társasági szerződésre módosítani.";

$textBlockLines = explode("\n", $textBlock8);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

$section->addText(
    "9. A nyereség felosztása",
    $titleStyle,
    $AlignCenter
);

$textBlock9 = "9.1. A társaság saját tőkéjéből a tag javára, annak tagsági jogviszonyára figyelemmel kifizetést a társaság fennállása alatt kizárólag az előző üzleti évi adózott eredménnyel kiegészített szabad eredménytartalékból teljesíthet. Nem kerülhet sor kifizetésre, ha a társaság helyesbített saját tőkéje nem éri el vagy a kifizetés következtében nem érné el a társaság törzstőkéjét, továbbá, ha a kifizetés veszélyeztetné a társaság fizetőképességét.\n
9.2. Az ügyvezető jogosult /\n nem jogosult *  osztalékelőleg fizetéséről határozni.";

$textBlockLines = explode("\n", $textBlock9);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    if ($line == "9.2. Az ügyvezető jogosult /")
    {
        if ($this->data["options"]["option6"]["yesOrNo"] == 1)
        {
            $textrun->addText($line, $underlinedChoise);
        }
        else
        {
            $textrun->addText($line);
        }
    }
    else if ($line == " nem jogosult *  osztalékelőleg fizetéséről határozni.")
    {
        if ($this->data["options"]["option6"]["yesOrNo"] == 0)
        {
            $textrun->addText($line, $underlinedChoise);
        }
        else
        {
            $textrun->addText($line);
        }
    }
    else
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

$section->addText(
    "10. Az alapítói határozat",
    $titleStyle,
    $AlignCenter
);

$textBlock10 = "10.1. A taggyűlés hatáskörébe tartozó kérdésekben a tag írásban határoz és a döntés az ügyvezetéssel való közléssel válik hatályossá.\n
10.2. A legfőbb szerv hatáskörét a tag gyakorolja.";

$textBlockLines = explode("\n", $textBlock10);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

$section->addText(
    "11. Az ügyvezetés és képviselet",
    $titleStyle,
    $AlignCenter
);

// if member is manager
for ($i = 1; $i < 2; $i++)
{
    if ($this->data["members"]["member_$i"]["manager"] == "on")
    {
        $manager_address = $this->data["members"]["member_$i"]["zip"] . " " . $this->data["members"]["member_$i"]["city"] . " " . $this->data["members"]["member_$i"]["address"] . " " . $this->data["members"]["member_$i"]["address2"];

        $cNumber = "";
        if (isset($this->data["members"]["member_$i"]["cNumber"]))
        {
            $cNumber = $this->data["members"]["member_$i"]["cNumber"];
        }
    
        $manager_address2 = "";
        if (isset($this->data["members"]["member_$i"]["cNumber"]))
        {
            $manager_address2 = $this->data["members"]["member_$i"]["zip2"] . " " . $this->data["members"]["member_$i"]["city2"] . " " . $this->data["members"]["member_$i"]["address2"] . " " . $this->data["members"]["member_$i"]["address2-2"];
        }

        $time = explode(",", $this->data["members"]["member_$i"]["managerTime"]);
        $time0 = ($time[0] != "határozatlan") ? $time[0] : "";
        $time1 = ($time[0] != "határozatlan") ? $time[1] : "";

        $textBlock11 = "11.1. *  A társaság ügyvezetésére és képviseletére jogosult ügyvezetője:\n
        Név: *  " . $this->data["members"]["member_$i"]["fullName"] . "\n
        Lakcím: " . $manager_address . "\n
        Cégnév (név): *  " . $this->data["basic"]["name"] . "\n
        Cégjegyzékszám (nyilvántartási szám): *  " . $cNumber . "\n
        Székhely: " . $company_seat2 . "\n
        Képviseletre jogosult neve: " . $this->data["members"]["member_$i"]["fullName"] . "\n
        Lakcím: " . $manager_address2 . "\n
        Az ügyvezetői megbízatás * \n
        a) határozott időre *\n
        b) határozatlan időre szól.\n
        A megbízatás kezdő időpontja: " . $time0 . "\n
        A megbízatás lejárta: *  " . $time1 . "\n
        A vezető tisztségviselő a társaság ügyvezetését megbízási jogviszonyban /\n munkaviszonyban *  látja el.";

        $textBlockLines = explode("\n", $textBlock11);

        $textrun = $section->addTextRun();
        $textrun->addText(array_shift($textBlockLines));

        foreach($textBlockLines as $line)
        {
            $underline = trim($line);
            if ($underline == "A vezető tisztségviselő a társaság ügyvezetését megbízási jogviszonyban /")
            {
                if ($this->data["members"]["member_$i"]["memberType"] == "Jogiszemély")
                {
                    $textrun->addText($line, $underlinedChoise);
                }
                else
                {
                    $textrun->addText($line);
                }
            }
            else if ($underline == "munkaviszonyban *  látja el." && $this->data["members"]["member_$i"]["memberType"] == "Magánszemély")
            {
                if ($this->data["members"]["member_$i"]["memberType"] == "Magánszemély")
                {
                    $textrun->addText($line, $underlinedChoise);
                }
                else
                {
                    $textrun->addText($line);
                }
            }
            else if ($underline == "a) határozott időre *" && $time != "határozatlan")
            {
                $textrun->addTextBreak();
                $textrun->addText($line, $underlinedChoise);
            }
            else if ($underline == "b) határozatlan időre szól." && $time == "határozatlan")
            {
                $textrun->addTextBreak();
                $textrun->addText($line, $underlinedChoise);
            }
            else
            {
                $textrun->addTextBreak();
                $textrun->addText($line);
            }
        }
    }
}

// if manager is not member
for ($i = 0; $i < $this->company["company_manager_num"]; $i++)
{
    $j = $i + 1;
    $manager_address = $this->data["managers"]["manager_$j"]["zip"] . " " . $this->data["managers"]["manager_$j"]["city"] . " " . $this->data["managers"]["manager_$j"]["address"] . " " . $this->data["managers"]["manager_$j"]["address2"];

    $cNumber = "";
    if (isset($this->data["managers"]["manager_$j"]["cNumber"]))
    {
        $cNumber = $this->data["managers"]["manager_$j"]["cNumber"];
    }
    
    $manager_address2 = "";
    if (isset($this->data["managers"]["manager_$j"]["cNumber"]))
    {
        $manager_address2 = $this->data["managers"]["manager_$j"]["zip2"] . " " . $this->data["managers"]["manager_$j"]["city2"] . " " . $this->data["managers"]["manager_$j"]["address2"] . " " . $this->data["managers"]["manager_$j"]["address2-2"];
    }

    $textBlock11 = "11.1. *  A társaság ügyvezetésére és képviseletére jogosult ügyvezetője:\n
    Név: *  " . $this->data["managers"]["manager_$j"]["fullName"] . "\n
    Lakcím: " . $manager_address . "\n
    Cégnév (név): *  " . $this->data["basic"]["name"] . "\n
    Cégjegyzékszám (nyilvántartási szám): *  " . $cNumber . "\n
    Székhely: " . $company_seat2 . "\n
    Képviseletre jogosult neve: " . $this->data["managers"]["manager_$j"]["fullName"] . "\n
    Lakcím: " . $manager_address2 . "\n
    Az ügyvezetői megbízatás * \n
    a) határozott időre *   Ilyen még nem lett eltárolva ezt javítani kell!!!!!\n
    b) határozatlan időre szól.\n
    A megbízatás kezdő időpontja: Ilyen még nem lett eltárolva ezt javítani kell!!!!!\n
    A megbízatás lejárta: *  Ilyen még nem lett eltárolva ezt javítani kell!!!!!\n
    A vezető tisztségviselő a társaság ügyvezetését megbízási jogviszonyban /\n munkaviszonyban *  látja el.";

    $textBlockLines = explode("\n", $textBlock11);

    $textrun = $section->addTextRun();
    $textrun->addText(array_shift($textBlockLines));

    foreach($textBlockLines as $line)
    {
        $underline = trim($line);
        if ($underline == "A vezető tisztségviselő a társaság ügyvezetését megbízási jogviszonyban /")
        {
            if ($this->data["managers"]["manager_$j"]["managerType"] == "Jogiszemély")
            {
                $textrun->addText($line, $underlinedChoise);
            }
            else
            {
                $textrun->addText($line);
            }
        }
        else if ($underline == "munkaviszonyban *  látja el.")
        {
            if ($this->data["managers"]["manager_$j"]["managerType"] == "Magánszemély")
            {
                $textrun->addText($line, $underlinedChoise);
            }
            else
            {
                $textrun->addText($line);
            }
        }
        else if ($line == "b) határozatlan időre szól.")
        {
            $textrun->addTextBreak();
            $textrun->addText($line, $underlinedChoise);
        }
        else
        {
            $textrun->addTextBreak();
            $textrun->addText($line);
        }
    }
}

$section->addText(
    "12. Cégvezető",
    $titleStyle,
    $AlignCenter
);

$textBlock12 = "12.1. A társaságnál cégvezető kinevezésére *\n
a) sor kerülhet.\n
b) nem kerülhet sor.";

$textBlockLines = explode("\n", $textBlock12);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    if ($this->data["options"]["option9"]["yesOrNo"] == 0 && $line == "b) nem kerülhet sor.")
    {
        $textrun->addTextBreak();
        $textrun->addText($line, $underlinedChoise);
    }
    else if($this->data["options"]["option9"]["yesOrNo"] == 1 && $line == "a) sor kerülhet.")
    {
        $textrun->addTextBreak();
        $textrun->addText($line, $underlinedChoise);
    }
    else
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

// if new boss can be elected
for ($i = 0; $i < $this->company["company_boss_num"]; $i++)
{
    $j = $i + 1;
    $boss_address = $this->data["options"]["option9"]["boss"]["boss_$j"]["zip"] . " " . $this->data["options"]["option9"]["boss"]["boss_$j"]["city"] . " " . $this->data["options"]["option9"]["boss"]["boss_$j"]["address"] . " " . $this->data["options"]["option9"]["boss"]["boss_$j"]["address2"];

    $textBlock12 = "12.2. *  Cégvezetőnek kinevezett munkavállaló(k) * :\n
    Név: " . $this->data["options"]["option9"]["boss"]["boss_$j"]["fullName"] . "\n
    Lakcím: " . $boss_address . "\n
    Kinevezés kezdő időpontja: " . $this->data["options"]["option9"]["boss"]["boss_$j"]["time"] . ""; //  " . $this->data["boss"]["boss_$j"]["time2"] . " end time of boss

    $textBlockLines = explode("\n", $textBlock12);

    $textrun = $section->addTextRun();
    $textrun->addText(array_shift($textBlockLines));

    foreach($textBlockLines as $line)
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

$section->addText(
    "13. Cégjegyzés",
    $titleStyle,
    $AlignCenter
);

$section->addText(
    "13.1. *  Az önálló cégjegyzésre jogosultak:"
);

for ($i = 1; $i < $this->company["company_member_num"] + 1; $i++)
{
    if ($this->data["members"]["member_$i"]["managerOption2"] == "on")
    {
        $textBlock13 = "Név: " . $this->data["members"]["member_$i"]["fullName"] . "";

        $textBlockLines = explode("\n", $textBlock13);

        $textrun = $section->addTextRun();
        $textrun->addText(array_shift($textBlockLines));

        foreach($textBlockLines as $line)
        {
            $textrun->addTextBreak();
            $textrun->addText($line);
        }
    }
}

$textBlock13 = "13.2. Az együttes cégjegyzési joggal rendelkezők: * \n
a) Név: és\n
Név: \n
együttesen jogosultak cégjegyzésre.\n
b) *  Név: és\n
Név: \n
együttesen jogosultak cégjegyzésre.";

$textBlockLines = explode("\n", $textBlock13);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

$section->addText(
    "14. Felügyelőbizottság",
    $titleStyle,
    $AlignCenter
);

$section->addText(
    "14.1. A társaságnál felügyelőbizottság választására *"
);

$textBlock14 = "a) sor kerül.\n
b) nem kerül sor.\n";

$textBlockLines = explode("\n", $textBlock14);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    if ($this->data["options"]["option10"]["yesOrNo"] == 1 && $line == "a) sor kerül.")
    {
        $textrun->addTextBreak();
        $textrun->addText($line, $underlinedChoise);
    }
    else if ($this->data["options"]["option10"]["yesOrNo"] == 0 && $line == "b) nem kerül sor.")
    {
        $textrun->addTextBreak();
        $textrun->addText($line, $underlinedChoise);
    }
    else
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

if ($this->data["options"]["option10"]["yesOrNo"] == 1)
{
    $textBlock14 = "14.2. A társaságnál nem ügydöntő felügyelőbizottság működik.\n
    14.3. *  A felügyelőbizottság tagjai:\n
    Név: " . $supervisor_name1 . "\n
    Lakcím: " . $supervisor_address1 . "\n
    A megbízatás * \n
    a) határozott időre *  ez még nem jó\n
    b) határozatlan időre\n
    szól.\n
    A megbízatás kezdő időpontja: ez még nem jó\n
    A megbízatás lejárta: *  ez még nem jó\n
    Név: " . $supervisor_name2 . "\n
    Lakcím: " . $supervisor_address2 . "\n
    A megbízatás * \n
    a) határozott időre *  ez még nem jó\n
    b) határozatlan időre\n
    szól.\n
    A megbízatás kezdő időpontja: ez még nem jó\n
    A megbízatás lejárta: *  ez még nem jó\n
    Név: *  " . $supervisor_name3 . "\n
    Lakcím: " . $supervisor_address3 . "\n
    A megbízatás * \n
    a) határozott időre *  ez még nem jó\n
    b) határozatlan időre\n
    szól.\n
    A megbízatás kezdő időpontja: ez még nem jó\n
    A megbízatás lejárta: *  ez még nem jó";

    $textBlockLines = explode("\n", $textBlock14);

    $textrun = $section->addTextRun();
    $textrun->addText(array_shift($textBlockLines));

    foreach($textBlockLines as $line)
    {
        $textrun->addTextBreak();
        $textrun->addText($line);
    }
}

$section->addText(
    "15. Könyvvizsgáló * ",
    $titleStyle,
    $AlignCenter
);

$textBlock15 = "A társaság könyvvizsgálója:
Név: *  \n
Lakcím: \n
Kamarai nyilvántartási száma: \n
Cégnév: *  \n
Cégjegyzékszám: \n
Székhely: \n
A könyvvizsgálat elvégzéséért személyében felelős természetes személy neve:
\n
Kamarai nyilvántartási száma: \n
Lakcím: \n
Helyettes könyvvizsgáló neve: \n
Lakcím:  \n
A megbízatás kezdő időpontja: \n
A megbízatás lejárta: ";

$textBlockLines = explode("\n", $textBlock15);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

$section->addText(
    "16. A társaság megszűnése",
    $titleStyle,
    $AlignCenter
);

$section->addText(
    "A társaság jogutód nélküli megszűnése esetében a hitelezők kielégítése után fennmaradó vagyon az alapítót illeti meg."
);

$section->addText(
    "17. Egyéb rendelkezések",
    $titleStyle,
    $AlignCenter
);

$section->addText(
    "17.1. Azokban az esetekben, amikor a Polgári Törvénykönyvről szóló 2013. évi V. törvény (Ptk.) a társaságot kötelezi arra, hogy közleményt tegyen közzé, a társaság e kötelezettségének *"
);

if ($this->data["options"]["option11"]["yesOrNo"] == 1)
{
    $section->addText("a) a Cégközlönyben", $underlinedChoise);
}
else
{
    $section->addText("a) a Cégközlönyben");
}

if ($this->data["options"]["option11"]["yesOrNo"] == 0)
{
    $section->addText("b) a társaság honlapján *", $underlinedChoise);
}
else
{
    $section->addText("b) a társaság honlapján *");
}

$textBlock17_2 = "tesz eleget.\n
17.2. A jelen alapító okiratban nem szabályozott kérdésekben a Ptk. rendelkezéseit kell alkalmazni.\n
Kelt: " . date("Y.m.d") . "\n
Az alapító aláírása:\n
......................................................................................................................................\n
Név:\n
Okirati ellenjegyzés/közjegyzői okirat elemei * ";

$textBlockLines = explode("\n", $textBlock17_2);

$textrun = $section->addTextRun();
$textrun->addText(array_shift($textBlockLines));

foreach($textBlockLines as $line)
{
    $textrun->addTextBreak();
    $textrun->addText($line);
}

// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, "Word2007");
$objWriter->save($fullPath);
?>