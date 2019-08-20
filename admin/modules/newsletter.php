<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$adminpoint = @basename(__FILE__,'.php');
global $admin_file, $db, $adminpoint, $evoconfig, $_GETVAR, $lang_admin;

if (is_mod_admin()) {
    getmodule_lang($adminpoint);
    
    function newsletter_selection($fieldname, $current) {
        global $db, $evoconfig, $adminpoint, $lang_admin;
        static $groups;
        if (!isset($groups)) {
            $groups = array(0 => $lang_admin[$adminpoint]['NEWSLETTER_NL_ALLUSERS'], 1 => $lang_admin[$adminpoint]['NEWSLETTER_SUBSCRIBEDUSERS'], 2 => $lang_admin[$adminpoint]['NEWSLETTER_NL_ADMINS']);
            $groupsResult = $db->sql_query("SELECT group_id, group_name FROM " . GROUPS_TABLE . " WHERE group_single_user=0");
            while (list($groupID, $groupName) = $db->sql_fetchrow($groupsResult, SQL_NUM)) {
                $groups[($groupID+2)] = $groupName;
            }
            $db->sql_freeresult($groupsResult);
        }
        $tmpgroups = $groups;
        return select_box($fieldname, $current, $tmpgroups);
    }

    $subject     = stripslashes($_GETVAR->get('subject', '_POST', 'string', ''));
    $mailcontent = stripslashes($_GETVAR->get('mailcontent', '_POST', 'string', ''));
    $group       = $_GETVAR->get('group', '_POST', 'int', 1);
    $discard     = $_GETVAR->get('discard', '_POST', 'string', '');
    $send        = $_GETVAR->get('send', '_POST', 'string', '');
    $preview     = $_GETVAR->get('preview', '_POST', 'string', '');
    $n_group     = $_GETVAR->get('n_group', '_POST', 'int', 0);

    if ( !empty($discard) ) {
        redirect($admin_file.'.php?op=newsletter');
    } elseif ( !empty($send) ) {
        // removed some codelines because SwiftMailer set all this stuff
        if (empty($subject)) {
            DisplayError(sprintf($lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'], $lang_admin[$adminpoint]['NEWSLETTER_SUBJECT']). '<br />'. "<a href='javascript:history.back(-1)'>".$lang_admin['KERNEL']['GOBACK']."</a>");
        }
        if (empty($mailcontent)) {
            DisplayError(sprintf($lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'], $lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT']). '<br />'. "<a href='javascript:history.back(-1)'>".$lang_admin['KERNEL']['GOBACK']."</a>");
        } else {
            $mailcontent = set_smilies(decode_bbcode(stripslashes(check_words($mailcontent)), 1, true), EVO_SERVER_URL);
        }
//        ignore_user_abort(true);
        if ($n_group == 0) {
            $query = "SELECT username, user_email FROM " . _USERS_TABLE . " WHERE user_level > 0 AND user_active > 0 AND user_id !='".ANONYMOUS."' AND user_email != ''";
        } elseif ($n_group == 1) {
            $query = "SELECT username, user_email FROM " . _USERS_TABLE . " WHERE user_level > 0 AND user_active > 0 AND user_id !='".ANONYMOUS."' AND user_email !='' AND newsletter = 1";
        } elseif ($n_group == 2) {
            $query = "SELECT aid, email FROM " . _AUTHOR_TABLE . " WHERE email != ''";
        } elseif ($n_group > 2) {
            $sql_group = $n_group-2;
            $query = "SELECT u.username, u.user_email FROM (" . _USERS_TABLE . " u, " . USER_GROUP_TABLE . " g) WHERE u.user_level>0 AND u.user_active > 0 AND u.user_email != '' AND u.user_id !='".ANONYMOUS."' AND u.newsletter=1 AND g.group_id='".$sql_group."' AND u.user_id = g.user_id AND g.user_pending=0";
        } else {
            $query = "";
        }
        $mailcontent = $lang_admin[$adminpoint]['NEWSLETTER_HELLO'].",<br /><br /> $mailcontent <br /><br />".$lang_admin[$adminpoint]['NEWSLETTER_NL_REGARDS'].",<br /><br />".EVO_SERVER_SITENAME." ".$lang_admin[$adminpoint]['NEWSLETTER_STAFF']."<br /><br />".$lang_admin[$adminpoint]['NEWSLETTER_NLUNSUBSCRIBE'];
        $recipients = array();
        $result = $db->sql_query($query);
        $send_count = 0;
        set_time_limit(0);
        while (list($u_name, $u_email) = $db->sql_fetchrow($result)) {
            $recipients[$u_name] = $u_email;
            $send_count++;
        }
        if (empty($recipients) || count($recipients) < 1) {
            DisplayError('0 '.$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'], $lang_admin[$adminpoint]['NEWSLETTER_TITLE']. '<br />'. "<a href='javascript:history.back(-1)'>".$lang_admin['KERNEL']['GOBACK']."</a>");
        }
        $mailsend = evo_mail($recipients, $subject, $mailcontent, '', '', TRUE);
        if (!empty($mailsend['error'])) {
            DisplayError($lang_admin['KERNEL']['ERROR'] . ': ' . $lang_admin[$adminpoint]['NEWSLETTER_TITLE']. '&nbsp;&nbsp;'.$mailsend);
        } elseif ($mailsend['sended'] != $send_count) {
            DisplayError($lang_admin[$adminpoint]['NEWSLETTER_NEWSLETTERSENT'].'<br />'.$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'].':&nbsp;'.$mailsend['sended'].'<br />'.implode($mailsend['failed']));
        } else {
            DisplayError($lang_admin[$adminpoint]['NEWSLETTER_NEWSLETTERSENT'].'<br />'.$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'].':&nbsp;'.$mailsend['sended']);
        }
    }

    $title = $lang_admin[$adminpoint]['NEWSLETTER_TITLE'];
    $notes = $submit = '';
    if ( !empty($preview) ) {
        $title .= ' '.$lang_admin[$adminpoint]['NEWSLETTER_PREVIEW'];
        if (empty($subject)) {
            DisplayError(sprintf($lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'], $lang_admin[$adminpoint]['NEWSLETTER_SUBJECT']). '<br />'. "<a href='javascript:history.back(-1)'>".$lang_admin['KERNEL']['GOBACK']."</a>");
        } else {
            $subject = Fix_Quotes(filter_text($subject, "nohtml"));
            $subject = stripslashes(check_html($subject, "nohtml"));
        }
        if (empty($mailcontent)) {
            DisplayError(sprintf($lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'], $lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT']). '<br />'. "<a href='javascript:history.back(-1)'>".$lang_admin['KERNEL']['GOBACK']."</a>");
        } else {
            $mailcontent1 = Fix_Quotes(nl2br(check_words($mailcontent)));
            $mailcontent1 = set_smilies(decode_bbcode(stripslashes($mailcontent1), 1, true));
        }
        if ($group == 0) {
            list($num_users) = $db->sql_ufetchrow("SELECT COUNT(username) FROM " . _USERS_TABLE . " WHERE user_level > 0 AND user_active > 0 AND user_id !='".ANONYMOUS."' AND user_email != ''");
            $group_name = strtolower($lang_admin[$adminpoint]['NEWSLETTER_NL_ALLUSERS']);
        } elseif ($group == 1) {
            list($num_users) = $db->sql_ufetchrow("SELECT COUNT(username) FROM " . _USERS_TABLE . " WHERE user_level > 0 AND user_active > 0 AND user_id !='".ANONYMOUS."' AND user_email !='' AND newsletter = 1");
            $group_name = strtolower($lang_admin[$adminpoint]['NEWSLETTER_SUBSCRIBEDUSERS']);
        } elseif ($group == 2) {
            list($num_users) = $db->sql_ufetchrow("SELECT COUNT(aid) FROM " . _AUTHOR_TABLE . " WHERE email != ''");
            $group_name = strtolower($lang_admin[$adminpoint]['NEWSLETTER_NL_ADMINS']);
        } elseif ($group >= 3) {
            $sql_group = $group - 2;
            list($num_users)  = $db->sql_ufetchrow("SELECT COUNT(u.username) FROM (" . _USERS_TABLE . " u, " . USER_GROUP_TABLE . " g) WHERE u.user_level>0 AND u.user_active > 0 AND u.user_email != '' AND u.user_id !='".ANONYMOUS."' AND u.newsletter=1 AND g.group_id='".$sql_group."' AND u.user_id = g.user_id AND g.user_pending=0");
            list($group_name) = $db->sql_ufetchrow("SELECT group_name FROM " . GROUPS_TABLE . " WHERE group_id='".$sql_group."'", SQL_NUM);
        } else {
            $query = "";
        }
        $status = '';
        if ($num_users < 1) { $status = ' disabled="disabled"'; }
        if ($num_users > 500) {
            $notes = '<tr><td align="center" class="row1" colspan="2">'.$lang_admin[$adminpoint]['NEWSLETTER_MANYUSERSNOTE'].'</td></tr>';
        } elseif ($num_users < 1) {
            $notes = '<tr><td align="center" class="row1" colspan="2">'.$lang_admin[$adminpoint]['NEWSLETTER_NL_NOUSERS'].'</td></tr>';
        }
        $preview = '<tr>
        <td class="row1" colspan="2">
        <span style="float: left">'.$lang_admin[$adminpoint]['NEWSLETTER_MUSERGROUPWILLRECEIVE'].'<strong>'.$group_name.'</strong></span><br />
        <span style="float: left"><strong>'.$num_users.'</strong> '.$lang_admin[$adminpoint]['NEWSLETTER_NUSERWILLRECEIVE'].'</span><br />
        <hr />
        <span class="gen">'.$mailcontent1.'</span>
        <hr />
        </td>
        </tr>';
        $submit = ' &nbsp;
        <input type="submit" name="send" value="'.$lang_admin[$adminpoint]['NEWSLETTER_SEND'].'" class="mainoption"'.$status.' /> &nbsp;
        <input type="submit" name="discard" value="'.$lang_admin[$adminpoint]['NEWSLETTER_DISCARD'].'" class="liteoption" />
        <input type="hidden" name="n_group" value="'.$group.'" />';
    }

    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align='center'>\n<a href='".$admin_file.".php?op=newsletter'>" . $lang_admin[$adminpoint]['NEWSLETTER_TITLE'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align='center'>\n[ <a href='".$admin_file.".php'>" . $lang_admin[$adminpoint]['NEWSLETTER_BACKMAIN'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo '<form name="newsletter" action="'.$admin_file.'.php?op=newsletter" method="post">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline" align="center">
    <tr>
        <td align="center" class="catleft" colspan="2"><strong><span class="gen">'.$title.'</span></strong></td>
    </tr>'.$preview.'<tr>
        <td class="row1"><span class="gen">'.$lang_admin[$adminpoint]['NEWSLETTER_SUBJECT'].'</span></td>
        <td class="row2"><input type="text" name="subject" size="50" maxlength="255" value="'.$subject.'" /></td>
    </tr><tr>
        <td class="row1"><span class="gen">'.$lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT'].'</span></td>
        <td class="row2">';
    Make_TextArea('mailcontent', $mailcontent, 'newsletter');
    echo '</td>
    </tr><tr>
        <td class="row1"><span class="gen">'.$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'].'</span></td>
        <td class="row2">'.newsletter_selection('group', $group).'</td>
    </tr>'.$notes.'<tr>
        <td class="catbottom" colspan="2" align="center" height="28">
        <input type="submit" name="preview" value="'.$lang_admin[$adminpoint]['NEWSLETTER_PREVIEW'].'" class="mainoption" />'.$submit.'
        </td>
    </tr></table></form>';
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

} else {
    DisplayError('<strong>' .$lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>