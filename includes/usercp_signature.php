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

if ( defined('IN_ADMIN_USERS') ) {
    global $admin_userid;
    $userwork = get_user_field('*', $admin_userid);
    $user_id  = $admin_userid;
} else {
    $userwork = &$userdata;
}

// get the board & user settings ...
$html_status    = ( $userwork['user_allowhtml'] && $board_config['allow_html'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
$bbcode_status  = ( $userwork['user_allowbbcode'] && $board_config['allow_bbcode']  ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
$smilies_status = ( $userwork['user_allowsmile'] && $board_config['allow_smilies']  ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];

$html_on    = ( $userwork['user_allowhtml'] && $board_config['allow_html'] ) ? true : false ;
$bbcode_on  = ( $userwork['user_allowbbcode'] && $board_config['allow_bbcode']  ) ? true : false ;
$smilies_on = ( $userwork['user_allowsmile'] && $board_config['allow_smilies']  ) ? true : false ;

// check and set various parameters
$submit       = $_GETVAR->get('submit', '_POST', 'string', '');
$preview      = $_GETVAR->get('preview', '_POST', 'string', '');
$mode         = $_GETVAR->get('mode', '_REQUEST', 'string', '');
$signature    = $_GETVAR->get('message', '_POST', 'string', '');
$save         = $_GETVAR->get('save', '_POST', 'string', '');
$preview_sig  = '';
$save_message = '';
$user_sig     = '';
$sig_message  = '';
if ( $_GETVAR->get('cancel', '_POST') ) {
    if ( defined('IN_ADMIN_USERS') ) {
        redirect(admin_sid('admin_users&amp;mode=editprofile&amp;'.POST_USERS_URL.'='.$userwork['user_id']));
    } else {
        $redirect = 'index.php';
        redirect(append_sid($redirect, true));
    }
}

$page_title = $lang['Signature'];
include_once(NUKE_INCLUDE_DIR . 'functions_post.php');
include_once(NUKE_INCLUDE_DIR . 'bbcode.php');

// save new signature
if ( !empty($save)) {
    $template->assign_block_vars('switch_save_sig', array());
    if ( isset($signature) ) {
        if ( strlen( $signature ) > $board_config['max_sig_chars'] ) {
            $save_message = $lang['Signature_too_long'];
        } else {
            $signature  = check_words($signature);
            $bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
            $signature  = prepare_message($signature, $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
            $user_id    = $userwork['user_id'];
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_sig = '" . $signature . "', user_sig_bbcode_uid = '$bbcode_uid'
                    WHERE user_id = $user_id";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql);
            } else {
                $save_message = $lang['sig_save_message'];
            }
        }
    } else {
        message_die(GENERAL_MESSAGE, 'An Error occured while submitting Signature');
    }
} else if ( !empty($preview) ) {
    // catch the submitted message and prepare it for a preview
    $template->assign_block_vars('switch_preview_sig', array());
    if ( !empty($signature) ) {
        $preview_sig = $signature = deepStrip($signature);
        if ( strlen( $preview_sig ) > $board_config['max_sig_chars'] ) {
            $preview_sig = $lang['Signature_too_long'];
        } else {
            if( !$html_on ) {
                if( $preview_sig != '' || !$userwork['user_allowhtml'] ) {
                    $preview_sig = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $preview_sig);
                }
            }
            $bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
            $preview_sig = ($board_config['allow_bbcode']) ? decode_bbcode($preview_sig, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $preview_sig);
            $preview_sig = make_clickable($preview_sig);
            if ( $smilies_on ) { 
                $preview_sig = smilies_pass($preview_sig);
            }
            $preview_sig = str_replace("\n", "<br />", $preview_sig);
            $preview_sig = $board_config['sig_line'] . '<br />' . $preview_sig;
        }
    } else {
        $preview_sig = $lang['sig_none'];
    }
} else {
    // read current signature and prepare it for a preview
    $template->assign_block_vars('switch_current_sig', array());
    $bbcode_uid  = $userwork['user_sig_bbcode_uid'];
    $html_on     = ( $userwork['user_allowhtml'] && $board_config['allow_html'] ) ? 1 : 0 ;
    $bbcode_on   = ( $userwork['user_allowbbcode'] && $board_config['allow_bbcode']  ) ? 1 : 0 ;
    $smilies_on  = ( $userwork['user_allowsmile'] && $board_config['allow_smilies']  ) ? 1 : 0 ;
    $sig_message = preg_replace("/\:$bbcode_uid/si", '', $userwork['user_sig']);
    $user_sig    = prepare_message($userwork['user_sig'], $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
    if( $user_sig != '' ) {
        if ( $bbcode_on  == 1 ) { $user_sig = bbencode_second_pass($user_sig, $bbcode_uid); }
        if ( $bbcode_on  == 1 ) { $user_sig = bbencode_first_pass($user_sig, $bbcode_uid); }
        if ( $bbcode_on  == 1 ) { $user_sig = make_clickable($user_sig); }
        if ( $smilies_on == 1 ) { $user_sig = smilies_pass($user_sig); }
        $user_sig = $board_config['sig_line'] . $user_sig;
        $user_sig = nl2br($user_sig);
    } else {
        $user_sig = $lang['sig_none'];
    }
}

// template
$template->set_filenames(array(
    'body' => 'profile_signature.tpl'

));
// added some pic´s for a better preview ;)
$template->assign_vars(array(
    'PROFIL_IMG'        => '<img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" />',
    'EMAIL_IMG'         => '<img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" />',
    'PM_IMG'            => '<img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" />',
    'WWW_IMG'           => '<img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" />',
    'AIM_IMG'           => '<img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" />',
    'YIM_IMG'           => '<img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" />',
    'MSN_IMG'           => '<img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" />',
    'ICQ_IMG'           => '<img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" />',
    'SIG_SAVE'          => $lang['sig_save'],
    'SIG_CANCEL'        => $lang['Cancel'],
    'SIG_PREVIEW'       => $lang['Preview'],
    'SIG_EDIT'          => $lang['sig_edit'],
    'SIG_CURRENT'       => $lang['sig_current'],
    'SIG_LINK'          => (defined('IN_ADMIN_USERS') ? admin_sid('admin_users&amp;mode=signature&amp;'.POST_USERS_URL.'='.$userwork['user_id']) : append_sid('profile.php?mode=signature')),
    'U_PROFILE'         => (defined('IN_ADMIN_USERS') ? admin_sid('admin_users&amp;mode=editprofile&amp;'.POST_USERS_URL.'='.$userwork['user_id']) : append_sid('profile.php?mode=editprofile')),
    'L_PROFILE'         => $lang['Edit_profile'],
    'L_SIGNATURE'       => $lang['Signature'],
    'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config['max_sig_chars']),
    'HTML_STATUS'       => $html_status,
    'BBCODE_STATUS'     => sprintf($bbcode_status, '<a href="' . append_sid("faq.php?mode=bbcode") . '" onclick="window.open(this.href,\'_blank\'); return false;">', '</a>'),
    'SMILIES_STATUS'    => $smilies_status,
    'BB_BOX'            => bbcode_table('message', 'post', 1, (($preview) ? $signature : $sig_message)),
    'SIGNATURE'         => $signature,
    'CURRENT_PREVIEW'   => $user_sig,
    'PREVIEW'           => $signature,
    'REAL_PREVIEW'      => $preview_sig,
    'SAVE_MESSAGE'      => $save_message
    )
);
$template->pparse('body');
if ( defined('IN_ADMIN_USERS') ) {
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
} else {
    include_once(NUKE_INCLUDE_DIR . 'page_tail.php');
}

?>