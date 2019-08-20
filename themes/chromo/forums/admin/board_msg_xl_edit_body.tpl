<script type="text/javascript">
var evo_img_path = "{BM_IMG_BASEDIR}";
</script>
<script src="{BM_BASE_DIR}modules/Forums/bbcode_box/bbcode_box.js" type="text/javascript" >
</script>

<h1>{L_BOARD_MSG_XL}</h1>
<p>{L_BOARD_MSG_XL_EXPLAIN}</p>

<form name="post" action={S_BOARD_MSG_XL_ACTION} method="post" >
    <table cellspacing="1" cellpadding="3" border="1" align="center" width="100%" >
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_MSG_SHOWPAGE}
            </td>
            <td class="row2" width="67%">
                {S_SHOWPAGE_SELECT}
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_TITLE}
            </td>
            <td class="row2" width="67%">
                <input type="text" name="title" size="70" maxlength="75" value="{BOARD_TITLE}">
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                <span class="gensmall">
                    <table width="100%" height="100%"  cellspacing="0" cellpadding="1">
                        <tr>
                            <td>
                                <span class="gen">
                                    <strong>{L_MESSAGE_BODY}</strong>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" align="center">
                                <br />
                                <table width="100"  cellspacing="0" cellpadding="5">
                                    <tr align="center">
                                        <td colspan="{S_SMILIES_COLSPAN}" class="gensmall">
                                            <strong>{L_EMOTICONS}</strong>
                                        </td>
                                    </tr>
<!-- BEGIN smilies_row -->
                                    <tr align="center" valign="middle">
<!-- BEGIN smilies_col -->
                                        <td>
                                            <a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}"  alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a>
                                        </td>
<!-- END smilies_col -->
                                    </tr>
<!-- END smilies_row -->
<!-- BEGIN switch_smilies_extra -->
                                    <tr align="center">
                                        <td colspan="{S_SMILIES_COLSPAN}">
                                            <span  class="nav">
                                                <a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=300');return false;" class="nav">{L_MORE_SMILIES}</a>
                                            </span>
                                        </td>
                                    </tr>
<!-- END switch_smilies_extra -->
                                </table>
                            </td>
                        </tr>
                    </table>
                </span>
            </td>
            <td class="row2" width="67%" valign="top">
                {BB_BOX}
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%" valign="bottom">
                <span class="gen">
                    {L_OPTIONS}
                </span>
            </td>
            <td class="row2" width="67%" valign="bottom">
                <span class="gensmall">
                    {HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}
                </span>
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_AUTH}<br />
            </td>
            <td class="row2" width="67%">
                {S_AUTH_LEVELS_SELECT}
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_WIDTH}<br />
                <span class="gensmall">
                    {L_BOARD_WIDTH_EXPLAIN}
                </span>
            </td>
            <td class="row2" width="67%">
                <input type="text" name="width" size="5" maxlength="3" value="{BOARD_WIDTH}">
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_STARTDATE}<br />
                <span class="gensmall">
                    {L_BOARD_DATE_EXPLAIN}
                </span>
            </td>
            <td class="row2" width="67%">
                {S_STARTDATE_SELECT}&nbsp;{L_BOARD_ENDDATE}&nbsp;{S_ENDDATE_SELECT}
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_DAYS}<br />
                <span class="gensmall">
                    {L_BOARD_DAYS_EXPLAIN}
                </span>
            </td>
            <td class="row2" width="67%">
                {BOARD_DAYS}
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_IMAGES}<br />
                <span class="gensmall">
                    {L_BOARD_IMAGES_EXPLAIN}
                </span>
            </td>
            <td class="row2" width="67%">
                <input type="text" name="images" size="50" maxlength="100" value="{BOARD_IMAGES}" >&nbsp;&nbsp;&nbsp;&nbsp;{BOARD_IMAGES_IMG}
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_ORDER}
            </td>
            <td class="row2" width="67%">
                <input type="text" name="order" size="6" maxlength="4" value="{BOARD_ORDER}" >
            </td>
        </tr>
<!-- BEGIN time_switch -->
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_STARTTIME}<br />
                <span class="gensmall">
                    {L_BOARD_TIME_EXPLAIN}
                </span>
            </td>
            <td class="row2" width="67%">
                {S_STARTTIME_SELECT}&nbsp;{L_BOARD_ENDTIME}&nbsp;{S_ENDTIME_SELECT}
            </td>
        </tr>
        <tr>
            <td class="row1" width="33%">
                {L_BOARD_USERS_TIMEZONE}<br />
                <span class="gensmall">
                    {L_BOARD_USERS_TIMEZONE_EXPLAIN}
                </span>
            </td>
            <td class="row2" width="67%">
                <input type="radio" name="users_timezone" value="0" {BOARD_USERS_TIMEZONE_NO} >{L_NO}&nbsp;
                <input type="radio" name="users_timezone" value="1" {BOARD_USERS_TIMEZONE_YES} >{L_YES}
            </td>
        </tr>
<!-- END time_switch -->
        <tr>
            <td align="center" class="row1" colspan="2">
                {S_HIDDEN_FIELDS}
                <input type="submit" name="{L_ACTION}" value="{L_SUBMIT}" class="mainoption">&nbsp;
                <input type="submit" name="preview" value="{L_PREVIEW}" class="mainoption">
            </td>
        </tr>
    </table>
</form>