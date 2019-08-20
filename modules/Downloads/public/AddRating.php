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

if (!defined('MODULE_FILE') || !defined('DOWNLOADS_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

if (!is_user() && !$downloadsconfig['allow_guest_vote']) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['INFO_ONLYREGISTERED']);
}

$did                = $_GETVAR->get('did', '_REQUEST', 'int', 0);
$gfx_check          = $_GETVAR->get('gfx_check', '_POST', 'string', '');
$ratingdid          = $_GETVAR->get('ratingdid', '_REQUEST', 'int', 0);
$ratinguser         = $_GETVAR->get('ratinguser', '_REQUEST', 'string', '');
$rating             = $_GETVAR->get('rating', '_REQUEST', 'int', 0);
$ratingcomments     = $_GETVAR->get('ratingcomments', '_REQUEST', 'string', '');

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

if (!is_user() && ($downloadsconfig['securitycheck'] == TRUE) && !security_code_check($gfx_check, 'force')) {
    if ($is_outside) {
        redirect('modules.php?name='.$module_name.'&amp;op=ratedownload&amp;ratinguser=outside&amp;did='.$ratingdid);
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
}

$ratingip = $userinfo['user_ip'];

if ( ($did == 0) && ($ratingdid == 0) ) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_NO_DID']);
} elseif ( ($did == 0) && ($ratingdid > 0) ) {
    $did = $ratingdid;
}

include_once(NUKE_BASE_DIR.'header.php');

DownloadsHeading();
OpenTable();

$result = $db->sql_query("SELECT `did`, `cid`  FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='".$did."'");
$is_in_db = $db->sql_numrows($result);
if ( !DownloadsAllowed($did, $userinfo['user_id'], 'view') && !is_mod_admin($module_name)) {
    $is_in_db = 0;
} else {
    $row      = $db->sql_fetchrow($result);
}
$db->sql_freeresult($result);
if ($is_in_db > 0) {
    $passtest = 'yes';
    $backcid  = $row['cid'];
    if ( is_user() ) {
        $votecountuser = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratinguser`='".$ratinguser."' AND `ratingdid`='".$did."'");
        if ($votecountuser > 0) {
            $error = 'regflood';
            DownloadsCompleteVote($error);
            $passtest = 'no';
        }
        $voteowndownload = $db->sql_unumrows("SELECT `name` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='".$did."' AND `name`='".$ratinguser."'");
        if ($voteowndownload > 0) {
            $error = 'postervote';
            DownloadsCompleteVote($error);
            $passtest = 'no';
        }
    } else {
        $votecountanon = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid`='".$did."' AND `ratinguser`='".$ratinguser."' AND `ratinghostname` = '".$ratingip."' AND (".time()." - `ratingtimestamp` < '".$downloadsconfig['anonwaitdays']."')");
        if ($votecountanon > 0) {
            $error = 'anonflood';
            DownloadsCompleteVote($error);
            $passtest = 'no';
        }
    }
    if ($rating < 1 || $rating > 10) {
        $error = 'nullerror';
        DownloadsCompleteVote($error);
        $passtest = 'no';
    }
    /* Passed Tests */
    if ($passtest == 'yes') {
        $ratingcomments = check_words($ratingcomments);
        $db->sql_uquery("INSERT INTO `"._DOWNLOADS_VOTEDATA_TABLE."` (`ratingdbid`, `ratingdid`, `ratinguser`, `rating`, `ratinghostname`, `ratingcomments`, `ratingtimestamp`)
                              VALUES (NULL,'".$ratingdid."', '".$ratinguser."', '".$rating."', '".$ratingip."', '".$ratingcomments."', '".time()."')");
        include(NUKE_MODULES_DIR.$module_name.'/public/VoteInclude.php');
        $db->sql_uquery("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` SET `downloadratingsummary`='".$finalrating."', `totalvotes`='".$totalvotes."', `totalcomments`='".$truecomments."' WHERE `did` = '".$did."'");
        $error = 'none';
        DownloadsCompleteVote($error);
        echo "<center><span class='content'>". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] ."&nbsp;".EVO_SERVER_SITENAME."&nbsp;". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] ."<br />".$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT']."</span></center><br /><br /><br />";
        if ($is_outside) {
            echo "<center><span class='content'>".$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU']."&nbsp;".EVO_SERVER_SITENAME."&nbsp;". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] ."<br /><a href='".$access."'>".$lang_new[$module_name]['SUBMIT_RETURN']."&nbsp;".$ttitle."</a></span></center><br /><br />";
        } else {
            echo "<center><span class='content'><a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$backcid."'>[".$lang_new[$module_name]['SUBMIT_BACK_CATEGORY']."]</a></span></center>";
        }
    }
} else {
      echo "<center><span class='content'>".$lang_new[$module_name]['ERROR_NO_DID']."</span></center><br /><br />";
      echo "<center><span class='content'>".$lang_new[$module_name]['SUBMIT_GOBACK']."</span></center><br /><br />";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>