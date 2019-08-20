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

global $ab_config, $db, $_GETVAR, $admin_file;

if( is_admin()) {
    $sip        = $_GETVAR->get('sip', '_POST', 'int');
    $xIPs       = $_GETVAR->get('xIPs', '_POST', 'string');
    $xop        = $_GETVAR->get('xop', '_POST', 'string');
    $min        = $_GETVAR->get('min', '_POST', 'int');
    $column     = $_GETVAR->get('column', '_POST', 'string');
    $direction  = $_GETVAR->get('direction', '_POST', 'string');
    $db->sql_uquery("DELETE FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_addr`='$xIPs'");
    $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_BLOCKED_IPS_TABLE."`");
    if($ab_config['htaccess_path'] != '') {
        $i = 1;
        while($i <= 3) {
            $tip = substr($xIPs, -2);
            if($tip == ".*") {
                $xIPs = substr($xIPs, 0, -2);
            }
            $i++;
        }
        $testip = "deny from $xIPs\n";
        $ipfile = file($ab_config['htaccess_path']);
        $ipfile = implode("", $ipfile);
        $ipfile = str_replace($testip, "", $ipfile);
        $doit   = @fopen($ab_config['htaccess_path'], "w");
        @fwrite($doit, $ipfile);
        @fclose($doit);
    }
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;sip='.$sip);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>