<?php
session_start();

if (isset($_POST["filename"]) && isset($_SESSION["userDir"]))
{
    $filename = $_POST["filename"];
}
else
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
if ($name == "none")
{
    $filenamePrefix = $type . "-" . $address[0] . $address[1] . $address[2] . Clean($address[3]) . "-" . $company_name;
}
else
{
    $filenamePrefix = $name . "-" . $type . "-" . $company_name;
}

$storeFolder = "temporary_uploads";

$filePath = dirname( __FILE__ ) . "/" . $storeFolder . "/" . $_SESSION["userDir"] . "/" . $filenamePrefix . "-" . $filename;
$filePath = RemoveSpecial($filePath);

if (file_exists($filePath))
{
    unlink($filePath);
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

function Clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>