<?php
define("WEBROOT", str_replace("/adminpanel/index.php", "/adminpanel/", $_SERVER["SCRIPT_NAME"]));
define("ROOT", str_replace("/adminpanel/index.php", "/adminpanel/", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . "Config/core.php");

require(ROOT . "Router.php");
require(ROOT . "Request.php");
require(ROOT . "Dispatcher.php");

$dispatch = new Dispatcher();
$dispatch->Dispatch();
?>