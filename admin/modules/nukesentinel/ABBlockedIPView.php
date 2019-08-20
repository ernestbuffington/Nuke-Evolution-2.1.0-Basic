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
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_VIEWIP);
    mastermenu();
    CarryMenu();
    blockedipmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` WHERE `ip_addr`='$xIPs' LIMIT 0,1");
    $getIPs['date'] = date("Y-m-d H:i:s",$getIPs['date']);
    list($getIPs['reason']) = $db->sql_ufetchrow("SELECT `reason` FROM `"._SENTINEL_BLOCKERS_TABLE."` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1");
    $lookupip = str_replace("*", "0", $xIPs);
    $getIPs['query_string'] = base64_decode($getIPs['query_string']);
    $getIPs['query_string'] = str_replace("%20", " ", $getIPs['query_string']);
    $getIPs['query_string'] = str_replace("/**/", "/* */", $getIPs['query_string']);
    $getIPs['get_string']   = base64_decode($getIPs['get_string']);
    $getIPs['get_string']   = str_replace("%20", " ", $getIPs['get_string']);
    $getIPs['get_string']   = str_replace("/**/", "/* */", $getIPs['get_string']);
    $getIPs['post_string']  = base64_decode($getIPs['post_string']);
    $getIPs['post_string']  = str_replace("%20", " ", $getIPs['post_string']);
    $getIPs['post_string']  = str_replace("/**/", "/* */", $getIPs['post_string']);
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_BLOCKEDIP.':</strong></td><td><a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$xIPs.'</a></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_USER.':</strong></td><td>'.UsernameColor($getIPs['username']).'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_AGENT.':</strong></td><td>'.$getIPs['user_agent'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_BLOCKEDON.':</strong></td><td>'.$getIPs['date'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td>'.$getIPs['notes'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REASON.':</strong></td><td>'.$getIPs['reason'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'" colspan="2">&nbsp;</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_QUERY.':</strong></td><td>'.evo_info_img("<strong>"._AB_QUERY.":</strong> ".$getIPs['query_string']).'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_GET.':</strong></td><td>'.evo_info_img("<strong>"._AB_GET.":</strong> ".$getIPs['get_string']).'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_POST.':</strong></td><td>'.evo_info_img("<strong>"._AB_POST.":</strong> ".$getIPs['post_string']).'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_X_FORWARDED.':</strong></td><td>'.$getIPs['x_forward_for'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_CLIENT_IP.':</strong></td><td>'.$getIPs['client_ip'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_ADDR.':</strong></td><td>'.$getIPs['remote_addr'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_PORT.':</strong></td><td>'.$getIPs['remote_port'].'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REQUEST_METHOD.':</strong></td><td>'.$getIPs['request_method'].'</td></tr>'."\n";
    echo '<tr><td align="center" colspan="2">'._GOBACK.'</td></tr>'."\n";
    echo '</table>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}
?>