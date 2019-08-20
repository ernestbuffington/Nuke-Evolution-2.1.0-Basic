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

if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

global $db, $lang_new;

$module_name = basename(dirname(dirname(__FILE__)));
$lang_path = NUKE_MODULES_DIR . $module_name . '/language/';
if (@file_exists($lang_path . 'lang-' . $currentlang . '.php')) {
    require($lang_path . 'lang-' . $currentlang . '.php');
} elseif (@file_exists($lang_path . 'lang-' . $board_config['default_lang'] . '.php')) {
    require($lang_path . 'lang-' . $board_config['default_lang'] . '.php');
} else {
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
}

if(is_mod_admin($module_name)) {

    function Faq_header() {
        global $module_name, $admin_file, $lang_new;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=FaqAdmin'>" . $lang_new[$module_name]['FAQ_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>" . $lang_new[$module_name]['FAQ_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        OpenTable();
        echo "<center><span class='title'><strong>" . $lang_new[$module_name]['FAQADMIN'] . "</strong></span></center><br /><br />\n";
    }

    function Faq_footer() {
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function FaqAdmin() {
        global $module_name, $bgcolor2, $db, $currentlang, $evoconfig, $admin_file, $lang_new;

        Faq_header();
        echo "<center><span class='option'><strong>" . $lang_new[$module_name]['ACTIVEFAQS'] . "</strong></span></center><br />\n";
        echo "<table border='1' width='100%' align='center'>\n<tr>\n";
        echo "<td bgcolor='$bgcolor2' align='center'><strong>" . $lang_new[$module_name]['ID'] . "</strong></td>";
        echo "<td bgcolor='$bgcolor2' align='center'><strong>" . $lang_new[$module_name]['CATEGORIES'] . "</strong></td>\n";
        echo "<td bgcolor='$bgcolor2' align='center'><strong>" . $lang_new[$module_name]['LANGUAGE'] . "</strong></td>\n";
        echo "<td bgcolor='$bgcolor2' align='center'><strong>" . $lang_new[$module_name]['FUNCTIONS'] . "</strong></td>\n</tr>\n";
        $result = $db->sql_query("select id_cat, categories, flanguage from "._FAQ_CATEGORIES_TABLE." order by id_cat");
        while ($row = $db->sql_fetchrow($result)) {
            $id_cat     = $row['id_cat'];
            $categories = $row['categories'];
            $flanguage  = $row['flanguage'];
            if (empty($flanguage)) {
                $flanguage = $lang_new[$module_name]['ALL'];
            }
            echo "<tr><td align='center'>".$id_cat."</td>\n";
            echo "<td align='center'>".$categories."</td>\n";
            echo "<td align='center'>".$flanguage."</td>\n";
            echo "<td align='center'>[ <a href='".$admin_file.".php?op=FaqCatGo&amp;id_cat=$id_cat'>" . $lang_new[$module_name]['CONTENT'] . "</a> | <a href='".$admin_file.".php?op=FaqCatEdit&amp;id_cat=$id_cat'>" . $lang_new[$module_name]['EDIT'] . "</a> | <a href='".$admin_file.".php?op=FaqCatDel&amp;id_cat=$id_cat&amp;ok=0'>" . $lang_new[$module_name]['DELETE'] . "</a> ]</td></tr>";
        }
        echo "</table>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class='option'><strong>" . $lang_new[$module_name]['ADDCATEGORY'] . "</strong></span></center><br />\n";
        echo "<form action='".$admin_file.".php' method='post'>\n";
        echo "<table border='0' width='100%'><tr>\n";
        echo "<td>".$lang_new[$module_name]['CATEGORIES'] . ":</td>\n";
        echo "<td><input type='text' name='categories' size='30' /></td></tr>\n";
        if ($evoconfig['multilingual'] == 1) {
            echo "<tr><td>" . $lang_new[$module_name]['LANGUAGE'] . ":</td><td>\n";
                echo "<select name='flanguage'>";
            $languages = lang_list();
            echo '<option value=""'.(($currentlang == '') ? ' selected="selected"' : '').'>'.$lang_new[$module_name]['ALL']."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($currentlang == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo "</select></td></tr>\n";
        }
        echo "<tr><td>&nbsp;</td><td><br />\n";
        if ($evoconfig['multilingual'] != 1) {
            echo "<input type='hidden' name='flanguage' value='$currentlang' />";
        }
        echo "<input type='hidden' name='op' value='FaqCatAdd' />";
        echo "<input type='submit' value='" . $lang_new[$module_name]['SAVE'] . "' />";
        echo "</td></tr>\n";
        echo "</table>\n</form>\n";
        Faq_footer();
    }

    function FaqCatGo($id_cat) {
        global $module_name, $bgcolor2, $db, $currentlang, $evoconfig, $admin_file, $lang_new;

        Faq_header();
        echo "<center><span class='option'><strong>" . $lang_new[$module_name]['QUESTIONS'] . "</strong></span></center><br />";
        echo "<table border='1' width='100%' align='center'><tr>";
        echo "<td bgcolor='$bgcolor2' align='center'>" . $lang_new[$module_name]['CONTENT'] . "</td>";
        echo "<td bgcolor='$bgcolor2' align='center'>" . $lang_new[$module_name]['FUNCTIONS'] . "</td></tr>";
        $result = $db->sql_query("select id, question, answer from "._FAQ_ANSWER_TABLE." where id_cat='$id_cat' order by id");
        while ($row = $db->sql_fetchrow($result)) {
            $id = intval($row['id']);
            $question = $row['question'];
            $answer = $row['answer'];
            $answer_bb = decode_bbcode(set_smilies(stripslashes($answer)), 1, true);
            echo "<tr><td><em>".$question."</em><br /><br />".$answer_bb."</td>\n";
            echo "<td align='center'>[ <a href='".$admin_file.".php?op=FaqCatGoEdit&amp;id=$id'>" . $lang_new[$module_name]['EDIT'] . "</a> | <a href='".$admin_file.".php?op=FaqCatGoDel&amp;id=$id&amp;ok=0'>" . $lang_new[$module_name]['DELETE'] . "</a> ]</td></tr>\n";
        }
        $db->sql_freeresult($result);
        echo "</table>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class='option'><strong>" . $lang_new[$module_name]['ADDQUESTION'] . "</strong></span></center><br />\n";
        echo "<form action='".$admin_file.".php' method='post' name='faq'>\n";
        echo "<table border='0' width='100%'><tr>\n";
        echo "<td>".$lang_new[$module_name]['QUESTION'] . ":</td>\n";
        echo "<td><input type='text' name='question' size='100' /></td>\n";
        echo "</tr><tr>\n";
        echo "<td>".$lang_new[$module_name]['ANSWER'] . "</td>\n";
        echo "<td>";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'answer';
        Make_TextArea('answer', '', 'faq');
        echo "</td></tr>\n";
        echo "<tr><td>&nbsp;</td>\n";
        echo "<td><input type='hidden' name='id_cat' value='".$id_cat."' />";
        echo "<input type='hidden' name='op' value='FaqCatGoAdd' />\n";
        echo "<input type='submit' value='" . $lang_new[$module_name]['SAVE'] . "' />&nbsp;<a href='javascript:history.back()'>" . $lang_new[$module_name]['GOBACK'] . "</a></td></tr>\n";
        echo "</table>\n</form>\n";
        Faq_footer();
    }

    function FaqCatEdit($id_cat) {
        global $module_name, $bgcolor2, $db, $currentlang, $evoconfig, $admin_file, $lang_new;

        Faq_header();
        $row = $db->sql_fetchrow($db->sql_query("SELECT categories, flanguage from "._FAQ_CATEGORIES_TABLE." where id_cat='$id_cat'"));
        $categories = $row['categories'];
        $flanguage = $row['flanguage'];
        echo "<center><span class='option'><strong>" . $lang_new[$module_name]['EDITCATEGORY'] . "</strong></span></center>";
            echo "<form action='".$admin_file.".php' method='post'>";
            echo "<input type='hidden' name='id_cat' value='$id_cat' />";
            echo "<table border='0' width='100%'>\n";
            echo "<tr><td>".$lang_new[$module_name]['CATEGORIES'] . ":</td><td><input type='text' name='categories' size='31' value='$categories' /></td></tr><tr>";
        if ($evoconfig['multilingual'] == 1) {
            echo "<td>" . $lang_new[$module_name]['LANGUAGE'] . ":</td><td>";
                echo "<select name='flanguage'>";
            $languages = lang_list();
            echo '<option value=""'.(($flanguage == '') ? ' selected="selected"' : '').'>'.$lang_new[$module_name]['ALL']."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($flanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select></td>';
        } else {
            echo "<td><input type='hidden' name='flanguage' value='$currentlang' /></td>";
        }
        echo "</tr>";
        echo "<tr><td>&nbsp;</td>\n";
        echo "<td><br />";
        echo "<input type='hidden' name='op' value='FaqCatSave' />";
        echo "<input type='submit' value='".$lang_new[$module_name]['SAVE']."' />&nbsp;<a href='javascript:history.back()'>".$lang_new[$module_name]['GOBACK']."</a></td></tr>\n";
        echo "</table></form>\n";
        Faq_footer();
    }

    function FaqCatGoEdit($id) {
        global $module_name, $bgcolor2, $db, $admin_file, $lang_new;

        Faq_header();
        $row = $db->sql_fetchrow($db->sql_query("SELECT question, answer, id_cat from "._FAQ_ANSWER_TABLE." where id='$id'"));
        $question = $row['question'];
        $answer = $row['answer'];
        $id_cat = $row['id_cat'];
        echo "<center><font class='option'><strong>" . $lang_new[$module_name]['EDITQUESTIONS'] . "</strong></font></center>";
        echo "<form action='".$admin_file.".php' method='post' name='faq'>";
        echo "<input type='hidden' name='id' value='$id' />";
        echo "<input type='hidden' name='id_cat' value='$id_cat' />";
        echo "<table border='0' width='100%'>\n";
        echo "<tr><td>".$lang_new[$module_name]['QUESTION'] . ":</td><td><input type='text' name='question' size='100' value='$question' /></td></tr>\n";
        echo "<tr><td>".$lang_new[$module_name]['ANSWER'] . ":</td><td>\n";
        global $wysiwyg_buffer;
        $wysiwyg_buffer = 'answer';
        Make_TextArea('answer', $answer, 'faq');
        echo "</tr>";
        echo "<tr><td>&nbsp;</td>\n";
        echo "<td><br />\n";
        echo "<input type='hidden' name='op' value='FaqCatGoSave' />";
        echo "<input type='submit' value='".$lang_new[$module_name]['SAVE']."' />&nbsp;<a href='javascript:history.back()'>".$lang_new[$module_name]['GOBACK']."</a></td></tr>\n";
        echo "</table></form>\n";
        Faq_footer();
    }

    function FaqCatSave($id_cat, $categories, $flanguage) {
        global $db, $admin_file;

        $db->sql_uquery("update "._FAQ_CATEGORIES_TABLE." set categories='$categories', flanguage='$flanguage' where id_cat='$id_cat'");
        redirect($admin_file.".php?op=FaqAdmin");
    }

    function FaqCatGoSave($id, $question, $answer, $id_cat) {
        global $db, $admin_file;

        $db->sql_uquery("update "._FAQ_ANSWER_TABLE." set question='$question', answer='$answer' where id='$id'");
        redirect($admin_file.".php?op=FaqCatGo&amp;id_cat=$id_cat");
    }

    function FaqCatAdd($categories, $flanguage) {
        global $db, $admin_file;

        $db->sql_uquery("insert into "._FAQ_CATEGORIES_TABLE." (`id_cat`, `categories`, `flanguage`) VALUES (NULL, '$categories', '$flanguage')");
        redirect($admin_file.".php?op=FaqAdmin");
    }

    function FaqCatGoAdd($id_cat, $question, $answer) {
        global $db, $admin_file, $_GETVAR;

        $db->sql_uquery("insert into "._FAQ_ANSWER_TABLE." (`id`, `id_cat`, `question`, `answer`) values (NULL, '$id_cat', '".$_GETVAR->fixQuotes($question)."', '".$_GETVAR->fixQuotes($answer)."')");
        redirect($admin_file.".php?op=FaqCatGo&id_cat=$id_cat");
    }

    function FaqCatDel($id_cat, $ok=0) {
        global $module_name, $lang_new, $db, $admin_file;

        if($ok==1) {
            $db->sql_uquery("delete from "._FAQ_CATEGORIES_TABLE." where id_cat='$id_cat'");
            $db->sql_uquery("delete from "._FAQ_ANSWER_TABLE." where id_cat='$id_cat'");
            redirect($admin_file.".php?op=FaqAdmin");
        } else {
            Faq_header();
            echo "<br /><center><strong>" . $lang_new[$module_name]['FAQDELWARNING'] . "</strong><br /><br />";
        }
        echo "[ <a href='".$admin_file.".php?op=FaqCatDel&amp;id_cat=$id_cat&amp;ok=1'>" . $lang_new[$module_name]['YES'] . "</a> | <a href='".$admin_file.".php?op=FaqAdmin'>" . _NO . "</a> ]</center><br /><br />";
        Faq_footer();
    }

    function FaqCatGoDel($id, $ok=0) {
        global $db, $admin_file;

        if($ok==1) {
            $db->sql_uquery("delete from "._FAQ_ANSWER_TABLE." where id='$id'");
            redirect($admin_file.".php?op=FaqAdmin");
        } else {
            Faq_header();
            echo "<br /><center><strong>" . $lang_new[$module_name]['QUESTIONDEL'] . "</strong><br /><br />";
        }
        echo "[ <a href='".$admin_file.".php?op=FaqCatGoDel&amp;id=$id&amp;ok=1'>" . $lang_new[$module_name]['YES'] . "</a> | <a href='".$admin_file.".php?op=FaqAdmin'>" . _NO . "</a> ]</center><br /><br />";
        Faq_footer();
    }

    $op         = $_GETVAR->get('op', '_REQUEST', 'string', '');
    $id_cat     = $_GETVAR->get('id_cat', '_REQUEST', 'int', NULL);
    $categories = $_GETVAR->get('categories', '_REQUEST', 'string', '');
    $flanguage  = $_GETVAR->get('flanguage', '_REQUEST', 'string', '');
    $answer     = $_GETVAR->get('answer', '_REQUEST', 'string', '');
    $id         = $_GETVAR->get('id', '_REQUEST', 'int', NULL);
    $question   = $_GETVAR->get('question', '_REQUEST', 'string', '');
    $ok         = $_GETVAR->get('ok', '_REQUEST', 'int');

    switch($op) {
        case 'FaqCatSave':
            FaqCatSave($id_cat, $categories, $flanguage);
            break;
        case 'FaqCatGoSave':
            FaqCatGoSave($id, $question, $answer, $id_cat);
            break;
        case 'FaqCatAdd':
            FaqCatAdd($categories, $flanguage);
            break;
        case 'FaqCatGoAdd':
            FaqCatGoAdd($id_cat, $question, $answer);
            break;
        case 'FaqCatEdit':
            FaqCatEdit($id_cat);
            break;
        case 'FaqCatGoEdit':
            FaqCatGoEdit($id);
            break;
        case 'FaqCatDel':
            FaqCatDel($id_cat, $ok);
            break;
        case 'FaqCatGoDel':
            FaqCatGoDel($id, $ok);
            break;
        case 'FaqAdmin':
            FaqAdmin();
            break;
        case 'FaqCatGo':
            FaqCatGo($id_cat);
            break;
    }
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>