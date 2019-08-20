<table class="forumline" width="100%" cellspacing="1" cellpadding="3" >
    <tr>
        <th class="thHead" height="25" valign="middle">
            <span class="tableTitle">
                {MESSAGE_TITLE}
            </span>
        </th>
    </tr>
    <tr>
        <td class="row1" align="center">
            <form action="{S_ACTION}" method="post">
                <br />
                <span class="gen">
                    {MESSAGE_TEXT}
                </span>
                <br /><br />
                {S_HIDDEN_FIELDS}
                <select name="{S_GROUP_VARIABLE}" class="post">
                    <option value="">{L_SELECT}</option>
<!-- BEGIN grouprow -->
                    <option value="{grouprow.GROUP_ID}">{grouprow.GROUP_NAME}</option>
<!-- END grouprow -->
                </select>
                <input type="submit" name="confirm" value="{L_GO}" class="mainoption" />&nbsp;
                <input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
            </form>
        </td>
    </tr>
</table>
<div style="clear:both;"></div>