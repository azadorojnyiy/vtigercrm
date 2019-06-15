<?php /* Smarty version Smarty-3.1.7, created on 2019-06-14 20:08:26
         compiled from "C:\OpenServer\OSPanel\domains\SalesP\vtigercrm\includes\runtime/../../layouts/v7\modules\MyModule\dashboards\Test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58315d03d48a2c6338-37597722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54079ab99cc7881abd0932542920ac1d505c4080' => 
    array (
      0 => 'C:\\OpenServer\\OSPanel\\domains\\SalesP\\vtigercrm\\includes\\runtime/../../layouts/v7\\modules\\MyModule\\dashboards\\Test.tpl',
      1 => 1560367334,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58315d03d48a2c6338-37597722',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5d03d48a3ab26',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d03d48a3ab26')) {function content_5d03d48a3ab26($_smarty_tpl) {?><script type="text/javascript">
    Vtiger_Widget_Js('Vtiger_Test_Widget_Js',{},{});
</script>
<div class="dashboardWidgetHeader">
    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/TestHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="dashboardWidgetContent">
    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/TestContents.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="widgeticons dashBoardWidgetFooter">
    <div class="filterContainer">
        <div class="row">
            <span class="col-lg-5">
                <span class="pull-right">
                    <?php echo vtranslate('Expected Close Date',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
   <?php echo vtranslate('LBL_BETWEEN',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                </span>
            </span>
            <span class="col-lg-7">
                <div class="input-daterange input-group dateRange widgetFilter" id="datepicker" name="expectedclosedate">
                    <input type="text" class="input-sm form-control" name="start" style="height:30px;"/>
                    <span class="input-group-addon">to</span>
                    <input type="text" class="input-sm form-control" name="end" style="height:30px;"/>
                </div>
            </span>
        </div>
    </div>
    <div class="footerIcons pull-right">
        <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/DashboardFooterIcons.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SETTING_EXIST'=>true), 0);?>

    </div>
</div><?php }} ?>