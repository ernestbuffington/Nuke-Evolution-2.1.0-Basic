<h1>{L_BOARD_MSG_XL}</h1>
<p>{L_BOARD_MSG_XL_EXPLAIN}</p>

<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <form method="post" action="{S_MODE_ACTION}">
            <td align="right" nowrap="nowrap" colspan="2">
                <span class="genmed">
                    {L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}
                    <input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
                </span>
            </td>
        </form>
    </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1"  class="forumline">
    <tr>
        <th height="25" class="thCornerL" nowrap="nowrap">#</th>
        <th class="thTop">{L_BOARD_TITLE}</th>
        <th class="thTop">{L_BOARD_MSG_SHOWPAGE}</th>
        <th class="thTop">{L_BOARD_AUTH}</th>
        <th class="thTop">{L_BOARD_WIDTH}</th>
        <th class="thTop">{L_BOARD_DAYS}</th>
        <th class="thTop">{L_BOARD_STARTDATE}</th>
        <th class="thTop">{L_BOARD_ENDDATE}</th>
        <th class="thTop">{L_BOARD_ORDER}</th>
<!-- BEGIN time_switch -->
        <th class="thTop">{L_BOARD_STARTTIME}</th>
        <th class="thTop">{L_BOARD_ENDTIME}</th>
        <th class="thTop">{L_BOARD_USERS_TIMEZONE}</th>
<!-- END time_switch -->
        <th class="thTop">{L_EDIT}</th>
        <th class="thCornerR" nowrap="nowrap">{L_DELETE}</th>
    </tr>
<!-- BEGIN board_msg_row -->
    <tr>
        <td class="{board_msg_row.ROW_CLASS}" align="center">
            <span class="gen">
                &nbsp;{board_msg_row.ROW_NUMBER}&nbsp;
            </span>
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            <a href="{board_msg_row.BOARD_MSG_EDIT2}" class="topictitle" title="{board_msg_row.BOARD_MSG}">{board_msg_row.BOARD_TITLE}</a>
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center">
            {board_msg_row.BOARD_MSG_DISPLAY}
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center">
            {board_msg_row.BOARD_AUTH}
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            &nbsp;{board_msg_row.BOARD_WIDTH}&nbsp;
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            &nbsp;{board_msg_row.BOARD_DAYS}&nbsp;
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_STARTDATE}
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_ENDDATE}
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_ORDER}
        </td>
<!-- BEGIN time_switch -->
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_STARTTIME}
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_ENDTIME}
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_USERS_TIMEZONE_TEXT}
        </td>
<!-- END time_switch -->
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_MSG_EDIT_IMG}
        </td>
        <td class="{board_msg_row.ROW_CLASS}" align="center" valign="middle">
            {board_msg_row.BOARD_MSG_DELETE_IMG}
        </td>
    </tr>
<!-- END board_msg_row -->
    <tr>
        <td class="catbottom" colspan="11" height="28">
            &nbsp;
        </td>
    </tr>
</table>

<table width="100%" cellspacing="2"  align="center" cellpadding="2">
    <tr>
        <td align="right" valign="top">
            &nbsp;
        </td>
    </tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" >
    <tr>
        <td>
            <span class="nav">
                {PAGE_NUMBER}
            </span>
        </td>
        <td align="right">
            <span class="nav">
                {PAGINATION}
            </span>
        </td>
    </tr>
    <tr>
        <form method="post" action="{U_BOARD_MSG_ADD}">
            <td colspan="2" height="25" align="right">
                <input type="submit" name="add" value="{L_ADD}" class="mainoption" />
            </td>
        </form>
    </tr>
</table>