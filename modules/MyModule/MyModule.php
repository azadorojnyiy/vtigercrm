<?php
include_once 'modules/Vtiger/CRMEntity.php';

class MyModule extends Vtiger_CRMEntity {

    //таблица с полями Модуля
    var $table_name = 'vtiger_mymodule';

    //название ключевого поля в таблице
    var $table_index = 'mymoduleid';

    var $customFieldTable = Array('vtiger_mymodulecf', 'mymoduleid');

    var $tab_name = Array('vtiger_crmentity', 'vtiger_mymodule', 'vtiger_mymodulecf');

    var $tab_name_index = Array('vtiger_crmentity' => 'crmid',
        'vtiger_mymodule' => 'mymoduleid',
        'vtiger_mymodulecf' => 'mymoduleid');


    function vtlib_handler($modulename, $event_type)
    {

        if($event_type == 'module.postinstall') {
            vimport("~~modules/com_vtiger_workflow/include.inc");
            vimport("~~modules/com_vtiger_workflow/tasks/VTEntityMethodTask.inc");
            vimport("~~modules/com_vtiger_workflow/VTEntityMethodManager.inc");
            vimport("~~modules/com_vtiger_workflow/VTTaskManager.inc");

            //создание Менеджера событий
            $vtWorkFlow = new VTWorkflowManager($adb);

            //создание Обработчика
            $myWorkFlow = $vtWorkFlow->newWorkFlow("MyModule");
            $myWorkFlow->test = '';
            $myWorkFlow->description = "Подсчет количества слушателей";
            $myWorkFlow->executionCondition = VTWorkflowManager::$ON_EVERY_SAVE;
            $myWorkFlow->defaultworkflow = 1;

            //сохранение нового обработчика в Менеджере Событий
            $vtWorkFlow->save($myWorkFlow);

            //получение id созданного Обработчика
            $id = $myWorkFlow->id;

            //создание Задачи
            $tm = new VTTaskManager($adb);
            $task = $tm->createTask('VTEntityMethodTask', $id);
            $task->active = true;
            $task->methodName = "SetListenersField";
            $task->subject = "уведомление о изменении поля Слушатели";
            $task->summary = 'Добавления числа подписанных слушателей группы в поле Слушатели';
            $tm->saveTask($task);
        }

    }

    function addField($contacts_)
    {$contactsInstance = Vtiger_Module::getInstance('Contacts');


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
    }
    static function getData($table, $orderBy=null, $sortArray=null)
    {
        global $adb;
        $sql = "SELECT  * FROM ". $table;
        if (!!$sortArray) {
            $sql =$sql. " WHERE ".$sortArray["field"]."=".$sortArray["value"];
        }
        if ($orderBy) {
            $sql =$sql. " ORDER BY " . $orderBy;
        }
        $query = $adb->pquery($sql);
        $count = $adb->num_rows($query);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $data[$i] = $adb->query_result_rowdata($query, $i);
            array_push($result, $data[$i]);
        }
          return $result;

}

    static function getListeners($groupBy = null, $groupId=null)
    {
        if(!$groupId) {
        $arrResult = static::getData( "vtiger_contactdetails", $groupBy);
        }else {
            $arrResult = static::getData( "
                vtiger_contactdetails",
                "groupid",
                ["field"=>"groupid",
                 "value" => $groupId]
                );
        }
        return $arrResult;
    }

    static function getPrograms()
    {
        $arrResult = static::getData( "vtiger_mymodule");
        $result=[];
        foreach ($arrResult as $program) {
            $result[$program["mymoduleid"]] =
                [
                "name" => $program["name"],
                "program" => $program["learning_programs"],
                "date" => $program["date"],
                "vacancy" => $program["vacancy"],
                ];
        }
        return $result;

    }
    static function getListenersCount($groupId)
    {
        global $adb;
        $sql = "SELECT  * FROM vtiger_contactdetails WHERE groupid=$groupId";
        return $adb->num_rows($adb->pquery($sql));
    }


}