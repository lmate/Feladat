<?php
define("ROOT", ""); // Root dir

require ROOT . "Config/core.php";

class Handler
{
    private $args;
    private $userDir;

    function __construct($args, $userDir, $newUserDirName)
    {
        $this->args = $args;
        $this->userDir = $userDir;
        $this->newUserDirName = $newUserDirName;
    }

    public function HandleForm()
    {
        $validator = new Validator($this->args, $this->userDir);
        $validatedJson = $validator->FormValidator();

        if (is_array($validatedJson))
        {
            $value = json_encode($validatedJson);
            $company = json_decode($value, true);

            $dirValidation = $validator->IsUserDirEmpty();
            if (is_array($dirValidation) && !empty($dirValidation))
            {
                $this->JsonError("userDirError", $dirValidation);
            }
            else if ($dirValidation == false && !empty($dirValidation))
            {
                $this->JsonError("userDirEmpty", "Nem töltöttél fel semmit se kérlek töltsd fel a kötelező fájlokat!");
            }

            /*$validator->SetRawSignature($this->GetAllSignature($company)); // setting signature for validator
            $validator->GetSignature(); // saving signatures as an image to the user directory (2020.08.07) Attila Deprecated*/

            // This is going to be in the database because this is clean and this is in order
            $json = array();
            if (strpos($company["company_type"], "Egyszemélyes") !== false && strpos($company["company_type"], "Kft") !== false)
            {
                require "Parser/Kft.php";

                $parser = new Kft();

                $json = array(
                    "basic" => $parser->GetCompanyBasic($company),
                    "options" => $parser->GetCompanyOptions($company),
                    "members" => $parser->GetCompanyMembers($company),
                    "user_temp_dir" => $this->newUserDirName
                );

                // if these are empty we are not going to pass an empty array element to the main json array instead we are passing 0
                $sites = $parser->GetCompanySites($company);
                if(!empty($sites))
                {
                    $json["sites"] = $sites;
                }
                else
                {
                    $json["sites"] = 0;
                }

                $branches = $parser->GetCompanyBranches($company);
                if(!empty($branches))
                {
                    $json["branches"] = $branches;
                }
                else
                {
                    $json["branches"] = 0;
                }

                $managers = $parser->GetCompanyManagers($company);
                if (!empty($managers))
                {
                    $json["managers"] = $managers;
                }
                else
                {
                    $json["managers"] = 0;
                }
            }

            $json["appointment"] = array(
                $company["appointment_date_1"],
                $company["appointment_date_2"],
                $company["appointment_date_3"]
            );

            $company_name = $json["basic"]["name"];
            $directory_name = $json["user_temp_dir"];
            $email = $company["notification_email"];
            ////
            
            if (strpos($company["company_type"], "Egyszemélyes") !== false)
            {
                /*$time1 = "";
                if ($json["basic"]["time"] != "határozatlan")
                {
                    $time1 = $json["basic"]["time"];
                }

                $time2 = $company["company_member_money_payment_time_1"];
                $time3 = "";
                $time4 = "";
                $time5 = "";
                $time6 = "";
                if (isset($company["company_member_boss_time_known_1"]))
                {
                    $time3 = $company["company_member_boss_time_knowndate2_1"];
                    $time4 = $company["company_member_boss_time_knowndate_1"];
                    $time5 = $company["company_member_boss_time_knowndate2_1"];
                }

                if (isset($company["boss_time_1"]))
                {
                    $time6 = $company["boss_time_1"];
                }

                $name = "";
                if ($company["company_member_fullname_1"] == "")
                {
                    $name = $company["company_member_type2_fullname_1"];
                }
                else
                {
                    $name = $company["company_member_fullname_1"];
                }

                $fulladdress1 = $json["members"]["member_1"]["country"] . " " . $json["members"]["member_1"]["zip"] . " " . $json["members"]["member_1"]["city"] . " " . $json["members"]["member_1"]["address"] . " " . $json["members"]["member_1"]["address2"];
                $fulladdress2 = "";
                $seat1 = $json["basic"]["zip"] . " " . $json["basic"]["city"] . " " . $json["basic"]["address"] . " " . $json["basic"]["address2"];
                $seat2 = "";
                if (isset($json["members"]["member_1"]["company_number"]))
                {
                    $seat2 = $json["members"]["member_1"]["zip"] . " " . $json["members"]["member_1"]["city"] . " " . $json["members"]["member_1"]["address"] . " " . $json["members"]["member_1"]["address2"];
                    $fulladdress2 = $json["members"]["member_1"]["zip2"] . " " . $json["members"]["member_1"]["zip2"] . " " . $json["members"]["member_1"]["city2"] . " " . $json["members"]["member_1"]["address2"] . " " . $json["members"]["member_1"]["address2-2"];
                }

                $money2Name = "";
                if (isset($company["company_member_money2_name_1"]))
                {
                    $money2Name = $company["company_member_money2_name_1"];
                }

                $manager_name = $name;
                $manager_address = $fulladdress1;

                $new_boss_name = "";
                $new_boss_address = "";
                if (isset($company["boss_firstname_1"]))
                {
                    $new_boss_name = $company["boss_fullname_1"];
                    $new_boss_address = $company["boss_country_1"] . " " . $company["boss_zip_1"] . " " . $company["boss_city_1"] . " " . $company["boss_address_1"] . " " . $company["boss_address2_1"];
                }

                $sub = "";
                if (isset($company["company_member_boss_manager_self_1"]))
                {
                    $sub = $name;
                }

                $supervisor_names1 = "";
                $supervisor_names2 = "";
                $supervisor_names3 = "";
                $supervisor_address1 = "";
                $supervisor_address2 = "";
                $supervisor_address3 = "";
                $time7 = "";
                $time8 = "";
                $time9 = "";
                $time10 = "";
                $time11 = "";
                $time12 = "";

                if (isset($company["company-option10"]))
                {
                    $supervisor_names1 = $json["options"]["option10"]["supervisors"]["supervisor_1"]["fullName"];
                    $supervisor_names2 = $json["options"]["option10"]["supervisors"]["supervisor_2"]["fullName"];
                    $supervisor_names3 = $json["options"]["option10"]["supervisors"]["supervisor_3"]["fullName"];
                    $supervisor_address1 = $json["options"]["option10"]["supervisors"]["supervisor_1"]["country"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_1"]["zip"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_1"]["city"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_1"]["address"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_1"]["address2"];
                    $supervisor_address2 = $json["options"]["option10"]["supervisors"]["supervisor_2"]["country"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_2"]["zip"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_2"]["city"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_2"]["address"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_2"]["address2"];
                    $supervisor_address3 = $json["options"]["option10"]["supervisors"]["supervisor_3"]["country"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_3"]["zip"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_3"]["city"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_3"]["address"] . " " . $json["options"]["option10"]["supervisors"]["supervisor_3"]["address2"];
                    $time7 = $company["company_supervisor_time2"];
                    $time8 = $company["company_supervisor_time2"];
                    $time9 = $company["company_supervisor_time1"];
                    $time10 = $company["company_supervisor_time2"];
                    $time11 = $company["company_supervisor_time1"];
                    $time12 = $company["company_supervisor_time2"];
                }

                $seat3 = "";
                if ($company["company_main_place"] != "seat")
                {
                    $main = $company["company_main_place"];
                    $mainType = explode("_", $main);
                    $mainType = $mainType[0];

                    $seat3 = $json[$mainType][$main]["country"] . " " . $json[$mainType][$main]["zip"] . " " . $json[$mainType][$main]["city"] . " " . $json[$mainType][$main]["address"] . " " . $json[$mainType][$main]["address2"];
                }

                $IsBank = true;
                if (isset($company["company_member_pay_notbank_1"]))
                {
                    $IsBank = false;
                }

                $data = array(
                    "name1" => $company["company_name"],
                    "name2" => $company["company_short_name"],
                    "name3" => $company["company_foreign_name"],
                    "name4" => $company["company_short_foreign_name"],
                    "name5" => $money2Name,
                    "seat1" => $seat1,
                    "seat2" => $seat2,
                    "seat3" => $seat3,
                    "sites" => $sites,
                    "branches" => $branches,
                    "member_name" => $name,
                    "company_number" => $company["company_member_company_number_1"],
                    "fulladdress1" => $fulladdress1,
                    "fulladdress2" => $fulladdress2,
                    "business1" => $company["company_business"],
                    "business2" => $company["company_other_business"],
                    "money1" => $json["basic"]["money"],
                    "money2" => $company["company_member_money_1"],
                    "money3" => $company["company_member_money2_1"],
                    "money4" => $company["company_member_money_half_1"],
                    "percent" => $company["company_member_money_percent_1"],
                    "time1" => $time1,
                    "time2" => $time2,
                    "time3" => $time3,
                    "time4" => $time4,
                    "time5" => $time5,
                    "time6" => $time6,
                    "time7" => $time7,
                    "time8" => $time8,
                    "time9" => $time9,
                    "time10" => $time10,
                    "time11" => $time11,
                    "time12" => $time12,
                    "time13" => date("Y.m.d"),
                    "manager_name" => $manager_name,
                    "manager_address" => $manager_address,
                    "new_boss_name" => $new_boss_name,
                    "new_boss_address" => $new_boss_address,
                    "sub" => $sub,
                    "supervisor_names1" => $supervisor_names1,
                    "supervisor_names2" => $supervisor_names2,
                    "supervisor_names3" => $supervisor_names3,
                    "supervisor_address1" => $supervisor_address1,
                    "supervisor_address2" => $supervisor_address2,
                    "supervisor_address3" => $supervisor_address3,
                    "IsBank" => $IsBank,
                    "option6" => $json["options"]["option6"]["yesOrNo"]
                );*/

                print_r($json);

                $filler = new Filler("templates", $this->userDir, "egyszemélyes_kft", $json);
                $filler->GetTemplate();
                $filler->SetOldJsonData($company);
                $filler->MakeDocument();
            }
            else if(strpos($company["company_type"], "Többszemélyes") !== false && strpos($company["company_type"], "Kft") !== false)
            {
                /*$filler = new Filler("templates", $this->userDir, "többszemélyes_kft", $company[0]);
                $filler->GetTemplate();
                $filler->FillDocument();*/
                die("Ez még nem érhető el!");
            }

            die(); // KIVENNI HA KÉSZ A DEBUG

            $this->HandleDatabase(json_encode($json), $company_name, $directory_name, $email);

            $config = array(
                "emailusername" => "sattipolo@gmail.com",
                "emailto" => $company["notification_email"],
                "emailsubject" => "Hello menő sikeres kérvény leadás teszt!",
                "emailhost" => "ssl://smtp.gmail.com",
                "emailport" => "465",
                "emailauth" => true,
                "emailpassword" => "guwfvkuenzxcehvp",
                "emailtemplate" => "Hello az én nevem sikeres kérvény leadás teszt örvendek a találkozásnak! Sikeresen leadtad a kérvényed!",
                "emailattachment" => ""
            );
            
            $email = new Email($config);
            $email->SendEmail();

            return true;
        }
        else
        {
            $this->JsonError("notValidJson", "Not valid content type!");
        }
    }

    private function JsonError($msg1, $msg2) // Error handler
    {
        die(json_encode(array("error" => $msg1, "errorMessage" => $msg2)));
    }

    private function HandleDatabase($value, $company_name, $directory_name, $email)
    {
        $model = new Form();
        $model->Insert($company_name, $directory_name, $email, $value);
    }

    public function SearchDatabase($company_name)
    {
        $model = new Form();
        $result = $model->GetMain($company_name);

        if (is_array($result))
        {
            $this->JsonError("companyExist", "Ilyen nevű cég már adott le kérelmet! Ezért kérlek használj másik cégnevet!");
        }
        else
        {
            return true;
        }
    }

    private function GetAllSignature($json)
    {
        $signatureError = "";
        $keys = array_keys($json);
        $names = array();
        $result = array();

        foreach ($keys as $key)
        {
            if (strpos($key, "company_member_fullname") !== false)
            {
                array_push($names, $json[$key]);
            }
        }

        $nameIndex = 0;
        foreach ($keys as $key)
        {
            if (strpos($key, "signature") !== false)
            {
                array_push($result, array($json[$key], $names[$nameIndex]));
                $nameIndex++;
            }
        }

        if (empty($result))
        {
            $this->JsonError("signatureError", "Egy vagy több aláírás hiányzik!");// need to improve this!
        }
        else
        {
            return $result;
        }
    }
}
?>