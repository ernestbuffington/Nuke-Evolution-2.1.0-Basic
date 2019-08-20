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

if (!defined('MODULE_FILE') || !defined('WEBLINK_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');

global $lang_new, $module_name;

if (!security_code_check($_POST['gfx_check'], 'force') && $weblinksconfig['securitycheck'] == 1) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
}
// Check if Title exist
if (empty($title)) {
    $message = $lang_new[$module_name]['ERROR_NO_TITLE'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
}
// Check if URL exist
if (empty($url)) {
    $message = $lang_new[$module_name]['ERROR_NO_URL'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
    $error = 1;
}
// Check if Description exist
if (empty($description)) {
    $message = $lang_new[$module_name]['ERROR_NO_DESCRIPTION'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
}

$title       = $_GETVAR->fixQuotes($title);
$image       = $_GETVAR->fixQuotes($image);
$url         = $_GETVAR->fixQuotes($url);
Validate($url,'url',$lang_new[$module_name]['LINKS']);
$description = $_GETVAR->fixQuotes($description);
$username    = $_GETVAR->fixQuotes($username);
$email       = $_GETVAR->fixQuotes($email);
if (!empty($email)) {
     Validate($email,'email',$lang_new[$module_name]['LINKS']);
}
$num_new  = $db->sql_unumrows("SELECT * FROM `"._WEBLINKS_NEWLINK_TABLE."` WHERE `title`='".$title."' OR `url`='".$url."'");
$num_new2 = $db->sql_unumrows("SELECT * FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `title`='".$title."' OR `url`='".$url."'");
if ($num_new > 0 || $num_new2 > 0) {
    $message = $lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
} else {
    $db->sql_query("INSERT INTO `"._WEBLINKS_NEWLINK_TABLE."` (`lid`, `cid` , `sid` , `title` , `image`, `url`, `description` , `date`, `name` , `email` , `submitter` )
                      VALUES (NULL, '".$cat."', '0', '".$title."', '".$image."', '".$url."', '".$description."', '".time()."', '".$username."', '".$email."', '".$submitter."')");
    $cache->delete('numwaitl', 'submissions');
    LinksHeading();
    OpenTable();
    echo "<center><strong>".$lang_new[$module_name]['MESSAGE_LINK_ADDED']."</strong><br />";
    if (!empty($email)) {
        echo $lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_EMAIL'];
    } else {
        echo $lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_NOEMAIL'];
    }
    echo "</center>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>