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

OpenTable();
$row = $db->sql_ufetchrow("SELECT * FROM `"._LINKUS_TABLE."` where `id`='$id' LIMIT 0,1");
$config = $db->sql_ufetchrow("SELECT * FROM "._LINKUS_CONFIG_TABLE." LIMIT 0,1");

if($row['site_status'] == 0){$inactive = "checked";}
if($row['site_status'] == 1){$active = "checked";}

echo "<br />\n";

OpenTable();
echo "<center><table border='1' width='70%' cellpadding='5' cellspacing='5'>";
echo "<form action='".$admin_file.".php?op=edit_button_save' name='edit_button' method='post' enctype='multipart/form-data'>";
echo "<tr><td><strong>".$lang_new[$module_name]['SITE_ID'].":</strong></td><td><strong>".$row['id']."</strong></td></tr>";
echo "<tr><td><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td><input type='text' name='site_name' size='60' value='".$row['site_name']."' /></td></tr>";
echo "<tr><td><strong>".$lang_new[$module_name]['SITE_URL'].":</strong></td><td><input type='text' name='site_url' size='60' value='".$row['site_url']."' /></td></tr>";
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
    echo "<input type=\"hidden\" name=\"current_image\" value=\"".$row['site_image']."\" />";
}
echo "<tr><td><strong>".$lang_new[$module_name]['SITE_IMAGE'].":</strong></td><td><input name='site_image' ".$type." size='60' value='".$row['site_image']."' /><br />( ".$lang_new[$module_name]['IMAGE_TYPES'].": JPEG, PJPEG, JPG, GIF & PNG )</td></tr>";
echo "<tr><td><strong>".$lang_new[$module_name]['DATE_ADDED'].":</strong></td><td>".formatTimestamp($row['date_added'])."</td></tr>";
echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SITE_DESCRIPTION'].":</strong></td></tr><tr><td colspan='2'>";
echo Make_TextArea('site_description', $row['site_description'],'edit_button', '100%', '300px');
echo "</tr></td>";
if($row['site_status'] == 1){
    echo "<tr><td><strong>".$lang_new[$module_name]['SITE_STATUS'].":</strong></td><td>".$lang_new[$module_name]['ACTIVE'].":<input name='site_status' type='radio' value='1' checked />&nbsp;".$lang_new[$module_name]['DEACTIVATED'].":<input name='site_status' type='radio' value='0' /></td></tr>";
}else{
    echo "<tr><td><strong>".$lang_new[$module_name]['SITE_STATUS'].":</strong></td><td>".$lang_new[$module_name]['ACTIVE'].":<input name='site_status' type='radio' value='1' />&nbsp;".$lang_new[$module_name]['DEACTIVATED'].":<input name='site_status' type='radio' value='0' checked /></td></tr>";
}

echo "</table></center>";
//echo "<input type='hidden' name='id' value='".$row['id']."' />";
echo "<center><input type='submit' value='".$lang_new[$module_name]['SAVE_EDIT_LINK_BUTTON']."' /></center>";
echo "</form>";
CloseTable();

?>