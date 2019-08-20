<!-- mod : categories hierarchy v 2 -->
<!-- BEGIN privmsg_extensions -->
<table  cellspacing="0" cellpadding="0" align="center" width="100%">
    <tr> 
        <td valign="top" align="center" width="100%"> 
            <table style="height: 40px" cellspacing="2" cellpadding="2" >
                <tr valign="middle"> 
                    <td>
                        {INBOX_IMG}
                    </td>
                    <td>
                        <span class="cattitle">
                            {INBOX_LINK}
                        </span>
                    </td>
                    <td>
                        {SENTBOX_IMG}
                    </td>
                    <td>
                        <span class="cattitle">
                            {SENTBOX_LINK}
                        </span>
                    </td>
                    <td>
                        {OUTBOX_IMG}
                    </td>
                    <td>
                        <span class="cattitle">
                            {OUTBOX_LINK}
                        </span>
                    </td>
                    <td>
                        {SAVEBOX_IMG}
                    </td>
                    <td>
                        <span class="cattitle">
                            {SAVEBOX_LINK}
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div style="clear:both;"></div>
<!-- END privmsg_extensions -->

<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)" {S_FORM_ENCTYPE}>
{POST_PREVIEW_BOX}
{ERROR_BOX}
<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr> 
        <td align="left">
            <span  class="nav">
                <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
<!-- BEGIN switch_not_privmsg --> 
                {NAV_CAT_DESC}
<!-- // Begin View Topic Name While Posting MOD -->
<!-- BEGIN reply_mode -->
                &nbsp;->&nbsp;
                <a href="{U_VIEW_TOPIC}" class="nav">{TOPIC_SUBJECT}</a>
<!-- END reply_mode -->
<!-- // End View Topic Name While Posting MOD -->
<!-- END switch_not_privmsg -->
            </span>
        </td>
    </tr>
</table>

<table  cellpadding="3" cellspacing="1" width="100%" class="forumline">
    <tr> 
        <th class="thHead" colspan="2" height="25"><strong>{L_POST_A}</strong></th>
    </tr>
<!-- BEGIN switch_username_select -->
    <tr> 
        <td class="row1">
            <span class="gen">
                <strong>{L_USERNAME}</strong>
            </span>
        </td>
        <td class="row2">
            <span class="genmed">
                <input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" />
            </span>
        </td>
    </tr>
<!-- END switch_username_select -->
<!-- BEGIN switch_privmsg -->
    <tr> 
        <td class="row1">
            <span class="gen">
                <strong>{L_USERNAME}</strong>
            </span>
        </td>
        <td class="row2">
            <span class="genmed">
                <input type="text"  class="post" name="username" size="25" tabindex="1" value="{USERNAME}" />&nbsp;
                <input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
            </span>
        </td>
    </tr>
<!-- END switch_privmsg -->
<!-- Start add - Custom mass PM MOD -->
<!-- BEGIN switch_groupmsg -->
    <tr> 
        <td class="row1">
            <span class="gen">
                <strong>{L_USERNAME}</strong>
            </span>
        </td>
        <td class="row2">
            <span class="genmed">
                {USERNAME}
            </span>
        </td>
    </tr>
<!-- END switch_groupmsg -->
<!-- End add - Custom mass PM MOD -->
    <tr> 
        <td class="row1" width="22%">
            <span class="gen">
                <strong>{L_SUBJECT}</strong>
            </span>
        </td>
        <td class="row2" width="78%">
            <span class="gen">
                <input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" />
            </span>
        </td>
    </tr>
<!-- BEGIN switch_icon_checkbox -->
	<tr>
		<td valign="top" class="row1">
		    <span class="gen">
		        <strong>{L_ICON_TITLE}</strong>
		    </span>
		</td>
		<td class="row2">
			<table width="100%"  cellspacing="0" cellpadding="2">
<!-- BEGIN row -->
			    <tr>
				    <td nowrap="nowrap">
                        <span class="gen">
<!-- BEGIN cell -->
						    <input type="radio" name="post_icon" value="{switch_icon_checkbox.row.cell.ICON_ID}"{switch_icon_checkbox.row.cell.ICON_CHECKED} />&nbsp;{switch_icon_checkbox.row.cell.ICON_IMG}&nbsp;&nbsp;
<!-- END cell -->
                        </span>
				    </td>
			    </tr>
<!-- END row -->
			</table>
		</td>
	</tr>
<!-- END switch_icon_checkbox -->
    <tr> 
        <td class="row1" valign="top"> 
            <table width="100%"  cellspacing="0" cellpadding="1">
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
                                        <a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" class="nav">{L_MORE_SMILIES}</a>
                                    </span>
                                </td>
                            </tr>
<!-- END switch_smilies_extra -->
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td class="row2" valign="top">
            {BB_BOX}
        </td>
    </tr>
    <tr> 
        <td class="row1" valign="top">
            <span class="gen">
                <strong>{L_OPTIONS}</strong>
            </span>
            <br />
            <span class="gensmall">
                {HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}
            </span>
        </td>
        <td class="row2">
            <table cellspacing="0" cellpadding="1" >
<!-- BEGIN switch_html_checkbox -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="disable_html" {S_HTML_CHECKED} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_DISABLE_HTML}
                        </span>
                    </td>
                </tr>
<!-- END switch_html_checkbox -->
<!-- BEGIN switch_bbcode_checkbox -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_DISABLE_BBCODE}
                        </span>
                    </td>
                </tr>
<!-- END switch_bbcode_checkbox -->
<!-- BEGIN switch_smilies_checkbox -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_DISABLE_SMILIES}
                        </span>
                    </td>
                </tr>
<!-- END switch_smilies_checkbox -->
<!-- BEGIN switch_signature_checkbox -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_ATTACH_SIGNATURE}
                        </span>
                    </td>
                </tr>
<!-- END switch_signature_checkbox -->
<!-- BEGIN switch_notify_checkbox -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="notify" {S_NOTIFY_CHECKED} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_NOTIFY_ON_REPLY}
                        </span>
                    </td>
                </tr>
<!-- END switch_notify_checkbox -->
<!-- BEGIN switch_delete_checkbox -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="delete" value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_DELETE_POST}
                        </span>
                    </td>
                </tr>
<!-- END switch_delete_checkbox -->    
<!-- BEGIN switch_topic_glance_priority -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="topic_glance_priority" {TOPIC_GLANCE_PRIORITY_CHECKED} value="1" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_TOPIC_GLANCE_PRIORITY}
                        </span>
                    </td>
                </tr>
<!-- END switch_topic_glance_priority -->
<!-- BEGIN switch_lock_topic -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="lock" {S_LOCK_CHECKED} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_LOCK_TOPIC}
                        </span>
                    </td>
                </tr>
<!-- END switch_lock_topic -->
<!-- BEGIN switch_unlock_topic -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="unlock" {S_UNLOCK_CHECKED} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_UNLOCK_TOPIC}
                        </span>
                    </td>
                </tr>        
<!-- END switch_unlock_topic -->
<!-- BEGIN switch_type_toggle -->
                <tr> 
                    <td colspan="2">
                        <span class="gen">
                            {S_TYPE_TOGGLE}
                        </span>
                    </td>
                </tr>
<!-- END switch_type_toggle -->    
<!-- BEGIN switch_Welcome_PM -->
                <tr> 
                    <td> 
                        <input type="checkbox" name="w_pm" {S_WELCOME_PM} value="ON" />
                    </td>
                    <td>
                        <span class="gen">
                            {L_WELCOME_PM}
                        </span>
                    </td>
                </tr>
<!-- END switch_Welcome_PM -->
            </table>
        </td>
    </tr>
    {ATTACHBOX}
    {POLLBOX} 
<!-- BEGIN switch_generate_security_code -->
    <tr> 
        <td class="catBottom" colspan="2" align="center" height="28">
            {L_GUEST_SECURITY_CODE}
        </td>
    </tr>
<!-- END switch_generate_security_code -->
    <tr> 
        <td class="catBottom" colspan="2" align="center" height="28">
            &nbsp;{S_HIDDEN_FORM_FIELDS}
            <input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
        </td>
    </tr>
</table>

<table width="100%" cellspacing="2"  align="center" cellpadding="2">
    <tr> 
        <td align="right" valign="top">
            <span class="gensmall">
                {S_TIMEZONE}
            </span>
        </td>
    </tr>
</table>
</form>

<table width="100%" cellspacing="2"  align="center">
    <tr> 
        <td valign="top" align="right">
            {JUMPBOX}
        </td>
    </tr>
</table>
{TOPIC_REVIEW_BOX}