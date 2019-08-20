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

$pagemodulname = 'DownloadsList';

DownloadsHeader();

OpenTable();
$perpage = $downloadsconfig['downloads_perpage'];
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$perpage;

$sort_by  = $_GETVAR->get('ext_sortby', '_REQUEST', 'string', 'ext');
$sort_dir = $_GETVAR->get('ext_sortdir', '_REQUEST', 'string', 'ASC');
$search   = $_GETVAR->get('ext_search', '_REQUEST', 'string', '');


$totalselected = $db->sql_unumrows("SELECT `ext` FROM `"._DOWNLOADS_EXTENSIONS_TABLE."`");
downloadspagenums_admin($op, $totalselected, $perpage, $max);
if ($totalselected > 0) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_EXTENSIONS_LIST'] . "</strong></span></center><br /><br />\n";
    echo "<table width=\"100%\" border=\"0\">\n";
    $result11 = $db->sql_query("SELECT `ext`, `type`, `mimetype`, `description`, `active`, `eid` FROM `"._DOWNLOADS_EXTENSIONS_TABLE."` ORDER BY `".$sort_by."` ASC LIMIT $min, $perpage");
    echo "<tr bgcolor='".$ThemeInfo['bgcolor2']."'>\n<td width='10%' align='center'><strong>".$lang_new[$module_name]['EXTENSIONS']."</strong></td>\n";
    echo "<td width='20%' align='center'><strong>".$lang_new[$module_name]['EXTENSIONS_DESCRIPTION']."</strong></td>\n";
    echo "<td width='20%'><strong>".$lang_new[$module_name]['EXTENSIONS_MIMETYPE']."</strong></td>\n";
    echo "<td width='20%'><strong>".$lang_new[$module_name]['EXTENSIONS_TYPE']."</strong></td>\n";
    echo "<td align='center' colspan='2'><strong>".$lang_new[$module_name]['ADMIN_DOWNLOAD_FUNCTION']."</strong></td>\n</tr><tr><td colspan='6'>\n";
    $x = 0;
    while($row11 = $db->sql_fetchrow($result11)) {
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifyextension_$x\">";
        echo "<input type=\"hidden\" name=\"min\" value=\"$min\" />\n";
        $eid = intval($row11['eid']);
        echo "<input type='hidden' name='eid' value='".$eid."' />\n";
        if ($row11['active'] == 1) {
            $active_img = evo_image_make_tag('ok.png', 'evo', '', 0, '', FALSE, '12px', '12px');
        } else {
            $active_img = evo_image_make_tag('bad.png', 'evo', '', 0, '', FALSE, '12px', '12px');
        }
        echo "<table width='100%' border=\"0\"><tr>";
        echo "<td width='10%' align='left'>".$active_img."&nbsp;".$row11['ext']."</td>\n";
        echo "<td width='20%' align='left'>".$row11['description']."</td>\n";
        echo "<td width='20%' align='center'>".$row11['mimetype']."</td>\n";
        echo "<td width='20%' align='left'><select name='exttype'>";
        for ($i=1; $i<=9; $i++) {
            if ( $row11['type'] == $i ) {
                echo "<option value='$i' selected='selected'>".$lang_new[$module_name]['EXTENSIONS_TYPE'.$i]."</option>\n";
            } else {
                echo "<option value='$i'>".$lang_new[$module_name]['EXTENSIONS_TYPE'.$i]."</option>\n";
            }
            if ($i == 6) { $i = 8; }
        }
        echo "</select></td>";  
        echo "<td width='20%' align='left'><select name='op'><option value='DownloadsExtModify' selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
        if ($row11['active'] == 1) {
            echo "<option value='DownloadsExtDeactivate'>".$lang_new[$module_name]['ADMIN_DEACTIVATE_EXTENSION']."\n";
        } else {
            echo "<option value='DownloadsExtActivate'>".$lang_new[$module_name]['ADMIN_ACTIVATE_EXTENSION']."\n";
        }
        echo "</option>";
        echo "<option value='DownloadsExtDel'>".$lang_new[$module_name]['DELETE']."</option></select> ";
        echo "</td><td width='10%' align=\"left\"><input type=\"submit\" value=\"" . $lang_new[$module_name]['OK'] . "\" /></td></tr>\n";
        echo "</table>";
        echo "</form>\n";
        $x++;
    }
    $db->sql_freeresult($result11);
    echo "</td></tr></table><br />";
    downloadspagenums_admin($op, $totalselected, $perpage, $max);
    echo "<br />";
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_EXTENSIONS_ADD'] . "</strong></span></center><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"addextension\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr bgcolor='".$ThemeInfo['bgcolor2']."'>\n<td><strong>".$lang_new[$module_name]['EXTENSIONS']."</strong></td>\n";
    echo "<td><strong>".$lang_new[$module_name]['EXTENSIONS_DESCRIPTION']."</strong></td>\n";
    echo "<td><strong>".$lang_new[$module_name]['EXTENSIONS_MIMETYPE']."</strong></td>\n";
    echo "<td><strong>".$lang_new[$module_name]['EXTENSIONS_TYPE']."</strong></td>\n";
    echo "<td><strong>".$lang_new[$module_name]['ADMIN_EXTENSIONS_STATUS']."</strong></td></tr>\n";
    echo "<tr>\n<td><input type=\"text\" name=\"add_extension\" size=\"10\" maxlength=\"10\" /></td>\n";
    echo "<td><input type=\"text\" name=\"add_extdescription\" size=\"20\" maxlength=\"100\" /></td>";
    echo "<td><input type=\"text\" name=\"add_extmimetype\" size=\"20\" maxlength=\"50\" /></td>";
    echo "<td align='left'><select name='add_exttype'>";
    for ($i=1; $i<=9; $i++) {
        if ( $i == 1 ) {
            echo "<option value='$i' selected='selected'>".$lang_new[$module_name]['EXTENSIONS_TYPE'.$i]."</option>\n";
        } else {
            echo "<option value='$i'>".$lang_new[$module_name]['EXTENSIONS_TYPE'.$i]."</option>\n";
        }
        if ($i == 6) { $i = 8; }
    }
    echo "</select></td>\n";  
    echo "<td align='left'><select name='add_extactive'>\n";
    echo "<option value='0' selected='selected'>".$lang_new[$module_name]['ADMIN_DEACTIVATE_EXTENSION']."</option>\n";
    echo "<option value='1'>".$lang_new[$module_name]['ADMIN_ACTIVATE_EXTENSION']."</option>\n";
    echo "</select>\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsExtAdd\" />";
    echo "</td></tr>\n</table>\n";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center>\n";
    echo "</form>\n";
} else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_EXTENSION_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>