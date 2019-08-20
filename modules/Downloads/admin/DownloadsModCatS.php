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

$canupload              = $_GETVAR->get('canupload', '_POST', 'int', 0);
$catactive              = $_GETVAR->get('catactive', '_POST', 'int', 0);
$cdescription           = $_GETVAR->get('cdescription', '_POST', 'string', '');
$image                  = $_GETVAR->get('image', '_POST', 'string', '');
$maxdirsize             = $_GETVAR->get('maxdirsize', '_POST', 'int', 0);
$maxfilesize            = $_GETVAR->get('maxfilesize', '_POST', 'int', 0);
$sizedefinefile         = $_GETVAR->get('sizedefinefile', '_POST', 'int', 0);
$sizedefinedir          = $_GETVAR->get('sizedefinedir', '_POST', 'int', 0);
$mintime                = $_GETVAR->get('mintime', '_POST', 'int', 0);
$mode                   = $_GETVAR->get('mode', '_POST', 'string', '');
$parentid               = $_GETVAR->get('parentid', '_POST', 'int', 0);
$restricted_group_add   = $_GETVAR->get('restricted_group_add', '_POST', 'int', 0);
$restricted_group_see   = $_GETVAR->get('restricted_group_see', '_POST', 'int', 0);
$title                  = $_GETVAR->get('ModCatTitle', '_POST', 'string', '');
$modify_catid           = $_GETVAR->get('modify_catid', '_POST', 'int', 0);

if ($mode == 'DownloadsAddCat'){
    $parentid = 0;
}

$error = '';
$allowed = DownloadsUploadsAllowed();
if (!$allowed && $canupload){
    $error .= $lang_new[$module_name]['ERROR_NO_UPLOAD_ALLOWED'].'<br />';
}

if (empty($error)) {
    $db->sql_uquery("UPDATE `"._DOWNLOADS_CATEGORIES_TABLE."` SET
        `title`                 = '".$title."',
        `image`                 = '".$image."',
        `cdescription`          = '".$cdescription."',
        `restricted_group_add`  = '".$restricted_group_add."',
        `restricted_group_see`  = '".$restricted_group_see."',
        `mintime`               = '".$mintime."',
        `maxdirsize`            = '".$maxdirsize."',
        `sizedefinedir`         = '".$sizedefinedir."',
        `maxfilesize`           = '".$maxfilesize."',
        `sizedefinefile`        = '".$sizedefinedir."',
        `canupload`             = '".$canupload."',
        `catactive`             = '".$catactive."'
        WHERE `cid` = '".$modify_catid."'");

    $status = "<strong>".$lang_new[$module_name]['CATEGORY']."<span style='color:#cc0000;'>".$title."</span>".$lang_new[$module_name]['CATEGORY_ADDCATS']."<span style='color:#cc0000'>".$uploaddir."</span>.</strong>";
    redirect($admin_file.".php?op=DownloadsCatList&amp;cid=".$modify_catid."&amp;status=2");
} else {
    DownloadsHeader();
    OpenTable();
    echo "<center><span class='option'>"
        ."<em>".$title."</em><br />"
        ."<strong>".$error."</strong><br />"
        .$lang_new[$module_name]['SUBMIT_GOBACK']."<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>