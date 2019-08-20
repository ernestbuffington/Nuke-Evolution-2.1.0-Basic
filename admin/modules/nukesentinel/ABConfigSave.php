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

global $admin_file, $db, $_GETVAR, $cache;

if (is_admin()) {

    $xblocker_row = $_GETVAR->get('xblocker_row', '_POST', 'array', array());
    $xop          = $_GETVAR->get('xop', '_REQUEST', 'string');
    if(!empty($xblocker_row['list'])) {
        if(!empty($xblocker_row['listadd'])) {
            $xblocker_row['list'] = $xblocker_row['list']."\r\n".$xblocker_row['listadd'];
        } else {
            $xblocker_row['list'] = $xblocker_row['list'];
        }
    } else {
      $xblocker_row['list'] = $xblocker_row['listadd'];
    }
    $xblocker_row['list'] = str_replace("<br />", "\r\n", $xblocker_row['list']);
    $xblocker_row['list'] = str_replace("<br />", "\r\n", $xblocker_row['list']);
    $block_list = explode("\r\n", $xblocker_row['list']);
    rsort($block_list);
    $endlist = count($block_list)-1;
    if (empty($block_list[$endlist])) {
        array_pop($block_list);
    }
    sort($block_list);
    $xblocker_row['list'] = implode("\r\n", $block_list);
    $xblocker_row['list'] = str_replace("\r\n\r\n", "\r\n", $xblocker_row['list']);
    $xblocker_row['duration'] = $xblocker_row['duration'] * 86400;
    $db->sql_uquery("UPDATE `"._SENTINEL_BLOCKERS_TABLE."` SET `activate`='".$xblocker_row['activate']."', `block_type`='".$xblocker_row['block_type']."', `email_lookup`='".$xblocker_row['email_lookup']."', `forward`='".$xblocker_row['forward']."', `reason`='".$xblocker_row['reason']."', `template`='".$xblocker_row['template']."', `duration`='".$xblocker_row['duration']."', `htaccess`='".$xblocker_row['htaccess']."', `list`='".$xblocker_row['list']."' WHERE `block_name`='".$xblocker_row['block_name']."'");
    $cache->delete('blockers', 'sentinel');
    $cache->resync();
    redirect($admin_file.'.php?op='.$xop);
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>