<script language="javascript" type="text/javascript">
//<![CDATA[
<!--
    function refresh_username(selected_username, group_id)
    {
        if (group_id) {
            if (opener.document.getElementById(group_id).username.value) {
                opener.document.getElementById(group_id).username.value = opener.document.getElementById(group_id).username.value + ';' + selected_username;
            } else {
                opener.document.getElementById(group_id).username.value = selected_username;
            }
        } else {
            <!-- Start replacement - Custom mass PM MOD -->
            if (opener.document.forms['post'].username.value) {
                opener.document.forms['post'].username.value = opener.document.forms['post'].username.value + ';' + selected_username;
            } else {
                opener.document.forms['post'].username.value = selected_username;
            }
            <!-- End replacement - Custom mass PM MOD -->
        }
        opener.focus();
        window.close();
    }
//-->
//]]>
</script>

<form method="post" name="search" action="{S_SEARCH_ACTION}">
    <table width="100%"  cellspacing="0" cellpadding="10">
        <tr>
            <td>
                <table width="100%" class="forumline" cellpadding="4" cellspacing="1" >
                    <tr>
                        <th class="thHead" height="25">{L_SEARCH_USERNAME}</th>
                    </tr>
                    <tr>
                        <td valign="top" class="row1">
                            <span class="genmed">
                                <br /><input type="text" name="search_username" value="{USERNAME}" class="post" />&nbsp;<input type="submit" name="search" value="{L_SEARCH}" class="liteoption" />
                            </span>
                            <span class="gensmall">
                                <br />{L_SEARCH_EXPLAIN}<br />
                            </span>
<!-- BEGIN switch_select_name -->
                            <div class="genmed">
                                {L_UPDATE_USERNAME}<br /><select name="username_list">{S_USERNAME_OPTIONS}</select>&nbsp;<input type="submit" class="liteoption" onclick="refresh_username(this.form.username_list.options[this.form.username_list.selectedIndex].value);return false;" name="use" value="{L_SELECT}" />
                            </div>
<!-- END switch_select_name -->
<!-- BEGIN switch_select_group -->
                            <div class="genmed">
                                {L_UPDATE_USERNAME}<br /><select name="username_list">{S_USERNAME_OPTIONS}</select>&nbsp;<input type="submit" class="liteoption" onclick="refresh_username(this.form.username_list.options[this.form.username_list.selectedIndex].value, {U_GROUP_ID});return false;" name="use" value="{L_SELECT}" />
                            </div>
<!-- END switch_select_group -->
                            <br />
                            <div class="genmed" style="text-align:center;">
                                <a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>