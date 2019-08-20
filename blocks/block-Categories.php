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

global $currentlang, $db, $currentlang, $evoconfig;

function block_categories_cache($block_cachetime) {
    global $db, $cache, $evoconfig, $currentlang;
    if ((($blockcache = $cache->load('categories', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        if ($evoconfig['multilingual'] == 1) {
            $querylang = "AND (alanguage='" . $currentlang . "' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
        } else {
            $querylang = '';
        }
        $result = $db->sql_query('SELECT `catid`, `title` FROM `'._STORIES_CATEGORIES_TABLE.'` ORDER BY `title`');
        $actualtime = actualTime();
        $a = 0;
        while (list($catid, $title) = $db->sql_fetchrow($result)) {
            $result2 = $db->sql_ufetchrow('SELECT COUNT(`sid`) as no FROM `'._STORIES_TABLE.'` WHERE `catid`='.$catid.' AND `time` <= "'.$actualtime.'" '.$querylang);
            $a++;
            $blockcache[$a]['catid']= $catid;
            $blockcache[$a]['title']= $title;
            $blockcache[$a]['count']= $result2['no'];
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('categories', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_categories_cache($evoconfig['block_cachetime']);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
        $title = stripslashes(check_html($blocksession[$a]['title'], "nohtml"));
        $catid   = intval($blocksession[$a]['catid']);
        $count   = intval($blocksession[$a]['count']);
    $blockcontent .= "<span style='font-weight: bold; font-size: large;'>&middot;</span>&nbsp;<a href=\"modules.php?name=News&amp;op=categories&amp;op=newindex&amp;catid=".$catid."\">($count)&nbsp;$title</a><br />";
}

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    $content .= $blockcontent;
}
$content .= "</div>\n";
?>