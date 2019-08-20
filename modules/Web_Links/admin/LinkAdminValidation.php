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
$result = $db->sql_query("SELECT `lid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `name`, `email`, `submitter`, `date` FROM `"._WEBLINKS_NEWLINK_TABLE."` WHERE `lid`= $lid");
$numrows = $db->sql_numrows($result);
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_LINK_VALIDATE'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"linkadminvalidation\">";
echo "<table width=\"100%\" border=\"0\">\n";
if ($numrows>0) {
    while($row = $db->sql_fetchrow($result)) {
        $lid = intval($row['lid']);
        $cid = intval($row['cid']);
        $sid = intval($row['sid']);
        $title = stripslashes($row['title']);
        $image = $row['image'];
        $url = $row['url'];
        $description = evo_img_tag_to_resize(stripslashes($row['description']));
        $name = $row['name'];
        $email = $row['email'];
        $submitter = $row['submitter'];
        $date = intval($row['date']);
        if (empty($submitter)) {
            $submitter = $lang_new[$module_name]['NONE'];
        }
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['LINK_ID'] . ": </td><td>$lid</td></tr>\n";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['LINK_SUBMITTER'] . ": </td><td>$submitter</td></tr>\n";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['LINK_PAGETITLE'] . ": </td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['LINK_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"image\" size=\"75\" maxlength=\"100\" value=\"$image\" /></td></tr>\n";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['LINK_URL'] . ": </td><td><input type=\"text\" name=\"url\" value=\"$url\" size=\"75\" maxlength=\"100\" />&nbsp;[ <a href=\"index.php?url=$url\" target=\"_blank\">" . $lang_new[$module_name]['VISIT'] . "</a> ]</td></tr>\n";
        if ($image !='http://' && !empty($image) ) {
        echo "<tr><td align=\"left\">".$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW']."</td><td align=\"center\">";
            echo "<img src=\"$image\" align=\"left\" /></td></tr>\n";
        }
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
        echo Make_TextArea('description',$description, 'linkadminvalidation');
        echo "</td></tr>\n";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"username\" size=\"75\" maxlength=\"100\" value=\"$name\" /></td></tr>\n";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['EMAIL'] . ": </td><td><input type=\"text\" name=\"email\" size=\"75\" maxlength=\"100\" value=\"$email\" /></td></tr>\n";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['LINK_SUBMIT_DATE'] . ": </td><td>". (($date > 0) ? formatTimestamp($date) : 0)."</td></tr>\n";
        echo "<input type=\"hidden\" name=\"new\" value=\"1\" />";
        echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\" />";
        echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\" />";
        echo "<input type=\"hidden\" name=\"date\" value=\"$date\" />";
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
        echo "<select name=\"cat\">";
        $result5 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` ORDER BY `title`");
        while ($row5 = $db->sql_fetchrow($result5)) {
            $cid2 = intval($row5['cid']);
            $ctitle2 = stripslashes($row5['title']);
            $parentid2 = intval($row5['parentid']);
            if ($cid2==$cid) {
                $sel = "selected";
            } else {
                $sel = "";
            }
            if ($parentid2!=0) {
                $ctitle2=linksgetparent($parentid2,$ctitle2);
            }
            echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
        }
        $db->sql_freeresult($result5);
        echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\" />";
        echo "</select></td></tr>\n";
    }
    $db->sql_freeresult($result);
    echo "</table><br />\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"LinksAddLink\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center><br />";
    echo "<center>[ <a href=\"".$admin_file.".php?op=LinksDelNew&amp;lid=$lid\">" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</center>";
    echo "</form>";
} else {
    echo "</table>\n";
    echo "</form>";
    echo "<center>". $lang_new[$module_name]['WARN_LINK_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>