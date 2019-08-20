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

$pagetitle = _CONTENT;

function showpage($pid, $page=0, $forward=0) {
    global $db, $admin_file, $module_name;
    include(NUKE_BASE_DIR.'header.php');
    $cid=0;
    $pid = intval($pid);
    $forward = intval($forward);
    $mypage = $db->sql_fetchrow($db->sql_query("SELECT * FROM "._PAGES_TABLE." WHERE pid=".$pid));
    $myactive = intval($mypage['active']);
    $mycid = intval($mypage['cid']);
    $mytitle = decode_bbcode(set_smilies(stripslashes(check_html($mypage['title'], "nohtml"))), 1);
    $mysubtitle = decode_bbcode(set_smilies(stripslashes(check_html($mypage['subtitle'], "nohtml"))), 1);
    $mypage_header = decode_bbcode(set_smilies(stripslashes($mypage['page_header'])), 1, true);
    $mypage_header = evo_img_tag_to_resize($mypage_header);
    $mytext = decode_bbcode(set_smilies(stripslashes($mypage['text'])), 1, true);
    $mytext = evo_img_tag_to_resize($mytext);
    $mypage_footer = decode_bbcode(set_smilies(stripslashes($mypage['page_footer'])), 1, true);
    $mypage_footer = evo_img_tag_to_resize($mypage_footer);
    $mysignature = decode_bbcode(set_smilies(stripslashes($mypage['signature'])), 1, true);
    $mysignature = evo_img_tag_to_resize($mysignature);
    $mydate = $mypage['date'];
    $mycounter = intval($mypage['counter']);
    if (($myactive == 0) AND (!is_mod_admin($module_name))) {
        DisplayError(_PAGE_NOT_EXISTS, 1);
    } else {
            OpenTable();
            if ($forward != 1)
            {
            $db->sql_uquery("UPDATE "._PAGES_TABLE." SET counter=counter+1 WHERE pid='$pid'");
        }
        $date = formatTimestamp($mydate);
        echo "<center><strong><span class=\"title\">$mytitle</span><br />";
        echo "<span class=\"content\">$mysubtitle</span></strong></center><br />";
        echo "<table width=\"100%\"><tr><td width=\"50%\" align=\"left\">";
        echo "<span style=\"font-size: xx-small;\">" ._COPYRIGHT."<br />".EVO_SERVER_SITENAME."<br /> "._COPYRIGHT2."</span></td>";
        echo "<td width=\"50%\" align=\"right\">";
        echo "<span style=\"font-size: xx-small;\">" ._PUBLISHEDON.":<br />$date<br />($mycounter "._READS.")</span>";
        echo "</td></tr></table><hr />";
        $contentpages = explode( "<!--pagebreak-->", $mytext );
        $pageno = count($contentpages);
        if ( empty($page) || $page < 1 ) { $page = 1; }
        if ( $page > $pageno ) { $page = $pageno; }
        $arrayelement = (int)$page;
        $arrayelement --;
        if($page <= 1) {
            $previous_page = '';
        } else {
            $previous_pagenumber = $page - 1;
            $previous_page = "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$previous_pagenumber&amp;forward=1\"><img src=\"".evo_image('left.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._PREVIOUS."\" title=\""._PREVIOUS."\" /> "._PREVIOUS."</a>";
        }
        if($page >= $pageno) {
            $next_page = "";
        } else {
            $next_pagenumber = $page + 1;
            if ($page != 1) {
                $next_page = '';
            }
            $next_page = "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$next_pagenumber&amp;forward=1\">"._NEXT." <img src=\"".evo_image('right.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._NEXT."\" title=\""._NEXT."\" /></a>";
        }
        echo "<table width=\"100%\"><tr><td align=\"left\" width=\"33%\">$previous_page</td><td align=\"center\" width=\"34%\">" . _PAGE. ": $page/$pageno</td><td align=\"right\" width=\"33%\">$next_page</td></tr></table><hr /><br />";
        if ($page == 1) {
            echo "<p align=\"justify\">".nl2br($mypage_header)."</p><br />";
        }
        echo "<p align=\"justify\">$contentpages[$arrayelement]</p>";
        if ($page == $pageno) {
            echo "<br /><p align=\"justify\">".nl2br($mypage_footer)."</p><br /><br />";
            echo "<p align=\"right\">".nl2br($mysignature)."</p>";
        }
        echo "<center>[ <a href=\"modules.php?name=Content&amp;pa=list_pages_categories&amp;cid=$mycid\">"._BACK."</a> ]</center>";
    }
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

function list_pages() {
    global $db, $evoconfig, $module_name, $admin_file, $bgcolor2;
    include(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div style=\"text-align: center;\"><img src=\"".evo_image('content-logo.png', $module_name)."\" title=\"$module_name\" alt=\"$module_name\" border=\"0\" />\n";
    echo "</div><br />\n";
    $count_output = 0;
    $result = $db->sql_query("SELECT * FROM "._PAGES_CATEGORIES_TABLE);
    $numrows = $db->sql_numrows($result);
    if ( $numrows > 0 ) {
        echo "<center><strong>"._CONTENTCATEGORIES."</strong></center><br /><br />";
            echo "<table width=\"100%\"><tr>";
            echo "<td width=\"50%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _TITLE . "</strong></td><td width=\"50%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _SUBTITLE . "</strong></td></tr>";
        while ($row = $db->sql_fetchrow($result)) {
            $cid = intval($row['cid']);
            $title = decode_bbcode(set_smilies(stripslashes(check_html($row['title'], "nohtml"))), 1);
            $description = decode_bbcode(set_smilies(stripslashes($row['description'])), 1, true);
            $numrows3 = $db->sql_numrows($db->sql_query("SELECT * FROM "._PAGES_TABLE." WHERE cid='$cid'"));
            if ($numrows3 > 0) {
                echo "<tr><td valign=\"top\">&nbsp;<a href=\"modules.php?name=$module_name&amp;pa=list_pages_categories&amp;cid=$cid\">" . decode_bbcode(set_smilies($title)) . "</a>&nbsp;</td><td align=\"left\">$description</td></tr>";
                echo "<tr><td colspan=\"2\"><hr /></td></tr>";
            }
            $count_output++;
        }
        $db->sql_freeresult($result);
        echo "</table><br /><br />";
    }
    $result4 = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM "._PAGES_TABLE." WHERE active='1' AND cid='0' ORDER BY date");
    $numrows2 = $db->sql_numrows($result4);
    if ( $numrows2 > 0 ) {
        echo "<center><strong>"._NONCLASSCONT."</strong></center><br /><br />";
            echo "<table width=\"100%\"><tr>";
            echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _LANGUAGE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _TITLE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _SUBTITLE . "</strong></td>";
            if ( is_mod_admin($module_name) ) {
                    echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _FUNCTIONS . "</strong></td>";
            } else {
                    echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"></td>";
        }
        echo "</tr>\n";
            while ($row4 = $db->sql_fetchrow($result4)) {
                $pid = intval($row4['pid']);
                $title = decode_bbcode(set_smilies(stripslashes(check_html($row4['title'], "nohtml"))), 1);
                $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row4['subtitle'], "nohtml"))), 1);
                $clanguage = $row4['clanguage'];
                if ($evoconfig['multilingual'] == 1 && $clanguage != '') {
                    $the_lang = "<center><img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\" alt=\"".$clanguage."\" /></center>";
                } else {
                    $the_lang = "<center><strong>"._ALL."</strong></center> ";
                }
                echo "<tr><td align=\"center\">";
                if (is_mod_admin($module_name)) {
                    echo "$the_lang</td><td><a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a></td><td> " . decode_bbcode(set_smilies($subtitle)) . "</td><td align=\"center\"><a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\"><img src=\"".evo_image('edit.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._EDIT."\" title=\""._EDIT."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\"><img src=\"".evo_image('inactive.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\"><img src=\"".evo_image('delete.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._DELETE."\" title=\""._DELETE."\" /></a></td></tr>";
                } else {
                    echo "$the_lang</td><td><a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a></td><td> " . decode_bbcode(set_smilies($subtitle)) ."</td></tr>";
                }
        }
        $count_output++;
                $db->sql_freeresult($result4);
                echo "</table><br /><br />";
    }
    if (is_mod_admin($module_name)) {
        $result5 = $db->sql_query("SELECT pid, cid, title, subtitle, clanguage FROM "._PAGES_TABLE." WHERE active='0' ORDER BY date");
        echo "<center><strong>"._INACTIVLIST."</strong></center><br /><br />";
            echo "<table width=\"100%\"><tr>";
            echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _LANGUAGE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _TITLE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _SUBTITLE . "</strong></td>";
                echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _FUNCTIONS . "</strong></td></tr>";
        while ($row5 = $db->sql_fetchrow($result5)) {
            $pid = intval($row5['pid']);
            $cid = intval($row5['cid']);
            $title = decode_bbcode(set_smilies(stripslashes(check_html($row5['title'], "nohtml"))), 1);
            $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row5['subtitle'], "nohtml"))), 1);
                $clanguage = $row['clanguage'];
                if ($evoconfig['multilingual'] == 1 && $clanguage != '') {
                            $the_lang = "<center><img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\" alt=\"".$clanguage."\" /></center>";
                } else {
                            $the_lang = "<center><strong>"._ALL."</strong></center> ";
                }
                echo "<tr><td align=\"center\">";
            echo "$the_lang</td><td><a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a></td><td> " . decode_bbcode(set_smilies($subtitle)) . "</td><td align=\"center\"><a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\"><img src=\"".evo_image('edit.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._EDIT."\" title=\""._EDIT."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\"><img src=\"".evo_image('inactive.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\"><img src=\"".evo_image('delete.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._DELETE."\" title=\""._DELETE."\" /></a></td></tr>";
            $count_output++;
                }
                $db->sql_freeresult($result5);
                echo "</table><br /><br />";
    }
    if ( $count_output < 1 ) {
        echo "<center>"._NO_CONTENT."</center>";
    }
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

function list_pages_categories($cid) {
    global $db, $evoconfig, $module_name, $admin_file, $bgcolor2;
    include(NUKE_BASE_DIR.'header.php');
    title(EVO_SERVER_SITENAME.': '._PAGESLIST);
    OpenTable();
    if ($cid) {
        $cid = intval($cid);
        $cattitle = $db->sql_ufetchrow("SELECT title FROM "._PAGES_CATEGORIES_TABLE);
        $cattitle = decode_bbcode(set_smilies(stripslashes(check_html($cattitle['title'], "nohtml"))), 1);
    } else {
        $cattitle = _NONCLASSCONT;
    }
    echo "<center><strong>"._LISTOFCONTENT."  <em>$cattitle</em></strong></center><br /><br />";
    $result = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM "._PAGES_TABLE." WHERE active='1' AND cid='$cid' ORDER BY date");
    echo "<table width=\"100%\"><tr>";
    echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _LANGUAGE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _TITLE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _SUBTITLE . "</strong></td>";
    if ( is_mod_admin($module_name) ) {
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _FUNCTIONS . "</strong></td>";
    } else {
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"></td>";
    }
    echo "</tr>\n";
    while ($row = $db->sql_fetchrow($result)) {
        $pid = intval($row['pid']);
        $title = decode_bbcode(set_smilies(stripslashes(check_html($row['title'], "nohtml"))), 1);
        $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row['subtitle'], "nohtml"))), 1);
        $clanguage = $row['clanguage'];
        if ($evoconfig['multilingual'] == 1 && $clanguage != '') {
                    $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\" alt=\"".$clanguage."\" />";
        } else {
                    $the_lang = "<strong>"._ALL."</strong> ";
        }
        echo "<tr><td align=\"center\">";
        if (is_mod_admin($module_name)) {
            echo "$the_lang</td><td><a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a></td><td> " . decode_bbcode(set_smilies($subtitle)) . "</td><td align=\"center\"><a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\"><img src=\"".evo_image('edit.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._EDIT."\" title=\""._EDIT."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\"><img src=\"".evo_image('inactive.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\"><img src=\"".evo_image('delete.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._DELETE."\" title=\""._DELETE."\" /></a></td></tr>";
        } else {
            echo "$the_lang</td><td><a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a></td><td> " . decode_bbcode(set_smilies($subtitle)) ."</td></tr>";
        }
    }
    $db->sql_freeresult($result);
        echo "</table><br /><br />";

    $result2 = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM "._PAGES_TABLE." WHERE active='0' AND cid='$cid' ORDER BY date");
    $numrows3 = $db->sql_numrows($result2);
    if ( $numrows3 > 0 && is_mod_admin($module_name) ) {
        echo "<center><strong>"._INACTIVLIST."</strong></center><br /><br />";
            echo "<table width=\"100%\"><tr>";
            echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _LANGUAGE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _TITLE . "</strong></td><td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _SUBTITLE . "</strong></td>";
            if ( is_mod_admin($module_name) ) {
                    echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"><strong>" . _FUNCTIONS . "</strong></td>";
            } else {
                    echo "<td width=\"10%\" align=\"center\" bgcolor=\"$bgcolor2\"></td>";
          }
          echo "</tr>\n";
        while ($row2 = $db->sql_fetchrow($result2)) {
            $pid = intval($row2['pid']);
            $title = decode_bbcode(set_smilies(stripslashes(check_html($row2['title'], "nohtml"))), 1);
            $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row2['subtitle'], "nohtml"))), 1);
            $clanguage = $row2['clanguage'];
                if ($evoconfig['multilingual'] == 1 && $clanguage != '') {
                            $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\" alt=\"".$clanguage."\" />";
                } else {
                            $the_lang = "<strong>"._ALL."</strong> ";
                }
                echo "<tr><td align=\"center\">";
                echo "$the_lang</td><td><a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a></td><td> " . decode_bbcode(set_smilies($subtitle)) . "</td><td align=\"center\"><a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\"><img src=\"".evo_image('edit.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._EDIT."\" title=\""._EDIT."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\"><img src=\"".evo_image('active.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._ACTIVATE."\" title=\""._ACTIVATE."\" /></a>&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\"><img src=\"".evo_image('delete.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\""._DELETE."\" title=\""._DELETE."\" /></a></td></tr>";
        }
        $db->sql_freeresult($result2);
                echo "</table><br /><br />";
    }
    echo "<center>[ <a href=\"modules.php?name=Content\">"._BACK."</a> ]</center>";
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

$pa      = $_GETVAR->get('pa', 'request', 'string', '');
$page    = $_GETVAR->get('page', 'request', 'int', 0);
$cid     = $_GETVAR->get('cid', 'request', 'int', NULL);
$pid     = $_GETVAR->get('pid', 'request', 'int', NULL);
$forward = $_GETVAR->get('forward', 'request', 'int', 0);

switch($pa) {

    case 'showpage':
        showpage($pid, $page, $forward);
    break;

    case 'list_pages_categories':
        list_pages_categories($cid);
    break;

    default:
        list_pages();
    break;

}

?>