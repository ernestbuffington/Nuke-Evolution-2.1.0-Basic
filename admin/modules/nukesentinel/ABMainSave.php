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

global $admin_file, $_GETVAR;

if (is_god_admin()) {

    $xadmin_contact         = $_GETVAR->get('xadmin_contact', '_POST', 'string');
    $xblock_perpage         = $_GETVAR->get('xblock_perpage', '_POST', 'int');
    $xblock_sort_column     = $_GETVAR->get('xblock_sort_column', '_POST', 'string');
    $xblock_sort_direction  = $_GETVAR->get('xblock_sort_direction', '_POST', 'string');
    $xcrypt_salt            = $_GETVAR->get('xcrypt_salt', '_POST', 'string');
    $xdisable_switch        = $_GETVAR->get('xdisable_switch', '_POST', 'int');
    $xdisplay_link          = $_GETVAR->get('xdisplay_link', '_POST', 'string');
    $xdisplay_reason        = $_GETVAR->get('xdisplay_reason', '_POST', 'int');
    $xdump_directory        = $_GETVAR->get('xdump_directory', '_POST', 'string');
    $xflood_delay           = $_GETVAR->get('xflood_delay', '_POST', 'int');
    $xforce_nukeurl         = $_GETVAR->get('xforce_nukeurl', '_POST', 'int');
    $xftaccess_path         = $_GETVAR->get('xftaccess_path', '_POST', 'string');
    $xhelp_switch           = $_GETVAR->get('xhelp_switch', '_POST', 'int');
    $xhtaccess_path         = $_GETVAR->get('xhtaccess_path', '_POST', 'string');
    $xhttp_auth             = $_GETVAR->get('xhttp_auth', '_POST', 'int');
    $xlookup_link           = $_GETVAR->get('xlookup_link', '_POST', 'string');
    $xpage_delay            = $_GETVAR->get('xpage_delay', '_POST', 'int');
    $xprevent_dos           = $_GETVAR->get('xprevent_dos', '_POST', 'int');
    $xproxy_reason          = $_GETVAR->get('xproxy_reason', '_POST', 'string');
    $xproxy_switch          = $_GETVAR->get('xproxy_switch', '_POST', 'string');
    $xsanty_protection      = $_GETVAR->get('xsanty_protection', '_POST', 'int');
    $xself_expire           = $_GETVAR->get('xself_expire', '_POST', 'int');
    $xshow_right            = $_GETVAR->get('xshow_right', '_POST', 'int');
    $xsite_reason           = $_GETVAR->get('xsite_reason', '_POST', 'string');
    $xsite_switch           = $_GETVAR->get('xsite_switch', '_POST', 'int');
    $xstaccess_path         = $_GETVAR->get('xstaccess_path', '_POST', 'string');
    $xtest_switch           = $_GETVAR->get('xtest_switch', '_POST', 'int');
    $xtrack_active          = $_GETVAR->get('xtrack_active', '_POST', 'int');
    $xtrack_max             = $_GETVAR->get('xtrack_max', '_POST', 'int');
    $xtrack_perpage         = $_GETVAR->get('xtrack_perpage', '_POST', 'int');
    $xtrack_sort_column     = $_GETVAR->get('xtrack_sort_column', '_POST', 'string');
    $xtrack_sort_direction  = $_GETVAR->get('xtrack_sort_direction', '_POST', 'string');

    if (!isset($xpage_delay)) {
        $xpage_delay = 5;
    }
    $xadmin_contact = str_replace("<br />", "\r\n", $xadmin_contact);
    $xadmin_contact = str_replace("<br />", "\r\n", $xadmin_contact);
    $admin_list = explode("\r\n", $xadmin_contact);
    sort($admin_list);
    $xadmin_contact = implode("\r\n", $admin_list);
    absave_config('admin_contact',$xadmin_contact);
    absave_config('block_perpage',$xblock_perpage);
    absave_config('block_sort_column',$xblock_sort_column);
    absave_config('block_sort_direction',$xblock_sort_direction);
    absave_config('crypt_salt',$xcrypt_salt);
    absave_config('disable_switch',$xdisable_switch);
    absave_config('display_link',$xdisplay_link);
    absave_config('display_reason',$xdisplay_reason);
    absave_config('dump_directory',$xdump_directory);
    absave_config('flood_delay',$xflood_delay);
    absave_config('force_nukeurl',$xforce_nukeurl);
    absave_config('ftaccess_path',$xftaccess_path);
    absave_config('help_switch',$xhelp_switch);
    absave_config('htaccess_path',$xhtaccess_path);
    absave_config('http_auth',$xhttp_auth);
    absave_config('lookup_link',$xlookup_link);
    absave_config('page_delay',$xpage_delay);
    absave_config('prevent_dos',$xprevent_dos);
    absave_config('proxy_reason',$xproxy_reason);
    absave_config('proxy_switch',$xproxy_switch);
    absave_config('santy_protection',$xsanty_protection);
    absave_config('self_expire',$xself_expire);
    absave_config('show_right',$xshow_right);
    absave_config('site_reason',$xsite_reason);
    absave_config('site_switch',$xsite_switch);
    absave_config('staccess_path',$xstaccess_path);
    absave_config('test_switch',$xtest_switch);
    absave_config('track_active',$xtrack_active);
    absave_config('track_max',$xtrack_max);
    absave_config('track_perpage',$xtrack_perpage);
    absave_config('track_sort_column',$xtrack_sort_column);
    absave_config('track_sort_direction',$xtrack_sort_direction);
    redirect($admin_file.'.php?op=ABMain');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>