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

$canupload              = $_GETVAR->get('canupload', 'POST', 'int', 0);
$catactive              = $_GETVAR->get('catactive', 'POST', 'int', 0);
$cdescription           = $_GETVAR->get('cdescription', 'POST', 'string', '');
$image                  = $_GETVAR->get('image', 'POST', 'string', '');
$maxdirsize             = $_GETVAR->get('maxdirsize', 'POST', 'int', 0);
$maxfilesize            = $_GETVAR->get('maxfilesize', 'POST', 'int', 0);
$sizedefinefile         = $_GETVAR->get('sizedefinefile', '_POST', 'int', 0);
$sizedefinedir          = $_GETVAR->get('sizedefinedir', '_POST', 'int', 0);
$mintime                = $_GETVAR->get('mintime', 'POST', 'int', 0);
$mode                   = $_GETVAR->get('mode', 'POST', 'string', '');
$parentid               = $_GETVAR->get('parentid', 'POST', 'int', 0);
$restricted_group_add   = $_GETVAR->get('restricted_group_add', 'POST', 'int', 0);
$restricted_group_see   = $_GETVAR->get('restricted_group_see', 'POST', 'int', 0);
$title                  = $_GETVAR->get('CatTitle', 'POST', 'string', '');
$uploaddir              = $_GETVAR->get('CatUploadDir', 'POST', 'string', '');


if ($mode == 'DownloadsAddCat'){
    $parentid = 0;
}

$error = '';
$allowed = DownloadsUploadsAllowed();
if (!$allowed && $canupload){
    $error .= $lang_new[$module_name]['ERROR_NO_UPLOAD_ALLOWED'].'<br />';
}

if (!empty($uploaddir)){
    if (((stristr($uploaddir, 'http')) === TRUE ) || ((stristr($uploaddir, 'ftp')) === TRUE )){
        $error .= $lang_new[$module_name]['ERROR_NO_EXTERNAL_DIR'].'<br />';
    } else {
        $uploaddir      = DownloadsCutDirectorySlashesStart($uploaddir);
        $uploaddir      = DownloadsCutDirectorySlashesEnd($uploaddir);
        $slash          = strpos($uploaddir, '/');
        if ($slash !== false){
            $uploaddir  = substr($uploaddir, 0, $slash);
        }
        if ($mode == 'DownloadsAddSubCat') {
            $xresult    = $db->sql_fetchrow($db->sql_query("SELECT `uploaddir` FROM "._DOWNLOADS_CATEGORIES_TABLE." WHERE `cid` = '".$parentid."'"));
            $uploaddir  = $xresult['uploaddir'].'/'.$uploaddir;
        } else {
            $uploaddir  = $downloadsconfig['downloads_basedir'].'/'.$uploaddir;
        }
        $uploadimagedir = $uploaddir.'/images';
        if (DownloadsMakeDirectory($uploaddir) === FALSE || DownloadsMakeDirectory($uploadimagedir) === FALSE) {
            DownloadsHeader();
            OpenTable();
            echo "<center><span class='option'>"
                ."<em>".$title."</em><br />"
                ."<strong>".$lang_new[$module_name]['ERROR_CREATING_DIR']."</strong><br />"
                .$lang_new[$module_name]['SUBMIT_GOBACK']."<br />";
            echo "</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }
} else {
    $uploaddir = $downloadsconfig['downloads_basedir'];
}

if (empty($error)) {
    $db->sql_uquery("INSERT INTO `"._DOWNLOADS_CATEGORIES_TABLE."` (`cid`, `title`, `image`, `cdescription`, `parentid`, `restricted_group_add`, `restricted_group_see`, `uploaddir`, `mintime`, `maxdirsize`, `sizedefinedir`, `maxfilesize`, `sizedefinefile`, `canupload`, `catactive`, `downloadimagedir`)
                    VALUES (NULL, '$title', '$image', '$cdescription', '$parentid', '$restricted_group_add', '$restricted_group_see', '$uploaddir', '$mintime', '$maxdirsize', '$sizedefinedir', '$maxfilesize', '$sizedefinefile', '$canupload', '$catactive', '$uploadimagedir')");
    $row = $db->sql_ufetchrow("SELECT `cid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `title` = '".$title."'");
    $status = "<strong>".$lang_new[$module_name]['CATEGORY']."<span style='color:#cc0000;'>".$title."</span>".$lang_new[$module_name]['CATEGORY_ADDCATS']."<span style='color:#cc0000'>".$uploaddir."</span>.</strong>";
    echo "<script type='text/javascript'>
        /*<![CDATA[*/\n
        window.onload = load;
        function load(){
            Sexy.done('$status', {onComplete: function(returnvalue) {if (returnvalue) {window.location.href = 'admin.php?op=DownloadsCatList';}}});
            return false;
        }
        \n/*]]>*/\n
        </script>";
    redirect($admin_file.".php?op=DownloadsCatList&amp;cid=".$row['cid']."&amp;status=1");
} else {
    DownloadsHeader();
    OpenTable();
    echo "<center><span class='option'>"
        ."<em>".$title."</em><br />"
        ."<strong>".$error."</strong><br />"
        .$lang_new[$module_name]['SUBMIT_GOBACK']."<br />";
    echo "</span></center>";
    CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');

?>