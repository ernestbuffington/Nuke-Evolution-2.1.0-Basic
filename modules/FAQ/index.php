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
$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$pagetitle = $lang_new[$module_name]['FAQ'];

function ShowFaq($id_cat, $categories) {
    global $bgcolor2, $db, $module_name, $lang_new;

    title($lang_new[$module_name]['FAQ2'], $module_name, 'faq-logo.png');
    OpenTable();
    echo "<a name='top'></a><br />\n";
    echo "<table width='100%' cellpadding='2' cellspacing='1' border='0' align='center'>\n";
    echo "<tr bgcolor='".$bgcolor2."'>\n<td colspan='2'>\n<span class='option'><strong>".$lang_new[$module_name]['CATEGORY'].": <a href='modules.php?name=$module_name'>".$lang_new[$module_name]['MAIN']."</a> -> ".$categories."</strong></span>\n</td>\n</tr>\n";
    echo "<tr><td colspan='2'></td></tr>\n";
    echo "</table><br />\n";
}

function ShowFaqAll($id_cat) {
    global $evoconfig, $bgcolor2, $db, $module_name, $lang_new;

    echo "<table width='100%' cellpadding='2' cellspacing='1' border='0' align='center'>\n";
    $result = $db->sql_query("SELECT id, id_cat, question, answer FROM "._FAQ_ANSWER_TABLE." WHERE id_cat='$id_cat'");
    while ($row = $db->sql_fetchrow($result)) {
        $style = "style='display: none;'";
        if (!$evoconfig['collapse_start']) {
            $style = '';
        }
        $id     = intval($row['id']);
        $id_cat = intval($row['id_cat']);
        $question = stripslashes(check_html($row['question'], "nohtml"));
        $answer = stripslashes($row['answer']);
        $answer = decode_bbcode(set_smilies(stripslashes($answer)), 1, true);
        echo "<tr><td>\n";
        echo "<fieldset><div class='showstate' onclick='expandcontent(this, \"question".$id."\")' style='cursor: pointer;' >";
        echo "<img src='".evo_image('helpicon.png', $module_name)."' title='".$lang_new[$module_name]['QUESTION']."' alt='".$lang_new[$module_name]['QUESTION']."' border='0' />&nbsp;\n";
        echo "<span class='gen'><strong>".$question."</strong></span>\n";
        echo "</div>\n";
        echo "<div id='question".$id."' class='switchcontent' $style>\n";
        echo "<p align='justify'>".$answer."</p>";
        echo "</div></fieldset>\n";
        echo "</td></tr>\n";
     }
     $db->sql_freeresult($result);
     echo "<tr><td>&nbsp;</td></tr></table><br /><br />";
     echo "<div align='center'><strong>[ <a href='modules.php?name=$module_name'>".$lang_new[$module_name]['BACKTOFAQINDEX']."</a> ]</strong></div>";
}

$myfaq      = $_GETVAR->get('myfaq', 'request', 'string', NULL);
$id_cat     = $_GETVAR->get('id_cat', 'request', 'int', NULL);
$categories = $_GETVAR->get('categories', 'request', 'string', '');

if (!isset($myfaq)) {
    global $currentlang, $evoconfig, $module_name, $lang_new;
    if ($evoconfig['multilingual'] == 1) {
        $querylang = "WHERE flanguage='$currentlang' or flanguage=''";
    } else {
        $querylang = "";
    }
    include_once(NUKE_BASE_DIR.'header.php');
    title($lang_new[$module_name]['FAQ2'], $module_name, 'faq-logo.png');
    OpenTable();
    echo "<table width='100%' cellpadding='4' cellspacing='0' border='0'>";
    echo "<tr><td bgcolor='".$bgcolor2."'><span class='option'><strong>".$lang_new[$module_name]['CATEGORIES']."</strong></span></td></tr><tr><td>";
    $result2 = $db->sql_query("SELECT id_cat, categories FROM "._FAQ_CATEGORIES_TABLE." $querylang");
    while ($row2 = $db->sql_fetchrow($result2)) {
        $id_cat = $row2['id_cat'];
        $categories = $row2['categories'];
        $catname = urlencode($categories);
        echo"<img src='".evo_image('arrow.png', $module_name)."' title='".$lang_new[$module_name]['CATEGORY']."' alt='".$lang_new[$module_name]['CATEGORY']."' border='0' />&nbsp;<a href='modules.php?name=$module_name&amp;myfaq=yes&amp;id_cat=$id_cat&amp;categories=$catname'>$categories</a><br />";
    }
    $db->sql_freeresult($result2);
    echo "</td></tr></table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    ShowFaq($id_cat, $categories);
    ShowFaqAll($id_cat);
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>