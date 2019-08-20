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

if(!defined('NUKE_EVO')) exit;

global $evoconfig, $db, $board_config, $userinfo;

$useavatars = 1; //1 to Show Avatars - 0 is off
$showip = 0; //1 to Show your current IP address - 0 is off

$content = '';

list($lastuser) = $db->sql_ufetchrow("SELECT username FROM "._USERS_TABLE." WHERE user_active = 1 AND user_level > 0 ORDER BY user_id DESC LIMIT 1");
list($numrows) = $db->sql_ufetchrow("SELECT COUNT(user_id) FROM "._USERS_TABLE." WHERE user_id <> " . ANONYMOUS . " AND user_active > 0");
$result = $db->sql_query("SELECT uname, guest FROM "._SESSION_TABLE." WHERE guest='0' OR guest='2'");
$member_online_num = $db->sql_numrows($result);

$who_online_now = "";
$i = 1;
while ($session = $db->sql_fetchrow($result, SQL_ASSOC)) {
    $username2=UsernameColor($session['uname']);
    if (isset($session['guest']) and $session['guest'] == 0 && !empty($username2)) {
        if ($i < 10) {
            $who_online_now .= "0" .$i.".&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$session[uname]\">$username2</a><br />\n";
        } else {
            $who_online_now .= $i.".&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$session[uname]\">$username2</a><br />\n";
        }
        $who_online_now .= ($i != $member_online_num ? "  " : "");
        $i++;
    }
}
$db->sql_freeresult($result);

if ($showip == 1) {
    $ip = $userinfo['user_ip'];
    $content .= "<br /><br /><center>".$lang_block['BLOCK_USERINFO_YOUR_IP'].": ".$ip."</center>";
}

if ($useavatars == 1) {
    $user_avatar = GetAvatar($userinfo['user_id']);
    $content .= "<br /><br /><center>".$user_avatar."</center><br />\n";
}


// Formatting date - Fix
$month = date('M');
$curDate2 = "%".$month[0].$month[1].$month[2]."%".date('d')."%".date('Y')."%";
$ty = time() - 86400;
$preday = strftime('%d', $ty);
$premonth = strftime('%B', $ty);
$preyear = strftime('%Y', $ty);
$curDateP = "%".$premonth[0].$premonth[1].$premonth[2]."%".$preday."%".$preyear."%";

//Select new today
//Select new yesterday
list($userCount) = $db->sql_ufetchrow("SELECT COUNT(user_id) FROM "._USERS_TABLE." WHERE user_regdate LIKE '$curDate2'", SQL_NUM);
list($userCount2) = $db->sql_ufetchrow("SELECT COUNT(user_id) FROM "._USERS_TABLE." WHERE user_regdate LIKE '$curDateP'", SQL_NUM);
//end

list($guest_online_num) = $db->sql_ufetchrow("SELECT COUNT(uname) FROM "._SESSION_TABLE." WHERE guest='1' OR guest='3'", SQL_NUM);
list($member_online_num) = $db->sql_ufetchrow("SELECT COUNT(uname) FROM "._SESSION_TABLE." WHERE guest='0' OR guest='2'", SQL_NUM);

$who_online_num = $guest_online_num + $member_online_num;
$who_online_num = intval($who_online_num);
$content .= "<form onsubmit=\"this.submit.disabled='true'\" action=\"modules.php?name=Your_Account\" method=\"post\">";

if (is_user()) {
    $uname = $userinfo['username'];
    $uname_color = UsernameColor($uname);
    $content .= "<br /><img src=\"". evo_image('group-4.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_WELCOME'].", <strong>$uname_color</strong>.<br />\n<hr />\n";
    $uid = $userinfo['user_id'];
    $newpms = check_priv_mess($userinfo['user_id']);
    list($oldpms) = $db->sql_ufetchrow("SELECT COUNT(*) FROM ".PRIVMSGS_TABLE." WHERE privmsgs_to_userid='".$userinfo['user_id']."' AND privmsgs_type='0'");
    $content .= "<img src=\"". evo_image('email-y.gif', 'blocks') ."\" height=\"10\" width=\"14\" alt=\"\" />&nbsp;<a href=\"modules.php?name=Private_Messages\"><strong>".$lang_block['BLOCK_USERINFO_PN_TITLE']."</strong></a><br />\n";
    $content .= "<img src=\"". evo_image('email-r.gif', 'blocks') ."\" height=\"10\" width=\"14\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_PN_UNREAD'].": <strong>".intval($newpms)."</strong><br />\n";
    $content .= "<img src=\"". evo_image('email-g.gif', 'blocks') ."\" height=\"10\" width=\"14\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_PN_READ'].": <strong>".intval($oldpms)."</strong><br />\n<hr noshade='noshade' />\n";
    if (is_user()) {
        $content .= "<u><strong>".$lang_block['BLOCK_USERINFO_GROUPS_TITLE'].":</strong></u><br />\n";
        $result = $db->sql_query("SELECT g.group_name FROM (".GROUPS_TABLE." g LEFT JOIN ".USER_GROUP_TABLE." ug on ug.group_id=g.group_id) WHERE ug.user_id='$uid' and g.group_description != 'Personal User'");
        if ($db->sql_numrows($result) == 0) {
           $content .= "<img src=\"". evo_image('arrow.png', 'blocks') ."\" align=\"middle\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_GROUPS_MEMBER_NONE']."<br />";
        } else {
           while(list($gname) = $db->sql_fetchrow($result, SQL_NUM)) {
              $gname = GroupColor($gname);
              $content .= "<img src=\"". evo_image('arrow.png', 'blocks') ."\" align=\"middle\" alt=\"\" /> $gname<br />";
           }
        }
        $db->sql_freeresult($result);
        $content .= "<hr noshade='noshade' />";
    }
} else {
    $content .= "<img src=\"". evo_image('group-4.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_WELCOME'].", <strong>".$evoconfig['anonymous']."</strong>\n<hr />";
    $content .= $lang_block['BLOCK_USERINFO_LOGIN_USERNAME']." <br /><input type=\"text\" name=\"username\" size=\"10\" maxlength=\"25\" /><br />";
    $content .= $lang_block['BLOCK_USERINFO_LOGIN_PW']." <br /><input type=\"password\" name=\"user_password\" size=\"10\" maxlength=\"20\" /><br />";
    $gfxchk = array(2,4,5,7);
    $content .= security_code($gfxchk, 'stacked');
    $content .= "<input type=\"hidden\" name=\"op\" value=\"login\" />";
    $content .= "<input type=\"submit\" value=\"".$lang_block['BLOCK_USERINFO_LOGIN_DOIT']."\" />\n (<a href=\"modules.php?name=Your_Account&amp;op=new_user\">".$lang_block['BLOCK_USERINFO_REGISTER_DOIT']."</a>)<hr />";
}
$content .= "<img src=\"". evo_image('group-2.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" />&nbsp;<strong><u>".$lang_block['BLOCK_USERINFO_MEMBERS_TITLE'].":</u></strong><br />\n";
$content .= "<img src=\"". evo_image('ur-moderator.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_MEMBERS_NEWEST'].": <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$lastuser\"><strong>$lastuser</strong></a><br />\n";
$content .= "<img src=\"". evo_image('ur-author.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_MEMBERS_NEWTODAY'].": <strong>$userCount</strong><br />\n";
$content .= "<img src=\"". evo_image('ur-admin.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_MEMBERS_NEWYESTERDAY'].": <strong>$userCount2</strong><br />\n";
$content .= "<img src=\"". evo_image('ur-guest.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_MEMBERS_TOTAL'].": <strong>$numrows</strong><br />\n<hr />\n";
$content .= "<img src=\"". evo_image('group-3.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" />&nbsp;<strong><u>".$lang_block['BLOCK_USERINFO_ONLINE_TITLE'].":</u></strong>\n<br />\n";
$content .= "<img src=\"". evo_image('ur-anony.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_ONLINE_GUESTS'].": <strong>$guest_online_num</strong><br />\n";
$content .= "<img src=\"". evo_image('ur-member.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_ONLINE_MEMBER'].": <strong>$member_online_num</strong><br />\n";
$content .= "<img src=\"". evo_image('ur-registered.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" /> ".$lang_block['BLOCK_USERINFO_ONLINE_TOTAL'].": <strong>$who_online_num</strong><br />\n";
$content .= "<hr noshade='noshade' />\n<img src=\"". evo_image('group-1.png', 'blocks') ."\" height=\"14\" width=\"17\" alt=\"\" />&nbsp;<strong><u>".$lang_block['BLOCK_USERINFO_ONLINE'].":</u></strong><br />$who_online_now";
$content .= "</form>";

?>