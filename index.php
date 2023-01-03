<?php

session_start();
ob_start();

if(isset($_GET["dev"]))
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);
}
else 
{
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE);
}

ini_set("memory_limit", "1000M");

error_reporting(E_ALL ^ E_NOTICE);

require_once("setting/setting.php");
require_once("system/fw.php");
require_once("system/engine.php");
require_once("system/html.php");
require_once("application/models/m_core.php");

// API
$GLOBALS["API"]['server']	= $data['api']['server'];
$GLOBALS["API"]['key']		= $data['api']['key'];
$GLOBALS["API"]['secret']	= $data['api']['secret'];

// BASE
$GLOBALS["folder"] 			  = $data['setting']['folder'];
$GLOBALS["controller"]		= $data['setting']['controller'];

$fw = new fw();
?>
