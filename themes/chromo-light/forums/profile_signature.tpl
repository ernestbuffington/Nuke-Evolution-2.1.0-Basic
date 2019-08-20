<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
    </tr>
</table>

<!-- BEGIN switch_current_sig -->

<form method="post" action="{SIG_LINK}" name="post">
    <table style="margin-left:auto; margin-right:auto;"  cellpadding="3" cellspacing="1" width="660" class="forumline">
        <tr>
            <th class="thHead" colspan="2" height="25" valign="middle">{SIG_CURRENT}</th>
        </tr>
        <tr>
            <td class="row1" width="140" height="140">
                <span class="gen">
                    {L_SIGNATURE}:
                </span>
            </td>
            <td class="row2" width="520" valign="bottom">
                <div class="gen">
                    {CURRENT_PREVIEW}
                </div>
            </td>
        </tr>
        <tr>
            <td class="row1" width="140" height="20">
                <span class="gen">
                    &nbsp;
                </span>
            </td>
            <td class="row2" width="520" valign="middle" nowrap="nowrap">
                {PROFIL_IMG} {EMAIL_IMG} {PM_IMG} {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG} {ICQ_IMG}
            </td>
        </tr>
    </table>

    <br />

    <table style="margin-left:auto; margin-right:auto;"  cellpadding="3" cellspacing="1" width="660" class="forumline">
        <tr>
            <th class="thHead" colspan="2" height="25" valign="middle">{SIG_EDIT}</th>
        </tr>
        <tr>
            <td class="row1" width="130" height="150">
                <span class="gen">
                    {L_SIGNATURE}:
                </span>
                <br />
                <span class="gensmall">
                    {L_SIGNATURE_EXPLAIN}<br /><br />{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}
                </span>
            </td>
            <td class="row2" width="530">
                {BB_BOX}
            </td>
        </tr>
        <tr>
            <td class="row1" width="130" height="20">
                <span class="gen">
                    &nbsp;
                </span>
            </td>
            <td class="row2" width="530" valign="middle">
                <input type="button" value="{L_PROFILE}" onclick="location='{U_PROFILE}'" />
                <input type="button" value="{SIG_CURRENT}" onclick="location='{SIG_LINK}'" />
                <input type="submit" value="{SIG_PREVIEW}" name="preview" />
                <input type="submit" value="{SIG_SAVE}" name="save" />
                <input type="submit" value="{SIG_CANCEL}" name="cancel" />
            </td>
        </tr>
    </table>
</form>

<!-- END switch_current_sig -->
<!-- BEGIN switch_preview_sig -->

    <table style="margin-left:auto; margin-right:auto;"  cellpadding="3" cellspacing="1" width="660" class="forumline">
        <tr>
            <th class="thHead" colspan="2" height="25" valign="middle">{SIG_PREVIEW}</th>
        </tr>
        <tr>
            <td class="row1" width="140" height="140">
                <span class="gen">
                    {L_SIGNATURE}:
                </span>
            </td>
            <td class="row2" width="520" valign="bottom">
                <div class="gen">
                    {REAL_PREVIEW}
                </div>
            </td>
        </tr>
        <tr>
            <td class="row1" width="140" height="20">
                <span class="gen">
                    &nbsp;
                </span>
            </td>
            <td class="row2" width="520" valign="middle" nowrap="nowrap">
                {PROFIL_IMG} {EMAIL_IMG} {PM_IMG} {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG} {ICQ_IMG}
            </td>
        </tr>
    </table>

    <br />

<form method="post" action="{SIG_LINK}" name="post">
    <table style="margin-left:auto; margin-right:auto;"  cellpadding="3" cellspacing="1" width="660" class="forumline">
        <tr>
            <th class="thHead" colspan="2" height="25" valign="middle">{SIG_EDIT}</th>
        </tr>
        <tr>
            <td class="row1" width="130" height="150">
                <span class="gen">
                    {L_SIGNATURE}:
                </span>
                <br />
                <span class="gensmall">
                    {L_SIGNATURE_EXPLAIN}<br /><br />{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}
                </span>
            </td>
            <td class="row2" width="530" valign="middle">
                {BB_BOX}
            </td>
        </tr>
        <tr>
            <td class="row1" width="130" height="20">
                <span class="gen">
                    &nbsp;
                </span>
            </td>
            <td class="row2" width="530" valign="middle">
                <input type="button" value="{L_PROFILE}" onclick="location='{U_PROFILE}'" />
                <input type="button" value="{SIG_CURRENT}" onclick="location='{SIG_LINK}'" />
                <input type="submit" value="{SIG_PREVIEW}" name="preview" />
                <input type="submit" value="{SIG_SAVE}" name="save" />
                <input type="submit" value="{SIG_CANCEL}" name="cancel" />
            </td>
        </tr>
    </table>
</form>

<!-- END switch_preview_sig -->
<!-- BEGIN switch_save_sig -->

<form method="post" action="{SIG_LINK}" name="save_sig">
    <table style="margin-left:auto; margin-right:auto;"  cellpadding="3" cellspacing="1" width="100%" class="forumline">
        <tr>
            <th class="thHead" height="25" valign="middle">{SIG_SAVE}</th>
        </tr>
        <tr>
            <td class="row1" valign="middle" align="center" height="50">
                <span class="gen">
                    {SAVE_MESSAGE}
                </span>
            </td>
        </tr>
        <tr>
            <td class="row2" valign="middle">
                <input type="button" value="{L_PROFILE}" onclick="location='{U_PROFILE}'" />
                <input type="button" value="{SIG_CURRENT}" onclick="location='{SIG_LINK}'" />
                <input type="submit" value="{SIG_CANCEL}" name="cancel" />
            </td>
        </tr>
    </table>
</form>
<!-- END switch_save_sig -->