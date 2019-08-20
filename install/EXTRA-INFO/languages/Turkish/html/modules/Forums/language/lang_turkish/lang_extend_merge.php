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

if(!defined('NUKE_EVO')) { die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR'); }

global $lang_extend_admin;

//
// admin part
//
if ( $lang_extend_admin ) {
    $lang['Lang_extend_merge']      = 'Simply Merge Threads';
}
$lang['Merge_confirm_process']      = 'Are you sure you want to merge <br />"<strong>%s</strong>"<br />to<br />"<strong>%s</strong>"';
$lang['Merge_from_not_authorized']  = 'You are not authorized to moderate topics coming from the forum of the topic to merge';
$lang['Merge_from_not_found']       = 'The topic to merge hasn\'t been found';
$lang['Merge_poll_from']            = 'There is a poll on the topic to merge. It will be copied to the destination topic';
$lang['Merge_poll_from_and_to']     = 'The destination topic already has got a poll. The poll of the topic to merge will be deleted';
$lang['Merge_title']                = 'New topic title';
$lang['Merge_title_explain']        = 'This will be the new title of the final topic. Let it blank if you want the system to use the title of the destination topic';
$lang['Merge_to_not_authorized']    =  'You are not authorized to moderate topics coming from the forum of the destination topic';
$lang['Merge_to_not_found']         = 'The destination topic hasn\'t been found';
$lang['Merge_topic_done']           = 'The topics have been successfully merged.';
$lang['Merge_topic_from']           = 'Topic to merge';
$lang['Merge_topic_from_explain']   = 'This topic will be merged to the other topic. You can input the topic id, the url of the topic, or the url of a post in this topic';
$lang['Merge_topic_to']             = 'Destination topic';
$lang['Merge_topic_to_explain']     = 'This topic will get all the posts of the precedent topic. You can input the topic id, the url of the topic, or the url of a post in this topic';
$lang['Merge_topics']               = 'Merge topics';
$lang['Merge_topics_equals']        = 'You can\'t merge a topic with itself';
$lang['Refresh']                    = 'Refresh';

?>