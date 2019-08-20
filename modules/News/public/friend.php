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

if (!defined('MODULE_FILE') && !defined('NEWS_INDEX_FILE')) {
   die('You can\'t access this file directly...');
}

function FriendSend($sid) {
    global $userinfo, $db, $module_name, $actualtime;

    if ($sid > 0) {
        include_once(NUKE_BASE_DIR.'header.php');
        ModuleNewsHeading();
        $row = $db->sql_fetchrow($db->sql_query("SELECT `title` FROM `"._STORIES_TABLE."` WHERE sid='".$sid."' AND time <= '".$actualtime."'"));
        $title = EvoKernel_HtmlEntities(check_words(check_html($row['title'], 'nohtml')), ENT_NOQUOTES);
        OpenTable();
        echo "<div style='text-align:center; width:100%;'>"._YOUSENDSTORY.":&nbsp;<div style='font-weight:bold;'>".$title."</div>&nbsp;"._TOAFRIEND."</div><br /><br /><br />\n";
        echo "<form action='modules.php?name=".$module_name."&amp;op=friend' method='post'>\n";
        echo "<input type='hidden' name='sid' value='".$sid."' />\n";
        if (is_user()) {
            echo "<div style='width:100%;'><span style='text-align:left; width:60%;'>"._FYOURNAME."</span><span style='text-align:left; width:40%;'><input type='text' readonly='readonly' name='yname' value='".$userinfo['username']."' size='30' maxlength='50' /></span></div><br />\n";
            echo "<div style='width:100%;'><span style='text-align:left; width:60%;'>"._FYOUREMAIL."</span><span style='text-align:left; width:40%;'><input type='text' readonly='readonly' name='ymail' value='".$userinfo['user_email']."' size='30' maxlength='100' /></span></div><br /><br />\n";
        } else {
            echo "<div style='width:100%;'><span style='text-align:left; width:60%;'>"._FYOURNAME."</span><span style='text-align:left; width:40%;'><input type='text' name='yname' size='30' maxlength='50' /></span></div><br />\n";
            echo "<div style='width:100%;'><span style='text-align:left; width:60%;'>"._FYOUREMAIL."</span><span style='text-align:left; width:40%;'><input type='text' name='ymail' size='30' maxlength='100' /></span></div><br /><br /><br />\n";
        }
        echo "<div style='text-align:left; width:100%;'><span style='text-align:left; width:60%;'>"._FFRIENDNAME." </span><span style='text-align:left; width:40%;'><input type='text' name='fname' size='30' maxlength='50' /></span></div><br />\n";
        echo "<div style='text-align:left; width:100%;'><span style='text-align:left; width:60%;'>"._FFRIENDEMAIL." </span><span style='text-align:left; width:40%;'><input type='text' name='fmail' size='30' maxlength='100' /></span></div><br /><br />\n";
        echo "<input type='hidden' name='mode' value='SendStory' />\n";
        echo "<div style='text-align:center; width:100%;'>\n";
        if (!is_user()) {
            echo security_code(1, 'stacked', 1, $module_name);
        }
        echo "<br /><input type='submit' value='"._SEND."' /></div>\n";
        echo "</form>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' ._SID_FAILURE);
    }
}

function SendStory($sid, $yname, $ymail, $fname, $fmail) {
    global $db, $module_name, $actualtime;

    $fname  = EvoKernel_HtmlEntities(check_words(check_html(stripslashes($fname), 'nohtml')), ENT_NOQUOTES);
    $row    = $db->sql_ufetchrow("SELECT `title`, `time`, `topic` FROM `"._STORIES_TABLE."` WHERE `sid`='".$sid."' AND `time` <= '".$actualtime."'");
    $title  = EvoKernel_HtmlEntities(check_words(check_html($row['title'], 'nohtml')), ENT_NOQUOTES);
    $time   = formatTimestamp($row['time']);
    $topic  = $row['topic'];
    $row2   = $db->sql_ufetchrow("SELECT `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='".$topic."'");
    $topictext  = EvoKernel_HtmlEntities(check_words(check_html($row['title'], 'nohtml')), ENT_NOQUOTES);
    $subject    = _INTERESTING_ARTICLE."&nbsp;".EVO_SERVER_SITENAME;
    $message    = _HELLO."&nbsp;".$fname.":<br /><br />"._YOURFRIEND."&nbsp;".$yname."&nbsp;"._CONSIDERED."<br /><br />".$title."<br />("._FDATE."&nbsp;".$time.")<br />"._FTOPIC."&nbsp;".$topictext."<br /><br />";
    $message   .= _URL.":&nbsp;<a href='".EVO_SERVER_URL."/modules.php?name=".$module_name."&amp;op=article&amp;sid=".$sid."'>".EVO_SERVER_URL."/modules.php?name=".$module_name."&op=article&sid=".$sid."</a><br /><br />";
    $message   .= _YOUCANREAD."&nbsp;".EVO_SERVER_SITENAME."<br /><a href='".EVO_SERVER_URL."'>".EVO_SERVER_URL."</a>";
    $from       = $ymail.','.$yname;
    $to         = $fmail.','.$fname;
    $return     = evo_mail($to, $subject, $message, $from);
    redirect('modules.php?name='.$module_name.'&amp;op=friend&amp;mode=StorySent&amp;title='.$title.'&amp;fname='.$fname);
}

function StorySent($title, $fname) {
    include_once(NUKE_BASE_DIR.'header.php');
    ModuleNewsHeading();
    $title = EvoKernel_HtmlEntities(check_words(check_html(stripslashes($title), 'nohtml')), ENT_NOQUOTES);
    $fname = EvoKernel_HtmlEntities(check_words(check_html(stripslashes($fname), 'nohtml')), ENT_NOQUOTES);
    OpenTable();
    echo "<div class='content' style='text-align:center;'>"._FSTORY."&nbsp;<span style='font-weight:bold;'>".$title."</span>&nbsp;"._HASSENT."&nbsp;".$fname."... <br />"._THANKS."</div>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$sid    =   $_GETVAR->get('sid', '_REQUEST', 'int', 0);
$yname  =   $_GETVAR->get('yname', '_REQUEST', 'string', '');
$ymail  =   $_GETVAR->get('ymail', '_REQUEST', 'string', '');
$fname  =   $_GETVAR->get('fname', '_REQUEST', 'string', '');
$fmail  =   $_GETVAR->get('fmail', '_REQUEST', 'string', '');
$title  =   $_GETVAR->get('title', '_REQUEST', 'string', '');
$mode   =   $_GETVAR->get('mode', '_REQUEST', 'string', '');
$gfx_check = $_GETVAR->get($module_name.'gfx_check', '_POST', 'string', '');

if (!is_user()) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' ._MODULEUSERS);
}
if ($mode == 'StorySent') {
    if (!is_user() && !security_code_check($gfx_check, 'force', $module_name)) {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' ._GFX_FAILURE);
    }
}

switch($mode) {
    case 'SendStory':  SendStory($sid, $yname, $ymail, $fname, $fmail); break;
    case 'StorySent':  StorySent($title, $fname); break;
    case 'FriendSend': FriendSend($sid); break;
}

?>