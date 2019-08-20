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

if (!defined('NUKE_EVO')) {
    die("You can't access this file directly...");
}

global $db, $cache;

/*################################################
# Load dynamic meta tags from database           #
################################################*/
$metastring = '';

if(($metatags = $cache->load('metatags', 'config')) === false) {
  $metatags = array();
  $sql = 'SELECT meta_name, meta_content FROM '._META_TABLE;
  $result = $db->sql_query($sql, true);
  $i=0;
  while(list($meta_name, $meta_content) = $db->sql_fetchrow($result, SQL_NUM)) {
      $metatags[$i] = array();
      $metatags[$i]['meta_name']    = @htmlentities($meta_name);
      $metatags[$i]['meta_content'] = @htmlentities($meta_content);

      $i++;
  }
  unset($i);
  $db->sql_freeresult($result);
  $cache->save('metatags', 'config', $metatags);
}

/*################################################
# Finally output the meta tags                   #
################################################*/

for($i=0,$j=count($metatags);$i<$j;$i++) {
  $metatag = $metatags[$i];
    $metastring .= "<meta name='".$metatag['meta_name']."' content='".$metatag['meta_content']."' />\n";
}

/*#############################################
# DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE! #
# YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS. #
#############################################*/

// IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
// PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
$metastring .= "<meta name='generator' content='Based on PHPNuke (c) by PHPNuke.org. This is free software, and you may redistribute it under the GPL (http://phpnuke.org/files/gpl.txt). Nuke-Evolution comes with absolutely no warranty, for details, see the license (http://phpnuke.org/files/gpl.txt). Powered by Nuke-Evolution (http://www.nuke-evolution.de).' />\n\n";

echo $metastring;

?>