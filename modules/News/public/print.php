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

if (!is_user() || $sid == 0) {
    DisplayError('<div style="font-weight:bold;">'._ERROR.'</div><br /><br />'._SID_FAILURE.'<br /><br />'._GOBACK);
}

function PrintPage($sid) {
    global $evoconfig, $db, $module_name, $display;

    $artinfo    = ModuleNews_GetDBRow('`sid`="'.$sid.'"', $display);
    $morelink   = '';
    $datetime   = formatTimeStamp($artinfo['time'], '', 1);
    echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html>
    <head>
    <title>".EVO_SERVER_SITENAME." - ".$artinfo['title']."</title>
    <meta http-equiv='Content-Type' content='text/html; charset="._CHARSET."' />
    </head>
    <body bgcolor='#ffffff' text='#000000'>
    <table border='0' align='center'><tr><td>
    <table border='0' width='640' cellpadding='0' cellspacing='1' bgcolor='#000000'><tr><td>
    <table border='0' width='640' cellpadding='20' cellspacing='1' bgcolor='#ffffff'><tr><td style='text-align:center;'>
    <img src='images/".$evoconfig['site_logo']."' alt='".EVO_SERVER_SITENAME."' title='".EVO_SERVER_SITENAME."' /><br /><br />
    <span class='content' style='font-weight:bold;'>".$artinfo['title']."</span><br />
    <span class='tiny' style='font-weight:bold;'>"._PDATE."&nbsp;". $datetime." <br />"._PTOPIC."&nbsp;".$artinfo['topics']['topicname']."</span><br /><br />
    <span class='content'>".$artinfo['hometext']."<br /><br />".$artinfo['bodytext']."<br /><br />".$artinfo['notes']."<br /><br /></span>
    </td></tr></table></td></tr></table>
    <br /><br /><center>
    <span class='content'>
    "._COMESFROM." ".EVO_SERVER_SITENAME."<br />
    <a href='".EVO_SERVER_URL."'>".EVO_SERVER_URL."</a><br /><br />
    "._THEURL."<br />
    <a href='".EVO_SERVER_URL."/modules.php?name=".$module_name."&amp;op=article&amp;sid=".$sid."'>".EVO_SERVER_URL."/modules.php?name=".$module_name."&amp;op=article&amp;sid=".$sid."</a>
    </span></center>
    </td></tr></table>
    </body>
    </html>";
    exit;
}

PrintPage($sid);

?>