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

if (is_mod_admin($module_name)) {

    global $db, $admin_file, $cache, $lang_admin, $board_config, $evoconfig, $lang_evo_userblock, $_GETVAR, $Sajax, $evo_userblock_count_active, $evo_userblock_count_inactive;
    $module_name = basename(dirname(dirname(__FILE__)));
    $evouserinfo_admin = TRUE;
    $post_order             = $_GETVAR->get('order', '_POST', 'string');
    $post_evouserinfo_ec    = $_GETVAR->get('evouserinfo_ec', '_POST', 'int');
    $post_evouserinfo_ec    = (isset($post_evouserinfo_ec) ? $post_evouserinfo_ec : $evoconfig['evouserinfo_ec']);
    $file                   = $_GETVAR->get('file', '_REQUEST', 'string');

    if (!defined('NUKE_EVO_USERBLOCK')) {
        define('USE_DRAG_DROP', true);
        define('NUKE_EVO_USERBLOCK', dirname(dirname(__FILE__)) . '/');
        define('NUKE_EVO_USERBLOCK_ADDONS', NUKE_EVO_USERBLOCK . '/addons/');
        define('NUKE_EVO_USERBLOCK_ADMIN', dirname(__FILE__) . '/');
        define('NUKE_EVO_USERBLOCK_ADMIN_INCLUDES', NUKE_EVO_USERBLOCK_ADMIN . 'includes/');
        define('NUKE_EVO_USERBLOCK_ADMIN_ADDONS', NUKE_EVO_USERBLOCK_ADMIN . 'addons/');
    }

    include_once(NUKE_EVO_USERBLOCK_ADMIN_INCLUDES . 'functions.php');
    include_once(NUKE_EVO_USERBLOCK_ADDONS.'core.php');
    require_once(NUKE_INCLUDE_DIR.'ajax/Sajax.php');

    function evouserinfo_drawlists () {
        global $lang_evo_userblock, $evoconfig, $admin_file, $ThemeSel, $module_name, $board_config, $userinfo, $evo_userblock_count_active, $evo_userblock_count_inactive;

        $active = evouserinfo_getactive();
        $inactive = evouserinfo_getinactive();
        $blocks = NUKE_THEMES_DIR.$ThemeSel."/blocks.html";
        OpenTable();
        //Config
        OpenTable();
        echo "<div align=\"center\">\n";
        echo "<form action=\"".$admin_file.".php?op=evo-userinfo\" method=\"post\">\n";
        echo "<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
        echo "<tr><td align=\"right\">\n";
        echo $lang_evo_userblock['ADMIN']['COLLAPSE'];
        echo "</td><td align=\"left\">\n";
        echo yesno_option('evouserinfo_ec', $evoconfig['evouserinfo_ec']);
        echo "</td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "<br />";
        echo "<input type=\"submit\" value=\""._SUBMIT."\" />";
        echo "</form>\n";
        echo "</div>\n";
        CloseTable();
        echo "<br />";
        echo "<div align=\"center\">";
        echo "<table width=\"360\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\ align=\"center\">\n";
        //Inactive
        echo "<tr><td>\n";
        echo "<ul id=\"left_col\" class=\"sortable boxy\">\n";
        if(is_array($inactive)) {
            foreach ($inactive as $element) {
                if(!empty($element['image'])) {
                    echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><center><img src=\"images/".$element['image']."\" /></center></li>\n";
                } else {
                    $addon = evouserinfo_load_addon($element['filename']);
                    if(!empty($addon)) {
                        echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$addon."</li>\n";
                    } else {
                        echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$element['name']."</li>\n";
                    }
                }
            }
        }
        //Breaks
        $end = $evo_userblock_count_active + $evo_userblock_count_inactive;
        for ($i = 0; $i < $end; $i++) {
            echo "<li id=\"Break".$i."\"><hr /></li>\n";
        }
        echo "</ul>\n";
        echo "</td>\n";
        echo "<td>\n";
        //Active
        $title = $lang_evo_userblock['ADMIN']['OUTPUT'];
        $content = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\ align=\"center\">\n";
        $content .= "<tr><td>\n";
        $content .= "<ul id=\"center\" class=\"sortable boxy\">\n";
        if(is_array($active)) {
            foreach ($active as $element) {
                if(!empty($element['image'])) {
                    $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><center><img src=\"".$board_config['avatar_gallery_path']."/".$userinfo['user_avatar']."\" /></center></li>\n";
                } else {
                    if($element['filename'] != 'Break') {
                        $addon = evouserinfo_load_addon($element['filename']);
                        if(!empty($addon)) {
                            $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$addon."</li>\n";
                        } else {
                            $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$element['name']."</li>\n";
                        }
                    } else {
                    $content .= "<li id=\"Break".$element['name']."\" ><hr /></li>\n";
                    }
                }
            }
        }
        $content .= "</ul>\n";
        $content .= "</td></tr>\n";
        $content .= "</table>";
        if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks.html")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks.html";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockR.html")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockR.html";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockr.html")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockr.html";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockL.html")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockL.html";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockl.html")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blockl.html";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/block.html")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/block.html";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks.htm")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks.htm";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocksR.htm")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocksR.htm";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocksL.htm")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocksL.htm";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks-right.htm")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks-right.htm";
        } else if(@file_exists(NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks-left.htm")) {
            $tmpl_file = NUKE_THEMES_DIR.$evoconfig['default_Theme']."/blocks-left.htm";
        }
        if(@file_exists($tmpl_file)) {
            $thefile = implode("", file($tmpl_file));
            $thefile = addslashes($thefile);
            $thefile = "\$r_file=\"".$thefile."\";";
            $thefile = str_replace('168', '230', $thefile);
            eval($thefile);
            echo $r_file;
            } else {
                echo $content;
            }
        echo "</td></tr>";
        echo "<tr>\n";
        echo "<td colspan=\"2\" align=\"center\">";
        echo "<form action=\"\" method=\"post\">
                  <br />
                  <input type=\"hidden\" name=\"order\" id=\"order\" value=\"\" />
                  <input type=\"submit\" onclick=\"getSort()\" value=\"".$lang_evo_userblock['ADMIN']['SAVE']."\" />
              </form>";
        echo "</td></tr>\n";
        echo "</table>\n";
        echo "</div>";
        CloseTable();
    }

    function evouserinfo_write ($data){
        global $db, $cache, $lang_evo_userblock;

        //Write Data
        if(is_array($data)) {
            //Clear All Previous Breaks
        $db->sql_query('DELETE FROM `'._BLOCK_EVO_USERINFO_TABLE.'` WHERE `name`="Break"');
            foreach ($data as $type => $sub) {
                if ($type == 'left_col') {
                    $i = 1;
                    foreach ($sub as $element) {
                        if (!preg_match('#Break#si',$element)) {
                            $sql = 'UPDATE `'._BLOCK_EVO_USERINFO_TABLE.'` SET `position`='.$i.', `active`=0 WHERE `filename`="'.$element.'";';
                            $db->sql_uquery($sql);
                            $i++;
                        } else {
                            $i++;
                        }
                    }
                } else {
                    $i = 1;
                    foreach ($sub as $element) {
                        if (!preg_match('#Break#si',$element)) {
                            $sql = 'UPDATE `'._BLOCK_EVO_USERINFO_TABLE.'` SET `position`='.$i.', `active`=1 WHERE `filename`="'.$element.'"';
                            $db->sql_uquery($sql);
                            $i++;
                        } else {
                            $sql = 'INSERT INTO `'._BLOCK_EVO_USERINFO_TABLE.'` (`id`, `name`, `filename`, `active`, `position`, `image`) values ("NULL", "Break", "Break", 1, '.$i.', "")';
                            $db->sql_uquery($sql);
                            $i++;
                        }
                    }
                }
            }
            $cache->delete('', 'evouserinfo');
        }
    }

    function evouserinfo_addscripts() {
        global $Sajax;
        $script = "    function onDrop() {
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

    $Sajax = new Sajax();
    evouserinfo_addscripts();
    $Sajax->sajax_export('sajax_update');
    $Sajax->sajax_handle_client_request();

    if (!empty($file)){
        //Look for . / \ and kick it out
        if (preg_match('/[^\w_]/i',$file)) {
            DisplayError($lang_evo_userblock['ACCESS_DENIED']);
        }
    }

    if (isset($post_order))
    {
      $data = evouserinfo_parse_data($post_order);
      evouserinfo_write($data);
      // redirect so refresh doesnt reset order to last save
      redirect($admin_file.".php?op=evo-userinfo");
    }
    if ( $post_evouserinfo_ec != $evoconfig['evouserinfo_ec']) {
        $db->sql_uquery("UPDATE "._EVOCONFIG_TABLE." SET evo_value=".$post_evouserinfo_ec." WHERE evo_field='evouserinfo_ec'");
        $evoconfig['evouserinfo_ec'] = $post_evouserinfo_ec;
        $cache->delete('evoconfig', 'config');
    }

    if (!empty($file)){
        if(@file_exists(NUKE_EVO_USERBLOCK_ADMIN_ADDONS . $file . '.php')) {
            include_once(NUKE_EVO_USERBLOCK_ADMIN_ADDONS . $file . '.php');
        } else {
            redirect($admin_file.".php?op=evo-userinfo");
        }
    } else {
        global $element_ids;
        $element_ids[] = 'left_col';
        $element_ids[] = 'center';
        $element_ids[] = 'right_col';
        include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            title($lang_evo_userblock['ADMIN']['EVO_USERINFO']);
            OpenTable();
            echo "<div align=\"center\">\n";
            echo "<span style=\"font-size: large; font-weight: bold;\">".$lang_evo_userblock['ADMIN']['HELP']."</span>\n<br /><br />\n";
            echo $lang_evo_userblock['ADMIN']['ADMIN_HELP'];
            echo "</div>";
            CloseTable();
            echo "<br />\n";
            evouserinfo_drawlists();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}
else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}
?>