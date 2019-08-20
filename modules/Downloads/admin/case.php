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

$module_name = basename(dirname(dirname(__FILE__)));
$lang_path = NUKE_MODULES_DIR . $module_name . '/language/';
if (@file_exists($lang_path . 'lang-' . $currentlang . '.php')) {
    include_once($lang_path . 'lang-' . $currentlang . '.php');
} elseif (@file_exists($lang_path . 'lang-' . $board_config['default_lang'] . '.php')) {
    include_once($lang_path . 'lang-' . $board_config['default_lang'] . '.php');
} else {
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
}

switch($op) {
    
    case 'AddNewDownload':
    case 'DownloadAdminValidation':
    case 'Downloads':
    case 'DownloadsActivate':
    case 'DownloadsAddCat':
    case 'DownloadsAddCatS':
    case 'DownloadsAddDownload':
    case 'DownloadsAddEditorial':
    case 'DownloadsAddNewDownloadS':
    case 'DownloadsAddSubCat':
    case 'DownloadsCatActivate':
    case 'DownloadsCatDeactivate':    
    case 'DownloadsCatList':
    case 'DownloadsCheck':    
    case 'DownloadsCleanVotes':    
    case 'DownloadsDeactivate':
    case 'DownloadsDelBrokenDownloads':
    case 'DownloadsDelCat':
    case 'DownloadsDelComment':
    case 'DownloadsDelDBRow':
    case 'DownloadsDelete':
    case 'DownloadsDelEditorial':
    case 'DownloadsDelVote':
    case 'DownloadsDelete':
    case 'DownloadsDelDBRow':
    case 'DownloadsEditBrokenDownload':
    case 'DownloadsEditBrokenDownloadS':
    case 'DownloadsExtList':
    case 'DownloadsExtAdd':
    case 'DownloadsExtDel':
    case 'DownloadsExtActivate':
    case 'DownloadsExtDeactivate':
    case 'DownloadsExtModify':
    case 'DownloadsExtModifyS':
    case 'DownloadsGroupAdd':
    case 'DownloadsGroupAddS':
    case 'DownloadsGroupDel':
    case 'DownloadsGroupMod':
    case 'DownloadsGroupModS':
    case 'DownloadsGroupList':
    case 'DownloadsGroupActivate':
    case 'DownloadsGroupDeactivate':
    case 'DownloadsIgnoreBrokenDownloads':    
    case 'DownloadsLicensesList':
    case 'DownloadsLicensesDel':
    case 'DownloadsLicensesMod':
    case 'DownloadsLicensesModS':
    case 'DownloadsLicensesAdd':
    case 'DownloadsLicensesAddS': 
    case 'DownloadsListBrokenDownloads':
    case 'DownloadsListValidateDownloads':   
    case 'DownloadsModCat':
    case 'DownloadsModCatS':
    case 'DownloadsModDownload':
    case 'DownloadsModDownloadS': 
    case 'DownloadsModEditorial':
    case 'DownloadsModSelect':
    case 'DownloadsSaveSettings':    
    case 'DownloadsSettings':
    case 'DownloadsTransfer':
    case 'DownloadsTransferCat':
    case 'DownloadsUserActivate':
    case 'DownloadsUserAdd':
    case 'DownloadsUserAddS':
    case 'DownloadsUserDeactivate':
    case 'DownloadsUserDel':
    case 'DownloadsUserList':
    case 'DownloadsUserMod':
    case 'DownloadsUserModS':
    case 'DownloadsValidate':
    case 'DownloadsValidateEditDownloads':

        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>