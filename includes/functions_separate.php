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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

//
// Select topic to be suggested
//
function get_dividers($topics) {
    global $lang;

    $dividers      = array();
    $total_topics  = count($topics);
    $total_by_type = array (POST_GLOBAL_ANNOUNCE => 0, POST_ANNOUNCE => 0, POST_STICKY => 0, POST_NORMAL => 0);

    for ( $i=0; $i < $total_topics; $i++ ) {
        $total_by_type[$topics[$i]['topic_type']]++;
    }
    if ( ( $total_by_type[POST_GLOBAL_ANNOUNCE] + $total_by_type[POST_ANNOUNCE] + $total_by_type[POST_STICKY] ) != 0 ) {
        $count_topics = 0;
        $dividers[$count_topics] = $lang['Global_Announcements'];
        $count_topics += $total_by_type[POST_GLOBAL_ANNOUNCE];
        $dividers[$count_topics] = $lang['Announcements'];
        $count_topics += $total_by_type[POST_ANNOUNCE];
        $dividers[$count_topics] = $lang['Sticky_Topics'];
        $count_topics += $total_by_type[POST_STICKY];
        if ( $count_topics < $total_topics ) {
            $dividers[$count_topics] = $lang['Topics'];
        }
    }
    return $dividers;
}

?>