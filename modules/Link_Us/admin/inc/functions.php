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

function LinkusTableOpen() {
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\"><tr><td class=\"extras\">\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" ><tr><td>\n";
}

function LinkusTableClose() {
    echo "</td></tr></table></td></tr></table>\n";
}

function LinkusAdminMain() {
    global $db, $lang_new, $module_name, $admin_file;
    $config = $db->sql_ufetchrow("SELECT * FROM `"._LINKUS_CONFIG_TABLE."` LIMIT 0,1");

    if (!empty($config) || is_array($config)) {

        $uploaddir = $config['upload_file'];

        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=link_us\">" .$lang_new[$module_name]['ADMINISTRATION']. "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_new[$module_name]['MAIN_ADMINISTRATION']. "</a> ]</div>\n";
        CloseTable();
        OpenTable();
        echo "<div align=\"center\">\n" .$lang_new[$module_name]['LINK_US']. "</div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\"><table width='60%' border='1' align='center'>
          <tr>
            <td width='30%' align='center'><a href='".$admin_file.".php?op=add_button'><img src='".evo_image('button-add.png', $module_name)."' border='0' alt='' /><br />".$lang_new[$module_name]['ADD_LINK_BUTTON']."</a></td>
          <td width='30%' align='center'><a href='".$admin_file.".php?op=block_config'><img src='".evo_image('block-config.png', $module_name)."' border='0' alt='' /><br />".$lang_new[$module_name]['BLOCK_CONFIG']."</a></td>
            <td width='30%' align='center'><a href='".$admin_file.".php?op=module_config'><img src='".evo_image('module-config.png', $module_name)."' border='0' alt='' /><br />".$lang_new[$module_name]['MODULE_CONFIG']."</a></td>
          </tr>
          <tr>
            <td width='30%' align='center'><a href='".$admin_file.".php?op=admin_config'><img src='".evo_image('admin-config.png', $module_name)."' border='0' alt='' /><br />".$lang_new[$module_name]['ADMIN_CONFIG']."</a></td>
            <td width='30%' align='center'><a href='".$admin_file.".php?op=active_sites'><img src='".evo_image('active-sites.png', $module_name)."' border='0' alt='' /><br />".$lang_new[$module_name]['VIEW_ACTIVE_SITES']."</a></td>
            <td width='30%' align='center'><a href='".$admin_file.".php?op=inactive_sites'><img src='".evo_image('inactive-sites.png', $module_name)."' border='0' alt='' /><br />".$lang_new[$module_name]['VIEW_INACTIVE_SITES']."</a></td>
          </tr>
        </table></div>";

        echo "<div align='right'><a href='http://www.darkforgegfx.com' target='_blank'>&copy; DarkForgeGFX</a></div>";
        CloseTable();
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $lang_new[$module_name]['CONFIG_ERROR'] . $module_name);
    }
}

?>