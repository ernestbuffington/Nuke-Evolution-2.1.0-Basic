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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }


global $ips, $users_ips;


// IPs that are used to allowed access to admin.php and forum admin; all others will be denied
// Seperate all IPs by a comma.
// ex: $ips = array('127.0.0.1', '192.168.1.1');

/*=====
  For more information on how to use this please see the help file in the help/features folder
  =====*/

//$ips = array('xxx.xxx.xxx.xxx');


// IPs that are allowed to login to the specified user accounts
// Seperate all IPs by a comma inside the second ''.
// ex: $users_ips = array('Technocrat', '127.0.0.1,192.168.1.1');

/*=====
  For more information on how to use this please see the help file in the help/features folder
  =====*/

//$users_ips = array('name', 'xxx.xxx.xxx.xxx');

?>