<?php
class Kft
{
    public function GetCompanyBasic($json)
    {
        $time = "határozatlan";
        if (isset($json["company_time_known"]) && $json["company_time_known"] == "on")
        {
            $time = $json["company_time1"] . "," . $json["company_time2"];
        }

        $result = array(
           "type" => $json["company_type"],
           "name" => $json["company_name"],
           "sName" => $json["company_short_name"],
           "fName" => $json["company_foreign_name"],
           "sfName" => $json["company_short_foreign_name"],
           "zip" => $json["company_seat_zip"],
           "city" => $json["company_seat_city"],
           "address" => $json["company_seat_address"],
           "address2" => $json["company_seat_address2"],
           "time" => $time,
           "money" => $json["money_sum"],
           "business" => array($json["company_business"], $json["company_other_business"])
        );
        return $result;
    }

    public function GetCompanySites($json)
    {
        $result = array();

        for ($i = 1; $i < $json["company_site_num"] + 1; $i++)
        {
            $site = array(
                "zip" => $json["company_site_zip_".$i],
                "city" => $json["company_site_city_".$i],
                "address" => $json["company_site_address_".$i],
                "address2" => $json["company_site_address2_".$i]
            );

            $result["site_".$i] = $site;
        }
        
        return $result;
    }

    public function GetCompanyBranches($json)
    {
        $result = array();

        for ($i = 1; $i < $json["company_branch_num"] + 1; $i++)
        {
            $site = array(
                "zip" => $json["company_branch_zip_".$i],
                "city" => $json["company_branch_city_".$i],
                "address" => $json["company_branch_address_".$i],
                "address2" => $json["company_branch_address2_".$i]
            );

            $result["branch_".$i] = $site;
        }
        
        return $result;
    }

    public function GetCompanyOptions($json)
    {
        $option1_2 = array();
        if (isset($json["company-option1"]) && $json["company-option1"] == "on")
        {
            if (isset($json["company-option2-2"]) && $json["company-option2-2"] == "on")
            {
                $option1_2["occurence"] = $json["company-option2-3"];
            }
            
            $option1_2["amount"] = $json["company-option2-4"];
        }
        else
        {
            $option1_2 = 0;
        }

        $option3 = array();
        if ($json["company-option3"] == "on")
        {
            $option3["yesOrNo"] = 1;
        }
        else
        {
            $option3["yesOrNo"] = 0;
        }

        $option4 = array(
            "select1" => $json["company-option4"],
            "select2" => $json["company-option4-2"]
        );

        $option5 = array();
        if ($json["company-option5"] == "on")
        {
            $option5["company-option5"] = 1;
        }
        else
        {
            $option5["month"] = $json["company-option5-month"];
            $option5["day"] = $json["company-option5-day"];
        }

        $option6 = array();
        if (isset($json["company-option6"]) && $json["company-option6"] == "on")
        {
            $option6["yesOrNo"] = 1;
        }
        else
        {
            $option6["yesOrNo"] = 0;
        }

        $option7 = array();
        if (isset($json["company-option7"]) && !isset($json["company-option7-2"]))
        {
            $option7["company-option7"] = 1;
            $option7["company-option7-2"] = 0;
        }
        else if (!isset($json["company-option7"]) && isset($json["company-option7-2"]))
        {
            $option7["company-option7"] = 0;
            $option7["company-option7-2"] = 1;
        }
        else
        {
            $option7["company-option7"] = 1;
            $option7["company-option7-2"] = 1;
        }

        $option8 = array();
        if ($json["company-option8"] == "on")
        {
            $option8["occurence"] = 0; // 0 means default (at least once)
        }
        else if ($json["company-option8-2"] == "on")
        {
            $option8["occurence"] = $json["company-option2-3"];
        }

        if ($json["company-option8-3"] == "on")
        {
            $option8["place"] = 0; // 0 means default (company seat)
        }
        else
        {
            $option8["place"] = array(
                "zip" => $json["company-option8-zip"],
                "city" => $json["company-option8-city"],
                "address" => $json["company-option8-address"],
                "address2" => $json["company-option8-address2"]
            );
        }

        $option9 = array();
        if ($json["company_boss_num"] == 0)
        {
            $option9["boss"] = 0;
        }
        else
        {
            for ($i = 1; $i < $json["company_boss_num"] + 1; $i++)
            {
                $boss = array(
                    "fName" => $json["boss_firstname_".$i],
                    "lName" => $json["boss_lastname_".$i],
                    "fullName" => $json["boss_fullname_".$i],
                    "country" => $json["boss_country_".$i],
                    "zip" => $json["boss_zip_".$i],
                    "city" => $json["boss_city_".$i],
                    "address" => $json["boss_address_".$i],
                    "address2" => $json["boss_address2_".$i],
                    "time" => $json["boss_time_".$i],
                    "time2" => $json["boss_time2_".$i]
                );

                $option9["boss"]["boss_".$i] = $boss;
            }
        }

        if (isset($json["company-option9"]) && $json["company-option9"] == "on")
        {
            $option9["yesOrNo"] = 1;
        }
        else
        {
            $option9["yesOrNo"] = 0;
        }

        $option10 = array();
        if (isset($json["company-option10"]) && $json["company-option10"] == "on")
        {
            $option10["yesOrNo"] = 1;
            for ($i = 1; $i < 4; $i++)
            {
                $supervisor = array(
                    "fName" => $json["company_supervisor_firstname_".$i],
                    "lName" => $json["company_supervisor_lastname_".$i],
                    "fullName" => $json["company_supervisor_fullname_".$i],
                    "country" => $json["company_supervisor_country_".$i],
                    "zip" => $json["company_supervisor_zip_".$i],
                    "city" => $json["company_supervisor_city_".$i],
                    "address" => $json["company_supervisor_address_".$i],
                    "address2" => $json["company_supervisor_address2_".$i]
                );

                $option10["supervisors"]["supervisor_".$i] = $supervisor;
            }
        }
        else
        {
            $option10["yesOrNo"] = 0;
            $option10["supervisors"] = 0;
        }

        $option11 = array();
        if (isset($json["company-option11"]) && $json["company-option11"] == "on")
        {
            $option11["yesOrNo"] = 1;
        }
        else
        {
            $option11["yesOrNo"] = 0;
        }
     
        $result = array(
            "option1-2" => $option1_2,
            "option3" => $option3,
            "option4" => $option4,
            "option5" => $option5,
            "option6" => $option6,
            "option7" => $option7,
            "option8" => $option8,
            "option9" => $option9,
            "option10" => $option10,
            "option11" => $option11
        );

        return $result;
    }

    public function GetCompanyMembers($json)
    {
        $result = array();

        for ($i = 1; $i < $json["company_member_num"] + 1; $i++)
        {
            $member = "";
            if ($json["company_member_type_".$i] == "Magánszemély")
            {
                $time = "határozatlan";
                if (isset($json["company_member_boss_time_unknown_".$i]) && $json["company_member_boss_time_unknown_".$i] != "on")
                {
                    $time = $json["company_member_boss_time_knowndate_".$i] . "," . $json["company_member_boss_time_knowndate2_".$i];
                }

                $paymentType = "A cég számlájára utalja át";
                if ($json["company_member_pay_bank_".$i] != "on")
                {
                    $paymentType = "A cég házipénztárjába fizeti be";
                }

                $paymentTime = "";
                if (isset($json["company_member_money_payment_time_$i"]))
                {
                    $paymentTime = $json["company_member_money_payment_time_$i"];
                }

                $member = array(
                    "manager" => $json["company_member_boss_".$i],
                    "managerOption1" => $json["company_member_boss_manager_".$i],
                    "managerOption2" => $json["company_member_boss_manager_self_".$i],
                    "managerTime" => $time,
                    "memberType" => $json["company_member_type_".$i],
                    "fName" => $json["company_member_firstname_".$i],
                    "lName" => $json["company_member_lastname_".$i],
                    "fullName" => $json["company_member_fullname_".$i],
                    "birthDate" => $json["company_member_date_".$i],
                    "birthPlace" => $json["company_member_birthplace_".$i],
                    "idType" => $json["company_member_id_".$i],
                    "idNumber" => $json["company_member_idnumber_".$i],
                    "email" => $json["company_member_email_".$i],
                    "phone" => $json["company_member_phone_".$i],
                    "email2" => $json["company_member_email2_".$i],
                    "money" => $json["company_member_money_".$i],
                    "moneyHalf" => $json["company_member_money_half_".$i],
                    "paymentType" => $paymentType,
                    "paymentTime" => $paymentTime,
                    "paymentPercent" => $json["company_member_money_percent_$i"],
                    "vatNumber" => $json["company_member_vatnumber_".$i],
                    "mName" => $json["company_member_mothername_".$i],
                    "country" => $json["company_member_country_".$i],
                    "zip" => $json["company_member_zip_".$i],
                    "city" => $json["company_member_city_".$i],
                    "address" => $json["company_member_address_".$i],
                    "address2" => $json["company_member_address2_".$i]
                );

                $money2 = "";
                $member["money2"] = $money2;
                if ($json["company_member_money2_".$i] != "")
                {
                    $money2 = $json["company_member_money2_".$i];
                    $member["money2"] = $money2;
                }

                $money2PaymentType = "Alapításkor rendelkezésre bocsátja";
                if ($json["company_member_pay_atstart_".$i] != "on")
                {
                    $money2PaymentType = "Eddig bocsátja rendelkezésre be";
                    $member["money2PaymentType"] = $money2PaymentType;
                    $member["money2PaymentTime"] = $json["company_member_pay_afterstart_time_".$i];
                }
            }
            else
            {
                $time = "határozatlan";
                if (isset($json["company_member_boss_time_unknown_".$i]) && $json["company_member_boss_time_unknown_".$i] != "on")
                {
                    $time = $json["company_member_boss_time_knowndate_".$i] . "," . $json["company_member_boss_time_knowndate2_".$i];
                }

                $member = array(
                    "manager" => $json["company_member_boss_".$i],
                    "managerOption1" => $json["company_member_boss_manager_".$i],
                    "managerOption2" => $json["company_member_boss_manager_self_".$i],
                    "managerTime" => $time,
                    "memberType" => $json["company_member_type_".$i],
                    "cNumber" => $json["company_member_company_number_".$i],
                    "zip" => $json["company_seat_type2_zip_".$i],
                    "city" => $json["company_seat_type2_city_".$i],
                    "address" => $json["company_seat_type2_address_".$i],
                    "address2" => $json["company_seat_type2_address2_".$i],
                    "fName" => $json["company_member_type2_firstname_".$i],
                    "lName" => $json["company_member_type2_lastname_".$i],
                    "fullName" => $json["company_member_type2_fullname_".$i],
                    "country" => $json["company_member_type2_country_".$i],
                    "zip2" => $json["company_member_type2_zip_".$i],
                    "city2" => $json["company_member_type2_city_".$i],
                    "address2" => $json["company_member_type2_address_".$i],
                    "address2-2" => $json["company_member_type2_address2_".$i]
                );

                // This is just for to not get undefined index (2020.09.04) Attila
                $member["money"] = "";
                $member["moneyHalf"] = "";
                $member["money2"] = "";
                $member["paymentTime"] = "";
                $member["paymentPercent"] = "";
            }

            $result["member_".$i] = $member;
        }
        
        return $result;
    }

    public function GetCompanyManagers($json)
    {
        $result = array();

        for ($i = 1; $i < $json["company_manager_num"] + 1; $i++)
        {
            $manager = "";
            if ($json["manager_type_".$i] == "Magánszemély")
            {
                $manager = array(
                    "managerType" => $json["manager_type_".$i],
                    "fName" => $json["manager_firstname_".$i],
                    "lName" => $json["manager_lastname_".$i],
                    "fullName" => $json["manager_fullname_".$i],
                    "country" => $json["manager_country_".$i],
                    "zip" => $json["manager_zip_".$i],
                    "city" => $json["manager_city_".$i],
                    "address" => $json["manager_address_".$i],
                    "address2" => $json["manager_address2_".$i]
                );
            }
            else
            {
                $manager = array(
                    "managerType" => $json["manager_type_".$i],
                    "cNumber" => $json["manager_company_number_".$i],
                    "fName" => $json["manager_type2_firstname_".$i],
                    "lName" => $json["manager_type2_lastname_".$i],
                    "fullName" => $json["manager_type2_fullname_".$i],
                    "country" => $json["manager_type2_country_".$i],
                    "zip" => $json["manager_type2_zip_".$i],
                    "city" => $json["manager_type2_city_".$i],
                    "address" => $json["manager_type2_address_".$i],
                    "address2" => $json["manager_type2_address2_".$i],
                    "zip2" => $json["manager_seat_type2_zip_".$i],
                    "city2" => $json["manager_seat_type2_city_".$i],
                    "address2" => $json["manager_seat_type2_address_".$i],
                    "address2-2" => $json["manager_seat_type2_address2_".$i]
                );
            }

            $result["manager_".$i] = $manager;
        }
        
        return $result;
    }
}
?>