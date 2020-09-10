<?php
$tempFolder = "temporary_result";
// code to delete temp res files if they are more than one hour old (2020.08.04) Attila
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

$storeFolder = "temporary_uploads";
// code to delete temp user dirs if they are more than one day old (2020.08.01) Attila
if (!is_dir($storeFolder)) // if temp folder doesnt exist create it
{
    mkdir($storeFolder);
}
else
{
    $dirs = scandir($storeFolder);
    unset($dirs[0]);
    unset($dirs[1]);

    foreach ($dirs as $dir)
    {
        $directory = $dir;
        $dirTimeStamp = filemtime($storeFolder . "/" . $directory);
        $nowTimeStamp = $dirTimeStamp + 86400;
        $now = time();

        if ($now >= $nowTimeStamp)
        {
            $files = scandir($storeFolder . "/" . $dir);
            unset($files[0]);
            unset($files[1]);

            foreach ($files as $file)
            {
                unlink($storeFolder . "/" . $dir . "/" . $file);
            }

            if (file_exists($storeFolder . "/" . $directory))
            {
                rmdir($storeFolder . "/" . $directory);
            }
        }
    }
}
?>