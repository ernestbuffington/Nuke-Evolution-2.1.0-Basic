<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		#$#BASE
 Nuke-Evo Version       :		#$#VER
 Nuke-Evo Build         :		#$#BUILD
 Nuke-Evo Patch         :		#$#PATCH
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		#$#DATE
 Nuke-Evo Author        :   ReOrGaNiSatiOn

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

if (!defined('MODULE_FILE')) {
   die('You can\´t access this file directly');;
}

define('IN_PHPBB', TRUE);
global $_GETVAR;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

$redirect   = $_GETVAR->get('redirect', '_REQUEST');
$forward_to = $_GETVAR->get('QUERY_STRING', '_SERVER', 'string');
// SPOD (Single Point of Definition) -> we only login through Your_Account
// get Informations to be set for redirecting after login
// Code is original from phpBB login.php (c) 2001 The phpBB Group
$forward_page = '';

if( $redirect ) {
    if( preg_match("/^redirect=([a-z0-9\.#\/\?&=\+\-_]+)/si", $forward_to, $forward_matches) ) {
        $forward_to = ( !empty($forward_matches[3]) ) ? $forward_matches[3] : $forward_matches[1];
        $forward_match = explode('&', $forward_to);

        if(count($forward_match) > 1) {
            for($i = 1; $i < count($forward_match); $i++) {
                if( !preg_match('#sid=#', $forward_match[$i]) ) {
                    if( $forward_page != '' ) {
                        $forward_page .= '&';
                    }
                    $forward_page .= $forward_match[$i];
                }
            }
            $forward_page = $forward_match[0] . '?' . $forward_page;
        } else {
            $forward_page = $forward_match[0];
        }
    }
}

redirect('modules.php?name=Your_Account&amp;redirect=' . $forward_page);

?>