<h1>{L_WELCOME}</h1>
<p>{L_ADMIN_INTRO}</p>
<h1>{L_FORUM_STATS}</h1>

<table width="100%" cellpadding="4" cellspacing="1"  class="forumline">
    <tr>
        <th width="25%" nowrap="nowrap" height="25" class="thCornerL" colspan="3">{L_STATISTIC}</th>
        <th width="25%" height="25" class="thTop">{L_VALUE}</th>
        <th width="25%" nowrap="nowrap" height="25" class="thTop">{L_STATISTIC}</th>
        <th width="25%" height="25" class="thCornerR">{L_VALUE}</th>
    </tr>
    <tr>
        <td class="row1" nowrap="nowrap" colspan="3">
            {L_ADMIN_IP_LOCK}:
        </td>
        <td class="row2" colspan="3">
            <img src="{ADMIN_IP_LOCK_IMAGE}" alt='' width='10' height='10' />&nbsp;{ADMIN_IP_LOCK_ED}
        </td>
    </tr>
    <tr>
        <td class="row1" nowrap="nowrap" colspan="3">
            {L_PHP_VERSION}:
        </td>
        <td class="row2">
            <strong>{PHP_VERSION}</strong>
        </td>
        <td class="row1" nowrap="nowrap">
            {L_MYSQL_VERSION}:
        </td>
        <td class="row2">
            <strong>{MYSQL_VERSION}</strong>
        </td>
    </tr>
    <tr>
        <td class="row1" nowrap="nowrap" colspan="3">
            {L_BOARD_STARTED}:
        </td>
        <td class="row2">
            <strong>{START_DATE}</strong>
        </td>
        <td class="row1" nowrap="nowrap">
            {L_AVATAR_DIR_SIZE}:
        </td>
        <td class="row2">
            <strong>{AVATAR_DIR_SIZE}</strong>
        </td>
    </tr>
    <tr>
        <td class="row1" nowrap="nowrap" colspan="3">
            {L_DB_SIZE}:
        </td>
        <td class="row2">
            <strong>{DB_SIZE}</strong>
        </td>
        <td class="row1" nowrap="nowrap">
            {L_GZIP_COMPRESSION}:
        </td>
        <td class="row2">
            <strong>{GZIP_COMPRESSION}</strong>
        </td>
    </tr>
    <tr>
        <td class="row1" nowrap="nowrap" colspan="3">
            {L_NUMBER_POSTS}:
        </td>
        <td class="row2">
            <strong>{NUMBER_OF_POSTS}</strong>
        </td>
        <td class="row1" nowrap="nowrap">
            {L_POSTS_PER_DAY}:
        </td>
        <td class="row2">
            <strong>{POSTS_PER_DAY}</strong>
        </td>
    </tr>
    <tr>
        <td class="row1" nowrap="nowrap" colspan="3">
            {L_NUMBER_TOPICS}:
        </td>
        <td class="row2">
            <strong>{NUMBER_OF_TOPICS}</strong>
        </td>
        <td class="row1" nowrap="nowrap">
            {L_TOPICS_PER_DAY}:
        </td>
        <td class="row2">
            <strong>{TOPICS_PER_DAY}</strong>
        </td>
    </tr>
    <tr>
        <td class="row1" nowrap="nowrap" colspan="3">
            {L_NUMBER_USERS}:
        </td>
        <td class="row2">
            <strong>{NUMBER_OF_USERS}</strong>
        </td>
        <td class="row1" nowrap="nowrap">
            {L_USERS_PER_DAY}:
        </td>
        <td class="row2">
            <strong>{USERS_PER_DAY}</strong>
        </td>
    </tr>
    <tr>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row1" nowrap="nowrap" colspan="2">
            {L_NUMBER_DEACTIVATED_USERS}:
        </td>
        <td class="row2" colspan="3">
            {NUMBER_OF_DEACTIVATED_USERS}
        </td>
    </tr>
    <tr>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row1" nowrap="nowrap">
            {L_NAME_DEACTIVATED_USERS}:
        </td>
        <td class="row2"  colspan="3">
            {NAMES_OF_DEACTIVATED}
        </td>
    </tr>
    <tr>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row1" nowrap="nowrap" colspan="2">
            {L_NUMBER_MODERATORS}:
        </td>
        <td class="row2" colspan="3">
            {NUMBER_OF_MODERATORS}
        </td>
    </tr>
    <tr>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row1" nowrap="nowrap">
            {L_NAME_MODERATORS}:
        </td>
        <td class="row2"  colspan="3">
            {NAMES_OF_MODERATORS}
        </td>
    </tr>
    <tr>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row1" nowrap="nowrap" colspan="2">
            {L_NUMBER_ADMINISTRATORS}:
        </td>
        <td class="row2"  colspan="3">
            {NUMBER_OF_ADMINISTRATORS}
        </td>
    </tr>
    <tr>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row3" nowrap="nowrap" width="10">
            &nbsp;
        </td>
        <td class="row1" nowrap="nowrap">
            {L_NAME_ADMINISTRATORS}:
        </td>
        <td class="row2"  colspan="3">
            {NAMES_OF_ADMINISTRATORS}
        </td>
    </tr>
</table>
<h1>{L_WHO_IS_ONLINE}</h1>
<br />{L_STATISTIC_LAST_UPDATED}&nbsp;&nbsp;{STATISTIC_LAST_UPDATED}<br />
<table width="100%" cellpadding="4" cellspacing="1"  class="forumline">
    <tr>
        <th width="20%" class="thCornerL" height="25">{L_USERNAME}</th>
        <th width="15%" height="25" class="thTop">{L_STARTED}</th>
        <th width="15%" class="thTop">{L_LAST_UPDATE}</th>
        <th width="15%" class="thTop">{L_ONLINE_TIME}</th>
        <th width="20%" class="thTop">{L_FORUM_LOCATION}</th>
        <th width="15%" height="25" class="thCornerR">{L_IP_ADDRESS}</th>
    </tr>
<!-- BEGIN reg_user_row -->
    <tr>
        <td width="20%" class="{reg_user_row.ROW_CLASS}">
            <span class="gen">
                <img src="{reg_user_row.U_USER_ACTIVE}" width="10" height="10" alt="" />&nbsp;
                {reg_user_row.U_USER_PROFILE}
            </span>
        </td>
        <td width="15%" align="center" class="{reg_user_row.ROW_CLASS}">
            <span class="gensmall">
                {reg_user_row.STARTED}
            </span>
        </td>
        <td width="15%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">
            <span class="gensmall">
                {reg_user_row.LASTUPDATE}
            </span>
        </td>
        <td width="15%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">
            <span class="gensmall">
                {reg_user_row.ONLINETIME}
            </span>
        </td>
        <td width="20%" class="{reg_user_row.ROW_CLASS}">
            <span class="gensmall">
                <a href="{reg_user_row.U_FORUM_LOCATION}" class="gen">{reg_user_row.FORUM_LOCATION}</a>
            </span>
        </td>
        <td width="15%" class="{reg_user_row.ROW_CLASS}">
            <span class="gensmall">
                <a href="{reg_user_row.U_WHOIS_IP}" class="gen" onclick="window.open(this.href,'_blank'); return false;">{reg_user_row.IP_ADDRESS}</a>
            </span>
        </td>
    </tr>
<!-- END reg_user_row -->
<!-- BEGIN no_user_row -->
    </tr>
        <td colspan="6" class="gen">
            <span class="gen">
                {no_user_row.L_NO_REGISTERED_USERS_BROWSING}
            </span>
        </td>
    </tr>
<!-- END no_user_row -->
</table>
<br />