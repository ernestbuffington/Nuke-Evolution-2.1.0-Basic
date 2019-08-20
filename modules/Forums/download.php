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
   die('You can\´t access this file directly');;
}

define('IN_PHPBB', TRUE);
global $_GETVAR, $browser;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

$module_name = basename(dirname(__FILE__));

include($phpbb_root_path . 'common.php');

//
// Parse the order and evaluate the array
//

$site = explode('?', $_GETVAR->get('HTTP_REFERER', '_SERVER'));
$url  = trim($site[0]);

if ($url != '') {
    $allowed = ($allow_deny_order == ALLOWED_DENIED) ? FALSE : TRUE;
    for ($i = 0; $i < count($sites); $i++) {
        if (strstr($url, $sites[$i])) {
            $allowed = ($allow_deny_order == ALLOWED_DENIED) ? TRUE : FALSE;
            break;
        }
    } 
} else {
    $allowed = TRUE;
}

if ($allowed == FALSE) {
    message_die(GENERAL_MESSAGE, $lang['Denied_Message']);
}


// Send file to browser
function send_file_to_browser($attachment, $upload_dir) {
    global $HTTP_USER_AGENT, $lang, $db, $attach_config;

    $filename = ($upload_dir == '') ? $attachment['physical_filename'] : $upload_dir . '/' . $attachment['physical_filename'];
    $gotit    = FALSE;

    if (!intval($attach_config['allow_ftp_upload'])) {
        if (!@file_exists(@amod_realpath($filename))) {
            message_die(GENERAL_ERROR, $lang['Error_no_attachment'] . "<br /><br /><strong>404 File Not Found:</strong> The File <em>" . $filename . "</em> does not exist.");
        } else {
            $gotit = TRUE;
        }
    }

    // Correct the mime type - we force application/octetstream for all files, except images
    // Please do not change this, it is a security precaution
    if (!strstr($attachment['mimetype'], 'image')) {
        $attachment['mimetype'] = ($browser == 'ie' || $browser == 'opera') ? 'application/octetstream' : 'application/octet-stream';
    }

    global $do_zlib_compress;
    if ($do_gzip_compress == TRUE) {
        while (ob_end_clean());
        header('Content-Encoding: none');
    }

    // Now the tricky part... let's dance
    //  @ob_end_clean();
    //  @ini_set('zlib.output_compression', 'Off');
    header('Pragma: public');
    //  header('Content-Transfer-Encoding: none');
    $real_filename = html_entity_decode(basename($attachment['real_filename']));
    // Send out the Headers
    header('Content-Type: ' . $attachment['mimetype'] . '; name="' . $real_filename . '"');
    header('Content-Disposition: inline; filename="' . $real_filename . '"');
    unset($real_filename);

    //
    // Now send the File Contents to the Browser
    //
    if ($gotit) {
        $size = @filesize($filename);
        if ($size) {
            header("Content-length: $size");
        }
        readfile($filename);
    } else if (!$gotit && intval($attach_config['allow_ftp_upload'])) {
        $conn_id = attach_init_ftp();
        $ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
        $tmp_path = ( !@$ini_val('safe_mode') ) ? '/tmp' : $upload_dir;
        $tmp_filename = @tempnam($tmp_path, 't0000');

        @unlink($tmp_filename);

        $mode = FTP_BINARY;
        if ( (preg_match("/text/i", $attachment['mimetype'])) || (preg_match("/html/i", $attachment['mimetype'])) ) {
            $mode = FTP_ASCII;
        }

        $result = @ftp_get($conn_id, $tmp_filename, $filename, $mode);

        if (!$result) {
            message_die(GENERAL_ERROR, $lang['Error_no_attachment'] . "<br /><br /><strong>404 File Not Found:</strong> The File <em>" . $filename . "</em> does not exist.");
        }

        @ftp_quit($conn_id);

        $size = @filesize($tmp_filename);
        if ($size) {
            header("Content-length: $size");
        }
        readfile($tmp_filename);
        @unlink($tmp_filename);
    } else {
        message_die(GENERAL_ERROR, $lang['Error_no_attachment'] . "<br /><br /><strong>404 File Not Found:</strong> The File <em>" . $filename . "</em> does not exist.");
    }
    exit;
}

//
// End Functions
//

$download_id = $_GETVAR->get('id', '_GET', 'int', 0);
$thumbnail   = $_GETVAR->get('thumb', '_GET', 'int', 0);

//
// Start Session Management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

if (!$download_id) {
    message_die(GENERAL_ERROR, $lang['No_attachment_selected']);
}
if ($attach_config['disable_mod'] && is_mod_admin('Forums') ) {
    message_die(GENERAL_MESSAGE, $lang['Attachment_feature_disabled']);
}
$sql = 'SELECT * FROM ' . ATTACHMENTS_DESC_TABLE . ' WHERE attach_id = ' . intval($download_id);
if (!($result = $db->sql_query($sql))) {
    message_die(GENERAL_ERROR, 'Could not query attachment informations', '', __LINE__, __FILE__, $sql);
}
if (!($attachment = $db->sql_fetchrow($result))) {
    message_die(GENERAL_MESSAGE, $lang['Error_no_attachment']);
}
$attachment['physical_filename'] = basename($attachment['physical_filename']);
$db->sql_freeresult($result);

// get forum_id for attachment authorization or private message authorization
$authorised = FALSE;

$sql = 'SELECT * FROM ' . ATTACHMENTS_TABLE . ' WHERE attach_id = '.intval($attachment['attach_id']);
if (!($result = $db->sql_query($sql))) {
    message_die(GENERAL_ERROR, 'Could not query attachment informations', '', __LINE__, __FILE__, $sql);
}

$auth_pages = $db->sql_fetchrowset($result);
$num_auth_pages = $db->sql_numrows($result);

for ($i = 0; $i < $num_auth_pages && $authorised == FALSE; $i++) {
    $auth_pages[$i]['post_id'] = intval($auth_pages[$i]['post_id']);
    if (intval($auth_pages[$i]['post_id']) != 0) {
        $sql = 'SELECT forum_id
        FROM ' . POSTS_TABLE . '
        WHERE post_id = ' . intval($auth_pages[$i]['post_id']);

        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not query post information', '', __LINE__, __FILE__, $sql);
        }
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $forum_id = $row['forum_id'];
        $is_auth = array();
        $is_auth = auth(AUTH_ALL, $forum_id, $userdata);
        if ($is_auth['auth_download']) {
            $authorised = TRUE;
        }
    } else {
        if ( (intval($attach_config['allow_pm_attach'])) && ( ($userdata['user_id'] == $auth_pages[$i]['user_id_2']) || ($userdata['user_id'] == $auth_pages[$i]['user_id_1']) ) || is_mod_admin($module_name ) ) {
            $authorised = TRUE;
        }
    }
}
if (!$authorised) {
    message_die(GENERAL_MESSAGE, $lang['Sorry_auth_view_attach']);
}

//
// Get Information on currently allowed Extensions
//
$sql = "SELECT e.extension, g.download_mode
        FROM (" . EXTENSION_GROUPS_TABLE . " g, " . EXTENSIONS_TABLE . " e)
        WHERE (g.allow_group = 1) AND (g.group_id = e.group_id)";

if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query Allowed Extensions.', '', __LINE__, __FILE__, $sql);
}

$rows = $db->sql_fetchrowset($result);
$num_rows = $db->sql_numrows($result);
$db->sql_freeresult($result);

for ($i = 0; $i < $num_rows; $i++) {
    $extension = strtolower(trim($rows[$i]['extension']));
    $allowed_extensions[] = $extension;
    $download_mode[$extension] = $rows[$i]['download_mode'];
}

// disallowed ?
if ((!in_array($attachment['extension'], $allowed_extensions)) && !is_mod_admin($module_name) ) {
    message_die(GENERAL_MESSAGE, sprintf($lang['Extension_disabled_after_posting'], $attachment['extension']));
}

$download_mode = intval($download_mode[$attachment['extension']]);

if ($thumbnail) {
    $attachment['physical_filename'] = THUMB_DIR . '/t_' . $attachment['physical_filename'];
}

// Update download count
if (!$thumbnail) {
    $sql = 'UPDATE ' . ATTACHMENTS_DESC_TABLE . '
            SET download_count = download_count + 1
            WHERE attach_id = ' . intval($attachment['attach_id']);

    if (!$db->sql_query($sql)) {
        message_die(GENERAL_ERROR, 'Couldn\'t update attachment download count', '', __LINE__, __FILE__, $sql);
    }
}

// Determine the 'presenting'-method
if ($download_mode == PHYSICAL_LINK) {
    $server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
    $server_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['server_name']));
    $server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
    $script_name .= '/';

    if (intval($attach_config['allow_ftp_upload'])) {
        if (trim($attach_config['download_path']) == '') {
            message_die(GENERAL_ERROR, 'Physical Download not possible with the current Attachment Setting');
        }
        $url = trim($attach_config['download_path']) . '/' . $attachment['physical_filename'];
        $redirect_path = $url;
    } else {
        $url = $upload_dir . '/' . $attachment['physical_filename'];
        $redirect_path = $server_protocol . $server_name . $server_port . $script_name . $url;
    }

    // Redirect via an HTML form for PITA webservers
    if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) {
        header('Refresh: 0; URL=' . $redirect_path);
        echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n';
        echo '<html lang="'._LANGCODE.'" dir="'._LANG_DIRECTION.'">\n';
        echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset="'._CHARSET.'" />\n';
        echo '<meta http-equiv="refresh" content="0; url=' . $redirect_path . '" /><title>Redirect</title></head>\n';
        echo '<body><div align="center">If your browser does not support meta redirection please click <a href="' . $redirect_path . '">HERE</a> to be redirected</div></body></html>';
        exit;
    }

    // Behave as per HTTP/1.1 spec for others
    redirect($redirect_path);
    exit;
} else {
    if (intval($attach_config['allow_ftp_upload'])) {
        // We do not need a download path, we are not downloading physically
        send_file_to_browser($attachment, '');
        exit;
    } else {
        send_file_to_browser($attachment, $upload_dir);
        exit;
    }
}

?>