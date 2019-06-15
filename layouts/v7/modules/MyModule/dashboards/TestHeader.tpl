{foreach key=index item=cssModel from=$STYLES}
    <link rel="{$cssModel->getRel()}" href="{$cssModel->getHref()}" type="{$cssModel->getType()}" media="{$cssModel->getMedia()}" />
{/foreach}
{foreach key=index item=jsModel from=$SCRIPTS}
    <script type="{$jsModel->getType()}" src="{$jsModel->getSrc()}"></script>
{/foreach}

<table width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
        <td class="span5">
            <div class="dashboardTitle textOverflowEllipsis" title="{vtranslate($WIDGET->getTitle(), $MODULE_NAME)}" style="width: 15em;"><b>  {vtranslate($WIDGET->getTitle(), $MODULE_NAME)}</b></div>
        </td>
          </tr>
    </tbody>
</table>

<div class="row-fluid filterContainer hide" style="position:absolute;z-index:100001">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <div class="dashboardTitle" title="">{vtranslate($WIDGET->getTitle(), $MODULE_NAME)}</div>
            </td>
        </tr>
    </table>
</div>