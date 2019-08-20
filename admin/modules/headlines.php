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

    $comeblock  = $_GETVAR->get('comeblock', '_REQUEST', 'int');
    $edit       = $_GETVAR->get('edit', '_GET', 'int');
    $del        = $_GETVAR->get('del', '_REQUEST', 'int');
    $cancel     = $_GETVAR->get('cancel', '_POST');
    $confirm    = $_GETVAR->get('confirm', '_POST');
    $xsitename  = $_GETVAR->get('xsitename', '_POST');
    $headlinesurl = $_GETVAR->get('headlinesurl', '_POST', 'url');
    $save       = $_GETVAR->get('save', '_POST', 'int');
    $addHeadline  = $_GETVAR->get('addHeadline', '_POST');

    if ($comeblock == 1 && empty($del) && empty($edit) && empty($save) && empty($cancel) && empty($confirm) ) {
        $backlink = "<div align=\"center\">\n[ <a href=\"javascript:window.close();\">" . $lang_admin[$adminpoint]['HEADLINES_RETURNBLOCK'] . "</a> ]</div>\n";
    } elseif ( $comeblock == 1 ) {
        $backlink = "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=headlines".(($comeblock==1)? "&amp;comeblock=1" : "")."\">" . $lang_admin[$adminpoint]['HEADLINES_RETURNBLOCK'] . "</a> ]</div>\n";
    } else {
        $backlink = "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] . "</a> ]</div>\n";
    }
    if (!empty($save)) {
        $xsitename = str_replace(' ', '', $xsitename);
        $headlinesurl = $headlinesurl;
        $db->sql_query('UPDATE '._HEADLINES_TABLE." SET sitename='$xsitename', headlinesurl='$headlinesurl' where hid=".$save);
        redirect($admin_file.'.php?op=headlines'.(($comeblock==1)? "&amp;comeblock=1" : ""));
    } else if (!empty($addHeadline)) {
        $xsitename = str_replace(' ', '', $xsitename);
        $headlinesurl = $headlinesurl;
        $db->sql_query('INSERT INTO '._HEADLINES_TABLE." (`headlinesurl`, `hid`, `sitename`) VALUES ('$headlinesurl', NULL, '$xsitename')");
        redirect($admin_file.'.php?op=headlines'.(($comeblock==1)? "&amp;comeblock=1" : ""));
    } elseif (!empty($edit)) {
        $hid = intval($edit);
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=headlines\">" . $lang_admin[$adminpoint]['HEADLINES_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo $backlink;
        CloseTable();
        echo "<br />";
        list($xsitename, $headlinesurl) = $db->sql_ufetchrow("SELECT sitename, headlinesurl FROM "._HEADLINES_TABLE." WHERE hid=".$hid."", SQL_NUM);
        OpenTable();
        echo '<span class="genmed"><strong>'.$lang_admin[$adminpoint]['HEADLINESADMIN'].'</strong></span><br /><br />
        <fieldset><legend>'.$lang_admin[$adminpoint]['EDITHEADLINE'].'</legend><form method="post" action="'.$admin_file.'.php?op=headlines">
        <label class="ulog" for="xsitename">'.$lang_admin[$adminpoint]['SITENAME'].'</label>
        <input type="text" name="xsitename" size="50" maxlength="30" value="'.$xsitename.'" /><br />
        <label class="ulog" for="headlinesurl">'.$lang_admin[$adminpoint]['RSS_FILE'].'</label>
        <input type="text" name="headlinesurl" size="50" maxlength="200" value="'.$headlinesurl.'" /><br /><br />
        <input type="hidden" name="save" value="'.$hid.'" />
        <input type="hidden" name="comeblock" value="'.$comeblock.'" />
        <input type="submit" value="'.$lang_admin[$adminpoint]['SAVECHANGES'].'" /></form></fieldset>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else if (!empty($del)) {
        if (!empty($cancel)) { redirect($admin_file.'.php?op=headlines'.(($comeblock==1)? "&amp;comeblock=1" : "")); }
        if (!empty($confirm)) {
            $db->sql_query('DELETE FROM '._HEADLINES_TABLE." WHERE hid='".intval($del)."'");
            redirect($admin_file.'.php?op=headlines'.(($comeblock==1)? "&amp;comeblock=1" : ""));
        }
        list($xsitename) = $db->sql_ufetchrow("SELECT sitename FROM "._HEADLINES_TABLE." WHERE hid=".$del."", SQL_NUM);
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=headlines\">" . $lang_admin[$adminpoint]['HEADLINES_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo $backlink;
        CloseTable();
        echo "<br />";
        OpenTable();
        confirm_msg($admin_file.'.php?op=headlines&amp;del='.$del.(($comeblock==1)? "&amp;comeblock=1" : ""), $lang_admin[$adminpoint]['SURE2DELHEADLINE'].'<br /><em>'.$xsitename.'</em>');
         CloseTable();
         include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=headlines\">" . $lang_admin[$adminpoint]['HEADLINES_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo $backlink;
        CloseTable();
        echo "<br />";
        OpenTable();
        echo '<span class="genmed"><strong>'.$lang_admin[$adminpoint]['HEADLINESADMIN'].'</strong></span><br /><br />
        <table border="0" width="100%">
         <tr bgcolor="'.$bgcolor2.'">
           <td><strong>'.$lang_admin[$adminpoint]['SITENAME'].'</strong></td>
           <td><strong>'.$lang_admin[$adminpoint]['URL'].'</strong></td>
           <td><strong>'.$lang_admin[$adminpoint]['FUNCTIONS'].'</strong></td>
         </tr>';
        $result = $db->sql_query("SELECT hid, sitename, headlinesurl FROM "._HEADLINES_TABLE." ORDER BY sitename");
        $bgcolor = $bgcolor3;
        while (list($hid, $headsitename, $headlinesurl) = $db->sql_fetchrow($result)) {
            $bgcolor = ($bgcolor == '') ? ' bgcolor="'.$bgcolor3.'"' : '';
            echo '
         <tr '.$bgcolor.'>
           <td>'.$headsitename.'</td>
           <td><a href="'.$headlinesurl.'" target="new">'.$headlinesurl.'</a></td>
           <td><a href="'.$admin_file.'.php?op=headlines&amp;edit='.$hid.(($comeblock==1)? "&amp;comeblock=1" : "").'">'.$lang_admin[$adminpoint]['EDIT'].'</a> / <a href="'.$admin_file.'.php?op=headlines&amp;del='.$hid.(($comeblock==1)? "&amp;comeblock=1" : "").'">'.$lang_admin[$adminpoint]['DELETE'].'</a></td>
         </tr>';
         }
         $db->sql_freeresult($result);
         echo '</table><br /><br />
         <fieldset><legend>'.$lang_admin[$adminpoint]['ADDHEADLINE'].'</legend><form method="post" action="'.$admin_file.'.php?op=headlines">
         <label class="ulog" for="xsitename">'.$lang_admin[$adminpoint]['SITENAME'].'</label>
         <input type="text" name="xsitename" id="xsitename" size="50" maxlength="30" /><br />
         <label class="ulog" for="headlinesurl">'.$lang_admin[$adminpoint]['RSS_FILE'].'</label>
         <input type="text" name="headlinesurl" id="headlinesurl" size="50" maxlength="200" /><br /><br />
         <input type="hidden" name="comeblock" value="'.$comeblock.'" />
         <input type="submit" name="addHeadline" value="'.$lang_admin[$adminpoint]['ADDHEADLINE'].'" /></form></fieldset>';
         CloseTable();
         include_once(NUKE_BASE_DIR.'footer.php');
    }

} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>