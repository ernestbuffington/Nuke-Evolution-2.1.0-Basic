<table width="100%" cellspacing="0" cellpadding="4"  align="center">
   <tr>
      <td width="100%" colspan="2" valign="top">
      <!-- MOD GLANCE BEGIN -->
      {GLANCE_OUTPUT}
      <!-- MOD GLANCE END -->
      </td>
   </tr>
</table>
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

<table width="100%" cellspacing="2" cellpadding="2" >
    <tr>
        <td align="left" valign="bottom" colspan="2"><a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a><br />
            <span class="gensmall">
                <strong>&nbsp;{PAGINATION}</strong><br />&nbsp;
            </span>
        </td>
    </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" >
    <tr>
        <td align="left" valign="bottom" nowrap="nowrap">
                <span class="nav">
                    <a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}"  alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" align="middle" /></a>
                    <a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}"  alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}" align="middle" /></a>
                    <a href="{U_PRINTER_TOPIC}" onclick="window.open(this.href,'_blank'); return false;"><img src="{PRINTER_IMG}"  alt="{L_PRINTER_TOPIC}" title="{L_PRINTER_TOPIC}" align="middle" /></a>
                </span>
            </td></tr><tr>
<!-- Begin mod : categories hierarchy v 2 -->
        <td align="left" valign="middle" width="100%">
            <table width="100%" cellspacing="2" cellpadding="2" >
                <tr>
                        <td align="left" valign="middle" class="nav" width="100%">
                            <span class="nav">
                                <a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}
                            </span>
                        </td>
                </tr>
            </table>
        </td>
<!-- End mod : categories hierarchy v 2 -->
    </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" >
    <tr align="right">
        <td class="catHead" colspan="2" height="28">
            <span class="nav">
                <a href="{U_VIEW_OLDER_TOPIC}" class="nav">{L_VIEW_PREVIOUS_TOPIC}</a> :: <a href="{U_VIEW_NEWER_TOPIC}" class="nav">{L_VIEW_NEXT_TOPIC}</a> &nbsp;
            </span>
        </td>
    </tr>
    {POLL_DISPLAY}
    <tr>
            <th class="thLeft" width="150" height="26" nowrap="nowrap">{L_AUTHOR}</th>
            <th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
        </tr>
<!-- BEGIN postrow -->
    <tr>
        <td width="150" align="left" valign="top" class="row2" >
            <span class="name"><a name="{postrow.U_POST_ID}"></a><strong>{postrow.POSTER_NAME}</strong></span><br />
            <span class="postdetails">{postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}<br />
<!-- BEGIN switch_showavatars -->
                {postrow.POSTER_AVATAR}
<!-- END switch_showavatars -->
                <br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br /><span style="white-space: normal;">{postrow.POSTER_FROM}</span><br />{postrow.POSTER_ONLINE_STATUS}
<!-- BEGIN xdata -->
                <br />{postrow.xdata.NAME}: <span style="white-space: normal;">{postrow.xdata.VALUE}</span>
<!-- END xdata -->
            </span>
        </td>
        <td class="{postrow.ROW_CLASS}" width="100%" height="100%" valign="top">
                <table width="100%"  cellspacing="0" cellpadding="0">
                    <tr>
                            <td width="100%">
                                <a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}"  /></a>
                                <span class="postdetails">
                                    {L_POSTED}:<br />&nbsp;{postrow.POST_DATE}
                                </span>

                            </td>
                            <td valign="bottom" align="right" nowrap="nowrap">
                                {postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG} {postrow.REPORT_IMG}
                            </td>
                    </tr>
                    <tr>
                            <td colspan="0">
                             <span class="gentitle">
                                    {L_POST_SUBJECT}:&nbsp;{postrow.POST_SUBJECT}
                            </span>
                            </td>
                    </tr>
                            <tr>

                            <td colspan="2"><hr /></td>
                    </tr>
                    <tr>
                            <td colspan="2" height="100%" valign="top">
                                <div class="postbody">
                                    {postrow.MESSAGE}
                                    {postrow.ATTACHMENTS}
                                </div>
                            </td>
<!-- Start add - Bottom aligned signature MOD -->
                    </tr>
                    <tr>
                            <td colspan="2">
                                <br /><br /><div class="postbody">{postrow.SIGNATURE}</div>
                                <span class="gensmall">{postrow.EDITED_MESSAGE}</span>
                            </td>
<!-- End add - Bottom aligned signature MOD -->
                    </tr>
            </table>
            </td>
        </tr>
        <tr>
            <td class="{postrow.ROW_CLASS}" width="150" align="left" valign="middle">
                <span class="nav">
                    <a href="#top" class="nav">{L_BACK_TO_TOP}</a>
                </span>
            </td>
            <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="bottom" nowrap="nowrap">
                <table cellspacing="0" cellpadding="0"  width="18">
                <tr>
                            <td valign="middle" nowrap="nowrap">
                                {postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.MSN_IMG}
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
<!-- BEGIN switch_spacer -->
        <tr>
            <td class="spaceRow" colspan="2" height="1">
                <img src="{SPACER_IMG}" alt="" width="1" height="1" />
            </td>
        </tr>
<!-- END switch_spacer -->
<!-- BEGIN move_message -->
      <tr>
        <td class="row3" colspan="2">
            <span class="postdetails">
                {postrow.move_message.MOVE_MESSAGE}
            </span>
        </td>
      </tr>
<!-- END move_message -->
<!-- END postrow -->
        <tr align="center">
            <td class="catBottom" colspan="2" height="28">
                <table cellspacing="0" cellpadding="0" >
                <tr>
                    <td align="center">
                        <form method="post" action="{S_POST_DAYS_ACTION}">
                            <span class="gensmall">
                                {L_DISPLAY_POSTS}:&nbsp;{S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}
                                <input type="submit" value="{L_GO}" class="liteoption" name="submit" />
                            </span>
                        </form>
                    </td>
                </tr>
                </table>
            </td>
      </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <td align="left" valign="middle" nowrap="nowrap">
            <span class="nav">
                <a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}"  alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" align="middle" /></a>
                <a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}"  alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}" align="middle" /></a>
<!-- BEGIN switch_quick_reply -->
                <a href="{U_POST_SQR_TOPIC}"><img src="{SQR_IMG}"  alt="{L_POST_SQR_TOPIC}" title="{L_POST_SQR_TOPIC}" align="middle" /></a>
<!-- END switch_quick_reply -->
                <a href="{U_PRINTER_TOPIC}" onclick="window.open(this.href,'_blank'); return false;"><img src="{PRINTER_IMG}"  alt="{L_PRINTER_TOPIC}" title="{L_PRINTER_TOPIC}" align="middle" /></a>
            </span>
        </td></tr><tr>
        <td align="left" valign="middle" width="100%">
            <span class="nav">
                <a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a>
            </span>
        </td>
        <td align="right" valign="top" nowrap="nowrap">
            <span class="gensmall">{S_TIMEZONE}</span><br />
            <span class="nav">&nbsp;{PAGINATION}</span>
        </td>
    </tr>
    <tr>
        <td align="left" colspan="3">
            <span class="nav">{PAGE_NUMBER}</span>
        </td>
    </tr>
</table>

<!-- BEGIN switch_quick_reply -->
{QRBODY}
<!-- END switch_quick_reply -->

<table width="100%" cellspacing="2"  align="center">
    <tr>
        <td width="40%" valign="top" nowrap="nowrap" align="left">
            <span class="gensmall">{S_WATCH_TOPIC}</span><br /><br />
              {S_TOPIC_ADMIN}
          </td>
        <td align="right" valign="top" nowrap="nowrap">
            {JUMPBOX}
            <span class="gensmall">{S_AUTH_LIST}</span>
        </td>
    </tr>
</table>
