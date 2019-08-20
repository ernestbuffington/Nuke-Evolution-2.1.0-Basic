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

include_once(NUKE_BASE_DIR.'header.php');
ReviewHeading();
OpenTable();

$ridrow = $db->sql_ufetchrow("SELECT `rid`, `hits`, `reviewratingsummary`, `totalcomments`, `totalvotes`  FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='".$rid."'");
if ($ridrow['rid'] == $rid) {
    reviewshowsingle($rid);
    CloseTable();
    OpenTable();
    if (isset($ttitle) && !empty($ttitle)) {
        $ttitle = stripslashes($ttitle);
        $transfertitle = preg_replace ('#_#', ' ', $ttitle);
    } else {
        $transfertitle = '';
    }
    $displaytitle = $transfertitle;
    echo "<center><span class='option'><strong>".$lang_new[$module_name]['REVIEW_PROFILE'].":&nbsp;".$displaytitle."</strong></span>\n";
    echo reviewinfomenu($rid, $ttitle);
    $votesDB  = $db->sql_query("SELECT `rating`, `ratinguser` FROM `"._REVIEWS_VOTEDATA_TABLE."` WHERE `ratingrid` = '".$rid."'");
    $totalvotesDB = $db->sql_numrows($votesDB);
    $outsidevotes   = 0;
    $anonvotes      = 0;
    $regvotes       = 0;
    $outsiderating  = 0;
    $anonrating     = 0;
    $regrating      = 0;
    $totalvotes     = 0;
    $maxheight      = 100; // maximum height of bar in pixel
    $vbar           = evo_image('voting_bar.png', $module_name);
    $vbar_r         = evo_image('voting_roof.png', $module_name);
    $vbar_b         = evo_image('voting_base.png', $module_name);
    $rounding       = $reviewsconfig['detailvotedecimal'];
    $dvo = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0);
    $dva = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0);
    $dvr = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0);
    $ddo = array('maxV' => 0, 'minV' => 0, 'totV' => 0, 'totVS' => 0, 'avg' => 0);
    $dda = array('maxV' => 0, 'minV' => 0, 'totV' => 0, 'totVS' => 0, 'avg' => 0);
    $ddr = array('maxV' => 0, 'minV' => 0, 'totV' => 0, 'totVS' => 0, 'avg' => 0);
    if ($totalvotesDB > 0) {
        while($vrow = $db->sql_fetchrow($votesDB)) {
            $ratingDB       = intval($vrow['rating']);
            $ratinguserDB   = $vrow['ratinguser'];
            switch ($ratinguserDB) {
                case 'outside':
                    $ddo['totV']++;
                    $ddo['totVS'] += $vrow['rating'];
                    $dvo[$vrow['rating']]++;
                    if ($vrow['rating'] < $ddo['minV']) {
                        $ddo['minV'] = $vrow['rating'];
                    }
                    if ($vrow['rating'] > $ddo['maxV']) {
                        $ddo['maxV'] = $vrow['rating'];
                    }
                    $totalvotes++;
                    break;
                case ANONYMOUS:
                    $dda['totV']++;
                    $dda['totVS'] += $vrow['rating'];
                    $dva[$vrow['rating']]++;
                    if ($vrow['rating'] < $dda['minV']) {
                        $dda['minV'] = $vrow['rating'];
                    }
                    if ($vrow['rating'] > $dda['maxV']) {
                        $dda['maxV'] = $vrow['rating'];
                    }
                    $totalvotes++;
                    break;
                default:
                    $ddr['totV']++;
                    $ddr['totVS'] += $vrow['rating'];
                    $dvr[$vrow['rating']]++;
                    if ($vrow['rating'] < $ddr['minV']) {
                        $ddr['minV'] = $vrow['rating'];
                    }
                    if ($vrow['rating'] > $ddr['maxV']) {
                        $ddr['maxV'] = $vrow['rating'];
                    }
                    $totalvotes++;
                    break;
            }
        }
        $db->sql_freeresult($votesDB);
        if ( $ddo['totV'] > 0 ) {
            $ddo['avg'] = round($ddo['totVS'] / $ddo['totV'], $rounding);
        }
        if ( $dda['totV'] > 0 ) {
            $dda['avg'] = round($dda['totVS'] / $dda['totV'], $rounding);
        }
        if ( $ddr['totV'] > 0 ) {
            $ddr['avg'] = round($ddr['totVS'] / $ddr['totV'], $rounding);
        }
        echo "<br /><br /><fieldset style='width:50%'>\n";
        echo "<legend><strong>".$lang_new[$module_name]['RATING_DETAILS']."</strong></legend><br />\n";
        echo $lang_new[$module_name]['VOTES_TOTAL'].":&nbsp;".$totalvotes."<br />\n";
        echo $lang_new[$module_name]['RATING_OVERALL'].":&nbsp;".round($ridrow['reviewratingsummary'], $rounding)."\n";
         if (is_admin()) {
            if ($totalvotes != $ridrow['totalvotes']) {
                echo "There is a difference between Table Votedata and stored value in Reviews for totalvotes";
            }
        }
        echo "<br /></fieldset><br /><br />\n";
        // Output of Registered Votes
        echo "<table align='center' border='0' cellspacing='0' cellpadding='0' width='80%'>\n";
        echo "<tr><td colspan='3' bgcolor='".$bgcolor2."' align='center'><span class='content'><strong>".$lang_new[$module_name]['USER_REGISTERED']."</strong></span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor1."'><span class='content'>".$lang_new[$module_name]['RATING_NUMBERS'].":</span></td><td bgcolor='".$bgcolor1."'><span class='content'>".$ddr['totV']."</span></td>\n";
        echo "<td rowspan='4' width='70%' height='".$maxheight."' bgcolor='".$bgcolor1."'>";
        if ($ddr['totV'] == 0) {
            echo "<center><span class='content'>".$lang_new[$module_name]['VOTES_REGISTERED_NONE']."</span></center>";
        } else {
            echo "<table border='0' cellspacing='0' cellpadding='0' width='100%'>\n";
            echo "<tr><td align='center' colspan='12' bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_BREAKDOWN_VALUES']."</span></td></tr>\n";
            echo "<tr>\n";
            echo "<td bgcolor='".$bgcolor2."' height='".$maxheight."' width='1'></td>\n";
            for ($i=1; $i <= 10; $i++) {
                $pervote = $maxheight / $ddr['totV'];
                $barheight = round(($dvr[$i]*$pervote),0);
                echo "<td bgcolor='".$bgcolor1."' valign='bottom' align='center'>";
                echo "<img src='".$vbar."' width='20' height='".$barheight."' border='0' alt='".$lang_new[$module_name]['VOTES'].":&nbsp;".$i."&nbsp;:(".$barheight."%&nbsp;".$lang_new[$module_name]['VOTES_TOTAL'].")' title='".$lang_new[$module_name]['VOTES'].":&nbsp;".$i."&nbsp;:(".$barheight."%&nbsp;".$lang_new[$module_name]['VOTES_TOTAL'].")' /></td>\n";
            }
            echo "<td bgcolor='".$bgcolor2."' height='".$maxheight."' width='1'></td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td bgcolor='".$bgcolor2."'></td>\n";
            for ($i=1; $i<=10; $i++) {
                echo "<td align='center' bgcolor='".$bgcolor2."'><span class='content'>".$i."</span></td>\n";
            }
            echo "<td bgcolor='".$bgcolor2."' ></td></tr></table>\n";
        }
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW'].":</span></td><td bgcolor='".$bgcolor2."'><span class='content'>".$ddr['avg']."</span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor1."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW_HIGHEST'].":</span></td><td bgcolor='".$bgcolor1."'><span class='content'>".$ddr['maxV']."</span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW_LOWEST'].":</span></td><td bgcolor='".$bgcolor2."'><span class='content'>". $ddr['minV']."</span></td></tr>\n";
        echo "<tr><td colspan='3'></td></tr>\n";
        // Output of Guest Votes
        echo "<tr><td colspan='3'><span class='tiny'><br /><br />".$lang_new[$module_name]['RATING_WEIGHT_NOTE']."&nbsp;".$reviewsconfig['anonweight']."&nbsp;".$lang_new[$module_name]['TO']."&nbsp;1.</span></td></tr>\n";
        echo "<tr><td colspan='3' bgcolor='".$bgcolor2."' align='center'><span class='content'><strong>".$lang_new[$module_name]['VOTERS_UNREGISTERED']."</strong></span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor1."'><span class='content'>".$lang_new[$module_name]['RATING_NUMBERS'].":</span></td><td bgcolor='".$bgcolor1."'><span class='content'>".$dda['totV']."</span></td>\n";
        echo "<td rowspan='4' width='70%' height='".$maxheight."' bgcolor='".$bgcolor1."'>";
        if ($dda['totV'] == 0) {
            echo "<center><span class='content'>".$lang_new[$module_name]['VOTES_UNREGISTERED_NONE']."</span></center>";
        } else {
            echo "<table border='0' cellspacing='0' cellpadding='0' width='100%'>\n";
            echo "<tr><td align='center' colspan='12' bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_BREAKDOWN_VALUES']."</span></td></tr>\n";
            echo "<tr>\n";
            echo "<td bgcolor='".$bgcolor2."' height='".$maxheight."' width='1'></td>\n";
            for ($i=1; $i <= 10; $i++) {
                $pervote = $maxheight / $dda['totV'];
                $barheight = round(($dva[$i]*$pervote),0);
                echo "<td bgcolor='".$bgcolor1."' valign='bottom' align='center'>";
                echo "<img src='".$vbar."' width='20' height='".$barheight."' border='0' alt='".$lang_new[$module_name]['VOTES'].":&nbsp;".$i."&nbsp;:(".$barheight."%&nbsp;".$lang_new[$module_name]['VOTES_TOTAL'].")' title='".$lang_new[$module_name]['VOTES'].":&nbsp;".$i."&nbsp;:(".$barheight."%&nbsp;".$lang_new[$module_name]['VOTES_TOTAL'].")' /></td>\n";
            }
            echo "<td bgcolor='".$bgcolor2."' height='".$maxheight."' width='1'></td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td bgcolor='".$bgcolor2."'></td>\n";
            for ($i=1; $i<=10; $i++) {
                echo "<td align='center' bgcolor='".$bgcolor2."'><span class='content'>".$i."</span></td>\n";
            }
            echo "<td bgcolor='".$bgcolor2."' ></td></tr></table>\n";
        }
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW'].":</span></td><td bgcolor='".$bgcolor2."'><span class='content'>".$dda['avg']."</span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor1."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW_HIGHEST'].":</span></td><td bgcolor='".$bgcolor1."'><span class='content'>".$dda['maxV']."</span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW_LOWEST'].":</span></td><td bgcolor='".$bgcolor2."'><span class='content'>". $dda['minV']."</span></td></tr>\n";
        echo "<tr><td colspan='3'></td></tr>\n";
        // Output of  Votes from external sites
        echo "<tr><td colspan='3'><span class='tiny'><br /><br />".$lang_new[$module_name]['RATING_WEIGHT_OUTNOTE']."&nbsp;".$reviewsconfig['outsideweight']."&nbsp;".$lang_new[$module_name]['TO']."&nbsp;1.</span></td></tr>\n";
        echo "<tr><td colspan='3' bgcolor='".$bgcolor2."' align='center'><span class='content'><strong>".$lang_new[$module_name]['VOTERS_OUTSIDE']."</strong></span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor1."'><span class='content'>".$lang_new[$module_name]['RATING_NUMBERS'].":</span></td><td bgcolor='".$bgcolor1."'><span class='content'>".$ddo['totV']."</span></td>\n";
        echo "<td rowspan='4' width='70%' height='".$maxheight."' bgcolor='".$bgcolor1."'>";
        if ($ddo['totV'] == 0) {
            echo "<center><span class='content'>".$lang_new[$module_name]['VOTES_OUTSIDE_NONE']."</span></center>";
        } else {
            echo "<table border='0' cellspacing='0' cellpadding='0' width='100%'>\n";
            echo "<tr><td align='center' colspan='12' bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_BREAKDOWN_VALUES']."</span></td></tr>\n";
            echo "<tr>\n";
            echo "<td bgcolor='".$bgcolor2."' height='".$maxheight."' width='1'></td>\n";
            for ($i=1; $i <= 10; $i++) {
                $pervote = $maxheight / $ddo['totV'];
                $barheight = round(($dvo[$i]*$pervote),0);
                echo "<td bgcolor='".$bgcolor1."' valign='bottom' align='center'>";
                echo "<img src='".$vbar."' width='20' height='".$barheight."' border='0' alt='".$lang_new[$module_name]['VOTES'].":&nbsp;".$i."&nbsp;:(".$barheight."%&nbsp;".$lang_new[$module_name]['VOTES_TOTAL'].")' title='".$lang_new[$module_name]['VOTES'].":&nbsp;".$i."&nbsp;:(".$barheight."%&nbsp;".$lang_new[$module_name]['VOTES_TOTAL'].")' /></td>\n";
            }
            echo "<td bgcolor='".$bgcolor2."' height='".$maxheight."' width='1'></td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td bgcolor='".$bgcolor2."'></td>\n";
            for ($i=1; $i<=10; $i++) {
                echo "<td align='center' bgcolor='".$bgcolor2."'><span class='content'>".$i."</span></td>\n";
            }
            echo "<td bgcolor='".$bgcolor2."' ></td></tr></table>\n";
        }
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW'].":</span></td><td bgcolor='".$bgcolor2."'><span class='content'>".$ddo['avg']."</span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor1."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW_HIGHEST'].":</span></td><td bgcolor='".$bgcolor1."'><span class='content'>".$ddo['maxV']."</span></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."'><span class='content'>".$lang_new[$module_name]['RATING_REVIEW_LOWEST'].":</span></td><td bgcolor='".$bgcolor2."'><span class='content'>". $ddo['minV']."</span></td></tr>\n";
        echo "<tr><td colspan='3'></td></tr>\n";
        echo "</table>\n";
    } else {
        echo "<br /><br /><span class='option'><strong>".$lang_new[$module_name]['WARN_DETAILS_NOT_FOUND']."</strong></span>";
        echo "<br />"._GOBACK."<br />\n";
    }
    echo "</center>\n";
} else {
    echo "<center><span class='content'>".$lang_new[$module_name]['ERROR_NO_RID']."</span></center><br /><br />";
    echo "<center><span class='content'>".$lang_new[$module_name]['SUBMIT_GOBACK']."</span></center><br /><br />";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>