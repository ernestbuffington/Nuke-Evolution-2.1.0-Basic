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

global $db, $cache, $evoconfig, $plus_minus_images, $userinfo, $lang_block, $all_moduleblock_active, $all_moduleblock_cats, $content;
$block_name = str_replace('_all', '',(str_replace('block-', '', (str_replace('.php', '', basename(__FILE__))))));
get_blocklang($block_name);

function all_moduleblock_get_active() {
    global $db;

    $out = array();
    if(!($result = $db->sql_query("SELECT * FROM `"._MODULES_TABLE."` WHERE `active`='1' AND `inmenu`='1' AND `cat_id`<>0 ORDER BY `cat_id`, `pos` ASC"))) {
        return '';
    }
    while ($row = $db->sql_fetchrow($result)) {
        $out[$row['cat_id']][] = $row;
    }
    $db->sql_freeresult($result);
    return $out;
}

function all_moduleblock_get_cats() {
    global $db, $cache, $_GETVAR;
    static $cats;
    $catsave = $_GETVAR->get('save', '_POST', 'string');
    $catarea = $_GETVAR->get('area', '_GET', 'string');
    $use = (!empty($catsave) || $catarea == 'block') ? 0 : 1;
    if (isset($cats) && is_array($cats) && $use) {
        return $cats;
    }
    if((($cats = $cache->load('module_cats', 'config')) === false) || !isset($cats) || !$use) {
        $cats = array();
        if(!($result = $db->sql_query("SELECT * FROM `"._MODULES_CATEGORIES_TABLE."` ORDER BY `pos` ASC"))) {
            return '';
        }
        while ($row = $db->sql_fetchrow($result)) {
            $cats[] = $row;
        }
        $db->sql_freeresult($result);
        $cache->save('module_cats', 'config', $cats);
    }
    return $cats;
}

function all_moduleblock_image($name) {

    if(empty($name)) {
        return '';
    }
    if (substr($name,0,strlen('http://')) == 'http://') {
        return $name;
    }
    return evo_image($name, 'blocks/modules');
}

function all_moduleblock_display() {
    global $evoconfig, $all_moduleblock_active, $all_moduleblock_cats, $content, $plus_minus_images, $userinfo, $lang_block;

    if(!is_array($all_moduleblock_active) || !is_array($all_moduleblock_cats)) {
        return;
    }
    $cat['cid'] = 0;
    $c_image = ($evoconfig['module_collapse']) ? "&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" id=\"moduleblockallimg".$cat['cid']."\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'moduleblockall0')\" alt=\"\" style=\"cursor: pointer;\" />" : '';
    //Home
    $content .= "<img src=\"".evo_image('icon_home.png', 'blocks/modules')."\" alt=\"".$lang_block['MODULES_HOME']."\" />&nbsp;<span style=\"font-weight: bold;\">".$lang_block['MODULES_CAT_HOME']."</span>".$c_image."<br />\n";
    $content .= ($evoconfig['module_collapse']) ? "<div id=\"moduleblock0\" class=\"switchcontent\">\n" : '';
    $content .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\">".$lang_block['MODULES_HOME']."</a><br />\n";
    $content .= ($evoconfig['module_collapse']) ? "</div>\n" : '<br />';
    foreach ($all_moduleblock_cats as $cat) {
        if(isset($cat['cid']) && is_integer(intval($cat['cid']))) {
            if (!isset($all_moduleblock_active[intval($cat['cid'])])) {
                continue;
            }
            $mod_array = $all_moduleblock_active[intval($cat['cid'])];
            if(is_array($mod_array)) {
                $img = all_moduleblock_image($cat['image']);
                $img = (!empty($img)) ? "<img src=\"". $img."\" alt=\"\" />" : '';
                $c_image = ($evoconfig['module_collapse']) ? "&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" id=\"moduleblockallimg".$cat['cid']."\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'moduleblockall".$cat['cid']."')\" alt=\"\" style=\"cursor: pointer;\" />" : '';
                $content .= $img."&nbsp;<span style=\"font-weight: bold;\">".(isset($lang_block['MODULES_CAT_'.$cat['name']]) ? $lang_block['MODULES_CAT_'.$cat['name']] : $cat['name'])."</span>".$c_image."<br />\n";
                $content .= ($evoconfig['module_collapse']) ? "<div id=\"moduleblockall".$cat['cid']."\" class=\"switchcontent\">\n" : '';
                foreach ($mod_array as $module) {
                    $not_show = 0;
                    if ($module['view'] >= 2 && (!is_mod_admin($module['title']) || !is_admin()) ) {
                        if ($module['view'] == 2 && is_user()) {
                            $not_show = 1;
                            $error = $lang_block['BLOCK_MODULES_VIEWANON'];
                        } elseif ($module['view'] == 3 && !is_user()) {
                            $not_show = 1;
                            $error = $lang_block['BLOCK_MODULES_MODULEUSERS'];
                        } elseif ($module['view'] == 4) {
                            $not_show = 1;
                            $error = $lang_block['BLOCK_MODULES_MODULESADMINS'];
                        } elseif ($module['view'] == 6) {
                            $groups = (!empty($module['groups'])) ? $groups = explode('-', $module['groups']) : '';
                            $ingroup = false;
                            if(is_array($groups)){
                                foreach ($groups as $group) {
                                     if (isset($userinfo['groups'][$group])) {
                                         $ingroup = true;
                                     }
                                }
                                if ( !$ingroup ) {
                                    $not_show = 1;
                                    $error = $lang_block['BLOCK_MODULES_MODULESGROUP'];
                                }
                            }
                        }
                    }
                    if ( $not_show == 1 ) {
                        $not_show_img = evo_image_make_tag('locked.png', '', $error, 0, '', FALSE , '12px', '12px');
                        $content .= "&nbsp;&nbsp;".$not_show_img.(isset($lang_block['MODULES_'.$module['title']]) ? $lang_block['MODULES_'.$module['title']] : $module['title'])."<br />\n";
                    } else {
                        if(substr($module['title'],0,3) == '~l~') {
                            $target = (strstr($module['custom_title'], 'HTTP') ? 'target="_blank"' : '');
                            $content .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".htmlentities($module['custom_title'])."\" ".$target.">".substr($module['title'],3)."</a><br />\n";
                        } else {
                            $content .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"modules.php?name=".htmlentities($module['title'])."\" >".(isset($lang_block['MODULES_'.$module['title']]) ? $lang_block['MODULES_'.$module['title']] : $module['title'])."</a><br />\n";
                        }
                    }
                }
                $content .= ($evoconfig['module_collapse']) ? "</div>\n" : "";
            }
        }
    }
}

function all_moduleblock_get_inactive() {
    global $db, $cache, $lang_block;

    if(!($result = $db->sql_query("SELECT * FROM `"._MODULES_TABLE."` WHERE (`active`='0' OR `inmenu`='0' OR `cat_id`='0') AND `title` NOT LIKE '~l~%' ORDER BY `custom_title` ASC"))) {
        return '';
    }
    while ($row = $db->sql_fetchrow($result)) {
        $out[] = $row;
    }
    $db->sql_freeresult($result);
    return $out;
}

function all_moduleblock_get_inactive_links() {
    global $db, $cache, $lang_block;
    static $links;
    $use = (isset($_POST['save']) || (isset($_GET['area']) && $_GET['area'] == 'block')) ? 0 : 1;
    if (isset($links) && is_array($links) && $use) {
        return $links;
    }
    if ((($links = $cache->load('module_links', 'config')) === false) || !isset($links) || !$use) {
        $links = '';
        if(!($result = $db->sql_query("SELECT * FROM `"._MODULES_TABLE."` WHERE (`active`=0 OR `cat_id`='0') AND `title` LIKE '~l~%' ORDER BY `title` ASC"))) {
            return '';
        }
        while ($row = $db->sql_fetchrow($result)) {
            $links[] = $row;
        }
        $db->sql_freeresult($result);
        if(!empty($links) && is_array($links)) {
            $cache->save('module_links', 'config', $links);
        } else {
            $cache->delete('module_links', 'config');
        }
    }
    return $links;
}

function all_moduleblock_display_inactive() {
    global $all_moduleblock_invisible, $all_moduleblock_invisible_links, $content, $lang_block;

    $content .= "<div align=\"center\" style='width: 98%;'>\n";
    $content .= "<hr />\n";
    $content .= "<select name=\"name\" style='width: 98%;' onchange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
    $content .= "<option value=''>".$lang_block['BLOCK_MODULES_MORE']."</option>\n";
    $content .= "<optgroup label=\"".$lang_block['BLOCK_MODULES_INVISIBLE']."\">\n";
    if(is_array($all_moduleblock_invisible)) {
        foreach ($all_moduleblock_invisible as $module) {
            if ($module['active']) {
                $one = 1;
                $content .= "<option value=\"modules.php?name=".htmlentities($module['title'])."\">".(isset($lang_block['MODULES_'.$module['custom_title']]) ? $lang_block['MODULES_'.$module['custom_title']] : $module['custom_title'])."</option>\n";
            } else {
                $all_moduleblock_inactive[] = $module;
            }
        }
        if(!$one) {
            $content .= "<option value=''>".$lang_block['BLOCK_MODULES_NONE']."</option>\n";
        }
    } else {
        $content .= "<option value=''>".$lang_block['BLOCK_MODULES_NONE']."</option>\n";
    }
    $content .= "</optgroup>\n";
    $content .= "<optgroup label=\"".$lang_block['BLOCK_MODULES_INACTIVE_MODULE']."\">\n";
    if(is_array($all_moduleblock_inactive)) {
        foreach ($all_moduleblock_inactive as $module) {
            $content .= "<option value=\"modules.php?name=".htmlentities($module['title'])."\">".(isset($lang_block['MODULES_'.$module['custom_title']]) ? $lang_block['MODULES_'.$module['custom_title']] : $module['custom_title'])."</option>\n";
        }
    } else {
        $content .= "<option value=''>".$lang_block['BLOCK_MODULES_NONE']."</option>\n";
    }
    $content .= "</optgroup>\n";
    $content .= "<optgroup label=\"".$lang_block['BLOCK_MODULES_INACTIVE_LINK']."\">\n";
    if(is_array($all_moduleblock_invisible_links)) {
        foreach ($all_moduleblock_invisible_links as $link) {
            $content .= "<option value=\"".htmlentities($link['custom_title'])."\" target=\"_blank\">".substr($link['title'],3)."</option>\n";
        }
    } else {
        $content .= "<option value=''>".$lang_block['BLOCK_MODULES_NONE']."</option>\n";
    }
    $content .= "</optgroup>\n";
    $content .= "</select>\n";
    $content .= "</div>\n";
}

$content = "<div style='width: 98%;'>\n";
$main_module = main_module();
$all_moduleblock_active = all_moduleblock_get_active();
$all_moduleblock_cats = all_moduleblock_get_cats();
all_moduleblock_display();

if(is_admin()) {
    global $all_moduleblock_invisible, $all_moduleblock_invisible_links;
    $all_moduleblock_invisible = all_moduleblock_get_inactive();
    $all_moduleblock_invisible_links = all_moduleblock_get_inactive_links();
    all_moduleblock_display_inactive();
}
$content .= "</div>\n";

?>