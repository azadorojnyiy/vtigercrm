<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/vtigercrm/modules/MyModule/MyModule.php";
class MyModule_Test_Dashboard extends Vtiger_IndexAjax_View {

    public function process(Vtiger_Request $request) {

        $currentUser = Users_Record_Model::getCurrentUserModel();
        $viewer = $this->getViewer($request);
        $moduleName = $request->getModule();
        $linkId = $request->get('linkid');

        $listeners = MyModule::getListeners("groupid");
        $programs = MyModule::getPrograms();

        $list = [];
        foreach ($listeners as $listener) {
               $list[]=[
                   "fullname" => $listener["firstname"] ." ".$listener["lastname"],
                   "groupName"=> $programs[$listener["groupid"]]["name"],
                   "phone" => $listener["phone"],
                   "program" => $programs[$listener["groupid"]]["program"],
                   "date" => $programs[$listener["groupid"]]["date"],
                ];
        }

        $widget = Vtiger_Widget_Model::getInstance($linkId, $currentUser->getId());

        $viewer->assign('WIDGET', $widget);
        $viewer->assign('MODULE_NAME', $moduleName);
        $viewer->assign('LIST', $list);
//        $viewer->assign('DUMP', $dump);


        $content = $request->get('content');
        if(!empty($content)) {
            $viewer->view('dashboards/TestContents.tpl', $moduleName);
        } else {
            $viewer->view('dashboards/Test.tpl', $moduleName);
        }
    }
}
