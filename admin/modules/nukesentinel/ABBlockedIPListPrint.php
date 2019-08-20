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

global $admin_file, $db;

if (is_admin()) {

    @set_time_limit(600);
    $totalselected = $db->sql_unumrows("SELECT date FROM `"._SENTINEL_BLOCKED_IPS_TABLE."`");
    if($totalselected > 0) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n";
        $pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTBLOCKEDIPS;
        echo '<title>'.$pagetitle.'</title>'."\n";
        echo '</head>'."\n";
        echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
        echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
        echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
        echo '<tr bgcolor="#ffffff">'."\n";
        echo '<td><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_DATE.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_EXPIRES.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_REASON.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` ORDER BY `ip_addr`");
        while($getIPs = $db->sql_fetchrow($result)) {
            list($getIPs['reason']) = $db->sql_ufetchrow("SELECT `reason` FROM `"._SENTINEL_BLOCKERS_TABLE."` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1");
            $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
            $bdate = date("Y-m-d @ H:i:s", $getIPs['date']);
            $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
            if ($getIPs['expires']==0) {
                $bexpire = _AB_PERMENANT;
            } else {
                $bexpire = date("Y-m-d @ H:i:s", $getIPs['expires']);
            }
            list($bname) = $db->sql_ufetchrow("SELECT `username` FROM `"._USERS_TABLE."` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1");
            echo '<tr bgcolor="#ffffff">'."\n";
            $qs = base64_decode($getIPs['query_string']);
            $qs = str_replace("%20", " ", $qs);
            $qs = str_replace("/**/", "/* */", $qs);
            $qs = str_replace("&", "<br />&", $qs);
            $ua = $getIPs['user_agent'];
            echo "<td>".$getIPs['ip_addr']."</td>\n";
            $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
            echo '<td align="center">'.strtoupper($getIPs['c2c']).' - '.$countrytitleinfo['country'].'</td>'."\n";
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