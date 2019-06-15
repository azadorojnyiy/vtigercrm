<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/vtigercrm/modules/MyModule/MyModule.php";

function dump($text)
{
    $file = $_SERVER["DOCUMENT_ROOT"]."/vtigercrm/logs/application.log";
    $mes= "test: ". $text. "\r\n";
    return file_put_contents($file, $mes, FILE_APPEND);
}

function UpdateListenersField($entity){
    // WS id
//    dump("enter ");
    $ws_id = $entity->getId();
//    dump("id ".$ws_id);
    $module = $entity->getModuleName();
//        dump("module ".$module);

    if (empty($ws_id) || empty($module)) {
       dump("no ws_id");
       return;
    }

    // CRM id
    $crmid = vtws_getCRMEntityId($ws_id);
//        dump("crm ".$crmid);

    if ($crmid <= 0) {
        dump("no crm_id");

        return;
    }

    //получение объекта со всеми данными о текущей записи Модуля "MyModule"
    $myModuleInstance = Vtiger_Record_Model::getInstanceById($crmid);

    //получение id Заказа
    $recordId = $myModuleInstance->get("id");

//    dump("id :".$recordId);
    $max = $myModuleInstance->get("max_capacity");
//    dump("max :".$max);

        //получение количество слушателей
     $count = MyModule::getListenersCount($recordId);
//        dump("listeners: ".$count);
        $vacancy =$max - $count;
//   dump("vacancy :". $vacancy);
//        //объект в режиме редактирования

        $myModuleInstance->set('mode', 'edit');

   dump("edit :");
        $myModuleInstance->set('listeners', $count);
        $myModuleInstance->set('vacancy', $vacancy);

        //сохранение
        $myModuleInstance->save();
//    }
}