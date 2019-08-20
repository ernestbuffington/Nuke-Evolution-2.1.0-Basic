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

    $totalselected = $db->sql_unumrows("SELECT `username`, `ip_addr`, `ip_long`, MAX(`date`), COUNT(*) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` GROUP BY 1,2,3");
    if($totalselected > 0) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n";
        $pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTTRACKEDIPS;
        if (!isset($modfilter)) {
            $modfilter='';
        }
        echo '<title>'.$pagetitle.'</title>'."\n";
        echo '</head>'."\n";
        echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
        echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
        echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
        echo '<tr bgcolor="#ffffff">'."\n";
        echo '<td><strong>'._AB_USER.'</strong></td>'."\n";
        echo '<td><strong>'._AB_IPADDRESS.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT `user_id`, `username`, `ip_addr`, `ip_long`, MAX(`date`), COUNT(*), MIN(`tid`), `c2c` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` $modfilter GROUP BY 2,3,4 ORDER BY `ip_addr`");
        while(list($userid,$username,$ipaddr,$ip_long,$lastview,$hits,$tid,$c2c) = $db->sql_fetchrow($result)){
            $countrytitleinfo = abget_countrytitle($c2c);
            echo '<tr bgcolor="#ffffff">'."\n";
            if ($userid != ANONYMOUS) {
                echo '<td>'.$username.'</td>'."\n";
            } else {
                echo '<td>'._ANONYMOUS.'</td>'."\n";
            }
            echo '<td>'.$ipaddr.'</td>'."\n";
            echo '<td align="center">'.strtoupper($c2c).' - '.$countrytitleinfo['country'].'</td>'."\n";
            echo '<td align="center">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
            echo '<td align="center">'.$hits.'</td>'."\n";
            echo '</tr>'."\n";
        }
        $db->sql_freeresult($result);
        echo '</table>'."\n";
        echo '</body>'."\n";
        echo '</html>';
        exit();
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