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

global $currentlang, $db, $userinfo, $mode, $order, $thold, $evoconfig;

function block_bigstorieoftoday_cache($block_cachetime) {
    global $db, $cache, $evoconfig, $currentlang;
    if ((($blockcache = $cache->load('bigstorieoftoday', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        if ($evoconfig['multilingual'] == 1) {
            $querylang = "AND (alanguage='" . $currentlang . "' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
        } else {
            $querylang = '';
        }
        $searchtime = time() - 864000; // = 10 days * 60 minutes * 60 seconds
        $result = $db->sql_query('SELECT `sid`, `title` FROM `'._STORIES_TABLE.'` WHERE `time`>FROM_UNIXTIME('.$searchtime.') AND `time`< FROM_UNIXTIME('.time().') '.$querylang.' ORDER BY `counter` DESC LIMIT 0,1');
        $a = 0;
        while (list($sid, $title) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['sid']  = $sid;
            $blockcache[$a]['title']= $title;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('bigstorieoftoday', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_bigstorieoftoday_cache($evoconfig['block_cachetime']);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    $title = stripslashes(check_html($blocksession[$a]['title'], 'nohtml'));
    $sid   = intval($blocksession[$a]['sid']);
    $r_options = '';
    if (!isset($mode) || empty($mode)) {
        $r_options .= (!empty($userinfo['umode'])) ? '&amp;mode='.$userinfo['umode'] : '&amp;mode=thread';
    }
    if (!isset($order) || empty($order)) {
        $r_options .= (!empty($userinfo['uorder'])) ? '&amp;order='.$userinfo['uorder'] : '';
    }
    if (!isset($thold) || empty($thold)) {
        $r_options .= (!empty($userinfo['thold'])) ? '&amp;thold='.$userinfo['thold'] : '';
    }
    $blockcontent .= "<p style='text-align:center;'><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid.$r_options."'>".$title."</a></p>\n";
}

$content = "<div style='width: 100%;' class='content'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    $content .= "<p style='font-weight: bold; text-align:center;'>".$lang_block['BLOCK_BIGSTORY_OF_TODAY_CONTENT']."</p>\n";
    $content .= $blockcontent;
}
$content .= "</div>\n";
?>