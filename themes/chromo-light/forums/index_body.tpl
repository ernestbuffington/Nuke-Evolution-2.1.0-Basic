<table width="100%" cellspacing="0" cellpadding="4"  align="center">
    <tr>
        <td width="100%" colspan="2" valign="top">
<!-- MOD GLANCE BEGIN -->
            {GLANCE_OUTPUT}
<!-- MOD GLANCE END -->
        </td>
   </tr>
</table>

<table width="100%" cellspacing="0" cellpadding="2"  align="center">
    <tr> 
        <td class="rowlt" align="left" valign="bottom">
            <span class="gensmall">
<!-- BEGIN switch_user_logged_in -->
                {LAST_VISIT_DATE}<br />
<!-- END switch_user_logged_in -->
                {CURRENT_TIME}<br /><br />
            </span>
            <span class="nav">
                <a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}
            </span>
        </td>
        <td class= "rowrt" align="right" valign="bottom">
<!-- BEGIN switch_user_logged_in -->
            <a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br />
            <a href="{U_SEARCH_SELF}" class="gensmall">{L_SEARCH_SELF}</a><br />
<!-- END switch_user_logged_in -->
            <a href="{U_SEARCH_UNANSWERED}" class="gensmall">{L_SEARCH_UNANSWERED}</a><br />
            <a href="{U_RECENT}" class="gensmall">{L_RECENT}</a>
        </td>
    </tr>
</table>

{BOARD_INDEX}

<table width="100%" cellspacing="0"  align="center" cellpadding="2">
    <tr> 
        <td align="left">
<!-- BEGIN switch_user_logged_in -->
            <span class="gensmall">
                <a href="{U_MARK_READ}" class="gensmall">{L_MARK_FORUMS_READ}</a>
            </span>
<!-- END switch_user_logged_in -->
        </td>
        <td align="right">
            <span class="gensmall">
                {S_TIMEZONE}
            </span>
        </td>
    </tr>
</table>

<!-- BEGIN disable_viewonline -->
<table width="100%" cellpadding="3" cellspacing="1"  class="forumline">
    <tr> 
        <td class="catHead" colspan="2" height="28">
            <span class="cattitle">
                <a href="{U_VIEWONLINE}" class="cattitle">{L_WHO_IS_ONLINE}</a>
            </span>
        </td>
    </tr>
    <tr> 
        <td class="row1" align="center" valign="middle" rowspan="3">
            <img src="{IMG_WHO_IS_ONLINE}" alt="{L_WHO_IS_ONLINE}" />
        </td>
        <td class="row1" align="left" width="100%">
            <span class="gensmall">
                {TOTAL_POSTS}<br />{TOTAL_USERS}<br />{NEWEST_USER}
            </span>
        </td>
    </tr>
    <tr> 
        <td class="row1" align="left">
            <span class="gensmall">
                {TOTAL_USERS_ONLINE}<br />
                {disable_viewonline.GROUPS}<br />
                {RECORD_USERS}<br />
                {LOGGED_IN_USER_LIST}
            </span>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="1" cellspacing="1" >
    <tr>
        <td align="left" valign="top">
            <span class="gensmall">
                {L_ONLINE_EXPLAIN}
            </span>
        </td>
    </tr>
</table>
<!-- END disable_viewonline -->
<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}">
    <input type="hidden" name="op" value="login" />
    <table width="100%" cellpadding="3" cellspacing="1"  class="forumline">
        <tr> 
            <td class="catHead" height="28">
                <a name="login"></a>
                <span class="cattitle">
                    {L_LOGIN_LOGOUT}
                </span>
            </td>
        </tr>
        <tr> 
            <td class="row1" align="center" valign="middle" height="28">
                <span class="gensmall">
                    {L_USERNAME}:&nbsp;
                    <input class="post" type="text" name="username" size="10" />
                    &nbsp;&nbsp;&nbsp;{L_PASSWORD}:&nbsp;
                    <input class="post" type="password" name="user_password" size="10" />
                    &nbsp;&nbsp; &nbsp;&nbsp;{GFX}
                    &nbsp;&nbsp;&nbsp; 
                    <input type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
                </span>
            </td>
        </tr>
    </table>
</form>
<!-- END switch_user_logged_out -->

<div style="clear:both;"></div>

<table cellspacing="3"  align="center" cellpadding="0">
    <tr> 
        <td width="20" align="center">
            <img src="{FORUM_NEW_IMG}" alt="{L_NEW_POSTS}"/>
        </td>
        <td>
            <span class="gensmall">
                {L_NEW_POSTS}
            </span>
        </td>
        <td>
            &nbsp;&nbsp;
        </td>
        <td width="20" align="center">
            <img src="{FORUM_IMG}" alt="{L_NO_NEW_POSTS}" />
        </td>
        <td>
            <span class="gensmall">
                {L_NO_NEW_POSTS}
            </span>
        </td>
        <td>
            &nbsp;&nbsp;
        </td>
        <td width="20" align="center">
            <img src="{FORUM_LOCKED_IMG}" alt="{L_FORUM_LOCKED}" />
        </td>
        <td>
            <span class="gensmall">
                {L_FORUM_LOCKED}
            </span>
        </td>
    </tr>
</table>