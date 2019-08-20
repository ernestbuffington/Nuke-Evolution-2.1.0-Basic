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

global $admin_file, $db, $ab_config, $_GETVAR, $bgcolor2, $bgcolor1;

if (is_admin()) {

    $xop        = $_GETVAR->get('xop', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $hid        = $_GETVAR->get('hid', '_REQUEST', 'int');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'asc');

    $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_HARVESTER_TABLE."` WHERE `hid`='".$hid."' LIMIT 0,1");
    $db->sql_uquery("DELETE FROM `"._SENTINEL_HARVESTER_TABLE."` WHERE `hid`='".$hid."'");
    $db->sql_uquery("ALTER TABLE `"._SENTINEL_HARVESTER_TABLE."` ORDER BY `harvester`");
    $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_HARVESTER_TABLE."`");
    $list_harvester = explode("\r\n", $ab_config['list_harvester']);
    $list_harvester = str_replace($getIPs['harvester'], "", $list_harvester);
    rsort($list_harvester);
    $endlist = count($list_harvester)-1;
    if (empty($list_harvester[$endlist])) {
        array_pop($list_harvester);
    }
    sort($list_harvester);
    $list_harvester = implode("\r\n", $list_harvester);
    absave_config("list_harvester", $list_harvester);
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;direction='.$direction);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>