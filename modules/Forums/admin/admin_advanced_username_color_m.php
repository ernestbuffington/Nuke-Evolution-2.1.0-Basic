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
        $module['AUC']['Management']     = $filename;
        return;
    }
}

global $_GETVAR;

$lang_file = '/lang_auc.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

$modus = $_GETVAR->get('mode', 'request', 'string', 'main');
$link  = admin_sid('admin_advanced_username_color_m.php');

function color_main() {
    global $db, $lang, $link;
    echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
    echo "    <tr>";
    echo "        <th class='thHead' colspan='2'>";
    echo "            ". $lang['admin_main_header_m'];
    echo "        </th>";
    echo "    </tr>";
    echo "</table>";
    echo "<br /><br />";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='100%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['choose_group'];
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<form name='choose_group' action='$link' method='post'>";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='left' valign='top' width='50%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['choose_group_2'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='50%' class='row2'>";
    echo "            <select name='group'>";
    echo "                <option selected value=''>". $lang['choose_group_3'] ."</option>";
    $q = "SELECT * FROM ". AUC_TABLE ." WHERE group_id > '0' ORDER BY group_weight ASC";
    $r            = $db->sql_query($q);
    while($row    = $db->sql_fetchrow($r)) {
      $name   = $row['group_name'];
      $id     = $row['group_id'];
      echo "                <option value='". $id ."'>$name</option>";
    }
    $db->sql_freeresult($r);
    echo "            </select>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<br />";
    echo "<table border='0' align='center' valign='top'>";
    echo "    <tr>";
    echo "        <td align='center' valign='middle' width='100%' class='row2'>";
    echo "            <input type='hidden' name='mode' value='select_group' />";
    echo "            <input type='submit' class='mainoption' value='". $lang['choose_group_4'] ."' onchange='document.choose_group.submit()' />";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "</form>";
    echo "<br /><br />";
}

function select_group($group) {
    global $db, $lang, $link;
    $row     = $db->sql_ufetchrow("SELECT * FROM ". AUC_TABLE ." WHERE group_id = '". $group ."'");
    $name    = $row['group_name'];
    $id      = $row['group_id'];
    $color   = $row['group_color'];
    echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
    echo "    <tr>";
    echo "        <th class='thHead' colspan='2'>";
    echo "            ". $lang['admin_main_header_m'];
    echo "        </th>";
    echo "    </tr>";
    echo "</table>";
    echo "<br /><br />";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='100%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". str_replace("%G%", $name, $lang['group_selected']);
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<br />";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['group_already_assigned'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";
    echo "                <select name=''>";
    $r = $db->sql_query("SELECT username FROM ". USERS_TABLE ." WHERE user_color_gi REGEXP  '(".$group.")' AND user_active >0 ORDER BY username ASC");
    while($row    = $db->sql_fetchrow($r)) {
            echo "                <option value=''>". $row['username'] ."</option>";
    }
    $db->sql_freeresult($r);
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
    echo "<form name='add_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['goup_group'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";
    $groups = $db->sql_ufetchrowset("SELECT group_id, group_name
          FROM ". GROUPS_TABLE ."
          WHERE group_id > 0
          AND group_description <> 'Personal User'
          ORDER BY group_id ASC");
    echo "                <select name='group_id'>";
    echo '                    <option selected value="" class="post">----------</option>';
    $cgr = count($groups);
    for ($x = 0; $x < $cgr; $x++) {
            $group_id = intval($groups[$x]['group_id']);
            echo '<option value="'. $group_id .'" class="post">'. $groups[$x]['group_name'] .'</option>';
    }
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo '    </tr>';
    echo "        <td align='center' valign='middle' width='100%' class='row2' colspan='3'>";
    echo "            <input type='hidden' name='mode' value='add_group' />";
    echo "            <input type='hidden' name='group' value='". $id ."' />";
    echo "            <input type='hidden' name='color' value='". $color ."' />";
    echo "            <input type='submit' class='mainoption' value='". $lang['group_assign_1'] ."' onchange='document.add_group.submit()' />";
    echo "        </td>";
    echo "</form>";
    echo "<form name='add_to_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['group_assign'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";
    $users = $db->sql_ufetchrowset("SELECT username, user_id
          FROM ". USERS_TABLE ."
          WHERE user_color_gi NOT REGEXP  '(".$group.")'
          ORDER BY username ASC");
    echo "                <select name='users_id'>";
    echo '                    <option selected value="" class="post">----------</option>';
    $cus = count($users);
    for ($x = 0; $x < $cus; $x++) {
            echo '<option value="'. intval($users[$x]['user_id']) .'" class="post">'. $users[$x]['username'] .'</option>';
    }
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td align="left" class="row2">';
    echo '            <span class="genmed">';
    echo '                '. $lang['group_assign_2'];
    echo '            </span>';
    echo '        </td>';
    echo '        <td align="center" class="row2" colspan="2">';
    echo '            <span class="genmed">';
    echo '                <textarea name="multi_users" class="post" rows="15" cols="40"></textarea>';
    echo '            </span>';
    echo '        </td>';
    echo '    </tr>';
    echo '    <tr>';
    echo "        <td align='center' valign='middle' width='100%' class='row2' colspan='3'>";
    echo "            <input type='hidden' name='mode' value='add_user' />";
    echo "            <input type='hidden' name='group' value='". $id ."' />";
    echo "            <input type='hidden' name='color' value='". $color ."' />";
    echo "            <input type='submit' class='mainoption' value='". $lang['group_assign_1'] ."' onchange='document.add_to_group.submit()' />";
    echo "        </td>";
    echo "    </tr>";
    echo "</form>";
    echo "<form name='delete_from_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['group_delete_user'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                <select name='delete'>";
    $q = "SELECT username, user_id, user_color_gi
          FROM ". USERS_TABLE ."
          WHERE user_color_gi REGEXP  '(".$id.")'
          ORDER BY username ASC";
    $r            = $db->sql_query($q);
    while($row     = $db->sql_fetchrow($r)) {
        echo "<option value='". $row['user_id'] ."'>". $row['username'] ."</option>";
    }
    $db->sql_freeresult($r);
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='middle' width='100%' class='row2'>";
    echo "            <input type='hidden' name='mode' value='del_user' />";
    echo "            <input type='hidden' name='group' value='". $id ."' />";
    echo "            <input type='submit' class='mainoption' value='". $lang['group_delete_user_1'] ."' onchange='document.delete_from_group.submit()' />";
    echo "        </td>";
    echo "    </tr>";
    echo "</form>";
    echo "</table>";
}

function del_user($user, $group) {
    global $db, $cache, $lang;

    $return = remove_group_attributes($user, $group, 0, 1);
    if ($return) {
        message_die(GENERAL_MESSAGE, $lang['group_delete_user_2'] . "<br /><br />" . sprintf($lang['Return_to_management'], "<a href=".admin_sid('admin_advanced_username_color_m.php').">", "</a>"), $lang['success']);
        $cache->delete('UserColors', 'config');
    } else {
        message_die(GENERAL_MESSAGE, $lang['group_delete_user_2'] . "<br /><br />" . sprintf($lang['Return_to_management'], "<a href=".admin_sid('admin_advanced_username_color_m.php').">", "</a>"), $lang['Admin_user_fail']);
    }
    
}

function add_user($who=0, $multi='', $group=0, $color='') {
    global $db, $cache, $lang;

    if ($who > 0) {
        $multi = '';
    }
    if (!empty($multi)) {
        $who = 0;
    }
    if (($who == 0) && empty($multi)) {
        message_die(GENERAL_ERROR, $lang['choose_user_id_error'] . "<br /><br />" . sprintf($lang['Return_to_management'], "<a href=".admin_sid('admin_advanced_username_color_m.php').">", "</a>"));
    }
    $user_plus = '';
    $user_added = '<br /><div style="text-align:left;"><span style="font-weight:bold;text-align:center;">' . $lang['added_to_group'] . ':</span><br />';
    if ($multi) {
        $users = explode("\n", $multi);
        $cu = count($users);
        for ($x = 0; $x < $cu; $x++) {
            $users[$x] = phpbb_clean_username($users[$x]);
            $row = $db->sql_ufetchrow("SELECT `user_id`, `username` FROM `". USERS_TABLE ."`
                    WHERE `username` = '". $users[$x] ."'
                    AND `user_color_gi` NOT REGEXP '(".$group.")'");
            $added = add_group_attributes($row['user_id'], $group, 0, 1, 1, 0);
            if ($added) {
                $user_plus .= $row['username'].'<br />';
            }
        }
    } else {
        $added = add_group_attributes($who, $group, 0, 1, 1, 0);
        if ($added) {
            $user_plus .= get_user_field('username', $who).'<br />';
        }
    }
    if (!empty($user_plus)) {
        $cache->delete('UserColors', 'config');
        $user_added .= $user_plus;
    }
    $user_added .= '<br />' . $lang['changed_user_color'] . '<br />';
    $user_added .= '</div><br />';
    $cache->delete('UserColors', 'config');
    message_die(GENERAL_MESSAGE, $lang['group_user_added'] . "<br />". $user_added ."<br />" . sprintf($lang['Return_to_management'], "<a href=".admin_sid('admin_advanced_username_color_m.php').">", "</a>"), $lang['success']);
}

// group_id = ID of the new UserGroup added to ColorGroup
// group    = ID of the ColorGroup
// color    = not longer used - depreciated for the future
function add_group($group_id, $group, $color='') {
    global $db, $cache, $lang;

    $user_plus = '';
    $user_added = '<br /><div style="text-align:left;"><span style="font-weight:bold;text-align:center;">' . $lang['added_to_group'] . ':</span><br />';
    $result3 = $db->sql_query('SELECT `user_id` FROM `'. USER_GROUP_TABLE .'` WHERE `group_id` = '. $group_id);
    while( $new_group = $db->sql_fetchrow($result3) ) {
        // Here we add all users which are in the selected Forums-Group to the color-group
        $result = add_group_attributes($new_group['user_id'], $group, 0, 1, 1);
        if ($result) {
            $user_plus .= get_user_field('username', $new_group['user_id']) . '<br />';
        }
    }
    $db->sql_freeresult($result3);
    if (!empty($user_plus)) {
        $cache->delete('UserColors', 'config');
        $user_added .= $user_plus;
    }
    $user_added .= '<br />' . $lang['changed_user_color'] . '<br />';
    $user_added .= '</div><br />';
    $db->sql_uquery('UPDATE `'. GROUPS_TABLE . '` SET `group_color` = '. $group .' WHERE `group_id` = ' . $group_id);
    $cache->delete('UserColors', 'config');
    $cache->delete('GroupColors', 'config');
    message_die(GENERAL_MESSAGE, $lang['group_user_added'] . $user_added . sprintf($lang['Return_to_management'], "<a href=".admin_sid('admin_advanced_username_color_m.php').">", "</a>"), $lang['success']);
}

$xgroup_id  = $_GETVAR->get('group_id', 'post', 'int');
$xgroup     = $_GETVAR->get('group', 'post', 'int');
$xcolor     = $_GETVAR->get('color', 'post', 'string', NULL);
$xusers_id  = $_GETVAR->get('users_id', 'post', 'string', NULL);
$xmulti     = $_GETVAR->get('multi_users', 'post', 'string', NULL);
$xdelete    = $_GETVAR->get('delete', 'post', 'int', NULL);

switch ($modus) {
  case 'add_group':
      add_group($xgroup_id, $xgroup, $xcolor);
      break;
  case 'add_user':
      add_user($xusers_id, $xmulti, $xgroup, $xcolor);
      break;
  case 'del_user':
      del_user($xdelete, $xgroup);
      break;
  case 'select_group':
      select_group($xgroup);
      break;
  case 'main':
  default:
      color_main();
      break;
}
include_once(NUKE_FORUMS_ADMIN_DIR.'page_footer_admin.php');

?>