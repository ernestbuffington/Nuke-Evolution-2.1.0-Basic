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

if ( !defined('NUKE_EVO') && !defined('IN_SMILIES') ) {
    die("You can't access this file directly...");
}

global $db, $currentlang, $ThemeSel;

if(@file_exists(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php')) {
    include(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php');
} else {
    include(NUKE_LANGUAGE_DIR.'bbcode/lang-english.php');
}
require_once(NUKE_CLASSES_DIR.'class.nbbcode.php');

$smilies_path = (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/images/smiles/icon_smile.gif')) ? NUKE_THEMES_MAIN_DIR.$ThemeSel.'/images/smiles/' : NUKE_IMAGES_BASE_DIR . 'smiles/';
$bbbttns_path = NUKE_IMAGES_BASE_DIR . 'bbcode/';

$bb_codes['quote'] = '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center" class="bodyline"><tr>
    <td><span class="genmed"><strong>Quote:</strong></span></td>
</tr><tr>
    <td class="quote">';
$bb_codes['quote_name'] = '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center" class="bodyline"><tr>
    <td><span class="genmed"><strong>\\1 Wrote:</strong></span></td>
</tr><tr>
    <td class="quote">';
$bb_codes['quote_close'] = '</td></tr></table>';
$bb_codes['code_start'] = '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center" class="bodyline"><tr>
        <td><span class="genmed"><strong>Code:</strong></span></td>
</tr><tr>
    <td class="code"><code>';
$bb_codes['code_end'] =  '</code></td></tr></table>';
$bb_codes['php_start'] = '<table border="0" align="center" width="90%" cellpadding="3" cellspacing="1" class="bodyline"><tr>
    <td><span class="genmed"><strong>PHP:</strong></span></td>
</tr><tr>
    <td class="code">';
$bb_codes['php_end'] = '</td></tr></table>';
$bb_codes['win_start'] = '<html>
<head>
  <title>'.$bbcode_lang['More_emoticons'].'</title>
  <link rel="stylesheet" href="'.NUKE_THEMES_MAIN_DIR.$ThemeSel.'/style/style.css" type="text/css" />
</head>
<body>
<script language="javascript" type="text/javascript">
<!--
function emoticon(form, field, text) {
    text = \' \' + text + \' \';
    if (opener.document.forms[form].elements[field].createTextRange && opener.document.forms[form].elements[field].caretPos) {
        var caretPos = opener.document.forms[form].elements[field].caretPos;
        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == \' \' ? text + \' \' : text;
        opener.document.forms[form].elements[field].focus();
    } else {
        opener.document.forms[form].elements[field].value += text;
        opener.document.forms[form].elements[field].focus();
    }
}
//-->
</script>';
$bb_codes['win_end'] = '<br />
<div align="center"><a href="javascript:window.close();" class="genmed">'.$bbcode_lang['smilies_close'].'</a></div>
</body></html>';

function get_codelang($var, $array) {
    return (isset($array[$var])) ? $array[$var] : $var;
}

function smilies_table($mode, $field='message', $form='post', $id='textarea')
{
    global $bb_codes, $smilies_path, $currentlang, $smilies_desc;
    if(@file_exists(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php')) {
        include(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php');
    } else {
        include(NUKE_LANGUAGE_DIR.'bbcode/lang-english.php');
    }
    $url = NUKE_INCLUDE_HREF_DIR . 'more_smilies.php?form='.$form.'&amp;field='.$field;

    $inline_cols = 4;
    $inline_rows = 5;
    $window_cols = 8;

    $content = '';
    if ($mode == 'window') {
        $content = $bb_codes['win_start'];
    } else if (!defined('BBCODE_JS_ACTIVE') && !defined('BBCODE_SMILIES_ACTIVE')) {
        $content .= '<script language="javascript" type="text/javascript">
                    <!--
                    function emoticon(form, field, text) {
                        text = \' \' + text + \' \';
                        if (opener.document.forms[form].elements[field].createTextRange && opener.document.forms[form].elements[field].caretPos) {
                            var caretPos = opener.document.forms[form].elements[field].caretPos;
                            caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == \' \' ? text + \' \' : text;
                            opener.document.forms[form].elements[field].focus();
                        } else {
                            opener.document.forms[form].elements[field].value += text;
                            opener.document.forms[form].elements[field].focus();
                        }
                    }
                    //-->
                    </script>';
         define('BBCODE_SMILIES_ACTIVE', TRUE);
    } else {
        $content .= '<script language="javascript" type="text/javascript">
                     function emoticon(form, field, text) { BBCwrite(form, field, \'\', \' \'+text+\' \', true); }
                    </script>';
    }

    if ($mode == 'onerow') {
        $content .= '<table width="450" border="0" cellspacing="0" cellpadding="0">';
    } else {
        $content .= '<table width="100" border="0" cellspacing="0" cellpadding="5">';
    }
    $smilies = get_smilies();
    if (is_array($smilies)) {
        $num_smilies = 0;
        $rowset = array();
        for ($i=0; $i<count($smilies); ++$i) {
            if (empty($rowset[$smilies[$i]['smile_url']])) {
                $rowset[$smilies[$i]['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $smilies[$i]['code']));
                $rowset[$smilies[$i]['smile_url']]['emoticon'] = get_codelang($smilies[$i]['emoticon'],$smilies_desc);
                $num_smilies++;
            }
        }

        if ($num_smilies) {
            $smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
            $smilies_split_row = ($mode == 'inline') ? $inline_cols - 1 : $window_cols - 1;

            $s_colspan = $row = $col = 0;

            while (list($smile_url, $data) = each($rowset)) {
                if (!$col) {
                    $content .= '<tr align="center" valign="middle">'."\n";
                }
                $content .= "<td><a href=\"#".$id."\" onclick=\"javascript:emoticon('".$form."', '".$field."', '".$data['code']."')\"><img src=\"" . $smilies_path . $smile_url . "\" border=\"0\" alt=\"".$data['emoticon']."\" title=\"".$data['emoticon']."\" /></a></td>\n";
                $s_colspan = max($s_colspan, $col + 1);

                if ($mode == 'onerow') {
                    if ($col >= 15) {
                        if ($num_smilies > 15) {
                            $content .= "<td colspan=\"$s_colspan\" class=\"nav\"><a href=\"$url\" onclick=\"window.open('$url', '_smilies', 'HEIGHT=200,resizable=yes,scrollbars=yes,WIDTH=230');return false;\"  class=\"nav\">".$lang['More_emoticons']."</a></td>\n";
                        }
                        break;
                    }
                    $col++;
                }
                else if ($col == $smilies_split_row) {
                    $content .= "</tr>\n";
                    $col = 0;
                    if ($mode == 'inline' && $row == $inline_rows - 1) {
                        break;
                    }
                    $row++;
                }
                else { $col++; }
            }
            if ($col > 0) { $content .= '</tr>'; }

            if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_cols) {
                $content .= "<tr align=\"center\">
                    <td colspan=\"$s_colspan\" class=\"nav\"><a href=\"$url\" onclick=\"window.open('$url', '_smilies', 'HEIGHT=200,resizable=yes,scrollbars=yes,WIDTH=230');return false;\" class=\"nav\">".$lang['More_emoticons']."</a></td>
                </tr>\n";
            }
        }
    }
    $content .= "\n</table>\n";
    if ($mode == 'window') { $content .= $bb_codes['win_end']; }
    return $content;
}

function nbbcode_table($field='message', $form='post', $allowed=0)
{
        global $currentlang, $textcolor1, $bb_codes, $smilies_path, $bbbttns_path;
        if(@file_exists(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php')) {
            include(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php');
        } else {
            include(NUKE_LANGUAGE_DIR.'bbcode/lang-english.php');
        }
        $content = '';
        if (!defined('BBCODE_JS_ACTIVE')) {
            $content .= '<script type="text/javascript">
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
                            var bbcode_height       = "'.$lang['bbcode_height'].'";
                            var bbcode_width        = "'.$lang['bbcode_width'].'";
                            var bbcode_pagename     = "'.$lang['bbcode_pagename'].'";
                            var bbcode_no_pagename  = "'.$lang['bbcode_no_pagename'].'";
                            var bbcode_web_pagename = "'.$lang['bbcode_web_pagename'].'";
                            var bbcode_img_url      = "'.$lang['bbcode_img_url'].'";
                            var bbcode_no_img_url   = "'.$lang['bbcode_no_img_url'].'";
                            var bbcode_quote        = "'.$lang['bbcode_quote'].'";
                            var bbcode_no_message   = "'.$lang['bbcode_no_message'].'";
                    </script>
                    <script language="JavaScript" src="includes/bbcode.js" type="text/javascript"></script>';
            define('BBCODE_JS_ACTIVE', 1);
        }
        $content .= '<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>
            <img alt="'.$lang['bbcode_alt_b'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_b_help'].'\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="b" src="'.$bbbttns_path.'b.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_i'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_i_help'].'\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="i" src="'.$bbbttns_path.'i.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_u'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_u_help'].'\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="u" src="'.$bbbttns_path.'u.gif" border="0" />
    &nbsp;&nbsp;
            <img alt="'.$lang['bbcode_alt_ltr'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_ltr_help'].'\')" onclick="BBCdir(\''.$form.'\',\''.$field.'\',\'ltr\')" name="dirltr" src="'.$bbbttns_path.'ltr.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_rtl'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_rtl_help'].'\')" onclick="BBCdir(\''.$form.'\',\''.$field.'\',\'rtl\')" name="dirrtl" src="'.$bbbttns_path.'rtl.gif" border="0" />
    &nbsp;&nbsp;
            <img alt="'.$lang['bbcode_alt_url'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_url_help'].'\')" onclick="BBCurl(\''.$form.'\',\''.$field.'\')" name="url" src="'.$bbbttns_path.'url.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_email'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_mail_help'].'\')" onclick="BBCwmi(\''.$form.'\',\''.$field.'\',\'email\')" name="email" src="'.$bbbttns_path.'email.gif" border="0" />';
    if ($allowed) {
            $content .= '
    &nbsp;&nbsp;
            <img alt="'.$lang['bbcode_alt_justify'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_justify_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="align_justify" src="'.$bbbttns_path.'align_justify.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_left'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_left_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="align_left" src="'.$bbbttns_path.'align_left.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_center'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_center_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="align_center" src="'.$bbbttns_path.'align_center.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_right'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_right_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="algin_right" src="'.$bbbttns_path.'align_right.gif" border="0" />';
    }
        $content .= '
    &nbsp;&nbsp;
            <select name="addnbbcode19" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_color_help'].'\')" onchange="BBCfc(\''.$form.'\',\''.$field.'\',this);this.selectedIndex=0;" title="'.$lang['Font_color'].'">
                <option selected="selected" class="genmed" value="'.$textcolor1.'" style="color: black; background-color: rgb(250, 250, 250);">'.$lang['color_default'].'</option>
                <option class="genmed" value="maroon" style="color: maroon; background-color: rgb(250, 250, 250);">'.$lang['color_dark_red'].'</option>
                <option class="genmed" value="red" style="color: red; background-color: rgb(250, 250, 250);">'.$lang['color_red'].'</option>
                <option class="genmed" value="orange" style="color: orange; background-color: rgb(250, 250, 250);">'.$lang['color_orange'].'</option>
                <option class="genmed" value="brown" style="color: brown; background-color: rgb(250, 250, 250);">'.$lang['color_brown'].'</option>
                <option class="genmed" value="yellow" style="color: yellow; background-color: rgb(250, 250, 250);">'.$lang['color_yellow'].'</option>
                <option class="genmed" value="green" style="color: green; background-color: rgb(250, 250, 250);">'.$lang['color_green'].'</option>
                <option class="genmed" value="olive" style="color: olive; background-color: rgb(250, 250, 250);">'.$lang['color_olive'].'</option>
                <option class="genmed" value="cyan" style="color: cyan; background-color: rgb(250, 250, 250);">'.$lang['color_cyan'].'</option>
                <option class="genmed" value="blue" style="color: blue; background-color: rgb(250, 250, 250);">'.$lang['color_blue'].'</option>
                <option class="genmed" value="darkblue" style="color: darkblue; background-color: rgb(250, 250, 250);">'.$lang['color_dark_blue'].'</option>
                <option class="genmed" value="indigo" style="color: indigo; background-color: rgb(250, 250, 250);">'.$lang['color_indigo'].'</option>
                <option class="genmed" value="violet" style="color: violet; background-color: rgb(250, 250, 250);">'.$lang['color_violet'].'</option>
                <option class="genmed" value="white" style="color: white; background-color: rgb(250, 250, 250);">'.$lang['color_white'].'</option>
                <option class="genmed" value="black" style="color: black; background-color: rgb(250, 250, 250);">'.$lang['color_black'].'</option>
            </select>';
        if ($allowed) {
            $content .= '
        </td>
    </tr><tr>
        <td>
            <img alt="'.$lang['bbcode_alt_img'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_img_help'].'\')" onclick="BBCwmi(\''.$form.'\',\''.$field.'\',\'img\')" name="img" src="'.$bbbttns_path.'img.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_flash'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_flash_help'].'\')" onclick="BBCmm(\''.$form.'\',\''.$field.'\',\'flash\')" name="flash" src="'.$bbbttns_path.'flash.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_video'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_video_help'].'\')" onclick="BBCmm(\''.$form.'\',\''.$field.'\',\'video\')" name="video" src="'.$bbbttns_path.'video.gif" border="0" />
    &nbsp;&nbsp;
            <img alt="'.$lang['bbcode_alt_quote'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_quote_help'].'\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="quote" src="'.$bbbttns_path.'quote.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_code'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_code_help'].'\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="code" src="'.$bbbttns_path.'code.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_php'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_php_help'].'\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="php" src="'.$bbbttns_path.'php.gif" border="0" />
        &nbsp;&nbsp;
            <img alt="'.$lang['bbcode_alt_hr'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_hr_help'].'\')" onclick="BBChr(\''.$form.'\',\''.$field.'\')" name="hr" src="'.$bbbttns_path.'hr.gif" border="0" />
    &nbsp;&nbsp;
            <img alt="'.$lang['bbcode_alt_marqd'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_marqd_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="down" src="'.$bbbttns_path.'marq_down.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_marqu'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_marqu_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="up" src="'.$bbbttns_path.'marq_up.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_marql'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_marql_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="left" src="'.$bbbttns_path.'marq_left.gif" border="0" />
            <img alt="'.$lang['bbcode_alt_marqr'].'" class="bbcbutton" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_marqr_help'].'\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="right" src="'.$bbbttns_path.'marq_right.gif" border="0" />
    &nbsp;&nbsp;
            <select name="addnbbcode20" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\''.$lang['bbcode_size_help'].'\')" onchange="BBCfs(\''.$form.'\',\''.$field.'\',this);this.selectedIndex=2" title="'.$lang['Font_size'].'">
            <option value="7" class="genmed">'.$lang['font_tiny'].'</option>
            <option value="9" class="genmed">'.$lang['font_small'].'</option>
            <option value="12" class="genmed" selected="selected">'.$lang['font_normal'].'</option>
            <option value="18" class="genmed">'.$lang['font_large'].'</option>
            <option  value="24" class="genmed">'.$lang['font_huge'].'</option>
            </select>';
        }
        $content .= '
        </td>
    </tr><tr>
        <td>
            <input type="text" name="help'.$field.'" size="100" maxlength="100" style="width:100%; font-size:10px;" value="'.$lang['Styles_tip'].'" class="helpline" />
        </td>
      </tr>
    </table>';

        return $content;
}


function get_smilies() {
   global $db, $cache;
   static $smilies;
    if((($smilies = $cache->load('smilies', 'config')) === false) || empty($smilies)) {
        $smilies = $db->sql_ufetchrowset('SELECT * FROM '.SMILIES_TABLE);
        if(count($smilies))
        {
            usort($smilies, 'sort_smiley');
            $cache->save('smilies', 'config', $smilies);
        }
    }
    return $smilies;
}

function set_smilies($message, $url='') {
    static $orig, $repl;
    if (!isset($orig)) {
        global $smilies_path, $smilies_desc;
        $orig = $repl = array();
        $smilies = get_smilies();
        if (!empty($url) && (substr($url, -1) == '/')) { $url = substr($url, -1); }
        for ($i = 0; $i < count($smilies); $i++) {
            $smilies[$i]['code'] = str_replace('#', '\#', preg_quote($smilies[$i]['code']));
            $orig[] = "#([\s])".$smilies[$i]['code']."([\s<])#si";
            $repl[] = '\\1<NO RESIZE><img src="'. $url . $smilies_path . $smilies[$i]['smile_url'] . '" alt="'.get_codelang($smilies[$i]['emoticon'],$smilies_desc).'" title="'.get_codelang($smilies[$i]['emoticon'],$smilies_desc).'" border="0" />\\2';
        }
    }
    if (count($orig)) {
        $message = preg_replace($orig, $repl, " $message ");
        $message = substr($message, 1, -1);
    }
    return $message;
}

function sort_smiley($a, $b)
{
    if (strlen($a['code']) == strlen($b['code'])) { return 0; }
    return (strlen($a['code']) > strlen($b['code'])) ? -1 : 1;
}

# bbencode_first_pass() prepare bbcode for db insert
function encode_bbcode($text)
{
    return BBCode::encode($text);
}
function decode_bb_all($text, $allowed=0, $allow_html=false, $url='') {
    return set_smilies(decode_bbcode($text, $allowed, $allow_html), $url);
}
function decode_bbcode($text, $allowed=0, $allow_html=false)
{
    return BBCode::decode($text, $allowed, $allow_html);
}

function shrink_url($url) {
    $url = preg_replace("#(^[\w]+?://)#", '', $url);
    return (strlen($url) > 35) ? substr($url,0,22).'...'.substr($url,-10) : $url;
}

function makeclickable($text)
{
    $ret = ' ' . $text;
    //$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" rel=\"nofollow\" title=\"\\2\" target=\"_blank\">'.shrink_url('\\2').'</a>'", $ret);
    //$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" rel=\"nofollow\" target=\"_blank\" title=\"\\2\">'.shrink_url('\\2').'</a>'", $ret);
    // delete deprecated Attribut nofollow 
    $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" rel=\"nofollow\" title=\"\\2\" target=\"_blank\">'.shrink_url('\\2').'</a>'", $ret);
    $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" rel=\"nofollow\" target=\"_blank\" title=\"\\2\">'.shrink_url('\\2').'</a>'", $ret);
    $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1 \\2 &#64; \\3", $ret);
    $ret = substr($ret, 1);
    return($ret);
}

function htmlprepare($str, $nl2br=false, $spchar=ENT_QUOTES, $nohtml=false) {
    if ($nohtml) { $str = strip_tags($str, $nohtml); } # $nohtml : <a><br /><strong><em><img><li><ol><p><strong><u><ul>
    $str = htmlspecialchars($str,$spchar,'utf-8'); # htmlentities sucks cos it converts all chars
    if ($nl2br) { $str = nl2br($str); }
    return trim($str);
}

function htmlunprepare($str, $nl2br=false) {
    $unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&\#039;#', '#&amp;#');
    $unhtml_specialchars_replace = array('>', '<', '"', '\'', '&');
    if ($nl2br) {
        $unhtml_specialchars_match[] = "#<br />\n#";
        $unhtml_specialchars_replace[] = "\n";
    }
    return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $str);
}

function html2bb($text) {
    $text = preg_replace('/</si', ' <', $text);
    $text = preg_replace('/<ol type="([a1])">/si', '/\[list=\\1\]', $text);
    $text = preg_replace('/<(b|u|i|hr)>/sie', "'['.strtolower(\\1).']'", $text);
    $text = preg_replace('/<\/(b|u|i|hr)>/sie', "'[/'.strtolower(\\1).']'", $text);
    $text = preg_replace('#<img(.*?)src="(.*?)\.(gif|png|jpg|jpeg)"(.*?)>#si', '[img]\\2.\\3[/img]', $text);
    $text = str_replace('<ul>', '[list]', $text);
    $text = str_replace('<li>', '[*]', $text);
    $text = str_replace('</ul>', '[/list:u]', $text);
    $text = str_replace('</ol>', '[/list:o]', $text);
    $text = strip_tags($text, '<br /><p><strong>');
    return trim($text);
}

# prepare_message(
function message_prepare($message, $html_on, $bbcode_on)
{
    global $board_config;
    #
    # Clean up the message
    #
    $message = trim($message);
    if ($html_on) {
        $allowed_html_tags = preg_split('#,#', $board_config['allow_html_tags']);
        $end_html = 0;
        $start_html = 1;
        $tmp_message = '';
        $message = ' ' . $message . ' ';
        while ($start_html = strpos($message, '<', $start_html)) {
            $tmp_message .= BBCode::encode_html(substr($message, $end_html + 1, ($start_html - $end_html - 1)));
            if ($end_html = strpos($message, '>', $start_html)) {
                $length = $end_html - $start_html + 1;
                $hold_string = substr($message, $start_html, $length);
                if (($unclosed_open = strrpos(' ' . $hold_string, '<')) != 1) {
                    $tmp_message .= BBCode::encode_html(substr($hold_string, 0, $unclosed_open - 1));
                    $hold_string = substr($hold_string, $unclosed_open - 1);
                }
                $tagallowed = false;
                for ($i = 0; $i < count($allowed_html_tags); $i++) {
                    $match_tag = trim($allowed_html_tags[$i]);
                    if (preg_match('#^<\/?' . $match_tag . '[> ]#i', $hold_string)) {
                        $tagallowed = (preg_match('#^<\/?' . $match_tag . ' .*?(style[ ]*?=|on[\w]+[ ]*?=)#i', $hold_string)) ? false : true;
                    }
                }
                $tmp_message .= ($length && !$tagallowed) ? BBCode::encode_html($hold_string) : $hold_string;
                $start_html += $length;
            } else {
                $tmp_message .= BBCode::encode_html(substr($message, $start_html));
                $start_html = strlen($message);
                $end_html = $start_html;
            }
        }
        if ($end_html != strlen($message) && $tmp_message != '') {
            $tmp_message .= BBCode::encode_html(substr($message, $end_html + 1));
        }
        $message = ($tmp_message != '') ? trim($tmp_message) : trim($message);
    } else {
        $message = BBCode::encode_html($message);
    }
    if ($bbcode_on) {
        $message = BBCode::encode($message);
    }
    return evo_img_tag_to_resize($message);
}

?>