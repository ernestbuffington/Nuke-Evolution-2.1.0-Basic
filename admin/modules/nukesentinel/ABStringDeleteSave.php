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
    $min        = $_GETVAR->get('min', '_REQUEST', 'int');
    $sid        = $_GETVAR->get('sid', '_REQUEST', 'int');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string');

    $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_STRINGS_TABLE."` WHERE `sid`='".$sid."' LIMIT 0,1");
    $db->sql_uquery("DELETE FROM `"._SENTINEL_STRINGS_TABLE."` WHERE `sid`='".$sid."'");
    $db->sql_uquery("ALTER TABLE `"._SENTINEL_STRINGS_TABLE."` ORDER BY `string`");
    $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_STRINGS_TABLE."`");
    $list_string = explode("\r\n", $ab_config['list_string']);
    $list_string = str_replace($getIPs['string'], "", $list_string);
    rsort($list_string);
    $endlist = count($list_string)-1;
    if (empty($list_string[$endlist])) {
        array_pop($list_string);
    }
    sort($list_string);
    $list_string = implode("\r\n", $list_string);
    absave_config("list_string", $list_string);
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;direction='.$direction);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>