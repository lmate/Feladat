<?php
session_start();

if (!isset($_SESSION["userDir"]))
{
    exit();
}

if (!isset($_POST["name"]))
{
    JsonError("noName", "Kérlek először nevet adjál meg!");
}
else if ($_POST["name"] == " ")
{
    JsonError("noName", "Kérlek először nevet adjál meg!");
}
else if ($_POST["name"] != "none" && $_POST["name"] != "ügyvezető")
{
    $nameCheck = explode("-", $_POST["name"]);
    if ($nameCheck[0] == "" || $nameCheck[1] == "")
    {
        JsonError("noName", "Kérlek mind a kettő név mezőt töltsd ki!!");
    }
}

if (!isset($_POST["company_name"]))
{
    JsonError("noCompanyName", "Kérlek először cégnevet adjál meg!");
}
else if ($_POST["company_name"] == "")
{
    JsonError("noCompanyName", "Kérlek először cégnevet adjál meg!");
}

$address = "";
if (!isset($_POST["address"]))
{
    JsonError("noAddress", "Kérlek először címet adjál meg!");
}
else if ($_POST["address"] != "none")
{
    $address = json_decode($_POST["address"], true);

    if ($address[0] == "" || $address[1] == "" || $address[2] == "" || $address[3] == "")
    {
        JsonError("noAddress", "Kérlek először címet adjál meg!");
    }
}

$type = $_POST["type"];
$name = $_POST["name"];
$company_name = $_POST["company_name"];

$filenamePrefix = "";
if ($name == "none" && $address != "none")
{
    $filenamePrefix = $type . "-" . $address[0] . $address[1] . $address[2] . Clean($address[3]) . "-" . $company_name;
}
else
{
    $filenamePrefix = $name . "-" . $type . "-" . $company_name;
}

$storeFolder = "temporary_uploads";

if (!is_dir($storeFolder)) // if temp folder doesnt exist create it
{
    mkdir($storeFolder);
    upload($storeFolder, $filenamePrefix);
}
else
{
    upload($storeFolder, $filenamePrefix);
}

function upload($storeFolder, $filenamePrefix)
{
    if (!empty($_FILES))
    {
        $tempFile = $_FILES["file"]["tmp_name"];
        $targetPath = dirname( __FILE__ ) . "/" . $storeFolder . "/" . $_SESSION["userDir"] . "/";
        $targetFile =  $targetPath. $filenamePrefix . "-" .  $_FILES["file"]["name"];

        if (!is_dir($targetPath))
        {
            mkdir($targetPath);
        }

        if (file_exists(RemoveSpecial($targetFile)))
        {
            $files = scandir($targetPath);

            unset($files[0]);
            unset($files[1]);

            $index = 0;
            foreach ($files as $file)
            {
                $filename = explode(".", $_FILES["file"]["name"]);
                if (strpos($file, $filename[0]) !== false)
                {
                    $index++;
                }
            }

            $duplicatedName = explode(".", $targetFile);
            $targetFile = $duplicatedName[0] . " " . "($index)" . "." .  $duplicatedName[1];
            $targetFile = RemoveSpecial($targetFile);

            move_uploaded_file($tempFile, $targetFile);

            JsonResponse("accepted", "A fájl feltöltése sikeres volt!");
        }
        else
        {
            $targetFile = RemoveSpecial($targetFile);
            move_uploaded_file($tempFile, $targetFile);

            JsonResponse("accepted", "A fájl feltöltése sikeres volt!");
        }
    }
}

function RemoveSpecial($name)
{
    $name = str_replace(" ", "", $name);
    return $name;
}

function JsonError($msg1, $msg2) // Error handler
{
    die(json_encode(array("error" => $msg1, "errorMessage" => $msg2)));
}

function JsonResponse($msg1, $msg2) // Response handler
{
    die(json_encode(array("title" => $msg1, "message" => $msg2)));
}

function Clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>