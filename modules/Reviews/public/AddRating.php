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

if (!defined('MODULE_FILE') || !defined('REVIEW_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

if (!is_user() && !$reviewsconfig['allow_guest_vote']) {
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

if (!is_user() && ($reviewsconfig['securitycheck'] == TRUE) && !security_code_check($gfx_check, 'force')) {
    if ($is_outside) {
        redirect('modules.php?name='.$module_name.'&amp;op=ratereview&amp;ratinguser=outside&amp;&url='.$access.'&amp;rid='.$ratingrid);
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
}

$ratingip = $userinfo['user_ip'];

if ( ($rid == 0) && ($ratingrid == 0) ) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_NO_RID']);
} elseif ( ($rid == 0) && ($ratingrid > 0) ) {
    $rid = $ratingrid;
}

include_once(NUKE_BASE_DIR.'header.php');

ReviewHeading();
OpenTable();

$result = $db->sql_query("SELECT `rid`, `cid`  FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='".$rid."'");
$is_in_db = $db->sql_numrows($result);
if ($is_in_db > 0) {
    $passtest = 'yes';
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $backcid = $row['cid'];
    if ( is_user() ) {
        $votecountuser = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._REVIEWS_VOTEDATA_TABLE."` WHERE `ratinguser`='".$ratinguser."' AND `ratingrid`='".$rid."'");
        if ($votecountuser > 0) {
            $error = 'regflood';
            reviewcompletevote($error);
            $passtest = 'no';
        }
        $voteownreview = $db->sql_unumrows("SELECT `name` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='".$rid."' AND `name`='".$ratinguser."'");
        if ($voteownreview > 0) {
            $error = 'postervote';
            reviewcompletevote($error);
            $passtest = 'no';
        }
    } else {
        $votecountanon = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._REVIEWS_VOTEDATA_TABLE."` WHERE `ratingrid`='".$rid."' AND `ratinguser`='".$ratinguser."' AND `ratinghostname` = '".$ratingip."' AND (".time()." - `ratingtimestamp` < '".$reviewsconfig['anonwaitdays']."')");
        if ($votecountanon > 0) {
            $error = 'anonflood';
            reviewcompletevote($error);
            $passtest = 'no';
        }
    }
    if ($rating < 1 || $rating > 10) {
        $error = 'nullerror';
        reviewcompletevote($error);
        $passtest = 'no';
    }
    /* Passed Tests */
    if ($passtest == 'yes') {
        $ratingcomments = check_words($ratingcomments);
        $db->sql_query("INSERT INTO `"._REVIEWS_VOTEDATA_TABLE."` (`ratingdbid`, `ratingrid`, `ratinguser`, `rating`, `ratinghostname`, `ratingcomments`, `ratingtimestamp`)
                              VALUES (NULL,'".$ratingrid."', '".$ratinguser."', '".$rating."', '".$ratingip."', '".$ratingcomments."', '".time()."')");
        include(NUKE_MODULES_DIR.$module_name.'/public/VoteInclude.php');
        $db->sql_uquery("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `reviewratingsummary`='".$finalrating."', `totalvotes`='".$totalvotes."', `totalcomments`='".$truecomments."' WHERE `rid` = '".$rid."'");
        $error = 'none';
        reviewcompletevote($error);
        echo "<center><span class='content'>". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] ."&nbsp;".EVO_SERVER_SITENAME."&nbsp;". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] ."<br />".$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT']."</span></center><br /><br /><br />";
        if ($is_outside) {
            echo "<center><span class='content'>".$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU']."&nbsp;".EVO_SERVER_SITENAME."&nbsp;". $lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] ."<br /><a href='".$access."'>".$lang_new[$module_name]['SUBMIT_RETURN']."&nbsp;".$ttitle."</a></span></center><br /><br />";
        } else {
            echo "<center><span class='content'><a href='modules.php?name=".$module_name."&amp;op=viewreview&amp;cid=".$backcid."'>[".$lang_new[$module_name]['SUBMIT_BACK_CATEGORY']."]</a></span></center>";
        }
    }
} else {
      echo "<center><span class='content'>".$lang_new[$module_name]['ERROR_NO_RID']."</span></center><br /><br />";
      echo "<center><span class='content'>".$lang_new[$module_name]['SUBMIT_GOBACK']."</span></center><br /><br />";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>