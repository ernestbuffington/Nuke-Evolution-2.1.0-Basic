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

if (is_admin()) {

    $expiretime = time();
    $clearresult = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."` WHERE (`expires`<'$expiretime' AND `expires`!='0')");
    while($clearblock = $db->sql_fetchrow($clearresult)) {
        $old_masscidr = ABGetCIDRs($clearblock['ip_lo'], $clearblock['ip_hi']);
        if($ab_config['htaccess_path'] != "") {
            $old_masscidr = explode("||", $old_masscidr);
            for($i=0; $i < sizeof($old_masscidr); $i++) {
                if($old_masscidr[$i]!="") {
                  $old_masscidr[$i] = "deny from ".$old_masscidr[$i]."\n";
                }
            }
            $ipfile = file($ab_config['htaccess_path']);
            $ipfile = implode("", $ipfile);
            $ipfile = str_replace($old_masscidr, "", $ipfile);
            $ipfile = $ipfile;
            $doit   = @fopen($ab_config['htaccess_path'], "w");
            @fwrite($doit, $ipfile);
            @fclose($doit);
        }
        $db->sql_uquery("DELETE FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."` WHERE `ip_lo`='".$clearblock['ip_lo']."' AND `ip_hi`='".$clearblock['ip_hi']."'");
        $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_BLOCKED_RANGES_TABLE."`");
    }
    $db->sql_freeresult($clearresult);
    redirect($admin_file.'.php?op=ABBlockedRangeList');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>