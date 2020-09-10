<?php

class Filler
{
    private $templateFolder;
    private $outputFolder;
    private $templateType;
    private $templateFile;
    private $templatePlaceholders;
    private $data;
    private $underline;
    private $isDownload = false;
    private $randomNumber;

    function __construct($templateFolder, $outputFolder, $templateType, $data)
    {
        $this->templateFolder = $templateFolder;
        $this->outputFolder = $outputFolder;
        $this->templateType = $templateType;
        $this->data = $data;
        $this->randomNumber = rand(111111, 999999);
    }

    public function GetTemplate()
    {
        $this->templateFile = $this->templateType . ".docx";
        if (file_exists($this->templateFolder . "/" . $this->templateFile))
        {
            $this->templatePlaceholders = $this->templateType . ".php";
        }
        else
        {
            $this->JsonError("cantFindTemplate", "Hiba történt a dokumentum kitöltése/készítése során!");
        }
    }

    public function FillDocument()
    {
        include $this->templatePlaceholders;

        if (!file_exists($this->outputFolder))
        {
            mkdir($this->outputFolder);
        }

        $fileName = $this->templateType . $this->randomNumber . ".docx";
        $fullPath = $this->outputFolder . "/" . $fileName;

        try
        {
            // Copy the Template file to the Result Directory
            copy($this->templateFolder . "/" . $this->templateFile, $fullPath);
        
            // add class Zip Archive
            $zip_val = new ZipArchive;
        
            // Docx file is nothing but a zip file. Open this Zip File
            if($zip_val->open($fullPath) == true)
            {
                // In the Open XML Wordprocessing format content is stored.
                // In the document.xml file located in the word directory.

                $key_file_name = "word/document.xml";
                $message = $zip_val->getFromName($key_file_name);
                
                if (!is_array($this->data))
                {
                    $this->data = array($this->data);
                }

                // this data Replace the placeholders with actual values
                foreach ($placeholders as $key)
                {
                    $message = str_replace($key, $this->data[$key], $message);
                }
                
                // Replace the content with the new content created above.
                $zip_val->addFromString($key_file_name, $message);
                $zip_val->close();

                if ($this->isDownload)
                {
                    JsonResponse("prepare", $fullPath);
                }
            }
        }
        catch (Exception $e) 
        {
            $this->JsonError("cantFindTemplate", "Hiba történt a dokumentum létrehozása során!");
        }
    }

    public function MakeDocument()
    {
        $fileName = $this->templateType . $this->randomNumber . ".docx";
        $fullPath = $this->outputFolder . "/" . $fileName;

        include $this->templatePlaceholders;

        if (!file_exists($this->outputFolder))
        {
            mkdir($this->outputFolder);
        }
    }

    public function SetOldJsonData($company)
    {
        $this->company = $company;
    }

    public function SetDownload($bool)
    {
        $this->isDownload = $bool;
    }

    private function JsonError($msg1, $msg2) // Error handler
    {
        die(json_encode(array("error" => $msg1, "errorMessage" => $msg2)));
    }

    private function JsonResponse($msg1, $msg2) // Response handler
    {
        die(json_encode(array("title" => $msg1, "message" => $msg2)));
    }
}
?>