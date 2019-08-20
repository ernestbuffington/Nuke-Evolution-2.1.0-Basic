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

global $db, $evoconfig;

function block_content_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('content', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query("SELECT `pid`, `title` FROM `"._PAGES_TABLE."` WHERE `active`='1' ORDER BY `date` DESC");
        $a = 0;
        while (list($pid, $title) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['pid']  = $pid;
            $blockcache[$a]['title']= $title;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('content', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_content_cache($evoconfig['block_cachetime']);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    $pid    = intval($blocksession[$a]['pid']);
    $title  = stripslashes($blocksession[$a]['title']);
    $blockcontent .= "<div style='float:left; width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' /></div>\n";
    $blockcontent .= "<div style='float:left; width: 90%;'><a href='modules.php?name=Content&amp;pa=showpage&amp;pid=$pid'>$title</a></div>\n";
}

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;font-size: x-small'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= $blockcontent;
}
$content .= "</div><br />\n";
?>