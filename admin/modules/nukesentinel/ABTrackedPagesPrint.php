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

global $admin_file, $db, $bgcolor2;

if (is_admin()) {
    $tid      = $_GETVAR->get('tid', '_GET', 'int');
    $user_id  = $_GETVAR->get('user_id', '_GET', 'int');
    $totalselected = $db->sql_unumrows("SELECT `tid`, `page`, `date` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `ip_addr`='$ip_addr' AND `user_id`='$user_id'");
    if($totalselected > 0) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n";
        $pagetitle = _AB_NUKESENTINEL.": "._AB_PAGETRACKING;
        echo '<title>'.$pagetitle.'</title>'."\n";
        echo '</head>'."\n";
        echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
        echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
        list($ip_long) = $db->sql_ufetchrow("SELECT `ip_long` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `user_id`='$user_id' AND `ip_addr`='$ip_addr' LIMIT 0,1");
        echo '<center><strong>'.$ip_addr.' ('.$ip_long.')</strong></center><br />'."\n";
        echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
        echo '<tr bgcolor="#ffffff">'."\n";
        echo '<td><strong>'._AB_PAGEVIEWED.'</strong></td>'."\n";
        echo '<td><strong>'._AB_DATE.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT `tid`, `page`, `date` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `ip_addr`='$ip_addr' AND `user_id`='$user_id' ORDER BY `page`");
        while(list($ltid, $page, $date_time) = $db->sql_fetchrow($result)){
            $page = wordwrap($page, 50, "\n", true);
            $page = str_replace("&amp;amp;", "&amp;", $page);
            $page = str_replace("\n", "<br />\n", $page);
            echo '<tr bgcolor="#ffffff">'."\n";
            echo '<td>'.$page.'</td>'."\n";
            echo '<td>'.date("Y-m-d \@ H:i:s",$date_time).'</td>'."\n";
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
        echo '<center><strong>'._AB_NOPAGES.'</strong></center>'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>