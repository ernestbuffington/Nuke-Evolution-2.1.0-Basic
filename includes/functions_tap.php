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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }


define('TAP_PREFIX', 'Evo-');
define('TAP_SCOPE','[a-z0-9_-]');

global $evoconfig;

/*==========================================================================
  $lazy_tap = 0;  = Tap Off
  $lazy_tap = 1;  = Bots ONLY see the tap
  $lazy_tap = 2;  = Everyone sees the tap
  $lazy_tap = 3;  = Admin's only see the tap && bots
  ==========================================================================*/

function tap($buffer) {
    $buffer = str_replace('&&', '&',$buffer);
    $find = array('/("|\')index.php("|\')/','/("|\')modules.php\?name=('.TAP_SCOPE.'+)("|\')/i');
    $base = '/("|\')modules.php\?name=('.TAP_SCOPE.'+)';
    $add = '(&|&amp;|&&|&amp;&amp;)('.TAP_SCOPE.'+)=('.TAP_SCOPE.'+)';
    $close = '("|\')/i';
    $close2 = '\#('.TAP_SCOPE.'+)("|\')/i';
    for ($i = 1; $i < 5; $i++) {
        $combined = $base;
        for ($j = 0; $j < $i; $j++) {
            $combined .= $add;
        }
        $find[] = $combined . $close;
        $find[] = $combined . $close2;
    }

    $replace = array('$1'.TAP_PREFIX.'index.html$2','$1'.TAP_PREFIX.'$2.html$3');
    $base = '$1'.TAP_PREFIX.'$2';
    $close = '.html';
    $close2 = '.html#';
    for ($i = 2; $i < 6; $i++) {
        $combined = $base;
        for ($j = 4; $j < ($i * 3); $j = $j + 3) {
            $combined .= '_-_$'.$j.'_-_$'.($j+1);
            $last = $j + 2;
        }
        $replace[] = $combined . $close . '$' . $last;
        $replace[] = $combined . $close2 . '$' . $last . '$' . ($last+1);
    }

    //$buffer = preg_replace('/"modules.php\?name=([a-z0-9]+)&amp;([a-z0-9]+)=([a-z0-9]+)&amp;([a-z0-9]+)=([a-z0-9]+)"/i','="modules_name_$1_$2_$3_$4_$5.html"',$buffer);
    $buffer = preg_replace($find,$replace,$buffer);
    return $buffer;
}

$user_agent = identify::identify_agent();

$tap_fire = 0;
if(($evoconfig['lazy_tap'] == 1 || $evoconfig['lazy_tap'] == 3) && !defined('ADMIN_FILE')) {
    if($user_agent['engine'] == 'bot') {
        $tap_fire = 1;
    } else if(is_admin() && $evoconfig['lazy_tap'] == 3) {
        $tap_fire = 1;
    }
} else if ($evoconfig['lazy_tap'] == 2) {
    $tap_fire = 1;
}

if($tap_fire && !defined('ADMIN_FILE')) {
    ob_start("tap");
}

?>