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

if (!defined('MODULE_FILE') && !defined('ADMIN_FILE')) {
   die ("You can't access this file directly...");
}

define('IN_PHPBB', true);

include_once(NUKE_INCLUDE_DIR."bbcode.php");
include_once(NUKE_INCLUDE_DIR."functions_post.php");

//PM Sign Up
function change_post_msg($message,$ya_username)
{
       $message = str_replace("%NAME%", $ya_username, $message);

       return $message;
}

//PM Sign Up
function send_pm($new_uid,$ya_username)
{
    global $db, $board_config;

    if($board_config['welcome_pm'] != '1') { return; }

    $privmsgs_date = time();

    $sql = "SELECT * FROM "._WELCOME_PM_TABLE;

    if ( !($result = $db->sql_query($sql)) )
    {
           echo "Could not obtain private message";
    }
    $row = $db->sql_fetchrow($result);
    $message = $row['msg'];
    $subject = $row['subject'];
    if(empty($message) || empty($subject)) {
        return;
    }
    $message = change_post_msg($message,$ya_username);
    $subject = change_post_msg($subject,$ya_username);
    $bbcode_uid = make_bbcode_uid();
    $privmsg_message = prepare_message($message, 1, 1, 1, $bbcode_uid);
    $sql = "INSERT INTO ".PRIVMSGS_TABLE." (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date ) VALUES ('1', '".$subject."', '2', '".$new_uid."', ".$privmsgs_date.")";
    if ( !$db->sql_query($sql) )
    {
       echo "Could not insert private message sent info";
    }

    $privmsg_sent_id = $db->sql_nextid();
    $privmsg_message = addslashes($privmsg_message);

    $sql = "INSERT INTO ".PRIVMSGS_TEXT_TABLE." (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text) VALUES ('".$privmsg_sent_id."', '".$bbcode_uid."', '".$privmsg_message."')";

    if ( !$db->sql_query($sql) )
    {
       echo "Could not insert private message sent text";
    }

    $sql = "UPDATE "._USERS_TABLE."
            SET user_new_privmsg = user_new_privmsg + 1,  user_last_privmsg = '" . time() . "'
            WHERE user_id = $new_uid";
    if ( !($result = $db->sql_query($sql)) )
    {
         echo "Could not update users table";
    }

}

?>