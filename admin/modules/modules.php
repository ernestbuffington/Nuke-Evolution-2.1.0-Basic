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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$adminpoint = @basename(__FILE__,'.php');
global $evoconfig, $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin;

if(is_admin()) {
    getmodule_lang($adminpoint);
    update_modules();

    function modadmin_title () {
        global $admin_file, $adminpoint, $lang_admin;

        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=modules\">" . $lang_admin[$adminpoint]['MODULES_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin['KERNEL']['MAIN_BACK'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
    }

    function modadmin_get_modules ($mid='') {
        global $db;

        $mid = (!empty($mid)) ? 'WHERE mid='.$mid : '';
        if(!$result = $db->sql_query("SELECT `mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `blocks`, `groups` FROM `"._MODULES_TABLE."` $mid ORDER BY `mid` ASC")) {
            DisplayError($lang_admin[$adminpoint]['MODULES_NF_VALUES']);
        }
        if (!$out = $db->sql_fetchrowset($result)) {
            DisplayError($lang_admin[$adminpoint]['MODULES_NF_VALUES']);
        }
        $db->sql_freeresult($result);
        return $out;
    }

    function modadmin_activate ($module) {
        global $db, $cache, $debugger;

        $result = $db->sql_query('SELECT active FROM '._MODULES_TABLE." WHERE mid=$module");
        if($db->sql_numrows($result) > 0) {
            list($active) = $db->sql_fetchrow($result);
            if(is_numeric($active)) {
                $active = intval(!$active);
                $db->sql_query('UPDATE '._MODULES_TABLE." SET active='$active' WHERE mid=$module");
            }
        }
        $cache->delete('active_modules');
        $cache->resync();
    }

    function modadmin_activate_all ($type) {
        global $db, $cache;

        $active = ($type == 'all') ? '1;' : "0 WHERE `title` <> 'Your_Account' AND `title` <> 'Profile';";
        $sql = "UPDATE `"._MODULES_TABLE."` SET `active`=".$active;
        $db->sql_query($sql);
        $cache->delete('active_modules');
        $cache->resync();
    }

    function modadmin_home ($mid) {
        global $db, $cache;

        list($title) = $db->sql_ufetchrow("SELECT title FROM "._MODULES_TABLE." WHERE mid='$mid'",SQL_NUM);
        if ($title == '' || $title == 'Evo_UserBlock') {
            return false;
        }
        $db->sql_uquery("UPDATE "._MAIN_TABLE." SET main_module='$title'");
        $db->sql_uquery("UPDATE "._MODULES_TABLE." SET active=1, view=0 WHERE mid='$mid'");
        $cache->delete('main_module');
        $cache->delete('active_modules');
        $cache->resync();
    }

    function modadmin_display_modules ($modadmin_modules) {
        global $db, $admin_file, $bgcolor, $bgcolor2, $bgcolor3, $bgcolor4, $adminpoint, $lang_admin;

        if(!is_array($modadmin_modules)) {DisplayError($lang_admin[$adminpoint]['MODULES_NF_VALUES']);}
        $main_module = main_module();
        OpenTable();
        OpenTable();
        echo "<div align=\"center\"><strong>-=".$lang_admin[$adminpoint]['MODULES_MODULEINFO']."=-</strong><br />".$lang_admin[$adminpoint]['MODULES_MODULEHOMENOTE']."<br /><br />[<big><strong>&middot;</strong></big>]&nbsp;".$lang_admin[$adminpoint]['MODULES_NOTINMENU']."</div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=modules&amp;area=block\"><strong>" . $lang_admin[$adminpoint]['MODULES_BLOCK'] . "</strong></a> ]</div>\n";
        CloseTable();
        echo "<br /><br /><a href=\"".$admin_file.".php?op=modules&amp;a=all\">".$lang_admin[$adminpoint]['MODULES_ACTIVATE']." ".$lang_admin[$adminpoint]['MODULES_ALL']."</a>&nbsp;|&nbsp;";
        echo "<a href=\"".$admin_file.".php?op=modules&amp;a=none\">".$lang_admin[$adminpoint]['MODULES_DEACTIVATE']." ".$lang_admin[$adminpoint]['MODULES_ALL']."</a><br /><br />\n";
        echo "<form action=\"".$admin_file.".php?op=modules\" method=\"post\">\n";
        echo "<table border=\"0\" cellspacing=\"0\" width=\"100%\"><tr bgcolor=\"".$bgcolor2."\">\n";
        echo "<td align=\"center\"><strong>".$lang_admin[$adminpoint]['MODULES_ACTIVE']."<br />".$lang_admin[$adminpoint]['MODULES_DOUBLECLICK']."</strong></td>\n";
        echo "<td align=\"center\"><strong>Home</strong></td>\n";
        echo "<td align=\"center\"><strong>".$lang_admin[$adminpoint]['MODULES_TITLE']."</strong></td>\n";
        echo "<td align=\"center\"><strong>".$lang_admin[$adminpoint]['MODULES_CUSTOMTITLE']."</strong></td>\n";
        echo "<td align=\"center\" width=\"22%\"><strong>".$lang_admin[$adminpoint]['MODULES_VIEW']."</strong></td>\n";
        echo "<td align=\"center\" width=\"9%\"><strong>".$lang_admin[$adminpoint]['MODULES_BLOCKS_SHOW']."</strong></td>\n";
        echo "<td align=\"center\" width=\"12%\"><strong>".$lang_admin[$adminpoint]['MODULES_FUNCTIONS']."</strong></td></tr>\n";
        foreach ($modadmin_modules as $module) {
            if(substr($module['title'],0,3) == '~l~') {
                continue;
            }
            $bgcolor = ($bgcolor == '') ? ' bgcolor="'.$bgcolor3.'"' : '';
            $mid = $module['mid'];
            $who_view = '';
            if($module['view'] == 0 || $module['view'] == 1) {
                $who_view = $lang_admin[$adminpoint]['MODULES_MVALL'];
            } elseif($module['view'] == 2) {
                $who_view = $lang_admin[$adminpoint]['MODULES_MVANON'];
            } elseif($module['view'] == 3) {
                $who_view = $lang_admin[$adminpoint]['MODULES_MVUSERS'];
            } elseif($module['view'] == 4) {
                $who_view = $lang_admin[$adminpoint]['MODULES_MVADMIN'];
            } elseif($module['view'] == 6) {
                $groups = explode('-', $module['groups']);
                foreach ($groups as $group) {
                    if (!empty($group)) {
                         $row = $db->sql_ufetchrow("SELECT group_name FROM ".GROUPS_TABLE.' WHERE group_id='.$group, SQL_NUM);
                         if (!empty($row['group_name'])) {
                             $who_view .= $row['group_name'].', ';
                         }
                    }
                }
                if (!empty($who_view)) {
                    $who_view = substr($who_view, 0, strlen($who_view)-2);
                }
            }
            if($module['title'] == $main_module) {
                $home = '<img src="images/home.png" alt="'.$lang_admin[$adminpoint]['MODULES_INHOME'].'" title="'.$lang_admin[$adminpoint]['MODULES_INHOME'].'" />';
                $active = '<img src="images/checked.png" alt="'.$lang_admin[$adminpoint]['MODULES_ACTIVE'].'" title="'.$lang_admin[$adminpoint]['MODULES_DEACTIVATE'].'" border="0" />';
                $title = "<strong>".$module['title']."</strong>";
                $who_view = "<strong>".$who_view."</strong>";
                $bgcolor = ' bgcolor="'.$bgcolor4.'"';
            } else {
                $home = '<a href="'.$admin_file.'.php?op=modules&amp;h='.$mid.'"><img src="images/unchecked.png" alt="'.$lang_admin[$adminpoint]['MODULES_INACTIVE'].'" title="'.$lang_admin[$adminpoint]['MODULES_ACTIVATE'].'" border="0" /></a>';
                $active = (intval($module['active'])) ? '<a href="'.$admin_file.'.php?op=modules&amp;a='.$mid.'"><img src="images/checked.png" alt="'.$lang_admin[$adminpoint]['MODULES_ACTIVE'].'" title="'.$lang_admin[$adminpoint]['MODULES_DEACTIVATE'].'" border="0" /></a>' : '<a href="'.$admin_file.'.php?op=modules&amp;a='.$mid.'"><img src="images/unchecked.png" alt="'.$lang_admin[$adminpoint]['MODULES_INACTIVE'].'" title="'.$lang_admin[$adminpoint]['MODULES_ACTIVATE'].'" border="0" /></a>';
                $title =  (!intval($module['inmenu'])) ? "[&nbsp;<big><strong>&middot;</strong></big>&nbsp;]&nbsp;".$module['title'] : $module['title'];
            }
            if(isset($module['blocks'])) {
                switch($module['blocks']) {
                    case 0:
                        $module['blocks'] = $lang_admin[$adminpoint]['MODULES_BLOCKS_NONE'];
                    break;
                    case 1:
                        $module['blocks'] = $lang_admin[$adminpoint]['MODULES_BLOCKS_LEFT'];
                    break;
                    case 2:
                        $module['blocks'] = $lang_admin[$adminpoint]['MODULES_BLOCKS_RIGHT'];
                    break;
                    case 3:
                        $module['blocks'] = $lang_admin[$adminpoint]['MODULES_BLOCKS_BOTH'];
                    break;
                    default:
                        $module['blocks'] = '';
                    break;
                }
            } else {
                $module['blocks'] = '';
            }
            echo "<tr ".$bgcolor.">\n";
            echo "<td align=\"center\">".$active."</td>\n";
            echo "<td align=\"center\">".$home."</td>\n";
            echo "<td align=\"center\"><a href=\"modules.php?name=".$module['title']."\" title=\"".$lang_admin[$adminpoint]['MODULES_SHOW']."\">".$title."</a></td>\n";
            echo "<td align=\"center\">".$module['custom_title']."</td>\n";
            echo "<td align=\"center\">".$who_view."</td>\n";
            echo "<td align=\"center\">".$module['blocks']."</td>\n";
            echo "<td align=\"center\"><a href=\"".$admin_file.".php?op=modules&amp;edit=".$mid."\">"._EDIT."</a></td>";
            echo "</tr>\n";
        }
        echo "</table>\n</form>\n";
        CloseTable();
    }

    function modadmin_edit_module ($module) {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin;

        $main_module = main_module();
        $ingroups = array();

        $o1 = $o2 = $o3 = $o4 = $o6 = '';
        switch ($module['view']) {
            case 1:
                $o1 = 'selected="selected"';
            break;
            case 2:
                $o2 = 'selected="selected"';
            break;
            case 3:
                $o3 = 'selected="selected"';
            break;
            case 4:
                $o4 = 'selected="selected"';
            break;
            case 6:
                $o6 = 'selected="selected"';
                $ingroups = explode('-', $module['groups']);
            break;
        }

        OpenTable();
        if(substr($module['title'],0,3) != '~l~') {
            $a = ($module['title'] == $main_module) ? ' - ('.$lang_admin[$adminpoint]['MODULES_INHOME'].')' : '';

            echo "<fieldset><legend>".$module['title'].$a."</legend>";
            echo "<form method=\"post\" action=\"".$admin_file.".php?op=modules\">\n";
            echo "<label for=\"custom_title\">".$lang_admin[$adminpoint]['MODULES_CUSTOMTITLE']."</label>\n";
            echo "<input type=\"text\" name=\"custom_title\" id=\"custom_title\" value=\"".$module['custom_title']."\" size=\"30\" maxlength=\"255\" />\n<br />";

            if($module['title'] == $main_module || $module['title'] == 'Your_Account' || $module['title'] == 'Profile') {
                echo "<input type=\"hidden\" name=\"view\" value=\"0\" />\n";
            } else {
                echo "<br /><strong>" . $lang_admin[$adminpoint]['MODULES_VIEWPRIV'] . "</strong>&nbsp;<select name=\"view\">"
                 ."<option value=\"1\" $o1>" . $lang_admin[$adminpoint]['MODULES_MVALL'] . "</option>"
                 ."<option value=\"2\" $o2>" . $lang_admin[$adminpoint]['MODULES_MVANON'] . "</option>"
                 ."<option value=\"3\" $o3>" . $lang_admin[$adminpoint]['MODULES_MVUSERS'] . "</option>"
                 ."<option value=\"4\" $o4>" . $lang_admin[$adminpoint]['MODULES_MVADMIN'] . "</option>"
                ."<option value=\"6\" $o6>".$lang_admin[$adminpoint]['MODULES_MVGROUPS']."</option>"
                 ."</select><br />";
                echo "<span class='tiny'>".$lang_admin[$adminpoint]['MODULES_WHATGRDESC']."</span><br /><strong>".$lang_admin[$adminpoint]['MODULES_WHATGROUPS']."</strong>&nbsp;<select name='add_groups[]' multiple='multiple' size='5'>\n";
                $groupsResult = $db->sql_query("select group_id, group_name from ".GROUPS_TABLE." where group_description <> 'Personal User'");
                while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
                    if(in_array($gid,$ingroups) AND $module['view'] == 6) { $sel = 'selected="selected"'; } else { $sel = ""; }
                    echo "<option value='$gid'$sel>$gname</option>\n";
                }
                echo "</select><br /><br />\n";
            }
            echo "<label for=\"blocks\">".$lang_admin[$adminpoint]['MODULES_BLOCKS_SHOW']."</label>&nbsp;".select_box('blocks', $module['blocks'], array("0"=>$lang_admin[$adminpoint]['MODULES_BLOCKS_NONE'], "1"=>$lang_admin[$adminpoint]['MODULES_BLOCKS_LEFT'], "2"=>$lang_admin[$adminpoint]['MODULES_BLOCKS_RIGHT'], "3"=>$lang_admin[$adminpoint]['MODULES_BLOCKS_BOTH']))."\n<br />";
            echo $lang_admin[$adminpoint]['MODULES_SHOWINMENU']."&nbsp;".yesno_option('inmenu',  $module['inmenu'])."<br />";

            echo "<input type=\"hidden\" name=\"save\" value=\"".$module['mid']."\" />\n";
            echo "<input type=\"submit\" value=\"".$lang_admin[$adminpoint]['MODULES_SAVECHANGES']."\" />\n</form>\n</fieldset>\n";
        } else {
            $title = substr($module['title'],3);
            echo "<fieldset><legend>".$title."</legend>";
            echo "<form method=\"post\" action=\"".$admin_file.".php?op=modules\">\n";
            echo $lang_admin[$adminpoint]['MODULES_CAT_LINK_TITLE'].":&nbsp;<input type=\"text\" name=\"title\" id=\"linktitle\" value=\"".$title."\" size=\"30\" maxlength=\"30\" />\n<br />";
            echo $lang_admin[$adminpoint]['MODULES_URL'].":&nbsp;<input type=\"text\" name=\"custom_title\" id=\"link\" value=\"".$module['custom_title']."\" size=\"30\" maxlength=\"100\" />\n<br />";
            echo "<br /><strong>" . $lang_admin[$adminpoint]['MODULES_VIEWPRIV'] . "</strong>&nbsp;<select name=\"view\">"
             ."<option value=\"1\" $o1>" . $lang_admin[$adminpoint]['MODULES_MVALL'] . "</option>"
             ."<option value=\"2\" $o2>" . $lang_admin[$adminpoint]['MODULES_MVANON'] . "</option>"
             ."<option value=\"3\" $o3>" . $lang_admin[$adminpoint]['MODULES_MVUSERS'] . "</option>"
             ."<option value=\"4\" $o4>" . $lang_admin[$adminpoint]['MODULES_MVADMIN'] . "</option>"
             ."<option value=\"6\" $o6>".$lang_admin[$adminpoint]['MODULES_MVGROUPS']."</option>"
             ."</select><br />";
            echo "<span class='tiny'>".$lang_admin[$adminpoint]['MODULES_WHATGRDESC']."</span><br /><strong>".$lang_admin[$adminpoint]['MODULES_WHATGROUPS']."</strong>&nbsp;<select name='add_groups[]' multiple='multiple' size='5'>\n";
            $groupsResult = $db->sql_query("select group_id, group_name from ".GROUPS_TABLE." where group_description <> 'Personal User'");
            while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
                if(in_array($gid,$ingroups) AND $module['view'] == 6) { $sel = 'selected="selected"'; } else { $sel = ""; }
                echo "<option value='$gid'$sel>$gname</option>\n";
            }
            echo "</select><br /><br />\n";
            $groupsResult = $db->sql_query("select group_id, group_name from ".GROUPS_TABLE." where group_description <> 'Personal User'");
            while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) { echo "<option value='".$gid."'>$gname</option>\n"; }
            echo "</select><br />\n";
            echo "<input type=\"hidden\" name=\"link\" value=\"1\" />\n";
            echo "<input type=\"hidden\" name=\"save\" value=\"".$module['mid']."\" />\n";
            echo "<input type=\"submit\" value=\"".$lang_admin[$adminpoint]['MODULES_SAVECHANGES']."\" />\n</form>\n</fieldset>\n";
        }

        CloseTable();
    }

    function modadmin_edit_save ($mid) {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin;
        $ingroups = '';
        if (!isset($_POST['custom_title']) || empty($_POST['custom_title'])) {
            DisplayError($lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EMPTY'] . '<br /><a href="javascript:history.back(-1);">'.$lang_admin['KERNEL']['GOBACK'].'</a>');
        }
        if($_POST['view'] == 6) {
            if (!isset($_POST['add_groups']) || empty($_POST['add_groups'])) {
                DisplayError($lang_admin[$adminpoint]['MODULES_ERROR_GROUPS'] . '<a href="javascript:history.back(-1);">'.$lang_admin['KERNEL']['GOBACK'].'</a>');
            }
            $ingroups = implode("-", $_POST['add_groups']);
        }
        $result = $db->sql_query("SELECT `custom_title` FROM `"._MODULES_TABLE."` WHERE `mid`<>$mid");
        while ($row = $db->sql_fetchrow($result)) {
            if ( Fix_Quotes($_POST['custom_title']) == $row['custom_title']) {
                DisplayError($lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EXIST']. '<a href="javascript:history.back(-1);">'.$lang_admin['KERNEL']['GOBACK'].'</a>');
            }
        }
        if(isset($_POST['link'])) {
            Validate($_POST['custom_title'], 'url', 'modules');
            $view = intval($_POST['view']);
            $title = '~l~'.Fix_Quotes($_POST['title']);
            $custom_title = Fix_Quotes($_POST['custom_title']);
            $db->sql_uquery("UPDATE `"._MODULES_TABLE."` SET `custom_title`='$custom_title', `title`='$title', `view`=$view, `groups`='$ingroups' WHERE `mid`=$mid");
        } else {
            $view = intval($_POST['view']);
            $inmenu = intval($_POST['inmenu']);
            $blocks = intval($_POST['blocks']);
            $custom_title = Fix_Quotes($_POST['custom_title']);
            $db->sql_uquery("UPDATE `"._MODULES_TABLE."` SET `custom_title`='$custom_title', `view`=$view, `inmenu`=$inmenu, `blocks`=$blocks, `groups`='$ingroups' WHERE `mid`=$mid");
        }
    }

    function modadmin_get_inactive () {
        global $db, $cache;

        if(!$result = $db->sql_query("SELECT `mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `blocks` FROM `"._MODULES_TABLE."` WHERE `cat_id`=0 AND `inmenu`<>0 ORDER BY `pos` ASC")) {
            DisplayError($lang_admin[$adminpoint]['MODULES_NF_VALUES']);
        }
        $out = $db->sql_fetchrowset($result);
        $db->sql_freeresult($result);
        return $out;
    }

    function modadmin_ajax_header () {
        global $element_ids, $modadmin_module_cats;
        foreach ($modadmin_module_cats as $cat) {
            if ($cat['cid'] == 1) {
                continue;
            }
            $element_ids[] = 'ul'.$cat['cid'];
        }
        $element_ids[] = 'left_col';
        include_once(NUKE_BASE_DIR.'header.php');
    }

    function modadmin_block () {
        global $evoconfig, $lang_evo_userblock, $admin_file, $module_name, $board_config, $userinfo, $modadmin_module_cats, $bgcolor2, $adminpoint, $lang_admin;

        $inactive = modadmin_get_inactive();

        $total = count($modadmin_module_cats);

        OpenTable();
        //Notes
        OpenTable();
        echo "<div align=\"center\">\n";
        echo "<span style=\"background-color : #ff6c6c;\">".$lang_admin[$adminpoint]['MODULES_TITLE']."</span>&nbsp;-&nbsp;".$lang_admin[$adminpoint]['MODULES_INACTIVE']."<br />\n";
        echo "<span style=\"color: blue;\">".$lang_admin[$adminpoint]['MODULES_TITLE']."</span>&nbsp;-&nbsp;".$lang_admin[$adminpoint]['MODULES_LINK']."<br />\n";
        echo "<img src=\"images/admin/modules/delete.png\" border=\"0\" alt=\"\" />&nbsp;-&nbsp;".$lang_admin[$adminpoint]['MODULES_LINK_DELETE']."<br />\n";
        echo "<img src=\"images/admin/modules/deletecat.png\" border=\"0\" alt=\"".$lang_admin[$adminpoint]['MODULES_CAT_DELETE']."\" />&nbsp;-&nbsp;".$lang_admin[$adminpoint]['MODULES_CAT_DELETE']."<br />";
        echo "<img src=\"images/admin/modules/edit.png\" border=\"0\" alt=\"\" />&nbsp;-&nbsp;".$lang_admin[$adminpoint]['MODULES_EDIT']."<br />\n";
        echo "<img src=\"images/admin/modules/up.png\" border=\"0\" alt=\"\" /><img src=\"images/admin/modules/down.png\" border=\"0\" alt=\"\" />&nbsp;-&nbsp;".$lang_admin[$adminpoint]['MODULES_CAT_ORDER']."<br /><br />\n";
        echo $lang_admin[$adminpoint]['MODULES_EXPLAIN'];
        echo "<br /><br />";
        echo "<input type=\"submit\" value=\"".$lang_admin[$adminpoint]['MODULES_REFRESH SCREEN']."\" onclick=\"window.location.reload()\" />";
        echo "<br /><br />";
        echo $lang_admin[$adminpoint]['MODULES_EXPLAIN2'];
        echo "</div>\n";
        CloseTable();
        echo "<br />";

        //Config
        OpenTable();
        echo "<div align=\"center\">\n";
        echo "<form action=\"".$admin_file.".php?op=modules&amp;area=block\" method=\"post\">\n";
        echo "<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
        echo "<tr><td align=\"right\">\n";
        echo $lang_admin[$adminpoint]['MODULES_COLLAPSE'];
        echo "</td><td align=\"left\">\n";
        echo yesno_option('collapse',$evoconfig['module_collapse']);
        echo "</td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "<br />";
        echo "<input type=\"submit\" value=\"".$lang_admin['KERNEL']['SUBMIT']."\" />";
        echo "</form>\n";
        echo "</div>\n";
        CloseTable();

        echo "<br />";
        echo "<div align=\"center\">\n";
        echo "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n";
        //Inactive
        echo "<tr><td width=\"33%\" align=\"center\" rowspan=\"1\">\n";
        echo "<div align=\"center\"><span style=\"font-weight: bold;\">N/A</span></div>";
        echo "<ul id=\"left_col\" class=\"sortable boxy\">\n";
        if(is_array($inactive)) {
            foreach ($inactive as $element) {
                $custom_title = (substr($element['title'],0,3) == '~l~') ? "<span style=\"color: blue;\">".substr($element['title'],3)."</span>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=modules&amp;delete=".$element['mid']."\"><img src=\"images/admin/modules/delete.png\" border=\"0\" alt=\"\" /></a>" : $element['custom_title'];
                $custom_title .= "&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=modules&amp;edit=".$element['mid']."\"><img src=\"images/admin/modules/edit.png\" border=\"0\" alt=\"".$lang_admin[$adminpoint]['MODULES_EDIT']."\" /></a>";

                echo "<li class=\"" . (($element['active'] == 1) ? "active" : "inactive")."\" id=\"mod".$element['mid']."\" ondblclick=\"change_status('".$element['mid']."')\">".$custom_title."</li>\n";
            }
        }
        echo "</ul>\n";
        echo "</td>\n";
        echo "<td align=\"center\">\n";
        //Active
        if(is_array($modadmin_module_cats)) {
            global $db;
            $i = 0;
            foreach ($modadmin_module_cats as $cat) {
                if ($cat['cid'] == 1) {
                    continue;
                }
                $i++;
                if($i == count($modadmin_module_cats)) {
                    $updown = "<a href=\"".$admin_file.".php?op=modules&amp;upcat=".$cat['pos']."\"><img src=\"images/admin/modules/up.png\" border=\"0\" alt=\"\" /></a>";
                } else if($i != 1) {
                    $updown = "<a href=\"".$admin_file.".php?op=modules&amp;downcat=".$cat['pos']."\"><img src=\"images/admin/modules/down.png\" border=\"0\" alt=\"\" /></a><a href=\"".$admin_file.".php?op=modules&amp;upcat=".$cat['pos']."\"><img src=\"images/admin/modules/up.png\" border=\"0\" alt=\"\" /></a>";
                } else if($i == 1) {
                    $updown = "<a href=\"".$admin_file.".php?op=modules&amp;downcat=".$cat['pos']."\"><img src=\"images/admin/modules/down.png\" border=\"0\" alt=\"\" /></a>";
                }
                echo "<span style=\"font-weight: bold; text-align: center;\">".$cat['name']."&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=modules&amp;editcat=".$cat['cid']."\"><img src=\"images/admin/modules/edit.png\" border=\"0\" alt=\"".$lang_admin[$adminpoint]['MODULES_CAT_EDIT']."\" /></a>&nbsp;<a href=\"".$admin_file.".php?op=modules&amp;deletecat=".$cat['cid']."\"><img src=\"images/admin/modules/deletecat.png\" border=\"0\" alt=\"".$lang_admin[$adminpoint]['MODULES_CAT_DELETE']."\" /></a>&nbsp;".$updown."</span>";
                echo "<ul id=\"ul".$cat['cid']."\" class=\"sortable boxy\">\n";
                $sql = 'SELECT * FROM `'._MODULES_TABLE.'` WHERE cat_id='.$cat['cid'].' AND `inmenu`<>0 ORDER BY `pos` ASC';
                $result = $db->sql_query($sql);
                while ($row = $db->sql_fetchrow($result)) {
                    $custom_title = (substr($row['title'],0,3) == '~l~') ? "<span style=\"color: blue;\">".substr($row['title'],3)."</span>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=modules&amp;delete=".$row['mid']."\"><img src=\"images/admin/modules/delete.png\" border=\"0\" alt=\"\" /></a>" : $row['custom_title'];
                    $custom_title .= "&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=modules&amp;edit=".$row['mid']."\"><img src=\"images/admin/modules/edit.png\" border=\"0\" alt=\"".$lang_admin[$adminpoint]['MODULES_EDIT']."\" /></a>";

                    echo "<li class=\"" . (($row['active'] == 1) ? "active" : "inactive") . "\" id=\"mod".$row['mid']."\" ondblclick=\"change_status('".$row['mid']."')\">".$custom_title."</li>\n";
                }
                $db->sql_freeresult($result);
                echo "</ul>\n";
            }
        }
        echo "</td></tr>\n";
        echo "<tr>\n";
        echo "<td colspan=\"3\" align=\"center\">";
        echo "<form action=\"\" method=\"post\">
                  <br />
                  <input type=\"hidden\" name=\"order\" id=\"order\" value=\"\" />
                  <input type=\"submit\" onclick=\"getSort()\" value=\"".$lang_admin['KERNEL']['SUBMIT']."\" />
              </form>";
        echo "</td></tr>\n";
        echo "</table><br /><br />\n";

        echo "<table width=\"50%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n";
        echo "<tr><td align=\"center\" bgcolor=\"".$bgcolor2."\">\n<br />";
        echo "<strong>-=".$lang_admin[$adminpoint]['MODULES_MODULEINFO']."=-</strong>&nbsp;".$lang_admin[$adminpoint]['MODULES_CAT_IMG_NOTE']."\n<br /><br />";
        echo "<form action=\"".$admin_file.".php?op=modules&amp;area=block\" method=\"post\">\n";
        echo $lang_admin[$adminpoint]['MODULES_CAT_TITLE'].":&nbsp;<input type=\"text\" name=\"cat\" id=\"cat\" value=\"\" size=\"30\" maxlength=\"30\" />\n<br />";
        echo $lang_admin[$adminpoint]['MODULES_CAT_IMG'].":&nbsp;<input type=\"text\" name=\"catimage\" id=\"catimage\" value=\"\" size=\"30\" maxlength=\"50\" />\n<br />";
        echo "<input type=\"submit\" value=\"".$lang_admin['KERNEL']['SUBMIT']."\" />";
        echo "</form>\n";
        echo "</td></tr>";

        echo "<tr><td align=\"center\" bgcolor=\"".$bgcolor2."\">\n";
        echo "<form action=\"".$admin_file.".php?op=modules&amp;area=block\" method=\"post\">\n";
        echo $lang_admin[$adminpoint]['MODULES_CAT_LINK_TITLE'].":&nbsp;<input type=\"text\" name=\"linktitle\" id=\"linktitle\" value=\"\" size=\"30\" maxlength=\"30\" />\n<br />";
        echo $lang_admin[$adminpoint]['MODULES_URL'].":&nbsp;<input type=\"text\" name=\"link\" id=\"link\" value=\"\" size=\"30\" maxlength=\"100\" />\n<br />";
        echo "<input type=\"submit\" value=\"".$lang_admin['KERNEL']['SUBMIT']."\" />";
        echo "</form>\n";
        echo "</td></tr>";
        echo "</table>\n";

        echo "</div>";
        CloseTable();
    }

    function modadmin_get_module_cats () {
        global $modadmin_module_cats, $db, $cache;
        static $cats;
        if (isset($cats) && is_array($cats)) $modadmin_module_cats = $cats;

        if((($cats = $cache->load('module_cats', 'config')) === false) || !isset($cats)) {
            if(!$result = $db->sql_query("SELECT `cid`, `name`, `image`, `pos`, `link_type`, `link` FROM `"._MODULES_CATEGORIES_TABLE."` WHERE `name`<>'Home' ORDER BY `pos` ASC")) {
                DisplayError($lang_admin[$adminpoint]['MODULES_NF_VALUES']);
            }
            if (!$cats = $db->sql_fetchrowset($result)) {
                DisplayError($lang_admin[$adminpoint]['MODULES_NF_VALUES']);
            }
            $db->sql_freeresult($result);
            $cache->save('module_cats', 'config', $cats);
        }
        $modadmin_module_cats = $cats;
    }

    function modadmin_parse_data($data) {
      $containers = explode(":", $data);

      foreach($containers AS $container)
      {
          $container = str_replace(")", "", $container);
          $i = 0;
          $lastly = explode("(", $container);
          $values = explode(",", $lastly[1]);
          foreach($values AS $value)
          {
            if($value == '')
            {
                continue;
            }
            $key = str_replace('ul', '', $lastly[0]);
            $value = str_replace('mod','',$value);
            $final[$key][] = $value;
            $i ++;
          }
      }
      return $final;
    }

    function modadmin_write_cats ($data) {
        global $db, $cache;

        if(is_array($data)) {
            foreach ($data as $key => $modules) {
                $i = 0;
                foreach ($modules as $id) {
                    $key = ($key == 'left_col') ? '0' : $key;
                    $sql = 'UPDATE `'._MODULES_TABLE.'` SET `cat_id`='.$key.', `pos`='.$i.' WHERE `mid`="'.$id.'"';
                    $db->sql_query($sql);
                    $i++;
                }
            }
        }
        $cache->delete('module_cats');
        $cache->resync();
    }

    function modadmin_new_cat ($name, $image) {
        global $db, $cache;

        $result = $db->sql_query('SELECT COUNT(*) FROM `'._MODULES_CATEGORIES_TABLE.'`');
        $num = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $name = Fix_Quotes($name);
        $image = Fix_Quotes($image);
        $sql = 'INSERT INTO `'._MODULES_CATEGORIES_TABLE.'` (`cid`, `image`,`link`,`link_type`,`name`,`pos`) VALUES ("", "'.$image.'", "", 0, "'.$name.'", '.($num[0]+1).')';
        $result = $db->sql_query($sql);
        $cache->delete('module_cats');
        $cache->resync();
    }

    function modadmin_delete_cat ($cid) {
        global $db, $cache;

        $sql = 'DELETE FROM `'._MODULES_CATEGORIES_TABLE.'` WHERE `cid`='.$cid;
        $db->sql_query($sql);
        $sql = 'UPDATE `'._MODULES_TABLE.'` SET `cat_id`=0 WHERE `cat_id`='.$cid;
        $db->sql_query($sql);
        $cache->delete('module_cats');
        $cache->resync();
    }

    function modadmin_move_cat ($pos, $up) {
        global $db, $cache;

        $where = ($up) ? ($pos - 1) : ($pos + 1);
        $sql = "UPDATE `"._MODULES_CATEGORIES_TABLE."` SET `pos`=127 WHERE `pos`=".$where;
        $db->sql_query($sql);
        $sql = "UPDATE `"._MODULES_CATEGORIES_TABLE."` SET `pos`=".$where." WHERE `pos`=".$pos;
        $db->sql_query($sql);
        $sql = "UPDATE `"._MODULES_CATEGORIES_TABLE."` SET `pos`=".$pos." WHERE `pos`=127";
        $db->sql_query($sql);
        $cache->delete('module_cats');
        $cache->resync();
    }

    function modadmin_edit_cat($cat) {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin;

        $cat = Fix_Quotes($cat);
        if(!is_numeric($cat)) {
            DisplayError($lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF']);
        }
        $result = $db->sql_query('SELECT name, image, collapse FROM `'._MODULES_CATEGORIES_TABLE.'` WHERE `cid` = '.$cat);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);

        if(!isset($row[0]) || empty($row[0])) {
            DisplayError($lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF']);
        }

        $name = $row[0];
        $image = $row[1];

        include_once(NUKE_BASE_DIR.'header.php');
        modadmin_title();
        OpenTable();
        echo "<fieldset><legend>".$lang_admin[$adminpoint]['MODULES_CAT_EDIT']."</legend>";
        echo "<form method=\"post\" action=\"".$admin_file.".php?op=modules\">\n";
        echo "<table border='0'>\n";
        echo "<tr><td style='text-align:left;'>".$lang_admin[$adminpoint]['MODULES_CAT_TITLE'].":</td><td><input type=\"text\" name=\"cattitle\" id=\"title\" value=\"".$name."\" size=\"30\" maxlength=\"30\" /></td></tr>\n<br />";
        echo "<tr><td style='text-align:left;'>".$lang_admin[$adminpoint]['MODULES_CAT_IMG'].":</td><td><input type=\"text\" name=\"catimage\" id=\"image\" value=\"".$image."\" size=\"30\" /></td></tr>\n<br />";
        echo "<tr><td style='text-align:left;'>".$lang_admin[$adminpoint]['MODULES_CAT_COLLAPSE']."</td><td>".yesno_option('catcollapse', $row['collapse'])."<br /></td></tr>\n";
        echo "<tr><td colspan='2' style='text-align:left;'><input type=\"hidden\" name=\"catsave\" value=\"".$cat."\" />\n";
        echo "<input type=\"submit\" value=\"".$lang_admin[$adminpoint]['MODULES_SAVECHANGES']."\" /></td></tr>\n";
        echo "</table></form>\n</fieldset>\n";
        CloseTable();
    }

    function modadmin_edit_cat_save($cat, $name, $image, $catcollapse) {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin;

        $name = Fix_Quotes($name);
        $image = Fix_Quotes($image);
        $cat = Fix_Quotes($cat);

        if(!is_numeric($cat)) {
            DisplayError($lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF']);
        }

        $sql = "UPDATE `"._MODULES_CATEGORIES_TABLE."` SET `name`=\"".$name."\", `image`=\"".$image."\", `collapse`=\"".$catcollapse."\" WHERE `cid`=".$cat;
        $db->sql_query($sql);
        $cache->delete('module_cats');
    }

    function modadmin_new_link ($title, $link) {
        global $db, $cache, $adminpoint, $lang_admin;

        if(empty($title) || empty($link)) DisplayError($lang_admin[$adminpoint]['MODULES_ERROR_TITLE']);

        $title = Fix_Quotes($title);
        $link = Fix_Quotes($link);
        Validate($link, 'url', 'modules');
        $sql = 'INSERT INTO `'._MODULES_TABLE.'` (`mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `pos`, `cat_id`, `blocks`, `admins`, `groups`) VALUES ("","~l~'.$title.'","'.$link.'",0,0,1,0,0,1,"","")';
        $db->sql_query($sql);
        $cache->delete('module_links');
        $cache->resync();
    }

    function modadmin_delete_link ($mid) {
        global $db, $cache;

        $sql = 'DELETE FROM `'._MODULES_TABLE.'` WHERE `mid`='.$mid.' AND `title` LIKE "~l~%"';
        $db->sql_query($sql);
        $cache->delete('module_links');
        $cache->resync();
    }

    function modadmin_add_scripts() {
        global $Sajax;
        $script = "function module_activate(mid) {
                        x_modadmin_activate(mid, confirm);
                        window.location.reload();
                    }\n";
        $script .= "function change_status(bid) {
                var elem = document.getElementById(\"mod\"+bid);
                elem.className = ((elem.className == \"active\") ? \"inactive\" : \"active\");
                x_modadmin_activate(bid, confirm);
                }\n";
        $script .= "    function onDrop() {
                    var data = DragDrop.serData('g2');
                    x_sajax_update(data, confirm);
                }\n";
        $script .= "function getSort()
                    {
                      order = document.getElementById(\"order\");
                      order.value = DragDrop.serData('g1', null);
                    }\n";
        $script .= "function showValue()
                    {
                      order = document.getElementById(\"order\");
                      alert(order.value);
                    }\n";
        $Sajax->sajax_add_script($script);
    }

    /*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

    if(isset($_GET['a'])) {
       (intval($_GET['a'])) ? modadmin_activate(intval($_GET['a'])) :  modadmin_activate_all($_GET['a']);
    }

    if(isset($_GET['h'])) {
       (intval($_GET['h'])) ? modadmin_home(intval($_GET['h'])) :  '';
    }

    if(isset($_POST['save'])) {
        modadmin_edit_save(intval($_POST['save']));
    }

    if(isset($_POST['cat'])) {
        if(!empty($_POST['cat'])) {
            modadmin_new_cat($_POST['cat'], $_POST['catimage']);
        }
    }

    if(isset($_POST['linktitle']) && isset($_POST['link'])) {
        if(!empty($_POST['linktitle']) && !empty($_POST['link'])) {
            modadmin_new_link($_POST['linktitle'], $_POST['link']);
        }
    }

    if (isset($_POST['order']))
    {
        $data = modadmin_parse_data($_POST['order']);
        modadmin_write_cats($data);
        // redirect so refresh doesnt reset order to last save
        redirect($admin_file.".php?op=modules&amp;area=block");
    }

    if(isset($_GET['delete'])) {
        modadmin_delete_link($_GET['delete']);
        redirect($admin_file.".php?op=modules&amp;area=block");
    }

    if(isset($_GET['deletecat'])) {
        modadmin_delete_cat($_GET['deletecat']);
        redirect($admin_file.".php?op=modules&amp;area=block");
    }

    if(isset($_GET['upcat']) || isset($_GET['downcat'])) {
        $up = (isset($_GET['upcat'])) ? 1 : 0;
        modadmin_move_cat((isset($_GET['upcat'])) ? $_GET['upcat'] : $_GET['downcat'], $up);
        redirect($admin_file.".php?op=modules&amp;area=block");
    }

    if(isset($_POST['collapse']) && is_int(intval($_POST['collapse']))) {
        global $db, $cache;
        $db->sql_uquery('UPDATE `'._EVOCONFIG_TABLE.'` SET `evo_value`="'.intval($_POST['collapse']).'" WHERE `evo_field`= "module_collapse"');
        $evoconfig['module_collapse'] = intval($_POST['collapse']);
        $cache->delete('evoconfig');
        $cache->resync();
    }

    if(isset($_GET['editcat'])) {
        modadmin_edit_cat($_GET['editcat']);
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }

    if(isset($_POST['catsave'])) {
        modadmin_edit_cat_save($_POST['catsave'], $_POST['cattitle'], $_POST['catimage'], $_POST['catcollapse']);
        redirect($admin_file.".php?op=modules&amp;area=block");
    }
    $area = (isset($_REQUEST['area']) ? $_REQUEST['area'] : 'default');
    switch ($area) {
        case 'block':
            define('USE_DRAG_DROP', true);
            require_once(NUKE_INCLUDE_DIR.'ajax/Sajax.php');
            global $Sajax;
            $Sajax = new Sajax();
            $Sajax->sajax_export("sajax_update", "modadmin_activate");
            $Sajax->sajax_handle_client_request();
            modadmin_add_scripts();
            global $modadmin_module_cats;
            modadmin_get_module_cats();
            modadmin_ajax_header();
            modadmin_title();
            modadmin_block();
        break;

        default:
            include_once(NUKE_BASE_DIR.'header.php');
            modadmin_title();
            $modadmin_modules = modadmin_get_modules((isset($_GET['edit']) ? intval($_GET['edit']) : 0));
            (!isset($_GET['edit'])) ? modadmin_display_modules($modadmin_modules) : modadmin_edit_module($modadmin_modules[0]);
        break;
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>