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

$row = $db->sql_ufetchrow("SELECT * FROM "._LINKUS_CONFIG_TABLE." LIMIT 0,1");
$button_i = '';
$button_u = '';
switch ($row['button_method']) {
    case 1: $button_i = "checked='checked'"; break;
    case 2: $button_u = "checked='checked'"; break;
}
echo "<table width='70%' border='1' align='center'><tr><th scope='col'>".$lang_new[$module_name]['LINK_US_CONFIG']."</th></tr></table>";
echo "<form action='".$admin_file.".php?op=update_main' method='post'>";
echo "<table width='70%' border='1' align='center' cellpadding='3' cellspacing='3'>";
/* Commented out because it isn't used at the moment
echo "  <tr>";
echo "     <td width='30%'>".$lang_new[$module_name]['USERS_SUBMIT_BUTTON']."</td>";
echo "     <td width='30%'>";
echo yesno_option('user_submit', $row['user_submit']);
echo "      </td>";
echo "  </tr>";
*/
echo "  <tr>";
echo "     <td width='40%'>".$lang_new[$module_name]['BUTTON_SUBMIT_METHOD']."</td>";
echo "     <td width='30%'>".$lang_new[$module_name]['LINK'].":<input name='button_method' type='radio' value='1' ".$button_i." />&nbsp;&nbsp;".$lang_new[$module_name]['UPLOAD'].":<input name='button_method' type='radio' value='0' ".$button_u." /></td>";
echo "  </tr>";
echo "  <tr>";
echo "     <td width='40%'>".$lang_new[$module_name]['BUTTON_SIZE']." (px)</td>";
echo "     <td width='30%'>".$lang_new[$module_name]['HEIGHT'].":<input name='button_height' type='text' size='10' value='".$row['button_height']."' />&nbsp;&nbsp;".$lang_new[$module_name]['WIDTH'].":<input name='button_width' type='text' size='10' value='".$row['button_width']."' /></td>";
echo "  </tr>";
echo "  <tr>";
echo "     <td width='40%'>".$lang_new[$module_name]['BUTTON_BANNER_SIZE']." (px)</td>";
echo "       <td width='30%'>".$lang_new[$module_name]['HEIGHT'].":<input name='button_banner_height' type='text' size='10' value='".$row['button_banner_height']."' />&nbsp;&nbsp;".$lang_new[$module_name]['WIDTH'].":<input name='button_banner_width' type='text' size='10' value='".$row['button_banner_width']."' /></td>";
echo "  </tr>";
echo "  <tr>";
echo "     <td width='40%'>".$lang_new[$module_name]['BUTTON_RESSOURCE_SIZE']." (px)</td>";
echo "       <td width='30%'>".$lang_new[$module_name]['HEIGHT'].":<input name='button_ressource_height' type='text' size='10' value='".$row['button_ressource_height']."' />&nbsp;&nbsp;".$lang_new[$module_name]['WIDTH'].":<input name='button_ressource_width' type='text' size='10' value='".$row['button_ressource_width']."' /></td>";
echo "  </tr>";
echo "  <tr>";
echo "     <td width='40%'>".$lang_new[$module_name]['FOLDER_UPLOAD_LOCATION']."</td>";
echo "     <td width='30%'><input name='upload_file' type='text' size='35' value='".$row['upload_file']."' /></td>";
echo "  </tr>";
echo "</table>";
echo "<input name='op' type='hidden' value='update_main' />";
echo "<center><input name='submit' type='submit' value='".$lang_new[$module_name]['UPDATE_MAIN_CONFIG']."' /></center>";
echo "</form>";
CloseTable();

?>