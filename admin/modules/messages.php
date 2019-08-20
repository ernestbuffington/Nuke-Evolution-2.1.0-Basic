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

    function MsgDeactive($mid) {
        global $db, $admin_file;
        $mid = intval($mid);
        $db->sql_uquery("UPDATE " . _MESSAGE_TABLE . " SET active='0' WHERE mid='$mid'");
        redirect($admin_file.'.php?op=messages');
    }

    function messages() {
        global $bgcolor1, $bgcolor2, $db, $evoconfig, $admin_file, $adminpoint, $lang_admin;
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=messages\">" . $lang_admin[$adminpoint]['MESSAGES_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['MESSAGES_ALLMESSAGES'] . "</strong></span><br /><br /><table border=\"1\" width=\"100%\" bgcolor=\"$bgcolor1\">"
        ."<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . $lang_admin[$adminpoint]['MESSAGES_ID'] . "</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . $lang_admin[$adminpoint]['MESSAGES_TITLE'] . "</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\">&nbsp;<strong>" . $lang_admin[$adminpoint]['MESSAGES_LANGUAGE'] . "</strong>&nbsp;</td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\" nowrap=\"nowrap\">&nbsp;<strong>" . $lang_admin[$adminpoint]['MESSAGES_VIEW'] . "</strong>&nbsp;</td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\">&nbsp;<strong>" . $lang_admin[$adminpoint]['MESSAGES_ACTIVE'] . "</strong>&nbsp;</td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\">&nbsp;<strong>" . $lang_admin[$adminpoint]['MESSAGES_FUNCTIONS'] . "</strong>&nbsp;</td></tr>";
        $result = $db->sql_query("SELECT * from " . _MESSAGE_TABLE);
        while ($row = $db->sql_fetchrow($result)) {
        $groups = $row['groups'];
        $mid = intval($row['mid']);
        $title = $row['title'];
        $content = $row['content'];
        $mdate = $row['date'];
        $expire = intval($row['expire']);
        $active = intval($row['active']);
        $view = intval($row['view']);
        $mlanguage = $row['mlanguage'];
        if ($active == 1) {
        $mactive = $lang_admin[$adminpoint]['MESSAGES_YES'];
        } elseif ($active == 0) {
        $mactive = $lang_admin[$adminpoint]['MESSAGES_NO'];
        }
        if ($view == 1) {
       $mview = $lang_admin[$adminpoint]['MESSAGES_MVALL'];
        } elseif ($view == 2) {
       $mview = $lang_admin[$adminpoint]['MESSAGES_MVANON'];
        } elseif ($view == 3) {
       $mview = $lang_admin[$adminpoint]['MESSAGES_MVUSERS'];
        } elseif ($view == 4) {
       $mview = $lang_admin[$adminpoint]['MESSAGES_MVADMIN'];
        } elseif ($view > 5) {
        $mview = $lang_admin[$adminpoint]['MESSAGES_MVGROUPS'];
        }
        if (empty($mlanguage)) {
        $mlanguage = $lang_admin[$adminpoint]['MESSAGES_ALL'];
        }
        echo "<tr><td align=\"right\"><strong>$mid</strong>"
            ."</td><td align=\"left\" width=\"100%\"><strong>$title</strong>"
            ."</td><td align=\"center\">$mlanguage"
            ."</td><td align=\"center\" nowrap=\"nowrap\">$mview"
            ."</td><td align=\"center\">$mactive"
            ."</td><td align=\"right\" nowrap=\"nowrap\">(<a href=\"".$admin_file.".php?op=editmsg&amp;mid=$mid\">" . $lang_admin[$adminpoint]['MESSAGES_EDITMSG'] . "</a>-<a href=\"".$admin_file.".php?op=deletemsg&amp;mid=$mid\">" . $lang_admin[$adminpoint]['MESSAGES_DELETEMSG'] . "</a>)"
            ."</td></tr>";

        }
        echo "</table></center><br />";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['MESSAGES_ADDMSG'] . "</strong></span></center><br />";
        echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"message\">"
        ."<br /><strong>" . $lang_admin[$adminpoint]['MESSAGES_TITLE'] . ":</strong><br />"
        ."<input type=\"text\" name=\"add_title\" value=\"\" size=\"50\" maxlength=\"100\" /><br /><br />"
        ."<strong>" . $lang_admin[$adminpoint]['MESSAGES_MESSAGECONTENT'] . ":</strong><br />";
        Make_TextArea('add_content', '', 'message');
        if ($evoconfig['multilingual'] == 1) {
            echo "<br /><strong>".$lang_admin[$adminpoint]['MESSAGES_LANGUAGE'].": </strong>"
                ."<select name=\"add_mlanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($add_mlanguage == '') ? ' selected="selected"' : '').'>'.$lang_admin[$adminpoint]['MESSAGES_ALL']."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($add_mlanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"add_mlanguage\" value=\"\" />";
        }
        echo "<br /><br />";
        $now = time();
        echo "<strong>" . $lang_admin[$adminpoint]['MESSAGES_EXPIRATION'] . ":</strong>&nbsp;<select name=\"add_expire\">"
        ."<option value=\"86400\" >1 " . $lang_admin[$adminpoint]['MESSAGES_DAY'] . "</option>"
        ."<option value=\"172800\" >2 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option value=\"432000\" >5 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option value=\"1296000\" >15 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option value=\"2592000\" >30 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option value=\"0\" >" . $lang_admin[$adminpoint]['MESSAGES_UNLIMITED'] . "</option>"
        ."</select><br /><br />"
        ."<strong>" . $lang_admin[$adminpoint]['MESSAGES_ACTIVE'] . "</strong>&nbsp;<input type=\"radio\" name=\"add_active\" value=\"1\" checked=\"checked\" />" . $lang_admin[$adminpoint]['MESSAGES_YES']
        ."<input type=\"radio\" name=\"add_active\" value=\"0\" />" . $lang_admin[$adminpoint]['MESSAGES_NO'];
        echo "<br /><br /><strong>" . $lang_admin[$adminpoint]['MESSAGES_VIEWPRIV'] . "</strong>&nbsp;<select name=\"add_view\">"
         ."<option value=\"1\" >" . $lang_admin[$adminpoint]['MESSAGES_MVALL'] . "</option>"
         ."<option value=\"2\" >" . $lang_admin[$adminpoint]['MESSAGES_MVANON'] . "</option>"
         ."<option value=\"3\" >" . $lang_admin[$adminpoint]['MESSAGES_MVUSERS'] . "</option>"
         ."<option value=\"4\" >" . $lang_admin[$adminpoint]['MESSAGES_MVADMIN'] . "</option>"
         ."<option value=\"6\">".$lang_admin[$adminpoint]['MESSAGES_MVGROUPS']."</option>"
         ."</select><br /><br />"
         ."<span class='tiny'>".$lang_admin[$adminpoint]['MESSAGES_WHATGRDESC']."</span><br /><strong>".$lang_admin[$adminpoint]['MESSAGES_WHATGROUPS']."</strong>&nbsp;<select name='add_groups[]' multiple=\"multiple\" size='5'>\n";
         $groupsResult = $db->sql_query("select group_id, group_name from ".GROUPS_TABLE." where group_description <> 'Personal User'");
         while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) { echo "<option value='$gid'>$gname</option>\n"; }
         echo "</select><br /><br />\n"
        ."<input type=\"hidden\" name=\"op\" value=\"addmsg\" />"
        ."<input type=\"hidden\" name=\"add_mdate\" value=\"$now\" />"
        ."<input type=\"submit\" value=\"" . $lang_admin[$adminpoint]['MESSAGES_ADDMSG'] . "\" />"
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function editmsg($mid) {
        global $db, $evoconfig, $admin_file, $adminpoint, $lang_admin;
        include_once(NUKE_BASE_DIR.'header.php');
        $mid = intval($mid);
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=messages\">" . $lang_admin[$adminpoint]['MESSAGES_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        $row = $db->sql_fetchrow($db->sql_query("SELECT * from " . _MESSAGE_TABLE . " WHERE mid='$mid'"));
        $groups = $row['groups'];
        $title      = $row['title'];
        $content    = $row['content'];
        $mdate      = $row['date'];
        $expire     = intval($row['expire']);
        $active     = intval($row['active']);
        $view       = intval($row['view']);
        $mlanguage  = $row['mlanguage'];
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['MESSAGES_EDITMSG'] . "</strong></span></center>";
        if ($active == 1) {
        $asel1 = "checked='checked'";
        $asel2 = "";
        } elseif ($active == 0) {
        $asel1 = "";
        $asel2 = "checked='checked'";
        }
        $sel1 = $sel2 = $sel3 = $sel4 = $sel5 = $sel6 = "";
        if ($view == 1) {
        $sel1 = 'selected="selected"';
        } elseif ($view == 2) {
        $sel2 = 'selected="selected"';
        } elseif ($view == 3) {
        $sel3 = 'selected="selected"';
        } elseif ($view == 4) {
        $sel4 = 'selected="selected"';
        } elseif ($view == 5) {
        $sel5 = 'selected="selected"';
        } elseif ($view > 5) {
        $sel6 = 'selected="selected"';
        }
        $esel1 = $esel2 = $esel3 = $esel4 = $esel5 = $esel6 = "";
        if ($expire == 86400) {
        $esel1 = 'selected="selected"';
        } elseif ($expire == 172800) {
        $esel2 = 'selected="selected"';
        } elseif ($expire == 432000) {
        $esel3 = 'selected="selected"';
        } elseif ($expire == 1296000) {
        $esel4 = 'selected="selected"';
        } elseif ($expire == 2592000) {
        $esel5 = 'selected="selected"';
        } elseif ($expire == 0) {
        $esel6 = 'selected="selected"';
        }
        echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"message\">"
        ."<br /><strong>" . $lang_admin[$adminpoint]['MESSAGES_TITLE'] . ":</strong><br />"
        ."<input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\" /><br /><br />"
        ."<strong>" . $lang_admin[$adminpoint]['MESSAGES_MESSAGECONTENT'] . ":</strong><br />";
        Make_TextArea('content', $content, 'message');
        if ($evoconfig['multilingual'] == 1) {
        echo "<strong>" . $lang_admin[$adminpoint]['MESSAGES_LANGUAGE'] . ": </strong>"
            ."<select name=\"mlanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($mlanguage == '') ? ' selected="selected"' : '').'>'.$lang_admin[$adminpoint]['MESSAGES_ALL']."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($mlanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select>';
        } else {
            echo "<input type=\"hidden\" name=\"mlanguage\" value=\"\" />";
        }
        echo "<br /><br />";
        echo "<strong>" . $lang_admin[$adminpoint]['MESSAGES_EXPIRATION'] . ":</strong>&nbsp;<select name=\"expire\">"
        ."<option name=\"expire\" value=\"86400\" $esel1>1 " . $lang_admin[$adminpoint]['MESSAGES_DAY'] . "</option>"
        ."<option name=\"expire\" value=\"172800\" $esel2>2 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option name=\"expire\" value=\"432000\" $esel3>5 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option name=\"expire\" value=\"1296000\" $esel4>15 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option name=\"expire\" value=\"2592000\" $esel5>30 " . $lang_admin[$adminpoint]['MESSAGES_DAYS'] . "</option>"
        ."<option name=\"expire\" value=\"0\" $esel6>" . $lang_admin[$adminpoint]['MESSAGES_UNLIMITED'] . "</option>"
        ."</select><br /><br />"
        ."<strong>" . $lang_admin[$adminpoint]['MESSAGES_ACTIVE'] . "</strong>&nbsp;<input type=\"radio\" name=\"active\" value=\"1\" $asel1 />" . $lang_admin[$adminpoint]['MESSAGES_YES'] . " "
        ."<input type=\"radio\" name=\"active\" value=\"0\" $asel2 />" . $lang_admin[$adminpoint]['MESSAGES_NO'] . "";
        if ($active == 1) {
        echo "<br /><br /><strong>" . $lang_admin[$adminpoint]['MESSAGES_CHANGEDATE'] . "</strong>"
            ."<input type=\"radio\" name=\"chng_date\" value=\"1\" />" . $lang_admin[$adminpoint]['MESSAGES_YES'] . " "
            ."<input type=\"radio\" name=\"chng_date\" value=\"0\" checked='checked' />" . $lang_admin[$adminpoint]['MESSAGES_NO'] . "<br /><br />";
        } elseif ($active == 0) {
        echo "<br /><span class=\"tiny\">" . $lang_admin[$adminpoint]['MESSAGES_IFYOUACTIVE'] . "</span><br /><br />"
            ."<input type=\"hidden\" name=\"chng_date\" value=\"1\" />";
        }
        echo "<strong>" . $lang_admin[$adminpoint]['MESSAGES_VIEWPRIV'] . "</strong>&nbsp;<select name=\"view\">"
        ."<option name=\"view\" value=\"1\" $sel1>" . $lang_admin[$adminpoint]['MESSAGES_MVALL'] . "</option>"
        ."<option name=\"view\" value=\"2\" $sel2>" . $lang_admin[$adminpoint]['MESSAGES_MVANON'] . "</option>"
        ."<option name=\"view\" value=\"3\" $sel3>" . $lang_admin[$adminpoint]['MESSAGES_MVUSERS'] . "</option>"
        ."<option name=\"view\" value=\"4\" $sel4>" . $lang_admin[$adminpoint]['MESSAGES_MVADMIN'] . "</option>"
            ."<option name=\"view\" value=\"6\" $sel6>".$lang_admin[$adminpoint]['MESSAGES_MVGROUPS']."</option>"
        ."</select><br /><br />"
            ."<span class='tiny'>".$lang_admin[$adminpoint]['MESSAGES_WHATGRDESC']."</span><br /><strong>".$lang_admin[$adminpoint]['MESSAGES_WHATGROUPS']."</strong>&nbsp;<select name='groups[]' multiple='multiple' size='5'>";
        $ingroups = explode("-",$groups);
        $groupsResult = $db->sql_query("select group_id, group_name from ".GROUPS_TABLE." where group_description <> 'Personal User'");
        while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
            if(in_array($gid,$ingroups) AND $view > 5) { $sel = " selected='selected'"; } else { $sel = ""; }
            echo "<option value='$gid'$sel>$gname</option>";
        }
        echo "</select><br /><br />"
        ."<input type=\"hidden\" name=\"mdate\" value=\"$mdate\" />"
        ."<input type=\"hidden\" name=\"mid\" value=\"$mid\" />"
        ."<input type=\"hidden\" name=\"op\" value=\"savemsg\" />"
        ."<input type=\"submit\" value=\"" . $lang_admin[$adminpoint]['MESSAGES_SAVECHANGES'] . "\" />"
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function savemsg($mid, $title, $content, $mdate, $expire, $active, $view, $groups, $chng_date, $mlanguage) {
        global $db, $admin_file;
        if($view == 6) { $ingroups = implode('-',$groups); }
        if($view < 6) { $ingroups = ''; }
        $mid = intval($mid);
        $title = $title;
        $content = $content;
        if ($chng_date == 1) {
            $newdate = time();
        } elseif ($chng_date == 0) {
            $newdate = $mdate;
        }
        $result = $db->sql_uquery("UPDATE " . _MESSAGE_TABLE . " SET title='$title', content='$content', date='$newdate', expire='$expire', active='$active', view='$view', groups='$ingroups', mlanguage='$mlanguage' WHERE mid='$mid'");
        redirect($admin_file.'.php?op=messages');
    }

    function addmsg($add_title, $add_content, $add_mdate, $add_expire, $add_active, $add_view, $add_groups, $add_mlanguage) {
        global $db, $admin_file;
        if($add_view == 6) { $ingroups = implode('-',$add_groups); }
        if($add_view < 6) { $ingroups = ''; }
        $title      = $add_title;
        $content    = $add_content;
        $result     = $db->sql_query("INSERT INTO " . _MESSAGE_TABLE . " (`active`, `content`, `date`, `expire`, `groups`, `mid`, `mlanguage`, `title`, `view`) VALUES ('$add_active', '$add_content', '$add_mdate', '$add_expire', '$ingroups', NULL, '$add_mlanguage', '$add_title', '$add_view')");
        if (!$result) {
            exit();
        }
        redirect($admin_file.'.php?op=messages');
    }

    function deletemsg($mid, $ok=0) {
        global $db, $admin_file, $adminpoint, $lang_admin;
        if($ok) {
        $result = $db->sql_query("DELETE FROM " . _MESSAGE_TABLE . " WHERE mid='$mid'");
            if (!$result) {
            return;
            }
        redirect($admin_file.'.php?op=messages');
        } else {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=messages\">" . $lang_admin[$adminpoint]['MESSAGES_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center>" . $lang_admin[$adminpoint]['MESSAGES_DELETEMSG'] . "";
        echo "<br /><br />[ <a href=\"".$admin_file.".php?op=messages\">" . $lang_admin[$adminpoint]['MESSAGES_NO'] . "</a> | <a href=\"".$admin_file.".php?op=deletemsg&amp;mid=$mid&amp;ok=1\">" . $lang_admin[$adminpoint]['MESSAGES_YES'] . "</a> ]</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    $title          = $_GETVAR->get('title', 'POST');
    $content        = $_GETVAR->get('content', 'POST');
    $mdate          = $_GETVAR->get('mdate', 'POST', 'int');
    $expire         = $_GETVAR->get('expire', 'POST', 'int');
    $active         = $_GETVAR->get('active', 'POST', 'int');
    $view           = $_GETVAR->get('view', 'POST', 'int');
    $chng_date      = $_GETVAR->get('chng_date', 'POST', 'int');
    $mlanguage      = $_GETVAR->get('mlanguage', 'POST');
    $groups         = $_GETVAR->get('groups', 'POST', 'int');
    $ok             = $_GETVAR->get('ok', 'REQUEST', 'int');
    $op             = $_GETVAR->get('op', 'REQUEST');
    $mid            = $_GETVAR->get('mid', 'REQUEST', 'int');
    $add_title      = $_GETVAR->get('add_title', 'POST');
    $add_content    = $_GETVAR->get('add_content', 'POST');
    $add_mdate      = $_GETVAR->get('add_mdate', 'POST');
    $add_expire     = $_GETVAR->get('add_expire', 'POST', 'int');
    $add_active     = $_GETVAR->get('add_active', 'POST', 'int');
    $add_view       = $_GETVAR->get('add_view', 'POST', 'int');
    $add_groups     = $_GETVAR->get('add_groups', 'POST', 'int');
    $add_mlanguage  = $_GETVAR->get('add_mlanguage', 'POST');


    switch ($op){

        case 'messages':
        messages();
        break;

        case 'editmsg':
        editmsg($mid, $title, $content, $mdate, $expire, $active, $view, $chng_date, $mlanguage);
        break;

        case 'addmsg':
        addmsg($add_title, $add_content, $add_mdate, $add_expire, $add_active, $add_view, $add_groups, $add_mlanguage);
        break;

        case 'deletemsg':
        deletemsg($mid, $ok);
        break;

        case 'savemsg':
        savemsg($mid, $title, $content, $mdate, $expire, $active, $view, $groups, $chng_date, $mlanguage);
        break;

}

} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>