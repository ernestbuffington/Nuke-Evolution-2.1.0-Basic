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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('IN_DOWNLOADS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN DOWNLOADS ADMINISTRATION');
}

global $db, $module_name, $lang_new, $_GETVAR, $downloadsconfig;

$min    = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max    = $_GETVAR->get('max', '_REQUEST', 'int', 0);
$status = $_GETVAR->get('status', '_REQUEST', 'int', 0);
$cid    = $_GETVAR->get('cid', '_REQUEST', 'int', 0);

$status = (($cid == 0) ? 0 : $status);
$statustext = '';

DownloadsHeader();
OpenTable();

$perpage = $downloadsconfig['downloads_perpage'];

if ($max != 0) {
    $max=$min+$perpage;
}

$totalselected  = $db->sql_unumrows("SELECT `cid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."`");
$result11       = $db->sql_query("SELECT `cid`, `title`, `parentid`, `catactive` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` ORDER BY `cid`, `parentid` DESC LIMIT ".$min.", ".$perpage."");

if ($totalselected > 0){
    echo "<span class='option'><strong>".$lang_new[$module_name]['ADMIN_CAT_LIST']."</strong></span>";
    echo "<h3></h3>";
    $x = 0;
    while($row11 = $db->sql_fetchrow($result11)) {
        $statustext = '';
        $cid2       = intval($row11['cid']);
        $ctitle2    = $row11['title'];
        $ctitle     = $row11['title'];
        $parentid   = intval($row11['parentid']);
        $catactive  = intval($row11['catactive']);
        if ($parentid != 0) {
            $ctitle2=DownloadsGetParent($parentid,$ctitle2);
        }
        echo "<form method='post' action='".$admin_file.".php' name='selectmodifycat_".$x."'>";
        echo "<table width='100%' style='border:solid white 1px' ".$over_out." >";
        echo "<tr><td width='18%'></td><td align='left' width='32%'>";
        if ($catactive == 1){
            echo evo_image_make_tag('ok.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], FALSE, '12px', '12px');
        } else {
            echo evo_image_make_tag('bad.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], FALSE, '12px', '12px');
        }
        echo "&nbsp;".$ctitle2;
        if (($cid == $cid2) && ($status > 0)) {
            switch ($status) {
                case 1:  $statustext = $lang_new[$module_name]['MESSAGE_CATEGORY_ADDED']; break;
                case 2:  $statustext = $lang_new[$module_name]['MESSAGE_CATEGORY_MODIFIED']; break;
                default: $statustext = ''; break;
            }
        }
        if (!empty($statustext)) {
            echo "&nbsp;<span style='color:green;font-weight:italic;'>".$statustext."</span>";
        }
        echo "</td><td align='right' width='30%'><select name='op'><option value='DownloadsModCat' selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>";
        if ($catactive == 1) {
            echo "<option value='DownloadsCatDeactivate'>".$lang_new[$module_name]['ADMIN_DEACTIVATE_CAT']."</option>";
        } else {
            echo "<option value='DownloadsCatActivate'>".$lang_new[$module_name]['ADMIN_ACTIVATE_CAT']."</option>";
        }
        echo "<option value='DownloadsDelCat'>".$lang_new[$module_name]['DELETE']."</option></select> ";
        echo "<input type='hidden' name='min' value='".$min."' />";
        echo "<input type='hidden' name='parentid' value='".$parentid."' />";
        echo "<input type='hidden' name='cid' value='".$cid2."' />";
        echo "</td><td align='right'><input type='submit' value='" . $lang_new[$module_name]['OK'] . "' /></td><td width='18%'></td></tr>";
        echo "</table>";
        echo "</form>";
        $x++;
    }
    $db->sql_freeresult($result11);
    echo "<br />";
} else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] ."</center><br /><br />";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>";
}

downloadspagenums_admin($op, $totalselected, $perpage, $max);
echo "<h3></h3>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>