<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script type="text/javascript">
    var imagepath="{IMG_PATH}"
</script>
<script type="text/javascript" language="JavaScript" src="{INCLUDE_PATH}overlib.js"></script>
<script type="text/javascript" language="JavaScript" src="{INCLUDE_PATH}admin_overall_forumauth.js"></script>
<h1>{L_FORUM_TITLE}</h1>
<p>{L_FORUM_EXPLAIN}</p>

<form method="post" action="{S_FORUM_ACTION}">
    <table width="100%" cellpadding="4" cellspacing="1"  class="forumline" align="center">
        <tr>
            <th class="thHead" colspan="14">{L_FORUM_TITLE}</th>
        </tr>
        <tr>
            <td class="row1" align="center" valign="middle" colspan="14">
                <table width="40%" cellpadding="4" cellspacing="1"  class="forumline" align="center">
                    <tr>
                        <td class="row1">
<!-- BEGIN authedit -->
                            <a href="javascript:void(0);" onclick="return start_edit('{authedit.VALUE}', '{authedit.NAME}');" class="gen"><img src="{IMG_PATH}{authedit.NAME}.gif">&nbsp;{authedit.NAME}</a>
                            <br />
<!-- END authedit -->
                        </td>
                        <td class="row2">
                            <a href="javascript:void(0);" onclick="return start_restore();" class="gen">{L_FORUM_OVERALL_RESTORE}</a><br /><br />
                            <a href="javascript:void(0);" onclick="return stop_edit();" class="gen">{L_FORUM_OVERALL_STOP}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="row3" colspan="2">
                            <span class="gensmall">
                                {L_FORUM_EXPLAIN_EDIT}
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="catLeft" width="100%">
                <span class="cattitle">
                    <strong>&nbsp;</strong>
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_VIEW}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_READ}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_POST}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_REPLY}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_EDIT}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_DELETE}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_STICKY}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_ANNOUNCE}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_GLOBALANNOUNCE}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_VOTE}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_POLLCREATE}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_ATTACH}
                </span>
            </td>
            <td class="cat" align="center" valign="middle">
                <span class="gen">
                    {L_DOWNLOAD}
                </span>
            </td>
        </tr>
<!-- BEGIN forumrow -->
        <tr>
            <td class="{forumrow.CLASSCOLOR}" >
                <span class="gen">
                    {forumrow.FORUM_NAME}
                </span>
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_VIEW_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_VIEW_IMG}',{forumrow.FORUM_ID},'VIEW');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_VIEW" name="auth[{forumrow.FORUM_ID}][VIEW]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_READ_IMG}.gif"  onclick="return change_auth(this,'{forumrow.AUTH_READ_IMG}',{forumrow.FORUM_ID},'READ');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_READ" name="auth[{forumrow.FORUM_ID}][READ]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_POST_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_POST_IMG}',{forumrow.FORUM_ID},'POST');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_POST" name="auth[{forumrow.FORUM_ID}][POST]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_REPLY_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_REPLY_IMG}',{forumrow.FORUM_ID},'REPLY');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_REPLY" name="auth[{forumrow.FORUM_ID}][REPLY]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_EDIT_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_EDIT_IMG}',{forumrow.FORUM_ID},'EDIT');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_EDIT" name="auth[{forumrow.FORUM_ID}][EDIT]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_DELETE_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_DELETE_IMG}',{forumrow.FORUM_ID},'DELETE');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_DELETE" name="auth[{forumrow.FORUM_ID}][DELETE]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_STICKY_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_STICKY_IMG}',{forumrow.FORUM_ID},'STICKY');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_STICKY" name="auth[{forumrow.FORUM_ID}][STICKY]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_ANNOUNCE_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_ANNOUNCE_IMG}',{forumrow.FORUM_ID},'ANNOUNCE');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_ANNOUNCE" name="auth[{forumrow.FORUM_ID}][ANNOUNCE]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_GLOBALANNOUNCE_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_GLOBALANNOUNCE_IMG}',{forumrow.FORUM_ID},'GLOBALANNOUNCE');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_GLOBALANNOUNCE" name="auth[{forumrow.FORUM_ID}][GLOBALANNOUNCE]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_VOTE_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_VOTE_IMG}',{forumrow.FORUM_ID},'VOTE');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_VOTE" name="auth[{forumrow.FORUM_ID}][VOTE]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_POLLCREATE_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_POLLCREATE_IMG}',{forumrow.FORUM_ID},'POLLCREATE');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_POLLCREATE" name="auth[{forumrow.FORUM_ID}][POLLCREATE]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_ATTACHMENTS_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_ATTACHMENTS_IMG}',{forumrow.FORUM_ID},'ATTACHMENTS');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_ATTACHMENTS" name="auth[{forumrow.FORUM_ID}][ATTACHMENTS]" />
            </td>
            <td class="{forumrow.CLASSCOLOR}" align="center" valign="middle">
                <img src="{IMG_PATH}{forumrow.AUTH_DOWNLOAD_IMG}.gif" onclick="return change_auth(this,'{forumrow.AUTH_DOWNLOAD_IMG}',{forumrow.FORUM_ID},'DOWNLOAD');">
                <input type="hidden" id="auth_{forumrow.FORUM_ID}_DOWNLOAD" name="auth[{forumrow.FORUM_ID}][DOWNLOAD]" />
            </td>
        </tr>
<!-- END forumrow -->
        <tr>
            <td colspan="14" class="catBottom" align="center">
                <input type="submit" class="liteoption" name="submit" value="{L_SUBMIT}" />
            </td>
        </tr>
    </table>
</form>