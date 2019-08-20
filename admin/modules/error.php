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

if (is_god_admin() || is_admin('super')) {
    getmodule_lang($adminpoint);

    function ErrorManagerMenu() {
        global $db, $admin_file, $lang_admin, $adminpoint, $showblocks;

        $result = $db->sql_ufetchrow("SELECT modulblocks FROM "._ERROR_CONFIG_TABLE);
        $showblocks = $result['modulblocks'];
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Error\">" . $lang_admin[$adminpoint]['EMATITLE'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[&nbsp;<a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['EMABACKMAIN'] . "</a>&nbsp;]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<div align=\"center\"><strong>".$lang_admin[$adminpoint]['EMATITLE']."</strong></div><br/>";
        echo "<div align=\"center\"><a href=\"".$admin_file.".php?op=ConfigErrors\">".$lang_admin[$adminpoint]['EMCONFIG']."</a>&nbsp;|&nbsp;<a href=\"".$admin_file.".php?op=Error\">".$lang_admin[$adminpoint]['EMSHOWERRORS']."</a></div>";
        CloseTable();
        echo "<br />";
    }
    
    function ErrorManagerFooter() {
        include_once(NUKE_BASE_DIR.'footer.php');    
    }    
    
    function ConfigErrors() {
        global $db, $admin_file, $lang_admin, $adminpoint;
        ErrorManagerMenu();
        $result = $db->sql_query("SELECT log_errors, show_image, modulblocks, show_info_saved, totalerrors FROM "._ERROR_CONFIG_TABLE);
        list($log_errors, $show_image, $modulblocks, $show_info_saved, $totalerrors) = $db->sql_fetchrow($result);

        OpenTable();
        echo "<div align=\"center\"><form action='".$admin_file.".php' method='post'>";
        echo "<table border=\"0\"><tr><td>";

        //show settings
        echo $lang_admin[$adminpoint]['EALOGERRORS']."</td><td>";
        echo yesno_option('xlog_errors', $log_errors);
        echo "</td></tr><tr><td>";
        echo $lang_admin[$adminpoint]['EASHOWIMAGE']."</td><td>";
        echo yesno_option('xshow_image', $show_image);
        echo "</td></tr><tr><td>";
        echo "<label for=\"xmodulblocks\">".$lang_admin[$adminpoint]['EASHOWMODULBLOCKS']."</label></td><td>".select_box('xmodulblocks', $modulblocks, array("0"=>$lang_admin[$adminpoint]['ERROR_BLOCKS_NONE'], "1"=>$lang_admin[$adminpoint]['ERROR_BLOCKS_LEFT'], "2"=>$lang_admin[$adminpoint]['ERROR_BLOCKS_RIGHT'], "3"=>$lang_admin[$adminpoint]['ERROR_BLOCKS_BOTH']));
        echo "</td></tr><tr><td>";
        echo $lang_admin[$adminpoint]['EASHOWINFOSAVED']."</td><td>";
        echo yesno_option('xshow_info_saved', $show_info_saved);
        echo "</td></tr><tr><td>";
        echo $lang_admin[$adminpoint]['TOTALERRORS']."</td><td><strong>";
        echo $totalerrors;
        echo "</strong> <a href=\"".$admin_file.".php?op=ResetErrorCounter\"> ".$lang_admin[$adminpoint]['RESETCOUNTER']."</a>";
        echo "</td></tr></table><br /><br />";
        //send the form
        echo "<input type='hidden' name='op' value='ErrorConfigSave' />";
        echo "<center><input type='submit' value='".$lang_admin[$adminpoint]['SAVECHANGES']."' /></center>";
        echo "</form></div>";
        CloseTable();
        ErrorManagerFooter();
    }
    
    function ResetErrorCounter () {
        global $db, $admin_file;
        $db->sql_uquery("UPDATE "._ERROR_CONFIG_TABLE." SET totalerrors='0'");
        redirect($admin_file.'.php?op=ConfigErrors');
    }
    
    function ErrorConfigSave ($xlog_errors, $xshow_image, $xmodulblocks, $xshow_info_saved) {
        global $db, $admin_file;
        $db->sql_uquery("UPDATE "._ERROR_CONFIG_TABLE." SET log_errors='$xlog_errors', show_image='$xshow_image', modulblocks='$xmodulblocks', show_info_saved='$xshow_info_saved'");
        redirect($admin_file.'.php?op=ConfigErrors');
    }
    
    function display_errors() {
        global $db, $admin_file, $lang_admin, $adminpoint;
        ErrorManagerMenu();
        OpenTable();
        echo "<div align=\"center\"><table width=\"100%\" border=\"1\" cellpadding=\"5\" cellspacing=\"1\">\n<tr>\n"
            ."<td colspan=\"6\" align=\"center\"><strong>".$lang_admin[$adminpoint]['EMALIST']."</strong></td>\n</tr>\n"
            ."<tr><td  align=\"center\"><strong>".$lang_admin[$adminpoint]['EMAURL']."</strong></td><td  align=\"center\"><strong>".$lang_admin[$adminpoint]['EMASORT']."</strong></td><td  align=\"center\"><strong>".$lang_admin[$adminpoint]['EMAIP']."</strong></td><td  align=\"center\"><strong>".$lang_admin[$adminpoint]['EMAREF']."</strong></td><td  align=\"center\"><strong>".$lang_admin[$adminpoint]['EMADATETIME']."</strong></td><td  align=\"center\"><strong><a href=\"".$admin_file.".php?op=Delete_all\">".$lang_admin[$adminpoint]['EMADELALL']."</a></strong></td>\n</tr>\n";
            $result = $db->sql_query("SELECT error_id, error_sort, time, ip_address, referer, error_url FROM "._ERROR_TABLE." ORDER BY error_id");
            while(list($error_id, $error_sort, $time, $ip_address, $referer, $error_url) = $db->sql_fetchrow($result)) {
            	  $referer = str_replace("&", "&amp;", $referer);
            	  $time = str_replace("&", "&amp;", $time);
                echo "<tr>\n<td  align=\"center\">&nbsp;".$time." </td><td  align=\"center\">&nbsp;".$error_sort." </td><td  align=\"center\">&nbsp;".$ip_address." </td><td  align=\"center\">&nbsp;".$referer."</td><td  align=\"center\">&nbsp;".$error_url."</td><td  align=\"center\">&nbsp;<a href=\"".$admin_file.".php?op=Delete&amp;error_id=$error_id\">".$lang_admin[$adminpoint]['EMADEL']."</a>\n</td></tr>\n";
            }
        echo "</table></div>\n";
        CloseTable();
        ErrorManagerFooter();
    }
    
    
    function delete_errors($error_id) {
        global $db, $admin_file, $lang_admin, $adminpoint;
        ErrorManagerMenu();
        OpenTable();
            $db->sql_query("DELETE FROM "._ERROR_TABLE." WHERE error_id = '".$error_id."' LIMIT 1");
        echo "<table width=\"100%\" border=\"0\">\n<tr>\n"
            ."<td align=\"center\">".$lang_admin[$adminpoint]['EMADELETED']."</tr>\n<tr>"
            ."<td align=\"center\"><a href=\"".$admin_file.".php?op=Error\">".$lang_admin[$adminpoint]['EMABACK']."</a></td>\n"
            ."</tr>\n"
        ."</table>\n";
        CloseTable();
        ErrorManagerFooter();
    }
    
    
    function delete_all() {
        global $db, $admin_file, $lang_admin, $adminpoint;
        ErrorManagerMenu();
        OpenTable();
        $db->sql_query("DELETE FROM "._ERROR_TABLE);
        echo "<table width=\"100%\" border=\"0\">\n<tr>\n"
            ."<td align=\"center\">".$lang_admin[$adminpoint]['EMADELETEDALL']."</td>\n"
            ."</tr>\n<tr>"
            ."<td align=\"center\"><a href=\"".$admin_file.".php?op=Error\">".$lang_admin[$adminpoint]['EMABACK']."</a></td>\n"
            ."</tr>\n"
            ."</table>\n";
        CloseTable();
        ErrorManagerFooter();
    }

    $xlog_errors        = $_GETVAR->get('xlog_errors', '_POST', 'int');
    $xshow_image        = $_GETVAR->get('xshow_image', '_POST', 'int');
    $xmodulblocks       = $_GETVAR->get('xmodulblocks', '_POST', 'int');
    $xshow_info_saved   = $_GETVAR->get('xshow_info_saved', '_POST', 'int');
    $error_id           = $_GETVAR->get('error_id', '_GET', 'int');
    
    switch($op) {
        case 'ConfigErrors':
            ConfigErrors();
            break;
        case 'ErrorConfigSave':
            ErrorConfigSave ($xlog_errors, $xshow_image, $xmodulblocks, $xshow_info_saved);
            break;
        case 'ResetErrorCounter':
            ResetErrorCounter();
            break;
        case 'Error':
            display_errors();
            break;
        case 'Delete':
            delete_errors($error_id);
            break;
        case 'Delete_all':
            delete_all();
            break;
    }
} else {
    DisplayError('<strong>' .$lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>