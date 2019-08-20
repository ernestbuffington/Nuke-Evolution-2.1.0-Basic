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

global $db, $cache, $evoconfig, $plus_minus_images, $userinfo, $lang_block;
$block_name = str_replace('block-', '', (str_replace('.php', '', basename(__FILE__))));

function block_modules_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('modules', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        // All Categories and their active Modules sorted by Categorie Position and Module Position
        $result = $db->sql_query("SELECT `nmc`.`cid`, `nmc`.`name`, `nmc`.`image`, `nmc`.`collapse`, `nm`.`title`, `nm`.`custom_title`, `nm`.`view`, `nm`.`groups`, `nm`.`inmenu`
                                FROM `"._MODULES_CATEGORIES_TABLE."` AS `nmc` Inner Join `"._MODULES_TABLE."` AS `nm` ON `nm`.`cat_id` = `nmc`.`cid`
                                WHERE `nm`.`active` =  '1' AND `nm`.`inmenu` =  '1'
                                ORDER BY `nmc`.`pos` ASC, `nm`.`pos` ASC");
        $a = 0;
        while (list($cid, $cat_name, $cat_image, $collapse, $mod_title, $mod_custtitle, $mod_view, $mod_groups, $inmenu) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['cid']           = $cid;
            $blockcache[$a]['cat_name']      = $cat_name;
            $blockcache[$a]['cat_image']     = $cat_image;
            $blockcache[$a]['cat_collapse']  = $collapse;
            $blockcache[$a]['mod_title']     = $mod_title;
            $blockcache[$a]['mod_custtitle'] = $mod_custtitle;
            $blockcache[$a]['mod_view']      = $mod_view;
            $blockcache[$a]['mod_groups']    = $mod_groups;
            $blockcache[$a]['mod_inmenu']    = $inmenu;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['active'] = $a;
        // All inactive Modules sorted by Module Position
        $result = $db->sql_query("SELECT `nm`.`title`, `nm`.`custom_title`, `nm`.`view`, `nm`.`groups`, `nm`.`inmenu`
                                FROM `"._MODULES_TABLE."` AS `nm`
                                WHERE `nm`.`active` =  '0' OR `nm`.`inmenu` = '0' OR `nm`.`cat_id` = '0'
                                ORDER BY `nm`.`pos` ASC");
        while (list($mod_title, $mod_custtitle, $mod_view, $mod_groups, $inmenu) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['cid']           = 0;
            $blockcache[$a]['cat_name']      = '';
            $blockcache[$a]['cat_image']     = '';
            $blockcache[$a]['cat_collapse']  = 1;
            $blockcache[$a]['mod_title']     = $mod_title;
            $blockcache[$a]['mod_custtitle'] = $mod_custtitle;
            $blockcache[$a]['mod_view']      = $mod_view;
            $blockcache[$a]['mod_groups']    = $mod_groups;
            $blockcache[$a]['mod_inmenu']    = $inmenu;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $blockcache[0]['inactive'] = $a;
        $cache->save('modules', 'blocks', $blockcache);
    }
    return $blockcache;
}

function moduleblock_image($name) {
    if(empty($name)) return '';
    if (substr($name,0,strlen('http://')) == 'http://') return $name;
    return evo_image($name, 'blocks/modules');
}

$blocksession   = block_modules_cache($evoconfig['block_cachetime']);
$block_active   = '';
$block_inactive = '';
get_blocklang($block_name);
// Let's build our active module shown in menue
// They are sorted by category and position-number
// so we have only to run through array
$block_home = (isset($lang_block['MODULES_HOME']) ? $lang_block['MODULES_HOME'] : $lang_block['BLOCK_MODULES_HOME']);
$block_cat_home = (isset($lang_block['MODULES_CAT_HOME']) ? $lang_block['MODULES_CAT_HOME'] : $lang_block['BLOCK_MODULES_HOME']);
$block_active .= "<img src=\"".evo_image('icon_home.png', 'blocks/modules')."\" alt=\"".$block_cat_home."\" />&nbsp;<span style=\"font-weight: bold;\">".$block_cat_home."</span><br />\n";
$block_active .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\">".$block_home."</a><br />\n";
for ($i = 1; $i <= $blocksession[0]['active']; $i++) {
    $mod_view     = $blocksession[$i]['mod_view'];
    $mod_name     = $blocksession[$i]['mod_title'];
    $mod_custname = ($blocksession[$i]['mod_custtitle'] ? $blocksession[$i]['mod_custtitle'] : $blocksession[$i]['mod_title']);
    $mod_groups   = $blocksession[$i]['mod_groups'];
    $cat_name     = $blocksession[$i]['cat_name'];
    $cat_id       = $blocksession[$i]['cid'];
    $cat_image    = $blocksession[$i]['cat_image'];
    $cat_collapse = $blocksession[$i]['cat_collapse'];
    $old_cat      = (($i == 1) ? $cat_id : $old_cat);
    $show = 0;
    if (isset($lang_block['MODULES_CAT_'.$cat_name]) && (!empty($lang_block['MODULES_CAT_'.$cat_name]))) {
        $cat_name = $lang_block['MODULES_CAT_'.$cat_name];
    }
    if (isset($lang_block['MODULES_'.$mod_name]) && (!empty($lang_block['MODULES_'.$mod_name]))) {
        $mod_custname = $lang_block['MODULES_'.$mod_name];
    } else if (isset($lang_block['MODULES_'.$mod_custname]) && (!empty($lang_block['MODULES_'.$mod_custname]))) {
        $mod_custname = $lang_block['MODULES_'.$mod_custname];
    }

    switch ($mod_view) {
        case (0): $show = 1; break; // default value in table -> everyone
        case (1): $show = 1; break; // show to all visitors
        case (3): $show = (is_user() ? 1 : 0); break; // show only for registered users
        case (4): $show = (is_mod_admin($mod_name) ? 1 : 0); break; // show only to Admins
        case (6):
                   $groups = (!empty($mod_groups)) ? $groups = explode('-', $mod_groups) : '';
                   $ingroup = false;
                   if(is_array($groups)){
                       foreach ($groups as $group) {
                            if (isset($userinfo['groups'][$group])) {
                                $ingroup = true;
                            }
                       }
                   }
                   $show = ($ingroup ? 1 : 0); break;
    }
    if (($old_cat != $cat_id) && ($i != 1)) {
            $block_active .= "</div>\n";
    }
    if (($old_cat != $cat_id) || $i == 1) {
        $img           = moduleblock_image($cat_image);
        $img           = (!empty($img)) ? "<img src=\"". $img."\" alt=\"\" />" : '';
        if ($evoconfig['collapse_start'] == true) {
            $image = $plus_minus_images['minus'];
            $name = 'minus';
        } else {
            $image = $plus_minus_images['plus'];
            $name = 'plus';
        }
        if ($evoconfig['module_collapse'] == true) {
            $c_image       = "&nbsp;&nbsp;<img src=\"".$image."\" class=\"showstate\" name=\"".$name."block_modules".$cat_id."\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'moduleblock".$cat_id."')\" alt=\"\" style=\"cursor: pointer;\" />";
            $block_active .= $img."&nbsp;<span style=\"font-weight: bold;\">".$cat_name."</span>".$c_image."<br />\n";
            if ($cat_collapse == false) {
                $style = '';
            } else {
                $style = "style='display: none;'";
            }
            $block_active .= "<div id='moduleblock".$cat_id."' class='switchcontent' $style>";
        } else {
            $block_active .= $img."&nbsp;<span style=\"font-weight: bold;\">".$cat_name."</span><br />\n";
            $style = '';
            $block_active .= "<div id='moduleblock".$cat_id."' $style>";
        }
            $old_cat       = $cat_id;
    }

    if ($show == 1) {
        if(substr($mod_name,0,3) == '~l~') {
            $target = (strstr($mod_custname, 'HTTP') ? 'target="_blank"' : '');
            $block_active .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".htmlentities($mod_custname)."\" ".$target.">".substr($mod_name,3)."</a><br />\n";
        } else {
            $block_active .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"modules.php?name=".htmlentities($mod_name)."\" >".$mod_custname."</a><br />\n";
        }
    }
}
$block_active .= "</div>\n";

$block_invisible  = '';
$block_inactiv    = '';
$block_inactlinks = '';
$block_admin      = '';

if (is_admin()) {
    $block_admin = "<div style='width: 100%;'>\n";
    // Let's get inactive modules for admin
    for ($i = $blocksession[0]['active'] + 1; $i <= $blocksession[0]['inactive']; $i++) {
        $mod_view     = $blocksession[$i]['mod_view'];
        $mod_name     = $blocksession[$i]['mod_title'];
        $mod_custname = $blocksession[$i]['mod_custtitle'];
        $mod_groups   = $blocksession[$i]['mod_groups'];
        $mod_inmenu   = $blocksession[$i]['mod_inmenu'];
        $cat_name     = $blocksession[$i]['cat_name'];
        $cat_id       = $blocksession[$i]['cid'];
        if (isset($lang_block['MODULES_CAT_'.$cat_name]) && (!empty($lang_block['MODULES_CAT_'.$cat_name]))) {
            $cat_name = $lang_block['MODULES_CAT_'.$cat_name];
        }
        if (isset($lang_block['MODULES_'.$mod_name]) && (!empty($lang_block['MODULES_'.$mod_name]))) {
            $mod_custname = $lang_block['MODULES_'.$mod_name];
        } else if (isset($lang_block['MODULES_'.$mod_custname]) && (!empty($lang_block['MODULES_'.$mod_custname]))) {
            $mod_custname = $lang_block['MODULES_'.$mod_custname];
        }
        if(substr($mod_name,0,3) == '~l~') {
            $block_inactlinks .= '<option value="'.htmlentities($mod_custname).'">'.substr($mod_name,3)."</option>\n";
        } elseif ($mod_inmenu == 0) {
            $block_invisible  .= '<option value="modules.php?name='.htmlentities($mod_name).'">'.$mod_custname."</option>\n";
        } else {
            $block_inactiv    .= '<option value="modules.php?name='.htmlentities($mod_name).'">'.$mod_custname."</option>\n";
        }
    }
    $block_admin .= '<select name="name" style="width:98%;" onchange="top.location.href=this.options[this.selectedIndex].value">';
    $block_admin .= '<option value="">'.$lang_block['BLOCK_MODULES_MORE']."</option>\n";
    if (!empty($block_invisible)) {
        $block_admin .= "<optgroup label=\"".$lang_block['BLOCK_MODULES_INVISIBLE']."\">\n";
        $block_admin .= $block_invisible;
        $block_admin .= "</optgroup>\n";
    }
    if (!empty($block_inactiv)) {
        $block_admin .= "<optgroup label=\"".$lang_block['BLOCK_MODULES_INACTIVE_MODULE']."\">\n";
        $block_admin .= $block_inactiv;
        $block_admin .= "</optgroup>\n";
    }
    if (!empty($block_inactlinks)) {
        $block_admin .= "<optgroup label=\"".$lang_block['BLOCK_MODULES_INACTIVE_LINKS']."\">\n";
        $block_admin .= $block_inactlinks;
        $block_admin .= "</optgroup>\n";
    }
    $block_admin .= "</select>\n";
    $block_admin .= "</div>\n";
}

$content = "<div style='width: 98%;'>\n";
$content .= $block_active."<br />\n";
$content .= $block_admin;
$content .= "</div>\n";

?>