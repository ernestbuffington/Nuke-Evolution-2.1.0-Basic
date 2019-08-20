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
$cat = ($_GETVAR->get('cat', '_REQUEST', 'int') ) ? $cat : '';

$gmtdiff = date("O", time());
$gmtstr = substr($gmtdiff, 0, 3) . ":" . substr($gmtdiff, 3, 9);

define('TIME_ZONE', $gmtstr);

include_once(NUKE_CLASSES_DIR . 'class.feedcreator.php');

//define channel
$rss = new UniversalFeedCreator();
$rss->useCached();
$rss->encoding      ='UTF-8';
$rss->descriptionHtmlSyndicated = true;
$rss->title         =EVO_SERVER_SITENAME;
$rss->description   =$evoconfig['slogan'];
$rss->link          =EVO_SERVER_URL . '/';
$rss->syndicationURL=EVO_SERVER_URL . '/rss.php?feed=weblinks';
$rss->image->url    =EVO_SERVER_URL . '/images/evo/minilogo.gif';
$rss->image->title  =EVO_SERVER_SITENAME;
$rss->image->link   =EVO_SERVER_URL . '/';
$rss->image->width  ='88';
$rss->image->height ='31';

if (!empty($cat)) {
    $catid = $db->sql_fetchrow($db->sql_query("SELECT catid FROM "._WEBLINKS_CATEGORIES_TABLE." WHERE title LIKE '%$cat%' LIMIT 1"));
    if (empty($catid)) {
        $result = $db->sql_query("SELECT lid, title, description, date, submitter FROM "._WEBLINKS_LINKS_TABLE." ORDER BY lid DESC ".$num);
    } else {
        $catid = intval($catid);
        $result = $db->sql_query("SELECT lid, title, description, date, submitter FROM "._WEBLINKS_LINKS_TABLE." WHERE catid='$catid' ORDER BY lid DESC ".$num);
    }
} else {
    $result = $db->sql_query("SELECT lid, title, description, date, submitter FROM "._WEBLINKS_LINKS_TABLE." ORDER BY lid DESC ".$num);
}

//channel items/entries
while ($row = $db->sql_fetchrow($result)) {
    if ( !empty($row['submitter'] )) {
        $informant_email = get_user_field('user_email', $row['submitter'], true);
        $informant       = ( !empty($informant_email) ) ? $informant_email . ' ('.$row['submitter'].')' : $evoconfig['adminmail'] . ' (Webmaster)';
    } else {
        $informant       = $evoconfig['adminmail'] . ' (Webmaster)';
    }
    $title2 = preg_replace('# #si', '_', check_words($row['title']));
    $item = new FeedItem();
    $item->title    = set_smilies(decode_bbcode(check_words(stripslashes($row['title'])), 0, true), EVO_SERVER_URL);
    $item->link     = EVO_SERVER_URL."/modules.php?name=Web_Links&amp;op=viewlinkdetails&amp;lid=".$row['lid']."&amp;ttitle=".$title2;
    $item->updated  = $row['date'];
    $item->source = EVO_SERVER_URL;
    $item->description = set_smilies(decode_bbcode(check_words(stripslashes($row['description'])), 0, true), EVO_SERVER_URL);
    $item->creator  = $informant;
    $item->descriptionTruncSize = 500;
    $item->descriptionHtmlSyndicated = true;
    $item->guid     = $row['lid'].'@'.EVO_SERVER_URL;
    $item->date     = $row['date'];
    $rss->addItem($item);
}

$rss->outputFeed('RSS2.0');

?>