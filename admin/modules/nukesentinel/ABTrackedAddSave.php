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

global $admin_file, $db, $ab_config, $_GETVAR;

if (is_admin()) {

    $op         = $_GETVAR->get('op', '_POST', 'string');
    $tidinfo    = $_GETVAR->get('tidinfo', '_POST', 'array');
    $xip        = $_GETVAR->get('xip', '_POST', 'array');
    if(($xip[0] < 0 OR $xip[0] > 255 OR (!is_numeric($xip[0]) AND $xip[0] != "*")) OR ($xip[1] < 0 OR $xip[1] > 255 OR (!is_numeric($xip[1]) AND $xip[1] != "*")) OR ($xip[2] < 0 OR $xip[2] > 255 OR (!is_numeric($xip[2]) AND $xip[2] != "*")) OR ($xip[3] < 0 OR $xip[3] > 255 OR (!is_numeric($xip[3]) AND $xip[3] != "*"))) {
        $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDRANGEERROR;
        include_once(NUKE_BASE_DIR.'header.php');
        title($pagetitle);
        OpenTable();
        echo '<br />'."\n";
        echo '<center><strong>'._AB_IPERROR.' </strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }
    $tidinfo['ip_addr'] = implode(".", $xip);
    $bantemp = str_replace("*", "0", $tidinfo['ip_addr']);
    $tidinfo['ip_long'] = sprintf("%u", ip2long($bantemp));
    if ($tidinfo['expires']>0) { 
        $tidinfo['expires'] = ($tidinfo['expires'] * 86400) + time(); 
    }
    $tidinfo['user_id'] = intval($tidinfo['user_id']);
    $tidinfo['notes'] = str_replace("<br />", "\r\n", $tidinfo['notes']);
    $tidinfo['notes'] = str_replace("<br />", "\r\n", $tidinfo['notes']);
    $tidinfo['query_string'] = str_replace("http://", "", EVO_SERVER_URL).$tidinfo['query_string'];
    $tidinfo['query_string'] = base64_encode($tidinfo['query_string']);
    $ip = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_addr`='".$tidinfo['ip_addr']."' LIMIT 0,1");
    if($ip < 1) {
        $db->sql_uquery("INSERT INTO `"._SENTINEL_BLOCKED_IPS_TABLE."` (`ip_addr`, `ip_long`, `user_id`, `username`, `user_agent`, `date`, `notes`, `reason`, `query_string`, `get_string`, `post_string`, `x_forward_for`, `client_ip`, `remote_addr`, `remote_port`, `request_method`, `expires`, `c2c`)
                        VALUES ('".$tidinfo['ip_addr']."', '".$tidinfo['ip_long']."', '".$tidinfo['user_id']."', '".$tidinfo['username']."', '".$tidinfo['user_agent']."', '".$tidinfo['date']."', '".$tidinfo['notes']."', '".$tidinfo['reason']."', '".$tidinfo['query_string']."', '".$tidinfo['query_string']."', '".$tidinfo['query_string']."', '".$tidinfo['x_forward_for']."', '".$tidinfo['client_ip']."', '".$tidinfo['remote_addr']."', '".$tidinfo['remote_port']."', '".$tidinfo['request_method']."', '".$tidinfo['expires']."', '".$tidinfo['c2c']."')");
        if($ab_config['htaccess_path'] != "") {
            $i = 1;
            while($i <= 3) {
                $tip = substr($tidinfo['ip_addr'], -2);
                if($tip == ".*") { $tidinfo['ip_addr'] = substr($tidinfo['ip_addr'], 0, -2); }
                $i++;
            }
            $tempip = "";
            if($tidinfo['ip_addr'] != "*") { $tempip = "deny from ".$tidinfo['ip_addr']."\n"; }
            $doit = fopen($ab_config['htaccess_path'], "a");
            fwrite($doit, $tempip);
            fclose($doit);
        }
    }
    redirect($admin_file.'.php?op=ABBlockedIPList');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>