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
        $module['General']['Smilies'] = $filename;
        return;
    }
}

global $_GETVAR;
//
// Load default header
//
$no_page_header = $_GETVAR->get('export_pack', 'get', 'string', NULL) == 'send' ? TRUE : FALSE ;
$cancel = $_GETVAR->get('cancel', 'post', 'string') ? TRUE : FALSE;
if ($cancel) {
    $mode = '';
} else {
    $mode = $_GETVAR->get('mode', 'request', 'string');
}

if ( substr($board_config['smilies_path'], 0, 1) != '/' ) {
    $smilies_path = $board_config['smilies_path'];
} else {
    $smilies_path = substr($board_config['smilies_path'], 1, strlen($board_config['smilies_path']));
}
if ( substr($smilies_path, -1) == '/' ) {
    $smilies_path = substr($smilies_path, 0, -1);
}
$realpathdir  = NUKE_BASE_DIR . $smilies_path;
$smilies_path = NUKE_HREF_BASE_DIR . $smilies_path;
$delimeter    = '=+:';
//
// Read a listing of uploaded smilies for use in the add or edit smliey code...
//
$dir = @opendir($realpathdir);
while($file = @readdir($dir)) {
    if( !@is_dir($realpathdir . '/' . $file) ) {
        $img_size = @getimagesize($realpathdir . '/' . $file);
        if( $img_size[0] && $img_size[1] ) {
            $smiley_images[] = $file;
        } elseif( preg_match('#.pak#', $file) ) {
            $smiley_paks[] = $file;
        }
    }
}
@closedir($dir);
//
// Select main mode
//
if( $_GETVAR->get('import_pack', 'request', 'string', NULL) ) {
    //
    // Import a list a "Smiley Pack"
    //
    $smile_pak = $_GETVAR->get('smile_pak', 'request', 'string', NULL);
    $clear_current = $_GETVAR->get('clear_current', 'request', 'string', NULL);
    $replace_existing = $_GETVAR->get('replace', 'request', 'string', NULL);
    if ( !empty($smile_pak) ) {
        //
        // The user has already selected a smile_pak file.. Import it.
        //
        if( !empty($clear_current)  ) {
            $sql = "DELETE
                    FROM " . SMILIES_TABLE;
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't delete current smilies", "", __LINE__, __FILE__, $sql);
            }
        } else {
            $sql = "SELECT code
                    FROM ". SMILIES_TABLE;
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't get current smilies", "", __LINE__, __FILE__, $sql);
            }
            $cur_smilies = $db->sql_fetchrowset($result);
            for( $i = 0; $i < count($cur_smilies); $i++ ) {
                $k = $cur_smilies[$i]['code'];
                $smiles[$k] = 1;
            }
        }
        $fcontents = @file($realpathdir . '/'. $smile_pak);
        if( empty($fcontents) ) {
            message_die(GENERAL_ERROR, "Couldn't read smiley pak file", "", __LINE__, __FILE__, $sql);
        }
        for( $i = 0; $i < count($fcontents); $i++ ) {
            $smile_data = explode($delimeter, trim(addslashes($fcontents[$i])));
            for( $j = 2; $j < count($smile_data); $j++) {
                //
                // Replace > and < with the proper html_entities for matching.
                //
                $smile_data[$j] = str_replace("<", "&lt;", $smile_data[$j]);
                $smile_data[$j] = str_replace(">", "&gt;", $smile_data[$j]);
                $k = $smile_data[$j];
                if( $smiles[$k] == 1 ) {
                    if( !empty($replace_existing) ) {
                        $sql = "UPDATE " . SMILIES_TABLE . "
                               SET smile_url = '" . str_replace("\'", "''", $smile_data[0]) . "', emoticon = '" . str_replace("\'", "''", $smile_data[1]) . "'
                               WHERE code = '" . str_replace("\'", "''", $smile_data[$j]) . "'";
                    } else {
                        $sql = '';
                    }
                } else {
                    $sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon)
                            VALUES('" . str_replace("\'", "''", $smile_data[$j]) . "', '" . str_replace("\'", "''", $smile_data[0]) . "', '" . str_replace("\'", "''", $smile_data[1]) . "')";
                }
                if( $sql != '' ) {
                    $result = $db->sql_query($sql);
                    if( !$result ) {
                        message_die(GENERAL_ERROR, "Couldn't update smilies!", "", __LINE__, __FILE__, $sql);
                    }
                }
            }
        }
        $message = $lang['smiley_import_success'] . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . admin_sid("admin_smilies.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
        message_die(GENERAL_MESSAGE, $message);
    } else {
        //
        // Display the script to get the smile_pak cfg file...
        //
        $smile_paks_select = "<select name='smile_pak'><option value=''>" . $lang['Select_pak'] . "</option>";
        while( list($key, $value) = @each($smiley_paks) ) {
            if ( !empty($value) ) {
                $smile_paks_select .= "<option>" . $value . "</option>";
            }
        }
        $smile_paks_select .= "</select>";
        $hidden_vars = "<input type='hidden' name='mode' value='import' />";
        $template->set_filenames(array(
            'body' => 'admin/smile_import_body.tpl')
        );
        $template->assign_vars(array(
            'L_SMILEY_TITLE'    => $lang['smiley_title'],
            'L_SMILEY_EXPLAIN'  => $lang['smiley_import_inst'],
            'L_SMILEY_IMPORT'   => $lang['smiley_import'],
            'L_SELECT_LBL'      => $lang['choose_smile_pak'],
            'L_IMPORT'          => $lang['import'],
            'L_CONFLICTS'       => $lang['smile_conflicts'],
            'L_DEL_EXISTING'    => $lang['del_existing_smileys'],
            'L_REPLACE_EXISTING'=> $lang['replace_existing'],
            'L_KEEP_EXISTING'   => $lang['keep_existing'],
            'S_SMILEY_ACTION'   => admin_sid('admin_smilies.php'),
            'S_SMILE_SELECT'    => $smile_paks_select,
            'S_HIDDEN_FIELDS'   => $hidden_vars)
        );
        $template->pparse('body');
    }
} else if( $_GETVAR->get('export_pack', 'request', 'string', NULL) ) {
    //
    // Export our smiley config as a smiley pak...
    //
    if ( $_GETVAR->get('export_pack', 'get', 'string', '') == 'send' ) {
        $sql = "SELECT *
                FROM " . SMILIES_TABLE;
        if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Could not get smiley list", "", __LINE__, __FILE__, $sql);
        }
        $resultset = $db->sql_fetchrowset($result);
        $smile_pak = '';
        for($i = 0; $i < count($resultset); $i++ ) {
            $smile_pak .= $resultset[$i]['smile_url'] . $delimeter;
            $smile_pak .= $resultset[$i]['emoticon'] . $delimeter;
            $smile_pak .= $resultset[$i]['code'] . "\n";
        }
        header("Content-Type: text/x-delimtext; name=\"smiles.pak\"");
        header("Content-disposition: attachment; filename=smiles.pak");
        echo $smile_pak;
        exit;
    }
    $message = sprintf($lang['export_smiles'], "<a href=\"" . admin_sid("admin_smilies.php&amp;export_pack=send", TRUE) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . admin_sid("admin_smilies.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
    message_die(GENERAL_MESSAGE, $message);
} else if( $_GETVAR->get('add', 'request', 'string', NULL) ) {
    //
    // Admin has selected to add a smiley.
    //
    $template->set_filenames(array(
        'body' => 'admin/smile_edit_body.tpl')
    );
    $filename_list = '';
    for( $i = 0; $i < count($smiley_images); $i++ ) {
        $filename_list .= '<option value="' . $smiley_images[$i] . '">' . $smiley_images[$i] . '</option>';
    }
    $s_hidden_fields = '<input type="hidden" name="mode" value="savenew" />';
    $template->assign_vars(array(
        'L_SMILEY_TITLE'    => $lang['smiley_title'],
        'L_SMILEY_CONFIG'   => $lang['smiley_config'],
        'L_SMILEY_EXPLAIN'  => $lang['smile_desc'],
        'L_SMILEY_CODE'     => $lang['smiley_code'],
        'L_SMILEY_URL'      => $lang['smiley_url'],
        'L_SMILEY_EMOTION'  => $lang['smiley_emot'],
        'L_SUBMIT'          => $lang['Submit'],
        'L_RESET'           => $lang['Reset'],
        'SMILEY_IMG'        => $smilies_path . '/' . $smiley_images[0],
        'S_SMILEY_ACTION'   => admin_sid('admin_smilies.php'),
        'S_HIDDEN_FIELDS'   => $s_hidden_fields,
        'S_FILENAME_OPTIONS'=> $filename_list,
        'S_SMILEY_BASEDIR'  => $smilies_path .'/')
    );
    $template->pparse('body');
} else if ( $mode != '' ) {
    switch( $mode ) {
        case 'delete':
            //
            // Admin has selected to delete a smiley.
            //
            $smiley_id = $_GETVAR->get('id', 'request', 'int', NULL);
            $confirm = $_GETVAR->get('confirm', 'request', 'string', NULL);
            if( $confirm ) {
                $sql = "DELETE FROM " . SMILIES_TABLE . "
                        WHERE smilies_id = " . $smiley_id;
                $result = $db->sql_query($sql);
                if( !$result ) {
                        message_die(GENERAL_ERROR, "Couldn't delete smiley", "", __LINE__, __FILE__, $sql);
                }
                $message = $lang['smiley_del_success'] . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . admin_sid("admin_smilies.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
                message_die(GENERAL_MESSAGE, $message);
            } else {
                // Present the confirmation screen to the user
                $template->set_filenames(array(
                    'body' => 'admin/confirm_body.tpl')
                );
                $hidden_fields = '<input type="hidden" name="mode" value="delete" /><input type="hidden" name="id" value="' . $smiley_id . '" />';
                $template->assign_vars(array(
                    'MESSAGE_TITLE'     => $lang['Confirm'],
                    'MESSAGE_TEXT'      => $lang['Confirm_delete_smiley'],
                    'L_YES'             => $lang['Yes'],
                    'L_NO'              => $lang['No'],
                    'S_CONFIRM_ACTION'  => admin_sid('admin_smilies.php'),
                    'S_HIDDEN_FIELDS'   => $hidden_fields)
                );
                $template->pparse('body');
            }
            break;
        case 'edit':
            //
            // Admin has selected to edit a smiley.
            //
            $smiley_id = $_GETVAR->get('id', 'request', 'int', NULL) ? $_GETVAR->get('id', 'request', 'int') : message_die(GENERAL_MESSAGE, $lang['Fields_empty']);
            $sql = "SELECT *
                    FROM " . SMILIES_TABLE . "
                    WHERE smilies_id = " . $smiley_id;
            $result = $db->sql_query($sql);
            if( !$result ) {
                message_die(GENERAL_ERROR, 'Could not obtain emoticon information', "", __LINE__, __FILE__, $sql);
            }
            $smile_data = $db->sql_fetchrow($result);
            $filename_list = '';
            for( $i = 0; $i < count($smiley_images); $i++ ) {
                if( $smiley_images[$i] == $smile_data['smile_url'] ) {
                    $smiley_selected = "selected=\"selected\"";
                    $smiley_edit_img = $smiley_images[$i];
                } else {
                    $smiley_selected = '';
                }
                $filename_list .= '<option value="' . $smiley_images[$i] . '"' . $smiley_selected . '>' . $smiley_images[$i] . '</option>';
            }
            $template->set_filenames(array(
                'body' => 'admin/smile_edit_body.tpl')
            );
            $s_hidden_fields = '<input type="hidden" name="mode" value="save" /><input type="hidden" name="smile_id" value="' . $smile_data['smilies_id'] . '" />';
            $template->assign_vars(array(
                'SMILEY_CODE'       => $smile_data['code'],
                'SMILEY_EMOTICON'   => $smile_data['emoticon'],
                'L_SMILEY_TITLE'    => $lang['smiley_title'],
                'L_SMILEY_CONFIG'   => $lang['smiley_config'],
                'L_SMILEY_EXPLAIN'  => $lang['smile_desc'],
                'L_SMILEY_CODE'     => $lang['smiley_code'],
                'L_SMILEY_URL'      => $lang['smiley_url'],
                'L_SMILEY_EMOTION'  => $lang['smiley_emot'],
                'L_SUBMIT'          => $lang['Submit'],
                'L_RESET'           => $lang['Reset'],
                'SMILEY_IMG'        => $smilies_path . '/' . $smiley_edit_img,
                'S_SMILEY_ACTION'   => admin_sid('admin_smilies.php'),
                'S_HIDDEN_FIELDS'   => $s_hidden_fields,
                'S_FILENAME_OPTIONS'=> $filename_list,
                'S_SMILEY_BASEDIR'  => $smilies_path .'/')
            );
            $template->pparse('body');
            break;
        case 'save':
            //
            // Admin has submitted changes while editing a smiley.
            //
            // Get the submitted data, being careful to ensure that we only
            // accept the data we are looking for.
            //
            $smile_code     = trim($_GETVAR->get('smile_code', 'post', 'string', ''));
            $smile_url      = trim($_GETVAR->get('smile_url', 'post', 'string', ''));
            $smile_url      = phpbb_ltrim(basename($smile_url), "'");
            $smile_emotion  = htmlspecialchars(trim($_GETVAR->get('smile_emotion', 'post', 'string', '')));
            $smile_id       = $_GETVAR->get('smile_id', 'post', 'int', 0);
            // If no code was entered complain ...
            if ($smile_code == '' || $smile_url == '') {
                message_die(GENERAL_MESSAGE, $lang['Fields_empty']);
            }
            //
            // Convert < and > to proper htmlentities for parsing.
            //
            $smile_code = str_replace('<', '&lt;', $smile_code);
            $smile_code = str_replace('>', '&gt;', $smile_code);
            //
            // Proceed with updating the smiley table.
            //
            $sql = "UPDATE " . SMILIES_TABLE . "
                    SET code = '" . str_replace("\'", "''", $smile_code) . "', smile_url = '" . str_replace("\'", "''", $smile_url) . "', emoticon = '" . str_replace("\'", "''", $smile_emotion) . "'
                    WHERE smilies_id = $smile_id";
            if( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Couldn't update smilies info", "", __LINE__, __FILE__, $sql);
            }
            $message = $lang['smiley_edit_success'] . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . admin_sid("admin_smilies.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;
        case 'savenew':
            //
            // Admin has submitted changes while adding a new smiley.
            //
            // Get the submitted data being careful to ensure the the data
            // we receive and process is only the data we are looking for.
            //
            $smile_code     = trim($_GETVAR->get('smile_code', 'post', 'string', ''));
            $smile_url      = trim($_GETVAR->get('smile_url', 'post', 'string', ''));
            $smile_url      = phpbb_ltrim(basename($smile_url), "'");
            $smile_emotion  = htmlspecialchars(trim($_GETVAR->get('smile_emotion', 'post', 'string', '')));
            // If no code was entered complain ...
            if ($smile_code == '' || $smile_url == '') {
                    message_die(GENERAL_MESSAGE, $lang['Fields_empty']);
            }
            //
            // Convert < and > to proper htmlentities for parsing.
            //
            $smile_code = str_replace('<', '&lt;', $smile_code);
            $smile_code = str_replace('>', '&gt;', $smile_code);
            //
            // Save the data to the smiley table.
            //
            $sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon)
                    VALUES ('" . str_replace("\'", "''", $smile_code) . "', '" . str_replace("\'", "''", $smile_url) . "', '" . str_replace("\'", "''", $smile_emotion) . "')";
            $result = $db->sql_query($sql);
            if( !$result ) {
                message_die(GENERAL_ERROR, "Couldn't insert new smiley", "", __LINE__, __FILE__, $sql);
            }
            $message = $lang['smiley_add_success'] . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . admin_sid("admin_smilies.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;
    }
} else {
    //
    // This is the main display of the page before the admin has selected
    // any options.
    //
    $sql = "SELECT *
            FROM " . SMILIES_TABLE;
    $result = $db->sql_query($sql);
    if( !$result ) {
        message_die(GENERAL_ERROR, "Couldn't obtain smileys from database", "", __LINE__, __FILE__, $sql);
    }
    $smilies = $db->sql_fetchrowset($result);
    $template->set_filenames(array(
        'body' => 'admin/smile_list_body.tpl')
    );
    $template->assign_vars(array(
        'L_ACTION'          => $lang['Action'],
        'L_SMILEY_TITLE'    => $lang['smiley_title'],
        'L_SMILEY_TEXT'     => $lang['smile_desc'],
        'L_DELETE'          => $lang['Delete'],
        'L_EDIT'            => $lang['Edit'],
        'L_SMILEY_ADD'      => $lang['smile_add'],
        'L_CODE'            => $lang['Code'],
        'L_EMOT'            => $lang['Emotion'],
        'L_SMILE'           => $lang['Smile'],
        'L_IMPORT_PACK'     => $lang['import_smile_pack'],
        'L_EXPORT_PACK'     => $lang['export_smile_pack'],
        'S_SMILEY_ACTION'   => admin_sid('admin_smilies.php'))
    );
    //
    // Loop throuh the rows of smilies setting block vars for the template.
    //
    for($i = 0; $i < count($smilies); $i++) {
        //
        // Replace htmlentites for < and > with actual character.
        //
        $smilies[$i]['code'] = str_replace('&lt;', '<', $smilies[$i]['code']);
        $smilies[$i]['code'] = str_replace('&gt;', '>', $smilies[$i]['code']);
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
        $template->assign_block_vars('smiles', array(
            'ROW_COLOR'       => '#' . $row_color,
            'ROW_CLASS'       => $row_class,
            'SMILEY_IMG'      =>  $smilies_path . '/' . $smilies[$i]['smile_url'],
            'CODE'            => $smilies[$i]['code'],
            'EMOT'            => $smilies[$i]['emoticon'],
            'U_SMILEY_EDIT'   => admin_sid('admin_smilies.php&amp;mode=edit&amp;id=' . $smilies[$i]['smilies_id']),
            'U_SMILEY_DELETE' => admin_sid('admin_smilies.php&amp;mode=delete&amp;id=' . $smilies[$i]['smilies_id']))
        );
    }
    //
    // Spit out the page.
    //
    $template->pparse('body');
}
$cache->delete('smilies', 'config');
//
// Page Footer
//
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>