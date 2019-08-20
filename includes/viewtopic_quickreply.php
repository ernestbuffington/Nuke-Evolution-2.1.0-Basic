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

if (!defined('MODULE_FILE')  && !defined('IN_PHPBB') ) {
   die('You can\'t access this file directly...');
}


$submit = $refresh = FALSE;
$hidden_form_fields = '<input type="hidden" name="mode" value="reply" />';
$hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
//
// Set toggles for various options
//
if ( !$board_config['allow_html'] ) {
    $html_on = 0;
} else {
    $html_on = ( $submit || $refresh ) ? ( ( $_GETVAR->get('disable_html', 'post', 'string', NULL) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );
}
if ( !$board_config['allow_bbcode'] ) {
    $bbcode_on = 0;
} else {
    $bbcode_on = ( $submit || $refresh ) ? ( ( $_GETVAR->get('disable_bbcode', 'post', 'string', NULL) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}
if ( !$board_config['allow_smilies'] ) {
    $smilies_on = 0;
} else {
    $smilies_on = ( $submit || $refresh ) ? ( ( $_GETVAR->get('disable_smilies', 'post', 'string', NULL) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}
if ( ($submit || $refresh) && $is_auth['auth_read']) {
    $notify_user = $_GETVAR->get('notify', 'post', 'string', NULL) ? 1 : 0;
    if ( $mode != 'newtopic' && is_user() && $is_auth['auth_read'] ) {
        $is_notify = $db->sql_unumrows("SELECT topic_id FROM " . TOPICS_WATCH_TABLE . "
                                        WHERE topic_id = '$topic_id'
                                        AND user_id = " . $userdata['user_id']);
        $notify_user = ( $is_notify > 0 ) ? 1 : $notify_user;
    } else {
        $notify_user = ( is_user() && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
    }
} else {
    $notify_user = ( is_user() && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
}
$attach_sig = ( $submit || $refresh ) ? ( ( $_GETVAR->get('attach_sig', 'post', 'string', NULL) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );
$user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

if ( (($userdata['user_quickreply_mode']==1) && ($userdata['user_id'] != ANONYMOUS)) || (($board_config['anonymous_sqr_mode']==1) && ($userdata['user_id'] == ANONYMOUS)) ) {
    $template->assign_block_vars('switch_advanced_qr', array());
    //
    // Signature toggle selection
    //
    if( $user_sig != '' ) {
        $template->assign_block_vars('switch_advanced_qr.switch_signature_checkbox', array());
    }
    //
    // HTML toggle selection
    //
    if ( $board_config['allow_html'] ) {
        $html_status = $lang['HTML_is_ON'];
        $template->assign_block_vars('switch_advanced_qr.switch_html_checkbox', array());
    } else {
        $html_status = $lang['HTML_is_OFF'];
    }
    //
    // BBCode toggle selection
    //
    if ( $board_config['allow_bbcode'] ) {
        $bbcode_status = $lang['BBCode_is_ON'];
        $template->assign_block_vars('switch_advanced_qr.switch_bbcode_checkbox', array());
    } else {
        $bbcode_status = $lang['BBCode_is_OFF'];
    }
    //
    // Smilies toggle selection
    //
    if ( $board_config['allow_smilies'] ) {
        $smilies_status = $lang['Smilies_are_ON'];
        $template->assign_block_vars('switch_advanced_qr.switch_smilies_checkbox', array());
    } else {
        $smilies_status = $lang['Smilies_are_OFF'];
    }
    //
    // Notify checkbox - only show if user is logged in
    //
    if ( $userdata['session_logged_in'] && $is_auth['auth_read'] ) {
        if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) ) {
            $template->assign_block_vars('switch_advanced_qr.switch_notify_checkbox', array());
        }
    }
    if (  $is_auth['auth_mod'] ) {
            $sql = "SELECT topic_status FROM " . TOPICS_TABLE . " WHERE topic_id = '$reply_topic_id'";
                if (!$result = $db->sql_query($sql)) {
                message_die(GENERAL_ERROR, 'Could not obtain topic status information', '', __LINE__, __FILE__, $sql);
                }
            $topic_status = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);
            $topic_status = $topic_status['topic_status'];
        if ( $topic_status == TOPIC_LOCKED ) {
            $template->assign_block_vars('switch_advanced_qr.switch_unlock_topic', array());
            $template->assign_vars(array(
                'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
                'S_UNLOCK_CHECKED' => 'checked="checked"')
            );
        } else if ( $topic_status == TOPIC_UNLOCKED ) {
            $template->assign_block_vars('switch_advanced_qr.switch_lock_topic', array());
            $template->assign_vars(array(
                'L_LOCK_TOPIC' => $lang['Lock_topic'],
                'S_LOCK_CHECKED' => '')
            );
        }
    }
    // Generate smilies listing for page output
    generate_smilies('inline', PAGE_POSTING);
    $template->assign_vars(array(
        'BB_BOX'                => bbcode_table('message', 'post', 1, ''),
        'HTML_STATUS'           => $html_status,
        'BBCODE_STATUS'         => sprintf($bbcode_status, '<a href="' . append_sid("faq.php?mode=bbcode") . '" onclick="window.open(this.href,\'_blank\'); return false;">', '</a>'),
        'SMILIES_STATUS'        => $smilies_status,
        'L_OPTIONS'             => $lang['Options'],
        'L_DISABLE_HTML'        => $lang['Disable_HTML_post'],
        'L_DISABLE_BBCODE'      => $lang['Disable_BBCode_post'],
        'L_DISABLE_SMILIES'     => $lang['Disable_Smilies_post'],
        'L_ATTACH_SIGNATURE'    => $lang['Attach_signature'],
        'L_NOTIFY_ON_REPLY'     => $lang['Notify'],
        'S_HTML_CHECKED'        => ( !$html_on ) ? 'checked="checked"' : '',
        'S_BBCODE_CHECKED'      => ( !$bbcode_on ) ? 'checked="checked"' : '',
        'S_SMILIES_CHECKED'     => ( !$smilies_on ) ? 'checked="checked"' : '',
        'S_SIGNATURE_CHECKED'   => ( $attach_sig ) ? 'checked="checked"' : '',
        'S_NOTIFY_CHECKED'      => ( $notify_user ) ? 'checked="checked"' : '')
    );
} else {
    if ( !$html_on ) {
        $hidden_form_fields .= '<input type="hidden" name="disable_html" value="on" />';
    }
    if ( !$bbcode_on ) {
        $hidden_form_fields .= '<input type="hidden" name="disable_bbcode" value="on" />';
    }
    if ( !$smilies_on ) {
        $hidden_form_fields .= '<input type="hidden" name="disable_smilies" value="on" />';
    }
    if ( $attach_sig ) {
        $hidden_form_fields .= '<input type="hidden" name="attach_sig" value="on" />';
    }
    if ( $notify_user ) {
        $hidden_form_fields .= '<input type="hidden" name="notify" value="on" />';
    }
    $template->assign_vars(array(
        'BB_BOX'                => bbcode_table('message', 'post', 0, ''),
        'L_OPTIONS'             => $lang['Options'],
        'L_DISABLE_HTML'        => $lang['Disable_HTML_post'],
        'L_DISABLE_BBCODE'      => $lang['Disable_BBCode_post'],
        'L_DISABLE_SMILIES'     => $lang['Disable_Smilies_post'],
        'L_ATTACH_SIGNATURE'    => $lang['Attach_signature'],
        'L_NOTIFY_ON_REPLY'     => $lang['Notify'],
        'S_HTML_CHECKED'        => ( !$html_on ) ? 'checked="checked"' : '',
        'S_BBCODE_CHECKED'      => ( !$bbcode_on ) ? 'checked="checked"' : '',
        'S_SMILIES_CHECKED'     => ( !$smilies_on ) ? 'checked="checked"' : '',
        'S_SIGNATURE_CHECKED'   => ( $attach_sig ) ? 'checked="checked"' : '',
        'S_NOTIFY_CHECKED'      => ( $notify_user ) ? 'checked="checked"' : '')
    );
}

if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) ) {
    $template->assign_block_vars('switch_username_select', array());
}

//
// Output the data to the template
//
if ( !is_user() && ($board_config['board_disable_security_code'] == 1) ) {
    $template->assign_block_vars('switch_generate_security_code', array());
    $template->assign_vars(array(
        'L_GUEST_SECURITY_CODE' => security_code(1,'small', 1))
    );
}
if ( (($userdata['user_open_quickreply']==1) && ($userdata['user_id'] != ANONYMOUS)) || (($board_config['anonymous_open_sqr']==1) && ($userdata['user_id'] == ANONYMOUS)) ) {
    $template->assign_block_vars('switch_open_qr_yes', array());
} else {
    $template->assign_block_vars('switch_open_qr_no', array());
}

$template->assign_vars(array(
    'U_POST_SQR_TOPIC'      => 'javascript:sqr_show_hide();',
    'SQR_IMG'               => $images['quickreply'],
    'L_POST_SQR_TOPIC'      => $lang['Show_hide_quick_reply_form'],
    'L_EMPTY_MESSAGE'       => $lang['Empty_message'],
    'L_QUICK_REPLY'         => $lang['Quick_Reply'],
    'L_USERNAME'            => $lang['Username'],
    'L_SUBJECT'             => $lang['Subject'],
    'SUBJECT'               => "Re: " . $forum_topic_data['topic_title'],
    'L_MESSAGE_BODY'        => $lang['Message_body'],
    'L_PREVIEW'             => $lang['Preview'],
    'L_SUBMIT'              => $lang['Submit'],
    'S_POST_ACTION'         => append_sid('posting.php'),
    'S_HIDDEN_FORM_FIELDS'  => $hidden_form_fields)
);

$template->assign_var_from_handle('QRBODY', 'qrbody');

?>