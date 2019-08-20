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
$moddid = $_GETVAR->get('modify_did', '_REQUEST', 'int', 0);

$status = (($moddid == 0) ? 0 : $status);
$statustext = '';
$pagemodulname = 'DownloadsList';

DownloadsHeader();

OpenTable();
$perpage = $downloadsconfig['downloads_perpage'];
if ($max != 0) {
    $max=$min+$perpage;
}

$orderfield_array = array('1' => $lang_new[$module_name]['ORDERBY_DOWNLOAD_TITLE'], '2' => $lang_new[$module_name]['ORDERBY_DOWNLOAD_ID'], '3' => $lang_new[$module_name]['ORDERBY_SIZE'], '4' => $lang_new[$module_name]['ORDERBY_ACTIVE'], '5' => $lang_new[$module_name]['ORDERBY_INACTIVE'], '6' => $lang_new[$module_name]['ORDERBY_CATEGORY']);
$ordersort_array  = array('1' => $lang_new[$module_name]['ORDERBY_ASC'], '2' => $lang_new[$module_name]['ORDERBY_DESC']);
switch ( $order_field ) {
    case 1:  $sqlorder = ' ORDER BY `title`'; break;
    case 2:  $sqlorder = ' ORDER BY `did`'; break;
    case 3:  $sqlorder = ' ORDER BY `download_size`'; break;
    case 4:  $sqlorder = ' WHERE `download_active` = "1" ORDER BY `title`'; break;
    case 5:  $sqlorder = ' WHERE `download_active` = "0" ORDER BY `title`'; break;
    case 3:  $sqlorder = ' ORDER BY `cid`, `title`'; break;
    default: $sqlorder = ' ORDER BY `title`'; break;
}
$sqlorder .= ($order_sort == 1 ? ' ASC ' : ' DESC ');


$totalselected = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` $sqlorder");
downloadspagenums_admin($op, $totalselected, $perpage, $max);
if ($totalselected > 0) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_LIST'] . "</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectsortdownload\">";
    echo $lang_new[$module_name]['ORDERBY']."&nbsp;&nbsp;";
    echo select_box('order_field', 1, $orderfield_array);
    echo "&nbsp;&nbsp;";
    echo select_box('order_sort', 1, $ordersort_array);
    echo "&nbsp;&nbsp;";
    echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsModSelect\" />\n";
    echo "<input type=\"submit\" value=\"" . $lang_new[$module_name]['OK'] . "\" /><br />";
    echo "</form>";
    echo "<table width=\"100%\" border=\"0\">\n";
    $result11 = $db->sql_query("SELECT `did`, `cid`, `title`, `date`, `hits`, `download_author`, `download_active` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` $sqlorder LIMIT $min, $perpage");
    echo "<tr bgcolor='".$ThemeInfo['bgcolor2']."'>\n<td width=\"50%\"><strong>".$lang_new[$module_name]['DOWNLOADS']."</strong></td>\n";
    echo "<td width=\"25%\"><strong>".$lang_new[$module_name]['CATEGORY']."</strong></td>\n";
    echo "<td align=\"center\" width=\"25%\"><strong>".$lang_new[$module_name]['ADMIN_DOWNLOAD_FUNCTION']."</strong></td>\n</tr>\n</table>\n";
    $x = 0;
    while($row11 = $db->sql_fetchrow($result11)) {
        $statustext = '';
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifydownload_$x\">\n";
        echo "<table width=\"100%\" border=\"0\">\n";
        echo "<tr><td width=\"50%\">";
        echo "<input type=\"hidden\" name=\"min\" value=\"$min\" />\n";
        $did = intval($row11['did']);
        echo "<input type='hidden' name='did' value='".$did."' />\n";
        $cattitle = $db->sql_fetchrow($db->sql_query("SELECT `title` FROM `". _DOWNLOADS_CATEGORIES_TABLE ."` WHERE cid = '".$row11['cid']."'"));
        $title = stripslashes($row11['title']);
        $hits = intval($row11['hits']);
        $createdate = formatTimestamp($row11['date']);
        if ($row11['download_active'] == 1) {
            $active_img = evo_image_make_tag('ok.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], FALSE, '12px', '12px');
        } else {
            $active_img = evo_image_make_tag('bad.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], FALSE, '12px', '12px');
        }
        echo $active_img."&nbsp;".$title;
        if (($moddid == $did) && ($status > 0)) {
            switch ($status) {
                case 1:  $statustext = $lang_new[$module_name]['MESSAGE_CATEGORY_ADDED']; break;
                case 2:  $statustext = $lang_new[$module_name]['MESSAGE_CATEGORY_MODIFIED']; break;
                default: $statustext = ''; break;
            }
        }
        if (!empty($statustext)) {
            echo "&nbsp;<span style='color:green;font-weight:italic;'>".$statustext."</span>";
        }
        echo "</td>\n<td width=\"25%\">".$cattitle['title']."</td>\n";
        echo "<td align=\"center\" width=\"25%\"><select name='op'><option value='DownloadsModDownload' selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
        if ($row11['download_active'] == 1) {
            echo "<option value='DownloadsDeactivate'>".$lang_new[$module_name]['ADMIN_DEACTIVATE_DOWNLOAD']."</option>\n";
        } else {
            echo "<option value='DownloadsActivate'>".$lang_new[$module_name]['ADMIN_ACTIVATE_DOWNLOAD']."</option>\n";
        }
        echo "<option value='DownloadsDelete'>".$lang_new[$module_name]['DELETE']."</option></select> ";
        echo "<input type=\"submit\" value=\"" . $lang_new[$module_name]['OK'] . "\" /></td></tr>\n";
        echo "</table>\n";
        echo "</form>\n";
        $x++;
    }
    $db->sql_freeresult($result11);
    echo "<br />";
    downloadspagenums_admin($op, $totalselected, $perpage, $max);
} else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_DOWNLOAD_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>