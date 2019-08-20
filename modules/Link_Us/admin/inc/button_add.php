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

LinkusAdminMain();

$config = $db->sql_ufetchrow("SELECT * FROM "._LINKUS_CONFIG_TABLE." LIMIT 0,1");

OpenTable();

echo "<form action='".$admin_file.".php?op=insert_button' method='post' name='button_add' enctype='multipart/form-data'>";
echo "<table width='80%' border='1' align='center'><tr><th scope='col'>".$lang_new[$module_name]['ADD_SITE_LINK']."</th></tr></table>";
echo "<table width='80%' border='1' align='center' cellspacing='3' cellpadding='3'>";
echo " <tr>";
echo "  <td width='40%'><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td>";
echo "  <td width='40%'><input type='text' name='site_name' size='50' /></td>";
echo " </tr>";
echo " <tr>";
echo "  <td width='40%'><strong>".$lang_new[$module_name]['SITE_URL'].":</strong></td>";
echo "  <td width='40%'><input type='text' name='site_url' size='50' /></td>";
echo " </tr>";
echo " <tr>";
echo "  <td width='40%'><strong>".$lang_new[$module_name]['SITE_IMAGE'].":</strong>";
if($config['button_method'] == 1) {
    $type = "type='input'";
} else {
    $type = "type='file'";
    $maxsize = @ini_get('upload_max_filesize');
    if (!is_numeric($maxsize)) {
        if (strpos($maxsize, 'M') !== false)
            $maxsize = intval($maxsize)*1024*1024;
        elseif (strpos($maxsize, 'K') !== false)
            $maxsize = intval($maxsize)*1024;
        elseif (strpos($maxsize, 'G') !== false)
            $maxsize = intval($maxsize)*1024*1024*1024;
    }
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"".$maxsize."\" />";
}
echo "      </td>";
echo "      <td width='40%'><input name='site_image' ".$type." size='50' /><br />( ".$lang_new[$module_name]['IMAGE_TYPES'].": JPEG, PJPEG, JPG, GIF & PNG )</td>";
echo " </tr>";
echo " <tr><td colspan='2'>";
echo "  <strong>".$lang_new[$module_name]['SITE_DESCRIPTION'].":</strong><br /><br />";
echo Make_TextArea('site_description','','button_add');
echo "  </td>";
echo " </tr>";
echo " <tr>";
echo "     <td width='40%'><strong>".$lang_new[$module_name]['BUTTON_TYPE'].":</strong></td>";
echo "     <td width='40%'>
       <input name='button_type' type='radio' value='1' checked='checked' /> ".$lang_new[$module_name]['STANDARD_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_width'] ."px x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_height']."px )<br />
       <input name='button_type' type='radio' value='2' /> ".$lang_new[$module_name]['BANNER_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_banner_width'] ."px x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_banner_height']."px )<br />
       <input name='button_type' type='radio' value='3' /> ".$lang_new[$module_name]['RESOURCE_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_ressource_width'] ."px x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_ressource_height']."px )</td>";
echo "   </tr>";
echo "</table>";
echo "<table width='80%' border='1' align='center' cellspacing='3' cellpadding='3'>";
echo " <tr>";
echo "  <td width='80%' align='center'><strong>".$lang_new[$module_name]['ADD_BUTTON'].":</strong>&nbsp;<input name='another_button' type='radio' value='1' /></td>";
echo " </tr>";
echo "</table>";
echo "<br />";
echo "<input name='site_hits' type='hidden' value='0' />";
echo "<input name='site_status' type='hidden' value='1' />";
echo "<input name='date_added' type='hidden' value='".time()."' />";
echo "<input name='op' type='hidden' value='insert_button' />";
echo "<center><input name='submit' type='submit' value='".$lang_new[$module_name]['ADD_LINK_BUTTON']."' /></center>";
echo "</form>";
CloseTable();

?>