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

global $db, $cache, $evoconfig, $userinfo, $_GETVAR, $board_config, $currentlang, $admin_file, $lang_evo_userblock;

$module_name = 'Evo_UserBlock';
if (!defined('EVO_BLOCK')) {define('EVO_BLOCK', true);}
get_lang($module_name);

if ( !function_exists('evouserinfo_expand_collapse_start') ) {
    function evouserinfo_expand_collapse_start($name) {
        global $evoconfig, $evouserinfo_admin, $plus_minus_images;
        if (!$evoconfig['evouserinfo_ec']) return "<br />";
        if (!$evouserinfo_admin) {
            return "&nbsp;&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"evouserinfo_".$name."\" width=\"9\" height=\"9\" border=\"0\" alt=\"\" style=\"cursor: pointer;\" onclick=\"expandcontent(this, '".$name."')\" /><div id=\"".$name."\" class=\"switchcontent\">";
        } else {
            return "&nbsp;&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"evouserinfo_".$name."\" width=\"9\" height=\"9\" border=\"0\" alt=\"\" style=\"cursor: pointer;\" /><div id=\"".$name."\" class=\"switchcontent\">";
        }
    }

    function evouserinfo_expand_collapse_end() {
        global $evoconfig;
        if (!$evoconfig['evouserinfo_ec']) return '';
        return "</div><br />\n";
    }
}

function block_Evo_UserInfo_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('evo_userinfo', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT `name`, `value` FROM `'._BLOCK_EVO_USERINFO_ADDONS_TABLE.'`');
        while (list($name, $value) = $db->sql_fetchrow($result)) {
            $blockcache[1][$name]  = $value;
        }
        $db->sql_freeresult($result);
        $result = $db->sql_query('SELECT `name`, `filename`, `image` FROM `'._BLOCK_EVO_USERINFO_TABLE.'` WHERE `active`= 1 ORDER BY `position`');
        $a = 1;
        while (list($name, $filename, $image) = $db->sql_fetchrow($result)) {
            if ($filename != 'Break') {
                if(@file_exists(NUKE_MODULES_DIR .'Evo_UserBlock/addons/'.$filename.'.php')) {
                    $a++;
                    $blockcache[$a]['name']     = $name;
                    $blockcache[$a]['filename'] = $filename;
                    $blockcache[$a]['image']    = $image;
                }
            }
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $blockcache[0]['max']          = $a;
        $cache->save('evo_userinfo', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_Evo_UserInfo_cache($evoconfig['block_cachetime']);

//include_once(NUKE_MODULES_DIR .'Evo_UserBlock/addons/core.php');
$content = "<div style='width:100%;'>\n";
for ($a = 2, $max = $blocksession[0]['max']; $a <= $max; $a++) {
    @include_once(NUKE_MODULES_DIR .'Evo_UserBlock/addons/'.$blocksession[$a]['filename'].'.php');
    $output = 'evouserinfo_'.$blocksession[$a]['filename'];
    $content .= $$output;
    if(isset($$output) && !empty($$output)) {
        $content .= "<hr />";
    }
}
$content .= "</div>\n";
?>