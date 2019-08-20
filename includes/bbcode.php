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

define("BBCODE_UID_LEN", 10);
@require_once(NUKE_INCLUDE_DIR . 'functions.php');
// global that holds loaded-and-prepared bbcode templates, so we only have to do
// that stuff once.

$bbcode_tpl = null;
/**
 * Loads bbcode templates from the bbcode.tpl file of the current template set.
 * Creates an array, keys are bbcode names like "b_open" or "url", values
 * are the associated template.
 * Probably pukes all over the place if there's something really screwed
 * with the bbcode.tpl file.
 *
 * Nathan Codding, Sept 26 2001.
 */

function load_bbcode_template() {
    global $template;
    $tpl_filename = $template->make_filename('bbcode.tpl');
    $tpl = @fread(@fopen($tpl_filename, 'r'), @filesize($tpl_filename));
    // replace \ with \\ and then ' with \'.
    $tpl = str_replace('\\', '\\\\', $tpl);
    $tpl  = str_replace('\'', '\\\'', $tpl);
    // strip newlines.
    $tpl  = str_replace("\n", '', $tpl);
    // Turn template blocks into PHP assignment statements for the values of $bbcode_tpls..
    $tpl = preg_replace('#<!-- BEGIN (.*?) -->(.*?)<!-- END (.*?) -->#', "\n" . '$bbcode_tpls[\'\\1\'] = \'\\2\';', $tpl);
    $bbcode_tpls = array();
    eval($tpl);
    return $bbcode_tpls;
}
/**
 * Prepares the loaded bbcode templates for insertion into preg_replace()
 * or str_replace() calls in the bbencode_second_pass functions. This
 * means replacing template placeholders with the appropriate preg backrefs
 * or with language vars. NOTE: If you change how the regexps work in
 * bbencode_second_pass(), you MUST change this function.
 *
 * Nathan Codding, Sept 26 2001
 *
 */
function prepare_bbcode_template($bbcode_tpl) {
    global $lang, $db;

    $bbcode_tpl['olist_open'] = str_replace('{LIST_TYPE}', '\\1', $bbcode_tpl['olist_open']);
    $bbcode_tpl['color_open'] = str_replace('{COLOR}', '\\1', $bbcode_tpl['color_open']);
    $bbcode_tpl['size_open'] = str_replace('{SIZE}', '\\1', $bbcode_tpl['size_open']);
    $bbcode_tpl['quote_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_open']);
    $bbcode_tpl['quote_username_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_username_open']);
    $bbcode_tpl['quote_username_open'] = str_replace('{L_WROTE}', $lang['wrote'], $bbcode_tpl['quote_username_open']);
    $bbcode_tpl['quote_username_open'] = str_replace('{USERNAME}', UsernameColor('\\1'), $bbcode_tpl['quote_username_open']);
    $bbcode_tpl['quote_post_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_post_open']);
    $temp_url = append_sid('show_post.php?p=\\1&amp;popup=1');
    $bbcode_tpl['quote_post_open'] = str_replace('{U_VIEW_POST}', '<a href="#_somewhat" onclick="javascript:open_postreview( \'' . $temp_url . '\' );" class="genmed">' . $lang['View_post'] . '</a>', $bbcode_tpl['quote_post_open']);
    $bbcode_tpl['quote_username_post_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_username_post_open']);
    $bbcode_tpl['quote_username_post_open'] = str_replace('{L_WROTE}', $lang['wrote'], $bbcode_tpl['quote_username_post_open']);
    $bbcode_tpl['quote_username_post_open'] = str_replace('{USERNAME}', UsernameColor('\\1'), $bbcode_tpl['quote_username_post_open']);
    $temp_url = append_sid('show_post.php?p=\\2&amp;popup=1');
    $bbcode_tpl['quote_username_post_open'] = str_replace('{U_VIEW_POST}', '<a href="#_somewhat" onclick="javascript:open_postreview( \'' . $temp_url . '\' );" class="genmed">' . $lang['View_post'] . '</a>', $bbcode_tpl['quote_username_post_open']);
    $bbcode_tpl['code_open'] = str_replace('{L_CODE}', $lang['Code'], $bbcode_tpl['code_open']);
    $bbcode_tpl['php_open'] = str_replace('{L_PHP}', $lang['PHPCode'], $bbcode_tpl['php_open']); // PHP MOD
    $bbcode_tpl['img'] = str_replace('{URL}', '\\1', $bbcode_tpl['img']);
    $bbcode_tpl['url1'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url1']);
    $bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);
    $bbcode_tpl['url3'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url3']);
    $bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url4']);
    $bbcode_tpl['email'] = str_replace('{EMAIL1}', '\\1', $bbcode_tpl['email']);
    $bbcode_tpl['email'] = str_replace('{EMAIL2}', '\\2', $bbcode_tpl['email']);
    $bbcode_tpl['email'] = str_replace('{EMAIL3}', '\\3', $bbcode_tpl['email']);
    $bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);
    $bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_HIDDEN}', $lang['BBCode_box_hidden'], $bbcode_tpl['spoil_open']);
    $bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_VIEW}', $lang['BBcode_box_view'], $bbcode_tpl['spoil_open']);
    $bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_HIDE}', $lang['BBcode_box_hide'], $bbcode_tpl['spoil_open']);
    $bbcode_tpl['align_open'] = str_replace('{ALIGN}', '\\1', $bbcode_tpl['align_open']);
    $bbcode_tpl['stream'] = str_replace('{URL}', '\\1', $bbcode_tpl['stream']);
    $bbcode_tpl['ram'] = str_replace('{URL}', '\\3', $bbcode_tpl['ram']);
    $bbcode_tpl['ram'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['ram']);
    $bbcode_tpl['ram'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['ram']);
    $bbcode_tpl['ram'] = str_replace('{ID}', '\\4', $bbcode_tpl['ram']);
    $bbcode_tpl['marq_open'] = str_replace('{MARQ}', '\\1', $bbcode_tpl['marq_open']);
    $bbcode_tpl['table_open'] = str_replace('{TABLE}', '\\1', $bbcode_tpl['table_open']);
    $bbcode_tpl['cell_open'] = str_replace('{CELL}', '\\1', $bbcode_tpl['cell_open']);
    $bbcode_tpl['flash'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['flash']);
    $bbcode_tpl['flash'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['flash']);
    $bbcode_tpl['flash'] = str_replace('{URL}', '\\3', $bbcode_tpl['flash']);
    $bbcode_tpl['video'] = str_replace('{URL}', '\\3', $bbcode_tpl['video']);
    $bbcode_tpl['video'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['video']);
    $bbcode_tpl['video'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['video']);
    $bbcode_tpl['font_open'] = str_replace('{FONT}', '\\1', $bbcode_tpl['font_open']);
    $bbcode_tpl['GVideo'] = str_replace('{GVIDEOID}', '\\1', $bbcode_tpl['GVideo']);
    $bbcode_tpl['GVideo'] = str_replace('{GVIDEOLINK}', $lang['GVideo_link'], $bbcode_tpl['GVideo']);
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBEPREFIX}', '\\2', $bbcode_tpl['youtube']);
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBESUFFIX}', 'com', $bbcode_tpl['youtube']);
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBEID}', '\\1', $bbcode_tpl['youtube']);
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBELINK}', $lang['youtube_link'], $bbcode_tpl['youtube']);

    $u_sxbb_jslib = NUKE_INCLUDE_HREF_DIR . 'select_expand_bbcodes.js';

    // Replacing BBCode variables, but also adding CR to preserve HTML comment delimiters for JS code.
    $expand_ary1 = array('<!--', '//-->', '{L_SELECT}', '{L_EXPAND}', '{L_CONTRACT}', '{U_SXBB_JSLIB}');
    $expand_ary2 = array("\r<!--\r", "\r//-->\r", $lang['Select'], $lang['Expand'], $lang['Contract'], $u_sxbb_jslib);
    $expand_ary3 = array('<!--', '//-->');
    $expand_ary4 = array("\r<!--\r", "\r//-->\r");

    $bbcode_tpl['quote_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['quote_open']);
    $bbcode_tpl['quote_username_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['quote_username_open']);
    $bbcode_tpl['code_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['code_open']);
    $bbcode_tpl['quote_post_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['quote_post_open']);
    $bbcode_tpl['quote_username_post_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['quote_username_post_open']);
    $bbcode_tpl['php_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['php_open']);
    $bbcode_tpl['quote_close'] = str_replace($expand_ary3, $expand_ary4, $bbcode_tpl['quote_close']);
    $bbcode_tpl['code_close'] = str_replace($expand_ary3, $expand_ary4, $bbcode_tpl['code_close']);
//    $bbcode_tpl['quote_post_close'] = str_replace($expand_ary3, $expand_ary4, $bbcode_tpl['quote_post_close']);
//    $bbcode_tpl['quote_username_post_close'] = str_replace($expand_ary3, $expand_ary4, $bbcode_tpl['quote_username_post_close']);
    $bbcode_tpl['php_close'] = str_replace($expand_ary3, $expand_ary4, $bbcode_tpl['php_close']);

    define("BBCODE_TPL_READY", true);
    return $bbcode_tpl;
}

function replacer($mode, $bb) {
    global $userinfo, $lang, $board_config;

    switch($mode) {
        case 'img':
            $message = $lang['Images_Allowed_For_Registered_Only'];
            break;
        case 'link':
            $message = $lang['Links_Allowed_For_Registered_Only'];
            break;
        case 'email':
            $message = $lang['Emails_Allowed_For_Registered_Only'];
            break;
    }

    $replacer = '<table width="40%" cellspacing="1" cellpadding="3" border="0"><tr><td class="quote">';
    $replacer .= $message . '<br />';
    $replacer .= sprintf($lang['Get_Registered'], "<a href=\"" . append_sid('profile.php?mode=register') . "\">", "</a>");
    $replacer .= "<a href=\"modules.php?name=Forums&amp;file=login\">" . $lang['Login'] . "</a>";
    $replacer .= '</td></tr></table>';

    if (is_user()) {
        switch($mode) {
            case 'img':
                $user_option = $userinfo['user_hide_images'];
                break;
            case 'link':
                $user_option = 0;
                break;
            case 'email':
                $user_option = $userinfo['user_viewemail'];
                break;
            default:
                $user_option = 0;
            break;
        }
        $replacer = '<table width="40%" cellspacing="1" cellpadding="3" border="0"><tr><td class="quote">';
        $replacer .= sprintf($lang['Image_Blocked'], "<a href=\"" . append_sid('profile.php') . "\">", "</a>");
        $replacer .= '</td></tr></table>';
        if ($user_option) {
            return $replacer;
        } else {
            return $bb;
        }
    } else {
        switch($mode) {
            case 'img':
                $config = $board_config['hide_images'];
                break;
            case 'link':
                $config = $board_config['hide_links'];
                break;
            case 'email':
                $config = $board_config['hide_emails'];
            break;
        }
        if ($config) {
            return $replacer;
        } else {
            return $bb;
        }
    }
}

/**
 * Does second-pass bbencoding. This should be used before displaying the message in
 * a thread. Assumes the message is already first-pass encoded, and we are given the
 * correct UID as used in first-pass encoding.
 */
function bbencode_second_pass($text, $uid, $image_resize=TRUE) {
    global $lang, $bbcode_tpl, $userdata, $board_config;

    $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

    // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
    // This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
    $text = " " . $text;

    // First: If there isn't a "[" and a "]" in the message, don't bother.
    if (! (strpos($text, "[") && strpos($text, "]")) ) {
        // Remove padding, return.
        $text = substr($text, 1);
        return $text;
    }

    // Only load the templates ONCE..
    if (!defined("BBCODE_TPL_READY")) {
        // load templates from file into array.
        $bbcode_tpl = load_bbcode_template();

        // prepare array for use in regexps.
        $bbcode_tpl = prepare_bbcode_template($bbcode_tpl);
    }

    // [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
    $text = bbencode_second_pass_code($text, $uid, $bbcode_tpl);
    // [PHP] and [/PHP] for posting PHP code in your posts.
    $text = bbencode_second_pass_php($text, $uid, $bbcode_tpl);
    // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
    $text = str_replace("[quote:$uid]", $bbcode_tpl['quote_open'], $text);
    $text = str_replace("[/quote:$uid]", $bbcode_tpl['quote_close'], $text);
    // opening a quote with a pre-defined post entry
    $text = preg_replace("/\[quote:$uid=p=&quot;([0-9]+)&quot;\]/si", $bbcode_tpl['quote_post_open'], $text);
    $text = preg_replace("/\[quote:$uid=p=\"([0-9]+)\"\]/si", $bbcode_tpl['quote_post_open'], $text);
    // opening a username quote with a pre-defined post entry
    $text = preg_replace("/\[quote:$uid=(?:&quot;?([^\"]*)&quot;?);p=(?:&quot;?([0-9]+)&quot;?)\]/si", $bbcode_tpl['quote_username_post_open'], $text);
    $text = preg_replace("/\[quote:$uid=(?:\"?([^\"]*)\"?);p=(?:\"?([0-9]+)\"?)\]/si", $bbcode_tpl['quote_username_post_open'], $text);
    $text = preg_replace("/\[quote:$uid=(?:\"?([^\"]*)&quot;?);p=(?:&quot;?([0-9]+)\"?)\]/si", $bbcode_tpl['quote_username_post_open'], $text);
    // New one liner to deal with opening quotes with usernames...
    // replaces the two line version that I had here before..
    $text = preg_replace("/\[quote:$uid=\"(.*?)\"\]/si", $bbcode_tpl['quote_username_open'], $text);
    //Fix for the destroyed quotes Technocrat
    $text = preg_replace("/\[quote:$uid=&quot;(.*?)&quot;\]/si", $bbcode_tpl['quote_username_open'], $text);
    // [list] and [list=x] for (un)ordered lists.
    // unordered lists
    $text = str_replace("[list:$uid]", $bbcode_tpl['ulist_open'], $text);
    // li tags
    $text = str_replace("[*:$uid]", $bbcode_tpl['listitem'], $text);
    // ending tags
    $text = str_replace("[/list:u:$uid]", $bbcode_tpl['ulist_close'], $text);
    $text = str_replace("[/list:o:$uid]", $bbcode_tpl['olist_close'], $text);
    // Ordered lists
    $text = preg_replace("/\[list=([a1]):$uid\]/si", $bbcode_tpl['olist_open'], $text);
    // colours
    $text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['color_open'], $text);
    $text = str_replace("[/color:$uid]", $bbcode_tpl['color_close'], $text);
    // size
    $text = preg_replace("/\[size=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['size_open'], $text);
    $text = str_replace("[/size:$uid]", $bbcode_tpl['size_close'], $text);
    // [b] and [/b] for bolding text.
    $text = str_replace("[b:$uid]", $bbcode_tpl['b_open'], $text);
    $text = str_replace("[/b:$uid]", $bbcode_tpl['b_close'], $text);
    // [u] and [/u] for underlining text.
    $text = str_replace("[u:$uid]", $bbcode_tpl['u_open'], $text);
    $text = str_replace("[/u:$uid]", $bbcode_tpl['u_close'], $text);
    // [i] and [/i] for italicizing text.
    $text = str_replace("[i:$uid]", $bbcode_tpl['i_open'], $text);
    $text = str_replace("[/i:$uid]", $bbcode_tpl['i_close'], $text);
    // Patterns and replacements for URL and email tags..
    $patterns = array();
    $replacements = array();
    // [img]image_url_here[/img] code..
    // This one gets first-passed..
    $patterns[] = "#\[img:$uid\]([^?](?:[^\[]+|\[(?!url))*?)\[/img:$uid\]#i";
    $replacements[] = replacer('img', $bbcode_tpl['img']);
    // matches a [url]xxxx://www.phpbb.com[/url] code..
    $patterns[] = "#\[url\]([\w]+?://([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url1']);
    // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
    $patterns[] = "#\[url\]((www|ftp)\.([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url2']);
    // [url=xxxx://www.phpbb.com]phpBB[/url] code..
    $patterns[] = "#\[url=([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url3']);
    // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
    $patterns[] = "#\[url=((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url4']);
    // [email]user@domain.tld[/email] code..
    $patterns[] = "#\[email\]([a-z0-9&\-_.]+?)@([a-z0-9&\-_.]+)\.([a-z]+)\[/email\]#si";
      $replacements[] = replacer('email', $bbcode_tpl['email']);
    // [fade]Faded Text[/fade] code..
    $text = str_replace("[fade:$uid]", $bbcode_tpl['fade_open'], $text);
    $text = str_replace("[/fade:$uid]", $bbcode_tpl['fade_close'], $text);
    // [ram]Ram URL[/ram] code..
    $patterns[] = "#\[ram width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/ram:($uid)\]#si";
    $replacements[] = $bbcode_tpl['ram'];
    // [stream]Sound URL[/stream] code..
    $patterns[] = "#\[stream:$uid\](.*?)\[/stream:$uid\]#si";
    $replacements[] = $bbcode_tpl['stream'];
    // [flash width=X height=X]Flash URL[/flash] code..
    $patterns[] = "#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/flash:$uid\]#si";
    $replacements[] = $bbcode_tpl['flash'];
    // [video width=X height=X]Video URL[/video] code..
    $patterns[] = "#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/video:$uid\]#si";
    $replacements[] = $bbcode_tpl['video'];
    $text = preg_replace($patterns, $replacements, $text);
    // [align=left/center/right/justify]Formatted Code[/align] code..
    $text = preg_replace("/\[align=(left|right|center|justify):$uid\]/si", $bbcode_tpl['align_open'], $text);
    $text = str_replace("[/align:$uid]", $bbcode_tpl['align_close'], $text);
     // [marquee=left/right/up/down]Marquee Code[/marquee] code..
    $text = preg_replace("/\[marq=(left|right|up|down):$uid\]/si", $bbcode_tpl['marq_open'], $text);
    $text = str_replace("[/marq:$uid]", $bbcode_tpl['marq_close'], $text);
    // [table=blah]Table[/table] code..
    $text = preg_replace("/\[table=(.*?):$uid\]/si", $bbcode_tpl['table_open'], $text);
    $text = str_replace("[/table:$uid]", $bbcode_tpl['table_close'], $text);
    // [cell=blah]Cell[/table] code..
    $text = preg_replace("/\[cell=(.*?):$uid\]/si", $bbcode_tpl['cell_open'], $text);
    $text = str_replace("[/cell:$uid]", $bbcode_tpl['cell_close'], $text);
    // [font=fonttype]text[/font] code..
    $text = preg_replace("/\[font=(.*?):$uid\]/si", $bbcode_tpl['font_open'], $text);
    $text = str_replace("[/font:$uid]", $bbcode_tpl['font_close'], $text);
    // [hr]
    $text = str_replace("[hr:$uid]", $bbcode_tpl['hr'], $text);
    // [sub]Subscrip[/sub] code..
    $text = str_replace("[sub:$uid]", '<sub>', $text);
    $text = str_replace("[/sub:$uid]", '</sub>', $text);
    // [sup]Superscript[/sup] code..
    $text = str_replace("[sup:$uid]", '<sup>', $text);
    $text = str_replace("[/sup:$uid]", '</sup>', $text);
    // [strike]Strikethrough[/strike] code..
    $text = str_replace("[s:$uid]", '<strike>', $text);
    $text = str_replace("[/s:$uid]", '</strike>', $text);
    // [spoil]Spoiler[/spoil] code..
    $text = str_replace("[spoil:$uid]", $bbcode_tpl['spoil_open'], $text);
    $text = str_replace("[/spoil:$uid]", $bbcode_tpl['spoil_close'], $text);
    // [GVideo]GVideo URL[/GVideo] code..
    $patterns[] = "#\[GVideo\]http://video.google.[A-Za-z0-9.]{2,5}/videoplay\?docid=([0-9A-Za-z-_]*)[^[]*\[/GVideo\]#is";
    $replacements[] = $bbcode_tpl['GVideo'];
     // [youtube]YouTube URL[/youtube] code..
    $patterns[] = "#\[youtube\]http://[A-Za-z0-9.]{2,5}.youtube.com/watch\?v=([0-9A-Za-z-_]{11})[^[]*\[/youtube\]#is";
    $replacements[] = $bbcode_tpl['youtube'];
    $text = preg_replace($patterns, $replacements, $text);
    // Remove our padding from the string..
    $text = substr($text, 1);
    if ($image_resize) {
        $text = evo_img_tag_to_resize($text);
    }
    return $text;

} // bbencode_second_pass()

// Need to initialize the random numbers only ONCE
mt_srand((double) microtime() * 1000000);

function make_bbcode_uid() {
    // Unique ID for this message..
    $uid = dss_rand();
    $uid = substr($uid, 0, BBCODE_UID_LEN);
    return $uid;
}

function bbencode_first_pass($text, $uid) {
    // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
    // This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
    $text = " " . $text;
    if( preg_match('/<img.*>/', $text) ) {
        //    message_die(GENERAL_ERROR, "The ".htmlentities("<img>")." tag is not allowed");
    }
    // [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
    $text = bbencode_first_pass_pda($text, $uid, '[code]', '[/code]', '', true, '');
    // [PHP] and [/PHP] for posting PHP code in your posts.
    $text = bbencode_first_pass_pda($text, $uid, '[php]', '[/php]', '', true, '');
    // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff with an pre-defined post entry
    $text = bbencode_first_pass_pda($text, $uid, '/\[quote=p=\\\\&quot;([0-9]+)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=p=\\\"\\1\\\"]");
    $text = bbencode_first_pass_pda($text, $uid, '/\[quote=p=&quot;([0-9]+)&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=p=\\\"\\1\\\"]");
    $text = bbencode_first_pass_pda($text, $uid, '/\[quote=&quot;(.*?)&quot;;p=&quot;([0-9]+)&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\";p=\\\"\\2\\\"]");
    $text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;;p=\\\\&quot;([0-9]+)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\";p=\\\"\\2\\\"]");
    // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
    $text = bbencode_first_pass_pda($text, $uid, '[quote]', '[/quote]', '', false, '');
    //Removed by Techno (http://evaders.swrebellion.com/forums/postt34.html)
//  $text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\&quot;\\1\\\&quot;]");
    $text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\&quot;(.*?)\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\"]");
    // [list] and [list=x] for (un)ordered lists.
    $open_tag = array();
    $open_tag[0] = "[list]";
    // unordered..
    $text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:u]", false, 'replace_listitems');
    $open_tag[0] = "[list=1]";
    $open_tag[1] = "[list=a]";
    // ordered.
    $text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:o]",  false, 'replace_listitems');
    // [color] and [/color] for setting text color
    $text = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "[color=\\1:$uid]\\2[/color:$uid]", $text);
    // [size] and [/size] for setting text size
    $text = preg_replace("#\[size=([1-2]?[0-9])\](.*?)\[/size\]#si", "[size=\\1:$uid]\\2[/size:$uid]", $text);
    // [b] and [/b] for bolding text.
    $text = preg_replace("#\[b\](.*?)\[/b\]#si", "[b:$uid]\\1[/b:$uid]", $text);
    // [u] and [/u] for underlining text.
    $text = preg_replace("#\[u\](.*?)\[/u\]#si", "[u:$uid]\\1[/u:$uid]", $text);
    // [i] and [/i] for italicizing text.
    $text = preg_replace("#\[i\](.*?)\[/i\]#si", "[i:$uid]\\1[/i:$uid]", $text);
    // [img]image_url_here[/img] code..
    $text = preg_replace("#\[img\](.*?)\[/img\]#sie", "'[img:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/img:$uid]'", $text);
    // [fade]Faded Text[/fade] code..
    $text = preg_replace("#\[fade\](.*?)\[/fade\]#si", "[fade:$uid]\\1[/fade:$uid]", $text);
    // [align=left/center/right/justify]Formatted Code[/align] code..
    $text = preg_replace("#\[align=(left|right|center|justify)\](.*?)\[/align\]#si", "[align=\\1:$uid]\\2[/align:$uid]", $text);
     // [marquee=left/right/up/down]Marquee Code[/marquee] code..
    $text = preg_replace("#\[marq=(left|right|up|down)\](.*?)\[/marq\]#si", "[marq=\\1:$uid]\\2[/marq:$uid]", $text);
    // [table=blah]Table[/table] code..
    $text = preg_replace("#\[table=(.*?)\](.*?)\[/table\]#si", "[table=\\1:$uid]\\2[/table:$uid]", $text);
    // [cell=blah]Cell[/table] code..
    $text = preg_replace("#\[cell=(.*?)\](.*?)\[/cell\]#si", "[cell=\\1:$uid]\\2[/cell:$uid]", $text);
    // [font=fonttype]text[/font] code..
    $text = preg_replace("#\[font=(.*?)\](.*?)\[/font\]#si", "[font=\\1:$uid]\\2[/font:$uid]", $text);
    // [ram]Ram URL[/ram] code..
    $text = preg_replace("#\[ram width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/ram\]#si","[ram width=\\1 height=\\2:$uid\]\\3[/ram:$uid]", $text);
    // [stream]Sound URL[/stream] code..
    $text = preg_replace("#\[stream\](.*?)\[/stream\]#si", "[stream:$uid]\\1[/stream:$uid]", $text);
    // [flash width=X height=X]Flash URL[/flash] code..
    $text = preg_replace("#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/flash\]#si","[flash width=\\1 height=\\2:$uid\]\\3[/flash:$uid]", $text);
    // [video width=X height=X]Video URL[/video] code..
    $text = preg_replace("#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/video\]#si","[video width=\\1 height=\\2:$uid\]\\3[/video:$uid]", $text);
    // [hr]
    $text = preg_replace("#\[hr\]#si", "[hr:$uid]", $text);
    // [strike]Strikethrough[/strike] code..
    $text = preg_replace("#\[s\](.*?)\[/s\]#si", "[s:$uid]\\1[/s:$uid]", $text);
    // [spoil]Spoiler[/spoil] code..
    $text = preg_replace("#\[spoil\](.*?)\[/spoil\]#si", "[spoil:$uid]\\1[/spoil:$uid]", $text);
    // [sub]Subscrip[/sub] code..
    $text = preg_replace("#\[sub\](.*?)\[/sub\]#si", "[sub:$uid]\\1[/sub:$uid]", $text);
    // [sup]Superscript[/sup] code..
    $text = preg_replace("#\[sup\](.*?)\[/sup\]#si", "[sup:$uid]\\1[/sup:$uid]", $text);

    // Remove our padding from the string..
    return substr($text, 1);;

} // bbencode_first_pass()

/**
 * $text - The text to operate on.
 * $uid - The UID to add to matching tags.
 * $open_tag - The opening tag to match. Can be an array of opening tags.
 * $close_tag - The closing tag to match.
 * $close_tag_new - The closing tag to replace with.
 * $mark_lowest_level - boolean - should we specially mark the tags that occur
 *                     at the lowest level of nesting? (useful for [code], because
 *                        we need to match these tags first and transform HTML tags
 *                        in their contents..
 * $func - This variable should contain a string that is the name of a function.
 *                That function will be called when a match is found, and passed 2
 *                parameters: ($text, $uid). The function should return a string.
 *                This is used when some transformation needs to be applied to the
 *                text INSIDE a pair of matching tags. If this variable is FALSE or the
 *                empty string, it will not be executed.
 * If open_tag is an array, then the pda will try to match pairs consisting of
 * any element of open_tag followed by close_tag. This allows us to match things
 * like [list=A]...[/list] and [list=1]...[/list] in one pass of the PDA.
 *
 * NOTES:    - this function assumes the first character of $text is a space.
 *                - every opening tag and closing tag must be of the [...] format.
 */
function bbencode_first_pass_pda($text, $uid, $open_tag, $close_tag, $close_tag_new, $mark_lowest_level, $func, $open_regexp_replace = false) {
    $open_tag_count = 0;
    if (!$close_tag_new || (empty($close_tag_new))) {
        $close_tag_new = $close_tag;
    }
    $close_tag_length = strlen($close_tag);
    $close_tag_new_length = strlen($close_tag_new);
    $uid_length = strlen($uid);
    $use_function_pointer = ($func && (!empty($func)));
    $stack = array();
    if (is_array($open_tag)) {
        if (0 == count($open_tag)) {
            // No opening tags to match, so return.
            return $text;
        }
        $open_tag_count = count($open_tag);
    } else {
        // only one opening tag. make it into a 1-element array.
        $open_tag_temp = $open_tag;
        $open_tag = array();
        $open_tag[0] = $open_tag_temp;
        $open_tag_count = 1;
    }
    $open_is_regexp = false;
    if ($open_regexp_replace) {
        $open_is_regexp = true;
        if (!is_array($open_regexp_replace)) {
            $open_regexp_temp = $open_regexp_replace;
            $open_regexp_replace = array();
            $open_regexp_replace[0] = $open_regexp_temp;
        }
    }
    if ($mark_lowest_level && $open_is_regexp) {
        message_die(GENERAL_ERROR, "Unsupported operation for bbcode_first_pass_pda().");
    }

    // Start at the 2nd char of the string, looking for opening tags.
    $curr_pos = 1;
    while ($curr_pos && ($curr_pos < strlen($text))) {
        $curr_pos = strpos($text, "[", $curr_pos);
        // If not found, $curr_pos will be 0, and the loop will end.
        if ($curr_pos) {
            // We found a [. It starts at $curr_pos.
            // check if it's a starting or ending tag.
            $found_start = false;
            $which_start_tag = "";
            $start_tag_index = -1;

            for ($i = 0; $i < $open_tag_count; $i++) {
                // Grab everything until the first "]"...
                $possible_start = substr($text, $curr_pos, strpos($text, ']', $curr_pos + 1) - $curr_pos + 1);
                //
                // We're going to try and catch usernames with "[' characters.
                //
                if( preg_match('#\[quote=\\\&quot;#si', $possible_start, $match) && !preg_match('#\[quote=\\\&quot;(.*?)\\\&quot;\]#si', $possible_start) ) {
                    // OK we are in a quote tag that probably contains a ] bracket.
                    // Grab a bit more of the string to hopefully get all of it..
                    if ($close_pos = strpos($text, '&quot;]', $curr_pos + 14)) {
                        if (strpos(substr($text, $curr_pos + 14, $close_pos - ($curr_pos + 14)), '[quote') === false) {
                            $possible_start = substr($text, $curr_pos, $close_pos - $curr_pos + 7);
                        }
                    }
                }
                // Now compare, either using regexp or not.
                if ($open_is_regexp) {
                    $match_result = array();
                    if (preg_match($open_tag[$i], $possible_start, $match_result)) {
                        $found_start = true;
                        $which_start_tag = $match_result[0];
                        $start_tag_index = $i;
                        break;
                    }
                } else {
                    // straightforward string comparison.
                    if (0 == strcasecmp($open_tag[$i], $possible_start)) {
                        $found_start = true;
                        $which_start_tag = $open_tag[$i];
                        $start_tag_index = $i;
                        break;
                    }
                }
            }
            if ($found_start) {
                // We have an opening tag.
                // Push its position, the text we matched, and its index in the open_tag array on to the stack, and then keep going to the right.
                $match = array("pos" => $curr_pos, "tag" => $which_start_tag, "index" => $start_tag_index);
                array_push($stack, $match);
                //
                // Rather than just increment $curr_pos
                // Set it to the ending of the tag we just found
                // Keeps error in nested tag from breaking out
                // of table structure..
                //
                $curr_pos += strlen($possible_start);
            } else {
                // check for a closing tag..
                $possible_end = substr($text, $curr_pos, $close_tag_length);
                if (0 == strcasecmp($close_tag, $possible_end)) {
                    // We have an ending tag.
                    // Check if we've already found a matching starting tag.
                    if (count($stack) > 0) {
                        // There exists a starting tag.
                        $curr_nesting_depth = count($stack);
                        // We need to do 2 replacements now.
                        $match = array_pop($stack);
                        $start_index = $match['pos'];
                        $start_tag = $match['tag'];
                        $start_length = strlen($start_tag);
                        $start_tag_index = $match['index'];
                        if ($open_is_regexp) {
                            $start_tag = preg_replace($open_tag[$start_tag_index], $open_regexp_replace[$start_tag_index], $start_tag);
                        }
                        // everything before the opening tag.
                        $before_start_tag = substr($text, 0, $start_index);
                        // everything after the opening tag, but before the closing tag.
                        $between_tags = substr($text, $start_index + $start_length, $curr_pos - $start_index - $start_length);
                        // Run the given function on the text between the tags..
                        if ($use_function_pointer) {
                            $between_tags = $func($between_tags, $uid);
                        }
                        // everything after the closing tag.
                        $after_end_tag = substr($text, $curr_pos + $close_tag_length);
                        // Mark the lowest nesting level if needed.
                        if ($mark_lowest_level && ($curr_nesting_depth == 1)) {
                            if ($open_tag[0] == '[code]') {
                                $code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
                                $code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
                                $between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
                            }
                            if ($open_tag[0] == '[php]') {
                                $between_tags = preg_replace('/\:[0-9a-z\:]+\]/si', ']', $between_tags);
                            }
                            $text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$curr_nesting_depth:$uid]";
                            $text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$curr_nesting_depth:$uid]";
                        } else {
                            if ($open_tag[0] == '[code]') {
                                $text = $before_start_tag . '&#91;code&#93;';
                                $text .= $between_tags . '&#91;/code&#93;';
                            } else if ($open_tag[0] == '[php]') {
                                $text = $before_start_tag . '&#91;php&#93;';
                                $text .= $between_tags . '&#91;/php&#93;';
                            } else {
                                if ($open_is_regexp) {
                                    $text = $before_start_tag . $start_tag;
                                } else {
                                    $text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$uid]";
                                }
                                $text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$uid]";
                            }
                        }
                        $text .= $after_end_tag;
                        // Now.. we've screwed up the indices by changing the length of the string.
                        // So, if there's anything in the stack, we want to resume searching just after it.
                        // otherwise, we go back to the start.
                        if (count($stack) > 0) {
                            $match = array_pop($stack);
                            $curr_pos = $match['pos'];
//                            bbcode_array_push($stack, $match);
//                            ++$curr_pos;
                        } else {
                            $curr_pos = 1;
                        }
                    } else {
                        // No matching start tag found. Increment pos, keep going.
                        ++$curr_pos;
                    }
                } else {
                    // No starting tag or ending tag.. Increment pos, keep looping.,
                    ++$curr_pos;
                }
            }
        }
    } // while
    return $text;
} // bbencode_first_pass_pda()

/**
 * Does second-pass bbencoding of the [code] tags. This includes
 * running htmlspecialchars() over the text contained between
 * any pair of [code] tags that are at the first level of
 * nesting. Tags at the first level of nesting are indicated
 * by this format: [code:1:$uid] ... [/code:1:$uid]
 * Other tags are in this format: [code:$uid] ... [/code:$uid]
 */
function bbencode_second_pass_code($text, $uid, $bbcode_tpl) {
    global $lang;

    $code_start_html = $bbcode_tpl['code_open'];
    $code_end_html =  $bbcode_tpl['code_close'];

    // First, do all the 1st-level matches. These need an htmlspecialchars() run,
    // so they have to be handled differently.
    $match_count = preg_match_all("#\[code:1:$uid\](.*?)\[/code:1:$uid\]#si", $text, $matches);
    for ($i = 0; $i < $match_count; $i++) {
        $before_replace = $matches[1][$i];
        $after_replace = $matches[1][$i];
        // Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
        $after_replace = str_replace("  ", "&nbsp; ", $after_replace);
        // now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
        $after_replace = str_replace("  ", " &nbsp;", $after_replace);
        // Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
        $after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);
        // now Replace space occurring at the beginning of a line
        $after_replace = preg_replace("/^ {1}/m", '&nbsp;', $after_replace);
        $str_to_match = "[code:1:$uid]" . $before_replace . "[/code:1:$uid]";
        $replacement = $code_start_html;
        $replacement .= $after_replace;
        $replacement .= $code_end_html;
        $text = str_replace($str_to_match, $replacement, $text);
    }
    // Now, do all the non-first-level matches. These are simple.
    $text = str_replace("[code:$uid]", $code_start_html, $text);
    $text = str_replace("[/code:$uid]", $code_end_html, $text);
    return $text;
} // bbencode_second_pass_code()

/**
 * PHP MOD
 * Original code/function by phpBB Group
 * Modified by JW Frazier / Fubonis < php_fubonis@yahoo.com >
 */
function bbencode_second_pass_php($text, $uid, $bbcode_tpl) {
    $code_start_html = $bbcode_tpl['php_open'];
    $code_end_html =  $bbcode_tpl['php_close'];
    // First, do all the 1st-level matches. These need an htmlspecialchars() run,
    // so they have to be handled differently.
    $match_count = preg_match_all("#\[php:1:$uid\](.*?)\[/php:1:$uid\]#si", $text, $matches);
    // To change the colors of the syntax, uncomment the 6 lines above and
    // change the color codes. IF your host php settings allow ini_set() the
    // colors will be changed. If ini_set() is disallowed, nothing will change.
//    @ini_set('highlight.string', '#DD0000');
//    @ini_set('highlight.comment', '#FF9900');
//    @ini_set('highlight.keyword', '#007700');
//    @ini_set('highlight.bg', '#FFFFFF');
//    @ini_set('highlight.default', '#0000BB');
//    @ini_set('highlight.html', '#000000');

    for ($i = 0; $i < $match_count; $i++) {
        $before_replace = $matches[1][$i];
        $after_replace = ltrim(rtrim($matches[1][$i]), "\n\r\x0B");
        $after_replace = str_replace(' &nbsp;', '  ', $after_replace);
        // Prepare the code for highlight_string()
        $after_replace = undo_htmlspecialchars($after_replace);
        // Add the php tags if needed to let highlight_string() works
        if (preg_match('/^<\?.*?\?>$/si', $after_replace) <= 0) {
            $after_replace = "<?php $after_replace ?>";
            $added = TRUE;
        } else {
            $added = FALSE;
        }
        // Highlight the php code
        if(strcmp('4.2.0', phpversion()) > 0) {
            ob_start();
            highlight_string($after_replace);
            $after_replace = ob_get_contents();
            ob_end_clean();
        } else {
            $after_replace = highlight_string($after_replace, TRUE);
        }
        // Remove the php tags if added to let highlight_string() works
        if ($added == TRUE) {
            $after_replace = substr_replace($after_replace, '', strpos($after_replace, '&lt;?php&nbsp;'), 14);
            $after_replace = substr_replace($after_replace, '', strrpos($after_replace, '?&gt;'), 5);
        }
        // Remove the <code> tag added by highlight_string() not to force the text size
        $after_replace = str_replace('<code>', '', $after_replace);
        $after_replace = str_replace('</code>', '', $after_replace);
        // Remove the new lines added by highlight_string()
        $after_replace = str_replace("\n", '', $after_replace);
        // Replace ":", "(" & ")" by their HTML codes to prevent smilies replacements
        $code_entities_match = array('#:#', '#\(#', '#\)#');
        $code_entities_replace = array('&#58;', '&#40;', '&#41;');
        $after_replace = preg_replace($code_entities_match, $code_entities_replace, $after_replace);
        // Replace <font color=...> by <span style="color:...> to be HTML 4 compliant and  not to force the text size too
        $after_replace = preg_replace('/<font color="(.*?)">/si', '<span style="color: \\1;">', $after_replace);
        $after_replace = str_replace('</font>', '</span>', $after_replace);
        $str_to_match = "[php:1:$uid]" . $before_replace . "[/php:1:$uid]";
        $replacement = $code_start_html;
        $replacement .= $after_replace;
        $replacement .= $code_end_html;
        $text = str_replace($str_to_match, $replacement, $text);
    }
    // Now, do all the non-first-level matches. These are simple.
    $text = str_replace("[php:$uid]", $code_start_html, $text);
    $text = str_replace("[/php:$uid]", $code_end_html, $text);
    return $text;
}  // bbencode_second_pass_code_php()

/**
 * Rewritten by Nathan Codding - Feb 6, 2001.
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 *     to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 *     to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *        to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function make_clickable($text) {
    global $userdata, $lang, $u_login_logout, $board_config;

    $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);
    // pad it with a space so we can match things at the start of the 1st line.
    $ret = ' ' . $text;
    // matches an "xxxx://yyyy" URL at the start of a line, or after a space.
    // xxxx can only be alpha characters.
    // yyyy is anything up to the first space, newline, comma, double quote or <
    $ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", replacer('link', "\\1<a href=\"\\2\" onclick=\"window.open(this.href,'_blank'); return false;\">\\2</a>"), $ret);
    // matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
    // Must contain at least 2 dots. xxxx contains either alphanum, or "-"
    // zzzz is optional.. will contain everything up to the first space, newline,
    // comma, double quote or <.
    $ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", replacer('link', "\\1<a href=\"http://\\2\" onclick=\"window.open(this.href,'_blank'); return false;\">\\2</a>"), $ret);
    // matches an email@domain type address at the start of a line, or after a space.
    // Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
    $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([a-z0-9&\-_.]+)\.([a-z]+)#i", replacer('email', "\\1<a href=\"javascript:phpbbmail('\\3.\\4','\\2');\">\\2 [at] \\3 [dot] \\4</a>"), $ret);
    // Remove our padding..
    $ret = substr($ret, 0);
    return($ret);
}

/**
 * Nathan Codding - Feb 6, 2001
 * Reverses the effects of make_clickable(), for use in editpost.
 * - Does not distinguish between "www.xxxx.yyyy" and "http://aaaa.bbbb" type URLs.
 *
 */
function undo_make_clickable($text) {
    $text = preg_replace("#<!-- BBCode auto-link start --><a href=\"(.*?)\" onclick=\"window.open(this.href,'_blank'); return false;\">.*?</a><!-- BBCode auto-link end -->#i", "\\1", $text);
    $text = preg_replace("#<!-- BBcode auto-mailto start --><a href=\"mailto:(.*?)\">.*?</a><!-- BBCode auto-mailto end -->#i", "\\1", $text);
    return $text;
}

/**
 * Nathan Codding - August 24, 2000.
 * Takes a string, and does the reverse of the PHP standard function
 * htmlspecialchars().
 */
function undo_htmlspecialchars($input) {
    $input = preg_replace("/&gt;/i", ">", $input);
    $input = preg_replace("/&lt;/i", "<", $input);
    $input = preg_replace("/&quot;/i", "\"", $input);
    $input = preg_replace("/&amp;/i", "&", $input);
    return $input;
}

/**
 * This is used to change a [*] tag into a [*:$uid] tag as part
 * of the first-pass bbencoding of [list] tags. It fits the
 * standard required in order to be passed as a variable
 * function into bbencode_first_pass_pda().
 */
function replace_listitems($text, $uid) {
    $text = str_replace("[*]", "[*:$uid]", $text);
    return $text;
}

/**
 * Escapes the "/" character with "\/". This is useful when you need
 * to stick a runtime string into a PREG regexp that is being delimited
 * with slashes.
 */
function escape_slashes($input) {
    $output = str_replace('/', '\/', $input);
    return $output;
}

/**
 * This function does exactly what the PHP4 function array_push() does
 * however, to keep phpBB compatable with PHP 3 we had to come up with our own
 * method of doing it.
 * This function was deprecated in phpBB 2.0.18
 */
function bbcode_array_push(&$stack, $value) {
    $stack[] = $value;
    return(count($stack));
}

/**
 * This function does exactly what the PHP4 function array_pop() does
 * however, to keep phpBB compatable with PHP 3 we had to come up with our own
 * method of doing it.
 * This function was deprecated in phpBB 2.0.18
 */
function bbcode_array_pop(&$stack) {
    $arrSize = count($stack);
    $x = 1;
    while(list($key, $val) = each($stack)) {
        if($x < count($stack)) {
            $tmpArr[] = $val;
        } else {
            $return_val = $val;
        }
        $x++;
    }
    $stack = $tmpArr;
    return($return_val);
}

//
// Smilies code ... would this be better tagged on to the end of bbcode.php?
// Probably so and I'll move it before B2
//
function smilies_pass($message) {
    static $orig, $repl;

    if (!isset($orig)) {
        global $db, $board_config, $cache;
        $orig = $repl = array();
        if(($smilies = $cache->load('smilies', 'config')) === FALSE) {
            $sql = 'SELECT * FROM ' . SMILIES_TABLE;
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
            }
            $smilies = $db->sql_fetchrowset($result);
            $db->sql_freeresult($result);
            $cache->save('smilies', 'config', $smilies);
        }
        if (count($smilies)) {
            usort($smilies, 'smiley_sort');
        }
        for ($i = 0; $i < count($smilies); $i++) {
            $orig[] = "/(?<=.\W|\W.|^\W)" . preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
            $repl[] = '<img src="'. NUKE_HREF_BASE_DIR . $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" title="' . $smilies[$i]['emoticon'] . '" />';
        }
    }
    if (count($orig)) {
        $message = preg_replace($orig, $repl, ' ' . $message . ' ');
        $message = substr($message, 1, -1);
    }
    return $message;
}

function smiley_sort($a, $b) {
    if ( strlen($a['code']) == strlen($b['code']) ) {
        return 0;
    }
    return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}

function word_wrap_pass($message) {
    global $userdata, $board_config;

    if ( !$board_config['wrap_enable'] ) {
        return $message;
    }
    $wordwrap = ($board_config['wrap_max'] < $userdata['user_wordwrap']) ? $board_config['wrap_max'] : $userdata['user_wordwrap'];
    $tempText = '';
    $finalText = '';
    $curCount = $tempCount = 0;
    $longestAmp = 9;
    $inTag = false;
    $ampText = '';
    $len = intval(strlen($message));
    $message = $message.' ';
    for ($num=0;$num < $len;$num++) {
        $curChar = $message{$num};
        if ($curChar == '<') {
            for ($snum=0;$snum < strlen($ampText);$snum++) {
                addWrap($ampText{$snum},$ampText{$snum+1},$wordwrap,$finalText,$tempText,$curCount,$tempCount);
            }
            $ampText = '';
            $tempText .= '<';
            $inTag = true;
        } elseif ($inTag && $curChar == '>') {
            $tempText .= '>';
            $inTag = false;
        } elseif ($inTag) {
            $tempText .= $curChar;
        } elseif ($curChar == '&') {
            for ($snum=0;$snum < strlen($ampText);$snum++) {
                addWrap($ampText{$snum},$ampText{$snum+1},$wordwrap,$finalText,$tempText,$curCount,$tempCount);
            }
            $ampText = '&';
        } elseif (strlen($ampText) < $longestAmp && $curChar == ';' && function_exists('html_entity_decode') &&
               (strlen(html_entity_decode("$ampText;")) == 1 || preg_match('/^&#[0-9]+$/',$ampText))) {
            addWrap($ampText.';',$message{$num+1},$wordwrap,$finalText,$tempText,$curCount,$tempCount);
            $ampText = '';
        } elseif (strlen($ampText) >= $longestAmp || $curChar == ';') {
            for ($snum=0;$snum < strlen($ampText);$snum++) {
                addWrap($ampText{$snum},$ampText{$snum+1},$wordwrap,$finalText,$tempText,$curCount,$tempCount);
            }
            addWrap($curChar,$message{$num+1},$wordwrap,$finalText,$tempText,$curCount,$tempCount);
            $ampText = '';
        } elseif (strlen($ampText) != 0 && strlen($ampText) < $longestAmp) {
            $ampText .= $curChar;
        } else {
            addWrap($curChar,$message{$num+1},$wordwrap,$finalText,$tempText,$curCount,$tempCount);
        }
    }
    return $finalText . $tempText;
}

function addWrap($curChar,$nextChar,$maxChars,&$finalText,&$tempText,&$curCount,&$tempCount) {
    $wrapProhibitedChars = "([{!;,.\\/:?}])";

    if ($curChar == ' ' || $curChar == "\n") {
        $finalText .= $tempText . $curChar;
        $tempText = '';
        $curCount = 0;
        $curChar = '';
    } else {
        $tempText .= $curChar;
        $curCount++;
    }
    // the following code takes care of (unicode) characters prohibiting non-mandatory breaks directly before them.
    // $curChar isn't a " " or "\n"
    if ($tempText != '' && $curChar != '') {
        $tempCount++;
    } elseif ( ($curCount == 1 && strstr($wrapProhibitedChars,$curChar) !== false) ||
             ($curCount == 0 && $nextChar != '' && $nextChar != ' ' && $nextChar != "\n" && strstr($wrapProhibitedChars,$nextChar) !== false)) {
        // $curChar is " " or "\n", but $nextChar prohibits wrapping.
        $tempCount++;
    } elseif (!($curCount == 0 && ($nextChar == ' ' || $nextChar == "\n"))) {
        // $curChar and $nextChar aren't both either " " or "\n"
        $tempCount = 0;
    }
    if ($tempCount >= $maxChars && $tempText == '') {
        $finalText .= '&nbsp;';
        $tempCount = 1;
        $curCount = 2;
    }
    if ($tempText == ''  && $curCount > 0) {
        $finalText .= $curChar;
    }
}

/***********************************************************************************
 string bbcode_table($field="message", $form="post", $allowed=0)
 Return a table with BBcode options
    $field  : the name of the <input>/<textare> field to communicate with, default = 'message'
    $form   : the name of the <form> to communicate with, default = 'post'
    $allowed: 0 = simple, 1 = all code
************************************************************************************/
if(!function_exists('get_code_lang')){ 
    function get_code_lang($var, $array) {
        return ($array[$var] != '') ? $array[$var] : $var;
    }
}

function bbcode_table($field="message", $form="post", $allowed=1, $message='') {
    global $currentlang, $lang, $ThemeInfo;
    
    if (@file_exists(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php')) {
        include(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php');
    } else {
        include(NUKE_LANGUAGE_DIR.'bbcode/lang-english.php');
    }
    $content = '';
    if (!defined("BBCODE_JS_ACTIVE")) {
        $content .= '<script type="text/javascript" charset="UTF-8">
                        var bbcode_error        = "'.$lang['bbcode_error'].'";
                        var bbcode_text_first   = "'.$lang['bbcode_text_first'].'";
                        var bbcode_rm_url       = "'.$lang['bbcode_rm_url'].'";
                        var bbcode_no_file_url  = "'.$lang['bbcode_no_file_url'].'";
                        var bbcode_less_letters = "'.$lang['bbcode_less_letters'].'";
                        var bbcode_rm_width     = "'.$lang['bbcode_rm_width'].'";
                        var bbcode_no_rm_width  = "'.$lang['bbcode_no_rm_width'].'";
                        var bbcode_rm_height    = "'.$lang['bbcode_rm_height'].'";
                        var bbcode_no_rm_height = "'.$lang['bbcode_no_rm_height'].'";
                        var bbcode_stream_url   = "'.$lang['bbcode_stream_url'].'";
                        var bbcode_video_url    = "'.$lang['bbcode_video_url'].'";
                        var bbcode_video_width  = "'.$lang['bbcode_video_width'].'";
                        var bbcode_no_video_width   = "'.$lang['bbcode_no_video_width'].'";
                        var bbcode_video_height = "'.$lang['bbcode_video_height'].'";
                        var bbcode_no_video_height  = "'.$lang['bbcode_no_video_height'].'";
                        var bbcode_google_url   = "'.$lang['bbcode_google_url'].'";
                        var bbcode_youtube      = "'.$lang['bbcode_youtube'].'";
                        var bbcode_email        = "'.$lang['bbcode_email'].'";
                        var bbcode_no_email     = "'.$lang['bbcode_no_email'].'";
                        var bbcode_flash_url    = "'.$lang['bbcode_flash_url'].'";
                        var bbcode_no_flash_url = "'.$lang['bbcode_no_flash_url'].'";
                        var bbcode_flash_width  = "'.$lang['bbcode_flash_width'].'";
                        var bbcode_no_flash_width   = "'.$lang['bbcode_no_flash_width'].'";
                        var bbcode_flash_height = "'.$lang['bbcode_flash_height'].'";
                        var bbcode_no_flash_height  = "'.$lang['bbcode_no_flash_height'].'";
                        var bbcode_url          = "'.$lang['bbcode_url'].'";
                        var bbcode_no_url       = "'.$lang['bbcode_no_url'].'";
                        var bbcode_pagename     = "'.$lang['bbcode_pagename'].'";
                        var bbcode_no_pagename  = "'.$lang['bbcode_no_pagename'].'";
                        var bbcode_web_pagename = "'.$lang['bbcode_web_pagename'].'";
                        var bbcode_img_url      = "'.$lang['bbcode_img_url'].'";
                        var bbcode_no_img_url   = "'.$lang['bbcode_no_img_url'].'";
                        var bbcode_quote        = "'.$lang['bbcode_quote'].'";
                        var bbcode_no_message   = "'.$lang['bbcode_no_message'].'";
    
        </script>';
        $content .= '<script language="JavaScript" src="modules/Forums/bbcode_box/bbcode_box.js" type="text/javascript" charset="UTF-8"></script>';
        define("BBCODE_JS_ACTIVE", 1);
    }
    $content .= '<table width="100%" cellpadding="0" cellspacing="0" border="0">
     <tr>
       <td class="row2" valign="top">
           <table id="posttable" width="100%" border="1" class="posting" cellspacing="0" cellpadding="0">
               <tr align="right" valign="middle">
                   <td valign="middle">
                       <table width="100%" class="postingInside" cellpadding="3" cellspacing="0" >
                           <tr>
                               <td class="row2">
                                   <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                       <tr>
                                           <td class="row2bbcode" align="left" width="95%">';
    if ($allowed) {                                           
        $content .= '                          <select name="addbbcode19"  style="height: 20px;" onchange="bbfontstyle(\'[font=\' + this.form.addbbcode19.options[this.form.addbbcode19.selectedIndex].value + \']\', \'[/font]\');this.selectedIndex=0;" onmouseover="helpline(\''.$lang['bbcode_font_help'].'\')">
                                                   <option style="font-weight : bold;" selected="selected">'.$lang['bbcode_font_type'].'</option>
                                                   <option style="font-family: Arial;" value="Arial" class="genmed">'.$lang['bbcode_font_default'].'</option>
                                                   <option style="font-family: Arial;" value="Arial" class="genmed">Arial</option>
                                                   <option style="font-family: Arial Black;" value="Arial Black" class="genmed">Arial Black</option>
                                                   <option style="font-family: Century Gothic;" value="Century Gothic" class="genmed">Century Gothic</option>
                                                   <option style="font-family: Comic Sans MS;" value="Comic Sans MS" class="genmed">Comic Sans MS</option>
                                                   <option style="font-family: Courier New;" value="Courier New" class="genmed">Courier New</option>
                                                   <option style="font-family: Georgia;" value="Georgia" class="genmed">Georgia</option>
                                                   <option style="font-family: Lucida Console;"value="Lucida Console">Lucida Console</option>
                                                   <option style="font-family: Microsoft Sans Serif;" value="Microsoft Sans Serif" class="genmed">Microsoft Sans Serif</option>
                                                   <option style="font-family: Symbol;" value="Symbol" class="genmed">Symbol</option>
                                                   <option style="font-family: Tahoma;" value="Tahoma" class="genmed">Tahoma</option>
                                                   <option style="font-family: Trebuchet;" value="Trebuchet" class="genmed">Trebuchet</option>
                                                   <option style="font-family: Times New Roman;" value="Times New Roman" class="genmed">Times New Roman</option>
                                                   <option style="font-family: Verdana;" value="Verdana" class="genmed">Verdana</option>
                                               </select>
                                               <select name="addbbcode20"  style="height: 20px;" onchange="bbfontstyle(\'[size=\' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + \']\', \'[/size]\');this.selectedIndex=0;" onmouseover="helpline(\''.$lang['bbcode_size_help'].'\')">
                                                   <option style="font-weight : bold;" selected="selected">'.$lang['Font_size'].'</option>
                                                   <option style="font-size: 8px;" value="8" class="genmed">'.$lang['font_tiny'].'</option>
                                                   <option style="font-size: 10px;" value="10" class="genmed">'.$lang['font_small'].'</option>
                                                   <option style="font-size: 12px;" value="12" class="genmed">'.$lang['font_normal'].'</option>
                                                   <option style="font-size: 18px;" value="18" class="genmed">'.$lang['font_large'].'</option>
                                                   <option style="font-size: 24px;" value="24" class="genmed">'.$lang['font_huge'].'</option>
                                               </select>';
    }
    $content .= '                              <select name="addbbcode18"  style="height: 20px;" onchange="bbfontstyle(\'[color=\' + this.form.addbbcode18.options[this.form.addbbcode18.selectedIndex].value + \']\', \'[/color]\');this.selectedIndex=0;" onmouseover="helpline(\''.$lang['bbcode_color_help'].'\')">
                                                   <option style="font-weight : bold;" selected="selected">'.$lang['Font_color'].'</option>
                                                   <option style="color:'.$ThemeInfo['textcolor1'].'; " value="'.$ThemeInfo['textcolor1'].'">'.$lang['color_default'].'</option>
                                                   <option style="color:darkred; " value="darkred">'.$lang['color_dark_red'].'</option>
                                                   <option style="color:red; " value="red" class="genmed">'.$lang['color_red'].'</option>
                                                   <option style="color:orange; " value="orange" class="genmed">'.$lang['color_orange'].'</option>
                                                   <option style="color:brown; " value="brown" class="genmed">'.$lang['color_brown'].'</option>
                                                   <option style="color:yellow; " value="yellow" class="genmed">'.$lang['color_yellow'].'</option>
                                                   <option style="color:green; " value="green" class="genmed">'.$lang['color_green'].'</option>
                                                   <option style="color:olive; " value="olive" class="genmed">'.$lang['color_olive'].'</option>
                                                   <option style="color:cyan; " value="cyan" class="genmed">'.$lang['color_cyan'].'</option>
                                                   <option style="color:blue; " value="blue" class="genmed">'.$lang['color_blue'].'</option>
                                                   <option style="color:darkblue; " value="darkblue" class="genmed">'.$lang['color_dark_blue'].'</option>
                                                   <option style="color:indigo; " value="indigo" class="genmed">'.$lang['color_indigo'].'</option>
                                                   <option style="color:violet; " value="violet" class="genmed">'.$lang['color_violet'].'</option>
                                                   <option style="color:white; " value="white" class="genmed">'.$lang['color_white'].'</option>
                                                   <option style="color:black; " value="black" class="genmed">'.$lang['color_black'].'</option>
                                               </select>
                                           </td>
                                           <td align="right" width="5%">
                                               <a href="http://hvmdesign.com/" class="gensmall" title="Advanced BBCode Box v5.0.0 MOD - by Disturbed One - www.HVMDesign.com" onclick="window.open(this.href,\'_blank\'); return false;">&copy;</a>
                                           </td>
                                       </tr>
                                   </table>
                               </td>
                           </tr>';
    if ($allowed) {
        $content .= '      <tr>
                               <td class="row2bbcode" valign="middle">
                                   <img src="'.NUKE_IMAGES_BASE_DIR.'bbcode/justify.gif" class="postimage" name="justify" onclick="BBCjustify()" onmouseover="helpline(\''.$lang['bbcode_justify_help'].'\')" alt="'.$lang['bbcode_alt_justify'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/right.gif" name="right" onclick="BBCright()" onmouseover="helpline(\''.$lang['bbcode_right_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_right'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/center.gif" name="center" onclick="BBCcenter()" onmouseover="helpline(\''.$lang['bbcode_center_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_center'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/left.gif" name="left" onclick="BBCleft()" onmouseover="helpline(\''.$lang['bbcode_left_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_left'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/sup.gif" class="postimage" name="supscript" onclick="BBCsup()" onmouseover="helpline(\''.$lang['bbcode_sup_help'].'\')" alt="'.$lang['bbcode_alt_sup'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/sub.gif" name="subs" class="postimage" onclick="BBCsub()" onmouseover="helpline(\''.$lang['bbcode_sub_help'].'\')" alt="'.$lang['bbcode_alt_sub'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/bold.gif" name="bold" onclick="BBCbold()" onmouseover="helpline(\''.$lang['bbcode_b_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_b'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/italic.gif" name="italic" onclick="BBCitalic()" onmouseover="helpline(\''.$lang['bbcode_i_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_i'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/under.gif" name="under" onclick="BBCunder()" onmouseover="helpline(\''.$lang['bbcode_u_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_u'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/strike.gif" class="postimage" name="strik" onclick="BBCstrike()" onmouseover="helpline(\''.$lang['bbcode_strike_help'].'\')" alt="'.$lang['bbcode_alt_s'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/fade.gif" name="fade" onclick="BBCfade()" onmouseover="helpline(\''.$lang['bbcode_fade_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_fade'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/grad.gif" name="grad" onclick="BBCgrad()" onmouseover="helpline(\''.$lang['bbcode_grad_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_grad'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/rtl.gif" name="dirrtl" onclick="BBCdir(\'rtl\')" onmouseover="helpline(\''.$lang['bbcode_rtl_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_rtl'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/ltr.gif" name="dirltr" onclick="BBCdir(\'ltr\')" onmouseover="helpline(\''.$lang['bbcode_ltr_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_ltr'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/marqd.gif" name="marqd" onclick="BBCmarqd()" onmouseover="helpline(\''.$lang['bbcode_marqd_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_marqd'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/marqu.gif" name="marqu" onclick="BBCmarqu()" onmouseover="helpline(\''.$lang['bbcode_marqu_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_marqu'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/marql.gif" name="marql" onclick="BBCmarql()" onmouseover="helpline(\''.$lang['bbcode_marql_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_marql'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/marqr.gif" name="marqr" onclick="BBCmarqr()" onmouseover="helpline(\''.$lang['bbcode_marqr_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_marqr'].'" />
                               </td>
                           </tr>
                           <tr>
                               <td class="row2bbcode" valign="middle">
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/code.gif" name="code" onclick="BBCcode()" onmouseover="helpline(\''.$lang['bbcode_code_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_code'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/php.gif" name="php" onclick="BBCphp()" onmouseover="helpline(\''.$lang['bbcode_php_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_php'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/quote.gif" name="quote" onclick="BBCquote()" onmouseover="helpline(\''.$lang['bbcode_quote_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_quote'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/spoil.gif" class="postimage" name="spoil" onclick="BBCspoil()" onmouseover="helpline(\''.$lang['bbcode_spoil_help'].'\')" alt="'.$lang['bbcode_alt_spoil'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/url.gif" name="url" onclick="BBCurl()" onmouseover="helpline(\''.$lang['bbcode_url_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_url'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/email.gif" name="email" onclick="BBCmail()" onmouseover="helpline(\''.$lang['bbcode_mail_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_email'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/img.gif" name="img" onclick="BBCimg()" onmouseover="helpline(\''.$lang['bbcode_img_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_img'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/flash.gif" name="flash" onclick="BBCflash()" onmouseover="helpline(\''.$lang['bbcode_flash_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_flash'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/video.gif" name="video" onclick="BBCvideo()" onmouseover="helpline(\''.$lang['bbcode_video_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_video'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/sound.gif" name="stream" onclick="BBCstream()" onmouseover="helpline(\''.$lang['bbcode_stream_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_stream'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/ram.gif" name="ram" onclick="BBCram()" onmouseover="helpline(\''.$lang['bbcode_ram_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_realmedia'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/googlevid.gif" name="GVideo" onclick="BBCGVideo()" onmouseover="helpline(\''.$lang['bbcode_googlevid_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_googlevid'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/youtube.gif" name="youtube" onclick="BBCyoutube()" onmouseover="helpline(\''.$lang['bbcode_youtube_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_youtube'].'" />
                                   <img style="padding-left: 5px; padding-right: 5px;" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/blackdot.gif" width="1" height="20" border="0" alt="" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/list.gif" name="listdf" onclick="BBClist()" onmouseover="helpline(\''.$lang['bbcode_list_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_list'].'" />
                                   <img border="0" src="'.NUKE_IMAGES_BASE_DIR.'bbcode/hr.gif" name="hr" onclick="BBChr()" onmouseover="helpline(\''.$lang['bbcode_hr_help'].'\')" class="postimage" alt="'.$lang['bbcode_alt_hr'].'" />
                               </td>
                           </tr>';
    }
    $content .= '      </table>
                   </td>
               </tr>
               <tr>
                   <td colspan="9">
                       <span class="gensmall">
                           <input type="text" name="helpbox" size="45" maxlength="100" style="width:100%; font-size:10px;" class="helpline" value="'.$lang['Styles_tip'].'" />
                       </span>
                   </td>
               </tr>
               <tr>
                   <td colspan="9">
                       <span class="gen">
                           <textarea name="'.$field.'" rows="15" cols="80" style="overflow: auto; width:98%; border: 0px;" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">'.$message.'</textarea>
                       </span>
                   </td>
               </tr>
           </table>
       </td>
     </tr>
   </table>';
   return $content;
}

function bbencode_strip($message, $uid) {
    $message = strip_tags($message);
    // url #2
    $message = str_replace("[url]","", $message);
    $message = str_replace("[/url]", "", $message);
    // url /\[url=([a-z0-9\-\.,\?!%\*_\/:;~\\&$@\/=\+]+)\](.*?)\[/url\]/si
    $message = preg_replace("/\[url=([a-z0-9\-\.,\?!%\*_\/:;~\\&$@\/=\+]+)\]/si", "", $message);
    $message = str_replace("[/url:$uid]", "", $message);
    $message = preg_replace("/\[.*?:$uid:?.*?\]/si", '', $message);
    $message = preg_replace('/\[url\]|\[\/url\]/si', '', $message);
    $message = str_replace('"', "'", $message);
    return $message;
}

?>