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

// User
function get_bm_page_php($page_id) {
    if ( $page_id <= '0' ) {
        switch( $page_id ) {
            case PAGE_INDEX:
                $location_url = 'index.php?';
                break;
            case PAGE_POSTING:
                $location_url = 'index.php?';
                break;
            case PAGE_LOGIN:
                $location_url = 'index.php?';
                break;
            case PAGE_SEARCH:
                $location_url = 'search.php?';
                break;
            case PAGE_PROFILE:
                $location_url = 'index.php?';
                break;
            case PAGE_VIEWONLINE:
                $location_url = 'viewonline.php?';
                break;
            case PAGE_VIEWMEMBERS:
                $location_url = 'memberlist.php?';
                break;
            case PAGE_PRIVMSGS:
                $location_url = 'privmsg.php?';
                break;
            case PAGE_FAQ:
                $location_url = 'faq.php?';
                break;
            default:
                $location_url = 'index.php?';
        }
    } else {
        $location_url = 'viewforum.php?f=' . $page_id . '&amp;';
    }
    return $location_url;
}

function get_boardmsg_sql($pagephp, $usertimezone) {
    global $db, $board_config, $userdata;

    $addtime = doubleval($usertimezone)*3600;
    $posdays = create_date('w', time(), $board_config['board_timezone']) + 1;
    $sql = "SELECT msg_id, title, message, showpage , auth, width, images, ordr, bbcode_uid, startdate, enddate, starttime, endtime, users_timezone 
            FROM " . BOARD_MSG_TABLE . "
            WHERE ((showpage <> '-9999'
            AND showpage = '" . $pagephp . "' )
            OR showpage = '9999')
            AND MID(days,$posdays,1) = '1'
            ";
    if (is_admin()) {
        $sql .= " AND auth <= " . AUTH_ADMIN;
    } elseif (is_mod_admin('Forums')) {
        $sql .= " AND auth <= " . AUTH_MOD;
    } elseif ( is_user() ) {
        $sql .= " AND auth <= " . AUTH_REG;
    } else {
        $sql .= " AND auth = " . AUTH_ALL;
    }
    //
    // Date
    //
    $temp   = intval($board_config['board_timezone']);
    $bmPrae = ($temp < 0) ? '' : '+';
    $boarddate = strtotime ($bmPrae . $temp . " hour");
    $sql .= " AND startdate <= " . $boarddate . " AND enddate >= " . $boarddate;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Tried obtaining data. It failed', '', __LINE__, __FILE__, $sql);
    }
    if ( $row = $db->sql_fetchrow($result) ) {
        if ( $row['starttime'] != $row['endtime'] ) {
            $cur_hour = date ( 'H', time() );
            $cur_min = date ( 'i', time() );
            $board_curtime = mktime ( $cur_hour, $cur_min, 0, 1, 1, 2000 );
            $sql .= " AND starttime <= " . $board_curtime . " AND endtime >= " . $board_curtime;
        }
    }
    $db->sql_freeresult($result);
    return $sql;
}

?>