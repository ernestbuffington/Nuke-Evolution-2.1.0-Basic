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

if ($reviewsconfig['allow_guest_vote'] != 1 && !is_user() ) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['INFO_ONLYREGISTERED']);
}

include_once(NUKE_BASE_DIR.'header.php');

ReviewHeading();
OpenTable();

$numrows = $db->sql_unumrows("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='".$rid."'");
if ($numrows == 1) {
    $passtest   = 'yes';
    if (isset($ratinguser) && $ratinguser == 'outside') {
        $ratinguser = 'outside';
        $url = $_GETVAR->get('HTTP_REFERER', '_SERVER', 'string');
    } else {
        $ratinguser = $userinfo['username'];
    }
    $ratingip   = $userinfo['user_ip'];
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
    if ($passtest == 'yes') {
        reviewshowsingle($rid);
        CloseTable();
        OpenTable();
        echo "<center><strong>".$lang_new[$module_name]['RATING']." + ".$lang_new[$module_name]['COMMENTS']."</strong></center>\n";
        echo "<ul>\n";
        echo "<li>".$lang_new[$module_name]['INFO_RATING_1']."</li>\n";
        echo "<li>".$lang_new[$module_name]['INFO_RATING_2']."</li>\n";
        echo "<li>".$lang_new[$module_name]['INFO_RATING_3']."</li>\n";
        echo "<li>".$lang_new[$module_name]['INFO_RATING_4']."</li>\n";
        echo "<li>".$lang_new[$module_name]['INFO_RATING_5']."</li>\n";
        if (is_user()) {
            echo "<li>".$lang_new[$module_name]['INFO_REG_LOGGEDIN']."</li>";
            echo "<li>".$lang_new[$module_name]['INFO_RATE_CANDO']."</li>";
        } else {
            echo "<li>".$lang_new[$module_name]['INFO_UNREG_LOGGEDOUT']."</li>";
            echo "<li>".$lang_new[$module_name]['INFO_RATE_CANNOTDO']."</li>";
        }
        echo "</ul>\n";
        echo "<form method='post' action='modules.php?name=".$module_name."' name='ratereview'>\n";
        echo "<br /><hr /><br />\n";
        echo "<table border='0' cellpadding='1' cellspacing='0' width='100%'>\n";
        echo "<tr><td width='100%' align='center' nowrap='nowrap'><span class='content'><strong>".$lang_new[$module_name]['DO_RATE']."</strong></span></td></tr>\n";
        echo "<tr><td width='100%' align='center'><span class='content'><select name='rating'>\n";
        echo "<option>--</option>";
        for ($i=10; $i>=1; $i--) {
            echo "<option>".$i."</option>\n";
        }
        echo "</select></span></td></tr>\n";
        echo "</table>\n";
        echo "<br /><hr /><br />\n";
        if (is_user()) {
            echo "<table border='0' cellpadding='1' cellspacing='0' width='100%'>\n";
            echo "<tr><td>";
            echo "<strong>".$lang_new[$module_name]['COMMENTS'].":</strong></td></tr>\n";
            echo "<tr><td>\n";
            Make_TextArea('ratingcomments',$ratingcomments, 'ratereview', '100%', '150px');
            echo "</td></tr>\n";
            echo "</table>\n";
        } else {
            echo"<input type='hidden' name='ratingcomments' value='' />";
        }
        echo "<br /><table border='0' cellpadding='1' cellspacing='0' width='100%'>\n";
        if ( !is_user() && ($reviewsconfig['securitycheck'] == TRUE)) {
            echo "<tr><td align='center'>".security_code(1,'small', 1)."</td></tr>\n";
        }
        echo "<tr><td align='center'><span class='content'><input type='submit' value='".$lang_new[$module_name]['DO_RATE']."' /></span></td></tr>\n";
        echo "</table>\n";
        echo "<input type='hidden' name='ratingrid' value='".$rid."' />\n";
        echo "<input type='hidden' name='ratinguser' value='".$ratinguser."' />\n";
        echo "<input type='hidden' name='url' value='".$url."' />\n";
        echo "<input type='hidden' name='rid' value='".$rid."' />\n";
        echo "<input type='hidden' name='op' value='AddRating' />\n";
        echo "</form>";
    }
} else {
    echo "<center><span class='option'><em>".$lang_new[$module_name]['ERROR_NO_RID']."</em></span></center><br />\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>