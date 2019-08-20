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

// useflags is set in configuration
global $db, $cache, $evoconfig, $currentlang, $admin_file, $_GETVAR;

if (!$evoconfig['multilingual']) {
    return $content = '<br /><center>'. _LANG_NO_MULTILINGUAL . '</center><br />';
}
$name = '';

function block_languages_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('languages', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $langlist = lang_list();
        for ($i = 0, $maxi = count($langlist); $i < $maxi; $i++) {
            $language = $langlist[$i];
            if ( $language != '' ) {
                if (@file_exists(NUKE_IMAGES_DIR . 'language/flag-'.$language.'.png')) {
                    $blockcache[$i+1]['flag'] = evo_image('flag-'.$language.'.png', 'language');
                } else {
                    $blockcache[$i+1]['flag'] = false;
                }
                $blockcache[$i+1]['option'] = ucwords($language);
                $blockcache[$i+1]['lang']   = $language;
            }
        }
        $blockcache[0]['stat_created'] = time();
        $cache->save('languages', 'blocks', $blockcache);
    }
    return $blockcache;
}

$qs = defined('ADMIN_FILE') ? $admin_file.'.php?' : '';
$qs_ary = explode('&', $_GETVAR->get('QUERY_STRING', '_SERVER'));
foreach($qs_ary as $var_temp => $value_temp) {
        $var_ary = explode('=', $value_temp);
        $var = $var_ary[0];
        $value = (!empty($var_ary[1]) ? $var_ary[1] : '');
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
    $action = $qs.'&amp;';
} elseif (empty($name)) {
    $action = 'index.php?';
} else {
    $action = 'modules.php?name='.$qs.'&amp;';
}
$action .= 'newlang=';

$blocksession = block_languages_cache($evoconfig['block_cachetime']);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    $flag_image  = $blocksession[$a]['flag'];
    $lang_option = $blocksession[$a]['option'];
    $language    = strtolower($blocksession[$a]['lang']);
    if ( $evoconfig['useflags'] ) {
        $blockcontent .= '<a href="'.$action.$language.'">';
        $blockcontent .= (isset($flag_image)) ? '<img src="'.$flag_image.'" align="middle" border="0" alt="'.$lang_option.'" hspace="3" vspace="3" />&nbsp;' : $lang_option;
        $blockcontent .= '</a>';
    } else {
        $blockcontent .= '<option value="'.$action.$language.'"';
        if ($language == $currentlang) {
            $blockcontent .= ' selected="selected"';
        }
        $blockcontent .= '>'.$lang_option."</option>\n";
    }
}

$content = "<div style='width: 100%; text-align:center;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= "<div style='text-align: center;'>".$lang_block['BLOCK_LANGUAGES_SELECT']."</div><br />\n";
    $content .= ($evoconfig['useflags']) ? "<div style='margin-left: auto; margin-right: auto; text-align:center; width: 100%;'>\n" : "<div style='width: 100%; text-align:center;'>\n";
    $content .= ($evoconfig['useflags']) ? '' : '<form action="'.$action.'" method="get"><label for="newlanguage">&nbsp;</label><select name="newlanguage" id="newlanguage" onchange="top.location.href=this.options[this.selectedIndex].value">';
    $content .= $blockcontent;
    $content .= ($evoconfig['useflags']) ? '' : '</select></form>';
    $content .= ($evoconfig['useflags']) ? "</div>\n" : "</div>\n";
}
$content .= "</div>\n";

?>