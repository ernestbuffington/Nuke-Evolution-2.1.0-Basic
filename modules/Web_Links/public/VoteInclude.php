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

if (!defined('MODULE_FILE') || !defined('WEBLINK_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

$outsidevotes   = 0;
$anonvotes      = 0;
$regvotes       = 0;
$outsiderating  = 0;
$anonrating     = 0;
$regrating      = 0;
$finalrating    = 0;
$totalvotes     = 0;
$totalrating1   = 0;
$totalrating2   = 0;
$voteresult     = $db->sql_query("SELECT `rating`, `ratinguser` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '".$lid."'");
$truecomments   = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '".$lid."' AND LENGTH(`ratingcomments`) > 1 ");
while($vrow = $db->sql_fetchrow($voteresult)) {
    $ratingDB       = intval($vrow['rating']);
    $ratinguserDB   = $vrow['ratinguser'];
    switch ($ratinguserDB) {
        case 'outside':
            $outsidevotes++;
            $outsiderating =+ $ratingDB;
            $totalvotes++;
            break;
        case ANONYMOUS:
            $anonvotes++;
            $anonrating =+ $ratingDB;
            $totalvotes++;
            break;
        default:
            $regvotes++;
            $regrating =+ $ratingDB;
            $totalvotes++;
            break;
    }
}
$db->sql_freeresult($voteresult);
$outsideweight = round(100 / ($weblinksconfig['outsideweight'] ? $weblinksconfig['outsideweight'] : 100), 0);
$anonweight    = round(100 / ($weblinksconfig['anonweight'] ? $weblinksconfig['anonweight'] : 100), 0);
if ($totalvotes == 0) {
    $finalrating = 0;
} else {
    $calcoutside = (($outsidevotes > 0) ? ($outsiderating / $outsidevotes) : 0);
    $calcanon    = (($anonvotes > 0) ? ($anonrating / $anonvotes) : 0);
    $calcreg     = (($regvotes > 0) ? ($regrating / $regvotes) : 0);
    if ($calcreg == 0) {
        if ($calcoutside == 0 || $calcanon == 0) {
            $finalrating = round((($calcanon == 0) ? $calcoutside : $calcanon), 6);
        } else {
            $finalrating = round((($calcaonon + $calcoutside) / 2),6);
        }
    } else {
        if ($calcoutside > 0) {
            $totalrating1= (($outsideweight * $calcreg) + $calcoutside) / ($outsideweight + 1);
        }
        if ($calcanon > 0) {
            $totalrating2= (($anonweight * $calcreg) + $calcoutside) / ($anonweight + 1);
        }
        if ($totalrating1 == 0 || $totalrating2 == 0) {
            $finalrating = (($totalrating1 == 0) ? $totalrating2 : $totalrating1);
        } else {
            $finalrating = (($totalrating1 + $totalrating2) / 2);
        }
        $finalrating = round(($finalrating + $calcreg), 4);
    }
}

?>