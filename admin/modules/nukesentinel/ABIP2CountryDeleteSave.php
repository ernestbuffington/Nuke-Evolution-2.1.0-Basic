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

    $xop        = $_GETVAR->get('xop', '_REQUEST', 'string');
    $sip        = $_GETVAR->get('sip', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $ip_lo      = $_GETVAR->get('ip_lo', '_REQUEST', 'int');
    $ip_hi      = $_GETVAR->get('ip_hi', '_REQUEST', 'int');
    $column     = $_GETVAR->get('column', '_REQUEST', 'string');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string');
    $showcountry= $_GETVAR->get('showcountry', '_REQUEST', 'int');

    $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_IP2COUNTRY_TABLE."` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1");
    list($xcountry) = $db->sql_ufetchrow("SELECT `country` FROM `"._SENTINEL_COUNTRIES_TABLE."` WHERE `c2c`='".$getIPs['c2c']."' LIMIT 0,1");
    $db->sql_uquery("DELETE FROM `"._SENTINEL_IP2COUNTRY_TABLE."` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi'");
    $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_IP2COUNTRY_TABLE."`");
    $db->sql_uquery("UPDATE `"._SENTINEL_TRACKED_IPS_TABLE."` SET `c2c`='00' WHERE `ip_long` >= '$ip_lo' AND `ip_long` <= '$ip_hi'");
    $db->sql_uquery("UPDATE `"._SENTINEL_BLOCKED_IPS_TABLE."` SET `c2c`='00' WHERE `ip_long` >= '$ip_lo' AND `ip_long` <= '$ip_hi'");
    $db->sql_uquery("UPDATE `"._SENTINEL_BLOCKED_RANGES_TABLE."` SET `c2c`='00' WHERE `ip_lo` >= '$ip_lo' AND `ip_lo` <= '$ip_hi'");
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;sip='.$sip.'&amp;showcountry='.$showcountry);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>