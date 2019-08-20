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

if (!defined('IN_WEBLINKS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN WEBLINKS ADMINISTRATION');
}

$cat = explode("-", $cat);
if (empty($cat[1])) {
    $cat[1] = 0;
}

$db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` set `cid`='$cat[0]', `sid`='$cat[1]', `title`='$title', `image`='$image', `url`='$url', `description`='$description', `name`='$username', `email`='$email', `hits`='$hits' WHERE `lid`='$lid'");
// Has the link been submitted for modification? we edited it so let's remove it FROM the modrequest table
$sql = "SELECT * FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `lid`='$lid'";
$result = $db->sql_query($sql);
$numrows = $db->sql_numrows($result);
if ($numrows>0) {
    $db->sql_query("DELETE FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `lid`='$lid'");
    $cache->delete('numbrokenl', 'submissions');
    $cache->delete('nummodreql', 'submissions');
}
redirect($admin_file.".php?op=Links");

?>