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

if(!defined('NUKE_EVO')) {
    exit('THIS FILE WAS NOT CALLED WITHIN NUKE-EVO');
}

global $admin_file, $db, $cache;

$module_name = basename(dirname(dirname(__FILE__)));

if(is_active($module_name)) {
    if(($numbrokend = $cache->load('numbrokend', 'submissions')) === false) {
        $result     = $db->sql_ufetchrow("SELECT COUNT(`did`) AS `numbroken` FROM `". _DOWNLOADS_DOWNLOADS_TABLE ."` WHERE `download_broken` = '1'");
        $numbrokend = $result['numbroken'];
        $cache->save('numbrokend', 'submissions', $numbrokend);
    }
    if(($nummodreqd = $cache->load('nummodreqd', 'submissions')) === false) {
        $result     = $db->sql_ufetchrow("SELECT COUNT(`did`) AS `nummodified` FROM `". _DOWNLOADS_DOWNLOADS_TABLE ."` WHERE `download_modified` = '1'");
        $nummodreqd = $result['nummodified'];
        $cache->save('nummodreqd', 'submissions', $nummodreqd);
    }
    if(($numwaitd   = $cache->load('numwaitd', 'submissions')) === false) {
        $result     = $db->sql_ufetchrow("SELECT COUNT(`did`) AS `numnew` FROM `". _DOWNLOADS_NEWDOWNLOADS_TABLE."`");
        $numwaitd   = $result['numnew'];
        $cache->save('numwaitd', 'submissions', $numwaitd);
    }
    $content .= "<span style='text-align: center; font-weight: bold; font-style: italic;'>"._ADOWN.":</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=DownloadsListBrokenDownloads'>".  _BROKENDOWN."</a>:&nbsp;<span style='font-weight: bold;'>$numbrokend</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=DownloadsListModRequests'>".      _MODREQDOWN."</a>:&nbsp;<span style='font-weight: bold;'>$nummodreqd</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=DownloadsListValidateDownloads'>"._WDOWNLOADS."</a>:&nbsp;<span style='font-weight: bold;'>$numwaitd</span><br />\n";
}

?>