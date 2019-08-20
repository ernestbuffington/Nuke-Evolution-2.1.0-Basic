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

function log_action($action, $new_topic_id, $topic_id, $user_id, $forum_id, $new_forum_id) {
    global $db, $userdata;
    if (!isset($userdata['user_id']) || empty($userdata['user_id'])) {
        return;
    }
    if ( $action == 'split' ) {
        $where = "WHERE topic_id = '$new_topic_id'";
    } else {
        $where = "WHERE topic_id = '$topic_id'";
    }
    $sql = "SELECT topic_last_post_id
            FROM ". TOPICS_TABLE ."
            $where";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get topic_last_post_id', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $last_post_id = $row['topic_last_post_id'];
    $db->sql_freeresult($result);
    $user_ip    = encode_ip($userdata['user_ip']);
    $username   = $userdata['username'];
    $user_id    = $userdata['user_id'];
    $time = time();
    $sql = "INSERT INTO " . LOGS_TABLE . " (mode, topic_id, user_id, username, user_ip, time, new_topic_id, forum_id, new_forum_id, last_post_id)
            VALUES ('$action', '$topic_id', '$user_id', '$username', '$user_ip', '$time', '$new_topic_id', '$forum_id', '$new_forum_id', '$last_post_id')";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not insert data into logs table', '', __LINE__, __FILE__, $sql);
    }
    $db->sql_freeresult($result);
}

function prune_logs($prune_days) {
    global $db;

    $prune = time() - ( $prune_days * 86400 );
    $sql = "SELECT log_id
            FROM " . LOGS_TABLE . "
            WHERE time < $prune ";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not obtain list of logs to prune', '', __LINE__, __FILE__, $sql);
    }
    $logs = '';
    while ( $row = $db->sql_fetchrow($result) ) {
        $logs .= ( ( $logs != '' ) ? ', ' : '' ) . $row['log_id'];
    }
    $db->sql_freeresult($result);
    if ( $logs != '' ) {
        $sql = "DELETE FROM " . LOGS_TABLE . "
                WHERE log_id IN ($logs)";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not delete logs', '', __LINE__, __FILE__, $sql);
        }
        return TRUE;
    }
}

function auto_prune_logs() {
    global $db;
    // To do
}

?>