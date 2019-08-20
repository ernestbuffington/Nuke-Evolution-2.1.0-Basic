<script language="Javascript" type="text/javascript">
<!--
    function open_postreview(ref)
    {
        height = screen.height / 3;
        width = screen.width / 2;
        window.open(ref, '_phpbbpostreview', 'HEIGHT=' + height + ',WIDTH=' + width + ',resizable=yes,scrollbars=yes');
    }
//-->
</script>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" >
    <tr>
        <th class="thRight" nowrap="nowrap">{L_AUTHOR}</th>
    </tr>
<!-- BEGIN postrow -->
    <tr>
        <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top">
            <table width="100%"  cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%" align="center">
                        <span class="name">
                            <a name="{postrow.U_POST_ID}"></a><strong>{postrow.POSTER_NAME}</strong>
                        </span>
                        <br />
                        <span class="postdetails">
                            {postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />{postrow.POSTER_FROM}<br />{postrow.POSTER_ONLINE_STATUS}
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="spaceRow" colspan="2" height="1">
            <img src="{SPACER_IMG}" alt="" width="1" height="1" />
        </td>
    </tr>
<!-- END postrow -->
    <tr>
        <th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
    </tr>
<!-- BEGIN postrow -->
    <tr>
        <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top">
            <table width="100%"  cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%">
                        <img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}"  />
                        <div class="postdetails">
                            {L_POSTED}:&nbsp;{postrow.POST_DATE}
                            <span class="gen">
                                &nbsp;
                            </span>
                            &nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}:&nbsp;{postrow.POST_SUBJECT}
                        </div>
                    </td>
                    <td valign="top" align="right" nowrap="nowrap">
                        {postrow.QUOTE_IMG}&nbsp;{postrow.REPORT_IMG}
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
                            {postrow.MESSAGE}{postrow.SIGNATURE}
                        </div>
                        {postrow.ATTACHMENTS}
                        <span class="gensmall">
                            &nbsp;{postrow.EDITED_MESSAGE}
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="bottom" nowrap="nowrap">
            <table cellspacing="0" cellpadding="0"  width="18">
                <tr>
                    <td valign="middle" nowrap="nowrap">
                        {postrow.PROFILE_IMG}&nbsp;{postrow.PM_IMG}&nbsp;{postrow.EMAIL_IMG}&nbsp;{postrow.WWW_IMG}&nbsp;{postrow.AIM_IMG}&nbsp;{postrow.MSN_IMG}
                                <script language="JavaScript" type="text/javascript">
                                //<![CDATA[
                                    <!--
                                if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                                        document.write(' {postrow.ICQ_IMG}');
                                  else
                                        document.write('<\/td><td>&nbsp;<\/td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:relative">{postrow.ICQ_IMG}<\/div><div style="position:absolute;left:3px;top:-2px">{postrow.ICQ_STATUS_IMG}<\/div><\/div>');
                                    //-->
                                </script>
                                <script language="JavaScript" type="text/javascript">
                                    <!--
                                if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                                        document.write(' {postrow.YIM_IMG}');
                                  else
                                        document.write('<\/td><td>&nbsp;<\/td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:relative">{postrow.YIM_IMG}<\/div><div style="position:absolute;left:3px;top:-2px">{postrow.YIM_STATUS_IMG}<\/div><\/div>');
                                    //-->
                                    //]]>
                                </script>
                                <noscript>
                                    {postrow.ICQ_IMG_NOSCRIPT} {postrow.YIM_IMG_NOSCRIPT}
                                </noscript>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<!-- END postrow -->
</table>