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

if (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    'cookies' => 'admin/board_config/board_cookies.tpl')
);

$cookie_secure_yes = ( $new['cookie_secure'] ) ? 'checked="checked"' : '';
$cookie_secure_no = ( !$new['cookie_secure'] ) ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_COOKIE_SETTINGS'         => $lang['Cookie_settings'],
    'L_COOKIE_SETTINGS_EXPLAIN' => $lang['Cookie_settings_explain'],
    'L_COOKIE_DOMAIN'           => $lang['Cookie_domain'],
    'L_COOKIE_NAME'             => $lang['Cookie_name'],
    'L_COOKIE_PATH'             => $lang['Cookie_path'],
    'L_COOKIE_SECURE'           => $lang['Cookie_secure'],
    'L_COOKIE_SECURE_EXPLAIN'   => $lang['Cookie_secure_explain'],
    'L_SESSION_LENGTH'          => $lang['Session_length'],
));

//Data Template Variables
$template->assign_vars(array(
    'COOKIE_DOMAIN'             => $new['cookie_domain'],
    'COOKIE_NAME'               => $new['cookie_name'],
    'COOKIE_PATH'               => $new['cookie_path'],
    'SESSION_LENGTH'            => $new['session_length'],
    'S_COOKIE_SECURE_ENABLED'   => $cookie_secure_yes,
    'S_COOKIE_SECURE_DISABLED'  => $cookie_secure_no,
 ));
$template->pparse('cookies');

?>