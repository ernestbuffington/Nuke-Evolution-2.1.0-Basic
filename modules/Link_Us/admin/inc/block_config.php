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

echo "<table width='90%' border='1' align='center'><tr><th scope='col'>".$lang_new[$module_name]['BLOCK_CONFIG']."</th></tr></table>";
echo "<form action='".$admin_file.".php?op=update_settings' method='post'>";
echo "<table width='90%' border='1' cellpadding='3' cellspacing='3' align='center'>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['LINK_US_IMAGE'].":</strong></td>";
echo "    <td width='50%'><input name='my_image' type='text' size='60' value='".$config['my_image']."' /><br />( ".$lang_new[$module_name]['EXAMPLE'].": http://www.mysite.com/button.gif )</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['ENABLE_FADE'].":</strong></td>";
echo "    <td width='50%'>";
echo yesno_option('fade_effect', $config['fade_effect']);
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['ENABLE_MARQUEE'].":</strong></td>";
echo "    <td width='50%'>";
echo yesno_option('marquee', $config['marquee']);
echo "    </td>";
echo "  </tr>";
$marquee_d_u = '';
$marquee_d_d = '';
$marquee_d_l = '';
$marquee_d_r = '';
switch ($config['marquee_direction']) {
    case 1: $marquee_d_u ="checked='checked'"; break;
    case 2: $marquee_d_d ="checked='checked'"; break;
    case 3: $marquee_d_l ="checked='checked'"; break;
    case 4: $marquee_d_r ="checked='checked'"; break;
}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['MARQUEE_DIRECTION'].":</strong></td>";
echo "    <td width='50%'>
  ".$lang_new[$module_name]['UP'].":<input name='marquee_direction' type='radio' value='1' ".$marquee_d_u." />&nbsp;
  ".$lang_new[$module_name]['DOWN'].":<input name='marquee_direction' type='radio' value='2' ".$marquee_d_d." />&nbsp;
  ".$lang_new[$module_name]['LEFT'].":<input name='marquee_direction' type='radio' value='3' ".$marquee_d_l." />&nbsp;
  ".$lang_new[$module_name]['RIGHT'].":<input name='marquee_direction' type='radio' value='4' ".$marquee_d_r." /></td>";
echo "  </tr>";
$marquee_s_f = '';
$marquee_s_s = '';
switch ($config['marquee_scroll']) {
    case 1: $marquee_s_f = "checked='checked'"; break;
    case 2: $marquee_s_s = "checked='checked'"; break;
}
if ($config['marquee_scroll'] == 1){$marquee_s_f ="checked='checked'";}
if ($config['marquee_scroll'] == 2){$marquee_s_s ="checked='checked'";}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['MARQUEE_SCROLL'].":</strong></td>";
echo "    <td width='50%'>".$lang_new[$module_name]['FAST'].":<input name='marquee_scroll' type='radio' value='1' ".$marquee_s_f." />&nbsp;".$lang_new[$module_name]['SLOW'].":<input name='marquee_scroll' type='radio' value='2' ".$marquee_s_s." /></td>";
echo "  </tr>";
$block_height_100 = '';
$block_height_150 = '';
$block_height_200 = '';
$block_height_250 = '';
$block_height_300 = '';
switch ($config['marquee_direction']) {
    case 1: $block_height_100 ="checked='checked'"; break;
    case 2: $block_height_150 ="checked='checked'"; break;
    case 3: $block_height_200 ="checked='checked'"; break;
    case 4: $block_height_250 ="checked='checked'"; break;
    case 5: $block_height_300 ="checked='checked'"; break;
}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['BLOCK_HEIGHT'].":</strong></td>";
echo "    <td width='50%'>
    100px:<input name='block_height' type='radio' value='1' ".$block_height_100." />&nbsp;
    150px:<input name='block_height' type='radio' value='2' ".$block_height_150." />&nbsp;
    200px:<input name='block_height' type='radio' value='3' ".$block_height_200." />&nbsp;
    250px:<input name='block_height' type='radio' value='4' ".$block_height_250." />&nbsp;
    300px:<input name='block_height' type='radio' value='5' ".$block_height_300." />&nbsp;</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['SHOW_CLICK_COUNTER'].":</strong></td>";
echo "    <td width='50%'>";
echo yesno_option('show_clicks', $config['show_clicks']);
echo "    </td>";
echo "  </tr>";
$button_seperate_hr   ='';
$button_seperate_dot  ='';
$button_seperate_none ='';
switch ($config['button_seperate']) {
    case 1: $button_seperate_hr   = "checked='checked'"; break;
    case 2: $button_seperate_dot  = "checked='checked'"; break;
    case 0: $button_seperate_none = "checked='checked'"; break;
}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['BUTTON_SEPARATION'].":</strong></td>";
echo "    <td width='50%'>
  ".$lang_new[$module_name]['HORIZONTAL'].":<input name='button_seperate' type='radio' value='1' ".$button_seperate_hr." />&nbsp;
  ".$lang_new[$module_name]['DOTTED'].":<input name='button_seperate' type='radio' value='2' ".$button_seperate_dot." />&nbsp;
  ".$lang_new[$module_name]['NO_SEPARATION'].":<input name='button_seperate' type='radio' value='0' ".$button_seperate_none." />&nbsp;</td>";
echo "  </tr>";
echo "</table>";
echo "<br /><br />";
echo "<input name='op' type='hidden' value='update_settings' />";
echo "<center><input name='submit' type='submit' value='".$lang_new[$module_name]['UPDATE_BLOCK_CONFIG']."' /></center>";
echo "</form>";

CloseTable();

?>