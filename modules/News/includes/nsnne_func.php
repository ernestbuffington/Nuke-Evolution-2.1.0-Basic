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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }


function ModuleNewsHeading() {
    global $module_name, $lang_new, $op;
    $text = '';
    if (!defined('HOME_FILE')) {
        $text .= "";
        title($text, $module_name, 'news-logo.png');
    }
}

function ne_save_config($config_name, $config_value){
    global $db, $cache;
    $db->sql_uquery('REPLACE INTO `'._NSNNE_CONFIG_TABLE.'` set `config_value` = "'.$config_value.'", `config_name` = "'.$config_name.'"');
    $cache->delete('news', 'config');
}

function ne_get_configs(){
    global $db, $cache;
    static $config;
    if(isset($config)) {
        return $config;
    }
    if(($config = $cache->load('news', 'config')) === false) {
        $configresult = $db->sql_query("SELECT config_name, config_value FROM "._NSNNE_CONFIG_TABLE);
        while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
            $config[$config_name] = $config_value;
        }
        $db->sql_freeresult($configresult);
        $cache->save('news', 'config', $config);
    }
    return $config;
}

function automated_news() {
    global $currentlang, $db;
    $db->sql_uquery("INSERT INTO `"._STORIES_TABLE."` (`sid`,`catid`, `aid`, `title`, `time`, `hometext`, `bodytext`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `associated`, `ticon`, `writes`) 
                SELECT NULL, `catid`, `aid`, `title`, `time`, `hometext`, `bodytext`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `associated`, `ticon`, `writes` FROM "._AUTONEWS_TABLE." WHERE time<='".date('Y-m-d G:i:s', time())."'");
    $db->sql_uquery('DELETE FROM '._AUTONEWS_TABLE.' WHERE time<="'.date('Y-m-d G:i:s', time()).'"');
}

function getTopics($s_sid) {
    global $db;
    static $topic;

    if (isset($topic) && is_array($topic)) {
        if (isset($topic[$s_sid]) && is_array($topic[$s_sid])) {
            return $topic[$s_sid];
        }
    } else {
        $topic = array();
    }
    $row = $db->sql_ufetchrow('SELECT t.`topicname`, t.`topicimage`, t.`topictext` FROM (`'._STORIES_TABLE.'` s LEFT JOIN `'._TOPICS_TABLE.'` t ON t.`topicid` = s.`topic`) WHERE s.`sid` = "'.$s_sid.'"');
    $topic[$s_sid]['topicname']  = $row['topicname'];
    $topic[$s_sid]['topicimage'] = $row['topicimage'];
    $topic[$s_sid]['topictext']  = $row['topictext'];
    return $topic[$s_sid];
}

function ModuleNews_GetDBRow($where='', $display=''){
    global $admin_file, $db, $evoconfig, $neconfig, $module_name, $acomm;
    
    if (empty($where)) {
        $where = 'LIMIT 0,1';
    } else {
        $where = 'WHERE '.$where;
    }
    $row = $db->sql_ufetchrow('SELECT * FROM `'._STORIES_TABLE.'` '.$where);

    $the_icons = '';
    $morelink  = '';
    $result['datetime'] = formatTimeStamp($row['time'], '', 1);
    $result['time']     = $row['time'];
    if(!empty($row['subject'])) {
        $subject = EvoKernel_HtmlEntities(check_html($subject, 'nohtml'), ENT_NOQUOTES);
    }
    $result['hometext'] = check_words(set_smilies(decode_bbcode($row['hometext'], 1, true)));
    $result['hometext'] = evo_img_tag_to_resize($result['hometext']);
    $result['bodytext'] = check_words(set_smilies(decode_bbcode($row['bodytext'], 1, true)));
    $result['bodytext'] = evo_img_tag_to_resize($result['bodytext']);
    $result['row_text'] = $result['hometext'].'<br />'. $result['bodytext'];
    $result['notes']    = check_words(set_smilies(decode_bbcode($row['notes'], 1, true)));
    $result['sid']      = intval($row['sid']);
    $result['aid']      = EvoKernel_HtmlEntities($row['aid']);
    $result['title']    = EvoKernel_HtmlEntities(check_words(check_html($row['title'], 'nohtml')), ENT_NOQUOTES);
    $result['comments'] = intval($row['comments']);
    $result['counter']  = intval($row['counter']);
    $result['topic']    = intval($row['topic']);
    $result['acomm']    = intval($row['acomm']);
    $result['score']    = intval($row['score']);
    $result['ratings']  = intval($row['ratings']);
    $result['haspoll']  = intval($row['haspoll']);
    $result['pollID']   = intval($row['pollID']);
    $result['informantwrites'] = ($row['writes'] ? 1 : 0);
    $result['informant'][0] = (!empty($row['informant']) ? $row['informant'] : _ANONYMOUS);
    $result['informant'][1] = UsernameColor($result['informant'][0]);
    $result['topics']   = getTopics($result['sid']);
    if ($row['ticon']) {
        $result['topics']['topicimage'] = '';
    }
    if ($row['ratings'] > 0 && $row['score'] > 0) {
        $r_image = round(($row['score'] / $row['ratings']), 0);
        $result['average']   = round(($row['score'] / $row['ratings']), 2);
        if ($r_image == 1) {
                $the_image = "&nbsp;<img src='".evo_image('stars-1.png', $module_name)."' title='"._NE_COUNTRATINGS." ".$row['ratings']."' alt='' border='0' /> ";
        } elseif ($r_image == 2) {
                $the_image = "&nbsp;<img src='".evo_image('stars-2.png', $module_name)."' title='"._NE_COUNTRATINGS." ".$row['ratings']."' alt='' border='0' /> ";
        } elseif ($r_image == 3) {
                $the_image = "&nbsp;<img src='".evo_image('stars-3.png', $module_name)."' title='"._NE_COUNTRATINGS." ".$row['ratings']."' alt='' border='0' /> ";
        } elseif ($r_image == 4) {
                $the_image = "&nbsp;<img src='".evo_image('stars-4.png', $module_name)."' title='"._NE_COUNTRATINGS." ".$row['ratings']."' alt='' border='0' /> ";
        } elseif ($r_image == 5) {
                $the_image = "&nbsp;<img src='".evo_image('stars-5.png', $module_name)."' title='"._NE_COUNTRATINGS." ".$row['ratings']."' alt='' border='0' /> ";
        }
    } else {
        $the_image = '';
        $result['average'] = 0;
    }
    $result['the_image'] = $the_image;
    $result['introcount'] = utf8_strlen($row['hometext']);
    $result['fullcount']  = utf8_strlen($row['bodytext']);
    $result['totalcount'] = $result['introcount'] + $result['fullcount'];
    if (is_user()) {
        $the_icons .= "&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=print&amp;sid=".$row['sid']."' target='_blank'>\n<img src='".evo_image('print_small.png', $module_name)."' width='11' height='11' border='0' alt='"._PRINTER."' title='"._PRINTER."' /></a>\n";
        $the_icons .= "&nbsp;<a href='modules.php?name=".$module_name."&amp;op=friend&amp;mode=FriendSend&amp;sid=".$row['sid']."'><img src='".evo_image('friend_small.png', $module_name)."' width='11' height='11' border='0' alt='"._FRIEND."' title='"._FRIEND."' /></a>\n";
    }
    if (is_mod_admin($module_name)) {
        $the_icons .= "&nbsp;|&nbsp;<img src='".evo_image('approved.png', $module_name)."' width='11' height='11' border='0' title='"._APPROVEDBY."&nbsp;".$result['aid']."' alt='' />&nbsp;|";
        $the_icons .= "&nbsp;<a href='".$admin_file.".php?op=EditStory&amp;sid=".$row['sid']."'><img src='".evo_image('edit_small.png', $module_name)."' width='11' height='11' border='0' alt='"._EDIT."' title='"._EDIT."' /></a>\n";
        $the_icons .= "&nbsp;<a href='".$admin_file.".php?op=RemoveStory&amp;sid=".$row['sid']."'><img src='".evo_image('delete_small.png', $module_name)."' width='11' height='11' border='0' alt='"._DELETE."' title='"._DELETE."' /></a>\n";
    }
    if ($row['catid'] != 0) {
        $catinfo = $db->sql_ufetchrow("SELECT `title` FROM `"._STORIES_CATEGORIES_TABLE."` WHERE catid='".$row['catid']."'");
        if (strlen($catinfo['title']) > 25) {
            $result['cattitle'] = substr($catinfo['title'], 0, 25) . '&nbsp;...';
        } else {
            $result['cattitle'] = $catinfo['title'];
        }
        $morelink .= _NE_CATEGORY.":&nbsp;<a href='modules.php?name=".$module_name."&amp;op=categories&amp;mode=newindex&amp;catid=".$row['catid']."'>".EvoKernel_HtmlEntities($result['cattitle'])."</a>&nbsp;|&nbsp;";
    }
    $morelink .= "<img src='".evo_image('hits.png', $module_name)."' width='11' height='11' border='0' title='"._READS." ".$row['counter']."' alt='' />&nbsp;".$row['counter'];
    if ($acomm['allowed'] && !$result['acomm']) {
        $morelink .= "&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=article&amp;sid=".$row['sid'].$display."'><img src='".evo_image('comments.png', $module_name)."' border='0' width='11' height='11' title='"._COMMENTS."' alt='' />&nbsp;".$row['comments']."</a>\n";
    }
    $morelink .= $the_icons;
    $morelink .= $the_image;
    $result['morelink'] = $morelink;
    return $result;
}

?>