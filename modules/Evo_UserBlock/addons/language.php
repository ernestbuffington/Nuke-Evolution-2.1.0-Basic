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

if (defined('ADMIN_FILE')) {
    global $evouserinfo_language, $currentlang, $admin_file, $evoconfig;
}

$qs = '';

if ($evoconfig['multilingual']) {
    $qs = defined('ADMIN_FILE') ? $admin_file.'.php?' : '';
    foreach($_GET as $var => $value) {
        if ($var == 'name') {
            $name = $value;
            $qs .= $name.'&amp;';
        }
        if ($var != 'newlang' && $var != 'name') {
            $qs .= htmlspecialchars($var).'='.htmlspecialchars($value).'&amp;';
        }
    }
    $qs .= 'newlang=';
    $langlist = lang_list();
    $menulist = '';
    $evouserinfo_language = '<div align="center">'.$lang_evo_userblock['BLOCK']['LANG']['SELECT'].'<br /><br />';
    if ($evoconfig['useflags']) {
        for ($i = 0, $maxi = count($langlist); $i < $maxi; $i++) {
            if ($langlist[$i]!='') {
                $imge = NUKE_IMAGES_BASE_DIR . 'language/flag-'.$langlist[$i].'.png';
                $imgefile = NUKE_IMAGES_DIR . 'language/flag-'.$langlist[$i].'.png';
                $altlang = ucwords($langlist[$i]);
                if (defined('ADMIN_FILE')) {
                    $evouserinfo_language .= '';
                } elseif (empty($name)) {
                    $evouserinfo_language .= '<a href="index.php?newlang='.$langlist[$i]."\">";
                } else {
                    $evouserinfo_language .= '<a href="modules.php?name='.$qs.$langlist[$i].'">';
                }
                $evouserinfo_language .= (file_exists($imgefile)) ? "<img src=\"$imge\" align=\"middle\" border=\"0\" alt=\"$altlang\" title=\"$altlang\" hspace=\"3\" vspace=\"3\" />&nbsp;" : $altlang;
                if (!defined('ADMIN_FILE')) {
                    $evouserinfo_language .= '</a> ';
                  }
            }
        }
    } else {
        $evouserinfo_language .= '<form action="" method="get">';
        $evouserinfo_language .= '<select name="newlanguage"';
        if  (!defined('ADMIN_FILE')) {
            $evouserinfo_language .= 'onchange="top.location.href=this.options[this.selectedIndex].value">';
        } else {
            $evouserinfo_language .= '>';
        }
        for ($i=0, $maxi=count($langlist); $i < $maxi; $i++) {
            if ($langlist[$i]!='') {
                if (defined('ADMIN_FILE')) {
                    $evouserinfo_language .= '<option value="'.$qs.$langlist[$i].'"';
                } elseif (!$name) {
                    $evouserinfo_language .= '<option value="index.php?newlang='.$langlist[$i].'"';
                } else {
                    $evouserinfo_language .= '<option value="modules.php?name='.$qs.$langlist[$i].'"';
                }
                if ($langlist[$i]==$currentlang) $evouserinfo_language .= ' selected="selected"';
                $evouserinfo_language .= '>'.ucwords($langlist[$i])."</option>\n";
            }
        }
        $evouserinfo_language .= '</select></form>';
    }
    $evouserinfo_language .= '</div><br />';
}
?>