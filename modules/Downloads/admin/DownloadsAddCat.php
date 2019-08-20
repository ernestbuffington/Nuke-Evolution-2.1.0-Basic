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

global $db, $ThemeInfo, $downloadsconfig, $module_name, $lang_new;

$op            = $_GETVAR->get('op', '_REQUEST', 'string', '');
$mode          = $_GETVAR->get('mode', '_REQUEST', 'string', '');
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

$result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM "._DOWNLOADS_CATEGORIES_TABLE." ORDER BY `title`");
$presult = $db->sql_query("SELECT `title`, `uploaddir` FROM "._DOWNLOADS_CATEGORIES_TABLE." ORDER BY `cid`");

$check_dir      = '';
$check_titles   = '';
$local          = $downloadsconfig['downloads_basedir'].'/';

if ($op == 'DownloadsAddSubCat') {
    $mode = 'DownloadsAddSubCat';
}

while ($catinfo = $db->sql_fetchrow($presult)){
    $check_titles   .= strtolower(htmlentities($catinfo['title'], ENT_QUOTES)).', ';
    $check_dir      .= $catinfo['uploaddir'].',';
}
$db->sql_freeresult($presult);

DownloadsHeader();

echo "<script type='text/javascript'>
      /*<![CDATA[*/\n
function validate() {
    var title_fieldvalue    = document.AddMainCat.CatTitle.value;
    var title_array_all     = '".$check_titles."';
    var title_array_all     = title_array_all.split(',');
    if (title_fieldvalue == ''){
        Sexy.alert('".$lang_new[$module_name]['HELP_ADD_TITLE']."');
        return false;
    } else {
        for (var i = 0; i < title_array_all.length; i++){
            if (title_fieldvalue == title_array_all[i]){
                Sexy.alert('".$lang_new[$module_name]['CATEGORY_TITLE_DOUBLE']."');
                return false;
            }
        }
    }
    var fieldvalue  = document.AddMainCat.CatUploadDir.value;
    if (fieldvalue == ''){Sexy.alert('".$lang_new[$module_name]['CATEGORY_ADDDIR']."'); return false;}
    var lastChar = fieldvalue.substring(fieldvalue.length, -1);
    if (lastChar == '/'){
        do {
            fieldvalue  = fieldvalue.slice(0, -1);
            lastChar    = fieldvalue.substring(fieldvalue.length, -1);
        } while (lastChar == '/');
    }
    var firstChar = fieldvalue.substr(0, 1);
    if (firstChar == '/'){
        do {
            fieldvalue  = fieldvalue.slice(1);
            firstChar   = fieldvalue.substr(0, 1);
        } while (firstChar == '/');
    }
    var findSlash = fieldvalue.indexOf('/');
    if (findSlash != -1){
        fieldvalue = fieldvalue.substring(0, findSlash);
    }
    var fieldvalue  = '$local' + fieldvalue;
    var array_dir   = '$check_dir';
    var na          = new Array();
    na              = array_dir.split(',');
    var i       = 0;
    var length  = na.length;
    for(; i < length; i++){
        if (na[i] == fieldvalue){
        Sexy.alert('".$lang_new[$module_name]['CATEGORY_DIR_DOUBLE']."');
        return false;
        }
    }
}
\n/*]]>*/\n
</script>";

OpenTable();

echo "<span class='option'><strong>".$lang_new[$module_name]['ADMIN_ADD_CAT']."</strong></span>";
echo "<h3></h3>";
echo "<form id='AddMainCat' name='AddMainCat' method='post' action='".$admin_file.".php?op=DownloadsAddCatS'>";
echo "<table width='100%' border='0' align='center'>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_NAME'],$lang_new[$module_name]['NAME'])."&nbsp;".$lang_new[$module_name]['NAME'].": </td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input type='text' name='CatTitle' size='75%' maxlength='255' tabindex='1' /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_DIRECTORY_PATH_MORE'],$lang_new[$module_name]['CATEGORY_DIRECTORY_DIR'])."&nbsp;".$lang_new[$module_name]['CATEGORY_DIRECTORY_DIR'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input type='text' name='CatUploadDir' size='75%' maxlength='255' tabindex='2'/></td></tr>";
if ($mode == 'DownloadsAddSubCat') {
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_CATEGORY'],$lang_new[$module_name]['IN'])."&nbsp;".$lang_new[$module_name]['IN']."</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td>";
    echo "<select name='parentid'>";
    while($row = $db->sql_fetchrow($result1)) {
        $cid2           = intval($row['cid']);
        $ctitle2        = stripslashes($row['title']);
        $parentid2      = intval($row['parentid']);
        if ($parentid2!=0) {
            $ctitle2 = DownloadsGetParent($parentid2,$ctitle2);
        }
        echo "<option value='".$cid2."'>".$ctitle2."</option>";
    }
    $db->sql_freeresult($result1);
    echo "</select></td></tr>";
}
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' valign='top' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_IMAGE_SEL'],$lang_new[$module_name]['DOWNLOAD_IMAGE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_IMAGE'].": </td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px' ><span style='color:red;font-weight:bold;'></span></td><td>".DownloadsSelectGallery('image', 'modules/Downloads/images/categories', TRUE, '', 3)."</td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' colspan='3' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_DESCRIPTION'],$lang_new[$module_name]['DESCRIPTION'])."&nbsp;".$lang_new[$module_name]['DESCRIPTION'].": </td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' colspan='3' style='border:solid white 1px'><br />";
echo Make_TextArea('cdescription',$cdescription, 'AddMainCat', '90%', '150px', true, 'bbcode')."</td></tr>";
echo "<tr><td colspan='3' ><h3><br /></h3></td></tr>";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' border='0' align='center'><tr><td width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' >".evo_help_img($lang_new[$module_name]['CATEGORY_GROUP_DOWNLOAD'],$lang_new[$module_name]['CAT_RESTRICTED_GROUP_ADD'])."&nbsp;".$lang_new[$module_name]['CAT_RESTRICTED_GROUP_ADD'].":</td><td width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' >".evo_help_img($lang_new[$module_name]['CATEGORY_GROUP_SEE'],$lang_new[$module_name]['CAT_RESTRICTED_GROUP_SEE'])."&nbsp;".$lang_new[$module_name]['CAT_RESTRICTED_GROUP_SEE'].": </td></tr></table></td></tr>";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' border='0' align='center'><tr><td width='50%' align='center' bgcolor='".$ThemeInfo['bgcolor2']."' ><select name='restricted_group_add' tabindex='5'>";
echo DownloadsGroupSelect($restricted_group_add);
echo "</select></td><td width='50%' align='center' bgcolor='".$ThemeInfo['bgcolor2']."' ><select name='restricted_group_see' tabindex='6'>";
echo DownloadsGroupSelect($restricted_group_see);
echo "</select></td></tr></table></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' border='0' align='center' ><tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['HELP_MINTIME'],$lang_new[$module_name]['CATEGORY_MINTIME'])."&nbsp;".$lang_new[$module_name]['CATEGORY_MINTIME'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['MAXDIRSIZE'],$lang_new[$module_name]['CATEGORY_MAXDIRSIZE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_MAXDIRSIZE'].": </td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['MAXFILESIZE'],$lang_new[$module_name]['CATEGORY_MAXFILESIZE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_MAXFILESIZE'].": </td></tr></table></td></tr>";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' border='0' align='center' ><tr><td width='33%' align='center' bgcolor='".$ThemeInfo['bgcolor2']."' ><input type='text' value='0' name='mintime' size='6' maxlength='6' tabindex='7' />&nbsp;".$lang_new[$module_name]['SECONDS']."</td><td width='33%' align='center' bgcolor='".$ThemeInfo['bgcolor2']."' ><input type='text' value='0' name='maxdirsize' size='6' maxlength='6' tabindex='8' /> ";
echo "<select name='sizedefinedir'>";
echo "<option value='0' selected='selected'>".$lang_new[$module_name]['SIZE_KB']."</option>";
echo "<option value='1'>".$lang_new[$module_name]['SIZE_MB']."</option>";
echo "<option value='2'>".$lang_new[$module_name]['SIZE_GB']."</option>";
echo "</select></td>";
echo "<td width='33%' align='center' bgcolor='".$ThemeInfo['bgcolor2']."' ><input type='text' value='".$maxfilesize."' name='maxfilesize' size='6' maxlength='6' tabindex='9' /> ";
echo "<select name='sizedefinefile'>";
echo "<option value='0' selected='selected'>".$lang_new[$module_name]['SIZE_KB']."</option>";
echo "<option value='1'>".$lang_new[$module_name]['SIZE_MB']."</option>";
echo "<option value='2'>".$lang_new[$module_name]['SIZE_GB']."</option>";
echo "</select>";
echo "</td></tr></table></td></tr>";
echo "<tr><td colspan='3' align='center' >".$lang_new[$module_name]['INFO_MAX_SYSTEM_FILESIZE'].":&nbsp;".$maxallowed."<br />".$lang_new[$module_name]['SIZE_KB'].":&nbsp;".($maxallowed/1024)."<br />".$lang_new[$module_name]['SIZE_MB'].":&nbsp;".($maxallowed/1048576)."</td></tr>";
echo "<tr><td colspan='3' ><br /><h3></h3></td></tr>";
echo "<tr><td colspan='3' ><table>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_CATEGORY_OVERRIDE'],$lang_new[$module_name]['CATEGORY_OVERRIDE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_OVERRIDE'].":</td><td>";
echo yesno_option('catoverride', 0)."</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_UPLOAD'],$lang_new[$module_name]['CATEGORY_UPLOAD_ALLOWED'])."&nbsp;".$lang_new[$module_name]['CATEGORY_UPLOAD_ALLOWED'].":</td><td>";
echo yesno_option('canupload', 0)."</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['CATEGORY_ACTIVE2'],$lang_new[$module_name]['CATEGORY_ACTIVE'])."&nbsp;".$lang_new[$module_name]['CATEGORY_ACTIVE'].":</td><td>";
echo yesno_option('catactive', 0)."</td></tr>";
echo "</table></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td colspan='3' align='center'><input type='submit' onclick='return validate();' value='".$lang_new[$module_name]['SUBMIT_ADD']."' tabindex='10' /></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "</table>";
if ($mode == 'DownloadsAddSubCat') {
    echo "<input type='hidden' name='mode' value='DownloadsAddSubCat' />";
} else {
    echo "<input type='hidden' name='mode' value='DownloadsAddCat' />";
}
echo "</form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
?>