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

global $db, $_GETVAR;
$module_name = basename(dirname(dirname(__FILE__)));

if(is_mod_admin($module_name)) {
    getmodule_lang($module_name);

    include_once(NUKE_MODULES_DIR.$module_name.'/includes/nsnne_func.php');

    $ne_config = ne_get_configs();

    function NEAdminHeader() {
        global $admin_file;

        include(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
    }

    function NEAdminFooter() {
        include(NUKE_BASE_DIR.'footer.php');
    }

    function topicicon($topic_icon) {
        echo "<br /><strong>"._DISPLAY_T_ICON."</strong>&nbsp;&nbsp;";
        if (($topic_icon == 0) OR (empty($topic_icon))) {
            $topic_icon = 0;
            $sel1 = "checked='checked'";
            $sel2 = "";
        } else {
            $topic_icon = 1;
            $sel1 = "";
            $sel2 = "checked='checked'";
        }
        echo "<input type=\"radio\" name=\"topic_icon\" value=\"0\" $sel1 />"._YES."&nbsp;"
            ."<input type=\"radio\" name=\"topic_icon\" value=\"1\" $sel2 />"._NO;
    }

    function writes($writes) {
        echo "<br /><strong>"._DISPLAY_WRITES."</strong>&nbsp;&nbsp;";
        if (($writes == 1) ) {
            $sel1 = "";
            $sel2 = "checked='checked'";
        } else if (($writes == 0)) {
            $sel1 = "checked='checked'";
            $sel2 = "";
        }
        echo "<input type=\"radio\" name=\"writes\" value=\"0\" $sel1 />"._YES."&nbsp;"
            ."<input type=\"radio\" name=\"writes\" value=\"1\" $sel2 />"._NO;
    }

    function puthome($ihome, $acomm) {
        echo "<br /><strong>"._PUBLISHINHOME."</strong>&nbsp;&nbsp;";
        if (($ihome == 0) OR (empty($ihome))) {
            $sel1 = "checked='checked'";
            $sel2 = "";
        }
        if ($ihome == 1) {
            $sel1 = "";
            $sel2 = "checked='checked'";
        }
        echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1 />"._YES."&nbsp;"
            ."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2 />"._NO."<br />";

        echo "<br /><strong>"._ACTIVATECOMMENTS."</strong>&nbsp;&nbsp;";
        if (($acomm == 0) OR (empty($acomm))) {
            $sel1 = "checked='checked'";
            $sel2 = "";
        }
        if ($acomm == 1) {
            $sel1 = "";
            $sel2 = "checked='checked'";
        }
        echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1 />"._YES."&nbsp;"
            ."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2 />"._NO."<br /><br />";

    }

    function deleteStory() {
        global $db, $admin_file, $cache, $_GETVAR;

        $qid = $_GETVAR->get('qid', '_REQUEST', 'int');
        $result = $db->sql_query("delete FROM "._QUEUE_TABLE." WHERE qid='$qid'");
        if (!$result) {
            return;
        }
        $cache->delete('numwaits', 'submissions');
        redirect($admin_file.".php?op=submissions");
    }

    function SelectCategory($cat) {
        global $db, $admin_file;

        $selcat = $db->sql_query("SELECT catid, title FROM "._STORIES_CATEGORIES_TABLE." ORDER BY title");
        $a = 1;
        echo "<strong>"._CATEGORY."</strong> ";
        echo "<select name=\"catid\">";
        if ($cat == 0) {
            $sel = "selected='selected'";
        } else {
            $sel = "";
        }
        echo "<option value=\"0\" $sel>"._ARTICLES."</option>";
        while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
            $catid = intval($catid);
            if ($catid == $cat) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option value=\"$catid\" $sel>$title</option>";
            $a++;
        }
        $db->sql_freeresult($selcat);
        echo "</select> [ <a href=\"".$admin_file.".php?op=AddCategory\">"._ADD."</a> | <a href=\"".$admin_file.".php?op=EditCategory\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=DelCategory\">"._DELETE."</a> ]";
    }

    function putpoll($pollTitle, $optionText) {
        OpenTable();
        echo "<div align=\"center\"><span class=\"title\"><strong>"._ATTACHAPOLL."</strong></span><br />"
            ."<span class=\"tiny\">"._LEAVEBLANKTONOTATTACH."</span><br />"
            ."<br /><br />"._POLLTITLE.": <input type=\"text\" name=\"pollTitle\" size=\"50\" maxlength=\"100\" value=\"$pollTitle\" /><br /><br />"
            ."<font class=\"content\">"._POLLEACHFIELD."</font><br />"
            ."<table border=\"0\">";
        for($i = 1; $i <= 12; $i++)        {
            $optional = isset($optionText[$i]) ? $optionText[$i] : '';
            echo "<tr>"
                ."<td>"._OPTION." $i:</td><td><input type=\"text\" name=\"optionText[$i]\" size=\"50\" maxlength=\"50\" value=\"".$optional."\" /></td>"
                ."</tr>";
        }
        echo "</table></div>";
        CloseTable();
    }

    function AddCategory () {
        global $admin_file;

        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._CATEGORIESADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>"._CATEGORYADD."</strong></span><br /><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<strong>"._CATNAME.":</strong> "
            ."<input type=\"text\" name=\"title\" size=\"22\" maxlength=\"20\" /> "
            ."<input type=\"hidden\" name=\"op\" value=\"SaveCategory\" />"
            ."<input type=\"submit\" value=\""._SAVE."\" />"
            ."</form></center>";
        CloseTable();
        NEAdminFooter();
    }

    function EditCategory() {
        global $db, $admin_file, $_GETVAR;

        $catid = $_GETVAR->get('catid', '_REQUEST', 'int');
        list($title) = $db->sql_ufetchrow("SELECT title FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='$catid'");
        NEAdminHeader();
        OpenTable();
        echo "<div align=\"center\"><span class=\"option\"><strong>"._EDITCATEGORY."</strong></span><br /><br />";
        if (!$catid) {
            $selcat = $db->sql_query("SELECT catid, title FROM "._STORIES_CATEGORIES_TABLE);
            echo "<form action=\"".$admin_file.".php\" method=\"post\">";
            echo "<strong>"._ASELECTCATEGORY."</strong> ";
            echo "<select name=\"catid\">";
            while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
                $catid = intval($catid);
                echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
            }
            $db->sql_freeresult($selcat);
            echo "</select>";
            echo "<input type=\"hidden\" name=\"op\" value=\"EditCategory\" />";
            echo "<input type=\"submit\" value=\""._EDIT."\" /><br /><br />";
            echo ""._NOARTCATEDIT."";
        } else {
            echo "<form action=\"".$admin_file.".php\" method=\"post\">";
            echo "<strong>"._CATEGORYNAME.":</strong> ";
            echo "<input type=\"text\" name=\"title\" size=\"22\" maxlength=\"20\" value=\"$title\" /> ";
            echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\" />";
            echo "<input type=\"hidden\" name=\"op\" value=\"SaveEditCategory\" />";
            echo "<input type=\"submit\" value=\""._SAVECHANGES."\" /><br /><br />";
            echo "</form>";
        }
        echo "</div>";
        CloseTable();
        NEAdminFooter();
    }

    function DelCategory() {
        global $db, $admin_file, $_GETVAR;

        $cat = $_GETVAR->get('cat', '_REQUEST', 'int');
        list($title) = $db->sql_ufetchrow("SELECT title FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='".$cat."'");
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._CATEGORIESADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<div align=\"center\"><span class=\"option\"><strong>"._DELETECATEGORY."</strong></span><br /><br />";
        if (!$cat) {
            $selcat = $db->sql_query("SELECT catid, title FROM "._STORIES_CATEGORIES_TABLE);
            echo "<form action=\"".$admin_file.".php\" method=\"post\">"
                ."<strong>"._SELECTCATDEL.": </strong>"
                ."<select name=\"cat\">";
            while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
                $catid = intval($catid);
                echo "<option name=\"cat\" value=\"$catid\">$title</option>";
            }
            $db->sql_freeresult($selcat);
            echo "</select>"
                ."<input type=\"hidden\" name=\"op\" value=\"DelCategory\" />"
                ."<input type=\"submit\" value=\""._DELETE."\" />"
                ."</form>";
        } else {
            $result2 = $db->sql_query("SELECT * FROM "._STORIES_TABLE." WHERE catid='$cat'");
            $numrows = $db->sql_numrows($result2);
            if ($numrows == 0) {
                $db->sql_uquery("delete FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='".$cat."'");
                echo "<br /><br />"._CATDELETED."<br /><br />"._GOTOADMIN."";
            } else {
                echo "<br /><br /><strong>"._WARNING.":</strong> "._THECATEGORY." <strong>$title</strong> "._HAS." <strong>$numrows</strong> "._STORIESINSIDE."<br />"
                    .""._DELCATWARNING1."<br />"
                    .""._DELCATWARNING2."<br /><br />"
                    .""._DELCATWARNING3."<br /><br />"
                    ."<strong>[ <a href=\"".$admin_file.".php?op=YesDelCategory&amp;catid=$cat\">"._YESDEL."</a> | "
                    ."<a href=\"".$admin_file.".php?op=NoMoveCategory&amp;catid=$cat\">"._NOMOVE."</a> ]</strong>";
            }
            $db->sql_freeresult($result2);
        }
        echo "</div>";
        CloseTable();
        NEAdminFooter();
    }

    function YesDelCategory() {
        global $db, $admin_file, $_GETVAR;

        $catid = $_GETVAR->get('catid', '_REQUEST', 'int');
        $db->sql_uquery("delete FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='".$catid."'");
        $result = $db->sql_query("SELECT sid FROM "._STORIES_TABLE." WHERE catid='".$catid."'");
        while(list($sid) = $db->sql_fetchrow($result)) {
            $sid = intval($sid);
            $db->sql_uquery("delete FROM "._STORIES_TABLE." WHERE catid='".$catid."'");
            $db->sql_uquery("delete FROM "._COMMENTS_TABLE." WHERE sid='".$sid."'");
        }
        $db->sql_freeresult($result);
        redirect($admin_file.".php?op=adminStory");
    }

    function NoMoveCategory() {
        global $db, $admin_file, $_GETVAR;

        $catid = $_GETVAR->get('catid', '_REQUEST', 'int');
        $newcat =$_GETVAR->get('newcat', '_REQUEST', 'int');
        list($title) = $db->sql_ufetchrow("SELECT title FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='".$catid."'");
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._CATEGORIESADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<div align=\"center\"><span class=\"option\"><strong>"._MOVESTORIES."</strong></span><br /><br />";
        if (!$newcat) {
            echo ""._ALLSTORIES." <strong>$title</strong> "._WILLBEMOVED."<br /><br />";
            $selcat = $db->sql_query("SELECT catid, title FROM "._STORIES_CATEGORIES_TABLE);
            echo "<form action=\"".$admin_file.".php\" method=\"post\">";
            echo "<strong>"._SELECTNEWCAT.":</strong> ";
            echo "<select name=\"newcat\">";
            echo "<option name=\"newcat\" value=\"0\">"._ARTICLES."</option>";
            while(list($newcat, $title) = $db->sql_fetchrow($selcat)) {
                    echo "<option name=\"newcat\" value=\"$newcat\">$title</option>";
            }
            $db->sql_freeresult($selcat);
            echo "</select>";
            echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\" />";
            echo "<input type=\"hidden\" name=\"op\" value=\"NoMoveCategory\" />";
            echo "<input type=\"submit\" value=\""._OK."\" />";
            echo "</form>";
        } else {
            $resultm = $db->sql_query("SELECT sid FROM "._STORIES_TABLE." WHERE catid='".$catid."'");
            while(list($sid) = $db->sql_fetchrow($resultm)) {
            $sid = intval($sid);
                $db->sql_uquery("update "._STORIES_TABLE." set catid='$newcat' WHERE sid='$sid'");
            }
            $db->sql_freeresult($resultm);
            $db->sql_uquery("delete FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='".$catid."'");
            echo ""._MOVEDONE."";
        }
        echo "</div>";
        CloseTable();
        NEAdminFooter();
    }

    function SaveEditCategory() {
        global $db, $admin_file, $_GETVAR;

        $title = $_GETVAR->get('title', '_POST', 'string');
        $catid = $_GETVAR->get('catid', '_POST', 'int');
        $title = preg_replace("#\"#", '',$title);
        $result = $db->sql_query("SELECT catid FROM "._STORIES_CATEGORIES_TABLE." WHERE title='".$title."'");
        $catid = intval($catid);
        $check = $db->sql_numrows($result);
        if ($check) {
            $what1 = _CATEXISTS;
            $what2 = _GOBACK;
        } else {
            $what1 = _CATSAVED;
            $what2 = "[ <a href=\"".$admin_file.".php\">"._GOTOADMIN."</a> ]";
            $result = $db->sql_query("update "._STORIES_CATEGORIES_TABLE." set title='".$title."' WHERE catid='".$catid."'");
            if (!$result) {
                return;
            }
        }
        $db->sql_freeresult($result);
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._CATEGORIESADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"content\"><strong>$what1</strong></span><br /><br />";
        echo "$what2</center>";
        CloseTable();
        NEAdminFooter();
    }

    function SaveCategory() {
        global $db, $admin_file, $_GETVAR;

        $title = $_GETVAR->get('title', '_POST', 'string');
        $title = preg_replace("#\"#","",$title);
        $check = $db->sql_unumrows('SELECT `catid` FROM `'._STORIES_CATEGORIES_TABLE.'` WHERE `title`="'.$title.'"');
        if ($check > 0) {
            $what1 = _CATEXISTS;
            $what2 = _GOBACK;
        } else {
            $what1 = _CATADDED;
            $what2 = _GOTOADMIN;
            $result = $db->sql_query('INSERT INTO `'._STORIES_CATEGORIES_TABLE.'` (`catid`, `title`, `counter`) VALUES (NULL, "'.$title.'", "0")');
            if (!$result) {
                return;
            }
        }
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._CATEGORIESADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"content\"><strong>$what1</strong></span><br /><br />";
        echo "$what2</center>";
        CloseTable();
        NEAdminFooter();
    }

    function autodelete($anid) {
        global $db, $admin_file;
        $anid = intval($anid);
        $db->sql_uquery('DELETE FROM `'._AUTONEWS_TABLE.'` WHERE `anid`="'.$anid.'"');
        redirect($admin_file.".php?op=adminStory");
    }

    function autoEdit() {
        global $ThemeInfo, $db, $evoconfig, $admin_file, $module_name, $_GETVAR;

        $sid = $_GETVAR->get('anid', '_REQUEST', 'int');
        list($aaid) = $db->sql_ufetchrow("SELECT aid FROM "._STORIES_TABLE." WHERE sid='".$sid."'", SQL_NUM);
        $aaid = substr($aaid, 0,25);
        $result = $db->sql_query("SELECT catid, aid, title, time, hometext, bodytext, topic, informant, notes, ihome, alanguage, acomm, ticon, writes FROM "._AUTONEWS_TABLE." WHERE anid='$anid'");
        list($catid, $aid, $title, $time, $hometext, $bodytext, $topic, $informant, $notes, $ihome, $alanguage, $acomm, $topic_icon, $writes) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $catid = intval($catid);
        $aid = substr($aid, 0,25);
        $informant = substr($informant, 0,25);
        $ihome = intval($ihome);
        $acomm = intval($acomm);
        $topic_icon = intval($topic_icon);
        $writes = intval($writes);
        preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $time, $datetime);
        NEAdminHeader();
        OpenTable();
        echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">";
        echo "<center><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        $date = actualTime();
        echo "<center><span class=\"option\"><strong>"._AUTOSTORYEDIT."</strong></span></center><br /><br />";
        $title = stripslashes($title);
        $hometext = stripslashes($hometext);
        $bodytext = stripslashes($bodytext);
        $notes = stripslashes($notes);
        list($topicimage) = $db->sql_ufetchrow("SELECT topicimage FROM "._TOPICS_TABLE." WHERE topicid='$topic'");
        echo "<table border=\"0\" width=\"75%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"ThemeInfo['bgcolor2']\" align=\"center\"><tr><td>"
            ."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor='".$ThemeInfo['bgcolor1']."'><tr><td>";
            if ($topic_icon == 0) {
                echo "<img src=\"$topicimage\" border=\"0\" align=\"right\" alt=\"\" />";
            }
        $hometext_bb = set_smilies(decode_bbcode(stripslashes($hometext), 1, true));
        $bodytext_bb = set_smilies(decode_bbcode(stripslashes($bodytext), 1, true));
        $hometext_bb = evo_img_tag_to_resize($hometext_bb);
        $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);
        themepreview($subject, $hometext_bb, $bodytext_bb);
        echo "</td></tr></table></td></tr></table>"
            ."<br /><br /><strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"title\" size=\"50\" value=\"$title\" /><br /><br />"
            ."<strong>"._TOPIC."</strong>&nbsp;<select name=\"topic\">";
        $toplist = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
        echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
            $topicid = intval($topicid);
            if ($topicid==$topic) { $sel = "selected='selected' "; }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
            $sel = "";
        }
        $db->sql_freeresult($toplist);
        echo "</select><br /><br />";
        $cat = $catid;
        SelectCategory($cat);
        echo '<br />';
        topicicon($topic_icon);
        echo '<br />';
        writes($writes);
        echo "<br />";
        puthome($ihome, $acomm);
        if ($evoconfig['multilingual'] == 1) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"alanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"alanguage\" value=\"\" />";
        }
        echo "<br /><br /><strong>"._STORYTEXT."</strong>";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'hometext,bodytext';
        Make_TextArea('hometext', $hometext, 'postnews', '100%', '200px');
        echo "<strong>"._EXTENDEDTEXT."</strong>";
        Make_TextArea('bodytext', $bodytext, 'postnews', '100%', '200px');
        echo "<span class=\"content\">"._ARESUREURL."</span><br /><br />";
        if ($aid != $informant) {
                echo "<strong>"._NOTES."</strong><br />
            <textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\">$notes</textarea><br /><br />";
        }
        echo "<br /><strong>"._CHNGPROGRAMSTORY."</strong><br /><br />"
            .""._NOWIS.": $date<br /><br />";
        $xday = 1;
        echo ""._DAY.": <select name=\"day\">";
        while ($xday <= 31) {
            if ($xday == $datetime[3]) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xday</option>";
            $xday++;
        }
        echo "</select>";
        $xmonth = 1;
        echo ""._UMONTH.": <select name=\"month\">";
        while ($xmonth <= 12) {
            if ($xmonth == $datetime[2]) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xmonth</option>";
            $xmonth++;
        }
        echo "</select>";
        echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$datetime[1]\" size=\"5\" maxlength=\"4\" />";
        echo "<br />"._HOUR.": <select name=\"hour\">";
        $xhour = 0;
        $cero = "0";
        while ($xhour <= 23) {
            $dummy = $xhour;
            if ($xhour < 10) {
                $xhour = "$cero$xhour";
            }
            if ($xhour == $datetime[4]) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xhour</option>";
            $xhour = $dummy;
            $xhour++;
        }
        echo "</select>";
        echo ": <select name=\"min\">";
        $xmin = 0;
        while ($xmin <= 59) {
            if (($xmin == 0) OR ($xmin == 5)) {
                $xmin = "0$xmin";
            }
            if ($xmin == $datetime[5]) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xmin</option>";
            $xmin = $xmin + 5;
        }
        echo "</select>";
        echo ": 00<br /><br />
        <input type=\"hidden\" name=\"anid\" value=\"$anid\" />
        <input type=\"hidden\" name=\"op\" value=\"autoSaveEdit\" />
        <input type=\"submit\" value=\""._SAVECHANGES."\" />
        </form>";
        CloseTable();
        NEAdminFooter();
    }

    function autoSaveEdit() {
        global $_GETVAR, $db, $admin_file, $module_name;


        $anid = $_GETVAR->get('anid', '_POST', 'int');
        $year = $_GETVAR->get('year', '_POST', 'int');
        $day = $_GETVAR->get('day', '_POST', 'int');
        $month = $_GETVAR->get('month', '_POST', 'int');
        $hour = $_GETVAR->get('hour', '_POST', 'int');
        $min = $_GETVAR->get('min', '_POST', 'int');
        $title = $_GETVAR->get('title', '_POST', 'string');
        $hometext = $_GETVAR->get('hometext', '_POST', 'sting');
        $bodytext = $_GETVAR->get('bodytext', '_POST', 'string');
        $topic = $_GETVAR->get('topic', '_POST', 'string');
        $notes = $_GETVAR->get('notes', '_POST', 'string');
        $catid = $_GETVAR->get('catid', '_POST', 'int');
        $ihome = $_GETVAR->get('ihome', '_POST', 'int');
        $alanguage = $_GETVAR->get('alanguage', '_POST', 'int');
        $acomm = $_GETVAR->get('acomm', '_POST', 'int');
        $topic_icon = $_GETVAR->get('topic_icon', '_POST', 'int');
        $writes = $_GETVAR->get('writes', '_POST', 'int');
        if ($day < 10) {
            $day = "0$day";
        }
        if ($month < 10) {
            $month = "0$month";
        }
        $sec = "00";
        $date = "$year-$month-$day $hour:$min:$sec";
        $title = Fix_Quotes($title);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        $result = $db->sql_query("update "._AUTONEWS_TABLE." set catid='$catid', title='$title', time='$date', hometext='$hometext', bodytext='$bodytext', topic='$topic', notes='$notes', ihome='$ihome', alanguage='$alanguage', acomm='$acomm', ticon='$topic_icon', writes='$writes' WHERE anid='$anid'");
        if (!$result) {
            exit();
        }
        redirect($admin_file.".php?op=adminStory");
    }

    function displayStory() {
        global $aid, $admin_file, $ThemeInfo, $db, $evoconfig, $_GETVAR;

        $qid = $_GETVAR->get('qid', '_REQUEST', 'int');
        $cat = 0;
        $acomm = 0;
        $ihome = 0;
        $topic_icon = 0;
        $pollTitle = '';
        $optionText = '';
        NEAdminHeader();
        echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">";
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._SUBMISSIONSADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        $date = actualTime();
        $qid = intval($qid);
        $result = $db->sql_query("SELECT qid, uid, uname, subject, story, storyext, topic, timestamp, alanguage FROM "._QUEUE_TABLE." WHERE qid='$qid'");
        list($qid, $uid, $uname, $subject, $story, $storyext, $topic, $timestamp, $alanguage) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $qid = intval($qid);
        $uid = intval($uid);
        $subject_1 = $subject;
        $tday  = date('j', $timestamp);
        $ttmon = date('n', $timestamp);
        $storyext_bb = set_smilies(decode_bbcode($storyext, 1, true));
        $story_bb = set_smilies(decode_bbcode($story, 1, true));
        $storyext_bb = evo_img_tag_to_resize($storyext_bb);
        $story_bb = evo_img_tag_to_resize($story_bb);
        OpenTable();
        echo "<font class=\"content\">"
            ."<strong>"._AUTHOR."</strong></font><br />"
            ."<input type=\"text\" name=\"author\" size=\"25\" value=\"$uname\" />";
        if ($uname != _ANONYMOUS) {
            $email = get_user_field('user_email', $uid, false);
            echo "&nbsp;&nbsp;<span class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._EMAILUSER."</a> | <a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname'>"._USERPROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</span>";
        }
        echo "<br /><br /><strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size='80' maxlength='80' value=\"$subject\" /><br /><br />";
        $result = $db->sql_query("SELECT `topicname`, `topicimage`, `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='$topic'");
        list($topicname, $topicimage, $topictext) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $storypre = $story_bb.'<br /><br />'.$storyext_bb;
        $writes = 0;
        themeindex($aid, $uname, $timestamp, $subject_1, 0, $topic, $storypre, '', '', $topicname, $topicimage, $topictext, $writes);
    //    themepreview($subject, $storypre);
        $toplist = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
        echo "<br /><br /><strong>"._SELECTTOPIC."</strong>&nbsp;<select name='topic'>";
        echo "<option value=''>"._SELECTTOPIC."</option>\n";
        while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
        $topicid = intval($topicid);
            if ($topicid==$topic) {
                $sel = "selected='selected' ";
            } else {
                $sel = '';
            }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
            $sel = "";
        }
        $db->sql_freeresult($toplist);
        echo "</select>";
        echo "<br /><br />";
        SelectCategory($cat);
        echo '<br />';
        topicicon($topic_icon);
        echo '<br />';
        writes(0);
        echo "<br />";
        puthome($ihome, $acomm);
        if ($evoconfig['multilingual'] == 1) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"alanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"alanguage\" value=\"\" />";
        }
        echo "<br /><br /><strong>"._STORYTEXT."</strong>";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'hometext,bodytext';
        Make_TextArea('hometext', $story, 'postnews');
        echo "<strong>"._EXTENDEDTEXT."</strong>";
        Make_TextArea('bodytext', $storyext, 'postnews');
        echo "<span class=\"content\">"._ARESUREURL."</span><br /><br />";
        echo "<span class=\"content\">"._AREYOUSURE."</span><br /><br />"
            ."<strong>"._NOTES."</strong><br />"
            ."<textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\"></textarea><br />"
            ."<input type=\"hidden\" name=\"qid\" size=\"50\" value=\"$qid\" />"
            ."<input type=\"hidden\" name=\"uid\" size=\"50\" value=\"$uid\" />"
            ."<br /><strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"1\" />"._YES." &nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"0\" checked=\"checked\" />"._NO."<br /><br />"
            .""._NOWIS.": $date<br /><br />";
        $day = 1;
        echo ""._DAY.": <select name=\"day\">";
        while ($day <= 31) {
            if ($tday==$day) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$day</option>";
            $day++;
        }
        echo "</select>";
        $month = 1;
        echo ""._UMONTH.": <select name=\"month\">";
        while ($month <= 12) {
            if ($ttmon==$month) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$month</option>";
            $month++;
        }
        echo "</select>";
        $date = getdate();
        $year = $date['year'];
        echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\" />";
        echo "<br />"._HOUR.": <select name=\"hour\">";
        $hour = 0;
        $cero = "0";
        while ($hour <= 23) {
            $dummy = $hour;
            if ($hour < 10) {
                $hour = "$cero$hour";
            }
            echo "<option>$hour</option>";
            $hour = $dummy;
            $hour++;
        }
        echo "</select>";
        echo ": <select name=\"min\">";
        $min = 0;
        while ($min <= 59) {
            if (($min == 0) OR ($min == 5)) {
                $min = "0$min";
            }
            echo "<option>$min</option>";
            $min = $min + 5;
        }
        echo "</select>";
        echo ": 00<br /><br />"
            ."<select name=\"op\">"
            ."<option value=\"DeleteStory\">"._DELETESTORY."</option>"
            ."<option value=\"PreviewAgain\" selected='selected'>"._PREVIEWSTORY."</option>"
            ."<option value=\"PostStory\">"._POSTSTORY."</option>"
            ."</select>"
            ."<input type=\"submit\" value=\""._OK."\" />";
            CloseTable();
        echo "<br />";
        putpoll($pollTitle, $optionText);
        echo "</form>";
        NEAdminFooter();
    }

    function previewStory() {
        global $admin_file, $boxstuff, $ThemeInfo, $db, $evoconfig, $userinfo, $_GETVAR;

        $automated = $_GETVAR->get('automated', '_POST', 'int');
        $year = $_GETVAR->get('year', '_POST', 'int');
        $day = $_GETVAR->get('day', '_POST', 'int');
        $month = $_GETVAR->get('month', '_POST', 'int');
        $hour = $_GETVAR->get('hour', '_POST', 'int');
        $min = $_GETVAR->get('min', '_POST', 'int');
        $qid = $_GETVAR->get('qid', '_POST', 'int');
        $uid = $_GETVAR->get('uid', '_POST', 'int');
        $author = $_GETVAR->get('author', '_POST', 'string');
        $subject = $_GETVAR->get('subject', '_POST', 'string');
        $hometext = $_GETVAR->get('hometext', '_POST', 'string');
        $bodytext = $_GETVAR->get('bodytext', '_POST', 'string');
        $topic = $_GETVAR->get('topic', '_POST', 'int');
        $notes = $_GETVAR->get('notes', '_POST', 'string');
        $catid = $_GETVAR->get('catid', '_POST', 'int');
        $ihome = $_GETVAR->get('ihome', '_POST', 'int');
        $alanguage = $_GETVAR->get('alanguage', '_POST', 'string');
        $acomm = $_GETVAR->get('acomm', '_POST', 'int');
        $topic_icon = $_GETVAR->get('topic_icon', '_POST', 'int');
        $writes = $_GETVAR->get('writes', '_POST', 'int');
        $pollTitle = $_GETVAR->get('pollTitle', '_POST', 'string');
        $optionText = $_GETVAR->get('optionText', '_POST', 'string');
        $assotop = $_GETVAR->get('assotop', '_POST', 'array');
        NEAdminHeader();
        echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">";
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        $today = getdate();
        $tday = $today['mday'];
        if ($tday < 10){
            $tday = "0$tday";
        }
        $tmonth = $today['month'];
        $tyear = $today['year'];
        $thour = $today['hours'];
        if ($thour < 10){
            $thour = "0$thour";
        }
        $tmin = $today['minutes'];
        if ($tmin < 10){
            $tmin = "0$tmin";
        }
        $tsec = $today['seconds'];
        if ($tsec < 10){
            $tsec = "0$tsec";
        }
        $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
        $subject = stripslashes($subject);
        $hometext = stripslashes($hometext);
        $bodytext = stripslashes($bodytext);
        $notes = stripslashes($notes);
        $result = $db->sql_query("SELECT `topicname`, `topicimage`, `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='$topic'");
        list($topicname, $topicimage, $topictext) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        OpenTable();
        echo "<font class=\"content\">"
            ."<strong>"._AUTHOR."</strong></font><br />"
            ."<input type=\"text\" name=\"author\" size=\"25\" value=\"$author\" />";
        if ($author != _ANONYMOUS) {
            $email = get_user_field('user_email', $uid, false);
            $pm_userid = $uid;
            echo "&nbsp;&nbsp;<span class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._EMAILUSER."</a> | <a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$author'>"._USERPROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</span>";
        }
        echo "<br /><br /><strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\" /><br /><br />";
        $bodytext_bb = set_smilies(decode_bbcode(stripslashes($bodytext), 1, true));
        $hometext_bb = set_smilies(decode_bbcode(stripslashes($hometext), 1, true));
        $hometext_bb = evo_img_tag_to_resize($hometext_bb);
        $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);
        $storypre = $hometext_bb.'<br /><br />'.$bodytext_bb;
        $informant[0] = $author;
        $informant[1] = UsernameColor($author);
        $result = $db->sql_query("SELECT `topicname`, `topicimage`, `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='$topic'");
        list($topicname, $topicimage, $topictext) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if ($topic_icon != 0) {
            $topicimage = '';
        }
        themeindex($userinfo['username'], $informant, formatTimeStamp(time()), $subject, 0, $topic, $storypre, '', '', $topicname, $topicimage, $topictext, $writes);
    //    themepreview($subject, $hometext_bb, $bodytext_bb, $notes);
        echo "<br /><br /><strong>"._TOPIC."</strong>&nbsp;<select name=\"topic\">";
        $toplist = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
        echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
                $topicid = intval($topicid);
            if ($topicid==$topic) {
                $sel = "selected='selected' ";
            }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
            $sel = "";
        }
        $db->sql_freeresult($toplist);
        echo "</select>";
        echo "<br /><br />";
        $cat = $catid;
        SelectCategory($cat);
        echo '<br />';
        topicicon($topic_icon);
        echo '<br />';
        writes($writes);
        echo "<br />";
        puthome($ihome, $acomm);
        if ($evoconfig['multilingual'] == 1) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"alanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\" />";
        }
        echo "<br /><br /><strong>"._STORYTEXT."</strong>";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'hometext,bodytext';
        Make_TextArea('hometext', $hometext, 'postnews');
        echo "<strong>"._EXTENDEDTEXT."</strong>";
        Make_TextArea('bodytext', $bodytext, 'postnews');
        echo "<span class=\"content\">"._ARESUREURL."</span><br /><br />";
        echo "<strong>"._NOTES."</strong><br />"
            ."<textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\">$notes</textarea><br /><br />"
            ."<input type=\"hidden\" name=\"qid\" size=\"50\" value=\"$qid\" />"
            ."<input type=\"hidden\" name=\"uid\" size=\"50\" value=\"$uid\" />";
        if ($automated == 1) {
            $sel1 = "checked='checked'";
            $sel2 = "";
        } else {
            $sel1 = "";
            $sel2 = "checked='checked'";
        }
        echo "<strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"1\" $sel1 />"._YES." &nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"0\" $sel2 />"._NO."<br /><br />"
            .""._NOWIS.": $date<br /><br />";
        $xday = 1;
        echo ""._DAY.": <select name=\"day\">";
        while ($xday <= 31) {
            if ($xday == $day) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xday</option>";
            $xday++;
        }
        echo "</select>";
        $xmonth = 1;
        echo ""._UMONTH.": <select name=\"month\">";
        while ($xmonth <= 12) {
            if ($xmonth == $month) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xmonth</option>";
            $xmonth++;
        }
        echo "</select>";
        echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\" />";
        echo "<br />"._HOUR.": <select name=\"hour\">";
        $xhour = 0;
        $cero = "0";
        while ($xhour <= 23) {
            $dummy = $xhour;
            if ($xhour < 10) {
                $xhour = "$cero$xhour";
            }
            if ($xhour == $hour) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xhour</option>";
            $xhour = $dummy;
            $xhour++;
        }
        echo "</select>";
        echo ": <select name=\"min\">";
        $xmin = 0;
        while ($xmin <= 59) {
            if (($xmin == 0) OR ($xmin == 5)) {
                $xmin = "0$xmin";
            }
            if ($xmin == $min) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xmin</option>";
            $xmin = $xmin + 5;
        }
        echo "</select>";
        echo ": 00<br /><br />"
            ."<select name=\"op\">"
            ."<option value=\"DeleteStory\">"._DELETESTORY."</option>"
            ."<option value=\"PreviewAgain\" selected='selected'>"._PREVIEWSTORY."</option>"
            ."<option value=\"PostStory\">"._POSTSTORY."</option>"
            ."</select>"
            ."<input type=\"submit\" value=\""._OK."\" />";
        CloseTable();
        echo "<br />";
        putpoll($pollTitle, $optionText);
        echo "</form>";
        NEAdminFooter();
    }

    function postStory() {
        global $_GETVAR, $aid, $admin_file, $db, $ne_config, $cache;

        $automated = $_GETVAR->get('automated', '_POST', 'int');
        $year = $_GETVAR->get('year', '_POST', 'int');
        $day = $_GETVAR->get('day', '_POST', 'int');
        $month = $_GETVAR->get('month', '_POST', 'int');
        $hour = $_GETVAR->get('hour', '_POST', 'int');
        $min = $_GETVAR->get('min', '_POST', 'int');
        $qid = $_GETVAR->get('qid', '_POST', 'int');
        $uid = $_GETVAR->get('uid', '_POST', 'int');
        $author = $_GETVAR->get('author', '_POST', 'string');
        $subject = $_GETVAR->get('subject', '_POST', 'string');
        $hometext = $_GETVAR->get('hometext', '_POST', 'string');
        $bodytext = $_GETVAR->get('bodytext', '_POST', 'string');
        $topic = $_GETVAR->get('topic', '_POST', 'string');
        $notes = $_GETVAR->get('notes', '_POST', 'string');
        $catid = $_GETVAR->get('catid', '_POST', 'int');
        $ihome = $_GETVAR->get('ihome', '_POST', 'int');
        $alanguage = $_GETVAR->get('alanguage', '_POST', 'string');
        $acomm = $_GETVAR->get('acomm', '_POST', 'int');
        $topic_icon = $_GETVAR->get('topic_icon', '_POST', 'int');
        $writes = $_GETVAR->get('writes', '_POST', 'int');
        $pollTitle = $_GETVAR->get('pollTitle', '_POST', 'string');
        $optionText = $_GETVAR->get('optionText', '_POST', 'string');
        $assotop = $_GETVAR->get('assotop', '_POST', 'array');

        for ($i=0, $max<count($assotop); $i< $max; $i++) { $associated .= "$assotop[$i]-"; }
        if ($automated == 1) {
            if ($day < 10) {
                $day = "0$day";
            }
            if ($month < 10) {
                $month = "0$month";
            }
            $sec = "00";
            $date = formatTimestamp("$year-$month-$day $hour:$min:$sec");
            if ($uid == 1) {$author = '';}
            if ($hometext == $bodytext) {$bodytext = '';}
            $subject = Fix_Quotes($subject);
            $hometext = Fix_Quotes($hometext);
            $bodytext = Fix_Quotes($bodytext);
            $notes = Fix_Quotes($notes);
            $new_sql  = 'INSERT INTO `'._AUTONEWS_TABLE.'` (`anid`, `catid`, `aid`, `title`, `time`, `hometext`, `bodytext`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `associated`, `ticon`, `writes`)
                          VALUES (NULL, '.$catid.', "'.$aid.'", "'.$subject.'", "'.$date.'", "'.$hometext.'", "'.$bodytext.'", "'.$topic.'", "'.$author.'", "'.$notes.'", "'.$ihome.'", "'.$alanguage.'", "'.$acomm.'", "'.$associated.'", "'.$topic_icon.'", "'.$writes.'")';
            $result = $db->sql_query($new_sql);
            if (!$result) { return; }
            list($artid) = $db->sql_ufetchrow("SELECT sid FROM "._STORIES_TABLE." WHERE title='".$subject."' ORDER BY time DESC limit 0,1");
            $artid = intval($artid);
            if ($uid != 1) {
                $db->sql_uquery("update "._USERS_TABLE." set counter=counter+1 WHERE user_id='$uid'");
                if($ne_config["notifyauth"] == 1) {
                    $urow = $db->sql_ufetchrow("SELECT username, user_email FROM "._USERS_TABLE." WHERE user_id='".$uid."'");
                    $Msubject = _NE_ARTPUB;
                    $Mbody = _NE_HASPUB."\n".EVO_SERVER_URL."/modules.php?name=News&op=article&sid=$artid";
                    $to    = $urow['user_email'].','.$urow['username'];
                    $return = evo_mail($to, $Msubject, $Mbody);
                }
            }
            $db->sql_uquery("UPDATE "._AUTHOR_TABLE." SET counter=counter+1 WHERE aid='$aid'");
            $qid = intval($qid);
            $db->sql_uquery("DELETE FROM "._QUEUE_TABLE." WHERE qid='$qid'");
            $cache->delete('numwaits', 'submissions');
            redirect($admin_file.".php?op=submissions");
        } else {
            if ($uid == 1) $author = "";
            if ($hometext == $bodytext) $bodytext = "";
            $subject = Fix_Quotes($subject);
            $hometext = Fix_Quotes($hometext);
            $bodytext = Fix_Quotes($bodytext);
            $notes = Fix_Quotes($notes);
            if ((!empty($pollTitle)) AND (!empty($optionText[1])) AND (!empty($optionText[2]))) {
                $haspoll = 1;
                $timeStamp = time();
                $pollTitle = Fix_Quotes($pollTitle);
                if(!$db->sql_query("INSERT INTO "._POLL_DESC_TABLE." (`pollID`, `pollTitle`, `timeStamp`, `voters`, `planguage`, `artid`) VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$alanguage', '0')")) {
                    return;
                }
                $object = $db->sql_ufetchrow("SELECT pollID FROM "._POLL_DESC_TABLE." WHERE pollTitle='$pollTitle'");
                $id = $object["pollID"];
                $id = intval($id);
                for($i = 1, $maxi = count($optionText); $i <= $maxi; $i++) {
                    if(!empty($optionText[$i])) {
                        $optionText[$i] = Fix_Quotes($optionText[$i]);
                    }
                    if(!$db->sql_query("INSERT INTO "._POLL_DATA_TABLE." (pollID, optionText, optionCount, voteID) VALUES ('$id', '$optionText[$i]', '0', '$i')")) {
                        return;
                    }
                }
            } else {
                $haspoll = 0;
                $id = 0;
            }
            $new_sql  = 'INSERT INTO `'._STORIES_TABLE.'` (`sid`, `catid`, `aid`, `title`, `time`, `hometext`, `bodytext`, `comments`, `counter`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `haspoll`, `pollID`, `score`, `ratings`, `associated`, `ticon`, `writes`)
                                VALUES (NULL, "'.$catid.'", "'.$aid.'", "'.$subject.'", NOW(), "'.$hometext.'", "'.$bodytext.'", "0", "0", "'.$topic.'", "'.$author.'", "'.$notes.'", "'.$ihome.'", "'.$alanguage.'", "'.$acomm.'", "'.$haspoll.'", "'.$id.'", "0", "0", "'.$associated.'", "'.$topic_icon.'", "'.$writes.'")';
            $result = $db->sql_query($new_sql);
            list($artid) = $db->sql_ufetchrow("SELECT sid FROM "._STORIES_TABLE." WHERE title='".$subject."' ORDER BY time DESC limit 0,1");
            $artid = intval($artid);
            $db->sql_uquery("UPDATE "._POLL_DESC_TABLE." SET artid='".$artid."' WHERE pollID='".$id."'");
            if (!$result) { return; }
            if ($uid != 1) {
                $db->sql_uquery("update "._USERS_TABLE." set counter=counter+1 WHERE user_id='".$uid."'");
                if($ne_config["notifyauth"] == 1) {
                    $urow = $db->sql_ufetchrow("SELECT username, user_email FROM "._USERS_TABLE." WHERE user_id='".$uid."'");
                    $Msubject = _NE_ARTPUB;
                    $Mbody = _NE_HASPUB."\n".EVO_SERVER_URL."/modules.php?name=News&op=article&sid=$artid";
                    $to    = $urow['user_email'].','.$urow['username'];
                    $return = evo_mail($to, $Msubject, $Mbody);
                }
                // Copyright (c) 2000-2007 by NukeScripts Network
                $db->sql_uquery("update "._USERS_TABLE." set counter=counter+1 WHERE user_id='$uid'");
            }
            $db->sql_uquery("update "._AUTHOR_TABLE." set counter=counter+1 WHERE aid='$aid'");
            deleteStory($qid);
        }
    }

    function editStory() {
        global $aid, $admin_file, $ThemeInfo, $db, $evoconfig, $module_name, $_GETVAR;

        $sid = $_GETVAR->get('sid', '_REQUEST', 'int');
        list($aaid) = $db->sql_ufetchrow("SELECT aid FROM "._STORIES_TABLE." WHERE sid='$sid'", SQL_NUM);
        $aaid = substr($aaid, 0,25);
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        $result = $db->sql_query("SELECT catid, title, hometext, bodytext, topic, notes, ihome, alanguage, acomm, ticon, writes FROM "._STORIES_TABLE." WHERE sid='".$sid."'");
        list($catid, $subject, $hometext, $bodytext, $topic, $notes, $ihome, $alanguage, $acomm, $topic_icon, $writes) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $catid = intval($catid);
        $subject = stripslashes($subject);
        $hometext = stripslashes($hometext);
        $bodytext = stripslashes($bodytext);
        $notes = stripslashes($notes);
        $ihome = intval($ihome);
        $acomm = intval($acomm);
        $aid = $aid;
        $topic_icon = intval($topic_icon);
        $writes = intval($writes);
        list($topicimage) = $db->sql_ufetchrow("SELECT topicimage FROM "._TOPICS_TABLE." WHERE topicid='".$topic."'");
        OpenTable();
        echo "<center><span class=\"option\"><strong>"._EDITARTICLE."</strong></span></center><br />"
           ."<table width=\"80%\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"ThemeInfo['bgcolor2']\" align=\"center\"><tr><td>"
           ."<table width=\"100%\" border=\"0\" cellpadding=\"8\" cellspacing=\"1\" bgcolor='".$ThemeInfo['bgcolor1']."'><tr><td>";
        if ($topic_icon == 0) {
           echo "<img src=\"$topicimage\" border=\"0\" align=\"right\" alt=\"\" />";
        }
        $hometext_bb = set_smilies(decode_bbcode(stripslashes(nl2br($hometext)), 1, true));
        $bodytext_bb = set_smilies(decode_bbcode(stripslashes(nl2br($bodytext)), 1, true));
        $hometext_bb = evo_img_tag_to_resize($hometext_bb);
        $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);
        themepreview($subject, $hometext_bb, $bodytext_bb, $notes);
        echo "</td></tr></table></td></tr></table><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
            ."<strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\" /><br /><br />"
            ."<strong>"._TOPIC."</strong>&nbsp;<select name=\"topic\">";
        $toplist = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
        echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
            $topicid = intval($topicid);
            if ($topicid==$topic) { $sel = "selected='selected' "; }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
            $sel = '';
        }
        $db->sql_freeresult($toplist);
        echo "</select>";
        echo "<br /><br />";
        $arow = $db->sql_ufetchrow("SELECT associated FROM "._STORIES_TABLE." WHERE sid='".$sid."'");
        $asso_t = explode("-", $arow['associated']);
        echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";
        $sql = "SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext";
        $result = $db->sql_query($sql);
        $a = 0;
        while ($row = $db->sql_fetchrow($result)) {
            if ($a == 3) {
                echo "</tr><tr>";
                $a = 0;
            }
            $checked = '';
            for ($i=0; $i<count($asso_t); $i++) {
                if ($asso_t[$i] == $row["topicid"]) {
                    $checked = "checked='checked'";
                    break;
                }
            }
            echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."' $checked />".$row["topictext"]."</td>";
            $checked = "";
            $a++;
        }
        $db->sql_freeresult($result);
        echo "</tr></table></td></tr></table><br /><br />";
        $cat = $catid;
        SelectCategory($cat);
        echo '<br />';
        topicicon($topic_icon);
        echo '<br />';
        writes($writes);
        echo "<br />";
        puthome($ihome, $acomm);
        if ($evoconfig['multilingual'] == 1) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"alanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"alanguage\" value=\"\" />";
        }
        echo "<br /><br /><strong>"._STORYTEXT."</strong>";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'hometext,bodytext';
        Make_TextArea('hometext', $hometext, 'postnews', '100%', '200px');
        echo "<strong>"._EXTENDEDTEXT."</strong>";
        Make_TextArea('bodytext', $bodytext, 'postnews', '100%', '200px');
        echo "<span class=\"content\">"._AREYOUSURE."</span><br /><br />"
           ."<strong>"._NOTES."</strong><br />"
           ."<textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\">$notes</textarea><br /><br />"
           ."<input type=\"hidden\" name=\"sid\" size=\"50\" value=\"$sid\" />"
           ."<input type=\"hidden\" name=\"op\" value=\"ChangeStory\" />"
           ."<input type=\"submit\" value=\""._SAVECHANGES."\" />"
           ."</form>";
        CloseTable();
        NEAdminFooter();
    }

    function removeStory() {
        global $db, $admin_file, $module_name, $_GETVAR;

        $sid = $_GETVAR->get('sid', '_REQUEST', 'int');
        $ok  = $_GETVAR->get('ok', '_REQUEST', 'int', 0);
        list($aaid) = $db->sql_ufetchrow("SELECT aid FROM "._STORIES_TABLE." WHERE sid='".$sid."'", SQL_NUM);
        $aaid = substr($aaid, 0,25);
        if($ok) {
            $counter--;
            $db->sql_uquery("DELETE FROM "._STORIES_TABLE." WHERE sid='".$sid."'");
            $db->sql_uquery("DELETE FROM "._COMMENTS_TABLE." WHERE sid='".$sid."'");
            $db->sql_uquery("update "._POLL_DESC_TABLE." set artid='0' WHERE artid='".$sid."'");
            $db->sql_uquery("update "._AUTHOR_TABLE." set counter='".$counter."' WHERE aid='".$aid."'");
            redirect($admin_file.".php?op=adminStory");
        } else {
            NEAdminHeader();
            OpenTable();
            echo "<center><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></center>";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center>"._REMOVESTORY." $sid "._ANDCOMMENTS."";
            echo "<br /><br />[ <a href=\"".$admin_file.".php?op=adminStory\">"._NO."</a> | <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid&amp;ok=1\">"._YES."</a> ]</center>";
            CloseTable();
            NEAdminFooter();
        }
    }

    function changeStory() {
        global $aid, $db, $admin_file, $module_name, $_GETVAR;

        $sid = $_GETVAR->get('sid', '_REQUEST', 'int');
        $subject = $_GETVAR->get('subject', '_REQUEST', 'string');
        $hometext = $_GETVAR->get('hometext', '_REQUEST', 'string');
        $bodytext = $_GETVAR->get('bodytext', '_REQUEST', 'string');
        $topic = $_GETVAR->get('topic', '_REQUEST', 'string');
        $notes = $_GETVAR->get('notes', '_REQUEST', 'string');
        $catid = $_GETVAR->get('catid', '_REQUEST', 'int');
        $ihome = $_GETVAR->get('ihome', '_REQUEST', 'int');
        $alanguage = $_GETVAR->get('alanguage', '_REQUEST', 'string');
        $acomm = $_GETVAR->get('acomm', '_REQUEST', 'int');
        $topic_icon = $_GETVAR->get('topic_icon', '_REQUEST', 'int');
        $writes = $_GETVAR->get('writes', '_REQUEST', 'int');
        $assotop = $_GETVAR->get('assotop', '_REQUEST', 'array');
        for ($i=0; $i<count($assotop); $i++) { $associated .= "$assotop[$i]-"; }
        $sid = intval($sid);
        $aid = substr($aid, 0,25);
        list($aaid) = $db->sql_ufetchrow("SELECT aid FROM "._STORIES_TABLE." WHERE sid='".$sid."'", SQL_NUM);
        $aaid = substr($aaid, 0,25);
        $subject = Fix_Quotes($subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        $topic = (empty($topic)) ? '1' : $topic;
        $db->sql_uquery("update "._STORIES_TABLE." set catid='".$catid."', title='".$subject."', hometext='".$hometext."', bodytext='".$bodytext."', topic='".$topic."', notes='".$notes."', ihome='".$ihome."', alanguage='".$alanguage."', acomm='".$acomm."', ticon='".$topic_icon."', writes='".$writes."' WHERE sid='".$sid."'");
        $db->sql_uquery("update "._STORIES_TABLE." set associated='$associated' WHERE sid='".$sid."'");
        redirect($admin_file.".php?op=adminStory");
    }

    function adminStory() {
        global $db, $currentlang, $evoconfig, $admin_file, $module_name, $ThemeInfo;

        $hometext = '';
        $bodytext = '';
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><strong>"._LAST." 20 "._ARTICLES."</strong></center><br />";
        $result6 = $db->sql_query("SELECT sid, aid, title, time, topic, informant, alanguage, ihome FROM "._STORIES_TABLE." ORDER BY time DESC LIMIT 0,20");
        echo "<center><table border=\"1\" width=\"100%\" bgcolor='".$ThemeInfo['bgcolor1']."'>";
        echo "<tr>\n";
        echo "<th>"._NE_ID."</th>\n";
        echo "<th>"._TITLE."</th>\n";
        echo "<th>"._PUBLISHINHOME."</th>\n";
        echo "<th>"._LANGUAGE."</th>\n";
        echo "<th>"._TOPICS."</th>\n";
        echo "<th>"._NE_ACTION."</th>\n";
        echo "</tr>\n";
        while ($row6 = $db->sql_fetchrow($result6)) {
            $sid = intval($row6["sid"]);
            $aid = $row6['aid'];
            $said = substr($aid, 0,25);
            $title = $row6['title'];
            $time = $row6['time'];
            $tday  = @intval(date('j', $time));
            $ttmon = @intval(date('n', $time));
            $topic = $row6['topic'];
            $informant = $row6['informant'];
            $alanguage = $row6['alanguage'];
            $ihome = intval($row6['ihome']);
            $row7 = $db->sql_ufetchrow("SELECT topicname FROM "._TOPICS_TABLE." WHERE topicid='".$topic."'");
            $topicname = $row7["topicname"];
            if (empty($alanguage)) {
                $alanguage = ""._ALL."";
            }
            formatTimestamp($time);
            echo "<tr><td align=\"right\"><strong>$sid</strong>"
                ."</td><td align=\"left\" width=\"55%\"><a href=\"modules.php?name=News&amp;op=article&amp;sid=$sid\">$title</a>"
                ."</td><td align=\"center\" width=\"5%\">";
            if ($ihome == 0) {
                echo _YES;
            } else {
                echo _NO;
            }
            echo "</td><td align=\"center\" width=\"20%\">$alanguage"
                ."</td><td align=\"left\" width=\"20%\">$topicname";
            if (is_mod_admin($module_name)) {
                if ($aid == $said) {
                    echo "</td><td align=\"right\" nowrap=\"nowrap\">(<a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a>)"
                         ."</td></tr>";
                } else {
                    echo "</td><td align=\"right\" nowrap=\"nowrap\"><span class=\"content\"><em>("._NOFUNCTIONS.")</em></span>"
                        ."</td></tr>";
                }
            } else {
                echo "</td></tr>";
            }
        }
        $db->sql_freeresult($result6);
        echo "</table></center>";
        if (is_mod_admin($module_name)) {
        echo "<center>"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            .""._STORYID.": <input type=\"text\" name=\"sid\" size=\"10\" />"
            ."<select name=\"op\">"
            ."<option value=\"EditStory\" selected='selected'>"._EDIT."</option>"
            ."<option value=\"RemoveStory\">"._DELETE."</option>"
            ."</select>"
            ."<input type=\"submit\" value=\""._GO."\" />"
            ."</form></center>";
        }
        CloseTable();
        echo "<br />";
       if (!empty($admlanguage)) {
            $queryalang = "WHERE alanguage='".$admlanguage."' ";
        } else {
            $queryalang = "";
        }
        if (is_active("News")) {
        OpenTable();
        echo "<center><strong>"._AUTOMATEDARTICLES."</strong></center><br />";
        $count = 0;
        $result5 = $db->sql_query("SELECT anid, aid, title, time, alanguage FROM "._AUTONEWS_TABLE." ".$queryalang." ORDER BY time ASC");
        while (list($anid, $aid, $listtitle, $time, $alanguage) = $db->sql_fetchrow($result5)) {
            $anid = intval($anid);
            $said = substr($aid, 0,25);
            $title = $listtitle;
            if (empty($alanguage)) {
                $alanguage = ""._ALL."";
            }
            if (!empty($anid)) {
                if ($count == 0) {
                    echo "<table border=\"1\" width=\"100%\">";
                    $count = 1;
                }
                $time = str_replace(" ", "@", $time);
                if (is_mod_admin('News')) {
                    if ($aid == $said) {
                        echo "<tr><td nowrap=\"nowrap\">&nbsp;(<a href=\"".$admin_file.".php?op=autoEdit&amp;anid=$anid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=autoDelete&amp;anid=$anid\">"._DELETE."</a>)&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap=\"nowrap\">&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
                    } else {
                        echo "<tr><td>&nbsp;("._NOFUNCTIONS.")&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap=\"nowrap\">&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
                    }
                } else {
                    echo "<tr><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap=\"nowrap\">&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
                }
            }
        }
        $db->sql_freeresult($result5);
        if ((empty($anid)) AND ($count == 0)) {
            echo "<center><em>"._NOAUTOARTICLES."</em></center>";
        }
        if ($count == 1) {
            echo "</table>";
        }
        CloseTable();
        echo "<br />";
        }
        $date = actualTime();
        echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">";
        OpenTable();
        echo "<center><span class=\"option\"><strong>"._ADDARTICLE."</strong></span></center><br /><br />"
            ."<strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\" /><br /><br />"
            ."<strong>"._TOPIC."</strong> ";
        $toplist = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
        echo "<select name=\"topic\">";
        echo "<option value=\"\">"._SELECTTOPIC."</option>\n";
        while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
            $topicid = intval($topicid);
            if ($topicid == $topic) {
                $sel = "selected='selected' ";
            } else {
                $sel = "";
            }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
        }
        $db->sql_freeresult($toplist);
        echo "</select><br /><br />";
            echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
                ."<table border='1' cellspacing='3' cellpadding='8'><tr>";
            $sql = "SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext";
            $result = $db->sql_query($sql);
            $a = 0;
            while ($row = $db->sql_fetchrow($result)) {
                if ($a == 3) {
                    echo "</tr><tr>";
                    $a = 0;
                }
                echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."' />".$row["topictext"]."</td>";
                $a++;
            }
            $db->sql_freeresult($result);
            echo "</tr></table></td></tr></table><br /><br />";
        $cat = 0;
        SelectCategory($cat);
        echo "<br />";
        topicicon(0);
        echo '<br />';
        writes(0);
        echo '<br />';
        puthome('', '');
        if ($evoconfig['multilingual']) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"alanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($currentlang == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($currentlang == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"alanguage\" value='".$currentlang."' />";
        }
        echo "<br /><br /><strong>"._STORYTEXT."</strong>";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'hometext,bodytext';
        Make_TextArea('hometext', $hometext, 'postnews', '100%', '200px');
        echo "<strong>"._EXTENDEDTEXT."</strong>";
        Make_TextArea('bodytext', $bodytext, 'postnews', '100%', '200px');
        echo "<span class=\"content\">"._ARESUREURL."</span>"
            ."<br /><br /><strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"1\" />"._YES." &nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"0\" checked=\"checked\" />"._NO."<br /><br />"
            .""._NOWIS.": $date<br /><br />";
        $day = 1;
        echo ""._DAY.": <select name=\"day\">";
        while ($day <= 31) {
            if ($tday==$day) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$day</option>";
            $day++;
        }
        echo "</select>";
        $month = 1;
        echo ""._UMONTH.": <select name=\"month\">";
        while ($month <= 12) {
            if ($ttmon==$month) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$month</option>";
            $month++;
        }
        echo "</select>";
        $date = getdate();
        $year = $date['year'];
        echo _YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\" />"
            ."<br />"._HOUR.": <select name=\"hour\">";
        $hour = 0;
        $cero = "0";
        while ($hour <= 23) {
            $dummy = $hour;
            if ($hour < 10) {
                $hour = "$cero$hour";
            }
            echo "<option>$hour</option>";
            $hour = $dummy;
            $hour++;
        }
        echo "</select>"
            .": <select name=\"min\">";
        $min = 0;
        while ($min <= 59) {
            if (($min == 0) OR ($min == 5)) {
                $min = "0$min";
            }
            echo "<option>$min</option>";
            $min = $min + 5;
        }
        echo "</select>";
        echo ": 00<br /><br />"
            ."<select name=\"op\">"
            ."<option value=\"PreviewAdminStory\" selected='selected'>"._PREVIEWSTORY."</option>"
            ."<option value=\"PostAdminStory\">"._POSTSTORY."</option>"
            ."</select>"
            ."<input type=\"submit\" value=\""._OK."\" />";
        CloseTable();
        echo "<br />";
        putpoll('', '');
        echo "</form>";
        NEAdminFooter();
    }

    function previewAdminStory() {
        global $admin_file, $ThemeInfo, $db, $alanguage, $evoconfig, $_GETVAR;

        $automated = $_GETVAR->get('automated', '_POST', 'int');
        $year = $_GETVAR->get('year', '_POST', 'int');
        $day = $_GETVAR->get('day', '_POST', 'int');
        $month = $_GETVAR->get('month', '_POST', 'int');
        $hour = $_GETVAR->get('hour', '_POST', 'int');
        $min = $_GETVAR->get('min', '_POST', 'int');
        $subject = $_GETVAR->get('subject', '_POST', 'string');
        $hometext = $_GETVAR->get('hometext', '_POST', 'string');
        $bodytext = $_GETVAR->get('bodytext', '_POST', 'string');
        $topic = $_GETVAR->get('topic', '_POST', 'string');
        $catid = $_GETVAR->get('catid', '_POST', 'int');
        $ihome = $_GETVAR->get('ihome', '_POST', 'int');
        $alanguage = $_GETVAR->get('alanguage', '_POST', 'string');
        $acomm = $_GETVAR->get('acomm', '_POST', 'int');
        $topic_icon = $_GETVAR->get('topic_icon', '_POST', 'int');
        $writes = $_GETVAR->get('writes', '_POST', 'int');
        $pollTitle = $_GETVAR->get('pollTitle', '_POST', 'string');
        $optionText = $_GETVAR->get('optionText', '_POST', 'string');
        $assotop = $_GETVAR->get('assotop', '_POST', 'array');
        $associated = '';
        if ($topic<1) {
            $topic = 1;
        }
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        $date = actualTime();
        OpenTable();
        echo "<center><span class=\"option\"><strong>"._PREVIEWSTORY."</strong></span></center><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
            ."<input type=\"hidden\" name=\"catid\" value=\"$catid\" />";
        $subject = stripslashes($subject);
        $subject = preg_replace("#\"#", "''", $subject);
        $hometext = stripslashes($hometext);
        $bodytext = stripslashes($bodytext);
        list($topicimage) = $db->sql_ufetchrow("SELECT topicimage FROM "._TOPICS_TABLE." WHERE topicid='".$topic."'");
        echo "<table border=\"0\" width=\"75%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"ThemeInfo['bgcolor2']\" align=\"center\"><tr><td>"
            ."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor='".$ThemeInfo['bgcolor1']."'><tr><td>";
            if ($topic_icon == 0) {
                echo "<img src=\"$topicimage\" border=\"0\" align=\"right\" alt=\"\" />";
            }
        $hometext_bb = set_smilies(decode_bbcode(stripslashes($hometext), 1, true));
        $bodytext_bb = set_smilies(decode_bbcode(stripslashes($bodytext), 1, true));
        $hometext_bb = evo_img_tag_to_resize($hometext_bb);
        $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);
        themepreview($subject, $hometext_bb, $bodytext_bb);
        echo "</td></tr></table></td></tr></table>"
            ."<br /><br /><strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\" /><br /><br />"
            ."<strong>"._TOPIC."</strong><select name=\"topic\">";
        $toplist = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
        echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
                $topicid = intval($topicid);
            if ($topicid==$topic) {
                $sel = "selected='selected' ";
            }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
            $sel = "";
        }
        $db->sql_freeresult($toplist);
        echo "</select><br /><br />";
        for ($i=0; $i<count($assotop); $i++) { $associated .= "$assotop[$i]-"; }
        $asso_t = explode("-", $associated);
        echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";
        $sql = "SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext";
        $result = $db->sql_query($sql);
        $a = 0;
        $checked = '';
        while ($row = $db->sql_fetchrow($result)) {
            if ($a == 3) {
                echo "</tr><tr>";
                $a = 0;
            }
            for ($i=0; $i<count($asso_t); $i++) {
                if ($asso_t[$i] == $row["topicid"]) {
                    $checked = "checked='checked'";
                    break;
                }
            }
            echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."' $checked />".$row["topictext"]."</td>";
            $checked = '';
            $a++;
        }
        $db->sql_freeresult($result);
        echo "</tr></table></td></tr></table><br /><br />";
        $cat = $catid;
        SelectCategory($cat);
        echo '<br />';
        topicicon($topic_icon);
        echo '<br />';
        writes($writes);
        echo "<br />";
        puthome($ihome, $acomm);
        if ($evoconfig['multilingual'] == 1) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"alanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\" />";
        }
        echo "<br /><br /><strong>"._STORYTEXT."</strong>";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'hometext,bodytext';
        Make_TextArea('hometext', $hometext, 'postnews', '100%', '200px');
        echo "<strong>"._EXTENDEDTEXT."</strong>";
        Make_TextArea('bodytext', $bodytext, 'postnews', '100%', '200px');
        if ($automated == 1) {
            $sel1 = "checked='checked'";
            $sel2 = "";
        } else {
            $sel1 = "";
            $sel2 = "checked='checked'";
        }
        echo "<br /><strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"1\" $sel1 />"._YES." &nbsp;&nbsp;"
            ."<input type=\"radio\" name=\"automated\" value=\"0\" $sel2 />"._NO."<br /><br />"
            ._NOWIS.": $date<br /><br />";
        $xday = 1;
        echo _DAY.": <select name=\"day\">";
        while ($xday <= 31) {
            if ($xday == $day) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xday</option>";
            $xday++;
        }
        echo "</select>";
        $xmonth = 1;
        echo ""._UMONTH.": <select name=\"month\">";
        while ($xmonth <= 12) {
            if ($xmonth == $month) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xmonth</option>";
            $xmonth++;
        }
        echo "</select>";
        echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\" />";
        echo "<br />"._HOUR.": <select name=\"hour\">";
        $xhour = 0;
        $cero = "0";
        while ($xhour <= 23) {
            $dummy = $xhour;
            if ($xhour < 10) {
                $xhour = "$cero$xhour";
            }
            if ($xhour == $hour) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xhour</option>";
            $xhour = $dummy;
            $xhour++;
        }
        echo "</select>";
        echo ": <select name=\"min\">";
        $xmin = 0;
        while ($xmin <= 59) {
            if (($xmin == 0) OR ($xmin == 5)) {
                $xmin = "0$xmin";
            }
            if ($xmin == $min) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option $sel>$xmin</option>";
            $xmin = $xmin + 5;
        }
        echo "</select>";
        echo ": 00<br /><br />"
            ."<select name=\"op\">"
            ."<option value=\"PreviewAdminStory\" selected='selected'>"._PREVIEWSTORY."</option>"
            ."<option value=\"PostAdminStory\">"._POSTSTORY."</option>"
            ."</select>"
            ."<input type=\"submit\" value=\""._OK."\" />";
        CloseTable();
        echo "<br />";
        putpoll($pollTitle, $optionText);
        echo "</form>";
        NEAdminFooter();
    }

    function postAdminStory() {
        global $aid, $db, $admin_file, $_GETVAR;

        $automated = $_GETVAR->get('automated', '_POST', 'int');
        $year = $_GETVAR->get('year', '_POST', 'int');
        $day = $_GETVAR->get('day', '_POST', 'int');
        $month = $_GETVAR->get('month', '_POST', 'int');
        $hour = $_GETVAR->get('hour', '_POST', 'int');
        $min = $_GETVAR->get('min', '_POST', 'int');
        $subject = $_GETVAR->get('subject', '_POST', 'string');
        $hometext = $_GETVAR->get('hometext', '_POST', 'string');
        $bodytext = $_GETVAR->get('bodytext', '_POST', 'string');
        $topic = $_GETVAR->get('topic', '_POST', 'string');
        $catid = $_GETVAR->get('catid', '_POST', 'int');
        $ihome = $_GETVAR->get('ihome', '_POST', 'int');
        $alanguage = $_GETVAR->get('alanguage', '_POST', 'string');
        $acomm = $_GETVAR->get('acomm', '_POST', 'int');
        $topic_icon = $_GETVAR->get('topic_icon', '_POST', 'int');
        $writes = $_GETVAR->get('writes', '_POST', 'int');
        $pollTitle = $_GETVAR->get('pollTitle', '_POST', 'string');
        $optionText = $_GETVAR->get('optionText', '_POST', 'string');
        $assotop = $_GETVAR->get('assotop', '_POST', 'array');
        for ($i=0; $i<count($assotop); $i++)
        {
          $associated .= "$assotop[$i]-";
        }
        if ($automated == 1) {
            if ($day < 10) {
                $day = "0$day";
            }
            if ($month < 10) {
                $month = "0$month";
            }
            $sec = "00";
            $date = "$year-$month-$day $hour:$min:$sec";
            $notes = "";
            $author = $aid;
            $subject = Fix_Quotes($subject);
            $subject = preg_replace("#\"#", "''", $subject);
            $hometext = Fix_Quotes($hometext);
            $bodytext = Fix_Quotes($bodytext);
            $notes = Fix_Quotes($notes);
            $new_sql  = 'INSERT INTO `'._AUTONEWS_TABLE.'` (`anid`, `catid`, `aid`, `title`, `time`, `hometext`, `bodytext`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `associated`, `ticon`, `writes`)
                          VALUES (NULL, '.$catid.', "'.$aid.'", "'.$subject.'", "'.$date.'", "'.$hometext.'", "'.$bodytext.'", "'.$topic.'", "'.$aid.'", "'.$notes.'", "'.$ihome.'", "'.$alanguage.'", "'.$acomm.'", "'.$associated.'", "'.$topic_icon.'", "'.$writes.'")';
            $result = $db->sql_query($new_sql);
            if (!$result) { exit(); }
            $db->sql_uquery("update "._AUTHOR_TABLE." set counter=counter+1 WHERE aid='".$aid."'");
            redirect($admin_file.".php?op=adminStory");
        } else {
            $subject = Fix_Quotes($subject);
            $hometext = Fix_Quotes($hometext);
            $bodytext = Fix_Quotes($bodytext);
            if ((!empty($pollTitle)) AND (!empty($optionText[1])) AND (!empty($optionText[2]))) {
                $haspoll = 1;
                $timeStamp = time();
                $pollTitle = Fix_Quotes($pollTitle);

                if(!$db->sql_query("INSERT INTO "._POLL_DESC_TABLE." (`pollID`, `pollTitle`, `timeStamp`, `voters`, `planguage`, `artid`) VALUES (NULL, '".$pollTitle."', '".$timeStamp."', '0', '".$alanguage."', '0')")) {
                    return;
                }
                $object = $db->sql_ufetchrow("SELECT pollID FROM "._POLL_DESC_TABLE." WHERE pollTitle='".$pollTitle."'");
                $id = $object['pollID'];
                $id = intval($id);
                for($i = 1, $maxi = count($optionText); $i <= $maxi; $i++) {
                    if(!empty($optionText[$i])) {
                        $optionText[$i] = Fix_Quotes($optionText[$i]);
                    }
                    if(!$db->sql_query("INSERT INTO "._POLL_DATA_TABLE." (pollID, optionText, optionCount, voteID) VALUES ('".$id."', '".$optionText[$i]."', '0', '".$i."')")) {
                        return;
                    }
                }
            } else {
                $haspoll = 0;
                $id = 0;
            }
            $new_sql  = 'INSERT INTO `'._STORIES_TABLE.'` (`sid`, `catid`, `aid`, `title`, `time`, `hometext`, `bodytext`, `comments`, `counter`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `haspoll`, `pollID`, `score`, `ratings`, `associated`, `ticon`, `writes`)
                                VALUES (NULL, '.$catid.', "'.$aid.'", "'.$subject.'", now(), "'.$hometext.'", "'.$bodytext.'", "0", "0", "'.$topic.'", "'.$aid.'", "'.$notes.'", "'.$ihome.'", "'.$alanguage.'", "'.$acomm.'", "'.$haspoll.'", "'.$id.'", "0", "0", "'.$associated.'", "'.$topic_icon.'", "'.$writes.'")';
            $db->sql_uquery($new_sql);
            $result = $db->sql_query("SELECT sid FROM "._STORIES_TABLE." WHERE title='".$subject."' ORDER BY time DESC limit 0,1");
            list($artid) = $db->sql_fetchrow($result);
            $artid = intval($artid);
            $db->sql_query("UPDATE "._POLL_DESC_TABLE." SET artid='".$artid."' WHERE pollID='".$id."'");
            if (!$result) {
                exit();
            }
            $db->sql_freeresult($result);
            $db->sql_uquery("UPDATE "._AUTHOR_TABLE." set counter=counter+1 WHERE aid='".$aid."'");
            redirect($admin_file.".php?op=adminStory");
        }
    }

    function submissions() {
        global $admin, $admin_file, $ThemeInfo, $db, $evoconfig, $module_name;

        $dummy = 0;
        NEAdminHeader();
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._SUBMISSIONSADMIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        $result = $db->sql_query("SELECT qid, uid, uname, subject, timestamp, alanguage FROM "._QUEUE_TABLE." ORDER BY timestamp DESC");
        if($db->sql_numrows($result) == 0) {
            echo "<table width=\"100%\"><tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align=\"center\"><strong>"._NOSUBMISSIONS."</strong></td></tr></table>\n";
            if (is_mod_admin($module_name)) {
                echo "<br /><center>"
                    ."[ <a href=\"".$admin_file.".php\">"._BACK."</a> ]"
                    ."</center><br />";
            }
        } else {
            echo "<center><span class=\"content\"><strong>"._NEWSUBMISSIONS."</strong></span><form action=\"".$admin_file.".php\" method=\"post\"><table width=\"100%\" border=\"1\" bgcolor=\"ThemeInfo['bgcolor2']\"><tr><td><strong>&nbsp;"._TITLE."&nbsp;</strong></td>";
            if ($evoconfig['multilingual'] == 1) {
                  echo "<td><center><strong>&nbsp;"._LANGUAGE."&nbsp;</strong></center></td>";
            }
                echo "<td><center><strong>&nbsp;"._AUTHOR."&nbsp;</strong></center></td><td><center><strong>&nbsp;"._DATE."&nbsp;</strong></center></td><td><center><strong>&nbsp;"._FUNCTIONS."&nbsp;</strong></center></td></tr>\n";
            while (list($qid, $uid, $uname, $subject, $timestamp, $alanguage) = $db->sql_fetchrow($result)) {
                $qid = intval($qid);
                $uid = intval($uid);
                echo "<tr>\n";
                echo "<td width=\"100%\"><span class=\"content\">\n";
                if (empty($subject)) {
                    echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayStory&amp;qid=$qid\">"._NOSUBJECT."</a></span>\n";
                } else {
                    echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayStory&amp;qid=$qid\">$subject</a></span>\n";
                }
                if ($evoconfig['multilingual'] == 1) {
                        if (empty($alanguage)) {
                                    $alanguage = _ALL;
                        }
                        echo "</td><td align=\"center\"><font size=\"2\">&nbsp;$alanguage&nbsp;</font>\n";
                }
                if ($uname != _ANONYMOUS) {
                        $uname_color = UsernameColor($uname);
                        echo "</td><td align=\"center\" nowrap=\"nowrap\"><font size=\"2\">&nbsp;<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname'>$uname_color</a>&nbsp;</font>\n";
                } else {
                        echo "</td><td align=\"center\" nowrap=\"nowrap\"><font size=\"2\">&nbsp;$uname&nbsp;</font>\n";
                }
                $timestamp = explode(" ", $timestamp);
                echo "</td><td align=\"right\" nowrap=\"nowrap\"><span class=\"content\">&nbsp;$timestamp[0]&nbsp;</span></td><td align=\"center\">&nbsp;<a href=\"".$admin_file.".php?op=DeleteStory&amp;qid=$qid\">"._DELETE."</a>&nbsp;</td></tr>\n";
                $dummy++;
            }
            if ($dummy < 1) {
                echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align=\"center\"><strong>"._NOSUBMISSIONS."</strong></form></td></tr></table>\n";
            } else {
                echo "</table></form></center>\n";
            }
            if (is_mod_admin($module_name)) {
                echo "<br /><center>"
                    ."[ <a href=\"".$admin_file.".php?op=subdelete\">"._DELETE."</a> ]"
                    ."</center><br />";
            }
        }
        $db->sql_freeresult($result);
        CloseTable();
        NEAdminFooter();
    }

    function subdelete() {
        global $db, $admin_file, $cache;
        $db->sql_uquery("DELETE FROM "._QUEUE_TABLE);
        $cache->delete('numwaits', 'submissions');
        redirect($admin_file.".php?op=adminStory");
    }

    function NEConfig() {
        global $admin_file, $ThemeInfo, $db;

        $pagetitle = ": "._NE_NEWSCONFIG;
        NEAdminHeader();
        $ne_config = ne_get_configs();
        if (!isset($ne_config['rotator_width'])) {
            $ne_config['rotator_width']  = 0;
        }
        if (!isset($ne_config['rotator_height'])) {
            $ne_config['rotator_height'] = 0;
        }
        if (!isset($ne_config['rotator_speed'])) {
            $ne_config['rotator_speed'] = 0;
        }
        title(_NE_NEWSCONFIG);
        OpenTable();
        echo "<form action='".$admin_file.".php?op=NENewsConfigSave' method='post'>\n";
        echo "<center>\n<table border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>"._NE_DISPLAYTYPE.":</strong></td>\n<td><select name='xcolumns'>";
        $ck1 = $ck2 = $ck3 = '';
        switch($ne_config['columns']) {
            case 0: $ck1 = " selected='selected'"; break;
            case 1: $ck2 = " selected='selected'"; break;
            case 2: $ck3 = " selected='selected'"; break;
        }
        echo "<option value='0'$ck1>"._NE_SINGLE."</option>\n<option value='1'$ck2>"._NE_DUAL."</option>\n<option value='2'$ck3>"._NE_ROTATOR."</option>\n</select></td>\n</tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>"._NE_ROTATOR_WIDTH.":</strong></td>\n";
        echo "<td><input type='text' name='xrotator_width' value='".$ne_config['rotator_width']."' size='5' maxlength='4' /></td></tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>"._NE_ROTATOR_HEIGHT.":</strong></td>\n";
        echo "<td><input type='text' name='xrotator_height' value='".$ne_config['rotator_height']."' size='5' maxlength='4' /></td></tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>"._NE_ROTATOR_SPEED.":</strong></td>\n";
        echo "<td><input type='text' name='xrotator_speed' value='".$ne_config['rotator_speed']."' size='5' maxlength='5' /></td></tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>"._NE_READLINK.":</strong></td>\n<td><select name='xreadmore'>";
        if ($ne_config["readmore"] == 0) { $ck1 = " selected='selected'"; $ck2 = ""; } else { $ck1 = ""; $ck2 = " selected='selected'"; }
        echo "<option value='0'$ck1>"._NE_PAGE."</option>\n<option value='1'$ck2>"._NE_POPUP."</option>\n</select></td>\n</tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>"._NE_TEXTTYPE.":</strong></td>\n<td><select name='xtexttype'>";
        if ($ne_config["texttype"] == 0) { $ck1 = " selected='selected'"; $ck2 = ""; } else { $ck1 = ""; $ck2 = " selected='selected'"; }
        echo "<option value='0'$ck1>"._NE_COMPLETE."</option>\n<option value='1'$ck2>"._NE_TRUNCATE."</option>\n</select></td>\n</tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."' valign='top'><strong>"._NE_NOTIFYAUTH.":</strong></td>\n<td><select name='xnotifyauth'>";
        if ($ne_config["notifyauth"] == 0) { $ck1 = " selected='selected'"; $ck2 = ""; } else { $ck1 = ""; $ck2 = " selected='selected'"; }
        echo "<option value='0'$ck1>"._NE_NO."</option>\n<option value='1'$ck2>"._NE_YES."</option>\n</select><br />\n("._NE_NOTIFYAUTHNOTE.")</td>\n</tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>"._NE_HOMETOPIC.":</strong></td>\n<td><select name='xhometopic'>";
        echo "<option value='0'";
        if ($ne_config["hometopic"] == 0) { echo " selected='selected'"; }
        echo ">"._NE_ALLTOPICS."</option>\n";
        $result = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
        while(list($topicid, $topicname) = $db->sql_fetchrow($result)) {
            echo "<option value='$topicid'";
            if ($ne_config["hometopic"] == $topicid) { echo " selected='selected'"; }
            echo">$topicname</option>\n";
        }
        $db->sql_freeresult($result);
        echo "</select></td>\n</tr>\n";
        echo "<tr>\n<td align='right' bgcolor='".$ThemeInfo['bgcolor2']."' valign='top'><strong>"._NE_HOMENUMBER.":</strong></td>\n<td><select name='xhomenumber'>\n";
        echo "<option value='0'";
        if ($ne_config["homenumber"] == 0) { echo " selected='selected'"; }
        echo ">"._NE_NUKEDEFAULT."</option>\n";
        $i = 1;
        while ($i <= 50) {
            $k = $i;
            echo "<option value='$k'";
            if ($ne_config["homenumber"] == $k) { echo " selected='selected'"; }
            echo">$k "._NE_ARTICLES."</option>\n";
            if($i <= 9)
            {
              $i++;
            } else
            {
              $i = $i + 5;
            }
        }
        echo "</select><br />\n("._NE_HOMENUMNOTE.")</td>\n</tr>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._NE_SAVECHANGES."' /></td></tr>";
        echo "</table>\n</center>\n</form>\n";
        CloseTable();
        NEAdminFooter();
    }

    $cat = $_GETVAR->get('cat', '_REQUEST', 'int');

    switch($op) {
        case 'EditCategory':
            EditCategory();
            break;
        case 'subdelete':
            subdelete();
            break;
        case 'DelCategory':
            DelCategory();
            break;
        case 'YesDelCategory':
            YesDelCategory();
            break;
        case 'NoMoveCategory':
            NoMoveCategory();
            break;
        case 'SaveEditCategory':
            SaveEditCategory();
            break;
        case 'SelectCategory':
            SelectCategory($cat);
            break;
        case 'AddCategory':
            AddCategory();
            break;
        case 'SaveCategory':
            SaveCategory();
            break;
        case 'DisplayStory':
            displayStory();
            break;
        case 'PreviewAgain':
            previewStory();
            break;
        case 'PostStory':
            postStory();
            break;
        case 'EditStory':
            editStory();
            break;
        case 'RemoveStory':
            removeStory();
            break;
        case 'ChangeStory':
            changeStory();
            break;
        case 'DeleteStory':
            deleteStory();
            break;
        case 'adminStory':
            adminStory();
            break;
        case 'PreviewAdminStory':
            previewAdminStory();
            break;
        case 'PostAdminStory':
            postAdminStory();
            break;
        case 'autoDelete':
            autodelete();
            break;
        case 'autoEdit':
            autoEdit();
            break;
        case 'autoSaveEdit':
            autoSaveEdit();
            break;
        case 'submissions':
            submissions();
            break;
        case 'NENewsConfig':
            NEConfig();
            break;
        case 'NENewsConfigSave':
            global $_GETVAR;
            ne_save_config('columns', $_GETVAR->get('xcolumns', '_POST', 'int'));
            ne_save_config('readmore', $_GETVAR->get('xreadmore', '_POST', 'int'));
            ne_save_config('texttype', $_GETVAR->get('xtexttype', '_POST', 'int'));
            ne_save_config('notifyauth', $_GETVAR->get('xnotifyauth', '_POST', 'int'));
            ne_save_config('homenumber', $_GETVAR->get('xhomenumber', '_POST', 'int'));
            ne_save_config('hometopic', $_GETVAR->get('xhometopic', '_POST', 'int'));
            ne_save_config('rotator_width', $_GETVAR->get('xrotator_width', '_POST', 'int'));
            ne_save_config('rotator_height', $_GETVAR->get('xrotator_height', '_POST', 'int'));
            ne_save_config('rotator_speed', $_GETVAR->get('xrotator_speed', '_POST', 'int'));
            $cache->delete('news', 'config');
            redirect($admin_file.'.php?op=NENewsConfig');
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>