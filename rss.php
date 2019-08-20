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

define('RSS_FEED', true);
define('NO_SENTINEL', true);
define('NO_SECURITY', true);

require_once(dirname(__FILE__) . '/mainfile.php');
include_once(NUKE_INCLUDE_DIR.'counter.php');

$feed = $_GETVAR->get('feed', 'REQUEST');

if(isset($feed) && !preg_match("/[\W]/i", $feed)) {
  $feed = htmlentities(addslashes($feed));
  if(@file_exists(NUKE_RSS_DIR.$feed.'.php')) {
    include_once(NUKE_RSS_DIR.$feed.'.php');
  } else {
    exit(_NORSS);
  }
} else {
  include_once(NUKE_RSS_DIR.'news.php');
}

?>