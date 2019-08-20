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

function ModuleNewsArticlePoll($artinfo) {
    global $module_name, $db, $display, $evoconfig;

    if ($artinfo['haspoll']) {
        $row3 = $db->sql_ufetchrow('SELECT `pollTitle`, `voters` FROM `'._POLL_DESC_TABLE.'` WHERE `pollID`="'.($artinfo['pollID']).'"');
        if (isset($row3['pollTitle'])) {
            $sum        = 0;
            $url        = 'modules.php?name=Surveys&amp;op=results&amp;pollID='.$artinfo['pollID'];
            $boxTitle   = _ARTICLEPOLL;
            $boxContent = "<div style='text-align:left; width:100%;'>\n";
            $boxContent .= "<form action='modules.php?name=Surveys' method='post'>\n";
            $boxContent .= "<input type='hidden' name='pollID' value='".$artinfo['pollID']."' />\n";
            $boxContent .= "<input type='hidden' name='forwarder' value='".$url."' />\n";
            $boxContent .= "<span class='content' style='font-weight:bold;'>".EvoKernel_HtmlEntities(check_html($row3['pollTitle'], 'nohtml'))."&nbsp;(".$row3['voters'].")</span><br /><br />\n";
            $boxContent .= "<table border='0' width='100%'>\n";
            for ($i=1; $i <= 12; $i++) {
                $row4 = $db->sql_ufetchrow('SELECT `pollID`, `optionText`, `optionCount`, `voteID` FROM `'._POLL_DATA_TABLE.'` WHERE (`pollID`="'.($artinfo['pollID']).'") AND (`voteID`="'.$i.'")');
                if (isset($row4['optionText']) && !empty($row4['optionText'])) {
                    $sum = $sum + $row4['optionCount'];
                    $boxContent .= "<tr>\n<td valign='top'><input type='radio' name='voteID' value='".$i."' /></td>\n";
                    $boxContent .= "<td width='100%'><span class='content'>".EvoKernel_HtmlEntities(check_html($row4['optionText'], 'nohtml'))."</span></td>\n</tr>\n";
                }
            }
            $boxContent .= "</table>\n";
            $boxContent .= "<br /><br /><div style='text-align:center;'><span class='content'><input type='submit' value='"._VOTE."' /></span><br /><br />\n";
            $boxContent .= "<span class='content' style='font-weight:bold;'><a href='modules.php?name=Surveys&amp;op=results&amp;pollID=".($artinfo['pollID']).$display."'>"._RESULTS."</a><br /><a href='modules.php?name=Surveys'>"._POLLS."</a></span></div>\n";
            $boxContent .= "</form></div><br />\n";
            themesidebox($boxTitle, $boxContent, 'poll1');
            return;
        } else {
            $db->sql_uquery("UPDATE `"._STORIES_TABLE."` SET `haspoll`=0, `pollID`=0 WHERE `sid`='".$artinfo['sid']."'");
        }
    }
    return;
}

?>
