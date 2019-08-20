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


if (is_mod_admin()) {
    getmodule_lang($adminpoint);

/* Thanks to Oleg [Dark Pastor] Martos from http://www.rolemancer.ru */
/* to code the comments childs deletion function!                    */

    function removeSubComments($tid, $sid) {
        global $db;
        
        $i=0;
        $result = $db->sql_query("SELECT tid FROM " . _COMMENTS_TABLE . " WHERE pid='".$tid."'");
        $numrows = $db->sql_numrows($result);
        if($numrows>0) {
            while ($row = $db->sql_fetchrow($result)) {
                $stid = intval($row['tid']);
                $db->sql_query("DELETE FROM " . _COMMENTS_TABLE . " WHERE tid='".$stid."'");
                removeSubComments($stid, $sid);
            }
        }
        $db->sql_uquery("DELETE FROM " . _COMMENTS_TABLE . " WHERE tid='".$tid."'");
    }

    function removeComment ($tid, $sid, $ok=0) {
        global $db, $admin_file, $adminpoint, $lang_admin;
        if($ok) {
            $numrows = $db->sql_unumrows("SELECT date FROM " . _COMMENTS_TABLE . " WHERE pid='".$tid."'");
            removeSubComments($tid, $sid);
            $numrows = $db->sql_unumrows("SELECT date FROM " . _COMMENTS_TABLE . " WHERE sid='".$sid."'");
            $db->sql_uquery("UPDATE "._STORIES_TABLE." set comments = ".$numrows." WHERE sid = '".$sid."'");
            redirect('modules.php?name=News&amp;op=article&amp;sid='.$sid);
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            GraphicAdmin();
            title( $lang_admin[$adminpoint]['REMOVECOMMENTS']);
            OpenTable();
            echo "<center>" . $lang_admin[$adminpoint]['SURETODELCOMMENTS'];
            echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">" . $lang_admin[$adminpoint]['NO'] . "</a> | <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid&amp;ok=1\">" . $lang_admin[$adminpoint]['YES'] . "</a> ]</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    function removePollSubComments($tid) {
        global $db;
        $result = $db->sql_query("SELECT tid FROM " . _POLLCOMMENTS_TABLE . " WHERE pid='$tid'");
        $numrows = $db->sql_numrows($result);
        if($numrows>0) {
            while ($row = $db->sql_fetchrow($result)) {
                $stid = intval($row['tid']);
                removePollSubComments($stid);
                $db->sql_query("DELETE FROM " . _POLLCOMMENTS_TABLE . " WHERE tid='$stid'");
            }
        }
        $db->sql_query("DELETE FROM " . _POLLCOMMENTS_TABLE . " WHERE tid='$tid'");
    }

    function RemovePollComment ($tid, $pollID, $ok=0) {
        global $admin_file, $adminpoint, $lang_admin;
        if($ok) {
            removePollSubComments($tid);
            redirect("modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID");
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            GraphicAdmin();
            title("<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['REMOVECOMMENTS'] . "</strong></span></center>");
            OpenTable();
            echo "<center>" . $lang_admin[$adminpoint]['SURETODELCOMMENTS'];
            echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">" . $lang_admin[$adminpoint]['NO'] . "</a> | <a href=\"".$admin_file.".php?op=RemovePollComment&amp;tid=$tid&amp;pollID=$pollID&amp;ok=1\">" . $lang_admin[$adminpoint]['YES'] . "</a> ]</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    $tid    = $_GETVAR->get('tid', '_REQUEST', 'int');
    $sid    = $_GETVAR->get('sid', '_REQUEST', 'int');
    $pollID = $_GETVAR->get('pollID', '_REQUEST', 'int');
    $ok     = $_GETVAR->get('ok', '_REQUEST', 'int');
    
    switch ($op) {
        case 'RemoveComment':
            removeComment ($tid, $sid, $ok);
            break;
        case 'removeSubComments':
            removeSubComments($tid);
            break;
        case 'removePollSubComments':
            removePollSubComments($tid);
            break;
        case 'RemovePollComment':
            RemovePollComment($tid, $pollID, $ok);
            break;
    }

} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>