<?php /* Smarty version Smarty-3.1.7, created on 2019-06-14 20:08:26
         compiled from "C:\OpenServer\OSPanel\domains\SalesP\vtigercrm\includes\runtime/../../layouts/v7\modules\MyModule\dashboards\TestContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92455d03d48a4de680-48099444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ac33d1a51591c71602734071bd3f3ceaf4fc2bf' => 
    array (
      0 => 'C:\\OpenServer\\OSPanel\\domains\\SalesP\\vtigercrm\\includes\\runtime/../../layouts/v7\\modules\\MyModule\\dashboards\\TestContents.tpl',
      1 => 1560526003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92455d03d48a4de680-48099444',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'LIST' => 0,
    'listener' => 0,
    'DUMP' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5d03d48a5a971',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d03d48a5a971')) {function content_5d03d48a5a971($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_debug_print_var')) include 'C:\\OpenServer\\OSPanel\\domains\\SalesP\\vtigercrm\\libraries\\Smarty\\libs\\plugins\\modifier.debug_print_var.php';
?><strong> </strong>


<table class="table table-bordered">
    <thead>
    <tr>
        <td class="fieldLabel medium"><strong><?php echo vtranslate('LBL_FULL_NAME',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td>
        <td class="fieldLabel medium"><strong><?php echo vtranslate('LBL_PHONE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td>
        <td class="fieldLabel medium"><strong><?php echo vtranslate('LBL_GROUP_NAME',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td>
        <td class="fieldLabel medium"><strong><?php echo vtranslate('LBL_PROGRAM',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td>
        <td class="fieldLabel medium"><strong><?php echo vtranslate('LBL_DATE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td>

    </tr>
    </thead>
    <?php  $_smarty_tpl->tpl_vars['listener'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['listener']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['listener']->key => $_smarty_tpl->tpl_vars['listener']->value){
$_smarty_tpl->tpl_vars['listener']->_loop = true;
?>
        <tr>

            <td><?php echo $_smarty_tpl->tpl_vars['listener']->value["fullname"];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['listener']->value["phone"];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['listener']->value["groupName"];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['listener']->value["program"];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['listener']->value["date"];?>
</td>

        </tr>
    <?php } ?>
</table>
<?php echo smarty_modifier_debug_print_var($_smarty_tpl->tpl_vars['DUMP']->value);?>
<?php }} ?>