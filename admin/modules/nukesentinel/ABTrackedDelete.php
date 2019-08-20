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
    $max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
    $column     = $_GETVAR->get('column', '_REQUEST', 'string', 'user_agent');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'asc');
    $showmodule = $_GETVAR->get('showmodule', '_REQUEST', 'string', 'All_Modules');
    $tid        = $_GETVAR->get('tid', '_REQUEST', 'int');
    if(preg_match('#All.*Modules#', $showmodule) || !$showmodule ) {
        $modfilter = '';
    } elseif (preg_match('#Admin#', $showmodule)) {
        $modfilter = "AND page LIKE '%".$admin_file.".php%'";
    } elseif (preg_match('#Index#', $showmodule)) {
        $modfilter = "AND page LIKE '%index.php%'";
    } elseif (preg_match('#Backend#', $showmodule)) {
        $modfilter = "AND page LIKE '%backend.php%'";
    } else {
        $modfilter = "AND page LIKE '%name=$showmodule%'";
    }
    $deleterow = $db->sql_ufetchrow("SELECT `user_id`, `ip_addr` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `tid`='$tid' LIMIT 0,1");
    $db->sql_uquery("DELETE FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `user_id`='".$deleterow['user_id']."' AND `ip_addr`='".$deleterow['ip_addr']."' $modfilter");
    $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_TRACKED_IPS_TABLE."`");
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;showmodule='.$showmodule.'&amp;sip='.$sip);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>