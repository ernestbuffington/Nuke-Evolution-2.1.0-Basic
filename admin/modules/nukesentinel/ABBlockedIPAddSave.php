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

global $_GETVAR, $admin_file, $evoconfig, $db, $ab_config;

if (is_admin()) {

    $xip                = $_GETVAR->get('xip', '_POST', 'array', array());
    $xnotes             = $_GETVAR->get('xnotes', '_POST', 'string');
    $another            = $_GETVAR->get('another', '_POST', 'int');
    $xuser_id           = $_GETVAR->get('xuser_id', '_POST', 'int');
    $xusername          = $_GETVAR->get('xusername', '_POST', 'string');
    $xuser_agent        = $_GETVAR->get('xuser_agent', '_POST', 'string');
    $xexpires           = $_GETVAR->get('xexpires', '_POST', 'int');
    $xc2c               = $_GETVAR->get('xc2c', '_POST', 'string');
    $xreason            = $_GETVAR->get('xreason', '_POST', 'string');
    $xquery_string      = $_GETVAR->get('xquery_string', '_POST', 'string');
    $xx_forward_for     = $_GETVAR->get('xx_forward_for', '_POST', 'string');
    $xclient_ip         = $_GETVAR->get('xclient_ip', '_POST', 'string');
    $xremote_addr       = $_GETVAR->get('xremote_addr', '_POST', 'string');
    $xremote_port       = $_GETVAR->get('xremote_port', '_POST', 'string');
    $xrequest_method    = $_GETVAR->get('xrequest_method', '_POST', 'string');
    if(($xip[0] < 0 OR $xip[0] > 255 OR (!is_numeric($xip[0]) AND $xip[0] != "*")) OR ($xip[1] < 0 OR $xip[1] > 255 OR (!is_numeric($xip[1]) AND $xip[1] != "*")) OR ($xip[2] < 0 OR $xip[2] > 255 OR (!is_numeric($xip[2]) AND $xip[2] != "*")) OR ($xip[3] < 0 OR $xip[3] > 255 OR (!is_numeric($xip[3]) AND $xip[3] != "*"))) {
        $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDIPERROR;
        include_once(NUKE_BASE_DIR.'header.php');
        title($pagetitle);
        OpenTable();
        echo '<br />'."\n";
        echo '<center><strong>'._AB_IPERROR.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }
    $xIPs = implode(".", $xip);
    $bantemp = str_replace("*", "0", $xIPs);
    $xIPl = sprintf("%u", ip2long($bantemp));
    $ip = $db->sql_query("SELECT COUNT(`ip_addr`) AS counted FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_addr`='$xIPs'");
    $bantime = time();
    $xnotes = str_replace("<br />", "\r\n", $xnotes);
    $xnotes = str_replace("<br />", "\r\n", $xnotes);
    if ($xexpires>0) {
        $xexpires = $bantime + ($xexpires * 86400);
    }
    if ($ip['counted'] < 1) {
        $temp_qs = $xquery_string;
        $temp_qs = base64_encode($temp_qs);
        $db->sql_uquery("INSERT INTO `"._SENTINEL_BLOCKED_IPS_TABLE."` (`ip_addr`, `ip_long`, `user_id`, `username`, `user_agent`, `date`, `notes`, `reason`, `query_string`, `get_string`, `post_string`, `x_forward_for`, `client_ip`, `remote_addr`, `remote_port`, `request_method`, `expires`, `c2c`)
                  VALUES ('$xIPs', '$xIPl', '$xuser_id', '$xusername', '$xuser_agent', '$bantime', '$xnotes', '$xreason', '$temp_qs', '$temp_qs', '$temp_qs', '$xx_forward_for', '$xclient_ip', '$xremote_addr', '$xremote_port', '$xrequest_method', '$xexpires', '$xc2c')");
        if($ab_config['htaccess_path'] != '') {
            $i = 1;
            while($i <= 3) {
                $tip = substr($xIPs, -2);
                if($tip == ".*") { $xIPs = substr($xIPs, 0, -2); }
                $i++;
            }
            $tempip = '';
            if($xIPs != '*') { $tempip = "deny from ".$xIPs."\n"; }
            $doit = @fopen($ab_config['htaccess_path'], 'a');
            @fwrite($doit, $tempip);
            @fclose($doit);
        }
    }
    if($another == 1) {
        redirect($admin_file.'.php?op=ABBlockedIPAdd');
    }else {
        redirect($admin_file.'.php?op=ABBlockedIPList');
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}
?>