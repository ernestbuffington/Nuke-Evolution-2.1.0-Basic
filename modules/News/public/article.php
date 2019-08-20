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


$sid    =   $_GETVAR->get('sid', '_REQUEST', 'int', 0);
$tid    =   $_GETVAR->get('tid', '_REQUEST', 'int', 0);

if (($sid == 0) && ($tid == 0)) {
    redirect('modules.php?name='.$module_name);
}

$artinfo = ModuleNews_GetDBRow('`sid`="'.$sid.'" AND time <= "'.$actualtime.'"', $display);
if (isset($artinfo['time']) && $artinfo['time'] <= $actualtime ) {

    $morelink   = '';
    $rate       = '';
    $sum        = 0;
    $update     = '';
    if (empty($artinfo['aid'])) {
        $update = ' ,`aid`=`"'.$new_admin['aid'].'"';
    }
    $db->sql_uquery('UPDATE `'._STORIES_TABLE.'` SET `counter`=`counter`+1 '.$update.' WHERE `sid`="'.$sid.'"');
    $artpage    = 1;
    $pagetitle  = '-&nbsp;'.$artinfo['title'];
    $artpage    = 0;
    include_once(NUKE_BASE_DIR.'header.php');
    echo "<table width='100%' border='0'>\n<tr valign='top'>\n<td>\n";
    if (function_exists('themearticle')) {
        themearticle($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['row_text'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
    } else {
        themeindex($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['row_text'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
    }
    echo "<br />";
    if (!$artinfo['acomm']) {
        include_once(NUKE_MODULES_DIR . $module_name . '/public/comments.php');
        ModuleNewsCommentDisplayTopic($artinfo['sid'], 0);
    }
    echo "</td><td valign='top'><div id='columnB_3columns_no_right'>\n";
    include_once(NUKE_MODULES_DIR. $module_name .'/public/associates.php');
    include_once(NUKE_MODULES_DIR. $module_name .'/public/rate_article.php');
    ModuleNewsRateForm($artinfo);
    include_once(NUKE_MODULES_DIR. $module_name .'/public/article_poll.php');
    ModuleNewsArticlePoll($artinfo);
    echo "</div></td></tr></table>\n";
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' ._SID_FAILURE);
}

?>