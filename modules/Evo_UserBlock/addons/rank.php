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

if(!defined('NUKE_EVO')) exit;

if (defined('ADMIN_FILE')) {
    global $userinfo, $evouserinfo_rank;
}

function evouserinfo_rank () {
   global $userinfo;

   $rank_userid = $userinfo['user_id'];
   $rank_infos = GetRank($rank_userid);
   $rank_image = $rank_infos['image'];
   $poster_rank = $rank_infos['title'];
   if (empty($rank_image) && empty($poster_rank)) {
        $evouserinfo_rank = '';
   } else {
    		$evouserinfo_rank .= "<div align=\"center\">";
    		$evouserinfo_rank .= $rank_image.'<br />'.$poster_rank;
    		$evouserinfo_rank .= "</div><br />";
   }
   return $evouserinfo_rank;
}

if (is_user()) {
    $evouserinfo_rank = evouserinfo_rank();
} else {
    $evouserinfo_rank = '';
}

?>