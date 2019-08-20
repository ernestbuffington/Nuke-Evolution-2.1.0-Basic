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
if (file_exists($lang_path . 'lang-' . $currentlang . '.php'))
{
    include_once($lang_path . 'lang-' . $currentlang . '.php');
}
elseif (file_exists($lang_path . 'lang-' . $board_config['default_lang'] . '.php'))
{
    include_once($lang_path . 'lang-' . $board_config['default_lang'] . '.php');
}
else
{
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
}

switch($op) {

    case "Links":
    case "LinksDelNew":
    case "LinksAddCat":
    case "LinksAddSubCat":
    case "LinksAddLink":
    case "LinksAddEditorial":
    case "LinksModEditorial":
    case "LinksLinkCheck":
    case "LinksValidate":
    case "LinksDelEditorial":
    case "LinksCleanVotes":
    case "LinksListBrokenLinks":
    case "LinksEditBrokenLinks":
    case "LinksDelBrokenLinks":
    case "LinksIgnoreBrokenLinks":
    case "LinksListModRequests":
    case "LinksChangeModRequests":
    case "LinksChangeIgnoreRequests":
    case "LinksDelCat":
    case "LinksModCat":
    case "LinksModCatS":
    case "LinksModLink":
    case "LinksModLinkS":
    case "LinksDelLink":
    case "LinksDelVote":
    case "LinksDelComment":
    case "LinksTransfer":
    case "LinksSettings":
    case "LinksSaveSettings":
    case "LinksAddMainCategory":
    case "LinksSaveSubCat":
    case "LinksSelectModifyCategory":
    case "AddNewLink":
    case "LinkAdminValidation":
    case "LinksListNewLinks":
    case "SelectModifyLink":
    case "LinksTransferCat":
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>