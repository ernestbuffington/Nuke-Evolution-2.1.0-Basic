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

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

global $db, $evoconfig, $board_config;
include_once(NUKE_BASE_DIR.'header.php');
$result = $db->sql_query("SELECT user_email, user_website, username, user_password FROM "._USERS_TABLE." WHERE user_id='$uid'");
list($email, $url, $uname, $pass) = $db->sql_fetchrow($result);
if ($code == $pass) {
    if ($evoconfig['senddeletemail'] && $evoconfig['servermail']) {
        $to = $evoconfig['adminmail'];
        $subject = EVO_SERVER_SITENAME." - "._MEMDEL;
        $message = "$uname has been deleted from ".EVO_SERVER_SITENAME.".<br />";
        $message .= "-----------------------------------------------------------<br />";
        $message .= _YA_NOREPLY . '<br /><br />';
        $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
        $return  = evo_mail($to, $subject, $message, $email);
    }
    $db->sql_uquery("UPDATE "._USERS_TABLE." SET name='"._MEMDEL."', user_password='', user_website='', user_sig='', user_level='-1', user_active='0', user_allow_pm='0' WHERE user_id='$uid'");
    evo_setcookie ('user', 'delete', -1);
    $result = $db->sql_uquery("DELETE FROM "._SESSION_TABLE." WHERE uname='$uname'");
    $db->sql_uquery("OPTIMIZE TABLE "._SESSION_TABLE);
    echo "<meta http-equiv=\"refresh\" content=\"2;url=".EVO_SERVER_URL."\" />";
    title(_ACCTDELETE);
} else {
    title(_YOUBAD);
}
include_once(NUKE_BASE_DIR.'footer.php');

?>