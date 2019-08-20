<script language="JavaScript" type="text/javascript">
<!--
    message = new Array();
<!-- BEGIN postrow -->
    message[{postrow.U_POST_ID}] = "[quote=\"{postrow.POSTER_MESSAGE_NAME}\";p=\"{postrow.U_POST_ID}\"]\n{postrow.PLAIN_MESSAGE}\n[/quote]";
<!-- END postrow -->

    function addquote(post_id) {
        window.parent.document.post.message.value += message[post_id];
        window.parent.document.post.message.focus();
        return;
    }
//-->
</script>
<script language="Javascript" type="text/javascript">
<!--
    function open_postreview(ref)
    {
        height = screen.height / 3;
        width = screen.width / 2;
        window.open(ref, '_phpbbpostreview', 'HEIGHT=' + height + ',WIDTH=' + width + ',resizable=yes,scrollbars=yes');
        return;
    }
//-->
</script>
<br /><br />
<div style='height:300px; overflow:scroll;'>
<table  cellpadding="3" cellspacing="1" width="100%" class="forumline">
    <tr>
        <th class="thCornerL" width="22%" height="26">{L_AUTHOR}</th>
        <th class="thCornerR">{L_MESSAGE}</th>
    </tr>
<!-- BEGIN postrow -->
    <tr>
        <td width="22%" align="left" valign="top" class="{postrow.ROW_CLASS}">
            <span class="name">
                <a id="P{postrow.U_POST_ID}"></a><strong>{postrow.POSTER_NAME}</strong>
            </span>
        </td>
        <td class="{postrow.ROW_CLASS}" valign="top">
            <table width="100%"  cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%">
                        <img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}"  />
                        <span class="postdetails">
                            {L_POSTED}:&nbsp;{postrow.POST_DATE}
                            <span class="gen">
                                &nbsp;
                            </span>
                                &nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}:&nbsp;{postrow.POST_SUBJECT}
                        </span>
                    </td>
                    <td valign="top" align="right" nowrap="nowrap">
                        <span class="genmed">
                            <input type="button" class="button" name="addquote" value="{L_QUOTE}" style="width:75px" onclick="addquote({postrow.U_POST_ID});" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="postbody">
                            {postrow.MESSAGE}
<!-- BEGIN attachrow -->
                            {ATTACHMENTS}
<!-- END attachrow -->
                        </div>
                    </td>
                </tr>
           </table>
       </td>
    </tr>
    <tr>
        <td colspan="2" height="1" class="spaceRow">
            <img src="{SPACER_IMG}" alt="" width="1" height="1" />
        </td>
    </tr>
<!-- END postrow -->
</table>
</div>