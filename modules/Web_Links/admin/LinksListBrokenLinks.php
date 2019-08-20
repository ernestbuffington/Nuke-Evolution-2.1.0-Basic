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
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_BROKEN_LINK'] . "</strong></span></center><br /><br />\n";
$result = $db->sql_query("SELECT `requestid`, `lid`, `modifysubmitter` FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `brokenlink`='1' ORDER BY `requestid`");
$totalbrokenlinks = $db->sql_numrows($result);
echo "<center>". $lang_new[$module_name]['INFO_IGNORE'] . "</center>";
echo "<center>". $lang_new[$module_name]['INFO_DELETE'] . "</center><br />";
if ($totalbrokenlinks == 0 ) {
    echo "<center>" . $lang_new[$module_name]['WARN_LINK_NOT_FOUND'] . "</center><br />";
} else {
    echo "<table width=\"100%\" border=\"0\">\n";
    $colorswitch = $bgcolor2;
    echo "<tr>";
    echo "<td width=\"10%\" align=\"center\"></td>";
    echo "<td width=\"39%\" align=\"center\"><strong>" . $lang_new[$module_name]['TITLE'] . "</strong></td>";
    echo "<td width=\"15%\" align=\"center\"><strong>" . $lang_new[$module_name]['LINK_SUBMITTER'] . "</strong></td>";
    echo "<td width=\"15%\" align=\"center\"><strong>" . $lang_new[$module_name]['LINK_OWNER'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['EDIT'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['IGNORE'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['DELETE'] . "</strong></td>";
    echo "</tr>";
    while($row = $db->sql_fetchrow($result)) {
        $lid = intval($row['lid']);
        $modifysubmitter = $row['modifysubmitter'];
        $result2 = $db->sql_query("SELECT `title`, `image`, `url`, `name` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$lid'");
        if ( !empty($modifysubmitter ) ) {
            $row3 = $db->sql_fetchrow($db->sql_query("SELECT `user_email` FROM `"._USERS_TABLE."` WHERE `username`='$modifysubmitter'"));
            $email = stripslashes($row3['user_email']);
        }
        $row2 = $db->sql_fetchrow($result2);
        $title = stripslashes($row2['title']);
        $image = $row2['image'];
        $url = $row2['url'];
        $owner = $row2['name'];
        $row4 = $db->sql_fetchrow($db->sql_query("SELECT `user_email` FROM `"._USERS_TABLE."` WHERE `username`='$owner'"));
        $owneremail = stripslashes($row4['user_email']);
        echo "<tr>";
        echo "<td bgcolor=\"$colorswitch\"><a href=\"index.php?url=$url\">";
        if (!empty($image) ){
            echo "<img src=\"$image\" /></td><td bgcolor=\"$colorswitch\">$title</a></td>";
        } else {
            echo "</td><td bgcolor=\"$colorswitch\">$title</a></td>";
        }
        if (empty($email)) {
            echo "<td bgcolor=\"$colorswitch\">$modifysubmitter</td>";
        } else {
            echo "<td bgcolor=\"$colorswitch\"><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$modifysubmitter\">".UsernameColor($modifysubmitter)."</a></td>";
        }
        if (empty($owneremail)) {
            echo "<td bgcolor=\"$colorswitch\">$owner</td>";
        } else {
            echo "<td bgcolor=\"$colorswitch\"><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$owner\">".UsernameColor($owner)."</a></td>";
        }
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=LinksEditBrokenLinks&amp;lid=$lid\">X</a></center></td>";
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=LinksIgnoreBrokenLinks&amp;lid=$lid\">X</a></center></td>";
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=LinksDelBrokenLinks&amp;lid=$lid\">X</a></center></td>";
        echo "</tr>";
        if ($colorswitch == $bgcolor2) {
            $colorswitch = $bgcolor1;
        } else {
            $colorswitch = $bgcolor2;
        }
    }
    $db->sql_freeresult($result);
    echo "</table>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>