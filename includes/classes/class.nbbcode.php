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

class BBCode {

    function encode_html($text) {
        return (preg_match('/^</', $text)) ? stripslashes(check_html($text, '')) : $text;
    }

    function encode($text)
    {
        # Split all bbcodes.
        $text_parts = BBCode::split_bbcodes($text);
        # Merge all bbcodes and do special actions depending on the type of code.
        $text = '';
        while ($part = array_shift($text_parts)) {
            if (isset($part['code'])) {
                if ($part['code'] == 'list' && $part['text'][5] == '=' && substr($part['text'], -3) != ':o]') {
                    # [list=x] for ordered lists.
                    $part['text'] = substr($part['text'], 0, -1).':o]';
                }
                if ($part['code'] != 'code' && $part['code'] != 'php' && $part['subc']) {
                    $part['text'] = '['.encode_bbcode(substr($part['text'], 1, -1)).']';
                }
            }
            $text .= $part['text'];
        }
        return trim($text);
    }

    function decode($text, $allowed=0, $allow_html=false)
    {
        global $bb_codes;
        # First: If there isn't a "[" and a "]" in the message, don't bother.
        if (!(strpos($text, '[') !== false && strpos($text, ']'))) {
            return ($allow_html ? (preg_match('/^</', $text) ? $text : nl2br($text)) : nl2br(strip_tags($text)));
        }

        // fix for obsolete bbcode uid
        $text = preg_replace("/:(([a-z0-9]+:)?)[a-z0-9]{10}(=|\])/si", '\\3', $text);

        # pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
        $text = BBCode::split_on_bbcodes($text, $allowed, $allow_html);

        # Patterns and replacements for URL, email tags etc.
        $patterns = $replacements = array();

        # replace single & to &amp;
        $text = preg_replace('/&(?![a-z]{2,6};|#[0-9]{1,4};)/is', '&amp;', $text);

        # colours
        $patterns[] = '#\[color=(\#[0-9A-F]{6}|[a-z]+)\](.*?)\[/color\]#si';
        $replacements[] = '<span style="color: \\1">\\2</span>';

        # size
        $patterns[] = '#\[size=([1-2]?[0-9])\](.*?)\[/size\]#si';
        $replacements[] = '<span style="font-size: \\1px; line-height: normal">\\2</span>';

        # [b] and [/b] for bolding text.
        $patterns[] = '#\[b\](.*?)\[/b\]#si';
        $replacements[] = '<span style="font-weight: bold">\\1</span>';

        # [u] and [/u] for underlining text.
        $patterns[] = '#\[u\](.*?)\[/u\]#si';
        $replacements[] = '<span style="text-decoration: underline">\\1</span>';

        # [i] and [/i] for italicizing text.
        $patterns[] = '#\[i\](.*?)\[/i\]#si';
        $replacements[] = '<span style="font-style: italic">\\1</span>';

        # align
        $patterns[] = '#\[align=(left|right|center|justify)\](.*?)\[/align\]#si';
        $replacements[] = '<div style="text-align:\\1">\\2</div>';

        # [search=google]search string[/search]
        $patterns[] = "#\[search=google\](.*?)\[/search\]#ise";
        $replacements[] = "'<form action=\"http://google.com/search\" method=\"get\"><input type=\"text\" name=\"q\" value=\"'.trim('\\1').'\" /><input type=\"submit\" value=\"Search Google\" /></form>'";
        $patterns[] = "#\[search\](.*?)\[/search\]#ise";
        $replacements[] = "'<form action=\"modules.php?name=Search\" method=\"post\"><input type=\"text\" name=\"search\" value=\"'.trim('\\1').'\" /><input type=\"submit\" value=\"Search\" /></form>'";
        // $replacements[] = "'<a href=\"http://google.com/search?q='.urlencode(trim('\\1')).'\" target=\"_blank\" class=\"postlink\" rel=\"nofollow\">\\1</a>'";

        # [url] local
        $patterns[] = "#\[url\]([\w]+(\.html|\.php|/)[^ \[\"\n\r\t<]*?)\[/url\]#ise";
        $replacements[] = "'<a href=\"\\1\" title=\"\\1\" class=\"postlink\">'.shrink_url('\\1').'</a>'";
        $patterns[] = "#\[url=([\w]+(\.html|\.php|/)[^ \[\"\n\r\t<]*?)\](.*?)\[/url\]#is";
        $replacements[] = "<a href=\"\\1\" title=\"\\1\" class=\"postlink\">\\3</a>";

        # [url]xxxx://www.cpgnuke.com[/url]
        $patterns[] = "#\[url\]([\w]+?://[^ \[\"\n\r\t<]*?)\[/url\]#ise";
        //$replacements[] = "'<a href=\"\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\" rel=\"nofollow\">'.shrink_url('\\1').'</a>'";
        // delete deprecated Attribut nofollow 
        $replacements[] = "'<a href=\"\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\">'.shrink_url('\\1').'</a>'";
        # [url]www.cpgnuke.com[/url] (no xxxx:// prefix).
        $patterns[] = "#\[url\]((www|ftp)\.[^ \[\"\n\r\t<]*?)\[/url\]#ise";
        // delete deprecated Attribut nofollow 
        //$replacements[] = "'<a href=\"http://\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\" rel=\"nofollow\">'.shrink_url('\\1').'</a>'";
        $replacements[] = "'<a href=\"http://\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\">'.shrink_url('\\1').'</a>'";
        # [url=www.cpgnuke.com]cpgnuke[/url] (no xxxx:// prefix).
        $patterns[] = "#\[url=((www|ftp)\.[^ \"\n\r\t<]*?)\](.*?)\[/url\]#is";
        // delete deprecated Attribut nofollow 
        //$replacements[] = "<a href=\"http://\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\" rel=\"nofollow\">\\3</a>";
        $replacements[] = "<a href=\"http://\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\">\\3</a>";
        # [url=xxxx://www.cpgnuke.com]cpgnuke[/url]
        $patterns[] = "#\[url=([\w]+://[^ (\"\n\r\t<]*?)\](.*?)\[/url\]#is";
        // delete deprecated Attribut nofollow 
        //$replacements[] = "<a href=\"\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\" rel=\"nofollow\">\\2</a>";
        $replacements[] = "<a href=\"\\1\" target=\"_blank\" title=\"\\1\" class=\"postlink\">\\2</a>";

        # [email]user@domain.tld[/email] code..
        $patterns[] = "#\[email\]([a-z0-9&\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
        $replacements[] = "<a href=\"mailto:\\1\">\\1</a>";

        if ($allowed) {
            # [hr]
            $patterns[] = "#\[hr\]#si";
            $replacements[] = '<hr />';

            # marquee
            $patterns[] = "#\[marq=(left|right|up|down)\](.*?)\[/marq\]#si";
            $replacements[] = '<marquee direction="\\1" scrolldelay="60" scrollamount="1" onmouseover="this.stop()" onmouseout="this.start()">\\2</marquee>';

            # [img]image_url_here[/img] code..
            $patterns[] = "#\[img\]([\w]+(://|\.|/)[^ (\"\n\r\t<]*?)\[/img\]#si";
            $replacements[] = "<img src=\"\\1\" border=\"0\" alt=\"\" />";

            # [flash width= height= loop= ] and [/flash] code..
            $patterns[] = "#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\]((ht|f)tp://)([^ \?&=\"\n\r\t<]*?(\.(swf|fla)))\[/flash\]#si";
            $replacements[] = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="\\1" height="\\2">
    <param name="movie" value="\\3\\5">
    <param name="quality" value="high">
    <param name="scale" value="noborder">
    <param name="wmode" value="transparent">
    <param name="bgcolor" value="#000000">
  <embed src="\\3\\5" quality="high" scale="noborder" wmode="transparent" bgcolor="#000000" width="\\1" height="\\2" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
</embed></object>';

            # [video width= height= loop= ] and [/video] code..
            $patterns[] = "#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\]([\w]+?://[^ \?&=\"\n\r\t<]*?(\.(avi|mpg|mpeg|wmv)))\[/video\]#si";
            $replacements[] = '<embed src="\\3" width=\\1 height=\\2 autostart=0></embed>';
            
            # [ram width= height= url= ] and [/ram] code..
            $patterns[] = "#\[ram width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\]([\w]+?://[^ \?&=\"\n\r\t<]*?(\.(rm)))\[/ram\]#si";
            $replacements[] = '<OBJECT ID=RVOCX CLASSID="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" WIDTH=\\1 HEIGHT=\\2>
                                <PARAM NAME="SRC" VALUE="\\3">
                                <PARAM NAME="CONSOLE" VALUE="one">
                                <PARAM NAME="CONTROLS" VALUE="ImageWindow">
                                <PARAM NAME="BACKGROUNDCOLOR" VALUE="#000000">
                                <PARAM NAME="CENTER" VALUE="true">
                                <param name="autostart" value="false">
                                <EMBED SRC="\\3" 
                                    TYPE="audio/x-pn-realaudio-plugin" 
                                    CONSOLE=one 
                                    WIDTH=\\1
                                    HEIGHT=\\2
                                    NOJAVA=true
                                    CONTROLS=ImageWindow>
                                </EMBED>
                            </OBJECT>
                            <OBJECT ID=RVOCX CLASSID="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" WIDTH=\\1 HEIGHT=30>
                                <PARAM NAME="CONSOLE" VALUE="one">
                                <PARAM NAME="CONTROLS" VALUE="ControlPanel">
                                <PARAM NAME="BACKGROUNDCOLOR" VALUE="#000000">
                                <PARAM NAME="CENTER" VALUE="true">
                                <EMBED 
                                    TYPE="audio/x-pn-realaudio-plugin" 
                                    CONSOLE=one
                                    WIDTH=\\1
                                    HEIGHT=30
                                    CONTROLS=ControlPanel>
                                </EMBED>
                            </OBJECT>';                            
        }

        $text = preg_replace($patterns, $replacements, $text);

        # Fix linebreaks on important items
        $text = preg_replace("/<br \/>/si", "<br />", $text);
        $text = preg_replace("/<ul><br \/>/si", "<ul>", $text);
        $text = preg_replace("/<\/ul><br \/>/si", "</ul>", $text);
        $text = preg_replace("/<\/ol><br \/>/si", "</ol>", $text);
        $text = preg_replace("/<\/table><br \/>/si", "</table>", $text);
        $text = preg_replace("/<\/div><br \/>/si", "</div>", $text);
        $text = preg_replace("/<br \/><table/si", "<table", $text);

        # Remove our padding from the string..
        return trim($text);
    }

    function split_bbcodes($text)
    {
        $curr_pos = 0;
        $str_len = strlen($text);
        $text_parts = array();
        while ($curr_pos < $str_len) {
            # Find bbcode start tag, if not found end the loop.
            $curr_pos = strpos($text, '[', $curr_pos);
            if ($curr_pos === false) { break; }
            $end = strpos($text, ']', $curr_pos);
            if ($end === false) { break; }

            $code_start = substr($text, $curr_pos, $end-$curr_pos+1);
            $code = strtolower(preg_replace('/\[([a-z]+).*]/i', '\\1', $code_start));
            $code_len = strlen($code);

            $end_pos = empty($code) ? false : $end;
            $depth = 0;
            $sub = false;
            while ($end_pos) {
                # Find bbcode end tag, if not found end the loop.
                $end_pos = strpos($text, '[', $end_pos);
                if ($end_pos === false) { break; }
                $end = strpos($text, ']', $end_pos);
                if ($end === false) { break; }
                $code_end = strtolower(substr($text, $end_pos, $code_len+2));
                if ($code_end == "[/$code") {
                    if ($depth > 0) {
                        $depth--;
                        $end_pos++;
                        $sub = true;
                    } else {
                        if ($curr_pos > 0) {
                            $text_parts[] = array('text' => substr($text, 0, $curr_pos), 'code' => false, 'subc' => false);
                        }
                        $text_parts[] = array(
                            'text' => substr($text, $curr_pos, $end-$curr_pos+1),
                            'code' => $code,
                            'subc' => $sub);
                        $text = substr($text, $end+1);
                        $str_len = strlen($text);
                        $curr_pos = 0;
                        break;
                    }
                } else {
                    if (substr($code_end, 0, -1) == "[$code") { $depth++; }
                    $end_pos++;
                }
            }
            $curr_pos++;
        }
        if ($str_len > 0) { $text_parts[] = array('text' => $text, 'code' => false, 'subc' => false); }
        return $text_parts;
    }

    # split the bbcodes and use nl2br on everything except [php]
    function split_on_bbcodes($text, $allowed=0, $allow_html=false)
    {
        global $bb_codes;
        # Split all bbcodes.
        $text_parts = BBCode::split_bbcodes($text);
        # Merge all bbcodes and do special actions depending on the type of code.
        $text = '';
        while ($part = array_shift($text_parts)) {
            if ($part['code'] == 'php') {
                # [PHP]
                $text .= ($allowed) ? BBCode::decode_php($part['text']) : nl2br(htmlspecialchars($part['text']));
            } elseif ($part['code'] == 'code') {
                # [CODE]
                if (!$allowed && preg_match('/^</', $part['text'])) {
                    $part['text'] = nl2br(htmlspecialchars($part['text']));
                }
                $text .= $allowed ? BBCode::decode_code($part['text']) : $part['text'];
            } elseif ($part['code'] == 'quote') {
                # [QUOTE] and [QUOTE=""]
                if ($part['text'][6] == ']') {
                    $text .= $bb_codes['quote'].BBCode::split_on_bbcodes(substr($part['text'], 7, -8), $allowed, $allow_html).$bb_codes['quote_close'];
                } else {
                    $part['text'] = preg_replace('/\[quote="(.*?)"\]/si', $bb_codes['quote_name'], BBCode::split_on_bbcodes(substr($part['text'], 0, -8), $allowed, $allow_html), 1);
                    $text .= $part['text'].$bb_codes['quote_close'];
                }
            } elseif ($part['subc']) {
                $tmptext = '['.BBCode::split_on_bbcodes(substr($part['text'], 1, -1)).']';
                $text .= ($part['code'] == 'list') ? BBCode::decode_list($tmptext) : $tmptext;
                unset($tmptext);
            } else {
                if ($allow_html) {
                    $tmptext = (!preg_match('/^</', $part['text']) ? nl2br($part['text']) : $part['text']);
                } else {
                    $tmptext = nl2br(BBCode::encode_html($part['text']));
                }
                $text .= ($part['code'] == 'list') ? BBCode::decode_list($tmptext) : $tmptext;
                unset($tmptext);
            }
        }
        return $text;
    }

    function decode_code($text)
    {
        global $bb_codes;
        $text = substr($text, 6, -7);
        $code_entities_match   = array('#<#',  '#>#',  '#"#',    '#:#',   '#\[#',  '#\]#',  '#\(#',  '#\)#',  '#\{#',   '#\}#');
        $code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
        $text = preg_replace($code_entities_match, $code_entities_replace, $text);
        # Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
        $text = str_replace('  ', '&nbsp; ', $text);
        # now Replace 2 spaces with ' &nbsp;' to catch odd #s of spaces.
        $text = str_replace('  ', ' &nbsp;', $text);
        # Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
        $text = str_replace("\t", '&nbsp; &nbsp;', $text);
        # now Replace space occurring at the beginning of a line
        $text = preg_replace('/^ {1}/m', '&nbsp;', $text);
        return $bb_codes['code_start'].nl2br($text).$bb_codes['code_end'];
    }

    function decode_php($text)
    {
        global $bb_codes;
        $text = substr($text, 5, -6);
        $text = str_replace("\r\n", "\n", $text);
        $text = htmlunprepare($text, true);
        $added = FALSE;
        if (preg_match('/^<\?.*/', $text) <= 0) {
            $text = "<?php\n$text\n";
            $added = TRUE;
        }
        if (PHPVERS < '4.2') {
            ob_start();
            highlight_string($text);
            $text = ob_get_contents();
            ob_end_clean();
        } else {
            $text = highlight_string($text, TRUE);
        }
        if (PHPVERS < '5.0') {
            $text = preg_replace('/<font color="(.*?)">/si', '<span style="color: \\1;">', $text);
            $text = str_replace('</font>', '</span>', $text);
        }
        if ($added == TRUE) {
            if (PHPVERS < '5.0') {
                $text = preg_replace('/^(.*)\n.*?<\/span>(.*)php<br \/>/i', "\\1\n\\2?php<br />", $text, 1);
            }
            $text = preg_replace('/^(.*)\n.*php<br \/><\/span>/i', "\\1\n", $text, 1);
            $text = preg_replace('/^(.*)\n(.*)>.*php<br \/>/i', "\\1\n\\2>", $text, 1);
        }
        $text = str_replace('[', '&#91;', $text);
        return $bb_codes['php_start'].$text.$bb_codes['php_end'];
    }

    function decode_list($text)
    {
        // &(?![a-z]{2,6};|#[0-9]{1,4};)
        $items = explode('[*]', $text);
        $text = array_shift($items).'<li>';
        $text .= implode('</li><li>', $items);
        if (count($items) > 1) $text = str_replace('[/list', '</li>[/list', $text);
        $text = preg_replace("#<br />[\r\n]+</li>#", "</li>\n", $text);
        unset($items);
        # [list] and [list=x] for (un)ordered lists.
        # unordered lists
        $text = preg_replace('#\[list\]#i', '<ul>', $text);
        $text = preg_replace('#\[/list:u\]#i', '</ul>', $text);
        $text = preg_replace('#\[/list\]#i', '</ul>', $text);
        # Ordered lists
        $text = preg_replace('#\[list=([ai1])\]#i', '<ol type="\\1">', $text);
        $text = preg_replace('#\[/list:o\]#i', '</ol>', $text);

        $text = preg_replace('#(<[ou]l.*?>)<br />#s', '\\1', $text);
        return $text;
    }

}

?>