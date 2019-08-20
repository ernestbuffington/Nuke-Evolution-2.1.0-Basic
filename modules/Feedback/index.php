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
   die('You can\'t access this file directly...');
}

global $_GETVAR, $board_config, $userinfo;

$op           = $_GETVAR->get('op', '_REQUEST', 'string');
$sender_name  = $_GETVAR->get('sender_name', '_REQUEST', 'string');
$sender_email = $_GETVAR->get('sender_email', '_REQUEST', 'string');
$message      = $_GETVAR->get('message', '_REQUEST', 'string');
$submit       = $_GETVAR->get('submit', '_REQUEST', 'string');
$gfx_check    = $_GETVAR->get('gfx_check', '_REQUEST', 'string');

$module_name = basename(dirname(__FILE__));
get_lang($module_name);


$pagetitle = _FEEDBACKTITLE;
include_once(NUKE_BASE_DIR.'header.php');

title(_FEEDBACKTITLE, $module_name, 'feedback-logo.png');

function feedback_header() {
    OpenTable2();
    echo  '<br /><center><span class="content">' . _FEEDBACKNOTE . '</span></center><br /> ';
    CloseTable2();
    echo '<br /><br />';
}

function feedback_form() {
    global $sender_name, $sender_email, $message, $userinfo;
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"> ';
    echo '<tr><td width="15%" align="left"><strong>' . _YOURNAME . ':</strong></td><td width="2%"></td>';
    if(is_user())
    {
      echo  '<td width="82%" align="left"><input type="hidden" name="sender_name" value="' . $userinfo['username'] . '" />' . UsernameColor($userinfo['username']) . '</td></tr> ';
      echo  '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
      echo  '<tr><td width="15%" align="left"><strong>' . _YOUREMAIL . ':</strong></td><td width="2%"></td>';
      echo  '<td width="82%" align="left"><input type="hidden" name="sender_email" value="' . $userinfo['user_email'] . '" />' . $userinfo['user_email'] . '</td></tr> ';
    } else {
      echo  '<td width="82%" align="left"><input type="text" name="sender_name" value="' . $sender_name . '" size="60" /></td></tr> ';
      echo  '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
      echo  '<tr><td width="15%" align="left"><strong>' . _YOUREMAIL . ':</strong></td><td width="2%"></td>';
      echo  '<td width="82%" align="left"><input type="text" name="sender_email" value="' . $sender_email . '" size="60" /></td></tr>';
    }
    echo  '</table><br />';
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"> ';
    echo  '<tr><td width="15%" align="left"><strong>' . _MESSAGE . ':</strong></td>';
    echo  '<td width="85%">';
    Make_TextArea('message', $message, 'feedback');
    echo  '</td></tr> ';
    echo  '</table>';
    echo  '<center><table><tr><td>&nbsp;</td><td>';
    echo  security_code(1, 'small', 1);
    echo  '</td></tr></table><br /><br />';
    echo  '<input type="hidden" name="op" value="ds" /> ';
    echo  '<input type="submit" name="submitter" value="' . _SEND . '" /><br /> ';
    echo  '</center>';
}


OpenTable();
feedback_header();

if ($op != 'ds') {
    echo "<form name=\"feedback\" onsubmit=\"this.submitter.disabled='true'\" method=\"post\" action=\"modules.php?name=$module_name\" >";
    feedback_form();
    echo  '</form> ';
} else {
    if (!security_code_check($gfx_check, 'force')) {
        echo '<div class="texterrorcenter">'._GFX_FAILURE.'</div>';
        echo '<br /><br />';
        echo '<center>' . _GOBACK . '</center>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    $send = TRUE;
    if (empty($sender_name)) {
        $name_err = '<div align="center"><span class="option"><strong><em>' . _FBENTERNAME . '</em></strong></span></div>&nbsp;<br />';
        $send = FALSE;
    }
    if (!Validate($sender_email, 'email', $module_name, 1)) {
        $email_err = '<div align="center"><span class="option"><strong><em>' . _FBENTEREMAIL . '</em></strong></span></div>&nbsp;<br />';
        $send = FALSE;
    }
    if (empty($message)) {
        $message_err = '<div align="center"><span class="option"><strong><em>' . _FBENTERMESSAGE . '</em></span></span></div>&nbsp;<br />';
        $send = FALSE;
    }

    if ( $send == TRUE || !empty($submit) ) {
        $super_admins = get_mod_admins('super');
        for ($i=0, $max = count($super_admins); $i < $max; $i++) {
            $admin = $super_admins[$i];
            if (!empty($admin['email'])) {
                $sender_name = stripslashes(Fix_Quotes(check_html(removecrlf($sender_name))));
                $sender_email = validate_mail(stripslashes(check_html(removecrlf($sender_email))));
                $subject = $board_config['sitename'] . ' '._FEEDBACK;
                $message = decode_bb_all($message, 5, 1);
                $msg = $board_config['sitename'] . '<br /><br />';
                $msg .= _SENDERNAME . ': ' . $sender_name . '<br />';
                $msg .= _SENDEREMAIL . ': ' . $sender_email . '<br />';
                $msg .= _MESSAGE . ': ' . $message . '<br /><br />';
                $msg .= 'IP: ' . identify::get_ip() . '<br /><br />';
                $email = $admin['email'];
                $from = $sender_email;
                $return = evo_mail($email, $subject, $msg, $from );
            }
        }
        echo '<div align="center"><p>' . _FBMAILSENT . '</p></div> ';
        echo '<div align="center"><p>' . _FBTHANKSFORCONTACT . '</p></div> ';
    } elseif ( $send == FALSE || !empty($submit) ) {
        OpenTable2();
        if (!empty($name_err)) { echo $name_err; }
        if (!empty($email_err)) {echo $email_err; }
        if (!empty($message_err)) {echo $message_err; }
        CloseTable2();
        echo '<br /><br />';
        echo "<form name=\"feedback\" onsubmit=\"this.submitter.disabled='true'\" method=\"post\" action=\"modules.php?name=$module_name\" >";
        feedback_form();
        echo  '</form> ';
    } else {
        DisplayError("<strong>"._ERROR."</strong><br /><br /> A problem occured in:  $module_name\"");
    }
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>