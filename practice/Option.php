<?php


namespace Practice;

require_once $_SERVER["DOCUMENT_ROOT"]."/practice/AbstractOption.php";

class Option extends AbstractOption
{
    protected static $table = "vtiger_options";
    protected $searchField = "keyword";
    protected $categoryField = "category";
}
