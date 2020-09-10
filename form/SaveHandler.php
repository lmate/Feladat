<?php

class SaveHandler
{
    private $saveId;
    private $pageContent;
    private $saveFolder;

    function __construct($saveId)
    {
        $this->saveId = $saveId;
    }

    public function SetPageContent($pageContent)
    {
        $this->pageContent = $pageContent;
    }

    public function SetSaveFolder($folder)
    {
        $this->saveFolder = $folder;
    }

    public function Save()
    {
        $folderName = substr($this->saveId, 0, 2);
        $folderPath = $this->saveFolder . "/" . $folderName;
        $filePath = $_SERVER["DOCUMENT_ROOT"] . "/form/" . $folderPath . "/" . $this->saveId;

        if (!is_dir($folderPath))
        {
            mkdir($folderPath);
            $model = new Form();
            $model->Save($this->saveId);
        }
        file_put_contents($filePath, $this->pageContent);
    }

    public function LoadSave()
    {
        $folderName = substr($this->saveId, 0, 2);
        $folderPath = $this->saveFolder . "/" . $folderName;
        $filePath = $_SERVER["DOCUMENT_ROOT"] . "/form/" . $folderPath . "/" . $this->saveId;

        $content = "No content: $folderName, $folderPath, $filePath";
        if (file_exists($filePath))
        {
            $content = file_get_contents($filePath);
        }

        $this->JsonResponse("loaded", $content);
    }

    private function JsonResponse($msg1, $msg2) // Response handler
    {
        die(json_encode(array("title" => $msg1, "message" => $msg2)));
    }
}
?>