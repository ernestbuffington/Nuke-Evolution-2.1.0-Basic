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

$pagemodulname = 'DownloadsUsersList';

DownloadsHeader();

OpenTable();
$perpage = $downloadsconfig['downloads_perpage'];
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$perpage;

$orderfield_array = array('1' => $lang_new[$module_name]['ORDERBY_USERNAME'], '2' => $lang_new[$module_name]['ORDERBY_USERID'], '3' => $lang_new[$module_name]['ORDERBY_LEVEL'], '4' => $lang_new[$module_name]['ORDERBY_ACTIVE'], '5' => $lang_new[$module_name]['ORDERBY_INACTIVE']);
$ordersort_array  = array('1' => $lang_new[$module_name]['ORDERBY_ASC'], '2' => $lang_new[$module_name]['ORDERBY_DESC']);
switch ( $order_field ) {
    case 1:  $sqlorder = ' ORDER BY `username`'; break;
    case 2:  $sqlorder = ' ORDER BY `user_id`'; break;
    case 3:  $sqlorder = ' ORDER BY `user_level`'; break;
    case 4:  $sqlorder = ' AND `dt`.`user_active` = "1" ORDER BY `ut`.`username`'; break;
    case 5:  $sqlorder = ' AND `dt`.`user_active` IS NULL ORDER BY `ut`.`username`'; break;
    default: $sqlorder = ' ORDER BY `username`'; break;
}
$sqlorder .= ($order_sort == 1 ? ' ASC ' : ' DESC ');
if ( $order_field > 3 ) {
    $totalselected = $db->sql_numrows($db->sql_query("SELECT `ut`.`user_id` FROM (`"._USERS_TABLE."` as `ut` LEFT JOIN `"._DOWNLOADS_USERS_TABLE."` as `dt` ON `ut`.`user_id` = `dt`.`user_id`) WHERE `ut`.`user_level` > '0' AND `ut`.`user_active` = '1' AND `ut`.`user_id` <> '".ANONYMOUS."' $sql_order "));

} else {
    $totalselected = $db->sql_numrows($db->sql_query("SELECT `user_id` FROM `"._USERS_TABLE."` WHERE `user_level` > '0' AND `user_active` = '1' AND `user_id` <> '".ANONYMOUS."' "));
}
downloadspagenums_admin($op, $totalselected, $perpage, $max);
if ($totalselected > 0) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_USER_LIST'] . "</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectsortuser\">";
    echo $lang_new[$module_name]['ORDERBY']."&nbsp;&nbsp;";
    echo select_box('order_field', 1, $orderfield_array);
    echo "&nbsp;&nbsp;";
    echo select_box('order_sort', 1, $ordersort_array);
    echo "&nbsp;&nbsp;";
    echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsUserList\" />\n";
    echo "<input type=\"submit\" value=\"" . $lang_new[$module_name]['OK'] . "\" /><br />";
    echo "</form>";
    echo "<table width=\"100%\" border=\"0\">\n";
    if ( $order_field > 3 ) {
        $result11 = $db->sql_query("SELECT `ut`.`user_id`, `ut`.`username` FROM (`"._USERS_TABLE."` as `ut` LEFT JOIN `"._DOWNLOADS_USERS_TABLE."` as `dt` ON `ut`.`user_id` = `dt`.`user_id`) WHERE `ut`.`user_level` > '0' AND `ut`.`user_active` = '1' AND `ut`.`user_id` <> '".ANONYMOUS."' $sqlorder LIMIT $min, $perpage");
    } else {
        $result11 = $db->sql_query("SELECT `user_id`, `username`  FROM `"._USERS_TABLE."` WHERE `user_level` > '0' AND `user_active` = '1' AND `user_id` <> '".ANONYMOUS."' $sqlorder LIMIT $min, $perpage");
    }
    echo "<tr bgcolor='".$ThemeInfo['bgcolor2']."'>\n<td><strong>".$lang_new[$module_name]['ADMIN_USERS']."</strong></td>\n";
    echo "<td align='left'><strong>".$lang_new[$module_name]['ADMIN_USER_FUNCTION']."</strong></td>\n</tr>\n";
    $x = 0;
    while($row11 = $db->sql_fetchrow($result11)) {
        $userexists = $db->sql_fetchrow($db->sql_query("SELECT `user_id`, `user_active` FROM `"._DOWNLOADS_USERS_TABLE."` WHERE `user_id`= '".$row11['user_id']."'"));
        echo "<tr><td colspan='2'>";
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifyuser_$x\"><table width='100%'><tr><td width='50%'>";
        echo "<input type=\"hidden\" name=\"min\" value=\"$min\" />\n";
        echo "<input type='hidden' name='userid' value='".$row11['user_id']."' />\n";
        $username = stripslashes($row11['username']);
        if ($userexists['user_active'] == 1) {
            $active_img = evo_image_make_tag('ok.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], FALSE, '12px', '12px');
        } else {
            $active_img = evo_image_make_tag('bad.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], FALSE, '12px', '12px');
        }
        echo $active_img.'&nbsp;';
        echo $username."</td>\n";
        echo "<td align='left' width='30%'><select name='op'>";
        if ( !empty($userexists)) {
            echo "<option value='DownloadsUserDel'>".$lang_new[$module_name]['DELETE']."</option>\n";
            echo "<option value='DownloadsUserMod' selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
            if ($userexists['user_active'] == 1) {
                echo "<option value='DownloadsUserDeactivate'>".$lang_new[$module_name]['ADMIN_DEACTIVATE_USER']."</option>\n";
            } else {
                echo "<option value='DownloadsUserActivate'>".$lang_new[$module_name]['ADMIN_ACTIVATE_USER']."</option>\n";
            }
        } else {
            echo "<option value='DownloadsUserAdd' selected='selected'>".$lang_new[$module_name]['ADD']."</option>\n";
        }
        echo "</select></td><td align=\"left\" width='20%'><input type=\"submit\" value=\"" . $lang_new[$module_name]['OK'] . "\" /></td></tr></table></form></td></tr>\n";
        $x++;
    }
    $db->sql_freeresult($result11);
    echo "</table><br />";
    downloadspagenums_admin($op, $totalselected, $perpage, $max);
} else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_USER_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>