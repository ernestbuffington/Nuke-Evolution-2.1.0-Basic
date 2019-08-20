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

if(!defined('NUKE_EVO')) exit;

global $db, $userinfo, $admin_file, $_GETVAR;

$blockcontent = '';
if (is_user()) {
    $qs = defined('ADMIN_FILE') ? $admin_file.'.php?' : '';
    $qs_ary = explode('&', $_GETVAR->get('QUERY_STRING', '_SERVER'));
    $blockcontent = '';
    foreach($qs_ary as $var_temp => $value_temp) {
        $var_ary = explode('=', $value_temp);
        $var   = $var_ary[0];
        $value = (isset($var_ary[1]) ? $var_ary[1] : '');
        if ($var == 'name') {
            $name = $value;
            $qs .= $name.'&amp;';
        }
        if ($var != 'newlang' && $var != 'name')  {
            $qs .= $var.'='.$value.'&amp;';
        }
    }
    
    if (substr($qs, -5) == '&amp;') {
        $qs = substr($qs, 0, -5);
    }
    if (defined('ADMIN_FILE')) {
        $action = $qs;
    } elseif (!isset($name)) {
        $action = 'index.php';
    } else {
        $action = 'modules.php?name='.$qs;
    }

    $nb_unsubscribe = $_GETVAR->get('nb_unsubscribe', '_POST', 'string', '');
    $nb_subscribe   = $_GETVAR->get('nb_subscribe', '_POST', 'string', '');
    $user_id        = $userinfo['user_id'];
    if ($userinfo['newsletter']) {
        $message = $lang_block['BLOCK_NEWSLETTER_SUBSCRIBED'];
        $formaction = '<form action="'.$action.'" method="post"><input type="submit" name="nb_unsubscribe" value="'.$lang_block['BLOCK_NEWSLETTER_UNSUBSCRIBE'].'" /></form>';
        if ( $nb_unsubscribe == $lang_block['BLOCK_NEWSLETTER_UNSUBSCRIBE'] ) {
            $db->sql_uquery('UPDATE `'._USERS_TABLE.'` SET `newsletter`="0" WHERE `user_id`='.$user_id);
            redirect($action);
        }
    } else {
        $message = $lang_block['BLOCK_NEWSLETTER_SUBSCRIBED_NOT'];
        $formaction = '<form action="'.$action.'" method="post"><input type="submit" name="nb_subscribe" value="'.$lang_block['BLOCK_NEWSLETTER_SUBSCRIBE'].'" /></form>';
        if ( $nb_subscribe == $lang_block['BLOCK_NEWSLETTER_SUBSCRIBE'] ) {
            $db->sql_uquery('UPDATE `'._USERS_TABLE.'` SET `newsletter`="1" WHERE `user_id`='.$user_id);
            redirect($action);
        }
    }
} else {
    $message = $lang_block['BLOCK_NEWSLETTER_REGISTER_TEXT'];
    $formaction = '<a href="modules.php?name=Your_Account&amp;op=new_user" title="'.$lang_block['BLOCK_NEWSLETTER_REGISTER_DOIT'].'">'.$lang_block['BLOCK_NEWSLETTER_REGISTER_DOIT'].'</a>';
}

$news_img = '<img src="'.evo_image('newsletter.png', 'blocks').'" alt="'.$lang_block['BLOCK_NEWSLETTER_IMAGE_TEXT'].'" title="'.$lang_block['BLOCK_NEWSLETTER_IMAGE_TEXT'].'" />';

$content = "<div style='text-align:center; width: 100%;'>\n";
if (empty($formaction)) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= "<div style='text-align:center;'>".$news_img."</div>\n";
    $content .= "<div style='text-align:center;font-size: x-small;'>".$message."</div><br />\n";
    $content .= "<div style='text-align:center;font-size: x-small;'>".$formaction."</div>\n";
}
$content .= "</div>\n";

?>