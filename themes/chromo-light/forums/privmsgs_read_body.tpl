<table cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <td valign="middle">
            {INBOX_IMG}
        </td>
        <td valign="middle">
            <span class="cattitle">
                {INBOX}&nbsp;
            </span>
        </td>
        <td valign="middle">
            {SENTBOX_IMG}
        </td>
        <td valign="middle">
            <span class="cattitle">
                {SENTBOX}&nbsp;
            </span>
        </td>
        <td valign="middle">
            {OUTBOX_IMG}
        </td>
        <td valign="middle">
            <span class="cattitle">
                {OUTBOX}&nbsp;
            </span>
        </td>
        <td valign="middle">
            {SAVEBOX_IMG}
        </td>
        <td valign="middle">
            <span class="cattitle">
                {SAVEBOX}
            </span>
        </td>
    </tr>
</table>

<div style="clear:both;"></div>

    <table width="100%" cellspacing="2" cellpadding="2" >
        <tr>
            <td valign="middle">
                {REPLY_PM_IMG}
            </td>
            <td width="100%">
                <span class="nav">
                    &nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
                </span>
            </td>
        </tr>
    </table>
<form method="post" action="{S_PRIVMSGS_ACTION}">
    <table  cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr>
            <th colspan="3" class="thHead" nowrap="nowrap">{BOX_NAME} :: {L_MESSAGE}</th>
        </tr>
        <tr>
            <td class="row2">
                <span class="genmed">
                    {L_FROM}:
                </span>
            </td>
            <td width="100%" class="row2" colspan="2">
                <span class="genmed">
                    {MESSAGE_FROM}
                </span>
                <span class="gensmall">
                    {POSTER_FROM_ONLINE_STATUS}
                </span>
            </td>
        </tr>
        <tr>
            <td class="row2">
                <span class="genmed">
                    {L_TO}:
                </span>
            </td>
            <td width="100%" class="row2" colspan="2">
                <span class="genmed">
                    {MESSAGE_TO}
                </span>
                <span class="gensmall">
                    {POSTER_TO_ONLINE_STATUS}
                </span>
            </td>
        </tr>
        <tr>
            <td class="row2">
                <span class="genmed">
                    {L_POSTED}:
                </span>
            </td>
            <td width="100%" class="row2" colspan="2">
                <span class="genmed">
                    {POST_DATE}
                </span>
            </td>
        </tr>
        <tr>
            <td class="row2">
                <span class="genmed">
                    {L_SUBJECT}:
                </span>
            </td>
            <td width="100%" class="row2">
                <span class="genmed">
                    {POST_SUBJECT}
                </span>
            </td>
            <td nowrap="nowrap" class="row2" align="right">
                &nbsp;{QUOTE_PM_IMG}&nbsp;{EDIT_PM_IMG}
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="3" class="row1">
                <div class="postbody">
                    {MESSAGE}
                </div>
<!-- BEGIN postrow -->
            {ATTACHMENTS}
<!-- END postrow -->
            </td>
        </tr>
        <tr>
            <td width="78%" height="28" valign="bottom" colspan="3" class="row1">
                <table cellspacing="0" cellpadding="0" >
                    <tr>
                        <td valign="middle" nowrap="nowrap">
                            {PROFILE_IMG}&nbsp;{PM_IMG}&nbsp;{EMAIL_IMG}&nbsp;{WWW_IMG}&nbsp;{AIM_IMG}&nbsp;{MSN_IMG}
                        </td>
                        <td>
                            &nbsp;
                        </td>
                        <td valign="top" nowrap="nowrap">
                            <script language="JavaScript" type="text/javascript">
                            <!--
                                if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                                    document.write(' {ICQ_IMG}');
                                else
                                    document.write('<div style="position:relative"><div style="position:relative">{ICQ_IMG}<\/div><div style="position:absolute;left:3px;top:-2px">{ICQ_STATUS_IMG}<\/div><\/div>');
                            //-->
                            </script>
                            <noscript>{ICQ_IMG_NOSCRIPT}</noscript>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                        <td valign="top" nowrap="nowrap">
                            <script language="JavaScript" type="text/javascript">
                            <!--
                                if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                                    document.write(' {YIM_IMG}');
                                else
                                    document.write('<div style="position:relative"><div style="position:relative">{YIM_IMG}<\/div><div style="position:absolute;left:3px;top:-2px">{YIM_STATUS_IMG}<\/div><\/div>');
                            //-->
                            </script>
                            <noscript>{YIM_IMG_NOSCRIPT}</noscript>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="catBottom" colspan="3" height="28" align="right">
                {S_HIDDEN_FIELDS}
                <input type="submit" name="save" value="{L_SAVE_MSG}" class="liteoption" />
                &nbsp;
                <input type="submit" name="delete" value="{L_DELETE_MSG}" class="liteoption" />
<!-- BEGIN switch_attachments -->
                &nbsp;
                <input type="submit" name="pm_delete_attach" value="{L_DELETE_ATTACHMENTS}" class="liteoption" />
<!-- END switch_attachments -->
            </td>
        </tr>
    </table>
</form>
    {ROPM_QUICKREPLY_OUTPUT}
    <table width="100%" cellspacing="2"  align="center" cellpadding="2">
        <tr>
            <td>
                {REPLY_PM_IMG}
            </td>
            <td align="right" valign="top">
                <span class="gensmall">
                    {S_TIMEZONE}
                </span>
            </td>
        </tr>
    </table>

<table width="100%" cellspacing="2"  align="center" cellpadding="2">
    <tr>
        <td valign="top" align="right">
            <span class="nav">
                &nbsp;{JUMPBOX}
            </span>
        </td>
    </tr>
</table>