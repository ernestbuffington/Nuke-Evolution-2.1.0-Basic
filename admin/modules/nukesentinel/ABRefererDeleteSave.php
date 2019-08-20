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
    $rid        = $_GETVAR->get('rid', '_REQUEST', 'int');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string');

    $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_REFERERS_TABLE."` WHERE `rid`='".$rid."' LIMIT 0,1");
    $db->sql_uquery("DELETE FROM `"._SENTINEL_REFERERS_TABLE."` WHERE `rid`='".$rid."'");
    $db->sql_uquery("ALTER TABLE `"._SENTINEL_REFERERS_TABLE."` ORDER BY `referer`");
    $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_REFERERS_TABLE."`");
    $list_referer = explode("\r\n", $ab_config['list_referer']);
    $list_referer = str_replace($getIPs['referer'], "", $list_referer);
    rsort($list_referer);
    $endlist = count($list_referer)-1;
    if (empty($list_referer[$endlist])) {
        array_pop($list_referer);
    }
    sort($list_referer);
    $list_referer = implode("\r\n", $list_referer);
    absave_config("list_referer", $list_referer);
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;direction='.$direction);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>