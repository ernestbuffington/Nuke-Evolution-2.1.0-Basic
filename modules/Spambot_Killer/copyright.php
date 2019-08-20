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

define('CP_INCLUDE_DIR', dirname(dirname(dirname(__FILE__))));
require_once(CP_INCLUDE_DIR.'/includes/showcp.php');

$author_name        = "Rodmar";
$author_email       = "";
$author_homepage    = "www.evolved-Systems.net";
$based_on           = "Original Author not known";
$license            = "GPL 2.0";
$download_location  = "";
$module_version     = "2.0";
$module_description = "Floods spambots with useless emails!<br />Spambots often get your email by harvesting it from your website.<br /> This script feeds them tons of fake emails until they crash, loading their database with
                   fake emails that will bounce when spammed!
                   This script has been designed for deadliness. It
                   attracts spambots with advertising keywords (you must
                   link to it first), generates about 300+ fake emails
                   and 10 links back to it (with a slightly different URL
                   each time), several kilobytes of random ASCII to
                   confuse the spambot, a limit on the number of times
                   the page is retrieved by a spambot (to limit bandwidth
                   consumption), and then sends the spambots to dozens of
                   other similar deathtraps! (So the spambot still
                   receives tons of fake emails, but the bandwidth
                   consumed is not all yours!)";

show_copyright($author_name, $author_email, $author_homepage, $based_on, $license, $download_location, $module_version, $module_description);

?>
