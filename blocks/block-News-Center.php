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

global $db, $evoconfig, $currentlang, $userinfo, $plus_minus_images, $admin_file, $_GETVAR;

$module_name = 'News';

// Makes no sense to cache data

$actualtime = actualTime();

$blockop         = $_GETVAR->get('blockop', '_REQUEST', 'string');
$blockmin        = $_GETVAR->get('blockmin', '_REQUEST', 'int');
$blockmax        = $_GETVAR->get('blockmax', '_REQUEST', 'int');
$blockcontent = '';

if (!defined('getTopics')) {
    include_once(NUKE_MODULES_DIR . $module_name . '/includes/nsnne_func.php');
}

$blockconfig = ne_get_configs();

if($blockconfig['readmore'] == 1) {
    $blockcontent .= "<script type='text/javascript'>\n";
    $blockcontent .= "<!-- Begin\n";
    $blockcontent .= "function NewsReadWindow(mypage, myname, w, h, scroll) {\n";
    $blockcontent .= "var winl = (screen.width - w) / 2;\n";
    $blockcontent .= "var wint = (screen.height - h) / 2;\n";
    $blockcontent .= "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+''\n";
    $blockcontent .= "win = window.open(mypage, myname, winprops)\n";
    $blockcontent .= "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
    $blockcontent .= "}\n";
    $blockcontent .= "//  End -->\n";
    $blockcontent .= "</script>\n";
}

if($blockconfig['homenumber'] == 0) {
    if (isset($userinfo['storynum'])) {
        $storynum = $userinfo['storynum'];
    } else {
        $storynum = $evoconfig['storyhome'];
    }
} else {
    $storynum = $blockconfig['homenumber'];
}
if (!isset($blockmin)) { $blockmin = 0; }
if (!isset($blockmax)) { $blockmax = $blockmin + $storynum; }

if ($evoconfig['multilingual'] == 1) {
    $querylang = "WHERE (alanguage='$currentlang' OR alanguage='') AND ihome='0'";
} else {
    $querylang = "WHERE ihome='0'";
}

if($blockconfig['hometopic'] > 0 && defined('HOME_FILE')) { // One Topic on Home
    if(empty($querylang)) {
        $querylang = "WHERE topic='".$blockconfig['hometopic']."'";
    } else {
        $querylang .= " AND topic='".$blockconfig['hometopic']."'";
    }
}
$querylang = (!isset($querylang) || empty($querylang)) ? 'WHERE time <= "'.$actualtime.'"' : $querylang . ' AND time <= "'.$actualtime.'"';
$totalarticles = $db->sql_ufetchrow("SELECT COUNT(*) AS numrows FROM "._STORIES_TABLE." $querylang");
$result = $db->sql_query("SELECT * FROM "._STORIES_TABLE." $querylang ORDER BY sid DESC LIMIT $blockmin,$storynum");
$a = 0;
while ($artinfo = $db->sql_fetchrow($result)) {
    $news_collapse = FALSE;
    $content = '';
    $morelink = '';
    $morelinkbtn = '';
    $datetime = formatTimeStamp($artinfo['time'], '', 1);
    $artinfo['sid'] = intval($artinfo['sid']);
    $artinfo['aid'] = stripslashes($artinfo['aid']);
    $artinfo['title'] = check_words(stripslashes(check_html($artinfo['title'], 'nohtml')));
    $artinfo['topic'] = intval($artinfo['topic']);
    $artinfo['counter'] = intval($artinfo['counter']);
    $artinfo['informant'] = stripslashes($artinfo['informant']);
    $artinfo['hometext'] = check_words(set_smilies(decode_bbcode(stripslashes($artinfo['hometext']), 1, true)));
    $artinfo['hometext'] = evo_img_tag_to_resize($artinfo['hometext']);
    $artinfo['notes'] = check_words(set_smilies(decode_bbcode(stripslashes($artinfo['notes']), 1, true)));
    $artinfo['topic'] = intval($artinfo['topic']);
    $sid = $artinfo['sid'];
    if($artinfo['writes'] == 1) {
       $informantwrites = 1;
    } else {
       $informantwrites = 0;
    }
    if($blockconfig['texttype'] == 0) {
        $introcount = strlen($artinfo['hometext']);
        $fullcount = strlen($artinfo['bodytext']);
    } else {
        $introcount = strlen(strip_tags($artinfo['hometext'], "<br />"));
        $fullcount = strlen($artinfo['bodytext']);
    }
    if (!empty($artinfo['notes'])) {
        $notes = "<br /><br /><strong>".$lang_block['BLOCK_NEWS_NOTE']."</strong>&nbsp;<em>".$artinfo['notes']."</em>\n";
    } else {
        $notes = '';
    }
    $totalcount = $introcount + $fullcount;
    $r_options = '';
    if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; } else { $r_options .= "&amp;mode=thread"; }
    if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; } else { $r_options .= "&amp;order=0"; }
    if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; } else { $r_options .= "&amp;thold=0"; }
    $read_link = "<a href=\"modules.php?name=$module_name&amp;op=read_article&amp;sid=".$artinfo['sid']."$r_options\" target=\"_blank\" onclick=\"NewsReadWindow(this.href,'ReadArticle','600','400','yes');return false;\">";
    $story_link = "<a href=\"modules.php?name=$module_name&amp;op=article&amp;sid=".$artinfo['sid']."$r_options\">";
    if($blockconfig['texttype'] == 0) {
        if ($fullcount > 0 OR $artinfo['comments'] > 0 OR $artinfo['acomm'] == 1) {
             if($blockconfig['readmore'] == 1) {
                $morelinkbtn .= "<p style=\"text-align:right;\">$read_link<strong>".$lang_block['BLOCK_NEWS_READMORE']."</strong></a></p>";
            } else {
                $morelinkbtn .= "<p style=\"text-align:right;\">$story_link<strong>".$lang_block['BLOCK_NEWS_READMORE']."</strong></a></p>";
            }
        } else { $morelinkbtn .= ''; }
    } else {
        if ($introcount > 255 OR $fullcount > 0 OR $artinfo['comments'] > 0 OR $artinfo['acomm'] == 1) {
            if($blockconfig['readmore'] == 1) {
                $morelinkbtn .= "<p style=\"text-align:right;\">$read_link<strong>".$lang_block['BLOCK_NEWS_READMORE']."</strong></a></p>";
            } else {
                $morelinkbtn .= "<p style=\"text-align:right;\">$story_link<strong>".$lang_block['BLOCK_NEWS_READMORE']."</strong></a></p>";
            }
        } else { $morelinkbtn .= ''; }
        if ($introcount > 255) {
            $artinfo['hometext'] = strip_tags($artinfo['hometext'], "<br />");
            $artinfo['hometext'] = substr($artinfo['hometext'], 0, 255);
        }
    }
    getTopics($artinfo['sid']);
    global $topicname, $topicimage, $topictext;
    if($artinfo['ticon'] == 1) {
        $topicimage = '';
    }
    if ($artinfo['ratings'] > 0) {
        $r_image = round($artinfo['score'] / $artinfo['ratings']);
        if ($r_image == 1) {
                $the_image = "<img src='".evo_image('stars-1.png', $module_name)."' title='".$lang_block['BLOCK_NEWS_COUNTRATINGS']." ".$artinfo['ratings']."' alt='' border='0' /> |";
        } elseif ($r_image == 2) {
                $the_image = "<img src='".evo_image('stars-2.png', $module_name)."' title='".$lang_block['BLOCK_NEWS_COUNTRATINGS']." ".$artinfo['ratings']."' alt='' border='0' /> |";
        } elseif ($r_image == 3) {
                $the_image = "<img src='".evo_image('stars-3.png', $module_name)."' title='".$lang_block['BLOCK_NEWS_COUNTRATINGS']." ".$artinfo['ratings']."' alt='' border='0' /> |";
        } elseif ($r_image == 4) {
                $the_image = "<img src='".evo_image('stars-4.png', $module_name)."' title='".$lang_block['BLOCK_NEWS_COUNTRATINGS']." ".$artinfo['ratings']."' alt='' border='0' /> |";
        } elseif ($r_image == 5) {
                $the_image = "<img src='".evo_image('stars-5.png', $module_name)."' title='".$lang_block['BLOCK_NEWS_COUNTRATINGS']." ".$artinfo['ratings']."' alt='' border='0' /> |";
        }
    } else {
        $the_image = '';
    }
    if(($artinfo['informant'] == '') || ($artinfo['informant'] == $lang_block['BLOCK_NEWS_ANONYMOUS'])) {
        $informant[0] = $lang_block['BLOCK_NEWS_ANONYM'];
        $informant[1] = $lang_block['BLOCK_NEWS_ANONYM'];
    } else {
        $inf = array();
        $inf[0] = $artinfo['informant'];
        $inf[1] = UsernameColor($artinfo['informant']);
        $informant = $inf;
    }
    $the_icons = '';
    if (is_user()) {
        $the_icons .= "&nbsp;|&nbsp;<a href='modules.php?name=$module_name&amp;op=print&amp;sid=".$artinfo['sid']."' target='_blank'><img src='".evo_image('print_small.png', $module_name)."' width='11' height='11' border='0' alt='".$lang_block['BLOCK_NEWS_PRINTER']."' title='".$lang_block['BLOCK_NEWS_PRINTER']."' /></a>&nbsp;<a href='modules.php?name=$module_name&amp;op=friend&amp;op=FriendSend&amp;sid=".$artinfo['sid']."'><img src='".evo_image('friend_small.png', $module_name)."' width='11' height='11' border='0' alt='".$lang_block['BLOCK_NEWS_FRIEND']."' title='".$lang_block['BLOCK_NEWS_FRIEND']."' /></a>\n";
    }
    if (is_mod_admin($module_name)) {
        $the_icons .= "&nbsp;|&nbsp;<img src=\"".evo_image('approved.png', $module_name)."\" width=\"11\" height=\"11\" border=\"0\" title=\"".$lang_block['BLOCK_NEWS_APPROVED']." ".$artinfo['aid']."\" alt=\"\" />&nbsp;|&nbsp;<a href=\"".$admin_file.".php?op=EditStory&amp;sid=".$artinfo['sid']."\"><img src=\"".evo_image('edit_small.png', $module_name)."\" width=\"11\" height=\"11\" border=\"0\" alt=\"".$lang_block['BLOCK_NEWS_EDIT']."\" title=\"".$lang_block['BLOCK_NEWS_EDIT']."\" /></a>&nbsp;<a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=".$artinfo['sid']."\"><img src=\"".evo_image('delete_small.png', $module_name)."\" width=\"11\" height=\"11\" border=\"0\" alt=\"".$lang_block['BLOCK_NEWS_DELETE']."\" title=\"".$lang_block['BLOCK_NEWS_DELETE']."\" /></a>\n";
    }
    if ($artinfo['catid'] != 0) {
        $result3 = $db->sql_query("SELECT title FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='".$artinfo['catid']."'");
        $catinfo = $db->sql_fetchrow($result3);
        $db->sql_freeresult($result3);
        if (strlen($catinfo['title']) > 25) {
            $catinfo['title'] = substr(check_words($catinfo['title']), 0, 25) . ' ...';
        }
        $morelink .= $lang_block['BLOCK_NEWS_CATEGORY'].":&nbsp;<a href='modules.php?name=$module_name&amp;op=categories&amp;op=newindex&amp;catid=".$artinfo['catid']."'>".check_words($catinfo['title'])."</a>&nbsp;|";
    }
    $morelink .= $the_image;
    if(!$informantwrites) {
        $morelink .= "&nbsp;<img src=\"".evo_image('date.png', $module_name)."\" width=\"11\" height=\"11\" border=\"0\" title=\"".$lang_block['BLOCK_NEWS_POSTEDBY']."&nbsp;".(@is_array($informant) ? $informant[0] : $informant)." ".$lang_block['BLOCK_NEWS_ON']."&nbsp;".$datetime."\" alt=\"\" />";
    } else {
        $morelink .= "&nbsp;<img src=\"".evo_image('date.png', $module_name)."\" width=\"11\" height=\"11\" border=\"0\" title=\"".$lang_block['BLOCK_NEWS_POSTED']."&nbsp;".$lang_block['BLOCK_NEWS_ON']."&nbsp;".$datetime."\" alt=\"\" />";
    }    
    $morelink .= "|&nbsp;<img src=\"".evo_image('hits.png', $module_name)."\" width=\"11\" height=\"11\" border=\"0\" title=\"".$lang_block['BLOCK_NEWS_READS']."&nbsp;".$artinfo['counter']."\" alt=\"\" />&nbsp;".$artinfo['counter'];
    $morelink .= "|&nbsp;<a href=\"modules.php?name=$module_name&amp;op=article&amp;sid=".$artinfo['sid']."&amp;order=0&amp;thold=0\"><img src=\"".evo_image('comments.png', $module_name)."\" border=\"0\" width=\"11\" height=\"11\" title=\"".$lang_block['BLOCK_NEWS_COMMENTS']."\" alt=\"\" />&nbsp;".$artinfo['comments']."</a>";
    $morelink .= $the_icons;

    $content .= $artinfo['hometext'].$notes;
    // Here we start News-Output
    //$info = $lang_block['BLOCK_NEWS_WRITES']."<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$informant[0]."'>&nbsp;".$informant[1]."</a>&nbsp;"._ON.":&nbsp;".$datetime;
    if($evoconfig['collapse']) {
        if (!$evoconfig['collapsetype']) {
            if ($news_collapse) {
                $image = $plus_minus_images['minus'];
                $name = 'minus';
            } else {
                $image = $plus_minus_images['plus'];
                $name = 'plus';
            }
            $artinfo['title'] = $artinfo['title'] . "&nbsp;&nbsp;&nbsp;<img src=\"".$image."\" class=\"showstate\" name=\"".$name."\" width=\"9\" height=\"9\" onclick=\"expandcontent(this, 'newscenter".$sid."')\" alt=\"\" style=\"cursor: pointer;\" />";
        } else {
            $artinfo['title'] = "<a href=\"javascript:expandcontent(this, 'newscenter".$sid."')\">".$artinfo['title']."</a>";
        }
        $style = '';
        if (!$news_collapse) {
            $newsstyle = 'style="display: none;"';
        }
        if(!empty($topicimage)) {
            $t_image = @evo_image(@basename($topicimage), 'Topics');
            $topic_img = "<div style=\"text-align:right;\"><a href=\"modules.php?name=News&amp;new_topic=".$artinfo['topic']."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" title=\"$topictext\"/></a></div>";
        } else {
            $topic_img = '';
        }
        //$blockcontent .= $topic_img;
        $blockcontent .= "<div style=\"text-align:left; float:left; margin-left:50px;\"><strong>".$artinfo['title']."</strong></div>\n";
        $blockcontent .= "<div style=\"text-align:right; margin-right:50px;\">".$morelink."</div>\n";
        $blockcontent .= "<div style=\"display: block; margin-right:50px; margin-left:50px; margin-top:10px;\"><div id='newscenter".$sid."' class='switchcontent' $newsstyle>".$topic_img.$content.$morelinkbtn."</div></div>";
        $blockcontent .= "<hr/>";
    }
        // End News Output
}
$db->sql_freeresult($result);
$articlepagesint = ($storynum > 0 ) ? ($totalarticles['numrows'] / $storynum) : 0;
$articlepageremain = ($storynum > 0) ? ($totalarticles['numrows'] % $storynum) : 0;
if ($articlepageremain != 0) {
    $articlepages = ceil($articlepagesint);
    if ($totalarticles['numrows'] < $storynum) { $articlepageremain = 0; }
} else {
    $articlepages = $articlepagesint;
}
if ($articlepages!=1 && $articlepages!=0) {
    $blockcontent .= "<br />\n";
    $counter = 1;
    $currentpage = ($storynum > 0) ? ($blockmax / $storynum) : 0;
    $blockcontent .= "<div style='text-align: center;'>\n<form action='modules.php?name=$module_name' method='post'>\n";
    $blockcontent .= "<span>\n<strong>".$lang_block['BLOCK_NEWS_SELECT_PAGE']." </strong><select name='blockmin' onchange='top.location.href=this.options[this.selectedIndex].value'>\n";
    while ($counter <= $articlepages ) {
        $cpage = $counter;
        $blockmintemp = ($storynum * $counter) - $storynum;
        if ($counter == $currentpage) {
            $blockcontent .= "<option selected='selected'>$counter</option>\n";
        } else {
              $blockcontent .= "<option value='index.php?blockmin=$blockmintemp'>$counter</option>\n";
        }
        $counter++;
    }
    $blockcontent .= "</select><strong> ".$lang_block['BLOCK_NEWS_OF']." $articlepages ".$lang_block['BLOCK_NEWS_OF_PAGES'].".</strong></span>\n";
    $blockcontent .= "</form>\n";
    $blockcontent .= "</div>\n";
}
$blockcontent .= "<div style='text-align: center;'>[ \n";
$blockcontent .= "<a href='modules.php?name=News'>".$lang_block['BLOCK_NEWS_MORENEWS']."</a> |\n";
$blockcontent .= "<a href='modules.php?name=Topics'>".$lang_block['BLOCK_NEWS_TOPICS_ALL']."</a> |\n";
$blockcontent .= "<a href='rss.php?feed=news'><img src='".evo_image('feed_20_news.png', 'powered')."' title='RSS/XML' alt='RSS/XML' border='0' /></a>\n";
$blockcontent .= "]<br /><br /></div>\n";

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    $content .= $blockcontent;
}
$content .= "</div>\n";

?>