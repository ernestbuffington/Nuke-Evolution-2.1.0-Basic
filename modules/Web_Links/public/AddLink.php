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

include_once(NUKE_BASE_DIR.'header.php');
LinksHeading();
LinksLegend();

global $userinfo, $module_name, $lang_new, $weblinksconfig;

OpenTable();
$numrows = $db->sql_unumrows("SELECT `cid`, `title` FROM `"._WEBLINKS_CATEGORIES_TABLE."`");
echo "<center><span class='option'><strong>" . $lang_new[$module_name]['ADD_LINK'] . "</strong></span></center><br /><br />\n";
if ( $numrows>0 && (($weblinksconfig['anonaddlinklock'] == 1) || is_user()) ) {
    echo "<form method='post' action='modules.php?name=".$module_name."&amp;op=AddLinkSave' name='addnewlink'>";
    OpenTable2();
    echo "<table width='100%' border='0'>\n";
    echo "<tr><td><center><strong>".$lang_new[$module_name]['INSTRUCTIONS'].":</strong></center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['INFO_ONLYONCE']."</center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['INFO_PENDING']."</center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['WARN_RECORDED']."</center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['PICSIZE']."  ".$lang_new[$module_name]['PICSIZE_WIDTH'].":&nbsp;".$weblinksconfig['image_width']." x ".$lang_new[$module_name]['PICSIZE_HEIGHT'].": ".$weblinksconfig['image_height']."  ".$lang_new[$module_name]['IMAGE_PIXEL']."</center></td></tr>";
    echo "</table>\n";
    CloseTable2();
    echo "<br />";
    echo "<table width='100%' border='0'>\n";
    echo "<tr><td align='left'>". $lang_new[$module_name]['LINK_PAGETITLE'] . ":&nbsp;</td><td><input type='text' name='title' size='75' maxlength='100' /></td></tr>\n";
    echo "<tr><td align='left'>". $lang_new[$module_name]['LINK_IMAGE_URL']. ":&nbsp;</td><td><input type='text' name='image' size='75' maxlength='100' value='http://' /></td></tr>\n";
    echo "<tr><td align='left'>". $lang_new[$module_name]['LINK_URL'] . ":&nbsp;</td><td><input type='text' name='url' size='75' maxlength='100' /></td></tr>\n";
    echo "<tr><td align='left'>". $lang_new[$module_name]['CATEGORY'] . ":&nbsp;</td><td>";
    echo "<select name='cat'>";
    $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` ORDER BY `title`");
    while($row = $db->sql_fetchrow($result1)) {
         $cid2      = intval($row['cid']);
         $ctitle2   = stripslashes($row['title']);
         $parentid2 = intval($row['parentid']);
         if ($parentid2!=0) {
            $ctitle2=linksgetparent($parentid2,$ctitle2);
         }
         echo "<option value='$cid2'>$ctitle2</option>";
    }
    $db->sql_freeresult($result1);
    echo "</select></td></tr>\n";
    echo "<tr><td align='left'>". $lang_new[$module_name]['DESCRIPTION'] . "</td><td>";
    echo Make_TextArea('description','','addnewlink');
    echo "</td></tr>\n";
    if ( is_user() ) {
        echo "<tr><td align='left'>". $lang_new[$module_name]['NAME'] .":&nbsp;</td><td>".$userinfo['username']."</td></tr>\n";
        echo "<tr><td align='left'>". $lang_new[$module_name]['EMAIL'] .":&nbsp;</td><td>".$userinfo['user_email'];
        echo "<input type='hidden' name='email' value='".$userinfo['user_email']."' />";
        echo "<input type='hidden' name='username' value='".$userinfo['username']."' /></td></tr>\n";
    } else {
        echo "<tr><td align='left'>". $lang_new[$module_name]['USER'] .":&nbsp;</td><td><input type='text' name='username' size='60' maxlength='60' /></td></tr>\n";
        echo "<tr><td align='left'>". $lang_new[$module_name]['EMAIL'] .":&nbsp;</td><td><input type='text' name='email' size='60' maxlength='60' /></td></tr>\n";
    }
    if ($weblinksconfig['securitycheck'] == 1) {
        echo "<tr><td align='left'></td><td>".security_code(1,'small', 1)."</td></tr>\n";
    }
    echo "</table><br />";
    echo "<input type='hidden' name='new' value='0' />";
    echo "<input type='hidden' name='did' value='0' />";
    echo "<input type='hidden' name='submitter' value='".$userinfo['username']."' />";
    echo "<center><input type='submit' value='" . $lang_new[$module_name]['SUBMIT_ADD'] . "' /></center>\n";
    echo "</form>";
} else {
    if ( !($numrows > 0) ) {
        echo "<br /><br /><center>" . $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] . "</center><br /><br />\n";
        echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
    } else {
        echo "<br /><br /><center>" . $lang_new[$module_name]['INFO_ONLYREGISTERED'] . "</center><br /><br />\n";
        echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
    }
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>