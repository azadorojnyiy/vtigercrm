<strong> </strong>


<table class="table table-bordered">
    <thead>
    <tr>
        <td class="fieldLabel medium"><strong>{vtranslate('LBL_FULL_NAME', $MODULE_NAME)}</strong></td>
        <td class="fieldLabel medium"><strong>{vtranslate('LBL_PHONE', $MODULE_NAME)}</strong></td>
        <td class="fieldLabel medium"><strong>{vtranslate('LBL_GROUP_NAME', $MODULE_NAME)}</strong></td>
        <td class="fieldLabel medium"><strong>{vtranslate('LBL_PROGRAM', $MODULE_NAME)}</strong></td>
        <td class="fieldLabel medium"><strong>{vtranslate('LBL_DATE', $MODULE_NAME)}</strong></td>

    </tr>
    </thead>
    {foreach from=$LIST item=listener}
        <tr>

            <td>{$listener["fullname"]}</td>
            <td>{$listener["phone"]}</td>
            <td>{$listener["groupName"]}</td>
            <td>{$listener["program"]}</td>
            <td>{$listener["date"]}</td>

        </tr>
    {/foreach}
</table>
{*{$DUMP|@debug_print_var}*}