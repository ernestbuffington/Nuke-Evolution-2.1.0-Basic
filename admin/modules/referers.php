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
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$adminpoint = @basename(__FILE__,'.php');
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin;

if (is_admin()) {
    getmodule_lang($adminpoint);

    function Referers_main() {
        global $db, $admin_file, $adminpoint, $lang_admin, $bgcolor3;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=hreferer\">" . $lang_admin[$adminpoint]['REFERER_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['REFERER_ADMIN_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo '<span class="genmed"><strong>'.$lang_admin[$adminpoint]['REFERER_WHOSETLINK'].'</strong></span><br /><br />';
        $result = $db->sql_query("SELECT `url`, `link` FROM "._REFERER_TABLE ." ORDER by `url`");
        $bgcolor = '';
        if ($db->sql_numrows($result) > 0) {
            while (list($url, $link) = $db->sql_fetchrow($result)) {
                $url = str_replace('&', '&amp;', $url);
                $link = str_replace('&', '&amp;', $link);
                $bgcolor = ($bgcolor == '') ? ' style="background: '.$bgcolor3.'"' : '';
                $link = (!empty($link) && $link != '/' && $link != '/GET/') ? "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&gt;&nbsp;".$link : '';
                echo '<div class="content"'.$bgcolor.'><a href="'.$url.'" target="_blank">'.$url."</a>".$link."</div>";
            }
            echo '<br /><a class="genmed" href="'.$admin_file.'.php?op=delreferer&amp;del=all">'.$lang_admin[$adminpoint]['REFERER_DELETE_ALL'].'</a>';
        } else {
            echo $lang_admin[$adminpoint]['REFERER_LIST_EMPTY'];
        }
        $db->sql_freeresult($result);
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function Referers_delete($del='') {
        global $db, $admin_file, $cache;

        if ($del == 'all') {
            $db->sql_uquery("DELETE FROM "._REFERER_TABLE);
            $db->sql_uquery("OPTIMIZE TABLE "._REFERER_TABLE);
            $cache->delete('lastreferers', 'blocks');
            redirect($admin_file.'.php?op=hreferer');
        }
    }

    $del = $_GETVAR->get('del', '_REQUEST', 'string');

    switch ($op) {
        case 'delreferer':
            Referers_delete($del);
            break;
        case 'hreferer':
            Referers_main();
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>