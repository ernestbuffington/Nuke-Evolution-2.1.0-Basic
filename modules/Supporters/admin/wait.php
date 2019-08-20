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
    if(($numsuppen = $cache->load('numsuppen', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM "._NSNSP_SITES_TABLE." WHERE site_status='0'");
        list($numsuppen) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numsuppen', 'submissions', $numsuppen);
    }
    if(($numsupact = $cache->load('numsupact', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM "._NSNSP_SITES_TABLE." WHERE site_status='1'");
        list($numsupact) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numsupact', 'submissions', $numsupact);
    }
    if(($numsupdea = $cache->load('numsupdea', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM "._NSNSP_SITES_TABLE." WHERE site_status='-1'");
        list($numsupdea) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numsupdea', 'submissions', $numsupdea);
    }
    $content .= "<span style='text-align: center; font-weight: bold; font-style: italic;'>"._ASUP.":</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=SPPending'>" ._WSUPPORT."</a>:&nbsp;<span style='font-weight: bold;'>$numsuppen</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=SPActive'>"  ._ASUPPORT."</a>:&nbsp;<span style='font-weight: bold;'>$numsupact</span><br />\n";
    $content .= "<img src='". evo_image('arrow.png', 'evo') ."' alt='' width='5' height='10' />&nbsp;<a href='".$admin_file.".php?op=SPInactive'>"._DSUPPORT."</a>:&nbsp;<span style='font-weight: bold;'>$numsupdea</span><br />\n";
}

?>