<!-- BEGIN switch_open_qr_yes -->
<div id="sqr" style="display: inline; position: relative; ">
<!-- END switch_open_qr_yes -->
<!-- BEGIN switch_open_qr_no -->
<div id="sqr" style="display: none; position: relative; ">
<!-- END switch_open_qr_no -->
<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)">
    <table  cellpadding="3" cellspacing="1" width="100%" class="forumline">
        <tr>
            <th class="thHead" colspan="2" height="25"><strong>{L_QUICK_REPLY}</strong></th>
        </tr>
<!-- BEGIN switch_username_select -->
        <tr>
            <td class="row1">
                <span class="gen"><strong>{L_USERNAME}</strong></span>
            </td>
            <td class="row2">
                <span class="genmed">&nbsp;<input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /></span>
            </td>
        </tr>
<!-- END switch_username_select -->
        <tr>
            <td class="row1" width="22%">
                <span class="gen"><strong>{L_SUBJECT}</strong></span>
            </td>
            <td class="row2" width="78%">
                <span class="gen">
                    <input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" />
                </span>
            </td>
        </tr>
        <tr>
            <td class="row1" valign="top">
                <table width="100%"  cellspacing="0" cellpadding="1">
                    <tr>
                        <td>
                            <span class="gen"><strong>{L_MESSAGE_BODY}</strong></span>
                        </td>
                    </tr>
<!-- BEGIN switch_advanced_qr -->
                    <tr>
                        <td valign="middle" align="center">&nbsp;<br />
                            <table width="100"  cellspacing="0" cellpadding="5">
                                <tr align="center">
                                    <td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><strong>{L_EMOTICONS}</strong></td>
                                </tr>
<!-- END switch_advanced_qr -->
<!-- BEGIN smilies_row -->
                                <tr align="center" valign="middle">
<!-- BEGIN smilies_col -->
                                    <td>
                                        <img src="{smilies_row.smilies_col.SMILEY_IMG}"  onmouseover="this.style.cursor='hand';" onclick="emoticon('{smilies_row.smilies_col.SMILEY_CODE}');" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" />
                                    </td>
<!-- END smilies_col -->
                                </tr>
<!-- END smilies_row -->
<!-- BEGIN switch_smilies_extra -->
                                <tr align="center">
                                    <td colspan="{S_SMILIES_COLSPAN}">
                                        <span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=500');return false;" class="nav">{L_MORE_SMILIES}</a></span>
                                    </td>
                                </tr>
<!-- END switch_smilies_extra -->
<!-- BEGIN switch_advanced_qr -->
                            </table>
                        </td>
                    </tr>
<!-- END switch_advanced_qr -->
                </table>
            </td>
            <td class="row2" valign="top">
                {BB_BOX}
            </td>
        </tr>
<!-- BEGIN switch_advanced_qr -->
        <tr>
            <td class="row1" valign="top">
                <span class="gen"><strong>{L_OPTIONS}</strong><br /><br /></span>
                <span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span>
            </td>
            <td class="row2">
                <table cellspacing="0" cellpadding="1" >
<!-- BEGIN switch_html_checkbox -->
                    <tr>
                        <td>
                            <input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
                        </td>
                        <td>
                            <span class="gen">{L_DISABLE_HTML}</span>
                        </td>
                    </tr>
<!-- END switch_html_checkbox -->
<!-- BEGIN switch_bbcode_checkbox -->
                    <tr>
                        <td>
                            <input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
                        </td>
                        <td>
                            <span class="gen">{L_DISABLE_BBCODE}</span>
                        </td>
                    </tr>
<!-- END switch_bbcode_checkbox -->
<!-- BEGIN switch_smilies_checkbox -->
                    <tr>
                        <td>
                            <input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} />
                        </td>
                        <td>
                            <span class="gen">{L_DISABLE_SMILIES}</span>
                        </td>
                    </tr>
<!-- END switch_smilies_checkbox -->
<!-- BEGIN switch_signature_checkbox -->
                    <tr>
                        <td>
                            <input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} />
                        </td>
                        <td>
                            <span class="gen">{L_ATTACH_SIGNATURE}</span>
                        </td>
                    </tr>
<!-- END switch_signature_checkbox -->
<!-- BEGIN switch_notify_checkbox -->
                    <tr>
                        <td>
                            <input type="checkbox" name="notify" {S_NOTIFY_CHECKED} />
                        </td>
                        <td>
                            <span class="gen">{L_NOTIFY_ON_REPLY}</span>
                        </td>
                    </tr>
<!-- END switch_notify_checkbox -->
<!-- BEGIN switch_lock_topic -->
                    <tr>
                        <td>
                            <input type="checkbox" name="lock" {S_LOCK_CHECKED} />
                        </td>
                        <td>
                            <span class="gen">{L_LOCK_TOPIC}</span>
                        </td>
                    </tr>
<!-- END switch_lock_topic -->
<!-- BEGIN switch_unlock_topic -->
                    <tr>
                        <td>
                            <input type="checkbox" name="unlock" {S_UNLOCK_CHECKED} />
                        </td>
                        <td>
                            <span class="gen">{L_UNLOCK_TOPIC}</span>
                        </td>
                    </tr>
<!-- END switch_unlock_topic -->
                </table>
            </td>
        </tr>
<!-- END switch_advanced_qr -->
<!-- BEGIN switch_generate_security_code -->
        <tr>
            <td class="catBottom" colspan="2" align="center" height="28">
                {L_GUEST_SECURITY_CODE}
            </td>
        </tr>
<!-- END switch_generate_security_code -->
        <tr>
            <td class="catBottom" colspan="2" align="center" height="28">
                {S_HIDDEN_FORM_FIELDS}
                <input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />
                <input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
            </td>
        </tr>
    </table>
</form>
</div>