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

global $db;
$module_name = basename(dirname(dirname(__FILE__)));
if(is_mod_admin($module_name)) {

    include_once(NUKE_MODULES_DIR.'News/includes/nsnne_func.php');
    $ne_config = ne_get_configs();

    function topicsmanager() {
        global $db, $admin_file, $tipath;
        include(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>"._CURRENTTOPICS . "</strong></span><br />"._CLICK2EDIT . "</center><br />"
            ."<table border=\"0\" width=\"100%\" align=\"center\" cellpadding=\"2\">"
            ."<tr>";
        $count = 0;
        $result = $db->sql_query("SELECT topicid, topicname, topicimage, topictext from "._TOPICS_TABLE." order by topicname");
        while ($row = $db->sql_fetchrow($result)) {
            $topicid    = intval($row['topicid']);
            $topicname  = $row['topicname'];
            $topicimage = $row['topicimage'];
            $topictext  = $row['topictext'];
            echo "<td align=\"center\" width='17%' valign='top'>"
                ."<a href=\"".$admin_file.".php?op=topicedit&amp;topicid=$topicid\"><img src=\"$topicimage\" height=\"32\" width=\"32\" border=\"0\" alt=\"\" /><br />"
                ."<span class=\"content\"><strong>$topictext</strong></span></a></td>";
            $count++;
            if ($count == 6) {
                echo "</tr><tr>";
                $count = 0;
            }
        }
        echo "</tr></table>";
        CloseTable();
        echo "<br /><a name=\"Add\" />";
        OpenTable();
        $topicid = 0;
        $topicname = $topicimage = $topictext = '';
        echo "<center><span class=\"option\"><strong>"._ADDATOPIC . "</strong></span></center><br />"
                ."<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<strong>"._TOPICNAME . ":</strong><br /><span class=\"tiny\">"._TOPICNAME1 . "<br />"
            .""._TOPICNAME2 . "</span><br />"
            ."<input type=\"text\" name=\"topicname\" size=\"20\" maxlength=\"20\" value=\"$topicname\" /><br /><br />"
            ."<strong>"._TOPICTEXT . ":</strong><br /><span class=\"tiny\">"._TOPICTEXT1 . "<br />"
            .""._TOPICTEXT2 . "</span><br />"
            ."<input type=\"text\" name=\"topictext\" size=\"40\" maxlength=\"40\" value=\"$topictext\" /><br /><br />"
            ."<strong>"._TOPICIMAGE . ":</strong><br />";
        echo select_gallery('topicimage', $tipath, TRUE);
        echo "<br /><br />"
            ."<input type=\"hidden\" name=\"op\" value=\"topicmake\" />"
            ."<input type=\"submit\" value=\""._ADDTOPIC . "\" />"
            ."</form>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }

    function topicedit() {
        global $db, $admin_file, $tipath, $_GETVAR;
        
        $topicid = $_GETVAR->get('topicid', '_REQUEST', 'int');
        include(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        $query = $db->sql_query("SELECT topicid, topicname, topicimage, topictext from "._TOPICS_TABLE." where topicid='$topicid'");
        list($topicid, $topicname, $topicimage, $topictext) = $db->sql_fetchrow($query);
        $db->sql_freeresult($query);
        $topicid = intval($topicid);
        echo "<img src=\"$topicimage\" align=\"right\" alt=\"$topictext\" />"
            ."<span class=\"option\"><strong>"._EDITTOPIC . ": $topictext</strong></span>"
            ."<br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\"><br />"
            ."<strong>"._TOPICNAME . ":</strong><br /><span class=\"tiny\">"._TOPICNAME1 . "<br />"
            .""._TOPICNAME2 . "</span><br />"
            ."<input type=\"text\" name=\"topicname\" size=\"20\" maxlength=\"20\" value=\"$topicname\" /><br /><br />"
            ."<strong>"._TOPICTEXT . ":</strong><br /><span class=\"tiny\">"._TOPICTEXT1 . "<br />"
            .""._TOPICTEXT2 . "</span><br />"
            ."<input type=\"text\" name=\"topictext\" size=\"40\" maxlength=\"40\" value=\"$topictext\" /><br /><br />"
            ."<strong>"._TOPICIMAGE . ":</strong><br />";
        echo select_gallery('topicimage', $tipath, TRUE, $topicimage);
        echo "<br /><br />"
            ."<strong>"._ADDRELATED . ":</strong><br />"
            .""._SITENAME . ": <input type=\"text\" name=\"topicsitename\" size=\"30\" maxlength=\"30\" /><br />"
            .""._TOPICSURL . ": <input type=\"text\" name=\"url\" value=\"http://\" size=\"50\" maxlength=\"200\" /><br /><br />"
            ."<strong>"._ACTIVERELATEDLINKS . ":</strong><br />"
            ."<table width=\"100%\" border=\"0\">";
        $res = $db->sql_query("SELECT rid, name, url from "._RELATED_TABLE." where tid='$topicid'");
        $num = $db->sql_numrows($res);
        if ($num == 0) {
            echo "<tr><td><span class=\"tiny\">"._NORELATED . "</span></td></tr>";
        }
        while($row2 = $db->sql_fetchrow($res)) {
            $rid = intval($row2['rid']);
            $topicsitename = $row2['name'];
            if (isset($row2['url'])) {
                $url = stripslashes($row2['url']);
                echo "<tr><td align=\"left\"><span class=\"content\"><strong><big>&middot;</big></strong>&nbsp;&nbsp;<a href=\"$url\">$topicsitename</a></td>"
                    ."<td align=\"center\"><span class=\"content\"><a href=\"$url\">$url</a></td><td align=\"right\"><span class=\"content\">[ <a href=\"".$admin_file.".php?op=relatededit&amp;tid=$topicid&amp;rid=$rid\">"._EDIT . "</a> | <a href=\"".$admin_file.".php?op=relateddelete&amp;tid=$topicid&amp;rid=$rid\">"._DELETE . "</a> ]</td></tr>";
            }
        }
        echo "</table><br /><br />"
            ."<input type=\"hidden\" name=\"topicid\" value=\"$topicid\" />"
            ."<input type=\"hidden\" name=\"op\" value=\"topicchange\" />"
            ."<input type=\"submit\" value=\""._SAVECHANGES . "\" />&nbsp;<span class=\"content\">[ <a href=\"".$admin_file.".php?op=topicdelete&amp;topicid=$topicid\">"._DELETE . "</a> ]</span>"
            ."</form>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }

    function relatededit($tid, $rid) {
        global $db, $admin_file, $_GETVAR;
        
        $tid = $_GETVAR->get('tid', '_REQUEST', 'int');
        $rid = $_GETVAR->get('rid', '_REQUEST', 'int');
        include(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
        CloseTable();
        echo "<br />";
        $row = $db->sql_fetchrow($db->sql_query("SELECT name, url from "._RELATED_TABLE." where rid='$rid'"));
            $topicsitename = $row['name'];
            $url = $row['url'];
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT topictext, topicimage from "._TOPICS_TABLE." where topicid='$tid'"));
            $topictext = $row2['topictext'];
            $topicimage = $row2['topicimage'];
        OpenTable();
        echo "<center>"
            ."<img src=\"images/topics/$topicimage\" align=\"right\" alt=\"$topictext\" />"
            ."<span class=\"option\"><strong>"._EDITRELATED . "</strong></span><br />"
            ."<strong>"._TOPIC . ":</strong> $topictext</center>"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            .""._SITENAME . ": <input type=\"text\" name=\"topicsitename\" value=\"$topicsitename\" size=\"30\" maxlength=\"30\" /><br /><br />"
            .""._TOPICSURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"60\" maxlength=\"200\" /><br /><br />"
            ."<input type=\"hidden\" name=\"op\" value=\"relatedsave\" />"
            ."<input type=\"hidden\" name=\"tid\" value=\"$tid\" />"
            ."<input type=\"hidden\" name=\"rid\" value=\"$rid\" />"
            ."<input type=\"submit\" value=\""._SAVECHANGES . "\" /> "._GOBACK . ""
            ."</form>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }

    function relatedsave() {
        global $db, $admin_file, $_GETVAR;
        
        $tid        = $_GETVAR->get('tid', '_REQUEST', 'int');
        $rid        = $_GETVAR->get('rid', '_REQUEST', 'int');
        $topicsitename   = $_GETVAR->get('topicsitename', '_REQUEST', 'string');
        $url        = $_GETVAR->get('url', '_REQUEST', 'string');
        $db->sql_uquery("UPDATE "._RELATED_TABLE." SET name='$topicsitename', url='$url' where rid='$rid'");
        redirect($admin_file.".php?op=topicedit&amp;topicid=$tid");
    }

    function relateddelete() {
        global $db, $admin_file, $_GETVAR;

        $tid        = $_GETVAR->get('tid', '_REQUEST', 'int');
        $rid        = $_GETVAR->get('rid', '_REQUEST', 'int');
        $db->sql_uquery("DELETE FROM "._RELATED_TABLE." WHERE rid='$rid'");
        redirect($admin_file.".php?op=topicedit&amp;topicid=$tid");
    }

    function topicmake() {
        global $db, $admin_file, $_GETVAR;
        
        $topicname  = $_GETVAR->get('topicname', '_REQUEST', 'string');
        $topicimage = $_GETVAR->get('topicimage', '_REQUEST', 'string');
        $topictext  = $_GETVAR->get('topictext', '_REQUEST', 'string');
        if ( empty($topicimage) || $topicimage == FALSE ) {
            $topicimage = evo_image(EMPTY_IMAGE, 'evo');
        }
        $topicname  = Fix_Quotes($topicname);
        $topicimage = Fix_Quotes($topicimage);
        $topictext  = Fix_Quotes($topictext);
        $db->sql_uquery("INSERT INTO "._TOPICS_TABLE." (`topicid`, `topicname`, `topicimage`, `topictext`, `counter`) VALUES (NULL,'$topicname','$topicimage','$topictext','0')");
        redirect($admin_file.".php?op=topicsmanager#Add");
    }

    function topicchange() {
        global $db, $admin_file, $_GETVAR;
        
        $topicid        = $_GETVAR->get('topicid', '_REQUEST', 'int');
        $topicname      = $_GETVAR->get('topicname', '_REQUEST', 'string');
        $topicimage     = $_GETVAR->get('topicimage', '_REQUEST', 'string');
        $topictext      = $_GETVAR->get('topictext', '_REQUEST', 'string');
        $topicsitename       = $_GETVAR->get('topicsitename', '_REQUEST', 'string');
        $url            = $_GETVAR->get('url', '_REQUEST', 'string');
        $topicname = Fix_Quotes($topicname);
        if ( empty($topicimage) || $topicimage == FALSE ) {
            $topicimage = evo_image(EMPTY_IMAGE, 'evo');
        }
        $topicimage = Fix_Quotes($topicimage);
        $topictext = Fix_Quotes($topictext);
        $topicsitename = Fix_Quotes($topicsitename);
        $url = Fix_Quotes($url);
        $db->sql_uquery("UPDATE "._TOPICS_TABLE." SET topicname='$topicname', topicimage='$topicimage', topictext='$topictext' where topicid='$topicid'");
        if (!empty($topicsitename) && !empty($url) ) {
            $db->sql_uquery("INSERT INTO "._RELATED_TABLE." (`rid`, `tid`, `name`, `url`) VALUES (NULL, '$topicid','$topicsitename','$url')");
        }
        redirect($admin_file.".php?op=topicsmanager");
    }

    function topicdelete() {
        global $db, $ne_config, $admin_file, $_GETVAR;
        
        $topicid = $_GETVAR->get('topicid', '_REQUEST', 'int');
        $ok      = $_GETVAR->get('ok', '_REQUEST', 'int');
        if ($ok==1) {
        $row = $db->sql_fetchrow($db->sql_query("SELECT sid from "._STORIES_TABLE." where topic='$topicid'"));
            $sid = intval($row['sid']);
            // Copyright (c) 2000-2007 by NukeScripts Network
            if($ne_config['hometopic'] == $topicid) { ne_save_config("hometopic", "0"); }
            // Copyright (c) 2000-2007 by NukeScripts Network
            $db->sql_uquery("DELETE FROM "._STORIES_TABLE." WHERE topic='$topicid'");
            $db->sql_uquery("DELETE FROM "._TOPICS_TABLE." WHERE topicid='$topicid'");
            $db->sql_uquery("DELETE FROM "._RELATED_TABLE." WHERE tid='$topicid'");
            $row2 = $db->sql_fetchrow($db->sql_query("SELECT sid FROM "._COMMENTS_TABLE." WHERE sid='$sid'"));
            $sid = intval($row2['sid']);
            $db->sql_uquery("DELETE FROM "._COMMENTS_TABLE." where sid='$sid'");
            redirect($admin_file.".php?op=topicsmanager");
        } else {
            global $topicimage;
            include(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center><span class=\"title\"><strong>" . _TOPICSMANAGER . "</strong></span></center>";
            CloseTable();
            echo "<br />";
            $row3 = $db->sql_fetchrow($db->sql_query("SELECT topicimage, topictext FROM "._TOPICS_TABLE." WHERE topicid='$topicid'"));
            $topicimage = $row3['topicimage'];
            $topictext = $row3['topictext'];
            OpenTable();
            echo "<center><img src=\"images/topics/$topicimage\" alt=\"$topictext\" /><br /><br />"
                ."<strong>" . _DELETETOPIC . " $topictext</strong><br /><br />"
                ."" . _TOPICDELSURE . " <em>$topictext</em>?<br />"
                ."" . _TOPICDELSURE1 . "<br /><br />"
                ."[ <a href=\"".$admin_file.".php?op=topicsmanager\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=topicdelete&amp;topicid=$topicid&amp;ok=1\">" . _YES . "</a> ]</center><br /><br />";
            CloseTable();
            include(NUKE_BASE_DIR.'footer.php');
        }
    }

    switch ($op) {
        case 'topicsmanager':
            topicsmanager();
            break;
        case 'topicedit':
            topicedit();
            break;
        case 'topicmake':
            topicmake();
            break;
        case 'topicdelete':
            topicdelete();
            break;
        case 'topicchange':
            topicchange();
            break;
        case 'relatedsave':
            relatedsave();
            break;
        case 'relatededit':
            relatededit();
            break;
        case 'relateddelete':
            relateddelete();
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>