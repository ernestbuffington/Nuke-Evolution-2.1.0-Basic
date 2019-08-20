<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <td align="left">
            <span class="nav">
                <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
            </span>
        </td>
    </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3"  align="center">
    <tr>
        <th class="thHead" colspan="2" height="25" nowrap="nowrap">{L_VIEWING_PROFILE}</th>
    </tr>
    <tr>
        <td class="catLeft" width="40%" height="28" align="center">
            <span class="gen">
                <strong>{L_AVATAR}</strong>
            </span>
        </td>
        <td class="catRight" width="60%">
            <span class="gen">
                <strong>{L_ABOUT_USER}</strong>
            </span>
<!-- BEGIN switch_user_admin -->
            <span class="gen">
                &nbsp;(<a target="_admin" href="{U_ADMIN_PROFILE}" class="gen">{L_USER_ADMIN_FOR}&nbsp;{USERNAME}</a>)
            </span>
<!-- END switch_user_admin -->
        </td>
    </tr>
    <tr>
        <td class="row1" height="6" valign="top" align="center">
            {AVATAR_IMG}<br />
            <span class="postdetails">
                {POSTER_RANK}
            </span>
        </td>
        <td class="row1" rowspan="3" valign="top">
            <table width="100%"  cellspacing="1" cellpadding="3">
                <tr>
                    <td valign="middle" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_JOINED}:&nbsp;
                        </span>
                    </td>
                    <td width="100%">
                        <span class="gen">
                            <strong>{JOINED}</strong>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_TOTAL_POSTS}:&nbsp;
                        </span>
                    </td>
                    <td valign="top">
                        <span class="gen">
                            <strong>{POSTS}</strong>
                        </span>
                        <br />
                        <span class="genmed">
                            [{POST_PERCENT_STATS}&nbsp;/&nbsp;{POST_DAY_STATS}]
                        </span>
                        <br />
                        <span class="genmed">
                            <a href="{U_SEARCH_USER}" class="genmed">{L_SEARCH_USER_POSTS}</a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_LOCATION}:&nbsp;
                        </span>
                    </td>
                    <td>
                        <span class="gen">
                            <strong>{LOCATION}</strong>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_WEBSITE}:&nbsp;
                        </span>
                    </td>
                    <td>
                        <span class="gen">
                            <strong>{WWW}</strong>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_OCCUPATION}:&nbsp;
                        </span>
                    </td>
                    <td>
                        <span class="gen">
                            <strong>{OCCUPATION}</strong>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_INTERESTS}:
                        </span>
                    </td>
                    <td>
                        <span class="gen">
                            <strong>{INTERESTS}</strong>
                        </span>
                    </td>
                </tr>
<!-- BEGIN show_groups -->
                <tr>
                    <td valign="top" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_GROUPS}:
                        </span>
                    </td>
                    <td>
                        <span class="gen">
                            <strong>{GROUPS}</strong>
                        </span>
                    </td>
                </tr>
<!-- END show_groups -->
<!-- BEGIN xdata -->
                <tr>
                    <td valign="top" align="right" nowrap="nowrap">
                        <span class="gen">
                            {xdata.NAME}:
                        </span>
                    </td>
                    <td>
                        <span class="gen">
                            <strong>{xdata.VALUE}</strong>
                        </span>
                    </td>
                </tr>
<!-- END xdata -->
<!-- BEGIN switch_upload_limits -->
                <tr>
                    <td valign="top" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_UPLOAD_QUOTA}:
                        </span>
                    </td>
                    <td>
                        <table width="175" cellspacing="1" cellpadding="2"  class="bodyline">
                            <tr>
                                <td colspan="3" width="100%" class="row2">
                                    <table cellspacing="0" cellpadding="1" >
                                        <tr>
                                            <td>
                                                <img src="{LCAP_IMG}" width="4" height="13" alt="" /><img src="{MAINBAR_IMG}" width="{UPLOAD_LIMIT_IMG_WIDTH}" height="13" alt="{UPLOAD_LIMIT_PERCENT}" /><img src="{RCAP_IMG}" width="4" height="13" alt="" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="33%" class="row1">
                                    <span class="gensmall">0%</span>
                                </td>
                                <td width="34%" align="center" class="row1">
                                    <span class="gensmall">50%</span>
                                </td>
                                <td width="33%" align="right" class="row1">
                                    <span class="gensmall">100%</span>
                                </td>
                            </tr>
                        </table>
                        <span class="genmed">
                            <strong>[{UPLOADED}&nbsp;/&nbsp;{QUOTA}&nbsp;/&nbsp;{PERCENT_FULL}]</strong>
                        </span>
                        <br />
                        <span class="genmed">
                            <a href="{U_UACP}" class="genmed">{L_UACP}</a>
                        </span>
                    </td>
                </tr>
<!-- END switch_upload_limits -->
            </table>
        </td>
    </tr>
    <tr>
        <td class="catLeft" align="center" height="28">
            <span class="gen">
                <strong>{L_CONTACT}&nbsp;{USERNAME}</strong>
            </span>
        </td>
    </tr>
    <tr>
        <td class="row1" valign="top">
            <table width="100%"  cellspacing="1" cellpadding="3">
                <tr>
                    <td valign="middle" align="right" nowrap="nowrap">
                        <span class="gen">
                            {L_EMAIL_ADDRESS}:
                        </span>
                    </td>
                    <td class="row1" valign="middle" width="100%">
                        <span class="gen">
                            <strong>{EMAIL_IMG}</strong>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" nowrap="nowrap" align="right">
                        <span class="gen">
                            {L_PM}:
                        </span>
                    </td>
                    <td class="row1" valign="middle">
                        <span class="gen">
                            <strong>{PM_IMG}</strong>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" nowrap="nowrap" align="right">
                        <span class="gen">
                            {L_MESSENGER}:
                        </span>
                    </td>
                    <td class="row1" valign="middle">
                        <span class="gen">
                            {MSN}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" nowrap="nowrap" align="right">
                        <span class="gen">
                            {L_YAHOO}:
                        </span>
                    </td>
                    <td class="row1" valign="middle">
                        <script language="JavaScript" type="text/javascript">
                        <!--
                            if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                                document.write(' {YIM_IMG}');
                            else
                                document.write('<table cellspacing="0" cellpadding="0" ><tr><td nowrap="nowrap"><div style="position:relative;height:20px"><div style="position:absolute">{YIM_IMG}<\/div><div style="position:absolute;left:3px;top:-1px">{YIM_STATUS_IMG}<\/div><\/div><\/td><\/tr><\/table>');
                        //-->
                        </script>
                        <noscript>
                            {YIM_IMG_NOSCRIPT}
                        </noscript>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" nowrap="nowrap" align="right">
                        <span class="gen">
                            {L_AIM}:
                        </span>
                    </td>
                    <td class="row1" valign="middle">
                        <span class="gen">
                            {AIM_IMG}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" nowrap="nowrap" align="right">
                        <span class="gen">
                            {L_ICQ_NUMBER}:
                        </span>
                    </td>
                    <td class="row1" valign="middle">
                        <script language="JavaScript" type="text/javascript">
                        <!--
                            if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                                document.write(' {ICQ_IMG}');
                            else
                                document.write('<table cellspacing="0" cellpadding="0" ><tr><td nowrap="nowrap"><div style="position:relative;height:20px"><div style="position:absolute">{ICQ_IMG}<\/div><div style="position:absolute;left:3px;top:-1px">{ICQ_STATUS_IMG}<\/div><\/div><\/td><\/tr><\/table>');
                        //-->
                        </script>
                        <noscript>
                            {ICQ_IMG_NOSCRIPT}
                        </noscript>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" nowrap="nowrap" align="right">
                        <span class="gen">
                            {L_ONLINE_STATUS}:
                        </span>
                    </td>
                    <td class="row1" valign="middle">
                        <span class="gen">
                            {ONLINE_STATUS}
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<!-- BEGIN user_extra -->
    <tr>
        <td class="catLeft" align="center" height="28" colspan="2">
            <span class="gen">
                <strong>{L_EXTRA_INFO}</strong>
            </span>
        </td>
    </tr>
    <tr>
        <td class="row1" colspan="2">
            <table width="100%" >
                <tr>
                    <td>
                        {EXTRA_INFO}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<!-- END user_extra -->
<!-- BEGIN user_sig -->
    <tr>
        <td class="catLeft" align="center" height="28" colspan="2">
            <span class="gen">
                <strong>{L_SIG}</strong>
            </span>
        </td>
    </tr>
    <tr>
        <td class="row1" valign="top" colspan="2">
            <table width="100%" >
                <tr>
                    <td>
                        {USER_SIG}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<!-- END user_sig -->
</table>

<table width="100%"  cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td align="right">
                <br />{JUMPBOX}
        </td>
    </tr>
</table>