<?php
/*=======================================================================
 Nuke-Evolution         :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE.
 YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN" MODULE'S DATA SO THE SYSTEM CAN
 BE ABLE TO SHOW THE COPYRIGHT NOTICE FOR YOUR MODULE/ADDON.
 PLAY FAIR WITH THE PEOPLE THAT WORKED HARD CODING WHAT YOU USE!!
 YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE REQUIRED INFORMATION.
 YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS
 FILE IF YOU'RE NOT THIS MODULE'S AUTHOR.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

define('CP_INCLUDE_DIR', dirname(dirname(dirname(__FILE__))));
require_once(CP_INCLUDE_DIR.'/includes/showcp.php');

$author_name        = "RTC4EVER";
$author_email       = "rtc4ever(at)evo-german(dot)com";
$author_homepage    = "http://www.evo-german.com";
$based_on           = "Downloads Modul by ReOrGaNiSatiOn";
$license            = "GPL";
$download_location  = "http://www.nuke-evolution.com";
$module_version     = "1.0.0";
$module_description = "One of the best Download Modules found on the market. Allows Down-/Uploads, Categories and Subcategories, Links inside Categories; Permissions: Main, Categorie, Group, User; Bandwith limit, Up-/Download limit; Thumbnails (Lightbox); Down-/Upload history and much more";

show_copyright($author_name, $author_email, $author_homepage, $based_on, $license, $download_location, $module_version, $module_description);

?>