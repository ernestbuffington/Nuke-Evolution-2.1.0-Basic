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

if (!defined('MODULE_FILE') && !defined('NEWS_INDEX_FILE')) {
   die('You can\'t access this file directly...');
}

function ModuleNewsAssociatesTopics($topicid) {
    global $db, $module_name;
    static $topics;

    if (is_array($topics)) {
        if (isset($topics[$topicid]['topictext'])) {
            return $topics[$topicid];
        }
    } else {
        $topics = array();
    }
    $assoc = $db->sql_ufetchrow('SELECT `topicimage`, `topictext` FROM `'._TOPICS_TABLE.'` WHERE `topicid`="'.$topicid.'"');
    $topics[$topicid]['topicimage'] = EvoKernel_HtmlEntities($assoc['topicimage']);
    $topics[$topicid]['topictext']  = EvoKernel_HtmlEntities(check_html($assoc['topictext'], 'nohtml'));
    return $topics[$topicid];
}

if (isset($sid) && ($sid > 0)) {
    $associated = $db->sql_ufetchrow('SELECT `associated` FROM `'._STORIES_TABLE.'` WHERE `sid`="'.$sid.'"');

    if (!empty($associated)) {
        $associatedTitle = _ASSOTOPIC;
        $associatedBox   = '';
        $asso_t = explode('-',$associated['associated']);
        $asso_c = count($asso_t);
        for ($i=0; $i < $asso_c; $i++) {
            if (!empty($asso_t[$i])) {
                $topicid = intval($asso_t[$i]);
                $topics = ModuleNewsAssociatesTopics($topicid);
                $associatedBox .= "<div style='float:left; width:100%;'><a href='modules.php?name=".$module_name."&amp;new_topic=".$topicid."'><span style='vertical-align:middle;'><img src='".$topics['topicimage']."' border='0' hspace='10' alt='".$topics['topictext']."' title='".$topics['topictext']."' /></span>&nbsp;".$topics['topictext']."</a></div><br />\n";
            }
        }
    }
    $mostreadBox      = "<br /><br /><div style='text-align:center; font-weight:bold; width:100%;'>"._MOSTREAD.":<br /><span style='font-style:italic;'>".$artinfo['topics']['topictext']."</span></div>";
    $mostReaddb       = $db->sql_ufetchrow('SELECT `sid`, `title` FROM `'._STORIES_TABLE.'` WHERE `topic`="'.$artinfo['topic'].'" '.$querylang.' order by `counter` desc limit 0,1');
    $mostStoriesTitle = EvoKernel_HtmlEntities(check_words(check_html($mostReaddb['title'], 'nohtml')));
    $mostreadBox     .= "<br /><div style='text-align:center; width:100%;'>\n";
    $mostreadBox     .= "<a href='modules.php?name=".$module_name."&amp;op=article&amp;sid=".$mostReaddb['sid']."'>".$mostStoriesTitle."</a>\n";
    $mostreadBox     .= "</div><br />\n";
    $associatedBox   .= $mostreadBox;
    themesidebox($associatedTitle, $associatedBox, 'ModuleNewsAssociates');
}

?>
