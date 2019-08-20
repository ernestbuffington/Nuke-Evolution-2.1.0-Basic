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

if (!defined('IN_DOWNLOADS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN DOWNLOADS ADMINISTRATION');
}

DownloadsHeader();
OpenTable();
$transfertitle = str_replace ("_", " ", $ttitle);
/* Check ALL Links */
echo "<table width='100%' border='0'>";
if ($cid == 0 && $sid == 0) {
    echo "<tr><td ><center><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_CHECK_ALL'] . "</strong><br />" . $lang_new[$module_name]['BE_PATIENT'] . "</center><br /><br /></td></tr>";
    $result = $db->sql_query("SELECT `did`, `title`, `image`, `url`, `download_type`, `download_filename` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` ORDER BY `title`");
}
/* Check Categories & Subcategories */
if ($cid != 0 && $sid == 0) {
    echo "<tr><td ><center><strong>" . $lang_new[$module_name]['ADMIN_CAT_VALIDATE'] . ": $transfertitle</strong><br />" . $lang_new[$module_name]['BE_PATIENT'] . "</center><br /><br /></td></tr>";
    $result = $db->sql_query("SELECT `did`, `title`, `image`, `url`, `download_type`, `download_filename` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='$cid' ORDER BY `title`");
}
/* Check Only Subcategory */
if ($cid == 0 && $sid != 0) {
   echo "<tr><td ><center><strong>" . $lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] . ": $transfertitle</strong><br />" . $lang_new[$module_name]['BE_PATIENT'] . "</center><br /><br /></td></tr>";
   $result = $db->sql_query("SELECT `did`, `title`, `image`, `url`, `download_type`, `download_filename` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `sid`='$sid' ORDER BY `title`");
}
echo "</table><table width='100%' border='0'>\n";
echo "<tr><td width='15%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_STATUS'] . "</strong></td>";
echo "<td width='10%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_TYPE'] . "</strong></td>";
echo "<td width='10%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>" . $lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] . "</strong></td>";
echo "<td width='45%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>" . $lang_new[$module_name]['TITLE'] . "</strong></td>";
echo "<td width='20%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>" . $lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] . "</strong></td></tr>";
$x = 0;
while($row = $db->sql_fetchrow($result)) {
    $exist = false;
    $download_filename = $row['download_filename'];
    $type = intval($row['download_type']);
    $did = intval($row['did']);
    $title = stripslashes($row['title']);
    $image = stripslashes($row['image']);
    $type_long = ($type == 2 ? 'Datei' : 'LINK');
    if ($type == 2) {
        if ( @file_exists($download_filename)) {
            $exist = true;
        } else {
            $exist = false;
        }
    } else {
        if ( @file_exists($download_filename)) {
            $exist = true;
        } else {
            $exist = false;
        }
    }
    if ($x == 0) {
       $color = $bgcolor1;
       $x++;
    } else {
        $color = $bgcolor2;
        $x = 0;
    }
    if ($exist == false){
        echo "<tr bgcolor='".$color."'><td align='center'><strong><span style='color:red'>" . $lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] . "</span></strong></td>";
        echo "<td align='center'>".$type_long."</td>";
        echo "<td>";
        echo "<table width='100%' border='0'><tr><td>\n";
        if($image!='http://' && !empty($image)){
            if(is_file($image)){
                echo "<a href='".$image."' rel='lightbox' title='".$title."' rev='' ><img src='"."imgsize.php?src=".$image."&amp;w=".$downloadsconfig['image_width']."'  border='0' title='".$title."' alt='' /></a>";
            }
        }else{
            echo "<img src='"."imgsize.php?src=".evo_image('blank.gif', $module_name)."&amp;w=".$downloadsconfig['image_width']."' border='0' title='".$title."' alt='' /></a>";
        }
        echo "</td></tr></table>\n";
        echo "</td>";
        echo "<td><a href='".$url."' target='_blank'>".$title."<br />";
        echo "</a></td>"
            ."<td align='center'><span class='content'>[ <a href='".$admin_file.".php?op=DownloadsModDownload&amp;did=".$did."'>".$lang_new[$module_name]['EDIT']."</a> | <a href=\"".$admin_file.".php?op=DownloadsDelete&amp;did=$did\">" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</span>"
            ."</td></tr>";
    } else {
        echo "<tr bgcolor='".$color."' ><td align='center'><span style='color:green'>".$lang_new[$module_name]['OK']."</span></td>";
        echo "<td align='center'>".$type_long."</td>";
        echo "<td>";
        echo "<table width='100%' border='0'><tr><td>\n";
        if($image!='http://' && !empty($image)){
            if(is_file($image)){
                echo "<a href='".$image."' rel='lightbox' title='".$title."' rev='' ><img src='"."imgsize.php?src=".$image."&amp;w=".$downloadsconfig['image_width']."'  border='0' title='".$title."' alt='' /></a>";
            }
        }else{
            echo "<img src='"."imgsize.php?src=".evo_image('blank.gif', $module_name)."&amp;w=".$downloadsconfig['image_width']."'  border='0' title='".$title."' alt='' /></a>";
        }    
        echo "</td></tr></table>\n";
        echo "</td>";
        echo "<td><a href='modules.php?name=".$module_name."&amp;op=showdownload&amp;did=".$did."' target='_blank'>".$title."<br />";
        echo "</a></td>"
            ."<td align='center'><span class='content'>".$lang_new[$module_name]['NONE']."</span>"
            ."</td></tr>";
    }
}
$db->sql_freeresult($result);
echo "</table>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>