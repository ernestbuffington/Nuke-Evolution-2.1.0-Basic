<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <td align="left">
            <span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1"  class="forumline">
    <tr>
        <th width="35%" class="thCornerL" height="25">&nbsp;{L_USERNAME}&nbsp;</th>
        <th width="25%" class="thTop">&nbsp;{L_LAST_UPDATE}&nbsp;</th>
        <th width="40%" class="thCornerR">&nbsp;{L_FORUM_LOCATION}&nbsp;</th>
    </tr>
    <tr>
        <td class="catSides" colspan="3" height="28">
            <span class="cattitle"><strong>{TOTAL_REGISTERED_USERS_ONLINE}</strong></span>
        </td>
    </tr>
<!-- BEGIN reg_user_row -->
    <tr>
        <td width="35%" class="{reg_user_row.ROW_CLASS}">
            <span class="gen"><img src="{reg_user_row.U_USER_ACTIVE}" alt="" />&nbsp;<a href="{reg_user_row.U_USER_PROFILE}" class="gen">{reg_user_row.USERNAME}</a>&nbsp;</span>
        </td>
        <td width="25%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">
            <span class="gen">&nbsp;{reg_user_row.LASTUPDATE}&nbsp;</span>
        </td>
        <td width="40%" class="{reg_user_row.ROW_CLASS}">
            <span class="gen">&nbsp;<a href="{reg_user_row.U_FORUM_LOCATION}" class="gen">{reg_user_row.FORUM_LOCATION}</a>&nbsp;</span>
        </td>
    </tr>
<!-- END reg_user_row -->
    <tr>
        <td class="catSides" colspan="3" height="28">
            <span class="cattitle"><strong>{TOTAL_GUEST_USERS_ONLINE}</strong></span>
        </td>
    </tr>
<!-- BEGIN guest_user_row -->
    <tr>
        <td width="35%" class="{guest_user_row.ROW_CLASS}">
            <span class="gen"><img src="{guest_user_row.U_USER_ACTIVE}" alt="" />&nbsp;<a href="{guest_user_row.U_USER_PROFILE}" class="gen">{guest_user_row.USERNAME}</a>&nbsp;</span>
        </td>
        <td width="25%" align="center" nowrap="nowrap" class="{guest_user_row.ROW_CLASS}">
            <span class="gen">&nbsp;{guest_user_row.LASTUPDATE}&nbsp;</span>
        </td>
        <td width="40%" class="{guest_user_row.ROW_CLASS}">
            <span class="gen">&nbsp;<a href="{guest_user_row.U_FORUM_LOCATION}" class="gen">{guest_user_row.FORUM_LOCATION}</a>&nbsp;</span>
        </td>
    </tr>
<!-- END guest_user_row -->
</table>

<table width="100%" cellspacing="2"  align="center" cellpadding="2">
    <tr>
        <td align="left" valign="top">
            <span class="gensmall">{L_STATISTIC_LAST_UPDATED}&nbsp;&nbsp;{STATISTIC_LAST_UPDATED}</span>
        </td>
        <td align="right" valign="top" nowrap="nowrap">
            <span class="gensmall">{S_TIMEZONE}</span>
        </td>
    </tr>
</table>
<br />
<table width="100%" cellspacing="2"  align="center">
    <tr>
        <td valign="top" align="right">{JUMPBOX}</td>
    </tr>
</table>