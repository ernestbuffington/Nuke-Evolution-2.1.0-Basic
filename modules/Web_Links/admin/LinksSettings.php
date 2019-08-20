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

if (!defined('IN_WEBLINKS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN WEBLINKS ADMINISTRATION');
}

linksHeader();
OpenTable();
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] . "</strong></span></center><br /><br />\n";
if ($info == 'saved') {
    echo "<br /><center>".$lang_new[$module_name]['MESSAGE_ADMIN_SETTINGS_SAVED']."</center><br />";
}
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"linksettings\">";
/* General links settings */
$resultadmin = $db->sql_query("SELECT * FROM `" . _WEBLINKS_CONFIG_TABLE . "`");
while(list($config_name, $config_value) = $db->sql_fetchrow($resultadmin))
{
    $row[$config_name] = $config_value;
}
$db->sql_freeresult($resultadmin);
/* Settings from l_config.php */
echo "<fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_SETTING_GENERAL_TITLE'] . "</strong></span></legend>";
echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_LINKS_PER_PAGE'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='links_perpage' value='". $row['links_perpage'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_NEWLINKS'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='newlinks' value='". $row['newlinks'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_BESTLINKS'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='toplinks' value='". $row['toplinks'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_SEARCHLINKS'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='linksresults' value='". $row['linksresults'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWN_MODREQ'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('blockunregmodify', $row['blockunregmodify']);
echo "</td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNLINKS'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('anonaddlinklock', $row['anonaddlinklock']);
echo "</td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_USE_SECURITYCODE'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('securitycheck', $row['securitycheck']);
echo "</td></tr>";
echo "</table></fieldset><br />\n";
echo "<fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BEHAVIOR'] . "</strong></span></legend>";
echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_SHOW_FEATURE_BOX'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('show_header', $row['show_header']);
echo "</td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">".$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('show_topbox', $row['show_topbox']);
echo "</td></tr>\n";
/* How many links */
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW_LINKS'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='maxshow' value='". $row['maxshow'] ."' size='2' maxLength='2' /></td></tr>\n";
/* table colors*/
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_TOPBOX_HEIGHT'] .": </td><td width=\"10%\"></td><td></td><td><input type='text' name='topbox_height' value='". $row['topbox_height'] ."' size='3' maxlength='3' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL'] . ": </td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('topbox_scroll', $row['topbox_scroll']);
echo "</td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_AMOUNT'] .": </td><td width=\"10%\"></td><td></td><td><input type='text' name='topbox_scroll_amount' value='". $row['topbox_scroll_amount'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_DIRECTION']. ": </td><td width=\"10%\"></td><td></td><td>";
if ($row['topbox_scroll_direction'] == 1) { //0=down 1=up
        echo "<input type='radio' name='topbox_scroll_direction' value='1' checked /> ". $lang_new[$module_name]['SCROLL_UP']. " &nbsp;";
        echo "<input type='radio' name='topbox_scroll_direction' value='0' /> ". $lang_new[$module_name]['SCROLL_DOWN'] ."</td></tr>\n";
} else {
        echo "<input type='radio' name='topbox_scroll_direction' value='1' /> ". $lang_new[$module_name]['SCROLL_UP'] ." &nbsp;";
        echo "<input type='radio' name='topbox_scroll_direction' value='0' checked /> ". $lang_new[$module_name]['SCROLL_DOWN'] ."</td></tr>\n";
}
echo "<tr><td width=\"60%\" align=\"left\"></td><td width=\"10%\"></td><td></td><td></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\"><strong>". $lang_new[$module_name]['ADMIN_SETTING_TABLE_TITLE'] . "</strong></td><td width=\"10%\"></td><td></td><td></td><tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR1']. "</td><td width=\"10%\"></td><td></td><td><input type='text' name='tablecolor1' value='". $row['tablecolor1'] ."' size='20' maxLength='20' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR2']. "</td><td width=\"10%\"></td><td></td><td><input type='text' name='tablecolor2' value='". $row['tablecolor2'] ."' size='20' maxLength='20' /></td></tr>\n";
/* Description Image Size*/
echo "<tr><td width=\"60%\" align=\"left\"></td><td width=\"10%\"></td><td></td><td></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\"><strong>". $lang_new[$module_name]['ADMIN_SETTING_IMAGE_TITLE'] . "</strong></td><td width=\"10%\"></td><td></td><td></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_IMAGE_WIDTH'] . "</td><td width=\"10%\"></td><td></td><td><input type='text' name='image_width' value='". $row['image_width'] ."' size='4' maxLength='4' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_IMAGE_HEIGHT'] . "</td><td width=\"10%\"></td><td></td><td><input type='text' name='image_height' value='". $row['image_height'] ."' size='4' maxLength='4' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_USE'] . ": </td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('thumbnail_use', $row['thumbnail_use']);
echo "</td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_URL'] . "</td><td width=\"10%\"></td><td></td><td><input type='text' name='thumbnail_url' value='". $row['thumbnail_url'] ."' size='30' maxLength='100' /></td></tr>\n";
echo "</table></fieldset><br />";
/* Link block settings */
echo "<fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BLOCKS'] . "</strong></span></legend>";
echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_ROWS'] . ": </td><td width=\"10%\"></td><td></td><td><input type='text' name='block_rows' value='". $row['block_rows'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_HEIGHT'] .": </td><td width=\"10%\"></td><td></td><td><input type='text' name='block_height' value='". $row['block_height'] ."' size='3' maxlength='3' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_BREAKS_NO'] .": </td><td width=\"10%\"></td><td></td><td><input type='text' name='block_line_breaks' value='". $row['block_line_breaks'] ."' size='2' maxlength='2' /></td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_SHOW'] . ": </td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('block_image_show', $row['block_image_show']);
echo "</td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_WIDTH'] . "</td><td width=\"10%\"></td><td></td><td><input type='text' name='block_image_width' value='". $row['block_image_width'] ."' size='4' maxLength='4' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_HEIGHT'] . "</td><td width=\"10%\"></td><td></td><td><input type='text' name='block_image_height' value='". $row['block_image_height'] ."' size='4' maxLength='4' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\"></td><td width=\"10%\"></td><td></td><td></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\"><strong>". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_TITLE']. "</strong></td><td width=\"10%\"></td><td></td><td></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL'] . ": </td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('block_scroll', $row['block_scroll']);
echo "</td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_AMOUNT'] .": </td><td width=\"10%\"></td><td></td><td><input type='text' name='block_scroll_amount' value='". $row['block_scroll_amount'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_DIRECTION']. ": </td><td width=\"10%\"></td><td></td><td>";
if ($row['block_scroll_direction'] == 1) { //0=down 1=up
        echo "<input type='radio' name='block_scroll_direction' value='1' checked /> ". $lang_new[$module_name]['SCROLL_UP']. " &nbsp;";
        echo "<input type='radio' name='block_scroll_direction' value='0' /> ". $lang_new[$module_name]['SCROLL_DOWN'] ."</td></tr>\n";
} else {
        echo "<input type='radio' name='block_scroll_direction' value='1' /> ". $lang_new[$module_name]['SCROLL_UP'] ." &nbsp;";
        echo "<input type='radio' name='block_scroll_direction' value='0' checked /> ". $lang_new[$module_name]['SCROLL_DOWN'] ."</td></tr>\n";
}
echo "</table></fieldset><br />\n";
echo "<fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_SETTING_FIELDSET_VOTING'] . "</strong></span></legend>";
echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNVOTING'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('allow_guest_vote', $row['allow_guest_vote']);
echo "</td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNKNOWN'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='anonwaitdays' value='". ($row['anonwaitdays'] / 86400) ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNREGS'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='outsidewaitdays' value='". ($row['outsidewaitdays'] / 86400) ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_ADMINLINKS'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('useoutsidevoting', $row['useoutsidevoting']);
echo "</td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_UNREG_TO_REGISTERED'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='outsideweight' value='". $row['outsideweight'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_GUEST_TO_REGISTERED'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='anonweight' value='". $row['anonweight'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_DETAIL'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='detailvotedecimal' value='". $row['detailvotedecimal'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_MAIN'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='mainvotedecimal' value='". $row['mainvotedecimal'] ."' size='2' maxlength='2' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_PERCENT'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('toplinkspercentrigger', $row['toplinkspercentrigger']);
echo "</td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_VOTEMIN'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='linkvotemin' value='". $row['linkvotemin'] ."' size='4' maxlength='4' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_PERCENT'] ."</td><td width=\"10%\"></td><td></td><td>";
echo yesno_option('mostpoplinkspercentrigger', $row['mostpoplinkspercentrigger']);
echo "</td></tr>";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_VOTEMIN'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='mostpoplinks' value='". $row['mostpoplinks'] ."' size='4' maxlength='4' /></td></tr>\n";
echo "<tr><td width=\"60%\" align=\"left\">". $lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_POPULAR'] ."</td><td width=\"10%\"></td><td></td><td><input type='text' name='popular' value='". $row['popular'] ."' size='4' maxlength='4' /></td></tr>\n";
echo "</table></fieldset><br />\n";
echo "<input type='hidden' name='op' value='LinksSaveSettings' />\n";
echo "<center><input type='submit' name=\"submit\" value=\"".$lang_new[$module_name]['SUBMIT_SAVE']."\" /></center>";
echo "</form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>