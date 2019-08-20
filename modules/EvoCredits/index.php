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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

define('EVO_CREDITS', true);

global $db, $currentlang, $textcolor1, $bgcolor3;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = $lang_new[$module_name]['CREDITS'];
require_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

include(NUKE_BASE_DIR.'header.php');
title($lang_new[$module_name]['CREDITS'], $module_name, 'credits-logo.png');
OpenTable();
$ary_credits = array();
$result_credits = $db->sql_query( "SELECT id, credit_name FROM "._CREDITS_TABLE);
$i=0;
while ( list($id, $credit_name) = $db->sql_fetchrow($result_credits) ) {
    if ($lang_new[$module_name]['CREDITS_'.strtoupper($credit_name)] != '') {
        $ary_credits[$i]['id'] = $id;
        $ary_credits[$i]['div_name'] = 'faq_div'.$id;
        $ary_credits[$i]['name'] = $credit_name;
        $i++;
    }
}
$db->sql_freeresult($result_credits);
$no_credits = $i;
echo "<table width=\"100%\" cellpadding=\"2\" cellspacing=\"1\" class=\"forumline\" align=\"center\">"
    ."<tr><th colspan=\"".$no_credits."\" align=\"center\"><span id=\"top\" class=\"content\"><font color=\"$textcolor1\">".$lang_new[$module_name]['CREDITS']."</font></span></th></tr>"
    ."<tr>";
for ($j=0; $j < $no_credits; $j++) {
    echo "<td class=\"row1\" width=\"17%\" align=\"center\"><span class=\"content\"><a onclick=\"expandcontent(this, '".$ary_credits[$j]['div_name']."')\" href=\"#".$ary_credits[$j]['name']."\">".$lang_new[$module_name]['CREDITS_'.strtoupper($ary_credits[$j]['name'])]."</a></span></td>";
}
echo "</tr>"
    ."<tr bgcolor=\"$bgcolor3\">"
    ."<td colspan=\"".$no_credits."\" width=\"80%\" align=\"left\"><span class=\"content\">".$lang_new[$module_name]['CREDITS_INFO']." <a href=\"http://www.evo-german.com\" target=\"_blank\">Nuke-Evolution German</a></span></td>"
    ."</tr>"
    ."</table>";

CloseTable();

echo "<br />";

OpenTable();
for ($j=0; $j < $no_credits; $j++) {
    credits_get_content($ary_credits[$j]);
}
CloseTable();
include(NUKE_BASE_DIR.'footer.php');

?>