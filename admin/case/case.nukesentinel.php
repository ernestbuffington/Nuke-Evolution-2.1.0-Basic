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

global $admin_file;

switch($op) {
    case 'ABAuth':
    case 'ABAuthEdit':
    case 'ABAuthEditSave':
    case 'ABAuthList':
    case 'ABAuthResend':
    case 'ABAuthScan':
    case 'ABBlockedIPAdd':
    case 'ABBlockedIPAddSave':
    case 'ABBlockedIPClear':
    case 'ABBlockedIPClearExpired':
    case 'ABBlockedIPClearSave':
    case 'ABBlockedIPDelete':
    case 'ABBlockedIPDeleteSave':
    case 'ABBlockedIPEdit':
    case 'ABBlockedIPEditSave':
    case 'ABBlockedIPList':
    case 'ABBlockedIPListPrint':
    case 'ABBlockedIPMenu':
    case 'ABBlockedIPView':
    case 'ABBlockedIPViewPrint':
    case 'ABBlockedRangeAdd':
    case 'ABBlockedRangeAddSave':
    case 'ABBlockedRangeClear':
    case 'ABBlockedRangeClearExpired':
    case 'ABBlockedRangeClearSave':
    case 'ABBlockedRangeDelete':
    case 'ABBlockedRangeDeleteSave':
    case 'ABBlockedRangeEdit':
    case 'ABBlockedRangeEditSave':
    case 'ABBlockedRangeList':
    case 'ABBlockedRangeListPrint':
    case 'ABBlockedRangeMenu':
    case 'ABBlockedRangeOverlapCheck':
    case 'ABBlockedRangeView':
    case 'ABBlockedRangeViewPrint':
    case 'ABCGIAuth':
    case 'ABCGIBuild':
    case 'ABConfig':
    case 'ABConfigAdmin':
    case 'ABConfigAuthor':
    case 'ABConfigClike':
    case 'ABConfigDefault':
    case 'ABConfigFilter':
    case 'ABConfigFlood':
    case 'ABConfigHarvester':
    case 'ABConfigReferer':
    case 'ABConfigRequest':
    case 'ABConfigSave':
    case 'ABConfigScript':
    case 'ABConfigString':
    case 'ABConfigUnion':
    case 'ABConfigUpdate':
    case 'ABCountryList':
    case 'ABDBMaintenance':
    case 'ABDBOptimize':
    case 'ABDBRepair':
    case 'ABDBStructure':
    case 'ABExcludedAdd':
    case 'ABExcludedAddSave':
    case 'ABExcludedClear':
    case 'ABExcludedClearSave':
    case 'ABExcludedDelete':
    case 'ABExcludedDeleteSave':
    case 'ABExcludedEdit':
    case 'ABExcludedEditSave':
    case 'ABExcludedList':
    case 'ABExcludedListPrint':
    case 'ABExcludedMenu':
    case 'ABExcludedOverlapCheck':
    case 'ABExcludedView':
    case 'ABExcludedViewPrint':
    case 'ABHarvesterAdd':
    case 'ABHarvesterAddSave':
    case 'ABHarvesterDelete':
    case 'ABHarvesterDeleteSave':
    case 'ABHarvesterEdit':
    case 'ABHarvesterEditSave':
    case 'ABHarvesterList':
    case 'ABHarvesterListPrint':
    case 'ABHarvesterMenu':
    case 'ABIP2CountryAdd':
    case 'ABImport':
    case 'ABImportBlockedRange':
    case 'ABImportIP2Country':
    case 'ABIP2CountryAddSave':
    case 'ABIP2CountryDelete':
    case 'ABIP2CountryDeleteSave':
    case 'ABIP2CountryEdit':
    case 'ABIP2CountryEditSave':
    case 'ABIP2CountryList':
    case 'ABIP2CountryMenu':
    case 'ABIP2CountryOverlapCheck':
    case 'ABIP2CountryUpdateBlocked':
    case 'ABIP2CountryUpdateBlockedRanges':
    case 'ABIP2CountryUpdateExcludedRanges':
    case 'ABIP2CountryUpdateProtectedRanges':
    case 'ABIP2CountryUpdateTracked':
    case 'ABLoadError':
    case 'ABMain':
    case 'ABMainSave':
    case 'ABProtectedAdd':
    case 'ABProtectedAddSave':
    case 'ABProtectedClear':
    case 'ABProtectedClearSave':
    case 'ABProtectedDelete':
    case 'ABProtectedDeleteSave':
    case 'ABProtectedEdit':
    case 'ABProtectedEditSave':
    case 'ABProtectedList':
    case 'ABProtectedListPrint':
    case 'ABProtectedMenu':
    case 'ABProtectedOverlapCheck':
    case 'ABProtectedView':
    case 'ABProtectedViewPrint':
    case 'ABRefererAdd':
    case 'ABRefererAddSave':
    case 'ABRefererDelete':
    case 'ABRefererDeleteSave':
    case 'ABRefererEdit':
    case 'ABRefererEditSave':
    case 'ABRefererList':
    case 'ABRefererListPrint':
    case 'ABRefererMenu':
    case 'ABSearch':
    case 'ABSearchIPPrint':
    case 'ABSearchIPResults':
    case 'ABSearchRangePrint':
    case 'ABSearchRangeResults':
    case 'ABStringAdd':
    case 'ABStringAddSave':
    case 'ABStringDelete':
    case 'ABStringDeleteSave':
    case 'ABStringEdit':
    case 'ABStringEditSave':
    case 'ABStringList':
    case 'ABStringListPrint':
    case 'ABStringMenu':
    case 'ABTemplate':
    case 'ABTemplateSource':
    case 'ABTemplateView':
    case 'ABTrackedAdd':
    case 'ABTrackedAddSave':
    case 'ABTrackedAgentsDelete':
    case 'ABTrackedAgentsIPs':
    case 'ABTrackedAgentsList':
    case 'ABTrackedAgentsListAdd':
    case 'ABTrackedAgentsListAddSave':
    case 'ABTrackedAgentsListPrint':
    case 'ABTrackedAgentsPages':
    case 'ABTrackedAgentsPagesPrint':
    case 'ABTrackedClear':
    case 'ABTrackedClearSave':
    case 'ABTrackedDelete':
    case 'ABTrackedDeleteSave':
    case 'ABTrackedList':
    case 'ABTrackedListPrint':
    case 'ABTrackedMenu':
    case 'ABTrackedPages':
    case 'ABTrackedPagesPrint':
    case 'ABTrackedRefersDelete':
    case 'ABTrackedRefersIPs':
    case 'ABTrackedRefersList':
    case 'ABTrackedRefersListAdd':
    case 'ABTrackedRefersListAddSave':
    case 'ABTrackedRefersListPrint':
    case 'ABTrackedRefersPages':
    case 'ABTrackedRefersPagesPrint':
    case 'ABTrackedUsersDelete':
    case 'ABTrackedUsersIPs':
    case 'ABTrackedUsersList':
    case 'ABTrackedUsersListPrint':
    case 'ABTrackedUsersPages':
    case 'ABTrackedUsersPagesPrint':
        include(NUKE_ADMIN_MODULE_DIR.'nukesentinel.php');
    break;
}
?>