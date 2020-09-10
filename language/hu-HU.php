<?php
    // Hungarian language file
    $messages["title"] = "Cégalapítás könnyen és gyorsan!";
    $messages["company-basic"] = "Cégadatok";
    $messages["company-foreign-name"] = "Idegen nyelvű cégnév";
    $messages["company-short-foreign-name"] = "Idegen nyelvű rövidített cégnév";
    $messages["company-short-name"] = "Rövidített cégnév";
    $messages["company-name"] = "Cég neve";
    $messages["company-type"] = "Cégformátum";

    // Company types options
    function SetCompanyOptions()
    {
        // Company types (Add more if you need more)
        $company_types = array(
            "Egyszemélyes Korlátolt felelősségű társaság (Kft.)",
            "Többszemélyes Korlátolt felelősségű társaság (Kft.)" //"Betéti Társaság (Bt.)", "Zártkörüen működö részvénytársaság (Zrt.)" ezek még nem működnek
        );

        // You don't need to change anything here!
        $option_values = "";

        for ($i = 0; $i < count($company_types); $i++) 
        {
            $toOptions = '<option value="' . $company_types[$i] . '">' . $company_types[$i] . '</option>';
            $option_values .= $toOptions;
        }

        echo $option_values;
    }
    ////

    // Company business type options
    function SetCompanyBusinessOptions()
    {
        // Company business type (Add more if you need more)
        $company_businesses = explode(PHP_EOL, file_get_contents("../language/business-options.txt"));

        // You don't need to change anything here!
        $option_values = "";

        for ($i = 0; $i < count($company_businesses); $i++) 
        {
            $toOptions = '<option value="' . $company_businesses[$i] . '">' . $company_businesses[$i] . '</option>';
            $option_values .= $toOptions;
        }

        echo $option_values;
    }
    ////

    $messages["company-business"] = "Válaszd ki a főtevékenységi körét!";
    $messages["company-list-placeholder"] = "Keresés";
    $messages["company-other-business"] = "További tevékenységi körök!";
    $messages["company-seat"] = "Székhely";
    $messages["company-site"] = "Telephely adatok";
    $messages["company-branch"] = "Fióktelep adatok";
    $messages["district"] = "Kerület";
    $messages["city"] = "Település";
    $messages["street"] = "Közterület neve és jellege";
    $messages["address-other"] = "Házszám, emelet és ajtó";
    $messages["additional-data"] = "További adatok";
    $messages["other-sites"] = "Telephely hozzáadása";
    $messages["other-branch"] = "Fióktelep hozzáadása";
    $messages["other-manager"] = "Ügyvezető hozzáadása";
    $messages["other-boss"] = "Cégvezető hozzáadása";
    $messages["upload-text"] = "Húzz ide fájlt vagy kattins ide a kiválasztáshoz";
    $messages["company-meeting"] = "A taggyűlés a veszteségek fedezésére a tagok számára";
    $messages["company-meeting-additional-payment-yes"] = "Pótbefizetést előírhat";
    $messages["company-meeting-additional-payment-no"] = "Pótbefizetést nem írhat elő";
    $messages["company-meeting-additional-payment-once"] = "Üzleti évenként egyszer a taggyűlésben";
    $messages["company-meeting-additional-payment-time"] = "Legfeljebb üzleti évenként";
    $messages["company-meeting-additional-payment-amount"] = "A pótbefizetés legmagasabb összege";
    $messages["permission-granted-yes"] = "jogosultság a fenti sorrendben illeti meg.";
    $messages["permission-granted-no"] = "jogosultság nem illeti meg.";
    $messages["dividend-payment"] = "az osztalékfizetésről szóló döntés meghozatalának időpontjában a társasággal szemben a tagsági jogai gyakorlására jogosult.";
    $messages["current-year"] = "a tárgyév <select id='month' name='company-option5-month' class='form-control' style='display: inline; width: 120px;'>
    <option value='Január'>Január</option>
    <option value='Február'>Február</option>
    <option value='Március'>Március</option>
    <option value='Április'>Április</option>
    <option value='Május'>Május</option>
    <option value='Június'>Június</option>
    <option value='Július'>Július</option>
    <option value='Augusztus'>Augusztus</option>
    <option value='Szeptember'>Szeptember</option>
    <option value='Október'>Október</option>
    <option value='November'>November</option>
    <option value='December'>December</option>
    </select> hónap <select id='day' name='company-option5-day' class='form-control' style='display: inline; width: 90px;'></select> napjáig a társasággal szemben a tagsági jogai gyakorlására jogosult volt.";

    // Leave the <br /> tags alone ty :3
    $messages["upload-text2"] = "Bizonyíték, hogy a székhelyen van engedélyed céget alapítani
    <br />(tulajdoni lap, bérleti szerződés, írásos engedély a tulajdonostól) 
    <br /> Több fájlt is be tudsz egyszerre helyzeni.";

    $messages["company-members"] = "Tagok";
    $messages["company-member"] = "Tag";
    $messages["company-manager"] = "Ügyvezető";
    $messages["company-managers"] = "Ügyvezetők";
    $messages["company-boss"] = "Cégvezető";
    $messages["company-bosses"] = "Cégvezetők";
    $messages["company-member-internal"] = "Belső tag";
    $messages["company-member-external"] = "Külső tag";
    $messages["company-member-type"] = "Típus";

    // Member types options
    function SetMemberTypeOptions()
    {
        // Member types (Add more if you need more)
        $member_types = array(
            "Magánszemély",
            "Jogiszemély"
        );

        // You don't need to change anything here!
        $option_values = "";

        for ($i = 0; $i < count($member_types); $i++) 
        {
            $toOptions = '<option value="' . $member_types[$i] . '">' . $member_types[$i] . '</option>';
            $option_values .= $toOptions;
        }

        echo $option_values;
    }
    ////

    $messages["company-member-boss"] = "Ez a tag lesz a cég ügyvezetője";
    $messages["company-member-boss-manager"] = "Az üzletvezetésre, képviselésre és a cégjegyzésre ez a tag jogosult";
    $messages["company-member-boss-manager-self"] = "Önálló cégjegyzésre jogosult";
    $messages["company-member-boss-time"] = "Az ügyvezetés időtartama";
    $messages["company-time"] = "A cég működési időtartama";
    $messages["company-member-boss-time-unknown"] = "Határozatlan";
    $messages["company-member-boss-time-known"] = "Határozott";
    $messages["company-member-boss-lead"] = "A vezető tisztségviselő a társáság ügyvezetését";
    $messages["company-member-boss-lead-type1"] = "megbízási jogviszonyban látja el";
    $messages["company-member-boss-lead-type2"] = "munkaviszonyban látja el";
    $messages["company-member-firstname"] = "Vezetéknév";
    $messages["company-member-lastname"] = "Keresztnév";
    $messages["company-member-date"] = "Születési dátum";
    $messages["company-member-birthplace"] = "Születési hely";
    $messages["company-member-type2-name"] = "képviseletre jogosult neve";
    $messages["company-member-type2-address"] = "képviseletre jogosult lakcíme";
    $messages["company-member-id"] = "Azonosító okmány";
    $messages["company-member-idnumber"] = "Személyi igazolvány szám";

    // Member types options
    function SetIdTypeOptions()
    {
        // Member types (Add more if you need more)
        $id_types = array(
            "Személyi igazolvány szám",
            "Útlevélszám"
        );

        // You don't need to change anything here!
        $option_values = "";

        for ($i = 0; $i < count($id_types); $i++) 
        {
            $toOptions = '<option value="' . $id_types[$i] . '">' . $id_types[$i] . '</option>';
            $option_values .= $toOptions;
        }

        echo $option_values;
    }
    ////

    $messages["upload-text3"] = "Töltsd fel a személyi igazolványod elő- és hátlapját!";
    $messages["upload-text4"] = "Töltsd fel a lakcímkártyád elő- és hátlapját!";
    $messages["upload-text5"] = "Töltsd fel az adóigazolványod előlapját!";
    $messages["upload-text6"] = "Bizonyíték, hogy a telephelyen van engedélyed céget alapítani
    <br />(tulajdoni lap, bérleti szerződés, írásos engedély a tulajdonostól) 
    <br /> Több fájlt is be tudsz egyszerre helyzeni.";
    $messages["upload-text7"] = "Bizonyíték, hogy a fióktelepen van engedélyed céget alapítani
    <br />(tulajdoni lap, bérleti szerződés, írásos engedély a tulajdonostól) 
    <br /> Több fájlt is be tudsz egyszerre helyzeni.";
    $messages["company-member-address"] = "Lakcím";
    $messages["company-member-country"] = "Ország";
    $messages["company-member-contact"] = "Kapcsolattartási adatok";
    $messages["company-member-email2"] = "Ellenjegyzéshez email (gmail)";
    $messages["company-member-phone"] = "Telefonszám";
    $messages["money-currency"] = "forint";
    $messages["company-member-money"] = "Tag vagyoni hozzájárulása készpénzben";
    $messages["company-member-money2"] = "Tag vagyoni hozzájárulása nem pénzbeli betét formájában";
    $messages["company-member-vatnumber"] = "Adóazonosító jel";
    $messages["company-member-mothername"] = "Anyja neve";
    $messages["digital-signature"] = "Elektronikus aláírás";
    $messages["delete"] = "Törlés";
    $messages["notification-email"] = "A cég kapcsolati email címe";
    $messages["notification-email-text"] = "Erre az email címre fogjuk küldeni a dokumentumokat amikor elkészűl a cég. A bejegyzés után ez nyilvános adattá válik a cégbíróságon.";
    $messages["submit-btn"] = "Megalapítom a cégemet!";
    $messages["fine-print"] = "A cégalapításnak további költségei nincsenek. Nincsenek rejtett költségek, sem illetékek. A fizetés után a céged 1-2 munkanap alatt elkészül. <br />
    Minden adatot titkosítunk, bizalmasan kezelünk és tároljuk. Mindezt a GDRPt és további szabályokat betartva.";
    $messages["company-member-add"] = "Új tag hozzáadása";
    $messages["confirm-delete"] = "Biztosan törölni akarod?";
    $messages["confirm-yes"] = "Igen";
    $messages["confirm-no"] = "Nem";
    $messages["company-main-site"] = "Ez a központi ügyintézés helye";
    $messages["company-option1"] = "taggyűlés tartásával határozhat";
    $messages["company-option2"] = "írásbeli döntéshozatallal is határozhat";
    $messages["company-option3"] = "legalább egyszer";
    $messages["company-option4"] = "<select class='form-control' id='monthly-occurence' name='company-option8-monthly' style='width: 70px; display: inline;' disabled>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12'>12</option>
    </select>
    hónapi gyakorisággal";
    $messages["company-option5"] = "társaság székhelyére vagy telephelyére";
    $messages["company-option6"] = "a következő címre";
    $messages["company-option7"] = "sor kerülhet.";
    $messages["company-option8"] = "nem kerülhet sor.";
    $messages["company-option9"] = "biztosíthat.";
    $messages["company-option10"] = "nem biztosíthat.";
    $messages["company-option11"] = "sor kerül.";
    $messages["company-option12"] = "nem kerül sor.";
    $messages["company-option13"] = "a Cégközlönyben tesz eleget.";
    $messages["company-option14"] = "a társaság honlapján tesz eleget.";
    $messages["download-btn"] = "Igazoló dokumentum letöltése";
    $messages["download-help"] = "Töltsd ki cégnév és cím adatokat az igazoló dokumentum letöltéséhez!";
    $messages["company-member-basic-money"] = "Cégbejegyzésig szolgáltatandó összeg";
    $messages["company-member-pay-bank"] = "A cég számlájára utalja át";
    $messages["company-member-pay-notbank"] = "A cég házipénztárjába fizeti be";
    $messages["company-member-money-payment-time"] = "A fennmaradó összeget eddig fizeti be";
    $messages["company-member-pay-atstart"] = "Alapításkor rendelkezésre bocsátja";
    $messages["company-member-pay-afterstart"] = "Eddig bocsátja rendelkezésre be";
    $messages["company-member-email"] = "Email cím";
    $messages["upload-text8"] = "Töltsd fel az ügyvezető nyilatkozatot!";
    $messages["download-btn2"] = "Ügyvezető nyilatkozat letöltése";
    $messages["appointment"] = "Jelölj meg néhány időpontot, ami alkalmas neked egy 5-10 perces videóhívásra ügyvédi ellenjegyzés miatt";
    $messages["save"] = "Mentés";
    $messages["stat-1"] = "törzstőke aránya";
    $messages["stat-2"] = "tulajdon aránya";
    $messages["stat-3"] = "osztalék aránya";
    $messages["stat-4"] = "szavazatszám";
    $messages["stat-5"] = "szavazatok aránya";
    $messages["company-member-money2-name"] = "Megnevezés";
    $messages["company-member-company-number"] = "Cégjegyzékszám";
?>