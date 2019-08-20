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

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

global $admin_file, $db, $ab_config;

if (is_god_admin()) {

    if($ab_config['staccess_path'] > '') {
        $stwrite = '';
        $adminresult = $db->sql_query("SELECT * FROM `"._SENTINEL_ADMINS_TABLE."` WHERE `password_crypt`>'' ORDER BY `aid`");
        while($adminrow = $db->sql_fetchrow($adminresult)) {
            $stwrite .= $adminrow['login'].":".$adminrow['password_crypt']."\n";
            $doit = @fopen($ab_config['staccess_path'], "w");
            @fwrite($doit, $stwrite);
            @fclose($doit);
        }
        $db->sql_freeresult($adminresult);
    }
    redirect($admin_file.'.php?op=ABAuthList');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>