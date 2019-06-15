<script type="text/javascript">
    Vtiger_Widget_Js('Vtiger_Test_Widget_Js',{},{});
</script>
<div class="dashboardWidgetHeader">
    {include file="dashboards/TestHeader.tpl"|@vtemplate_path:$MODULE_NAME}
</div>
<div class="dashboardWidgetContent">
    {include file="dashboards/TestContents.tpl"|@vtemplate_path:$MODULE_NAME}
</div>
<div class="widgeticons dashBoardWidgetFooter">
    <div class="filterContainer">
        <div class="row">
            <span class="col-lg-5">
                <span class="pull-right">
                    {vtranslate('Expected Close Date', $MODULE_NAME)}   {vtranslate('LBL_BETWEEN', $MODULE_NAME)}
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
        {include file="dashboards/DashboardFooterIcons.tpl"|@vtemplate_path:$MODULE_NAME SETTING_EXIST=true}
    </div>
</div>