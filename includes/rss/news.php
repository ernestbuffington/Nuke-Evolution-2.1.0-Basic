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

global $db, $evoconfig, $_GETVAR, $template;

$num = ($_GETVAR->get('num', '_REQUEST') ) ? 'LIMIT '.$num : 'LIMIT 10';

$gmtdiff = date("O", time());
$gmtstr = substr($gmtdiff, 0, 3) . ":" . substr($gmtdiff, 3, 9);

define('TIME_ZONE', $gmtstr);

include_once(NUKE_CLASSES_DIR . 'class.feedcreator.php');

//define channel
$rss = new UniversalFeedCreator();
$rss->useCached();
$rss->encoding      ='UTF-8';
$rss->title         =EVO_SERVER_SITENAME;
$rss->descriptionHtmlSyndicated = true;
$rss->description   =$evoconfig['slogan'];
$rss->link          =EVO_SERVER_URL . '/';
$rss->syndicationURL=EVO_SERVER_URL . "/rss.php?feed=news";
$rss->image->url    =EVO_SERVER_URL . '/images/evo/minilogo.gif';
$rss->image->title  =EVO_SERVER_SITENAME;
$rss->image->link   =EVO_SERVER_URL . '/';
$rss->image->width  ='88';
$rss->image->height ='31';

$result = $db->sql_query("SELECT s.aid, s.sid, t.topicname, s.informant, s.title, UNIX_TIMESTAMP(s.time) as time, s.hometext
                          FROM ("._STORIES_TABLE." s, "._TOPICS_TABLE." t)
                          WHERE s.topic = t.topicid
                          ORDER BY sid
                          DESC $num");

//channel items/entries
while ($row = $db->sql_fetchrow($result)) {
    if ( !empty($row['informant'] )) {
        $informant_email = get_user_field('user_email', $row['informant'], true);
        $informant       = ( !empty($informant_email) ) ? $informant_email . ' ('.$row['informant'].')' : $evoconfig['adminmail'] . ' (Webmaster)';
    } else {
        $informant       = $evoconfig['adminmail'] . ' (Webmaster)';
    }
    $desc           = set_smilies(decode_bbcode(stripslashes($row['hometext']), 0, true), EVO_SERVER_URL);
    $item           = new FeedItem();
    $item->title    = check_words($row['title']);
    $item->link     = EVO_SERVER_URL."/modules.php?name=News&amp;op=article&amp;sid=".$row['sid'];
    $item->source = EVO_SERVER_URL;
    $item->description = check_words($desc);
    $item->creator  = $informant;
    $item->updated  = $row['time'];
    $item->descriptionTruncSize = 500;
    $item->descriptionHtmlSyndicated = true;
    $item->guid     = $row['sid'].'@'.EVO_SERVER_URL;
    $item->date     = $row['time'];
    $rss->addItem($item);
}

$rss->outputFeed('RSS2.0');

?>