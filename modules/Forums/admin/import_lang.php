<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
*                           import_lang.php
*                            -------------------
*   begin                : Sat, Jan 04, 2003
*   copyright            : (C) 2003 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: import_lang.php,v 1.1 2003/03/16 18:38:29 acydburn Exp $
*
***************************************************************************/

/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
***************************************************************************/

global $directory_mode;

define('IN_PHPBB', TRUE);
require(dirname(__FILE__) . '/pagestart.php');

global $_GETVAR;

$lang_file = '/lang_admin_statistics.php';

if (file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file))
{
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
}
elseif (file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file))
{
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
}
else
{
    die('Neither your selected nor the board-default language-file could be found');
}

include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/constants.php');
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/stat_functions.php');
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/admin_functions.php');
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/lang_functions.php');

$mode = $_GETVAR->get('mode', 'request', 'string', '');
$submit = $_GETVAR->get('submit', 'post', 'string', NULL) ? TRUE : FALSE;
$cancel = $_GETVAR->get('cancel', 'post', 'string', NULL) ? TRUE : FALSE;

if ($cancel)
{
    $no_page_header = TRUE;
}

$sql = "SELECT * FROM " . STATS_CONFIG_TABLE;

if ( !($result = $db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

$stats_config = array();

while ($row = $db->sql_fetchrow($result))
{
    $stats_config[$row['config_name']] = trim($row['config_value']);
}

if ($cancel)
{
    $url = 'admin/' . append_sid('admin_stats_lang.php?mode=select', TRUE);

    /*$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
    $server_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['server_name']));
    $server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';
    $script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));*/
    $url = preg_replace('/^\/?(.*?)\/?$/', '/\1', trim($url));

    // Redirect via an HTML form for PITA webservers
    if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
    {
        header('Refresh: 0; URL=' . $url);
        echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" /><meta http-equiv="refresh" content="0; url=' . $url . '" /><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $url . '">HERE</a> to be redirected</div></body></html>';
        exit;
    }

    // Behave as per HTTP/1.1 spec for others
    redirect($url);
    exit;
}

if ($mode == 'import_new_lang' && $submit)
{
    $template->set_filenames(array(
        'body' => 'admin/stat_import_language.tpl')
    );

    if ( $_GETVAR->get('mode', 'post', 'string', NULL))
    {
        $filename = trim(stripslashes(htmlspecialchars($_GETVAR->get('filename', 'post', 'string', ''))));

        if (!($fp = fopen($filename, 'r')) )
        {
            message_die(GENERAL_ERROR, 'Unable to open ' . $filename);
        }

        read_lang_pak_header($fp);
        fclose($fp);

        if (strstr($filename, 'test.pak'))
        {
            unlink($filename);
        }

        $stream = implode('', @file($filename));
        $lang_file = read_pak_file($stream, 'LANGPACK');

        // Prepare the Data
        $lang_array = parse_lang_file($lang_file);

        $languages = get_all_installed_languages();
        $inst_langs = array();
        @reset($lang_array);
        while (list($language, $content) = each($lang_array))
        {
            if (!in_array($language, $languages))
            {
                $inst_langs[$language] = $content;
            }
        }

        if (count($inst_langs) == 0)
        {
            message_die(GENERAL_ERROR, 'All Languages enclosed within this Language Pack are already installed.');
        }

        $lang_array = $inst_langs;

        @reset($lang_array);
        while (list($key, $data) = @each($lang_array))
        {
            $modules = get_modules_from_lang_block($data);
            add_new_language_predefined($key, $modules);
        }

        message_die(GENERAL_MESSAGE, $lang['Language_pak_installed']);
    }

    if ( $_GETVAR->get('fileselect', 'post', 'string', NULL) )
    {
        $filename = NUKE_FORUMS_DIR . 'modules/pakfiles/' . trim($_GETVAR->get('selected_pak_file', 'post', 'string', NULL));
    }
    else if ( $_GETVAR->get('fileupload', 'post', 'string', NULL) )
    {
        $filename = $HTTP_POST_FILES['package']['tmp_name'];

        // check php upload-size
        if ( ($filename == 'none') || ($filename == '') )
        {
            message_die(GENERAL_ERROR, 'Unable to upload file, please use the pak file selector');
        }

        $contents = @implode('', @file($filename));

        if ($contents == '')
        {
            message_die(GENERAL_ERROR, 'Unable to upload file, please use the pak file selector');
        }

        if (!file_exists(NUKE_FORUMS_DIR . 'modules/cache'))
        {
            @umask(0);
            mkdir(NUKE_FORUMS_DIR . 'modules/cache', $directory_mode);
        }

        if (!($fp = fopen(NUKE_FORUMS_DIR . 'modules/cache/temp.pak', 'wt')))
        {
            message_die(GENERAL_ERROR, 'Unable to write temp file');
        }

        fwrite($fp, $contents, strlen($contents));
        fclose($fp);

        $filename = NUKE_FORUMS_DIR . 'modules/cache/temp.pak';
    }
    else
    {
        message_die(GENERAL_ERROR, 'Unable to find Module Package');
    }

    if (!($fp = fopen($filename, 'r')) )
    {
        message_die(GENERAL_ERROR, 'Unable to open ' . $filename);
    }

    read_lang_pak_header($fp);
    fclose($fp);

    $stream = implode('', @file($filename));
    $lang_file = read_pak_file($stream, 'LANGPACK');

    $s_hidden_fields = '<input type="hidden" name="filename" value="' . $filename . '" />';

    // Prepare the Data
    $lang_array = parse_lang_file($lang_file);

    $languages = get_all_installed_languages();
    $inst_langs = array();
    @reset($lang_array);
    while (list($language, $content) = each($lang_array))
    {
        if (!in_array($language, $languages))
        {
            $inst_langs[$language] = $content;
        }
    }

    if (count($inst_langs) == 0)
    {
        message_die(GENERAL_ERROR, 'All Languages enclosed within this Language Pack are already installed.');
    }

    $lang_array = $inst_langs;

    // Prepare Template
    $template->assign_block_vars('switch_install_language', array());

    $template->assign_vars(array(
        'L_IMPORT_LANGUAGE' => $lang['Import_new_language'],
        'L_IMPORT_LANGUAGE_EXPLAIN' => $lang['Import_new_language_explain'],
        'L_INSTALL_LANGUAGE' => $lang['Install_language'],
        'L_INSTALL' => $lang['Install'],
        'L_LANGUAGE' => $lang['Language'],
        'L_MODULES' => $lang['Modules'])
    );

    @reset($lang_array);
    while (list($key, $data) = @each($lang_array))
    {
        $language = str_replace('lang_', '', $key);

        $template->assign_block_vars('languages', array(
            'LANGUAGE' => $language)
        );

        $modules = get_modules_from_lang_block($data);
        @reset($modules);
        while (list($module_name, $module_data) = each($modules))
        {
            $template->assign_block_vars('languages.modules', array(
                'MODULE' => $module_name)
            );
        }
    }

    $s_hidden_fields .= '<input type="hidden" name="install_language" value="1" />';

    $template->assign_vars(array(
        'S_HIDDEN_FIELDS' => $s_hidden_fields)
    );
}

if (($mode == 'import_new_lang') && (!$submit))
{
    $template->set_filenames(array(
        'body' => 'admin/stat_import_language.tpl')
    );

    if ( (!($_GETVAR->get('fileupload', 'post', 'string', NULL))) && (!($_GETVAR->get('fileselect', 'post', 'string', NULL))) )
    {
        $lang_paks = array();

        $dir = @opendir(NUKE_FORUMS_DIR . 'modules/pakfiles');

        while($file = @readdir($dir))
        {
            if( !@is_dir(NUKE_FORUMS_DIR . 'modules/pakfiles' . '/' . $file) )
            {
                if ( preg_match('#.pak$#', $file) )
                {
                    $lang_paks[] = $file;
                }
            }
        }

        @closedir($dir);

        if (count($lang_paks) > 0)
        {
            $template->assign_block_vars('switch_select_lang', array());

            $module_select_field = '<select name="selected_pak_file">';

            for ($i = 0; $i < count($module_paks); $i++)
            {
                $selected = ($i == 0) ? ' selected="selected"' : '';

                $module_select_field .= '<option value="' . $lang_paks[$i] . '"' . $selected . '>' . $lang_paks[$i] . '</option>';
            }

            $module_select_field .= '</select>';

            $s_hidden_fields = '<input type="hidden" name="fileselect" value="1" />';

            $template->assign_vars(array(
                'L_SELECT_LANGUAGE' => $lang['Select_language_pak'],
                'S_SELECT_LANGUAGE' => $module_select_field,
                'S_SELECT_HIDDEN_FIELDS' => $s_hidden_fields)
            );

        }

        $template->assign_block_vars('switch_upload_lang', array());

        $s_hidden_fields = '<input type="hidden" name="fileupload" value="1" />';

        $template->assign_vars(array(
            'L_IMPORT_LANGUAGE' => $lang['Import_new_language'],
            'L_IMPORT_LANGUAGE_EXPLAIN' => $lang['Import_new_language_explain'],
            'L_UPLOAD_LANGUAGE' => $lang['Upload_language_pak'],
            'L_SUBMIT' => $lang['Submit'],
            'S_ACTION' => append_sid(NUKE_FORUMS_ADMIN_DIR . 'import_lang.php?mode='.$mode),
            'S_UPLOAD_HIDDEN_FIELDS' => $s_hidden_fields)
        );

    }
}

$template->pparse('body');

//
// Page Footer
//
include(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>