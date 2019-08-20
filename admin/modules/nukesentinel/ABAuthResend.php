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

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

global $_GETVAR, $admin_file, $db, $evoconfig;

if(is_god_admin()) {
    
    $a_aid = $_GETVAR->get('a_aid', '_GET', 'string');
    $aidrow = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_ADMINS_TABLE."` WHERE `aid`='$a_aid' LIMIT 0,1");
    $subject = _AB_ACCESSFOR.' '.$evoconfig['sitename'];
    $message  = _AB_HTTPONLY."\n";
    $message .= _AB_LOGIN.': '.$aidrow['login']."\n";
    $message .= _AB_PASSWORD.': '.$aidrow['password']."\n";
    $message .= _AB_PROTECTED.': ';
    if(!$aidrow['protected']) {
        $message .= _AB_NO."\n";
    } else {
        $message .= _AB_YES."\n";
    }
    $return = evo_mail($aidrow['email'], $subject, $message);
    redirect($admin_file.'.php?op=ABAuthList');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>