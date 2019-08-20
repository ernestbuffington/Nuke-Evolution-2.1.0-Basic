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

if (defined('ADMIN_FILE')) {
    global $lang_evo_userblock;
}

global $evouserinfo_login;

function evouserinfo_login () {
   global $lang_evo_userblock, $evouserinfo_login;

    $evouserinfo_login .= "<form action=\"modules.php?name=Your_Account\" method=\"post\">\n";
    $evouserinfo_login .= "<table border=\"0\" align=\"center\">";
    $evouserinfo_login .= "<tr><td>\n";
    $evouserinfo_login .= "<img src=\"".evo_image('arrow.png', 'evo_userinfo')."\" alt=\"\" style=\"vertical-align:middle\" />\n";
    if (defined('ADMIN_FILE')) {
        $evouserinfo_login .= $lang_evo_userblock['BLOCK']['LOGIN']['REG']."<br />\n";
    } else {
        $evouserinfo_login .= "<a href=\"modules.php?name=Your_Account&amp;op=new_user\">".$lang_evo_userblock['BLOCK']['LOGIN']['REG']."</a><br />\n";
    }
    $evouserinfo_login .= "<img src=\"".evo_image('arrow.png', 'evo_userinfo')."\" alt=\"\" style=\"vertical-align:middle\" />\n";
    if (defined('ADMIN_FILE')) {
        $evouserinfo_login .= $lang_evo_userblock['BLOCK']['LOGIN']['LOST']."<br />\n";
    } else {
        $evouserinfo_login .= "<a href=\"modules.php?name=Your_Account&amp;op=pass_lost\">".$lang_evo_userblock['BLOCK']['LOGIN']['LOST']."</a><br />\n";
    }
    $evouserinfo_login .= "<img src=\"".evo_image('arrow.png', 'evo_userinfo')."\" alt=\"\" style=\"vertical-align:middle\" />\n";
    $evouserinfo_login .= "<a href=\"modules.php?name=Your_Account&amp;op=ShowCookiesRedirect\">".$lang_evo_userblock['BLOCK']['LOGIN']['COOKIECLEAR']."</a>\n";
    $evouserinfo_login .= "</td></tr>\n<tr><td align=\"center\">\n";
    //Login
    $evouserinfo_login .= $lang_evo_userblock['BLOCK']['LOGIN']['USERNAME']."<br /><input type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\" /></td></tr>\n";
    $evouserinfo_login .= "<tr><td align=\"center\">".$lang_evo_userblock['BLOCK']['LOGIN']['PASSWORD']."<br /><input type=\"password\" name=\"user_password\" size=\"15\" maxlength=\"20\" /><br />\n";
    $gfxchk = array(2,4,5,7);
    $evouserinfo_login .= security_code($gfxchk, 'doubleline', 0);
    $evouserinfo_login .= "</td><td align=\"center\">";
    $evouserinfo_login .= "<input type=\"hidden\" name=\"op\" value=\"login\" /></td></tr>\n";
    $evouserinfo_login .= "<tr><td align=\"center\"><input type=\"submit\" value=\"".$lang_evo_userblock['BLOCK']['LOGIN']['LOGIN']."\" /></td></tr></table></form>\n";
}

if (!is_user()) {
    evouserinfo_login();
} else {
    $evouserinfo_login .= "<table border=\"0\">";
    $evouserinfo_login .= "<tr><td>\n";
    $evouserinfo_login .= "<img src=\"".evo_image('arrow.png', 'evo_userinfo')."\" alt=\"\" style=\"vertical-align:middle\" />\n";
    if (defined('ADMIN_FILE')) {
        $evouserinfo_login .= "".$lang_evo_userblock['BLOCK']['LOGIN']['LOGOUT']."<br />\n";
    } else {
    	  $evouserinfo_login .= "<a href=\"modules.php?name=Your_Account&amp;op=logout\">".$lang_evo_userblock['BLOCK']['LOGIN']['LOGOUT']."</a><br />\n";
    }
    $evouserinfo_login .= "<img src=\"".evo_image('arrow.png', 'evo_userinfo')."\" alt=\"\" style=\"vertical-align:middle\" />\n";
    if (defined('ADMIN_FILE')) {
        $evouserinfo_login .= "".$lang_evo_userblock['BLOCK']['LOGIN']['COOKIECLEAR']."</a>\n";
    } else {
        $evouserinfo_login .= "<a href=\"modules.php?name=Your_Account&amp;op=ShowCookiesRedirect\">".$lang_evo_userblock['BLOCK']['LOGIN']['COOKIECLEAR']."</a>\n";
    }
    $evouserinfo_login .= "</td></tr>\n";
    $evouserinfo_login .= "</table>\n";
}
$evouserinfo_login .= "<br />";

?>