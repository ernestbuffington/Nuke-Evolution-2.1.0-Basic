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
    if(($numbrokenr = $cache->load('numbrokenr', 'submissions')) === false) {
        list($numbrokenr) = $db->sql_ufetchrow("SELECT COUNT(*) FROM ". _REVIEWS_MODREQUEST_TABLE ." WHERE brokenreview='1'");
    }
    if(($nummodreqr = $cache->load('nummodreqr', 'submissions')) === false) {
        list($nummodreqr) = $db->sql_ufetchrow("SELECT COUNT(*) FROM ". _REVIEWS_MODREQUEST_TABLE ." WHERE brokenreview='0'");
        $cache->save('nummodreqr', 'submissions', $nummodreqr);
    }
    if(($numwaitr = $cache->load('numwaitr', 'submissions')) === false) {
        list($numwaitr) = $db->sql_ufetchrow("SELECT COUNT(*) FROM ". _REVIEWS_NEWREVIEW_TABLE);
        $cache->save('numwaitr', 'submissions', $numwaitr);
    }
    $content .= "<span style='text-align: center; font-weight: bold; font-style: italic;'>"._AREV.":</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=ReviewsListBrokenReviews'>"._BROKENREVIEWS."</a>:&nbsp;<span style='font-weight: bold;'>$numbrokenr</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=ReviewsListModRequests'>"  ._MODREQREVIEWS."</a>:&nbsp;<span style='font-weight: bold;'>$nummodreqr</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=ReviewsListNewReviews'>"        ._WREVIEWS."</a>:&nbsp;<span style='font-weight: bold;'>$numwaitr</span><br />\n";
}

?>