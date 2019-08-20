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

$module_name = basename(dirname(dirname(__FILE__)));
get_lang($module_name);

function evouserinfo_get_addon_all () {
    global $db, $lang_evo_userblock;
    $sql = 'SELECT value, name from `'._BLOCK_EVO_USERINFO_ADDONS_TABLE.'`';
    if(!$result = $db->sql_query($sql)) {
        DisplayError($lang_evo_userblock['BLOCK']['ERR_NF']);
    }
    while ($row = $db->sql_fetchrow($result)) {
        $values[$row['name']] = $row['value'];
    }
    $db->sql_freeresult($result);
    return $values;
}

function evouserinfo_expand_collapse_start($name) {
    global $evoconfig, $evouserinfo_admin, $plus_minus_images;
    if (!$evoconfig['evouserinfo_ec']) return "<br />";
    if (!$evouserinfo_admin) {
        return "&nbsp;&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" border=\"0\" alt=\"\" style=\"cursor: pointer;\" onclick=\"expandcontent(this, '".$name."')\" /><div id=\"".$name."\" class=\"switchcontent\">";
    } else {
        return "&nbsp;&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" border=\"0\" alt=\"\" style=\"cursor: pointer;\" /><div id=\"".$name."\" class=\"switchcontent\">";
    }
}

function evouserinfo_expand_collapse_end() {
    global $evoconfig;
    if (!$evoconfig['evouserinfo_ec']) return '';
    return "</div><br />\n";
}

global $blocksession;
$blocksession[1] = evouserinfo_get_addon_all();

?>