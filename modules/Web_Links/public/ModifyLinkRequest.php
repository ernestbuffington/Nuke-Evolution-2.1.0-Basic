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
if(is_user()) {
    $ratinguser = $userinfo['username'];
} else {
    $ratinguser = '';
}
LinksHeading();
echo "<br />";
OpenTable();
if ( ($weblinksconfig['blockunregmodify'] == 1) && empty($ratinguser)) {
    echo "<br /><center>".$lang_new[$module_name]['INFO_ONLYREGISTERED']."<br /></center>";
} else {
    $result = $db->sql_query("SELECT `cid`, `sid`, `title`, `image`, `url`, `description` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='".$lid."'");
    echo "<center><span class='option'><strong>" . $lang_new[$module_name]['MODIFY_LINK_REQUEST'] . "</strong></span></center>\n";
    echo "<center><span class='option'><strong>" . $lang_new[$module_name]['LINK_ID'] . ":&nbsp;".$lid."</strong></span></center><br /><br />\n";
    echo "<form method='post' action='modules.php?name=".$module_name."' name='modifylinkrequest'>";
    echo "<table width='100%' border='0'>\n";
    while($row = $db->sql_fetchrow($result)) {
        $cid    = intval($row['cid']);
        $sid    = intval($row['sid']);
        $title  = stripslashes(check_html($row['title'], "nohtml"));
        $image  = $row['image'];
        $url    = stripslashes($row['url']);
        $description = evo_img_tag_to_resize(stripslashes($row['description']));
        echo "<tr><td align='left'>". $lang_new[$module_name]['LINK_PAGETITLE'] . ":&nbsp;</td><td><input type='text' name='title' value='".$title."' size='75' maxlength='100' /></td></tr>\n";
        echo "<tr><td align='left'>". $lang_new[$module_name]['CATEGORY'] . ":&nbsp;</td><td>";
        $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` ORDER BY `title`");
        echo "<select name='cat'>";
        while($row = $db->sql_fetchrow($result1)) {
            $cid2       = intval($row['cid']);
            $ctitle2    = stripslashes($row['title']);
            $parentid2  = intval($row['parentid']);
            if ($cid2 == $cid) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            if ($parentid2 != 0) {
                $ctitle2 = linksgetparent($parentid2,$ctitle2);
            }
            echo "<option value='".$cid2."' ".$sel.">".$ctitle2."</option>";
        }
        $db->sql_freeresult($result1);
        echo "</select></td></tr>\n";
        echo "<tr><td align='left'>". $lang_new[$module_name]['LINK_IMAGE_URL']. ":&nbsp;</td><td><input type='text' name='image' value='".$image."' size='75' maxlength='100' /></td></tr>\n";
        echo "<tr><td align='left'>". $lang_new[$module_name]['LINK_URL'] . ":&nbsp;</td><td><input type='text' name='url' value='".$url."' size='75' maxlength='100' /></td></tr>\n";
        echo "<tr><td align='left'>". $lang_new[$module_name]['DESCRIPTION'] . "</td><td>";
        echo Make_TextArea('description',$description,'modifylinkrequest');
        echo "</td></tr>\n";
    }
    echo "</table>";
    if ($weblinksconfig['securitycheck'] == 1) {
        echo "<center>".security_code(1,'small', 1)."</center><br />\n";
    }
    echo "<input type='hidden' name='lid' value='".$lid."' />";
    echo "<input type='hidden' name='modifysubmitter' value='".$ratinguser."' />";
    echo "<input type='hidden' name='op' value='modifylinkrequestS' />";
    echo "<center><input type='submit' value='".$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST']."' /></center></form>";
    $db->sql_freeresult($result);
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>