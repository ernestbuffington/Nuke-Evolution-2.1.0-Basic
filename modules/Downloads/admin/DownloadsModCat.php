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

$cid = $_GETVAR->get('cid', '_REQUEST', 'int', 0);

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='".$cid."'"));
$presult = $db->sql_query("SELECT `title`, `uploaddir` FROM "._DOWNLOADS_CATEGORIES_TABLE." WHERE cid !='".$cid."'");

$cid                    = intval($row['cid']);
$canupload              = intval($row['canupload']);
$catactive              = intval($row['catactive']);
$cdescription           = $row['cdescription'];
$folder                 = NUKE_BASE_DIR.$downloadsconfig['downloads_basedir'];
$image                  = $row['image'];
$maxdirsize             = intval($row['maxdirsize']);
$maxfilesize            = intval($row['maxfilesize']);
$mintime                = intval($row['mintime']);
$parentid               = intval($row['parentid']);
$restricted_group_add   = intval($row['restricted_group_add']);
$restricted_group_see   = intval($row['restricted_group_see']);
$title                  = $row['title'];
$sizedefinedir          = intval($row['sizedefinedir']);
$sizedefinefile         = intval($row['sizedefinefile']);
$uploaddir              = $row['uploaddir'];
$catoverride            = intval($row['catoverride']);

$uploadallowed = DownloadsUploadsAllowed();

if ($uploadallowed) {
    $maxallowed    = DownloadsMaxAllowedFileSize(FALSE);
} else {
    $maxallowed     = 0;
    $maxdirsize     = 0;
    $maxfilesize    = 0;
    $sizedefinefile = 0;
    $sizedefinedir  = 0;
}

$check_titles   = '';
while ($catinfo = $db->sql_fetchrow($presult)){
    $check_titles   .= strtolower(htmlentities($catinfo['title'], ENT_QUOTES)).', ';
}
$db->sql_freeresult($presult);

DownloadsHeader();

echo "<script type='text/javascript'>
      /*<![CDATA[*/\n
    function validate(){
    if (document.DownloadsModCat.ModCatTitle.value == ''){
        Sexy.alert('".$lang_new[$module_name]['CATEGORY_ADDTITLE']."');
        return false;
    } else {
        var fieldvalue  = document.DownloadsModCat.ModCatTitle.value;
        var fieldvalue  = fieldvalue.toLowerCase();
        var array_title = '".$check_titles."';
        var new_array   = array_title.split(',');
        for(var i = 0; i < new_array.length; i++) {
            if(fieldvalue == new_array[i]) {
                Sexy.alert('".$lang_new[$module_name]['CATEGORY_TITLE_DOUBLE']."');
                return false;
            }
        }
    }
}
\n/*]]>*/\n
</script>";

OpenTable();

echo "<span class='option'><strong>".$lang_new[$module_name]['ADMIN_MODIFY_CAT']."</strong></span><h3></h3>";
echo "<form method='post' action='".$admin_file.".php?op=DownloadsModCatS' name='DownloadsModCat'>";
echo "<table width='100%' align='center' border='0'>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_NAME'],$lang_new[$module_name]['NAME'])."&nbsp;".$lang_new[$module_name]['NAME'].": </td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input type='text' name='ModCatTitle' value='".$title."' size='75%' maxlength='255'  tabindex='1' /></td></tr>";
// This option is deactivated -> will work on this later for ver 2.1.1
/*
if ($parentid > 0) {
    $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM "._DOWNLOADS_CATEGORIES_TABLE." ORDER BY `parentid`, `title`");
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['CATEGORY_CATEGORY'])."&nbsp;".$lang_new[$module_name]['IN']."</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px' align='center'><span style='color:red; font-weight:bold;'>*</span></td><td>";
    echo "<select name='parentid' disabled='disabled'>"; 
    while($row3 = $db->sql_fetchrow($result1)) {
        $cid2           = intval($row3['cid']);
        $ctitle2        = stripslashes($row3['title']);
        $parentid2      = intval($row3['parentid']);
        if ($parentid2!=0) {
            $ctitle2    = DownloadsGetParent($parentid2,$ctitle2);
        }
        $cat_sel = '';
        if ($cid2 == $parentid) { 
            $cat_sel = "selected='selected'"; 
        }
        echo "<option value='".$cid2."' ".$cat_sel.">".$ctitle2."</option>";
    }
    $db->sql_freeresult($result1);
    echo "</select></td></tr>";
}
*/
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' valign='top' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_IMAGE_SEL'],$lang_new[$module_name]['DOWNLOAD_IMAGE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_IMAGE'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'><font color='red'><b> </b></font></td><td>".DownloadsSelectGallery('image', 'modules/Downloads/images/categories', TRUE, $image, 2)."</td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' colspan='3' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_DESCRIPTION'],$lang_new[$module_name]['DESCRIPTION'])."&nbsp;".$lang_new[$module_name]['DESCRIPTION'].": </td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' colspan='3' style='border:solid white 1px' ><br />";
echo Make_TextArea('cdescription',$cdescription, 'DownloadsModCat', '90%', '100px', true, 'bbcode')."</td></tr>";
echo "<tr><td colspan='3'><h3><br /></h3></td></tr>";
echo "<tr><td colspan='3'><table width='100%' border='0' align='center' style='border:solid white 1px' ><tr><td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' valign='top' >".evo_help_img($lang_new[$module_name]['CATEGORY_GROUP_DOWNLOAD'],$lang_new[$module_name]['CAT_RESTRICTED_GROUP_ADD'])."&nbsp;".$lang_new[$module_name]['CAT_RESTRICTED_GROUP_ADD'].":</td><td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' valign='top'>".evo_help_img($lang_new[$module_name]['CATEGORY_GROUP_SEE'],$lang_new[$module_name]['CAT_RESTRICTED_GROUP_SEE'])."&nbsp;".$lang_new[$module_name]['CAT_RESTRICTED_GROUP_SEE'].":</td></tr></table></td></tr>";
echo "<tr><td colspan='3'><table width='100%' border='0' align='center' style='border:solid white 1px' ><tr><td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' ><select name='restricted_group_add' tabindex='4' >";
echo DownloadsGroupSelect($restricted_group_add);
echo "</select></td>";
echo "<td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' ><select name='restricted_group_see'  tabindex='5' >";
echo DownloadsGroupSelect($restricted_group_see);
echo "</select></td></tr></table></td></tr>";
echo "<tr><td><br /></td></tr>";
echo "<tr><td colspan='3'><table width='100%' border='0' align='center' style='border:solid white 1px' ><tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['HELP_MINTIME'],$lang_new[$module_name]['CATEGORY_MINTIME'])."&nbsp;".$lang_new[$module_name]['CATEGORY_MINTIME'].":</td><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['MAXDIRSIZE'],$lang_new[$module_name]['CATEGORY_MAXDIRSIZE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_MAXDIRSIZE'].":</td><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['MAXFILESIZE'],$lang_new[$module_name]['CATEGORY_MAXFILESIZE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_MAXFILESIZE'].":</td></tr></table></td></tr>";
echo "<tr><td colspan='3'><table width='100%' border='0' align='center' style='border:solid white 1px' ><tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' ><input type='text' value='".$mintime."' name='mintime' size='6' maxlength='6'  tabindex='6' />&nbsp;".$lang_new[$module_name]['SECONDS']."</td><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' ><input type='text' value='".$maxdirsize."' name='maxdirsize' size='6' maxlength='6'  tabindex='7' /> ";
echo "<select name='sizedefinedir'>";
$dirsize1 = $dirsize2 = $dirsize3 = '';
switch ($sizedefinedir) {
    case 0: $dirsize1 = "selected='selected'"; break;
    case 1: $dirsize2 = "selected='selected'"; break;
    case 2: $dirsize3 = "selected='selected'"; break;
}
echo "<option value='0' ".$dirsize1.">".$lang_new[$module_name]['SIZE_KB']."</option>";
echo "<option value='1' ".$dirsize2.">".$lang_new[$module_name]['SIZE_MB']."</option>";
echo "<option value='2' ".$dirsize3.">".$lang_new[$module_name]['SIZE_GB']."</option>";
echo "</select></td>";
echo "<td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' ><input type='text' value='".$maxfilesize."' name='maxfilesize' size='6' maxlength='6'  tabindex='8' /> ";
echo "<select name='sizedefinefile'>";
$filesize1 = $filesize2 = $filesize3 = '';
switch ($sizedefinefile) {
    case 0: $filesize1 = "selected='selected'"; break;
    case 1: $filesize2 = "selected='selected'"; break;
    case 2: $filesize3 = "selected='selected'"; break;
}
echo "<option value='0' ".$filesize1.">".$lang_new[$module_name]['SIZE_KB']."</option>";
echo "<option value='1' ".$filesize2.">".$lang_new[$module_name]['SIZE_MB']."</option>";
echo "<option value='2' ".$filesize3.">".$lang_new[$module_name]['SIZE_GB']."</option>";
echo "</select>";
echo "</td></tr></table></td></tr>";
echo "<tr><td colspan='3' ><table width='100%' border='0' align='center' >";
echo "<tr><td width='100%' align='center' >".$lang_new[$module_name]['INFO_MAX_SYSTEM_FILESIZE'].":&nbsp;".$maxallowed."<br />".$lang_new[$module_name]['SIZE_KB'].":&nbsp;".($maxallowed/1024)."<br />".$lang_new[$module_name]['SIZE_MB'].":&nbsp;".($maxallowed/1048576)."</td></tr></table></td></tr>";
echo "<tr><td colspan='3' ><br /><h3></h3></td></tr>";
echo "<tr><td colspan='3' ><table border='0' align='center'><tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_CATEGORY_OVERRIDE'],$lang_new[$module_name]['CATEGORY_OVERRIDE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_OVERRIDE'].":</td><td>";
echo yesno_option('catoverride', $catoverride)."</td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_UPLOAD'],$lang_new[$module_name]['CATEGORY_UPLOAD_ALLOWED'])."&nbsp;".$lang_new[$module_name]['CATEGORY_UPLOAD_ALLOWED'].":</td><td>";
echo yesno_option('canupload', $canupload)."</td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_ACTIVE2'],$lang_new[$module_name]['CATEGORY_ACTIVE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_ACTIVE'].":</td><td>";
echo yesno_option('catactive', $catactive)."</td></tr></table></td></tr>";
echo "<tr><td><br /></td></tr>";
echo "<tr><td colspan='3' align='center'><input type='submit' onclick='return validate();' value='".$lang_new[$module_name]['SUBMIT_MODIFY']."'  tabindex='10' /></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "</table>";
echo "<input type='hidden' name='modify_catid' value='".$cid."' />";
echo "</form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>