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

$module_name = basename(dirname(dirname(__FILE__)));

if(!is_mod_admin($module_name)) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
} else {

    define('IN_LINKUS_ADMIN', TRUE);

    global $db, $admin_file, $currentlang;

    getmodule_lang($module_name);
    include(NUKE_BASE_DIR.'header.php');
    include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/functions.php');


    $op                 = $_GETVAR->get('op', 'GET');
    $id                 = $_GETVAR->get('id', 'REQUEST', 'int');
    $button_standard    = $_GETVAR->get('button_standard', 'POST', 'int');
    $button_banner      = $_GETVAR->get('button_banner', 'POST', 'int');
    $button_resource    = $_GETVAR->get('button_resource', 'POST', 'int');
    $user_submit        = $_GETVAR->get('user_submit', 'POST', 'int');
    $button_method      = $_GETVAR->get('button_method', 'POST', 'int');
    $button_height      = $_GETVAR->get('button_height', 'POST', 'int');
    $button_width       = $_GETVAR->get('button_width', 'POST', 'int');
    $button_banner_height      = $_GETVAR->get('button_banner_height', 'POST', 'int');
    $button_banner_width       = $_GETVAR->get('button_banner_width', 'POST', 'int');
    $button_ressource_height   = $_GETVAR->get('button_ressource_height', 'POST', 'int');
    $button_ressource_width    = $_GETVAR->get('button_ressource_width', 'POST', 'int');
    $upload_file        = $_GETVAR->get('upload_file', 'POST');
    $my_image           = $_GETVAR->get('my_image', 'POST');
    $fade_effect        = $_GETVAR->get('fade_effect', 'POST', 'int');
    $marquee            = $_GETVAR->get('marquee', 'POST', 'int');
    $marquee_direction  = $_GETVAR->get('marquee_direction', 'POST', 'int');
    $marquee_scroll     = $_GETVAR->get('marquee_scroll', 'POST', 'int');
    $block_height       = $_GETVAR->get('block_height', 'POST', 'int');
    $show_clicks        = $_GETVAR->get('show_clicks', 'POST', 'int');
    $button_seperate    = $_GETVAR->get('button_seperate', 'POST', 'int');
    $site_name          = $_GETVAR->get('site_name', 'POST');
    $site_url           = $_GETVAR->get('site_url', 'POST');
    $img_upload         = $_GETVAR->get('img_upload', 'POST');
    $site_description   = $_GETVAR->get('site_description', 'POST');
    $date_added         = $_GETVAR->get('date_added', 'POST', 'int');
    $button_type        = $_GETVAR->get('button_type', 'POST', 'int');

    switch($op){

      case 'add_button':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/button_add.php');
      break;

      case 'insert_button':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/button_save.php');
      break;

      case 'edit_button':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/edit_button.php');
      break;

      case 'delete_button':
        $db->sql_uquery("DELETE FROM `"._LINKUS_TABLE."` WHERE `id`='$id'");
        $db->sql_uquery("OPTIMIZE TABLE `"._LINKUS_TABLE."`");
        redirect($admin_file.'.php?op=link_us');
      break;

      case 'edit_button_save':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/edit_button_save.php');
      break;

      case 'active_sites':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/active_sites.php');
      break;

      case 'inactive_sites':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/inactive_sites.php');
      break;

      case 'block_config':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/block_config.php');
      break;

      case 'update_settings':
        $db->sql_query("UPDATE `"._LINKUS_CONFIG_TABLE."` SET `my_image`='$my_image', `fade_effect`='$fade_effect', `marquee`='$marquee', `marquee_direction`='$marquee_direction', `marquee_scroll`='$marquee_scroll', `block_height`='$block_height', `show_clicks`='$show_clicks', `button_seperate`='$button_seperate'");
        redirect($admin_file.'.php?op=block_config');
      break;

      case 'module_config':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/module_config.php');
      break;

      case 'update_module_settings':
        $db->sql_uquery("UPDATE `"._LINKUS_CONFIG_TABLE."` SET `button_standard`='$button_standard', `button_banner`='$button_banner', `button_resource`='$button_resource'");
        redirect($admin_file.'.php?op=module_config');
      break;

      case 'admin_config':
        include(NUKE_MODULES_DIR.$module_name.'/admin/inc/admin_config.php');
      break;

      case 'update_main':
        $db->sql_uquery("UPDATE `"._LINKUS_CONFIG_TABLE."` SET `user_submit`='0', `button_method`='$button_method', `button_height`='$button_height', `button_width`='$button_width', `button_banner_height`='$button_banner_height', `button_banner_width`='$button_banner_width', `button_ressource_height`='$button_ressource_height', `button_ressource_width`='$button_ressource_width', `upload_file`='$upload_file'");
        redirect($admin_file.'.php?op=admin_config');
      break;

      default:
          LinkusAdminMain();
      break;

    }

    include(NUKE_BASE_DIR.'footer.php');
}

?>