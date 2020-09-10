<?php
session_start();
if (!isset($_SESSION["userDir"]))
{
    exit();
}

require "Handler.php";
require "SaveHandler.php";

header("Content-Type: application/json"); // Setting content type to application/json

function JsonError($msg1, $msg2) // Error handler
{
    die(json_encode(array("error" => $msg1, "errorMessage" => $msg2)));
}

function JsonResponse($msg1, $msg2) // Response handler
{
    die(json_encode(array("title" => $msg1, "message" => $msg2)));
}

if(strcasecmp($_SERVER["REQUEST_METHOD"], "POST") != 0) // Throw error if request is not POST
{
    JsonError("exception", "Not valid request method!");
}

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "";
if(strcasecmp($contentType, "application/json") != 0) // Throw error if content is application/json
{
    JsonError("exception", "Not valid content type!");
}

$content = trim(file_get_contents("php://input")); // Getting rid of any whitespace and getting that juicy json content
$decoded = json_decode($content, true); // Decoding json content

if (!is_array($decoded)) 
{
    JsonError("exception", "Not valid content type!");
}

switch ($decoded[0]["type"])
{
    case "save":
        $saveHandler = new SaveHandler($decoded[1]["id"]);
        $saveHandler->SetPageContent($decoded[1]["page"]);
        $saveHandler->SetSaveFolder("saves");
        $saveHandler->Save();
        break;
    /*case "load": Maybe this should run with index.php that way maybe and I hope that I dont need to reinit everything
        $saveHandler = new SaveHandler($decoded[1]["id"]);
        $saveHandler->SetSaveFolder("saves");
        $saveHandler->LoadSave();
        break;*/
    case "nameCheck":
        $handler = new Handler("none", "none", "none");
        $handler->SearchDatabase($decoded[1]["company_name"]);
        break;
    case "evidence":
        $tempFolder = "temporary_result";
        $filler = new Filler("templates", $tempFolder, "ingatlan_használati_jogosultság_igazolása_kft", $decoded[1]);
        $filler->GetTemplate();
        $filler->SetDownload(true);
        $filler->FillDocument();
        break;
    case "manager":
        $tempFolder = "temporary_result";
        $filler = new Filler("templates", $tempFolder, "ügyvezető_elfogadó_nyilatkozat_kft", $decoded[1]);
        $filler->GetTemplate();
        $filler->SetDownload(true);
        $filler->FillDocument();
        break;
    case "submit":
        $userDir = $_SESSION["userDir"]; // getting user directory

        $targetDir = "UserAttachments";
        $storeFolder = "temporary_uploads";

        $companyDirName = $decoded[1]["company_name"];
        $companyDirName = str_replace(" ", "", $companyDirName);

        $newDirName = date("Y-m-d") . "-" . $companyDirName;
        $targetPath = "../adminpanel/" . $targetDir . "/" . $newDirName; // target path where we need to move the user directory
        $userPath = dirname( __FILE__ ) . "/" . $storeFolder . "/" . $userDir; // full path of user directory

        $handler = new Handler($decoded[1]["args"], $userPath, $newDirName);
        $handlerResponse = $handler->HandleForm();

        if ($handlerResponse == true)
        {
            // we are moving the userfiles after validation (2020.07.31) Attila

            if (rename($userPath, $targetPath)) // if fails might have permission issue
            {
                JsonResponse("submitted", "Sikeresen elküldted a kérvényed! Nemsokára kapsz róla egy emailt.");
            }
            else
            {
                JsonError("cantReadDir", "Nem tudtam átmozgatni a mappát!");
            }
        }
        break;
}

/*if ( == "save")
{
    $saveHandler = new SaveHandler($decoded[1]["id"]);
    $saveHandler->SetPageContent($decoded[1]["page"]);
    $saveHandler->SetSaveFolder("saves");
    $saveHandler->Save();
}
else if ($decoded[0]["type"] == "load")
{
    $saveHandler = new SaveHandler($decoded[1]["id"]);
    $saveHandler->SetSaveFolder("saves");
    $saveHandler->LoadSave();
}
else if ($decoded[0]["type"] == "nameCheck")
{
    $handler = new Handler("none", "none", "none");
    $handler->SearchDatabase($decoded[1]["company_name"]);
}
else if ($decoded[0]["type"] == "evidence")
{
    $tempFolder = "temporary_result";
    $filler = new Filler("templates", $tempFolder, "ingatlan_használati_jogosultság_igazolása_kft", $decoded[1]);
    $filler->GetTemplate();
    $filler->SetDownload(true);
    $filler->FillDocument();
}
else if ($decoded[0]["type"] == "manager")
{
    $tempFolder = "temporary_result";
    $filler = new Filler("templates", $tempFolder, "ügyvezető_elfogadó_nyilatkozat_kft", $decoded[1]);
    $filler->GetTemplate();
    $filler->SetDownload(true);
    $filler->FillDocument();
}
else
{
    $userDir = $_SESSION["userDir"]; // getting user directory

    $targetDir = "UserAttachments";
    $storeFolder = "temporary_uploads";

    $companyDirName = $decoded[1]["company_name"];
    $companyDirName = str_replace(" ", "", $companyDirName);

    $newDirName = date("Y-m-d") . "-" . $companyDirName;
    $targetPath = "../adminpanel/" . $targetDir . "/" . $newDirName; // target path where we need to move the user directory
    $userPath = dirname( __FILE__ ) . "/" . $storeFolder . "/" . $userDir; // full path of user directory

    $handler = new Handler($decoded[1]["args"], $userPath, $newDirName);
    $handlerResponse = $handler->HandleForm();

    if ($handlerResponse == true)
    {
        // we are moving the userfiles after validation (2020.07.31) Attila

        if (rename($userPath, $targetPath)) // if fails might have permission issue
        {
            JsonResponse("submitted", "Sikeresen elküldted a kérvényed! Nemsokára kapsz róla egy emailt.");
        }
        else
        {
            JsonError("cantReadDir", "Nem tudtam átmozgatni a mappát!");
        }
    }
}*/

?>