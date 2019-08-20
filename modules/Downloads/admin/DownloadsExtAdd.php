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

global $db;
$add_extension      = FixQuotes($add_extension);
$add_extmimetype    = FixQuotes($add_extmimetype);
$add_extension      = FixQuotes($add_extension);
$add_extdescription = FixQuotes($add_extdescription);
$error = '';
$result = $db->sql_unumrows("SELECT `ext` FROM `"._DOWNLOADS_EXTENSIONS_TABLE."` WHERE `ext` = '$add_extension'");
if ( $result > 0 ) {
    $error .= $lang_new[$module_name]['ERROR_EXTENSION_EXISTS'] . "<br />";
    $error .= $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
} else {
    $db->sql_uquery("INSERT INTO `"._DOWNLOADS_EXTENSIONS_TABLE."` (`eid`, `ext`, `type`, `mimetype`, `active`, `description`) VALUES ('NULL', '$add_extension', '$add_exttype', '$add_extmimetype', '$add_extactive',  '$add_extdescription')");
    $error .= $lang_new[$module_name]['MESSAGE_EXTENSION_ADDED'] . "<br />";
    $error .= "[ <a href=\"".$admin_file.".php?op=Downloads\">" . $lang_new[$module_name]['ADMIN_DOWNLOADSADMIN'] . "</a> ]<br />";
}
DownloadsHeader();
OpenTable();
echo "<center><span class=option>". $error . "</span></center>\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
?>