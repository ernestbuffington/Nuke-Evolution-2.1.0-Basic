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

if(defined('COUNTER')) {
    return;
}
define('COUNTER', 1);

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }


global $db, $browser, $agent, $add_count;

if($agent['engine'] == 'bot') {
    $browser = 'Bot';
} elseif(!empty($agent['ua'])) {
    $browser = $agent['ua'];
} else {
    $browser = 'Other';
}

if (!empty($agent['os'])) {
    $os = $agent['os'];
} else {
    $os = 'Other';
}

$now = explode('-',date('d-m-Y-H'));
$countsql = '';
$insertsql = '';
$insertfield = '';
if ( (is_array($add_count) && !empty($add_count)) && ($add_count['count'] == 1 )) {
    $result = $db->sql_uquery('UPDATE '._COUNTER_TABLE." SET count=count+1 WHERE (var='$browser' AND type='browser') OR (var='$os' AND type='os') OR (type='total' AND var='hits')");
    $insertfield = ", members, guests, bots, total";
    switch ($add_count['who']) {
        case 3:
            $countsql = ', bots=bots+1, total=total+1'; // bot
            $insertsql = ", '0', '0', '1', '1'";
            break;
        case 2:
            $countsql = ', guests=guests+1, total=total+1'; // not defined at the moment so we count it to guests
            $insertsql = ", '0', '1', '0', '1'";
            break;
        case 1:
            $countsql = ', guests=guests+1, total=total+1'; // guest
            $insertsql = ", '0', '1', '0', '1'";
            break;
        case 0:
            $countsql = ', members=members+1, total=total+1'; // member
            $insertsql = ", '1', '0', '0', '1'";
            break;
    }
    $is_row = $db->sql_unumrows('SELECT hits from '._STATS_HOUR_TABLE." WHERE year = '$now[2]' AND month = '$now[1]' AND date = '$now[0]' AND hour = '$now[3]'");
    if ( $is_row > 0 ) {
        $db->sql_uquery('UPDATE '._STATS_HOUR_TABLE." set hits = hits+1 ".$countsql." WHERE year = '$now[2]' AND month = '$now[1]' AND date = '$now[0]' AND hour = '$now[3]'");
    } else {
        $db->sql_uquery('INSERT IGNORE INTO '._STATS_HOUR_TABLE." (year, month, date, hour, hits ".$insertfield.") VALUES ('$now[2]','$now[1]','$now[0]','$now[3]','1' ".$insertsql.")");
    }
}

?>