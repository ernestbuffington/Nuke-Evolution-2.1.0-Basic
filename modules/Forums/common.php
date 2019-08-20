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

if (!defined('MODULE_FILE') && !defined('FORUM_ADMIN') ) {
   die('You can\'t access this file directly...');
}

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

global $_GETVAR;
$_GETVAR->unsetVariables();

include_once(NUKE_FORUMS_DIR.'extension.inc');
$phpbb_root_path = NUKE_FORUMS_DIR;

//
// Define some basic configuration arrays this also prevents
// malicious rewriting of language and otherarray values via
// URI params
//
$userdata   = array();
$theme      = array();
$images     = array();
$lang       = array();
$nav_links  = array();
$dss_seeded = false;
$pc_dateTime = array();
$gen_simple_header = (isset($gen_simple_header) && ($gen_simple_header == TRUE) ? TRUE : FALSE);
if(!$directory_mode) {
    $directory_mode = 0777;
} else {
    $directory_mode = 0755;
}
if (!$file_mode) {
    $file_mode = 0666;
} else {
    $file_mode = 0644;
}
include_once(NUKE_INCLUDE_DIR.'template.php');
include_once(NUKE_INCLUDE_DIR.'auth.php');
include_once(NUKE_INCLUDE_DIR.'sessions.php');
include_once(NUKE_INCLUDE_DIR.'functions.php');

$client_ip = identify::get_ip();
$user_ip   = encode_ip($client_ip);

include_once($phpbb_root_path . 'attach_mod/attachment_mod.php');

if( $board_config['board_disable'] && !defined('IN_ADMIN') && !defined('IN_LOGIN') && ($board_config['board_disable_adminview'] && !is_mod_admin('Forums')) ) {
    if ( $board_config['board_disable_msg'] != '' ) {
        message_die(GENERAL_MESSAGE, $board_config['board_disable_msg'], 'Information');
    } else {
        message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
    }
}

?>