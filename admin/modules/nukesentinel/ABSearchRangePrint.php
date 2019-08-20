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

    $sip_lo  = $_GETVAR->get('sip_lo', '_REQUEST', 'int', 0);
    $sip_hi  = $_GETVAR->get('sip_hi', '_REQUEST', 'int', 0);

    //BLOCKED IP SEARCH RESULTS
    $totalselected_ips = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_long` >='$sip_lo' AND `ip_long`<='$sip_hi'");
    if($sip_lo > 0 || $sip_hi < 4294967295) {
        $totalselected_ranges = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."` WHERE (`ip_lo`<='$sip_lo' AND `ip_hi`>='$sip_lo') OR (`ip_lo`<='$sip_hi' AND `ip_hi`>='$sip_hi') OR (`ip_lo`>='$sip_lo' AND `ip_hi`<='$sip_hi') OR (`ip_lo`<='$sip_lo' AND `ip_hi`>='$sip_hi') ORDER BY `ip_lo`");
    } else {
        $totalselected_ranges = 0;
    }
    if ( $totalselected_ips > 0 || $totalselected_ranges > 0) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n";
        $pagetitle = _AB_NUKESENTINEL.": "._AB_SEARCHRANGES;
        echo '<title>'.$pagetitle.'</title>'."\n";
        echo '</head>'."\n";
        echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
        echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
        echo '<br />'."\n";
        $longip_lo = sprintf("%u", ip2long($sip_lo)); // 0
        $longip_hi = sprintf("%u", ip2long($sip_hi)); // 4294967295

        if($totalselected_ips > 0) {
            echo '<br />'."\n";
            echo '<center class="title"><strong>'._AB_SEARCHBLOCKEDIPS.'</strong></center><br />'."\n";
            echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
            echo '<tr bgcolor="#ffffff">'."\n";
            echo '<td width="20%"><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_DATE.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_EXPIRES.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_REASON.'</strong></td>'."\n";
            echo '</tr>'."\n";
            $result = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_long` >='$longip_lo' AND `ip_long`<='$longip_hi'");
            while($getIPs = $db->sql_fetchrow($result)) {
                list($getIPs['reason']) = $db->sql_ufetchrow("SELECT `reason` FROM `"._SENTINEL_BLOCKERS_TABLE."` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1");
                $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
                $bdate = date("Y-m-d", $getIPs['date']);
                $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
                if ($getIPs['expires']==0) {
                    $bexpire = _AB_PERMENANT;
                } else {
                    $bexpire = date("Y-m-d", $getIPs['expires']);
                }
                list($bname) = $db->sql_ufetchrow("SELECT `username` FROM `"._USERS_TABLE."` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1");
                $qs = base64_decode($getIPs['query_string']);
                $qs = str_replace("%20", " ", $qs);
                $qs = str_replace("/**/", "/* */", $qs);
                $qs = str_replace("&", "<br />&", $qs);
                $ua = $getIPs['user_agent'];
                $countrytitle = abget_countrytitle($getIPs['c2c']);
                $getIPs['country'] = $countrytitle['country'];
                echo '<tr bgcolor="#ffffff">'."\n";
                echo '<td>'.$getIPs['ip_addr'].'</td>'."\n";
                echo '<td align="center">('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
                echo '<td align="center">'.$bdate.'</td>'."\n";
                echo '<td align="center">'.$bexpire.'</td>'."\n";
                echo '<td align="center">'.$getIPs['reason'].'</td>'."\n";
                echo '</tr>'."\n";
            }
            $db->sql_freeresult($result);
            echo '</table>'."\n";
            echo '</body>'."\n";
            echo '</html>';
            die();
        }
            //BLOCKED RANGES SEARCH RESULTS
        if ($totalselected_ranges > 0) {
            echo '<br />'."\n";
            echo '<center class="title"><strong>'._AB_SEARCHBLOCKEDRANGES.'</strong></center><br />'."\n";
            echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
            echo '<tr bgcolor="#ffffff">'."\n";
            echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
            echo '</tr>'."\n";
            $x = 0;
            $result = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
            while ($getIPs = $db->sql_fetchrow($result)) {
                $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
                $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
                $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
                $masscidr = str_replace("||", ",<br />", $masscidr);
                if (stristr($masscidr, "<br />")) {
                    $valign = ' valign="top"';
                } else {
                    $valign = '';
                }
                $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
                $getIPs['country'] = $countrytitleinfo['country'];
                echo '<tr bgcolor="#ffffff">'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
                echo '</tr>'."\n";
                $x++;
            }
            $db->sql_freeresult($result);
            echo '</table>'."\n";
        }
        //EXCLUDED RANGES SEARCH RESULTS
        $totalselected = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_EXCLUDED_RANGES_TABLE."` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
        if ($totalselected > 0) {
            echo '<br />'."\n";
            echo '<center class="title"><strong>'._AB_SEARCHEXCLUDEDRANGES.'</strong></center><br />'."\n";
            echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
            echo '<tr bgcolor="#ffffff">'."\n";
            echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
            echo '</tr>'."\n";
            $x = 0;
            $result = $db->sql_query("SELECT * FROM `"._SENTINEL_EXCLUDED_RANGES_TABLE."` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
            while($getIPs = $db->sql_fetchrow($result)) {
                $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
                $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
                $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
                $masscidr = str_replace("||", ",<br />", $masscidr);
                if (stristr($masscidr, "<br />")) {
                    $valign = ' valign="top"';
                } else {
                    $valign = '';
                }
                $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
                $getIPs['country'] = $countrytitleinfo['country'];
                echo '<tr bgcolor="#ffffff">'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
                echo '</tr>'."\n";
                $x++;
            }
            $db->sql_freeresult($result);
            echo '</table>'."\n";
        }
        //PROTECTED RANGES SEARCH RESULTS
        $totalselected = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_PROTECTED_RANGES_TABLE."` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
        if ($totalselected > 0) {
            echo '<br />'."\n";
            echo '<center class="title"><strong>'._AB_SEARCHPROTECTEDRANGES.'</strong></center><br />'."\n";
            echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
            echo '<tr bgcolor="#ffffff">'."\n";
            echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
            echo '</tr>'."\n";
            $x = 0;
            $result = $db->sql_query("SELECT * FROM `"._SENTINEL_PROTECTED_RANGES_TABLE."` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
            while ($getIPs = $db->sql_fetchrow($result)) {
                $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
                $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
                $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
                $masscidr = str_replace("||", ",<br />", $masscidr);
                if (stristr($masscidr, "<br />")) {
                    $valign = ' valign="top"';
                } else {
                    $valign = '';
                }
                $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
                $getIPs['country'] = $countrytitleinfo['country'];
                echo '<tr bgcolor="#ffffff">'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
                echo '</tr>'."\n";
                $x++;
            }
            $db->sql_freeresult($result);
            echo '</table>'."\n";
        }
        //IP 2 COUNTRY SEARCH
        $totalselected = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_IP2COUNTRY_TABLE."` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
        if ($totalselected > 0) {
            echo '<br />'."\n";
            echo '<center class="title"><strong>'._AB_IP2CSEARCH.'</strong></center><br />'."\n";
            echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
            echo '<tr bgcolor="#ffffff">'."\n";
            echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
            echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
            echo '</tr>'."\n";
            $x = 0;
            $result = $db->sql_query("SELECT * FROM `"._SENTINEL_IP2COUNTRY_TABLE."` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
            while($getIPs = $db->sql_fetchrow($result)) {
                $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
                $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
                $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
                $masscidr = str_replace("||", ",<br />", $masscidr);
                if (stristr($masscidr, "<br />")) {
                    $valign = ' valign="top"';
                } else {
                    $valign = '';
                }
                $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
                $getIPs['country'] = $countrytitleinfo['country'];
                echo '<tr bgcolor="#ffffff">'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
                echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
                echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
                echo '</tr>'."\n";
                $x++;
            }
            $db->sql_freeresult($result);
            echo '</table>'."\n";
        }
        echo '</body>'."\n";
        echo '</html>';
        exit();
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