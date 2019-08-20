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

if (!defined('IN_LINKUS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN LINK_US ADMINISTRATION');
}

global $config, $admin_file, $directory_mode;

function check_image_type($type) {
  switch($type) {
    case 'image/jpeg':
    case 'image/pjpeg':
    case 'image/jpg':
      return '.jpg';
      break;
    case 'image/gif':
      return '.gif';
      break;
    case 'image/png':
      return '.png';
      break;
    default:
      return false;
      break;
  }
  return false;
}

$config = $db->sql_ufetchrow("SELECT * FROM "._LINKUS_CONFIG_TABLE." LIMIT 0,1");

if($config['button_method'] == 0){
    if (!file_exists($config['upload_file'])) {
      if (!@mkdir($config['upload_file'], $directory_mode)) {
          @mkdir($config['upload_file'], $directory_mode);
      }
    }

    if (check_image_type($_FILES['site_image']['type']) == false) echo $lang_new[$module_name]['ERROR'];
    if (move_uploaded_file($_FILES['site_image']['tmp_name'], $config['upload_file'] . $_FILES['site_image']['name'])) {
      $img_upload = $config['upload_file'].$_FILES['site_image']['name'];
    }
} else {
  $img_upload = $_GETVAR->get('site_image', 'POST');
}

$result = $db->sql_uquery("INSERT INTO `"._LINKUS_TABLE."` (`id`, `site_name`, `site_url`, `site_image`, `site_description`, `site_hits`, `site_status`, `date_added`, `button_type`) VALUES (NULL, '".$_GETVAR->fixQuotes($site_name)."', '".$_GETVAR->fixQuotes($site_url)."', '".$_GETVAR->fixQuotes($img_upload)."', '".$_GETVAR->fixQuotes($site_description)."', '0', '1', '".$date_added."', '".$button_type."')");

if($another_button == 1){
    redirect($admin_file.'.php?op=add_button');
}else{
    redirect($admin_file.'.php?op=link_us');
}

?>