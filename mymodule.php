<?php
include_once 'vtlib/Vtiger/Module.php';
require_once('vtlib/Vtiger/Package.php');

$Vtiger_Utils_Log = true;

$MODULENAME = 'MyModule';

$oldInstance = Vtiger_Module::getInstance($MODULENAME);
if ($oldInstance) $oldInstance->delete();

$moduleInstance = new Vtiger_Module();
$moduleInstance->name = $MODULENAME;
$moduleInstance->parent = 'Tools';
$moduleInstance->save();
$moduleInstance->initTables();

$info_block = new Vtiger_Block();
$info_block->label = 'LBL_' . strtoupper($moduleInstance->name) . '_INFORMATION';
$moduleInstance->addBlock($info_block);

$contactModule = Vtiger_Module::getInstance('Contacts');
$relLabel ='Contacts';
$moduleInstance->setRelatedList( $contactModule, $relLabel, Array('ADD', 'SELECT'));

$name_filed = new Vtiger_Field();

$name_filed->name = 'name';
$name_filed->label = 'Name';
$name_filed->uitype = 2;
$name_filed->summaryfield =1;
$name_filed->column = $name_filed->name;
$name_filed->columntype = 'VARCHAR(255)';
$name_filed->typeofdata = 'V~M';
$info_block->addField($name_filed);
$moduleInstance->setEntityIdentifier($name_filed);

$date_field = new Vtiger_Field();
$date_field->name = 'date';
$date_field->label = 'Date';
$date_field->uitype = 5;
$date_field->column = $date_field->name;
$date_field->columntype = 'DATE';
$date_field->typeofdata = 'D~O';
$info_block->addField($date_field);

$program_field = new Vtiger_Field();
$program_field->name = 'learning_programs';
$program_field->label = 'Program';
$program_field->uitype = 16;
$program_field->summaryfield =1;
$program_field->column = $program_field->name;
$program_field->columntype = 'VARCHAR(255)';
$program_field->typeofdata = 'V~M';
$info_block->addField($program_field);
$program_field->setPicklistValues(Array(
    'Английский для начинающих',
    'Английский выходного дня',
    'Бизнес-таджикский',
    'Строительный молдавский'));

$order_field = new Vtiger_Field();
$order_field->name = 'listeners';
$order_field->label = 'Listeners';
$order_field->uitype = 1;
$order_field->summaryfield =1;
$order_field->column = $order_field->name;
$order_field->columntype = 'INT(19)';
$order_field->typeofdata = 'I~M';
$info_block->addField($order_field);

$vacancy_field = new Vtiger_Field();
$vacancy_field->name = "vacancy";
$vacancy_field->label = 'Vacancy';
$vacancy_field->uitype = 1;
$vacancy_field->summaryfield =1;
$vacancy_field->column = $vacancy_field->name;
$vacancy_field->columntype = 'VARCHAR(255)';
$vacancy_field->typeofdata = 'V~M';

$info_block->addField($vacancy_field);
$capacity_field = new Vtiger_Field();
$capacity_field->name = 'max_capacity';
$capacity_field->label = 'Maximum capacity';
$capacity_field->uitype = 2;
$capacity_field->summaryfield =1;
$capacity_field->column = $capacity_field->name;
$capacity_field->columntype = 'VARCHAR(255)';
$capacity_field->typeofdata = 'V~M';
$info_block->addField($capacity_field);

$filter1 = new Vtiger_Filter();
$filter1->name = 'All';
$filter1->isdefault = true;
$moduleInstance->addFilter($filter1);
$filter1->addField($name_filed)->addField($date_field,1)->addField($program_field, 2);

//настройка совместного доступа (права доступа устанавливаются по умолчанию).
$moduleInstance->setDefaultSharing();

//инициализация Веб-сервиса (автоматический вызов API)
$moduleInstance->initWebservice();

$package = new Vtiger_Package();
$package->export($moduleInstance, 'test/vtlib', 'classesModule.zip', false);