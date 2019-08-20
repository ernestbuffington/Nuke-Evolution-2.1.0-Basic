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

if (defined('PHPBB_BOARD_CONFIG')) {
    if( !empty($setmodules) ) {
        $filename = basename(__FILE__);
        $module['General']['Avatar_Management'] = $filename;
        return;
    }
}

global $_GETVAR, $bgcolor1, $bgcolor2;

$lang_file = '/lang_admin_avatar.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

// Any mode passed?
$mode   = $_GETVAR->get('mode', 'post', 'string');
$target = $_GETVAR->get('target', 'post', 'string');
$mode   = ( isset($mode) ) ? $mode : '';
$target = ( isset($target) ) ? $target : '';

// Select all avatars and usernames that have an uploaded avatar currently
$sql = "SELECT user_id, username, user_avatar FROM " . USERS_TABLE . "
    WHERE user_avatar_type = " . USER_AVATAR_UPLOAD . " AND user_avatar IS NOT NULL";
if(!$result = $db->sql_query($sql)) {
    $error = $db->sql_error();
    die($lang['Avatar_Error_noinfo'] ." $error[code] : $error[message]");
}

// Create a hash to keep track of all the user that is using the uploaded avatar
while ($avatar_rowset = $db->sql_fetchrow($result)) {
    $avatar_usage[$avatar_rowset[user_avatar]] = $avatar_rowset[username];
}

// This is the variable that points to the path of the avatars
// You may need to ajust this to meet your needs ;)
$real_avatar_dir = NUKE_BASE_DIR . $board_config['avatar_path'];
$real_avatar_picdir = NUKE_HREF_BASE_DIR . $board_config['avatar_path'];
echo "<h1>". $lang['Avatar_Manage'] ."</h1>";
echo "<p>". $lang['Avatar_Comments'] ."</p>";
switch( $mode ) {
    case "delete":
        echo '<table cellpadding=4 cellspacing=1 border=0 class=forumline>';
        if ( @unlink($real_avatar_dir.'/'.$target) ) {
            print "<tr><td>". $lang['Avatar_Success'] ." $target ". $lang['Avatar_Deleted'] ."</td></tr><tr><td><a href=\"admin_avatar.php\">". $lang['Avatar_Continue'] ."</a></td></tr></table>";
        } else {
            print "<tr><td>". $lang['Avatar_Failed'] ." $target!</td></tr><tr><td><a href=javascript:history.go(-1)>". $lang['Avatar_Back'] ."</a></td></tr></table>";
        }
        break;
    default:
        echo '<table cellpadding=4 cellspacing=1 border=0 class=forumline>
                <tr>
                    <th class="row1" width=40%>'. $lang['Avatar'] .'</th>
                    <th class="row1" width=20%>'. $lang['Avatar_Size'] .'</th>
                    <th class="row1" width=20%>'. $lang['Avatar_Usage'] .'</th>
                    <th class="row1" width=20%>'. $lang['Avatar_Edit_User'] .'</th>
                </tr>';
        // This is where we go through the avatar directory and report whether they are not
        // used or if they are used, by who.
        if ($avatar_dir = @opendir($real_avatar_dir)) {
            while( $file = @readdir($avatar_dir) ) {
                // This is where the script will filter out any file that doesn't match the patterns
                if( preg_match("#\.(gif|jpg|jpeg|png)$#",$file) ) {
                    $stats = stat($real_avatar_dir.'/'.$file);
                    // Alternating row colows code
                    if (isset($avatar_usage[$file]) ) {
                        // Since we need to supply a link with a valid sid later in html, let's build it now
                        $av_id = $avatar_usage[$file];
                        $avatar_usage[$file] = UsernameColor($avatar_usage[$file]);
                        $sql = "SELECT user_id FROM " . USERS_TABLE . "
                                WHERE username = '$av_id'";
                        if(!$result = $db->sql_query($sql)) {
                            $error = $db->sql_error();
                            die($lang['Avatar_Error_noinfo'] ."$error[code] : $error[message]");
                        }
                        $av_uid = $db->sql_fetchrow($result);
                        $avatar_uid = $av_uid['user_id'];
                        $edit_url = admin_sid('admin_users.php&amp;mode=edit&amp;u='.$avatar_uid);
                        // Bingo, someone is using this avatar
                        print "<tr><td class='row2'><img src=$real_avatar_picdir/$file /><br />$file</td>
                               <td class='row2'>$stats[7] ". $lang['Avatar_Bytes'] ."</td>
                               <td class='row2'>$avatar_usage[$file]</td>
                               <td class='row2'><a href=\"$edit_url\"> ". $lang['Avatar_Edit'] ." $avatar_usage[$file]</a></td></tr>\n";
                    } else {
                        // Not used, safe to display delete link for admin
                        $delete_html = admin_sid('admin_avatar.php&amp;mode=delete&amp;target='.$file);
                        print "<tr><td class='row2'><img src=$real_avatar_picdir/$file /><br />$file</td>
                               <td class='row2'>$stats[7] ". $lang['Avatar_Bytes'] ."</td>
                               <td class='row2'>". $lang['Avatar_Not_Used'] ."<br /><a href=$delete_html onclick=\"if(confirm('". $lang['Avatar_Delete_Sure'] ." $file ?')) return true; else return false;\">". $lang['Avatar_Delete'] ."</a></td>
                               <td class='row2'>&nbsp;</td>
                               </tr>\n";
                    }
                }
            }
        } else {
            // If we made it to this else there was a problem trying to read the avatar directory
            // If you see this error message check this variable:
            // $real_avatar_dir -> This may be set incorrectly for your site.
            print $lang['Avatar_Directory_Unavailable'];
        }
        echo '</table>';
        break;
}
include_once(NUKE_FORUMS_ADMIN_DIR.'page_footer_admin.php');

?>