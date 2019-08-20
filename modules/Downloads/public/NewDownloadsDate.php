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

global $userinfo;

$selectdate = $_GETVAR->get('selectdate', '_REQUEST', 'int', time());
$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
$show       = $_GETVAR->get('show', '_REQUEST', 'int', $downloadsconfig['newdownloads']);
$cid        = $_GETVAR->get('cid', '_REQUEST', 'int', 0);
$sql_order  = $_GETVAR->get('orderby', '_REQUEST', 'string', '');

if ($max == 0) {
    $max =$min+$downloadsconfig['newdownloads'];
}

$orderby = DownloadsConvertOrderByIn($sql_order);

include_once(NUKE_BASE_DIR.'header.php');

$dayend   = $selectdate;
$daystart = $selectdate + 86400;
$dateView = formatTimeStamp($daystart);

$totaldownloads = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `date_validated` < '".$daystart."' AND `date_validated` > '".$dayend."'");

DownloadsHeading();
OpenTable();
echo "<center><span class='option'><strong>".$lang_new[$module_name]['DOWNLOADS_NEW']."(".$totaldownloads."):&nbsp;".$dateView."</strong></span></center><br />";
if ($totaldownloads > 0) {
    echo "<table width='100%' cellspacing='0' cellpadding='10' border='0'><tr><td>\n";
    $result2 = $db->sql_query("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `date_validated` < '".$daystart."' AND `date_validated` > '".$dayend."' ORDER BY `date` DESC LIMIT ".$min.", ". $show);
    while ($row2 = $db->sql_fetchrow($result2)) {
        if ( !DownloadsAllowed($row2['did'], $userinfo['user_id'], 'view') && !is_mod_admin($module_name)) {
            continue;
        } else {
            echo "<fieldset>";
            DownloadShowSingle($row2);
            echo "</fieldset><br />";
        }
    }
    echo "</td></tr></table>\n";
    $db->sql_freeresult($result2);
    // Calculates how many pages exist. Which page one should be on, etc...
    $linkpagesint      = ($totaldownloads / $downloadsconfig['newdownloads']);
    $linkpageremainder = ($totaldownloads % $downloadsconfig['newdownloads']);
    if ($linkpageremainder != 0) {
        $linkpages = ceil($linkpagesint);
        if ($totaldownloads < $downloadsconfig['newdownloads']) {
            $linkpageremainder = 0;
        }
    } else {
        $linkpages = $linkpagesint;
    }

    // Page Numbering
    if ($linkpages!=1 && $linkpages!=0) {
        echo "<center><br /><br />";
        $prev=$min-$downloadsconfig['newdownloads'];
        if ($prev>=0) {
            echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=NewDownloadsDate&amp;selectdate=".$selectdate."&amp;min=".$prev."&amp;show=".$downloadsconfig['newdownloads']."'>";
            echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
        }else{
            echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
        }
        $counter = 1;
        $currentpage = ($max / $downloadsconfig['newdownloads']);
        while ($counter<=$linkpages ) {
            $cpage = $counter;
            $mintemp = ($downloadsconfig['newdownloads'] * $counter) - $downloadsconfig['newdownloads'];
            $next = (($totaldownloads - $mintemp) > $downloadsconfig['newdownloads']) ? $downloadsconfig['newdownloads'] : ($totaldownloads - $mintemp);
            if ($counter == $currentpage) {
                echo "<strong>$counter</strong>&nbsp;";
            } else {
                echo "<a href='modules.php?name=".$module_name."&amp;op=NewDownloadsDate&amp;selectdate=".$selectdate."&amp;min=".$min."temp&amp;show=".$next."'>".$counter."</a>";
            }
            $counter++;
        }
        if ($max < $totaldownloads ) {
            echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=NewDownloadsDate&amp;selectdate=".$selectdate."&amp;min=".$max."&amp;show=".$next."'>";
            echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
        }else{
            echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
        }
        echo "</center>";
    }
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>