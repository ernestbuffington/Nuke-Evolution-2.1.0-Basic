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

$pagemodulname = 'DownloadsExtensionModify';

DownloadsHeader();

OpenTable();

$eid = intval($eid);
if (!isset($min)) $min=0;
$row = $db->sql_ufetchrow("SELECT * FROM `"._DOWNLOADS_EXTENSIONS_TABLE."` WHERE `eid`= '$eid'");
if (!empty($row['eid']) ) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['EXTENSIONS'] . "</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"modifyextension\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>".$lang_new[$module_name]['EXTENSIONS']."</td><td>".$row['eid']."</td></tr>\n";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>".$lang_new[$module_name]['EXTENSIONS_NO']."</td><td><input type='text' name='add_extension' size='10' maxlength='10' value='".$row['ext']."'/></td></tr>\n";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>".$lang_new[$module_name]['EXTENSIONS_MIMETYPE']."</td><td><input type='text' name='add_extmimetype' size='50' maxlength='50' value='".$row['mimetype']."'/></td></tr>\n";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>".$lang_new[$module_name]['EXTENSIONS_DESCRIPTION']."</td><td><input type='text' name='add_extdescription' size='75' maxlength='100' value='".$row['description']."'/></td></tr>\n";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>".$lang_new[$module_name]['EXTENSIONS_TYPE']."</td>\n";
    echo "<td><select name='add_exttype'>";
    for ($i=1; $i<=9; $i++) {
        if ( $i == $row['type'] ) {
            echo "<option value='$i' selected='selected'>".$lang_new[$module_name]['EXTENSIONS_TYPE'.$i]."</option>\n";
        } else {
            echo "<option value='$i'>".$lang_new[$module_name]['EXTENSIONS_TYPE'.$i]."</option>\n";
        }
        if ($i == 6) { $i = 8; }
    }
    echo "</select></td></tr>\n";  
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>".$lang_new[$module_name]['ADMIN_EXTENSIONS_ACTIVE']."</td><td>";
    echo yesno_option('add_extactive', $row['active']);
    echo "</td></tr>\n";
    echo "</table>\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsExtModifyS\" />";
    echo "<input type=\"hidden\" name=\"eid\" value=\"".$row['eid']."\" />";
    echo "<input type=\"hidden\" name=\"min\" value=\"$min\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_SAVE'] . "\" /></center>\n";
    echo "</form>\n";
} else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_EXTENSION_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>