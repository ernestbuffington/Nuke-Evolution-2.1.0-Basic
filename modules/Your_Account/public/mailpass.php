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

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

global $db, $evoconfig, $board_config;
if (!empty($username) AND empty($user_email)) {
    $sql = "SELECT username, user_email, user_password, user_level FROM "._USERS_TABLE." WHERE username='$username'";
} elseif (empty($username) AND !empty($user_email)) {
    $sql = "SELECT username, user_email, user_password, user_level FROM "._USERS_TABLE." WHERE user_email='$user_email'";
} else {
    include_once(NUKE_BASE_DIR.'header.php');
// removed by menelaos dot hetnet dot nl
//      title(_USERREGLOGIN);
    Show_CNBYA_menu();
    OpenTable();
    echo "<center><span class='title'>"._YA_MUSTSUPPLY."</span></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}
$result = $db->sql_query($sql);
if($db->sql_numrows($result) == 0) {
    $db->sql_freeresult($result);
    include_once(NUKE_BASE_DIR.'header.php');

// removed by menelaos dot hetnet dot nl
//      title(_USERREGLOGIN);
    Show_CNBYA_menu();
    OpenTable();
    echo "<center><span class='title'>"._SORRYNOUSERINFO."</span></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {

    if ($evoconfig['servermail']) {
        $host_name = identify::get_ip();
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $user_name = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_level = $row['user_level'];
        if ($user_level > 0) {
            $areyou = substr($user_password, 0, 10);
            if ($areyou==$code) {
                $newpass = YA_MakePass();
                $message .= _USERACCOUNT." '$user_name' "._AT." ".EVO_SERVER_SITENAME." "._HASTHISEMAIL."  "._AWEBUSERFROM." $host_name "._HASREQUESTED."<br /><br />";
                $message .= _YOURNEWPASSWORD." $newpass<br /><br /> ";
                $message .= _YOUCANCHANGE."<br /><a href='".EVO_SERVER_URL."/modules.php?name=$module_name'>"._YA_ACTIVATE_CLICK."</a>";
                $message .= "  (".EVO_SERVER_URL."/modules.php?name=$module_name)<br /><br />"._IFYOUDIDNOTASK. '<br /><br />';
                $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                $subject = _USERPASSWORD4;
                if (!empty($username)) {
                    $subject .= " '$user_name'";
                } else if (!empty($user_email)) {
                    $subject .= " '$user_email'";
                }
                $to = $user_email.', '.$username;
                $return = evo_mail($to, $subject, $message);
                $cryptpass = EvoCrypt($newpass);
                if (!empty($username)) {
                    $query = "UPDATE "._USERS_TABLE." SET user_password='$cryptpass' WHERE username='$username'";
                } else if (!empty($user_email)) {
                    $query = "UPDATE "._USERS_TABLE." SET user_password='$cryptpass' WHERE user_email='$user_email'";
                }
                include_once(NUKE_BASE_DIR.'header.php');
                OpenTable();
                if (!$db->sql_uquery($query)) { echo "<center>"._UPDATEFAILED."</center><br />"; }
                echo "<center><strong>"._PASSWORD4." ";
                if (!empty($username)) { echo "'$user_name'"; } else if (!empty($user_email)) { echo "'$user_email'"; }
                echo " "._MAILED."</strong><br /><br /><a href=\"modules.php?name=$module_name\">"._LOGIN."</a></center>";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
            } else {
                $host_name = identify::get_ip();
                $row = $db->sql_fetchrow($result);
                $db->sql_freeresult($result);
                $areyou = substr($user_password, 0, 10);
                $message = _USERACCOUNT." '$user_name' "._AT." ".EVO_SERVER_SITENAME." "._HASTHISEMAIL." "._AWEBUSERFROM." $host_name "._CODEREQUESTED."<br /><br />";
                $message .= _YOURCODEIS." $areyou<br /><br />";
                $message .= _WITHTHISCODE."<br /><a href='".EVO_SERVER_URL."/modules.php?name=$module_name&amp;op=pass_lost'>"._YA_ACTIVATE_CLICK."</a>";
                $message .= "  (".EVO_SERVER_URL."/modules.php?name=$module_name&amp;op=pass_lost)<br /><br />";
                $message .= _IFYOUDIDNOTASK2 . '<br /><br />';
                $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                $subject = _CODEFOR;
                if (!empty($username)) {
                    $subject .= " '$user_name'";
                } else if (!empty($user_email)) {
                    $subject .= " '$user_email'";
                }
                $to = $user_email.', '.$username;
                $return = evo_mail($to, $subject, $message);
                include_once(NUKE_BASE_DIR.'header.php');
                OpenTable();
                echo "<center><strong>"._CODEFOR." ";
                if (!empty($username)) { echo "'$user_name'"; } else if (!empty($user_email)) { echo "'$user_email'"; }
                echo " "._MAILED."</strong><br /><br /><a href=\"modules.php?name=$module_name\">"._LOGIN."</a></center>";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
            }
        } elseif ($user_level == 0) {
            include_once(NUKE_BASE_DIR.'header.php');
            title(_USERREGLOGIN);
            OpenTable();
            echo "<center><span class='title'>"._ACCSUSPENDED."</span></center>\n";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        } elseif ($user_level == -1) {
            include_once(NUKE_BASE_DIR.'header.php');
            title(_USERREGLOGIN);
            OpenTable();
            echo "<center><span class='title'>"._ACCDELETED."</span></center>\n";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    } else {
        $db->sql_freeresult($result);
        include_once(NUKE_BASE_DIR.'header.php');
        title(_USERREGLOGIN);
        OpenTable();
        echo "<center>"._SERVERNOMAIL."</center>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

}

?>