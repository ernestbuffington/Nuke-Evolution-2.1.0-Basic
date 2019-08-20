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

global $userinfo, $db;

if (is_user()) {
    $content  = "<div style='width: 100%; text-align: center;'>\n";
    $content .= $lang_block['BLOCK_USERINFO_WELCOME']."<br /><br /><span style='font-weight: bold;'>&nbsp;".UsernameColor($userinfo['username'])."</span><br /><br />\n";
    $content .= "(<a href='modules.php?name=Your_Account&amp;op=logout'>".$lang_block['BLOCK_USERINFO_LOGOUT_DOIT']."</a>)<br />\n";
    $content .= "<hr noshade='noshade' size='1' /><br />\n";
    if(is_active('Private_Messages')) {
        $newpms = check_priv_mess($userinfo['user_id']);
        $savpms = $db->sql_ufetchrow("select count(privmsgs_to_userid) as no from ".PRIVMSGS_TABLE." where privmsgs_to_userid='".$userinfo['user_id']."' and privmsgs_type='3'");
        $oldpms = $db->sql_ufetchrow("select count(privmsgs_to_userid) as no from ".PRIVMSGS_TABLE." where privmsgs_to_userid='".$userinfo['user_id']."' and privmsgs_type='0'");
        $totpms = $newpms + $oldpms['no'] + $savpms['no'];
        $content .= "<span style='font-weight: bold;'><a href='modules.php?name=Private_Messages'>".$lang_block['BLOCK_USERINFO_PN_TITLE'].":</a></span>\n";
        $content .= "</div><br />\n";
        $content .= "<div style='width: 100%; text-align: left;'>\n";
        $content .= "<img src=\"". evo_image('email-y.gif', 'blocks') ."\" height=\"10\" width=\"14\" alt=\"\" />&nbsp;<a href='modules.php?name=Private_Messages&amp;folder=inbox'><span style='font-weight: bold; font-size: large;'></span>&nbsp;".$lang_block['BLOCK_USERINFO_PN_UNREAD'].":&nbsp;".$newpms."</a><br />\n";
        $content .= "<img src=\"". evo_image('email-r.gif', 'blocks') ."\" height=\"10\" width=\"14\" alt=\"\" />&nbsp;<a href='modules.php?name=Private_Messages&amp;folder=inbox'><span style='font-weight: bold; font-size: large;'></span>&nbsp;".$lang_block['BLOCK_USERINFO_PN_READ'].  ":&nbsp;".$oldpms['no']."</a><br />\n";
        $content .= "<img src=\"". evo_image('email-y.gif', 'blocks') ."\" height=\"10\" width=\"14\" alt=\"\" />&nbsp;<a href='modules.php?name=Private_Messages&amp;folder=savebox'><span style='font-weight: bold; font-size: large;'></span>&nbsp;".$lang_block['BLOCK_USERINFO_PN_ARCHIVE']. ":&nbsp;".$savpms['no']."</a><br />\n";
        $content .= "<span style='font-weight: bold; font-size: large;'></span>".$lang_block['BLOCK_USERINFO_PN_TOTAL'].":&nbsp;".$totpms."<br />\n";
        $content .= "</div>\n";
        $content .= "<hr noshade='noshade' size='1' />\n";
    }
} else {
    $content  = "<div style='width: 100%; text-align: center;'>\n";
    $content .= $lang_block['BLOCK_USERINFO_WELCOME']."<br /><br /><span style='font-weight: bold;'>&nbsp;".$lang_block['BLOCK_USERINFO_GUEST']."</span><br /><br />\n";
    $content .= "<form action='modules.php?name=Your_Account' method='post'>\n";
    $content .= "<span style='text-align: center;'>".$lang_block['BLOCK_USERINFO_LOGIN_USERNAME'].":<br /><input type='text' name='username' size='15' maxlength='25' /></span><br />\n";
    $content .= "<span style='text-align: center;'>".$lang_block['BLOCK_USERINFO_LOGIN_PW'].":<br /><input type='password' name='user_password' size='15' maxlength='20' /></span>\n";
    $content .= "<span style='text-align: center;'><br /><br />";
    $gfxchk = array(2,4,5,7);
    $content .= security_code($gfxchk, 'stacked');
    $content .= "</span><br />\n";
    $content .= "<input type='hidden' name='op' value='login' />\n";
    $content .= "<span style='text-align: center;'><br /><input type='submit' value='".$lang_block['BLOCK_USERINFO_LOGIN_DOIT']."' />&nbsp;<br />(<a href='modules.php?name=Your_Account&amp;op=new_user'>".$lang_block['BLOCK_USERINFO_REGISTER_DOIT']."</a>)</span>\n";
    $content .= "</form>\n";
    $content .= "</div>\n";
}

?>