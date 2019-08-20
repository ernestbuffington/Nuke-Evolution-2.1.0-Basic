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

    $xIPs       = $_GETVAR->get('xIPs', '_GET', 'string');
    $totalselected = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_addr`='$xIPs' LIMIT 0,1");
    if($totalselected > 0) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n";
        $pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTIP;
        echo '<title>'.$pagetitle.'</title>'."\n";
        echo '</head>'."\n";
        echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
        echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
        $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_addr`='$xIPs' LIMIT 0,1");
        $getIPs['date'] = date("Y-m-d H:i:s",$getIPs['date']);
        list($getIPs['reason']) = $db->sql_ufetchrow("SELECT `reason` FROM `"._SENTINEL_BLOCKERS_TABLE."` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1");
        $lookupip = str_replace("*", "0", $xIPs);
        $getIPs['query_string'] = base64_decode($getIPs['query_string']);
        $getIPs['query_string'] = str_replace("%20", " ", $getIPs['query_string']);
        $getIPs['query_string'] = str_replace("/**/", "/* */", $getIPs['query_string']);
        $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
        echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_BLOCKEDIP.':</strong></td><td>'.$xIPs.'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_USER.':</strong></td><td>'.$getIPs['username'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_AGENT.':</strong></td><td>'.$getIPs['user_agent'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_BLOCKEDON.':</strong></td><td>'.$getIPs['date'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td valign="top"><strong>'._AB_NOTES.':</strong></td><td>'.$getIPs['notes'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REASON.':</strong></td><td>'.$getIPs['reason'].'</td></tr>'."\n";
        //echo '<tr bgcolor="#ffffff"><td colspan="2">&nbsp;</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_QUERY.':</strong></td><td>'.$getIPs['query_string'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_X_FORWARDED.':</strong></td><td>'.$getIPs['x_forward_for'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_CLIENT_IP.':</strong></td><td>'.$getIPs['client_ip'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REMOTE_ADDR.':</strong></td><td>'.$getIPs['remote_addr'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REMOTE_PORT.':</strong></td><td>'.$getIPs['remote_port'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REQUEST_METHOD.':</strong></td><td>'.$getIPs['request_method'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_COUNTRY.':</strong></td><td>'.strtoupper($getIPs['c2c']).' - '.$countrytitleinfo['country'].'</td></tr>'."\n";
        echo '</table>'."\n";
        echo '</body>'."\n";
        echo '</html>';
        die();
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo '<center><strong>'._AB_NORANGES.'</strong></center>'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}
?>