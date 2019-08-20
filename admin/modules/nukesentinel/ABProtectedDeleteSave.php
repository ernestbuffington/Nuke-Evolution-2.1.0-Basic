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

global $admin_file, $db, $_GETVAR;

if (is_admin()) {

    $ip_lo      = $_GETVAR->get('ip_lo', '_POST', 'string');
    $ip_hi      = $_GETVAR->get('ip_hi', '_POST', 'string');
    $xop        = $_GETVAR->get('xop', '_POST', 'string');
    $min        = $_GETVAR->get('min', '_POST', 'int', 0);
    $sip        = $_GETVAR->get('sip', '_POST', 'string');
    $column     = $_GETVAR->get('column', '_POST', 'string');
    $direction  = $_GETVAR->get('direction', '_POST', 'string'); 
    $db->sql_uquery("DELETE FROM `"._SENTINEL_PROTECTED_RANGES_TABLE."` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi'");
    $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_PROTECTED_RANGES_TABLE."`");
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;sip='.$sip);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>