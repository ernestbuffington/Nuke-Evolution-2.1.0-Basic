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

if(!defined('NUKE_EVO')) exit;

if(is_active('Surveys')) {
    global $db, $content, $userinfo, $currentlang, $evoconfig;

    // Fetch random poll
    $make_random = intval($evoconfig['poll_random']);

    // Fetch number of days in between voting per user
    $number_of_days = intval($evoconfig['poll_days']);

    $querylang = ($evoconfig['multilingual'] == 1) ? "WHERE (planguage='$currentlang' OR planguage='') AND artid='0'" : "WHERE artid='0'";
    $result = (!isset($pollID)) ? $db->sql_query("SELECT pollID, pollTitle, voters FROM "._POLL_DESC_TABLE." $querylang ORDER BY rand() LIMIT 1") : $db->sql_query("SELECT pollID, pollTitle, voters FROM "._POLL_DESC_TABLE." WHERE pollID='$pollID'");
    $counted_rows = $db->sql_numrows($result);
    if ($counted_rows < 1) {
        $content = "<br />"._NOSURVEYS."<br /><br />";
        $db->sql_freeresult($result);
    } else {
        list($pollID, $pollTitle, $voters) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $pollTitle = stripslashes($pollTitle);
        $url = 'modules.php?name=Surveys&amp;op=results&amp;pollID='.$pollID;
        $sum = '';
        $button = '';
        $content = '<span class="content"><strong>'.$pollTitle.'</strong></span><br /><br />';
        $content .= '<form action="modules.php?name=Surveys" method="post">';
        $content .= '<table border="0" cellpadding="2" cellspacing="0" width="100%">';
        $ip = identify::get_ip();
        $past = time()-86400*$number_of_days;
        $result = $db->sql_query("SELECT `ip` FROM `"._POLL_CHECK_TABLE."` WHERE `ip`='$ip' AND `pollID`='$pollID'");
        $result2 = $db->sql_query("SELECT `optionText`, `voteID`, `optionCount` FROM `"._POLL_DATA_TABLE."` WHERE `pollID`='$pollID' AND `optionText`!='' ORDER BY `voteID`");
        if ($db->sql_numrows($result) > 0) {
            while ($row = $db->sql_fetchrow($result2)) {
                $options[] = $row;
                $sum += (int)$row['optionCount'];
            }
            $leftbar   = evo_image('leftbar.png', 'Surveys');
            $rightbar  = evo_image('rightbar.png', 'Surveys');
            $mainbar   = evo_image('mainbar.png', 'Surveys');
            $mainbar_d = evo_image('mainbar.png', 'Surveys');
            $l_size    = @getimagesize(evo_image_dir('leftbar.png', 'Surveys'));
            $m_size    = @getimagesize(evo_image_dir('mainbar.png', 'Surveys'));
            $r_size    = @getimagesize(evo_image_dir('rightbar.png', 'Surveys'));
            if (isset($mainbar_d)) {
                $m1_size = @getimagesize(evo_image_dir('mainbar.png', 'Surveys'));
            }
            foreach ($options as $option) {
                $percent = @(100 / $sum * $option['optionCount']);
                $percentInt = (int)$percent * .85;
                $percent2 = (int)$percent;
                $content .= "<tr><td>". $option['optionText'] ."<br />";
                $content .= "<img src=\"$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" />";
                if ($percent > 0) {
                        $content .= "<img src=\"$mainbar\" height=\"$m_size[1]\" width=\"$percentInt%\" alt=\"$percent2 %\" title=\"$percent2 %\" />";
                } else {
                    if (!isset($mainbar_d)) {
                        $content .= "<img src=\"$mainbar_d\" height=\"$m_size[1]\" width=\"$m_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" />";
                    }
                }
                $content .= "<img src=\"$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" /><br />";
                $content .= "</td></tr>\n";
            }
            $button = '';
        }
        else {
            while ($row = $db->sql_fetchrow($result2)) {
                $content .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$row['voteID']."\" /></td><td align=\"left\" width=\"100%\"><span class=\"content\">".$row['optionText']."</span></td></tr>\n";
                $sum += (int)$row['optionCount'];
            }
            $button .= '<input type="hidden" name="pollID" value="'.$pollID.'" />';
            $button .= '<input type="hidden" name="forwarder" value="'.$url.'" />';
            $button .= '<input type="submit" value="'.$lang_block['BLOCK_SURVEYS_VOTE'].'" /><br /><br />';
        }
        $db->sql_freeresult($result);
        $db->sql_freeresult($result2);

        $content .= "</table><br /><center>$button
        <span class=\"content\"><a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=".$userinfo['umode']."&amp;order=".$userinfo['uorder']."&amp;thold=".$userinfo['thold']."\"><strong>".$lang_block['BLOCK_SURVEYS_RESULTS']."</strong></a><br />
        <a href=\"modules.php?name=Surveys\"><strong>".$lang_block['BLOCK_SURVEYS_POLLS']."</strong></a><br />
        <br />".$lang_block['BLOCK_SURVEYS_VOTES'].": <strong>$sum</strong>\n";
        if ($evoconfig['pollcomm']) {
            list($numcom) = $db->sql_ufetchrow("SELECT COUNT(tid) FROM "._POLL_COMMENTS_TABLE." WHERE pollID='".$pollID."'");
            $content .= "<br />".$lang_block['BLOCK_SURVEYS_COMMENTS'].": <strong>$numcom</strong>\n";
        }
        $content .= "</span></center></form>\n";
    }

}

?>