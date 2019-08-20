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
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin, $evoconfig;

if (is_mod_admin()) {
    getmodule_lang($adminpoint);

    function cache_header($cache_cleared) {
        global $admin_file, $evoconfig, $cache, $adminpoint, $lang_admin;
        
        $enabled = ($cache->valid) ? "<font color=\"green\">" . $lang_admin[$adminpoint]['CACHE_ENABLED'] . "</font>" : "<font color=\"red\">" . $lang_admin[$adminpoint]['CACHE_DISABLED'] . "</font> (<a href=\"$admin_file.php?op=howto_enable_cache\">" . $lang_admin[$adminpoint]['CACHE_HOWTOENABLE'] . "</a>)";
        $enabled_img = ($cache->valid) ? "<img src='images/evo/ok.png' alt='' width='10' height='10' />" : "<img src='images/evo/bad.png' alt='' width='10' height='10' />";
        $cache_num_files = $cache->count_rows();
        $last_cleared_img = ((time() - $evoconfig['cache_last_cleared']) >= 604800) ? "<img src='images/evo/bad.png' alt='' width='10' height='10' />" : "<img src='images/evo/ok.png' alt='' width='10' height='10' />";
        $clear_needed = ((time() - $evoconfig['cache_last_cleared']) >= 604800) ? "(<a href=\"$admin_file.php?op=cache_clear\"><font color=\"red\">" . $lang_admin[$adminpoint]['CACHE_CLEARNOW'] . "</font></a>)" : "";
        $last_cleared = formatTimestamp($evoconfig['cache_last_cleared']);
        $user_can_clear = ($evoconfig['usrclearcache']) ? "[ <strong>" . $lang_admin[$adminpoint]['CACHE_YES'] . "</strong> | <a href=\"$admin_file.php?op=usrclearcache&amp;opt=0\">" . $lang_admin[$adminpoint]['CACHE_NO'] . "</a> ]" : "[ <a href=\"$admin_file.php?op=usrclearcache&amp;opt=1\">" . $lang_admin[$adminpoint]['CACHE_YES'] . "</a> | <strong>" . $lang_admin[$adminpoint]['CACHE_NO'] . "</strong> ]";
        $cache_good = ($cache->valid) ? "<font color=\"green\">" . $lang_admin[$adminpoint]['CACHE_GOOD'] . "</font>" : "<font color=\"red\">" . $lang_admin[$adminpoint]['CACHE_BAD'] . "</font>";
        $cache_good_img = ($cache->valid) ? "<img src='images/evo/ok.png' alt='' width='10' height='10' />" : "<img src='images/evo/bad.png' alt='' width='10' height='10' />";
        $cache_good = (ini_get('safe_mode')) ? "<font color=red>" . $lang_admin[$adminpoint]['CACHESAFEMODE'] . "</font>" : $cache_good;
        $cache_type = ($cache->type == FILE_CACHE) ? $lang_admin[$adminpoint]['CACHE_FILEMODE'] : (($cache->type == SQL_CACHE) ? $lang_admin[$adminpoint]['CACHE_SQLMODE'] : $lang_admin[$adminpoint]['CACHE_DISABLED']);
        OpenTable();
        echo "<center>"
            ."<a href=\"$admin_file.php?op=cache\">" . $lang_admin[$adminpoint]['CACHE_HEADER'] . "</a>"
            ."<br /><br />"
            ."<table border='0' width='70%'><tr><td>"
            ."$enabled_img</td><td>"
            ."<em>" . $lang_admin[$adminpoint]['CACHE_STATUS'] . "</em></td><td>" . $enabled . "</td>"
            ."</tr><tr><td>"
            ."$enabled_img</td><td>"
            ."<em>" . $lang_admin[$adminpoint]['CACHE_MODE'] . "</em></td><td>" . $cache_type . "</td>"
            ."</tr><tr><td>"
            ."$cache_good_img</td><td>"
            ."<em>" . $lang_admin[$adminpoint]['CACHE_DIR_STATUS'] . "</em></td><td>" . $cache_good . "</td>"
            ."</tr><tr><td>"
            ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
            ."<em>" . $lang_admin[$adminpoint]['CACHE_NUM_FILES'] . "</em></td><td>" . $cache_num_files . "</td>"
            ."</tr>"
            ."<tr><td>"
            ."$last_cleared_img</td><td>"
            ."<em>" . $lang_admin[$adminpoint]['CACHE_LAST_CLEARED'] . "</em></td><td>" . $last_cleared . "  $clear_needed</td>"
            ."</tr>"
            ."<tr><td>"
            ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
            ."<em>" . $lang_admin[$adminpoint]['CACHE_USER_CAN_CLEAR'] . "</em></td><td>" . $user_can_clear . "</td>"
            ."</tr>"
            ."</table>"
            .'<br />'
            ."[ <a href=\"$admin_file.php?op=cache_clear\">" . $lang_admin[$adminpoint]['CACHE_CLEAR'] . "</a> | <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['CACHE_RETURN'] . "</a> ]"
            ."</center><br />";
        if($cache_cleared) {
            echo "<center>\n";
            echo "<font color=\"green\"><strong>" . $lang_admin[$adminpoint]['CACHE_CLEARED_SUCC'] . "</strong></font>\n";
            echo "</center>\n";
        }
        CloseTable();
        echo "<br />";
    }

    function display_main() {
       global $admin_file, $cache, $adminpoint, $lang_admin;

       $open = "<img src=\"images/evo/folder_open.png\" alt=\"\" border=\"0\" name=\"folder\" />";
       $closed = "<img src=\"images/evo/folder_closed.png\" alt=\"\" border=\"0\" name=\"folder\" />";
       echo "<script type=\"text/javascript\">
            <!--

            var folder_closed = new Image();
            folder_closed.src = \"images/evo/folder_closed.png\";
            var folder_open = new Image();
            folder_open.src = \"images/evo/folder_open.png\";

            function show(name, count)
            {
                i=1;
                while(i<=count){
                    if(document.getElementById(name + i).style.display == \"none\") {
                        document.getElementById(name + i).style.display = \"\";
                    } else {
                        document.getElementById(name + i).style.display = \"none\";
                    }
                i++;
                }

                var img = document['folder-' + name].src;
                if (img == folder_open.src) {
                    document['folder-' + name].src = folder_closed.src;
                } else {
                    document['folder-' + name].src = folder_open.src;
                }
            }
            -->
            </script>";

        OpenTable();
        echo  "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"1\" class=\"forumline\">\n";
        echo  "\n"
             ."<tr><th width='40%' align='center'><span class=\"content\"><strong>" . $lang_admin[$adminpoint]['CACHE_FILENAME'] . "</strong></span></th>\n"
             ."<th width='15%' align='center'><span class=\"content\"><strong>" . $lang_admin[$adminpoint]['CACHE_OPTIONS'] . "</strong></span></th></tr>\n"
             ."\n";
        $all_cache = $cache->saved;
        $total = count($all_cache);
        $cat_names = array_keys($all_cache);
        if(is_array($cat_names)) {
            foreach($cat_names as $file) {
                $img = "open";
                $num_files = $cache->count_rows($file);
                echo  "<tr valign=\"middle\">"
                ."<td width='40%' align='left' colspan=\"1\" class=\"row1\"><a id=\"$file\" href=\"javascript:show('$file', '$num_files');\">&nbsp;<img name='folder-$file' src='images/evo/folder_$img.png' alt='' border='0' /></a>&nbsp;<strong>" . $file . " ($num_files)</strong></td>\n"
                ."<td width='15%' align='center' colspan=\"1\" class=\"row1\"><strong><a href=\"$admin_file.php?op=cache_delete&amp;name=$file\">" . $lang_admin[$adminpoint]['CACHE_DELETE'] . "</a></strong></td>\n"
                ."</tr>\n";
                $subNames = array_keys($all_cache[$file]);
                $id = 1;
                foreach($subNames as $subFile) {
                    echo  "<tr valign='middle' id='$file$id'>\n"
                    ."<td class=\"row3\" width='40%' align='left' style='text-indent: 15pt;'>$subFile</td>\n"
                    ."<td class=\"row3\" width='15%' align='center'><span class=\"content\">[ <a href=\"$admin_file.php?op=cache_delete&amp;file=$subFile&amp;name=$file\">" . $lang_admin[$adminpoint]['CACHE_DELETE'] . "</a> | <a href=\"$admin_file.php?op=cache_view&amp;file=$subFile&amp;name=$file\">" . $lang_admin[$adminpoint]['CACHE_VIEW'] . "</a> ]</span></td>\n"
                    ."</tr>\n";
                    $id++;
                }
            }
        }
        echo  "</table>\n";
        CloseTable();
    }

    function delete_cache($file, $name) {
        global $admin_file, $cache, $adminpoint, $lang_admin;
        OpenTable();
        if (!empty($file) && !empty($name)) {
                if ($cache->delete($file, $name)) {
                    echo "<center>\n";
                    echo "<strong>" . $lang_admin[$adminpoint]['CACHE_FILE_DELETE_SUCC'] . "</strong><br /><br />\n";
            redirect("$admin_file.php?op=cache");
                    echo "</center>\n";
                } else {
                    echo "<center>\n";
                    echo "<strong>" . $lang_admin[$adminpoint]['CACHE_FILE_DELETE_FAIL'] . "</strong><br /><br />\n";
                    redirect("$admin_file.php?op=cache");
                    echo "</center>\n";
                }
        } elseif (empty($file) && (!empty($name))) {
                if ($cache->delete('', $name)) {
                    echo "<center>\n";
                    echo "<strong>" . $lang_admin[$adminpoint]['CACHE_CAT_DELETE_SUCC'] . "</strong><br /><br />\n";
                    redirect("$admin_file.php?op=cache");
                    echo "</center>\n";
                } else {
                    echo "<center>\n";
                    echo "<strong>" . $lang_admin[$adminpoint]['CACHE_CAT_DELETE_FAIL'] . "</strong><br /><br />\n";
                    redirect("$admin_file.php?op=cache");
                    echo "</center>\n";
                }
        } else {
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['CACHE_INVALID'] . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</center>\n";
        }
        CloseTable();
    }

    function cache_view($file, $name) {
        global $admin_file, $cache, $adminpoint, $lang_admin;
        OpenTable();
            echo  "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" class=\"forumline\">\n";
            echo  "<tr>\n"
                 ."<td class=\"row1\" width='33%' align='center'><span class=\"content\"><a href=\"$admin_file.php?op=cache_delete&amp;file=$file&amp;name=$name\">" . $lang_admin[$adminpoint]['CACHE_DELETE'] . "</a></span></td>\n"
                 ."<td class=\"row1\" width='33%' align='center'><span class=\"content\"><a href=\"$admin_file.php?op=cache\">" . $lang_admin[$adminpoint]['CACHE_RETURNCACHE'] . "</a></span></td>\n"
                 ."</tr>\n"
                 ."</table>\n";
            echo "<br />\n";
            echo  "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"1\" align=\"left\" class=\"forumline\">\n";
            echo  "<tr>\n"
                 ."<td class=\"row1\" width='100%' align='left'>\n";
            if(is_array($cache->saved[$name][$file])) {
                $file = "<?php\n\n\$$file = array(\n".$cache->array_parse($cache->saved[$name][$file]).");\n\n?>";
            } else {
                $file = "<?php\n\n\$$file = \"" . $cache->saved[$name][$file] . "\";\n\n?>";
            }
            @highlight_string($file);
            echo  "</td>\n";
            echo  "</tr>\n";
            echo "</table>\n";
        CloseTable();
    }

    function clear_cache() {
        global $admin_file, $cache, $adminpoint, $lang_admin;
            OpenTable();
                if($cache->clear()) {
                        echo "<center>\n";
                        echo "<strong>" . $lang_admin[$adminpoint]['CACHE_CLEARED_SUCC'] . "</strong><br /><br />\n";
                        redirect("$admin_file.php?op=cache&amp;cache_cleared=".TRUE);
                        echo "</center>\n";
                } else {
                        echo "<center>\n";
                        echo "<strong>" . $lang_admin[$adminpoint]['CACHE_CLEARED_FAIL'] . "</strong><br /><br />\n";
                        redirect("$admin_file.php?op=cache&amp;cache_cleared=".FALSE);
                        echo "</center>\n";
                }
            CloseTable();
    }

    function usrclearcache($opt) {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin;
        if($opt == 1 || $opt == 0) {
            $db->sql_uquery("UPDATE "._EVOCONFIG_TABLE." SET evo_value='" . $opt . "' WHERE evo_field='usrclearcache'");
            $cache->delete('evoconfig');
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['CACHE_PREF_UPDATED_SUCC'] . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</center>\n";
            CloseTable();
        } else {
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['CACHE_INVALID'] . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</center>\n";
            CloseTable();
        }
    }

    function howto_enable_cache() {
        global $admin_file, $adminpoint, $lang_admin;
        OpenTable();
            echo "<center>\n";
            echo "<strong>" . $lang_admin[$adminpoint]['CACHE_ENABLE_HOW'] . "</strong><br />";
            echo "<br />\n";
            redirect("$admin_file.php?op=cache");
            echo "</center>\n";
        CloseTable();
    }

    include_once(NUKE_BASE_DIR.'header.php');
    $op   = $_GETVAR->get('op', 'request', 'string', '');
    $file = $_GETVAR->get('file', 'get', 'string', NULL);
    $name = $_GETVAR->get('name', 'get', 'string', NULL);
    $opt  = $_GETVAR->get('opt', 'get', 'int', NULL);
    $cache_cleared  = $_GETVAR->get('cache_cleared', 'get', 'int', NULL);
    cache_header($cache_cleared);


    switch ($op) {
        case 'cache_delete':
            delete_cache($file, $name);
        break;
        case 'cache_view':
            cache_view($file, $name);
        break;
        case 'cache_clear':
            clear_cache();
        break;
        case 'usrclearcache':
            usrclearcache($opt);
        break;
        case 'howto_enable_cache':
            howto_enable_cache();
        break;
        default:
            display_main();
        break;
    }
    include_once(NUKE_BASE_DIR.'footer.php');

} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $lang_admin[$adminpoint]['CACHE_HEADER'] . '</strong>');
}

?>