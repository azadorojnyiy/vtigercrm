<?php

// добавляет поле связанное с модулем Группы поле в модуль Контакты.
include_once 'vtlib/Vtiger/Module.php';
require_once('vtlib/Vtiger/Package.php');

$contactsInstance = Vtiger_Module::getInstance('Contacts');


$group_block = new Vtiger_Block();
$group_block->label = 'LBL_CONTACTS_GROUP';
$contactsInstance->addBlock($group_block);

$addedModule = Vtiger_Module::getInstance('MyModule');
$relLabel ='Group';
$contactsInstance->setRelatedList( $addedModule, $relLabel, Array('ADD', 'SELECT'));

$group_field = new Vtiger_Field();
$group_field->name = 'GroupId';
$group_field->label = 'Group';
$group_field->uitype = 10;
$group_field->summaryfield =1;
$group_field->column = $group_field->name;
$group_field->columntype = 'INT(19)';
$group_field->typeofdata = 'I~M';
$group_block->addField($group_field);
$group_field->setRelatedModules(Array('MyModule'));

// Добавляет обработчик задач
require_once 'include/utils/utils.php';
require 'modules/com_vtiger_workflow/VTEntityMethodManager.inc';

$emm = new VTEntityMethodManager($adb);
$emm->addEntityMethod(
    "MyModule",
    "Test",
    "modules/MyModule/workflow/SetListenersFields.php", "UpdateListenersField");

