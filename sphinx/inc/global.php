<?php
ini_set("display_errors","on");
error_reporting(E_ALL ^ E_NOTICE);

!defined("FROOT") && define("FROOT",dirname(dirname(__FILE__)));
include_once(FROOT.'/inc/config.php');
include_once(FROOT.'/inc/mysqlClass.php');
include_once(FROOT.'/inc/function.php');
include_once(FROOT.'/inc/sphinxapi.php');
