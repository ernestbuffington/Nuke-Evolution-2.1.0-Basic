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

global $_GETVAR;

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

function SubmitNewsHeader() {
    global $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    title(_SUBMITADVICE, $module_name, 'submitnews-logo.png');
}


function defaultDisplay() {
    global $userinfo, $currentlang, $evoconfig, $db, $module_name, $wysiwyg_buffer;
    SubmitNewsHeader();
    OpenTable();
    echo "<form method='post' action='modules.php?name=".$module_name."' name='submitnews'>";
    echo "<table width='100%'><tr>";
    echo "<td width='20%'><strong>"._YOURNAME.":</strong></td><td>";
    if (is_user()) {
        echo UsernameColor($userinfo['username']);
    } else {
        echo _ANONYMOUS ."<span class='content'> [ <a href='modules.php?name=Your_Account&amp;op=new_user'>"._NEWUSER."</a> ]</span>\n";
    }
    echo "</td>\n</tr>\n";
    echo "<tr><td width='20%'><strong>"._SUBTITLE."</strong></td><td>";
    echo "<input type='text' name='subject' size='50' maxlength='80' /><br />("._BEDESCRIPTIVE.")<br />("._BADTITLES.")</td>\n</tr>\n";
    echo "<tr><td width='20%'><strong>"._TOPIC.":</strong></td><td>";
    echo "<select name='topic'>\n";
    $result = $db->sql_query("SELECT topicid, topictext FROM "._TOPICS_TABLE." ORDER BY topictext");
    echo "<option value=''>"._SELECTTOPIC."</option>\n";
    while ($row = $db->sql_fetchrow($result)) {
        $topicid = (int)$row['topicid'];
        $topics = stripslashes(check_html($row['topictext'], "nohtml"));
        echo "<option value='".$topicid."'>".$topics."</option>\n";
    }
    $db->sql_freeresult($result);
    echo "</select>\n";
    echo "</td>\n</tr>\n";
    if ($evoconfig['multilingual']) {
        echo "<tr><td width='20%'><strong>"._LANGUAGE.": </strong></td><td>";
        echo "<select name='alanguage'>\n";
        $languages = lang_list();
        echo '<option value=""'.(($currentlang == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
        for ($i=0, $j = count($languages); $i < $j; $i++) {
            if ($languages[$i] != '') {
                echo '<option value="'.$languages[$i].'"'.(($currentlang == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
            }
        }
        echo '</select>';
        echo "</td>\n</tr>\n";
    } else {
        echo "<input type='hidden' name='alanguage' value='".$currentlang."' />\n";
    }
    echo "<tr><td width='20%'><strong>"._STORYTEXT.":</strong><br />("._HTMLISFINE.")</td><td>";
    $wysiwyg_buffer = 'story,storyext';
    echo Make_TextArea('story','','submitnews');
    echo "</td>\n</tr>\n";
    echo "<tr><td width='20%'><strong>"._EXTENDEDTEXT.":</strong></td><td>";
    echo Make_TextArea('storyext','','submitnews');
    echo "</td>\n</tr>\n";
    echo "</table>\n<br />";
    echo "<center><input type='submit' name='op' value='"._PREVIEW."' />\n";
    echo "<br />("._SUBPREVIEW.")</center></form>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function PreviewStory($username, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype) {
    global $bgcolor1, $bgcolor2, $db, $module_name, $userinfo;
    SubmitNewsHeader();
    $warning = '';
    if (empty($story) && empty($storyext)) {
        $warning = '<div style="font-style: italic; text-align: center;"><blink>'._SN_ERROR_STORY.'</blink></div>';
        DisplayError(_SN_ERROR_STORY . '<br /><br />'. _GOBACK);
    }
    if (empty($subject)) {
        $warning = '<div style="font-style: italic; text-align: center;"><blink>'._SN_ERROR_SUBJECT.'</blink></div>';
        DisplayError(_SN_ERROR_SUBJECT. '<br /><br />'. _GOBACK);
    }
    $subject_preview    = Remove_Slashes(check_words($subject));
    $story_preview      = Remove_Slashes(check_words($story));
    $storyext_preview   = Remove_Slashes(check_words($storyext));
    OpenTable();
    $hometext_bb = set_smilies(decode_bbcode($story_preview, 1, true));
    $bodytext_bb = set_smilies(decode_bbcode($storyext_preview, 1, true));
    $hometext_bb = evo_img_tag_to_resize($hometext_bb);
    $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);
//    themepreview($subject, $hometext_bb, $bodytext_bb);
    Validate($topic, 'int', $module_name, 0, 0, 0, 0, 'topic');
    echo '<div style="font-style: italic; text-align: center;">'._STORYLOOK.'</div><br /><br />';
    if (empty($topic)) {
        $topicimage = 'AllTopics.gif';
        $warning = '<div style="font-style: italic; text-align: center;"><blink>'._SELECTTOPIC.'</blink></div>';
        $topicname = $topicimage = $topictext = '';
    } else {
        $result=$db->sql_query("SELECT `topicname`, `topicimage`, `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='".$topic."'");
        list($topicname, $topicimage, $topictext) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
    }
    $informantwrites = 0;
    if (is_user()) {
        $informant[0] = $userinfo['username'];
        $informant[1] = UsernameColor($userinfo['username']);
        $aid          = $userinfo['username'];
    } else {
        $informant[0] = _ANONYMOUS;
        $informant[1] = UsernameColor(_ANONYMOUS);
        $aid          = _ANONYMOUS;
    }
    $story2 = $hometext_bb .'<br /><br />'.$bodytext_bb;
    themeindex($aid, $informant, formatTimeStamp(time()), $subject_preview, 0, $topic, $story2, '', '', $topicname, $topicimage, $topictext, 1);
    echo $warning;
    echo '<br /><br /><center><span class="tiny">'._CHECKSTORY."</span></center>\n";
    echo '<br /><br /><center><span class="tiny">'._GOBACK.'</span></center>';
    if (empty($warning)) {
        echo "<form name='submitnews' action='modules.php?name=".$module_name."' method='post'>";
        echo '<input type="hidden" name="subject" value="'.htmlspecialchars($subject).'" />';
        echo '<input type="hidden" name="alanguage" value="'.$alanguage.'" />';
        echo '<input type="hidden" name="story" value="'.htmlspecialchars($story).'" />';
        echo '<input type="hidden" name="storyext" value="'.htmlspecialchars($storyext).'" />';
        echo '<input type="hidden" name="topic" value="'.$topic.'" />';
        echo '<input type="hidden" name="username" value="'.$username.'" />';
        echo '<input type="hidden" name="posttype" value="'.$posttype.'" />';
        echo '<input type="hidden" name="address" value="'.$address.'" />';
        echo '<input type="hidden" name="op" value="submitnews" />';
        echo '<center><input type="submit" name="submit" value="'._SUBMIT.'" /></center>';
        echo "</form>\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function submitStory($username, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype) {
    global $userinfo, $EditedMessage, $evoconfig, $db, $cache;
    static $numwaits;
    if (is_user()) {
        $uid = $userinfo['user_id'];
        $username = $userinfo['username'];
    } else {
        $uid = ANONYMOUS;
        $username = _ANONYMOUS;
    }
    if ($evoconfig['textarea'] != 'bbcode' && $evoconfig['textarea'] != 'none') {
        $subject    = check_words(Remove_Slashes($subject));
        $story      = check_words(Remove_Slashes($story));
        $storyext   = check_words(Remove_Slashes($storyext));
    } else {
        $subject    = check_words(Remove_Slashes(html_entity_decode($subject)));
        $story      = check_words(Remove_Slashes(html_entity_decode($story)));
        $storyext   = check_words(Remove_Slashes(html_entity_decode($storyext)));
    }
        $result = $db->sql_query('INSERT INTO '._QUEUE_TABLE.' (`qid`, `uid`, `uname`, `subject`, `story`, `storyext`, `timestamp`, `topic`, `alanguage`) VALUES (NULL, '.$uid.', "'.$username.'", "'.$subject.'", "'.$story.'", "'.$storyext.'", NOW(), "'.$topic.'", "'.$alanguage.'")');
    if(!$result) {
        DisplayError(_SN_ERROR_SAVE. '<br />'. _GOBACK);
    }
    $cache->delete('numwaits', 'submissions');
    $db->sql_freeresult($result);
    if($evoconfig['notify']) {
        $notify_message = $evoconfig['notify_message']."\n\n\n========================================================\n$subject\n\n\n$story\n\n$storyext\n\n$username";
        $return = evo_mail($evoconfig['notify_email'], $evoconfig['notify_subject'], $notify_message);
    }
    SubmitNewsHeader();
    OpenTable();
    if((($numwaits = $cache->load('numwaits', 'submissions')) === false) || empty($numwaits)) {
        $result = $db->sql_query("SELECT COUNT(*) AS numrows FROM "._QUEUE_TABLE);
        $numwaits = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $cache->save('numwaits', 'submissions', $numwaits);
    }
    $numwaits = $numwaits['numrows'];
    echo "<center><div class='nuketitle'>"._SUBSENT."</div>"
    ."<span class='content'><strong>"._THANKSSUB."</strong></span><br /><br />"
    ._SUBTEXT
    ."<br />"._WEHAVESUB." $numwaits "._WAITING."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$op         = $_GETVAR->get('op', '_REQUEST', 'string');
$submit     = $_GETVAR->get('submit', '_POST', 'string');
$alanguage  = $_GETVAR->get('alanguage', '_POST', 'string', '');
$address    = $_GETVAR->get('address', '_POST', 'string', '');

$username   = $_GETVAR->get('username', '_POST', 'string');
$subject    = $_GETVAR->get('subject', '_POST', 'string');
$story      = $_GETVAR->get('story', '_POST', 'string');
$storyext   = $_GETVAR->get('storyext', '_POST', 'string');
$topic      = $_GETVAR->get('topic', '_POST', 'string');
$posttype   = $_GETVAR->get('posttype', '_POST', 'string');

switch($op) {

    case _PREVIEW:
        PreviewStory($username, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype);
    break;

    case 'submitnews':
        if (!empty($submit)) {
            SubmitStory($username, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype);
        } else {
            die('Nice try ...');
        }
    break;

    default:
        defaultDisplay();
    break;

}

?>