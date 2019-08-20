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

    $ip_lo      = $_GETVAR->get('ip_lo', '_REQUEST', 'int', 0);
    $ip_hi      = $_GETVAR->get('ip_hi', '_REQUEST', 'int', 0);

    $totalselected = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_EXCLUDED_RANGES_TABLE."` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1");
    if($totalselected > 0) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n";
        $pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTEXCLUDED;
        echo '<title>'.$pagetitle.'</title>'."\n";
        echo '</head>'."\n";
        echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
        echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
        $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_EXCLUDED_RANGES_TABLE."` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1");
        $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
        $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
        $countryrow = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_COUNTRIES_TABLE."` WHERE `c2c`='".$getIPs['c2c']."' LIMIT 0,1");
        echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_IPLO.':</strong></td><td>'.$getIPs['ip_lo_ip'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_IPHI.':</strong></td><td>'.$getIPs['ip_hi_ip'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td valign="top"><strong>'._AB_NOTES.':</strong></td><td>'.$getIPs['notes'].'</td></tr>'."\n";
        echo '<tr bgcolor="#ffffff"><td><strong>'._AB_COUNTRY.':</strong></td><td>'.strtoupper($getIPs['c2c']).' - '.$countryrow['country'].'</td></tr>'."\n";
        echo '</table>'."\n";
        echo '</body>'."\n";
        echo '</html>';
        die();
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>