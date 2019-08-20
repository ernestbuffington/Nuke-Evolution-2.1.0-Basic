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

if (!defined('MODULE_FILE') || !defined('WEBLINK_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

$lid = intval($lid);
$editorialresult = $db->sql_query("SELECT `adminid`, `editorialtimestamp`, `editorialtext`, `editorialtitle` FROM `"._WEBLINKS_EDITORIALS_TABLE."` WHERE `linkid` = '".$lid."'");
$totaleditorialsDB = $db->sql_numrows($editorialresult);
include_once(NUKE_BASE_DIR.'header.php');
LinksHeading();
if ($totaleditorialsDB > 0 ) {
    OpenTable();
    linkshowsingle($lid);
    CloseTable();
}
OpenTable();
if (isset($ttitle) && !empty($ttitle)) {
    $ttitle = stripslashes($ttitle);
    $transfertitle = preg_replace ('#_#', ' ', $ttitle);
} else {
    $transfertitle = '';
}
$displaytitle = $transfertitle;
echo "<center><span class=\"option\"><strong>".$lang_new[$module_name]['EDITORIAL'].": ".$displaytitle."</strong></span></center>\n";
if ($totaleditorialsDB > 0 ) {
    echo linkinfomenu($lid, $ttitle);
}
if ($totaleditorialsDB > 0 ) {
    while($row = $db->sql_fetchrow($editorialresult)) {
        $adminid = UsernameColor($row['adminid']);
        $editorialtext = evo_img_tag_to_resize(set_smilies(decode_bbcode(stripslashes($row['editorialtext']), 1, true)));
        $editorialtitle = stripslashes(check_html($row['editorialtitle'], "nohtml"));
        $formatted_date = formatTimeStamp($row['editorialtimestamp']);
        echo "<br /><br />";
        OpenTable2();
        echo "<center><span class='option'><strong>'".$editorialtitle."'</strong></span></center>";
        echo "<center><span class='tiny'>".$lang_new[$module_name]['EDITORIAL_BY']."&nbsp;".$adminid."&nbsp;-&nbsp;".$formatted_date."</span></center><br /><br />";
        echo $editorialtext;
        CloseTable2();
    }
    $db->sql_freeresult($editorialresult);
} else {
    echo "<br /><br /><center><span class='option'><strong>".$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND']."</strong></span><br /><br />"._GOBACK."</center><br />\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>