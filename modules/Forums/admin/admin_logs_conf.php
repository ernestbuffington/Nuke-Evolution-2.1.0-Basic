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
        $module['Logs']['Logs Config'] = $filename;
        return;
    }
}

global $_GETVAR;

include_once(NUKE_INCLUDE_DIR . 'functions_log.php');
$template->set_filenames(array(
    'body' => 'admin/logs_config_body.tpl')
);
$sql = "SELECT config_value AS all_admin
        FROM " . LOGS_CONFIG_TABLE . "
        WHERE config_name = 'all_admin' ";
if(!$result = $db->sql_query($sql)) {
    message_die(CRITICAL_ERROR, 'Could not query log config informations', '', __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$all_admin_authorized = $row['all_admin'];
if ( $all_admin_authorized == '0' && $userdata['user_id'] <> '2' && !is_mod_admin($module_name) && $userdata['user_view_log'] <> '1' ) {
    message_die(GENERAL_MESSAGE, $lang['Admin_not_authorized']);
}

$sql = "SELECT * FROM " . LOGS_CONFIG_TABLE ;
if(!$result = $db->sql_query($sql)) {
    message_die(CRITICAL_ERROR, 'Could not query log config informations', '', __LINE__, __FILE__, $sql);
} else {
    while ( $row = $db->sql_fetchrow($result) ) {
        $config_name = $row['config_name'];
        $config_value = $row['config_value'];
        $default_config[$config_name] = $config_value;
        $new[$config_name] = $_GETVAR->get($config_name, 'post', 'string', $default_config[$config_name]);
        if ( $_GETVAR->get('submit', 'post', 'string') ) {
            $sql = "UPDATE " . LOGS_CONFIG_TABLE . " SET
                    config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
                    WHERE config_name = '$config_name'";
            if( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Failed to update configuration for $config_name', '', __LINE__, __FILE__, $sql);
            }
        }
    }
    if( $_GETVAR->get('submit', 'post', 'string') ) {
        $message = $lang['Log_Config_updated'] . '<br /><br />' . sprintf($lang['Click_return_admin_log_config'], "<a href=\"" . admin_sid("admin_logs_conf.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
        message_die(GENERAL_MESSAGE, $message);
    }
}

$add_admin_username = $_GETVAR->get('add_admin', 'post', 'string', '');

//
// Admins which can be allowed
//

$sql = "SELECT user_id, username
        FROM " . USERS_TABLE . "
        WHERE user_level = '2'
        AND user_id <> '2'
        AND user_view_log = '0' ";
$result = $db->sql_query($sql);
if( !$result ) {
    message_die(GENERAL_ERROR, 'Couldn\'t selected informations about user.', '',__LINE__, __FILE__, $sql);
}
$choose = $db->sql_fetchrowset($result);
$add_admin_select = '<select name="add_admin_select">';
if( empty($choose) ) {
    $add_admin_select .= '<option value="">' . $lang['No_other_admins'] . '</option>';
} else {
    $user = array();
    for( $i = 0; $i < count($choose); $i++ ) {
        $add_admin_select .= '<option value="' . $choose[$i]['user_id'] . '">' . $choose[$i]['username'] . '</option>';
    }
}
$add_admin_select .= '</select>';
$choose_username_add = $_GETVAR->get('add_admin_select', 'post', 'string', '');
if ( $add_admin_username ) {
    if ( $choose_username_add != '' ) {
        //
        // Allow a admin to see the logs
        //
        $sql = "UPDATE " . USERS_TABLE . "
                SET user_view_log = '1'
                WHERE user_id = '$choose_username_add' ";
        $result = $db->sql_query($sql);
        if( !$result ) {
            message_die(GENERAL_ERROR, "Couldn't allow this admin to see the logs.", "",__LINE__, __FILE__, $sql);
        } else {
            message_die(GENERAL_MESSAGE, $lang['Admins_add_success'] . "<br /><br />" . sprintf($lang['Click_return_admin_log_config'], "<a href=\"" . admin_sid("admin_logs_conf.php") . "\">", "</a>"));
        }
    } else {
        message_die(GENERAL_MESSAGE, $lang['No_admins_allow'] . "<br /><br />" . sprintf($lang['Click_return_admin_log_config'], "<a href=\"" . admin_sid("admin_logs_conf.php") . "\">", "</a>"));
    }
}
//
// Admins which can be disallowed
//
$sql = "SELECT user_id, username
        FROM " . USERS_TABLE . "
        WHERE user_level = '2'
        AND user_id <> '2'
        AND user_view_log = '1' ";
$result = $db->sql_query($sql);
if( !$result ) {
    message_die(GENERAL_ERROR, "Couldn't selected informations about user.", "",__LINE__, __FILE__, $sql);
}
$choose_delete = $db->sql_fetchrowset($result);
$delete_admin_select = '<select name="delete_admin_select[]" multiple="multiple" size="4">';
if( empty($choose_delete) ) {
    $delete_admin_select .= '<option value=""> ' . $lang['No_admins_authorized'] . '</option>';
} else {
    $user = array();
    for( $i = 0; $i < count($choose_delete); $i++ ) {
        $delete_admin_select .= '<option value="' . $choose_delete[$i]['user_id'] . '">' . $choose_delete[$i]['username'] . '</option>';
    }
}
$delete_admin_select     .= '</select>';
$delete_admin_username    = $_GETVAR->get('delete_admin', 'post', 'string', NULL);
$temp_choose_username_del = $_GETVAR->get('delete_admin_select', 'post', 'array');
$choose_username_del      = $temp_choose_username_del ? $temp_choose_username_del : array();
$choose_username_del_sql  = implode(', ', $choose_username_del);
if ( $delete_admin_username ) {
    if ( $choose_username_del_sql != '' ) {
        //
        // Disallow admin to see the logs
        //
        $sql = "UPDATE " . USERS_TABLE . "
                SET user_view_log = '0'
                WHERE user_id ";
        if ( count($choose_username_del) > 1 ) {
            $sql .= "IN ($choose_username_del_sql)";
        } else {
            $sql .= " = $choose_username_del_sql ";
        }
        $result = $db->sql_query($sql);
        if( !$result ) {
            message_die(GENERAL_ERROR, "Couldn't disallow this admin to see the logs.", "",__LINE__, __FILE__, $sql);
        } else {
            message_die(GENERAL_MESSAGE, $lang['Admins_del_success'] . "<br /><br />" . sprintf($lang['Click_return_admin_log_config'], "<a href=\"" . admin_sid("admin_logs_conf.php") . "\">", "</a>"));
        }
    } else {
        message_die(GENERAL_MESSAGE, $lang['No_admins_disallow'] . "<br /><br />" . sprintf($lang['Click_return_admin_log_config'], "<a href=\"" . admin_sid("admin_logs_conf.php") . "\">", "</a>"));
    }
}
$do_prune = ( $_GETVAR->get('do_prune', 'post', 'string') ) ? TRUE : FALSE;
if ( $do_prune ) {
    $prune_days =  $_GETVAR->get('prune_days', 'post', 'int', 0);
    $prune = prune_logs($prune_days);
    if ( $prune ) {
        message_die(GENERAL_MESSAGE, $lang['Prune_success'] . "<br /><br />" . sprintf($lang['Click_return_admin_log_config'], "<a href=\"" . admin_sid("admin_logs_conf.php") . "\">", "</a>"));
    }
}
$all_admin_yes = ( $new['all_admin'] ) ? "checked=\"checked\"" : "";
$all_admin_no = ( !$new['all_admin'] ) ? "checked=\"checked\"" : "";
$template->assign_vars(array(
    'S_CONFIG_ACTION'               => admin_sid('admin_logs_conf.php'),
    'L_YES'                         => $lang['Yes'],
    'L_NO'                          => $lang['No'],
    'L_SUBMIT'                      => $lang['Submit'],
    'L_RESET'                       => $lang['Reset'],
    'L_ENABLED'                     => $lang['Enabled'],
    'L_DISABLED'                    => $lang['Disabled'],
    'L_ADD'                         => $lang['Add_disallow'],
    'L_DELETE'                      => $lang['Delete_disallow'],
    'L_LOG_CONFIG_TITLE'            => $lang['Log_Config'],
    'L_LOG_CONFIG_TITLE_EXPLAIN'    => $lang['Log_Config_explain'],
    'L_GENERAL_LOG_CONFIG'          => $lang['General_Config_Log'],
    'L_ALLOW_OTHER_ADMIN'           => $lang['Allow_all_admin'],
    'L_ALLOW_OTHER_ADMIN_EXPLAIN'   => $lang['Allow_all_admin_explain'],
    'L_ADD_ADMIN_USERNAME'          => $lang['Add_Admin_Username'],
    'L_DELETE_ADMIN_USERNAME'       => $lang['Delete_Admin_Username'],
    'L_USERNAME_ADD_ADMIN_EXPLAIN'  => $lang['Add_username_admin_explain'],
    'L_USERNAME_DELETE_ADMIN_EXPLAIN' => $lang['Delete_username_admin_explain'],
    'L_PRUNE_LOG'                   => $lang['Prune_of_logs'],
    'L_PRUNE'                       => $lang['Prune'],
    'L_PRUNE_EXPLAIN'               => $lang['Prune_explain'],
    'L_DO_PRUNE'                    => $lang['Prune_!'],
    'S_ALLOW_ALL_ADMIN'             => $all_admin_yes,
    'S_DISALLOW_ALL_ADMIN'          => $all_admin_no,
    'S_ADD_ADMIN'                   => $add_admin_select,
    'S_DELETE_ADMIN'                => $delete_admin_select)
);

$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>