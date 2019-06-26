<?php
chdir($_SERVER["DOCUMENT_ROOT"]);

require_once "libraries/adodb/adodb-active-recordx.inc.php";
require_once "config.inc.php";
require_once 'include/database/PearDatabase.php';
require_once $_SERVER["DOCUMENT_ROOT"]."/practice/OptionFactory.php";


$cat1Options = \Practice\OptionFactory::build("cat1");
echo $cat1Options->unlimit;
