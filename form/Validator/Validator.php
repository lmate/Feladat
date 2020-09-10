<?php

class Validator
{
    private $objects;
    private $userDir;
    private $rawSignature;

    function __construct($args, $userDir)
    {
        $args = $this->CleanArgs($args);
        $this->objects = $this->BigData($args);
        $this->userDir = $userDir;
    }

    public function SetRawSignature($signature)
    {
        $this->rawSignature = $signature;
    }

    public function FormValidator()
    {
        return $this->objects;
    }

    private function BigData($args) // Handling dynamically the big amount of data that flows through :c
    {
        $objects = array();

        foreach ($args as $arg)
        {
            $rawData = explode("=", urldecode($arg));
            $objects[$rawData[0]] = $rawData[1];
        }

        return $objects;
    }

    private function CleanArgs($args) // separating the big amount of data to be easily handled
    {
        $newArgs = explode("&", $args);
        return $newArgs;
    }

    public function GetSignature() // Converting Base64 data to be an image
    {
        foreach ($this->rawSignature as $signature)
        {
            $signatureFileName = "aláírásminta.png";

            // removing any unnesecary junk from our beautiful base64
            $signature[0] = str_replace("data:image/png;base64,", "", $signature[0]);
            $signature[0] = str_replace(" ", "+", $signature[0]);

            $data = base64_decode($signature[0]); // decoding base64 to later use it to generate our image
            $file = $this->userDir . "/" . $signature[1] . "." . $signatureFileName;
            file_put_contents($file, $data); // saving generated image
        }
    }

    public function IsUserDirEmpty() // checking if user dir is we dont want any of that :3 (2020.07.31) Attila
    {
        if (!is_dir($this->userDir))
        {
            $this->JsonError("userDirEmpty", "Nem töltöttél fel semmit se kérlek töltsd fel a kötelező fájlokat!");
        }

        $dir = scandir($this->userDir);

        if ($dir == false) // if cant read dir might have permission issues
        {
            $this->JsonError("cantReadDir", "Nem tudtam beolvasni a mappát!");
        }

        unset($dir[0]);
        unset($dir[1]);

        $filenameSubstrings = array(
            "bizonyíték",
            "adókártya",
            "azonosítóokmány",
            "lakcímkártya",
            "ügyvezető"
        );

        if (empty($dir))
        {
            return false;
        }
        else if (!empty($dir))
        {
            return $this->DepthDirSearch($dir, $filenameSubstrings);
        }
        else
        {
            return true;
        }
    }

    private function DepthDirSearch($dir, $filenameSubstrings)
    {
        $dirError = array();

        for ($i=0; $i < count($filenameSubstrings); $i++)
        {
            $found = false;
            foreach ($dir as $file)
            {
                if (strpos($file, $filenameSubstrings[$i]) !== false)
                {
                    $found = true;
                }
            }

            if (!$found)
            {
                array_push($dirError, $filenameSubstrings[$i]." nem található kérlek töltsd fel a hiányzó fájlokat!");
            }
        }

        return $dirError;
    }

    private function JsonError($msg1, $msg2) // Error handler
    {
        die(json_encode(array("error" => $msg1, "errorMessage" => $msg2)));
    }
}
?>