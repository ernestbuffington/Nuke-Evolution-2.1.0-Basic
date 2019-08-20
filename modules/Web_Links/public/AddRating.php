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

if (!defined('MODULE_FILE') || !defined('WEBLINK_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

if (!is_user() && !$weblinksconfig['allow_guest_vote']) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['INFO_ONLYREGISTERED']);
}

if (!isset($ratinguser) || $ratinguser != 'outside') {
    $access = $_GETVAR->get('HTTP_REFERER', '_SERVER', 'string'); 
    if (preg_match('#'.EVO_SERVER_URL.'#', $access)) {
        // call is from our own server
        $is_outside = FALSE;
        $ratinguser = $userinfo['username'];
    } else {
        $is_outside = TRUE;
        $ratinguser = 'outside';
        $access     = $url;
    }
} else {
    $is_outside = TRUE;
    $ratinguser = 'outside';
    $access     = $url;
}

if (!is_user() && ($weblinksconfig['securitycheck'] == TRUE) && !security_code_check($gfx_check, 'force')) {
    if ($is_outside) {
        redirect('modules.php?name='.$module_name.'&amp;op=ratelink&amp;ratinguser=outside&amp;lid='.$ratinglid);
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
}

$ratingip = $userinfo['user_ip'];

if ( ($lid == 0) && ($ratinglid == 0) ) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_NO_LID']);
} elseif ( ($lid == 0) && ($ratinglid > 0) ) {
    $lid = $ratinglid;
}

include_once(NUKE_BASE_DIR.'header.php');

LinksHeading();
OpenTable();

$result = $db->sql_query("SELECT `lid`, `cid`  FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='".$lid."'");
$is_in_db = $db->sql_numrows($result);
if ($is_in_db > 0) {
    $passtest = 'yes';
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $backcid = $row['cid'];
    if ( is_user() ) {
        $votecountuser = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinguser`='".$ratinguser."' AND `ratinglid`='".$lid."'");
        if ($votecountuser > 0) {
            $error = 'regflood';
            linkcompletevote($error);
            $passtest = 'no';
        }
        $voteownlink = $db->sql_unumrows("SELECT `name` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='".$lid."' AND `name`='".$ratinguser."'");
        if ($voteownlink > 0) {
            $error = 'postervote';
            linkcompletevote($error);
            $passtest = 'no';
        }
    } else {
        $votecountanon = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid`='".$lid."' AND `ratinguser`='".$ratinguser."' AND `ratinghostname` = '".$ratingip."' AND (".time()." - `ratingtimestamp` < '".$weblinksconfig['anonwaitdays']."')");
        if ($votecountanon > 0) {
            $error = 'anonflood';
            linkcompletevote($error);
            $passtest = 'no';
        }
    }
    if ($rating < 1 || $rating > 10) {
        $error = 'nullerror';
        linkcompletevote($error);
        $passtest = 'no';
    }
    /* Passed Tests */
    if ($passtest == 'yes') {
        $ratingcomments = check_words($ratingcomments);
        $db->sql_query("INSERT INTO `"._WEBLINKS_VOTEDATA_TABLE."` (`ratingdbid`, `ratinglid`, `ratinguser`, `rating`, `ratinghostname`, `ratingcomments`, `ratingtimestamp`)
                              VALUES (NULL,'".$ratinglid."', '".$ratinguser."', '".$rating."', '".$ratingip."', '".$ratingcomments."', '".time()."')");
        include(NUKE_MODULES_DIR.$module_name.'/public/VoteInclude.php');
        $db->sql_uquery("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `linkratingsummary`='".$finalrating."', `totalvotes`='".$totalvotes."', `totalcomments`='".$truecomments."' WHERE `lid` = '".$lid."'");
        $error = 'none';
        linkcompletevote($error);
        echo "<center><span class='content'>". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] ."&nbsp;".EVO_SERVER_SITENAME."&nbsp;". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] ."<br />".$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT']."</span></center><br /><br /><br />";
        if ($is_outside) {
            echo "<center><span class='content'>".$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU']."&nbsp;".EVO_SERVER_SITENAME."&nbsp;". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] ."<br /><a href='".$access."'>".$lang_new[$module_name]['SUBMIT_RETURN']."&nbsp;".$ttitle."</a></span></center><br /><br />";
        } else {
            echo "<center><span class='content'><a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$backcid."'>[".$lang_new[$module_name]['SUBMIT_BACK_CATEGORY']."]</a></span></center>";
        }
    }
} else {
      echo "<center><span class='content'>".$lang_new[$module_name]['ERROR_NO_LID']."</span></center><br /><br />";
      echo "<center><span class='content'>".$lang_new[$module_name]['SUBMIT_GOBACK']."</span></center><br /><br />";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>