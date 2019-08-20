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

//
// Debug Mode
$debug = False;
$lang['TRANSLATION_INFO'] = '';
//

if ( $debug || $board_config['ropm_quick_reply']) {
    //if ( $board_config['ropm_quick_reply'])
    $lang_file = '/lang_main_pmqr.php';
    if (file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
        include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
    } elseif (file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
        include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file);
    } else {
        die('Neither your selected nor the board-default language-file could be found');
    }
    $template->set_filenames(array(
       'ropm_quick_reply_output' => 'ropm_quick_reply.tpl')
    );
    $bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
    $last_poster = $privmsg['username_1'];
    $last_msg = $privmsg['privmsgs_text'];
    $last_msg = str_replace(":1:$bbcode_uid", '', $last_msg);
    $last_msg = str_replace(":$bbcode_uid", '', $last_msg);
    $last_msg = '[quote="' . $last_poster . '"]' . $last_msg . '[/quote]';
    $last_msg = str_replace("\\", "\\\\", $last_msg);$last_msg = str_replace("'", "\'", $last_msg);$last_msg = str_replace(chr(13), '', $last_msg);$last_msg = str_replace("\n", "\\n", $last_msg);
    $s_hidden_fields = '<input type="hidden" name="folder" value="'.$folder.'" />'."\n".'
                       <input type="hidden" name="mode" value="post" />'."\n".'
                       <input type="hidden" name="username" value="' . $privmsg['username_1'] . '" />'."\n".'
                       <input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />'."\n";

    $template->assign_block_vars('ROPM_QUICK_REPLY', array(
        'POST_ACTION'       => append_sid('privmsg.php'),
        'S_HIDDEN_FIELDS'   => $s_hidden_fields,
        'SUBJECT'           => ( ( !preg_match('/^Re:/', $privmsg['privmsgs_subject']) ) ? 'Re: ' : '' ) . str_replace('"', "&quot;", $privmsg['privmsgs_subject']),
        'LAST_MSG'          => $last_msg,
        'S_HTML_CHECKED'    => ( !$userdata['user_allowhtml'] ) ? ' checked="checked"' : '',
        'S_BBCODE_CHECKED'  => ( !$userdata['user_allowbbcode'] ) ? ' checked="checked"' : '',
        'S_SMILIES_CHECKED' => ( !$userdata['user_allowsmile'] ) ? ' checked="checked"' : '',
        'S_SIG_CHECKED'     => ( $userdata['user_attachsig'] ) ? ' checked="checked"' : ''
    ));

    if ( $board_config['allow_html'] ) {
        $template->assign_block_vars('ROPM_QUICK_REPLY.HTMLCB', array());
    }
    if ( $board_config['allow_bbcode'] ) {
        $template->assign_block_vars('ROPM_QUICK_REPLY.BBCODECB', array());
        if ( $board_config['ropm_quick_reply_bbc'] ) {
            $template->assign_block_vars('ROPM_QUICK_REPLY.BBCODEBUTT', array());
        }
    }
    if ( $board_config['allow_smilies'] ) {
        $template->assign_block_vars('ROPM_QUICK_REPLY.SMILIESCB', array());
        generate_smilies_row();
    }
    $template->assign_vars(array(
        'U_MORE_SMILIES'    => append_sid('posting.php?mode=smilies'),
        'L_EMPTY_MESSAGE'   => $lang['Empty_message'],
        'L_PREVIEW'         => $lang['Preview'],
        'L_SUBMIT'          => $lang['Submit'],
        'L_CANCEL'          => $lang['Cancel'],
        'L_SUBJECT'         => $lang['PMQR_Subject'],
        'L_MESSAGE'         => $lang['Message'],
        'L_OPTIONS'         => $lang['Options'],
        'L_ATTACH_SIGNATURE'=> $lang['Attach_signature'],
        'L_DISABLE_HTML'    => $lang['Disable_HTML_post'],
        'L_DISABLE_BBCODE'  => $lang['Disable_BBCode_post'],
        'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'],
        'L_ALL_SMILIES'     => $lang['PMQR_smilies'],
        'L_QUOTE_SELECTED'  => $lang['PMQR_QuoteSelelected'],
        'L_NO_TEXT_SELECTED'=> $lang['PMQR_QuoteSelelectedEmpty'],
        'L_EMPTY_MESSAGE'   => $lang['Empty_message'],
        'L_EMPTY_SUBJECT'   => $lang['Empty_subject'],
        'L_ENTER_URL'       => $lang['PMQR_enter_url'],
        'L_ENTER_TITLE'     => $lang['PMQR_enter_title'],
        'L_TITLE'           => $lang['PMQR_title'],
        'L_EMPTY_URL'       => $lang['PMQR_empty_url'],
        'L_EMPTY_TITLE'     => $lang['PMQR_empty_title'],
        'L_ENTER_IMG_URL'   => $lang['PMQR_enter_img_url'],
        'L_EMPTY_IMG_URL'   => $lang['PMQR_empty_img_url'],
        'L_ERROR'           => $lang['Error'],
        'L_QUOTE_LAST_MESSAGE' => $lang['PMQR_Quick_quote'],
        'L_QUICK_REPLY'     => $lang['PMQR_Quick_Reply'],
        'L_CUT'             => $lang['PMQR_cut'],
        'L_COPY'            => $lang['PMQR_copy'],
        'L_PASTE'           => $lang['PMQR_paste'],
        'L_MARKALL'         => $lang['PMQR_markall'],
        'L_BOLD'            => $lang['PMQR_bold'],
        'L_ITALIC'          => $lang['PMQR_italic'],
        'L_UNDERLINE'       => $lang['PMQR_underline'],
        'L_QUOTE'           => $lang['PMQR_quote'],
        'L_CODE'            => $lang['PMQR_code'],
        'L_IMAGE'           => $lang['PMQR_image'],
        'L_URL'             => $lang['PMQR_url'],
        'L_B'               => $lang['PMQR_b'],
        'L_I'               => $lang['PMQR_i'],
        'L_U'               => $lang['PMQR_u'],
        'IMG_CUT'           => (isset($images['bbc_cut']) ? $images['bbc_cut']: ''),
        'IMG_COPY'          => (isset($images['bbc_copy']) ? $images['bbc_copy']: '') ,
        'IMG_PASTE'         => (isset($images['bbc_paste']) ? $images['bbc_paste']: ''),
        'IMG_MARKALL'       => (isset($images['bbc_markall']) ? $images['bbc_markall']: ''),
        'IMG_BOLD'          => (isset($images['bbc_bold']) ? $images['bbc_bold'] : ''),
        'IMG_ITALIC'        => (isset($images['bbc_italic']) ? $images['bbc_italic']: ''),
        'IMG_UNDERLINE'     => (isset($images['bbc_underline']) ? $images['bbc_underline']: ''),
        'IMG_QUOTESELECTED' => (isset($images['bbc_quoteselected']) ? $images['bbc_quoteselected'] : ''),
        'IMG_QUOTE'         => (isset($images['bbc_quote']) ? $images['bbc_quote'] : ''),
        'IMG_CODE'          => (isset($images['bbc_code']) ? $images['bbc_code'] : ''),
        'IMG_IMAGE'         => (isset($images['bbc_image']) ? $images['bbc_image'] : ''),
        'IMG_URL'           => (isset($images['bbc_url']) ? $images['bbc_url'] : '')
    ));
    $lang['TRANSLATION_INFO'] .= '<br />PM Quick Reply &copy; by <a href="http://www.rondom.gu2.info" target="rondom">Rondom</a> 2003-2004' . (( $lang['PMQR_TRANSLATION'] )?' :: '.$lang['PMQR_TRANSLATION'] : '') . (($debug)?'&nbsp;&nbsp;<span style="font-weight:bolder;font-size:20px;">Rondom\'s Debug Mode enabled!</span>':'');
    $template->assign_var_from_handle('ROPM_QUICKREPLY_OUTPUT', 'ropm_quick_reply_output');
}

function generate_smilies_row() {
    global $db, $board_config, $template;
    $max_smilies = $board_config['ropm_quick_reply_smilies'];

    $sql = 'SELECT emoticon, code, smile_url
         FROM ' . SMILIES_TABLE . '
         GROUP BY smile_url
         ORDER BY smilies_id LIMIT ' . $max_smilies;
    if (!$result = $db->sql_query($sql)) {
        message_die(GENERAL_ERROR, "Couldn't retrieve smilies list", '', __LINE__, __FILE__, $sql);
    }
    $smilies_count = $db->sql_numrows($result);
    $smilies_data = $db->sql_fetchrowset($result);
    for ($i = 0; $i < $smilies_count; $i++) {
        $template->assign_block_vars('ROPM_QUICK_REPLY.SMILIES', array(
            'CODE' => $smilies_data[$i]['code'],
            'URL'  => $board_config['smilies_path'] . '/' . $smilies_data[$i]['smile_url'],
            'DESC' => $smilies_data[$i]['emoticon'])
         );
    }
    $sql = 'SELECT COUNT(*) FROM ' . SMILIES_TABLE . '
            GROUP BY smile_url;';

    if (!$result = $db->sql_query($sql)) {
        message_die(GENERAL_ERROR, "Couldn't count smilies", '', __LINE__, __FILE__, $sql);
    }
    $real_smilies_count = $db->sql_numrows($result);
    if ($real_smilies_count > $max_smilies || !$max_smilies) {
        $template->assign_block_vars('ROPM_QUICK_REPLY.MORESMILIES', array());
    }
}
?>