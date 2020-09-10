<?php
session_start();
require ROOT . "Model/Admin.php";
require ROOT . "Email/Email.php";

class adminController extends Controller
{
    function login()
    {
        $this->Render("login");
    }

    function HandleLogin()
    {
        if (!isset($_POST["username"]) || !isset($_POST["password"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $user = new Admin();
        $userData = $user->GetUser(trim($_POST["username"]));

        if (password_verify(trim($_POST["password"]), $userData["password"]))
        {
			session_regenerate_id();
            $_SESSION["name"] = $userData["username"];
            $_SESSION["office"] = json_decode($userData["office"], true);
            $_SESSION["permission"] = $userData["permission"];
            $_SESSION["id"] = uniqid();
			header("Location: /adminpanel/admin/home");
        }
        else
        {
            $_SESSION["error"] = "Hibás felhasználónév vagy jelszó!";
            header("Location: /adminpanel/admin/");
        }
    }

    function register()
    {
        $this->Render("register");
    }

    function HandleRegister()
    {
        // handling office reg (2020.08.09) Attila

        if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["office_country"]) || !isset($_POST["office_zip"]) || !isset($_POST["office_city"]) || !isset($_POST["office_address"]) || !isset($_POST["office_address2"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $address = trim($_POST["office_country"]) . " " . trim($_POST["office_zip"]) . " " . trim($_POST["office_city"]) . " " . trim($_POST["office_address"]) . " " . trim($_POST["office_address2"]);

        $user = new Admin();
        $user->InsertOffice($name, $email, $address);

        $plain = uniqid();
        $password = password_hash($plain, PASSWORD_BCRYPT);

        $office = json_encode(array("offices" => array($office)));
        $user->InsertUser($email, $password, $office);

        $config = array(
            "emailusername" => "sattipolo@gmail.com",
            "emailto" => $email,
            "emailsubject" => "Hello menő regisztráció teszt!",
            "emailhost" => "ssl://smtp.gmail.com",
            "emailport" => "465",
            "emailauth" => true,
            "emailpassword" => "guwfvkuenzxcehvp",
            "emailtemplate" => "Hello az én nevem regisztráció teszt örvendek a találkozásnak! A felhasználó neved: $email A jelszavad: $plain Ájánljuk, hogy változtasd meg az első belépés után!",
            "emailattachment" => ""
        );
        
        $email = new Email($config);
        $email->SendEmail();

        header("Location: /adminpanel/admin/home");
    }

    function SendInvite()
    {
        // handling member invite (2020.08.09) Attila

        if (!isset($_POST["email"]) || !isset($_SESSION["id"]) || !isset($_SESSION["office"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $email = trim($_POST["email"]);
        $office = $_SESSION["office"]["offices"][0];

        $user = new Admin();
        $isUserExist = $user->GetUser($email);

        if (is_array($isUserExist) && $isUserExist["office"] == '{"offices":["'.$office.'"]}')
        {
            echo "cantBeInvited";
        }
        else if (is_array($isUserExist) && $isUserExist["office"] == '{"offices":[""]}')
        {
            $new_office = $office = json_encode(array("offices" => array("$office")));
            $user->UpdateOfficeMember($new_office, $email);

            echo "inviteSuccess";

            $config = array(
                "emailusername" => "sattipolo@gmail.com",
                "emailto" => $email,
                "emailsubject" => "Hello menő meghívó teszt!",
                "emailhost" => "ssl://smtp.gmail.com",
                "emailport" => "465",
                "emailauth" => true,
                "emailpassword" => "guwfvkuenzxcehvp",
                "emailtemplate" => "Hello az én nevem meghívó teszt örvendek a találkozásnak! Meghívtak ide: $office. Mivel már létezik fiókod ezért nem kell újra jelszót megadnod!",
                "emailattachment" => ""
            );
            
            $email = new Email($config);
            $email->SendEmail();
        }
        else
        {
            $invite_id = uniqid();
            $user->InsertInvite($email, $office, $invite_id);

            echo "inviteSuccess";

            $config = array(
                "emailusername" => "sattipolo@gmail.com",
                "emailto" => $email,
                "emailsubject" => "Hello menő meghívó teszt!",
                "emailhost" => "ssl://smtp.gmail.com",
                "emailport" => "465",
                "emailauth" => true,
                "emailpassword" => "guwfvkuenzxcehvp",
                "emailtemplate" => "Hello az én nevem meghívó teszt örvendek a találkozásnak! Itt is lenne a híres meghívó kérlek <a href='http://localhost/adminpanel/admin/Invite/$invite_id' target='_blank'>Katt ide!</a>",
                "emailattachment" => ""
            );
            
            $email = new Email($config);
            $email->SendEmail();
        }
    }

    function Invite($id)
    {
        // handling member invite (2020.08.09) Attila

        if ($id == "")
        {
            header("Location: /adminpanel/admin/home");
        }

        $user = new Admin();
        $userData["userData"] = $user->GetInvite($id);

        $this->Set($userData);
        $this->Render("newmember");
    }

    function ActivateInvite()
    {
        // handling member invite (2020.08.09) Attila

        if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["office"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $username = $_POST["username"];
        $password = trim($_POST["password"]);
        $office = $_POST["office"];

        $user = new Admin();
        $user->UpdateInvite($username);

        $password = password_hash($password, PASSWORD_BCRYPT);

        $office = json_encode(array("offices" => array($office)));
        $user->InsertUser($username, $password, $office);

        echo "joinSuccess";

        $config = array(
            "emailusername" => "sattipolo@gmail.com",
            "emailto" => $username,
            "emailsubject" => "Hello menő sikeres csatlakozás teszt!",
            "emailhost" => "ssl://smtp.gmail.com",
            "emailport" => "465",
            "emailauth" => true,
            "emailpassword" => "guwfvkuenzxcehvp",
            "emailtemplate" => "Hello az én nevem sikeres csatlakozás teszt örvendek a találkozásnak! Sikeresen sikerült csatlakoznod a következő irodához: $office",
            "emailattachment" => ""
        );
        
        $email = new Email($config);
        $email->SendEmail();

        //$_SESSION["error"] = "Sikeresen csatlakoztál most jelentkezz be!";
    }

    function DeleteMember()
    {
        // handling member remove (2020.08.10) Attila

        if (!isset($_POST["username"]) || !isset($_SESSION["office"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $username = $_POST["username"];
        $new_office = $office = json_encode(array("offices" => array("")));

        $user = new Admin();
        $user->UpdateOfficeMember($new_office, $username);

        echo "deleteSuccess";

        $config = array(
            "emailusername" => "sattipolo@gmail.com",
            "emailto" => $username,
            "emailsubject" => "Hello menő sikeres törlés teszt!",
            "emailhost" => "ssl://smtp.gmail.com",
            "emailport" => "465",
            "emailauth" => true,
            "emailpassword" => "guwfvkuenzxcehvp",
            "emailtemplate" => "Hello az én nevem sikeres törlés teszt örvendek a találkozásnak! A következő irodából töröltek téged: $office. Ezek után amíg nem hívnak meg egy új irodába sajnos nem nagyon fogsz tudni mit csinálni!",
            "emailattachment" => ""
        );
        
        $email = new Email($config);
        $email->SendEmail();
    }

    function ChangePermission()
    {
        // handling member perm change (2020.08.10) Attila

        if (!isset($_POST["username"]) || !isset($_POST["permission"]) || !isset($_SESSION["office"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $username = $_POST["username"];
        $new_perm = $_POST["permission"];

        $user = new Admin();
        $user->UpdateOfficeMemberPerm($username, $new_perm);

        echo "permSuccess";
    }

    function ChangePassword()
    {
        // handling password change (2020.08.09) Attila

        if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }
        else if ($_POST["password"] == "")
        {
            echo "emptyPass";
            exit();
        }

        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        $user = new Admin();

        $password = password_hash($password, PASSWORD_BCRYPT);

        $user->UpdatePassword($username, $password);

        echo "changeSuccess";

        $config = array(
            "emailusername" => "sattipolo@gmail.com",
            "emailto" => $username,
            "emailsubject" => "Hello menő jelszó változtatás teszt!",
            "emailhost" => "ssl://smtp.gmail.com",
            "emailport" => "465",
            "emailauth" => true,
            "emailpassword" => "guwfvkuenzxcehvp",
            "emailtemplate" => "Hello az én nevem jelszó változtatás teszt örvendek a találkozásnak! A felhasználó neved: $username A jelszavadat megváltoztatták a main napon ha nem te voltál vagy az irodád akkor azonnal jelezd!",
            "emailattachment" => ""
        );
        
        $email = new Email($config);
        $email->SendEmail();
    }

    function ChangePhone()
    {
        // handling office phone change (2020.08.14) Attila

        if (!isset($_SESSION["office"]) || !isset($_POST["phone"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $office = $_SESSION["office"]["offices"][0];
        $phone = $_POST["phone"];

        $user = new Admin();
        $user->UpdateOfficePhone($office, $phone);

        echo "phoneSuccess";
    }

    function ChangePostAddress()
    {
        // handling office post address change (2020.08.14) Attila

        if (!isset($_SESSION["office"]) || !isset($_POST["address"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $office = $_SESSION["office"]["offices"][0];
        $address = $_POST["address"];

        $user = new Admin();
        $user->UpdateOfficePostAddress($office, $address);

        echo "addressSuccess";
    }

    function SaveDocument() // Document saving (2020.07.31) Attila
    {
        if (!isset($_POST["myDoc"]) || !isset($_SESSION["htmlDocName"]))
        {
            header("Location: /adminpanel/admin/home");
        }
        else
        {
            $html = $_POST["myDoc"];
            if (file_put_contents($_SESSION["htmlDocName"], $html))
            {
                unset($_SESSION["htmlDocName"]);
                echo "saved";
            }
            else
            {
                echo "error";
            }
        }
    }

    function home()
    {
        if (isset($_SESSION["company_name"]))
        {
            unset($_SESSION["company_name"]);
        }

        $tempFolder = "TempDownload";
        // code to delete zip files older than on hour (2020.08.26) Attila
        if (!is_dir($tempFolder)) // if temp folder doesnt exist create it
        {
            mkdir($tempFolder);
        }
        else
        {
            $files = scandir($tempFolder);
            unset($files[0]);
            unset($files[1]);

            foreach ($files as $file)
            {
                $filename = $file;
                $fileTimeStamp = filemtime($tempFolder . "/" . $filename);
                $nowTimeStamp = $fileTimeStamp + 3600;
                $now = time();

                if ($now >= $nowTimeStamp)
                {
                    if (file_exists($tempFolder . "/" . $filename))
                    {
                        unlink($tempFolder . "/" . $filename);
                    }
                }
            }
        }

        $main = new Admin();
        $mainData["mainData"] = $main->GetMain();
        $mainData2["mainData2"] = 0;

        if (isset($_SESSION["name"]))
        {
            $mainData2["mainData2"] = $main->GetReviewByProfile($_SESSION["name"]);
        }

        $this->Set($mainData);
        $this->Set($mainData2);
        $this->Render("home");
    }

    function company()
    {
        $main = new Admin();

        if (!isset($_SESSION["company_name"]))
        {
            $main->UnderReview($_POST["company_name"], $_POST["review_by"]);
            $mainData["mainData"] = $main->GetCompany($_POST["company_name"]);
        }
        else
        {
            $mainData["mainData"] = $main->GetCompany($_SESSION["company_name"]);
        }

        $this->Set($mainData);
        $this->Render("company");
    }

    function CancelReview()
    {
        if (!isset($_POST["company_name"]) || !isset($_POST["review_by"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $main = new Admin();
        $main->NotUnderReview($_POST["company_name"], $_POST["review_by"]);
        unset($_SESSION["company_name"]);

        header("Location: /adminpanel/admin/home");
    }

    function RejectRequest()
    {
        if (!isset($_SESSION["office"]) || !isset($_POST["company_name"]) || !isset($_POST["company_email"]) || !isset($_POST["comment"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $company_name = $_POST["company_name"];
        $company_email = $_POST["company_email"];
        $under_review = 0;
        $isRejected = 1;
        $isAccepted = 0;
        $comment = $_POST["comment"];

        $main = new Admin();
        $main->UpdateRequest($isRejected, $isAccepted, $under_review, $company_name);
        unset($_SESSION["company_name"]);

        $config = array(
            "emailusername" => "sattipolo@gmail.com",
            "emailto" => $company_email,
            "emailsubject" => "Hello menő elutasított kérelem teszt!",
            "emailhost" => "ssl://smtp.gmail.com",
            "emailport" => "465",
            "emailauth" => true,
            "emailpassword" => "guwfvkuenzxcehvp",
            "emailtemplate" => "Hello az én nevem elutasított kérelem teszt örvendek a találkozásnak! A cégalapítási kérelmedet elutasították! Megjegyzés: $comment",
            "emailattachment" => ""
        );
        
        $email = new Email($config);
        $email->SendEmail();

        header("Location: /adminpanel/admin/home");
    }

    function AcceptRequest()
    {
        if (!isset($_SESSION["office"]) || !isset($_POST["company_name"]) || !isset($_POST["company_email"]) || !isset($_POST["comment"]) || !isset($_SESSION["id"]))
        {
            header("Location: /adminpanel/admin/home");
        }

        $company_name = $_POST["company_name"];
        $company_email = $_POST["company_email"];
        $under_review = 0;
        $isAccepted = 1;
        $isRejected = 0;
        $comment = $_POST["comment"];

        $main = new Admin();
        $main->UpdateRequest($isRejected, $isAccepted, $under_review, $company_name);
        unset($_SESSION["company_name"]);

        $dir = $_SERVER["DOCUMENT_ROOT"] . "/adminpanel/UserAttachments/" . $_SESSION["userDir"];
        $zipFile = "TempDownload/" . $_SESSION["userDir"] . ".zip";

        if ($this->FindAndConvertDocBack() == true)
        {
            $this->MakeZip($dir, $zipFile);

            $config = array(
                "emailusername" => "sattipolo@gmail.com",
                "emailto" => $company_email,
                "emailsubject" => "Hello menő elfogadott kérelem teszt!",
                "emailhost" => "ssl://smtp.gmail.com",
                "emailport" => "465",
                "emailauth" => true,
                "emailpassword" => "guwfvkuenzxcehvp",
                "emailtemplate" => "Hello az én nevem elfogadott kérelem teszt örvendek a találkozásnak! A cégalapítási kérelmedet elfogadták! Megjegyzés: $comment",
                "emailattachment" => $zipFile
            );
            
            $email = new Email($config);
            $email->SendEmail();

            header("Location: /adminpanel/admin/home");
        }
        else
        {
            die("OOOPS");
        }
    }

    function FindAndConvertDocBack()
    {
        // Attachment checking for converting it back to odt or docx if doc was edited (2020.08.18) Attila
        if (isset($_SESSION["userDir"]))
        {
            $userDir = $_SERVER["DOCUMENT_ROOT"] . "/adminpanel/UserAttachments/" . $_SESSION["userDir"];
            $editedDocsDir = $_SERVER["DOCUMENT_ROOT"] . "/adminpanel/TempDocSave";

            $scan = scandir($editedDocsDir);
            $scan2 = scandir($userDir);
            if ($scan != false && $scan2 !== false)
            {
                unset($scan[0]);
                unset($scan[1]);
                unset($scan2[0]);
                unset($scan2[1]);

                foreach ($scan as $dir)
                {
                    if (strpos($dir, $_SESSION["userDir"]) !== false)
                    {
                        $editedDocDir = $_SERVER["DOCUMENT_ROOT"] . "/adminpanel/TempDocSave/" . $dir;
                        $editedFile = scandir($editedDocDir);

                        unset($editedFile[0]);
                        unset($editedFile[1]);

                        //die(var_dump($editedFile));
                        $fileName = explode(".", $editedFile[2]);
                        foreach ($scan2 as $file)
                        {
                            if (strpos($file, $fileName[0]) !== false)
                            {
                                if (php_uname("s") == "Windows NT") // Checking OS
                                {
                                    $convert = 'soffice --convert-to odt --outdir ' . $userDir . '  ' . $editedDocDir . '/' . $editedFile[2];
                                }
                                else
                                {
                                    $convert = 'sudo /usr/bin/soffice --convert-to odt --outdir ' . $userDir . '  ' . $editedDocDir . '/' . $editedFile[0];
                                }

                                if (!shell_exec($convert))
                                {
                                    die("Hibába csúsztam!");
                                }
                                else
                                {
                                    unlink($editedDocDir . '/' . $editedFile[2]);
                                    rmdir($editedDocDir);
                                }
                            }
                        }
                    }
                }

                return true;
            }
            else
            {
                die("Nem tudtam beolvasni a mappát!");
            }
        }
        else
        {
            header("Location: /adminpanel/admin/home");
        }
    }

    function profile()
    {
        if($_SESSION["permission"] == 3)
        {
            $office = new Admin();
            $officeData["officeData"] = $office->GetOffice($_SESSION["office"]["offices"][0]);
            $this->Set($officeData);
        }

        $this->Render("profile");
    }

    function messages()
    {
        $getReviews = new Admin();
        $mainData["mainData"] = $getReviews->GetAppointmentByReview($_SESSION["name"]);

        $this->Set($mainData);
        $this->Render("messages");
    }

    function office()
    {
        $office = new Admin();
        $officeUser["officeUser"] = $office->GetOfficeMembers($_SESSION["office"]["offices"][0]);

        $this->Set($officeUser);
        $this->Render("office");
    }

    function editor()
    {
        $_SESSION["fileToOpen"] = $_POST["file"];
        $this->Render("editor");
    }

    function logout()
    {
        $this->Render("logout");
    }

    function DownloadAttachments()
    {
        // Attachment zipping for download (2020.08.14) Attila
        if (isset($_SESSION["userDir"]))
        {
            $dir = $_SERVER["DOCUMENT_ROOT"] . "/adminpanel/UserAttachments/" . $_SESSION["userDir"];
            $zipFile = "TempDownload/" . $_SESSION["userDir"] . ".zip";

            $this->MakeZip($dir, $zipFile);

            echo $zipFile;
        }
        else
        {
            header("Location: /adminpanel/admin/home");
        }
    }

    function MakeZip($dir, $zipFile)
    {
        // Get real path for our folder
        $rootPath = realpath($dir);

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();
    }

    function Scan()
    {
        if (isset($_SESSION["userDir"]))
        {
            $dir = $_SERVER["DOCUMENT_ROOT"] . "/adminpanel/UserAttachments/" . $_SESSION["userDir"];

            header('Content-type: application/json');

            // Run the recursive function 
            if ($response = $this->scanDir($dir))
            {
                // Output the directory listing as JSON
                echo json_encode(array(
                    "name" => "UserAttachments",
                    "type" => "folder",
                    "path" => $dir,
                    "items" => $response
                ));
            }
            else
            {
                die("Nem tudtam beolvasni a mappát!");
            }
        }
        else
        {
            header("Location: /adminpanel/admin/home");
        }
    }

    // This function scans the files folder recursively, and builds a large array

    function scanDir($dir)
    {
        $files = array();

        // Is there actually such a folder/file?

        if(file_exists($dir)){
        
            foreach(scandir($dir) as $f) {
            
                if(!$f || $f[0] == '.') {
                    continue; // Ignore hidden files
                }

                if(is_dir($dir . '/' . $f)) {

                    // The path is a folder

                    $files[] = array(
                        "name" => $f,
                        "type" => "folder",
                        "path" => $dir . '/' . $f,
                        "items" => $this->Scan($dir . '/' . $f) // Recursively get the contents of the folder
                    );
                }
                
                else {

                    // It is a file

                    $files[] = array(
                        "name" => $f,
                        "type" => "file",
                        "path" => $dir . '/' . $f,
                        "size" => filesize($dir . '/' . $f) // Gets the size of this file
                    );
                }
            }
        
        }

        return $files;
    }
}
?>