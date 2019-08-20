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

global $db, $evoconfig, $_GETVAR;
$module_name = basename(dirname(dirname(__FILE__)));
if(is_mod_admin($module_name)) {

    function shownews_home($text) {
       global $wysiwyg_buffer;
       $wysiwyg_buffer = 'hometext,bodytext';
       echo "<br /><br />\n";
       echo Make_TextArea('hometext', $text,'postnews');
       echo "<br />\n";
       return;
    }

    function shownews_body($text) {
       echo "<br /><br />\n";
       echo Make_TextArea('bodytext', $text,'postnews');
       echo "<br />\n";
       return;
    }

    function topicicon($topic_icon) {
        echo "<br /><strong>"._DISPLAY_T_ICON."</strong>&nbsp;&nbsp;";
        echo yesno_option('topic_icon', $topic_icon);
        return;
    }

    function writes($writes) {
        echo "<br /><strong>"._DISPLAY_WRITES."</strong>&nbsp;&nbsp;";
        echo yesno_option('writes', $writes);
        return;
    }

    function poll_index() {
      global $admin_file;
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _POLLADMIN . "</strong></span><br />"
            ."<br />" . _POLLCHOOSE . "<br /><br />"
            ."[ <a href=\"".$admin_file.".php?op=Surveys\">" . _POLLMAIN . "</a> "
            ."| <a href=\"".$admin_file.".php?op=DeletePoll\">" . _DELETEPOLL . "</a> "
            ."| <a href=\"".$admin_file.".php?op=EditPoll\">" . _CHANGEPOLL . "</a> "
            ."| <a href=\"".$admin_file.".php?op=CreatePoll\">" . _ADDPOLL . "</a> "
            ."]</center><br /><br />";
        CloseTable();
        return;
    }

    function poll_options() {
      global $admin_file, $db, $evoconfig;

      // Fetch random poll
      $make_random = intval($evoconfig['poll_random']);
      // Fetch number of days in between voting per user
      $number_of_days = intval($evoconfig['poll_days']);
      // Fetch allow or disallow guests voting
      $allow_guests = intval($evoconfig['poll_guests']);
      echo "<br />";
      OpenTable();
      echo "<center><span class='option'><strong>" . _POLL_OPTIONS . "</strong></span><br />"
          ."<br />" . _POLL_INFO . "<br /><br /></center>"
          ."<form action='".$admin_file.".php' method='post'>"
          ."<table border='0'><tr><td>"
          . _POLLDAYS . ":</td><td><input type='text' name='xnumber_of_days' value='$number_of_days' size='2' maxlength='3' />"
          ."</td></tr>"
          ."<tr><td>"
          . _POLLRANDOM . ":</td><td>";
      echo yesno_option('xmake_random', $make_random);
      echo "</td></tr>"
          ."<tr><td>"
           . _POLLGUESTS . ":</td><td>";
      echo yesno_option('xallow_guests', $allow_guests);
      echo "</td></tr>";
      echo "</table>"
          ."<input type='hidden' name='op' value='PollOptionsSave' /><br />"
          ."<center><input type='submit' value='" . _SAVECHANGES . "' /></center>"
          ."</form>";
      CloseTable();
      return;
    }

    function puthome($ihome, $acomm) {
        echo "<br /><strong>"._PUBLISHINHOME."</strong>&nbsp;&nbsp;";
        if (($ihome == 0) OR (empty($ihome))) {
            $sel1 = "checked";
            $sel2 = "";
        }
        if ($ihome == 1) {
            $sel1 = "";
            $sel2 = "checked";
        }
        echo yesno_option('ihome', $ihome);
        echo "&nbsp;&nbsp;<span class=\"content\">[ "._ONLYIFCATSELECTED." ]</span><br />";

        echo "<br /><strong>"._ACTIVATECOMMENTS."</strong>&nbsp;&nbsp;";
        echo yesno_option('acomm', $acomm);
        echo "<br /><br />";
        return;
    }

    function SelectCategory($cat) {
        global $db, $admin_file;
        $selcat = $db->sql_query("SELECT catid, title FROM "._STORIES_CATEGORIES_TABLE." ORDER BY title");
        $a = 1;
        echo "<strong>"._CATEGORY."</strong> ";
        echo "<select name=\"catid\">";
        if ($cat == 0) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo "<option value=\"0\" $sel>"._ARTICLES."</option>";
        while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
            $catid = intval($catid);
            if ($catid == $cat) {
                $sel = 'selected="selected"';
            } else {
                $sel = '';
            }
            echo "<option value=\"$catid\" $sel>$title</option>";
            $a++;
        }
        echo "</select> [ <a href=\"".$admin_file.".php?op=AddCategory\">"._ADD."</a> | <a href=\"".$admin_file.".php?op=EditCategory\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=DelCategory\">"._DELETE."</a> ]";
        return;
    }

    function poll_createPoll() {
        global $currentlang, $admin, $evoconfig, $db, $admin_file, $ap;
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Surveys\">" . _POLL_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _POLL_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        poll_index();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _CREATEPOLL . "</strong></span></center>"
            ."<br /><form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
            . _POLLTITLE . ":&nbsp;<input type=\"text\" name=\"pollTitle\" size=\"50\" maxlength=\"100\" /><br />";
        if ($evoconfig['multilingual'] == 1) {
            echo "<br />" . _LANGUAGE . ":&nbsp;"
                ."<select name=\"planguage\">";
            $languages = lang_list();
            echo '<option value="'.((empty($language)) ? ' selected="selected"' : '').'">'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($currentlang == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select><br /><br />';
        } else {
            echo "<input type=\"hidden\" name=\"planguage\" value=\"$currentlang\" /><br /><br />";
        }
        echo "<span class=\"content\"><em>" . _POLLEACHFIELD . "</em></span><br />";
        echo "<table border=\"0\">\n";
        for($i = 1; $i <= 12; $i++)    {
            echo "<tr>\n";
            echo "<td>" . _POLLOPTION . "&nbsp;".$i.":</td>\n";
            echo "<td><input type=\"text\" name=\"optionText[$i]\" size=\"50\" maxlength=\"50\" /></td>\n";
            echo "</tr>\n";
        }
        echo "</table>\n"
            ."<br /><span class=\"option\"><em>" . _ANNOUNCEPOLL . "</em><br />"
            ."<input name='ap' type='radio' value='1' onclick=\"javascript:document.getElementById('announcepoll').style.display=''\" />" . _YES . "&nbsp;"
            ."<input name='ap' type='radio' value='0' checked=\"checked\" onclick=\"javascript:document.getElementById('announcepoll').style.display='none'\" />" . _NO . "</span><br /><br />";
        $show_style = ($ap == 0) ? 'display: none;' : '';
        echo "<div id='announcepoll' class='switchcontent' style='".$show_style."'>"
            ."<br /><br /><center><hr size=\"1\" noshade=\"noshade\" /><span class=\"option\"><strong>" . _ANNOUNCEPOLL . "</strong></span><br />"
            ."</center>"
            ."<br /><strong>" . _TITLE . ":</strong><br />"
            ."<input type=\"text\" name=\"title\" size=\"40\" /><br /><br />";
        $cat = 0;
        $ihome = 0;
        $acomm = 0;
        $writes = 0;
        $topic_icon = 1;
        SelectCategory($cat);
        echo '<br />';
        topicicon($topic_icon);
        echo '<br />';
        writes($writes);
        echo "<br />";
        puthome($ihome, $acomm);
        echo "<strong>" . _TOPIC . "</strong>&nbsp;<select name=\"topic\">";
        $toplist = $db->sql_query("SELECT `topicid`, `topictext` FROM `"._TOPICS_TABLE."` ORDER BY `topictext`");
        echo "<option value=\"\">" . _SELECTTOPIC . "</option>\n";
        while ($row = $db->sql_fetchrow($toplist)) {
            $topicid = intval($row['topicid']);
            $topics = $row['topictext'];
            echo "<option value=\"$topicid\">$topics</option>\n";
        }
        echo "</select>";
        echo "<br /><br /><strong>" . _STORYTEXT . "</strong><br />";
        shownews_home($hometext);
        echo "<strong>" . _EXTENDEDTEXT . "</strong><br />";
        shownews_body($bodytext);
        echo "<br /><br /></div>"
            ."<input type=\"hidden\" name=\"op\" value=\"CreatePosted\" />"
            ."<input type=\"submit\" value=\"" . _CREATEPOLLBUT . "\" />"
            ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function poll_createPosted() {
        global $db, $aid, $admin_file, $_GETVAR;
        
        $pollTitle  = $_GETVAR->get('pollTitle', '_POST', 'string');
        $optionText = $_GETVAR->get('optionText', '_POST', 'array');
        $planguage  = $_GETVAR->get('planguage', '_POST', 'string');
        $title      = $_GETVAR->get('title', '_POST', 'string');
        $hometext   = $_GETVAR->get('hometext', '_POST', 'string');
        $topic      = $_GETVAR->get('topic', '_POST', 'int');
        $bodytext   = $_GETVAR->get('bodytext', '_POST', 'string');
        $catid      = $_GETVAR->get('catid', '_POST', 'int');
        $ihome      = $_GETVAR->get('ihome', '_POST', 'int');
        $acomm      = $_GETVAR->get('acomm', '_POST', 'int');
        $topic_icon = $_GETVAR->get('topic_icon', '_POST', 'int');
        $writes     = $_GETVAR->get('writes', '_POST', 'int');
        $SurveyStory = $_GETVAR->get('SurveyStory', '_POST', 'int');
        $timeStamp = time();
        $error = '';
        if (strlen(implode('', $optionText)) < 1) {
            $error .=  _POLL_ERROR_NO_POLL.'<br />';
        }
        $pollTitle = Fix_Quotes($pollTitle);
        if (empty($pollTitle)) {
            $error .= _POLL_ERROR_NO_TITLE.'<br />';
        }
        if (!empty($error)) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Surveys\">" . _POLL_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _POLL_RETURNMAIN . "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center><span class=\"option\">"
                ."<strong>" . $error . "</strong><br />"
                ._GOBACK . "<br />";
            echo "</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
        if(!$db->sql_query("INSERT INTO `"._POLL_DESC_TABLE."` (`pollID`, `pollTitle`, `timeStamp`, `voters`, `planguage`, `artid`) VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$planguage', '0')")) {
            return;
        }
        $object = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM "._POLL_DESC_TABLE." WHERE pollTitle='$pollTitle'"));
        $id = intval($object['pollID']);
        for($i = 1; $i <= 12; $i++) {
            if(!empty($optionText[$i])) {
                $optionText[$i] = Fix_Quotes(addslashes($optionText[$i]));
            }
            if(!$db->sql_query("INSERT INTO `"._POLL_DATA_TABLE."` (`pollID`, `optionText`, `optionCount`, `voteID`) VALUES ('$id', '$optionText[$i]', '0', '$i')")) {
                return;
            }
        }
        if (!empty($title) && !empty($hometext)) {
            $title = Fix_Quotes($title);
            $hometext = Fix_Quotes($hometext);
            $bodytext = Fix_Quotes($bodytext);
            $result = $db->sql_query("INSERT INTO "._STORIES_TABLE." (`sid`, `catid`, `aid`, `title`, `time`, `hometext`, `bodytext`, `comments`, `counter`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `haspoll`, `pollID`, `score`, `ratings`, `associated`, `ticon`, `writes`)
            VALUES (NULL, '$catid', '$aid', '$title', now(), '$hometext', '$bodytext', '0', '0', '$topic', '$aid', '', '$ihome', '$planguage', '$acomm', '0', '0', '0', '0', '', '$topic_icon', '$writes')");
        }
        redirect($admin_file.".php?op=Surveys");
    }

    function poll_removePoll() {
        global $db, $admin_file, $evoconfig;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Surveys\">" . _POLL_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _POLL_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        poll_index();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _REMOVEEXISTING . "</strong></span><br /><br />"
            . _POLLDELWARNING . "</center><br /><br />"
            ."<em>" . _CHOOSEPOLL . "</em><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<input type=\"hidden\" name=\"op\" value=\"RemovePosted\" />";
        $result = $db->sql_query("SELECT `pollID`, `pollTitle`, `timeStamp`, `planguage` FROM `"._POLL_DESC_TABLE."` ORDER BY `timeStamp`");
        if(!$result) {
            return;
        }
        /* cycle through the descriptions until everyone has been fetched */
        echo "<select name=\"id\">";
        while($object = $db->sql_fetchrow($result)) {
        $object['pollID'] = intval($object['pollID']);
            echo "<option value=\"".$object['pollID']."\">".$object['pollTitle'];
            if($evoconfig['multilingual'] == 1 && !empty($object['planguage'])) echo " - (".$object['planguage'].")";
            echo "</option>";
        }
        echo "</select>&nbsp;";
        echo "<input type=\"submit\" value=\"" . _DELETE . "\" />";
        echo "</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function poll_removePosted() {
        global $id, $db, $admin_file;

        $id = intval($id);
        $db->sql_query("DELETE FROM `"._POLL_DESC_TABLE."` WHERE `pollID` = '$id'");
        $db->sql_query("DELETE FROM `"._POLL_DATA_TABLE."` WHERE `pollID` = '$id'");
        redirect($admin_file.".php?op=Surveys");
    }

    function polledit_select() {
        global $db, $admin_file, $evoconfig;
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Surveys\">" . _POLL_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _POLL_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        poll_index();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _EDITPOLL . "</strong></span></center><br /><br />"
        . _CHOOSEPOLLEDIT . "<br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<input type=\"hidden\" name=\"op\" value=\"PollEdit\" />";
        $result = $db->sql_query("SELECT `pollID`, `pollTitle`, `timeStamp`, `planguage` FROM `"._POLL_DESC_TABLE."` ORDER BY `timeStamp`");
        if(!$result) {
            return;
        }
        /* cycle through the descriptions until everyone has been fetched */
        echo "<select name=\"pollID\">";
        while($object = $db->sql_fetchrow($result)) {
        $object['pollID'] = intval($object['pollID']);
            echo "<option value=\"".$object['pollID']."\">".$object['pollTitle'];
            if($evoconfig['multilingual'] == 1) echo " - (".$object['planguage'].")";
            echo "</option>";
        }
        echo "</select>&nbsp;";
        echo "<input type=\"submit\" value=\"" . _EDIT . "\" />";
        echo "</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function polledit() {
        global $db, $evoconfig, $admin_file, $_GETVAR;

        $pollID = $_GETVAR->get('pollID', '_REQUEST', 'int');
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Surveys\">" . _POLL_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _POLL_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        poll_index();
        $row = $db->sql_fetchrow($db->sql_query("SELECT `pollTitle`, `planguage` FROM `"._POLL_DESC_TABLE."` WHERE `pollID` ='$pollID'"));
        $pollTitle = $row['pollTitle'];
        $planguage = $row['planguage'];
        echo "<br />";
        OpenTable();
        echo "<center><strong>"._POLLEDIT." $pollTitle</strong></center>\n";
        echo "<form action=\"".$admin_file.".php\" method=\"post\"\n>";
        echo "<table border=\"0\" align=\"center\">\n<tr>\n<td align=\"right\">";
        echo "<strong>" . _TITLE . ":</strong></td>\n<td colspan=\"2\"><input type=\"text\" name=\"pollTitle\" value=\"$pollTitle\" size=\"40\" maxlength=\"100\" /></td>\n</tr>\n";
        if ($evoconfig['multilingual'] == 1) {
            echo "<tr>\n<td><strong>" . _LANGUAGE . ":</strong></td>\n<td>"
                ."<select name=\"planguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($planguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($planguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select><br /><br />';
            echo "</td>\n</tr>\n";
        } else {
            echo "<input type=\"hidden\" name=\"planguage\" value=\"$planguage\" /><br /><br />\n";
        }
        $result2 = $db->sql_fetchrowset($db->sql_query("SELECT optionText, optionCount, voteID from "._POLL_DATA_TABLE." WHERE pollID='$pollID' ORDER BY voteID"));
        for($i=0;$i<=11;$i++) {
            $optionText     = $result2[$i]['optionText'];
            $optionCount    = intval($result2[$i]['optionCount']);
            $voteID         = intval($result2[$i]['voteID']);
            $r              = $i+1;
            echo "<tr>\n<td align=\"right\"><strong>" . _POLLOPTION . " $voteID:</strong></td>\n<td><input type=\"text\" name=\"optionText[$r]\" value=\"$optionText\" size=\"40\" maxlength=\"50\"></td><td align=\"right\" />$optionCount "._VOTES."</td>\n</tr>\n";
        }
        $db->sql_freeresult($result2);
        echo "</table>\n";
        echo "<center><input type=\"hidden\" name=\"pollID\" value=\"$pollID\">\n";
        echo "<input type=\"hidden\" name=\"op\" value=\"SavePoll\" />"
            ."<strong>" . _CLEARVOTES . "</strong>&nbsp;<input type='radio' name='ClearVotes' value='1' />" . _YES . " &nbsp;"
            ."<input type='radio' name='ClearVotes' value='0' checked=\"checked\" />" . _NO . "<br />"
        ."<br /><input type=\"submit\" value=\"" . _SAVECHANGES . "\" /><br /><br />" . _GOBACK . "</center><br /><br /></form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function savepoll() {
        global $db, $admin_file, $_GETVAR;
        
        $pollID     = $_GETVAR->get('pollID', '_POST', 'int');
        $pollTitle  = $_GETVAR->get('pollTitle', '_POST', 'string');
        $planguage  = $_GETVAR->get('planguage', '_POST', 'string');
        $optionText = $_GETVAR->get('optionText', '_POST', 'array');
        $ClearVotes = $_GETVAR->get('ClearVotes', '_POST', 'int');
        $error = '';
        if (strlen(implode('', $optionText)) < 1) {
            $error .= _POLL_ERROR_NO_POLL.'<br />';
        }
        $pollTitle = Fix_Quotes($pollTitle);
        if (empty($pollTitle)) {
            $error .= _POLL_ERROR_NO_TITLE.'<br />';
        }
        if (!empty($error)) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Surveys\">" . _POLL_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _POLL_RETURNMAIN . "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center><span class=\"option\">"
                ."<strong>" . $error . "</strong><br />"
                ._GOBACK . "<br />";
            echo "</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
        $db->sql_query("UPDATE "._POLL_DESC_TABLE." SET pollTitle='$pollTitle', planguage='$planguage' WHERE pollID='$pollID'");
        for($i=1; $i<=12; $i++) {
            $optionText[$i] = Fix_Quotes(addslashes($optionText[$i]));
            if ( empty($optionText[$i]) ) {
                $optionCount[$i] = 0;
                $db->sql_query("UPDATE `"._POLL_DATA_TABLE."` SET `optionText` = '".$optionText[$i]."', `optionCount` = '".$optionCount[$i]."' WHERE `voteID` = '$i' AND `pollID` = '$pollID'");
            } else {
                $db->sql_query("UPDATE `"._POLL_DATA_TABLE."` SET `optionText` = '".$optionText[$i]."' WHERE `voteID` = '$i' AND `pollID` ='$pollID'");
            }
        }
        if($ClearVotes) {
            $db->sql_query("UPDATE `"._POLL_DATA_TABLE."` SET `optionCount` = '0' WHERE `pollID` = '$pollID'");
        }
        redirect($admin_file.".php?op=Surveys");
    }

    function PollOptionsSave() {
        global $admin_file, $db, $_GETVAR, $cache;
        
        $xmake_random    = $_GETVAR->get('xmake_random', '_POST', 'int');
        $xnumber_of_days = $_GETVAR->get('xnumber_of_days', '_POST', 'int');
        $xallow_guests   = $_GETVAR->get('xallow_guests', '_POST', 'int');
        $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xmake_random."' WHERE evo_field='poll_random'");
        $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xnumber_of_days."' WHERE evo_field='poll_days'");
        $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xallow_guests."' WHERE evo_field='poll_guests'");
        $cache->delete('evoconfig');
        redirect($admin_file.'.php?op=Surveys');
    }

    $op = $_GETVAR->get('op', '_REQUEST', 'string');
    
    switch($op) {

        case 'Surveys';
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Surveys\">" . _POLL_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _POLL_RETURNMAIN . "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            poll_index();
            poll_options();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case 'CreatePoll':
            poll_createPoll();
            break;
        case 'CreatePosted':
            poll_createPosted();
            break;
        case 'DeletePoll':
            poll_removePoll();
            break;
        case 'RemovePosted':
            poll_removePosted();
            break;
        case 'PollEdit':
            polledit();
            break;
        case 'SavePoll':
            savepoll();
            break;
        case 'EditPoll':
            polledit_select();
            break;
        case 'PollOptionsSave':
            PollOptionsSave();
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>