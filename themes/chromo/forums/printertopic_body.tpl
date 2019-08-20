<a class="maintitle" href="{U_VIEW_TOPIC}"><span style="color: black;">{TOPIC_TITLE}</span></a><br />
<form action="{U_VIEW_TOPIC}" method="post" name="viewtopic">
<table border=0 align=right>
    <tr>
        <td class="gen" nowrap>
            {L_SELECT_MESSAGES_FROM}<td class="gen" nowrap title="{L_BOX1_DESC}">
          #<input class="post" type="text" maxlength="5" size="5" name="start_rel" value="{START_REL}" />
      </td>
      <td>
          {L_SELECT_THROUGH} <td class="gen" nowrap title="{L_BOX2_DESC}">
          #<input class="post" type="text" maxlength="5" size="5" name="finish_rel" value="{FINISH_REL}" />
      </td>
      <td class="gen">
            <input type="hidden" name="t" value="{TOPIC_ID}" />
            <input type="hidden" name="printertopic" value="1" />
            <input type="submit" name="submit" value="{L_SHOW}" class="mainoption" />
        </td>
        <td class="gen" >
            <a target=_blank title="{L_SEE_FAQ_MORE_HELP}" href="{U_FAQ}">{L_FAQ}</a>
        </td>
    </tr>
</table>
<span style="color:#aaaaaa; vertical-align: sub;">[/[<a title="{L_PRINT_DESC}" href="javascript:self.print()">{L_PRINT}</a>]\]</span>
<span sytle="color:#aaaaaa; vertical-align: sub;">[/[<a title="{L_PRINT_CLOSE}" href="javascript:self.close()">{L_PRINT_CLOSE}</a>]\]</span>
<br clear=all>
<span class="nav">
    {PAGINATION}
</span>
<br />
<span class="nav">
    <span style="color: black;"><a href="{U_INDEX}" class="nav">{SITENAME}</a>&nbsp;->&nbsp;<a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span>
</span>
{POLL_DISPLAY}
<!-- BEGIN postrow -->
<div align="center"><hr width=80% /></div>
<span class="name">
    <a name="{postrow.U_POST_ID}"></a>
</span>
<span class="postdetails">
    #{postrow.POST_NUMBER}:&nbsp;<span style:"color: black;"><span style="font-weight: bold;">{postrow.POST_SUBJECT}</span>&nbsp;{L_AUTHOR}:&nbsp;<span style="font-weight: bold;">{postrow.POSTER_NAME}</span>,&nbsp;</span>
</span>
<span class="postdetails">
    <span style="color: black;">{postrow.POSTER_FROM}</span>
</span>
<a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}"  /></a>
<span class="postdetails">
    <span style="color: black;">{L_POSTED}:&nbsp;{postrow.POST_DATE}</span>
<span class="gen">
<br />
<span class="gensmall">
    &nbsp;&nbsp;&nbsp;&nbsp;&#151;
</span>
<br />
<span class="postbody">
    {postrow.MESSAGE}
</span>
<span class="gensmall">
    {postrow.EDITED_MESSAGE}{postrow.ATTACHMENTS}
</span>
<!-- END postrow -->
<span class="gensmall">
    <div align="center"><hr width=48% /><hr width=16% /><hr width=4% /></div>
<span>
<span class="nav">
    <a href="{U_INDEX}" class="nav"><span style="color: black;">{SITENAME}</a>&nbsp;->&nbsp;<a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</span></a>
</span>
<div align=right>
    <br />
    <span class="copyright">
        {L_OUTPUT_GENERATED}&nbsp;<a href="http://wiking.sourceforge.net/phpBB2/wakka.php?wakka=PrinterFriendlyTopicView" target=_phpbb class="copyright">
        <span style="color: black;">printer-friendly topic mod</span></a>.&nbsp;
    </span>
    <span class="gensmall">
        {S_TIMEZONE}
    </span>
</div>
<span class="nav">
    {PAGINATION}
</span>
<span class="nav">
    <div align="center">{PAGE_NUMBER}</div>
</span>
</form>
</body>
</html>