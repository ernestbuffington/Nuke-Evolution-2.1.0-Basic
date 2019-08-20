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

global $admin_file, $db, $_GETVAR;

if (is_admin()) {

    $sip                = $_GETVAR->get('sip', '_POST', 'string', '');
    $xop                = $_GETVAR->get('xop', '_POST', 'string', '');
    $min                = $_GETVAR->get('min', '_POST', 'int', 0);
    $column             = $_GETVAR->get('column', '_POST', 'string', '');
    $direction          = $_GETVAR->get('direction', '_POST', 'string');
    $xip                = $_GETVAR->get('xip', '_POST', 'array', array());
    $old_xIPs           = $_GETVAR->get('old_xIPs', '_POST', 'string', '');
    $xnotes             = $_GETVAR->get('xnotes', '_POST', 'string', '');
    $xdatetime          = $_GETVAR->get('xdatetime', '_POST', 'string', '');
    $another            = $_GETVAR->get('another', '_POST', 'int', 0);
    $xuser_id           = $_GETVAR->get('xuser_id', '_POST', 'int', 0);
    $xusername          = $_GETVAR->get('xusername', '_POST', 'string', '');
    $xuser_agent        = $_GETVAR->get('xuser_agent', '_POST', 'string', '');
    $xexpires           = $_GETVAR->get('xexpires', '_POST', 'int', 0);
    $xc2c               = $_GETVAR->get('xc2c', '_POST', 'string', '');
    $xreason            = $_GETVAR->get('xreason', '_POST', 'string', '');
    $xquery_string      = $_GETVAR->get('xquery_string', '_POST', 'string', '');
    $xx_forward_for     = $_GETVAR->get('xx_forward_for', '_POST', 'string', '');
    $xclient_ip         = $_GETVAR->get('xclient_ip', '_POST', 'string', '');
    $xremote_addr       = $_GETVAR->get('xremote_addr', '_POST', 'string', '');
    $xremote_port       = $_GETVAR->get('xremote_port', '_POST', 'string', '');
    $xrequest_method    = $_GETVAR->get('xrequest_method', '_POST', 'string', '');
    if(($xip[0] < 0 OR $xip[0] > 255 OR (!is_numeric($xip[0]) AND $xip[0] != "*")) OR ($xip[1] < 0 OR $xip[1] > 255 OR (!is_numeric($xip[1]) AND $xip[1] != "*")) OR ($xip[2] < 0 OR $xip[2] > 255 OR (!is_numeric($xip[2]) AND $xip[2] != "*")) OR ($xip[3] < 0 OR $xip[3] > 255 OR (!is_numeric($xip[3]) AND $xip[3] != "*"))) {
        $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDIPERROR;
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
    $xIPs = implode(".", $xip);
    $bantemp = str_replace("*", "0", $xIPs);
    $xIPl = sprintf("%u", ip2long($bantemp));
    if ($xexpires>0) {
        $xexpires = ($xexpires * 86400) + time();
    }
    $xdate    = (!empty($xdatetime) ? strtotime($xdatetime) : actualTimeServer());
    $xuser_id = intval($xuser_id);
    $xnotes = str_replace("<br />", "\r\n", $xnotes);
    $xnotes = str_replace("<br />", "\r\n", $xnotes);
    $db->sql_uquery("UPDATE `"._SENTINEL_BLOCKED_IPS_TABLE."` SET `ip_addr`='$xIPs', `ip_long`='$xIPl', `user_id`='$xuser_id', `username`='$xusername', `user_agent`='$xuser_agent', `date`='$xdate', `notes`='$xnotes', `reason`='$xreason', `expires`='$xexpires', `c2c`='$xc2c' WHERE `ip_addr`='$old_xIPs'");
    $i = 1;
    while($i <= 3) {
        $tip = substr($xIPs, -2);
        if ($tip == ".*") {
            $xIPs = substr($xIPs, 0, -2);
        }
        $i++;
    }
    $i = 1;
    while($i <= 3) {
        $tip = substr($old_xIPs, -2);
        if($tip == ".*") {
            $old_xIPs = substr($old_xIPs, 0, -2);
        }
        $i++;
    }
    $testip1 = '';
    if($xIPs != "0" AND $xIPs != "*") {
        $testip1 = "deny from $xIPs\n";
    }
    $testip2 = "deny from $old_xIPs\n";
    if($ab_config['htaccess_path'] != "") {
        $ipfile = file($ab_config['htaccess_path']);
        $ipfile = implode("", $ipfile);
        $ipfile = str_replace($testip2, $testip1, $ipfile);
        $ipfile = $ipfile;
        $doit = @fopen($ab_config['htaccess_path'], "w");
        @fwrite($doit, $ipfile);
        @fclose($doit);
    }
    redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;sip='.$sip);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>