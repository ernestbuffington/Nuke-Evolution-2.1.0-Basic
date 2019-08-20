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


// Item Delimiter
$item_delim = "-";
$newpagetitle = '';

global $name, $admin_file, $db, $cookie, $evoconfig, $pagetitle, $module_title, $simple_header;

// Forums
if ($name == 'Forums') {
    global $p, $t, $forum, $f;
    $tname = (!empty($pagetitle) ? $pagetitle : $module_title);
    $newpagetitle = "$item_delim $tname";
    if (isset($p) && is_numeric($p)) {
        $p = (int)$p;
        list($title, $post) = $db->sql_ufetchrow("SELECT `post_subject`, `post_id` FROM `".POSTS_TEXT_TABLE."` WHERE `post_id`='$p'", SQL_NUM);
        $newpagetitle = "$item_delim Post $post $item_delim $title";
    } else if (isset($t) && is_numeric($t)) {
        $newpagetitle = "$item_delim $tname";
    } else if (isset($f) && is_numeric($f)) {
        $newpagetitle = "$item_delim $tname";
    }
} elseif ($name == 'News') {// News
    global $file, $sid, $new_topic;
    $tname =  (!empty($pagetitle) ? $pagetitle : $module_title);
    $newpagetitle= "$item_delim $tname";
    if (isset($new_topic) && is_numeric($new_topic)) {
        list($top) = $db->sql_ufetchrow("SELECT `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='$new_topic'", SQL_NUM);
        $newpagetitle= "$item_delim $tname $top";
    } else if ($file == 'article' && isset($sid) && is_numeric($sid)){
        list($art, $top) = $db->sql_ufetchrow("SELECT `title`, `topic` FROM `"._STORIES_TABLE."` WHERE `sid`='$sid'", SQL_NUM);
        if ($top) {
            list($top) = $db->sql_ufetchrow("SELECT `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='$top'", SQL_NUM);
            $newpagetitle= "$item_delim $name $top $item_delim $art";
        } else {
            $newpagetitle= "$item_delim $tname $art";
        }
    }
} elseif ($name == 'Topics') { // Topics
      $newpagetitle = $item_delim.' '._ACTIVETOPICS;
} elseif ($name == 'Web_Links') { // Web Links
    global $op, $cid, $lid;
    $tname = $module_title;
    $newpagetitle = "$item_delim $tname";
    if($op == 'viewlink' && is_numeric($cid)) {
        list($cat, $parent) = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `cid`='$cid'", SQL_NUM);
        if ($parent == 0) {
            $newpagetitle = "$item_delim $tname $item_delim $cat";
        } else {
            list($parent) = $db->sql_ufetchrow("SELECT `title` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `cid`='$parent'", SQL_NUM);
            $newpagetitle = "$item_delim $tname $item_delim $parent $item_delim $cat";
        }
    }
} elseif ($name == 'Downloads') { // Downloads
    global $op, $cid, $did;
    $tname =  (!empty($pagetitle) ? $pagetitle : $module_title);
    $newpagetitle = "$item_delim $tname";
    if(isset($cid) && is_numeric($cid)) {
        list($cat, $parent) = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='$cid'", SQL_NUM);
        if ($parent == 0) {
            $newpagetitle = "$item_delim $tname $item_delim $cat";
        } else {
            list($parent) = $db->sql_ufetchrow("SELECT `title` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='$parent'", SQL_NUM);
            $newpagetitle = "$item_delim $tname $item_delim $parent $item_delim $cat";
        }
    }
} elseif ($name == 'Content') { // Content
    global $pa, $cid, $pid;
    $tname =  (!empty($pagetitle) ? $pagetitle : $module_title);
    $newpagetitle = "$item_delim $tname";
    if ($pa == 'list_pages_categories' && is_numeric($cid)) {
        list($cat) = $db->sql_ufetchrow("SELECT `title` FROM `"._PAGES_CATEGORIES_TABLE."` WHERE `cid`='$cid'", SQL_NUM);
        $newpagetitle = "$item_delim $tname $item_delim $cat";
    } else if ($pa == 'showpage' && is_numeric($pid)) {
        list($page, $cid) = $db->sql_ufetchrow("SELECT `title`, `cid` FROM `"._PAGES_TABLE."` WHERE `pid`='$pid'", SQL_NUM);
        list($cat) = $db->sql_ufetchrow("SELECT `title` FROM `"._PAGES_CATEGORIES_TABLE."` WHERE `cid`='$cid'", SQL_NUM);
        $newpagetitle = "$item_delim $tname $item_delim $cat $item_delim $page";
    }
} elseif ($name == 'Reviews') { // Reviews
    global $rop, $rid;
    $tname =  (!empty($pagetitle) ? $pagetitle : $module_title);
    $newpagetitle = "$item_delim $tname";
    if ($rop == "showcontent" && is_numeric($rid)) {
        list($rev) = $db->sql_ufetchrow("SELECT `title` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$rid'", SQL_NUM);
        $newpagetitle = "$item_delim $tname $item_delim $rev";
    }
} elseif ($name == 'Stories_Archive') { // Stories Archive
    global $sa, $year, $month_l;
    $tname =  (!empty($pagetitle) ? $pagetitle : $module_title);
    $newpagetitle = "$item_delim $tname";
    if($sa == 'show_month') {
        $newpagetitle = "$item_delim $tname $item_delim $month_l, $year";
    }
} elseif ($name == 'Profile') { // Profile
    global $mode, $u, $userinfo;
    $tname =  (!empty($pagetitle) ? $pagetitle : $module_title);
    $newpagetitle = "$item_delim $tname";
    if ($mode == 'viewprofile'  && is_numeric($u)) {
        $username = get_user_field('username', $u);
        $sec = @htmlentities(_VIEWING).' '.$username.'\'s '._PROFILE;
        $newpagetitle = "$item_delim $tname $item_delim $sec";
    } else if ($mode == 'editprofile') {
        $sec = @htmlentities(_EDIT).' '.$userinfo['username'].'\'s '._PROFILE;
        $newpagetitle = "$item_delim $tname $item_delim $sec";
    }
}

// Catch all for anything we don't have custom coding for
if (empty($newpagetitle)) {
    if(isset($pagetitle)) {
        $newpagetitle = @htmlentities($pagetitle);
    } else {
        $newpagetitle = @htmlentities("$item_delim $module_title");
    }
} else {
    $newpagetitle = @htmlentities($newpagetitle);
}

//$newpagetitle = check_html($newpagetitle, 'nohtml');


// Admin Pages
if (defined('ADMIN_FILE')) {
    $newpagetitle = @html_entity_decode($item_delim).' '.@html_entity_decode(_ADMINISTRATION);
}
// If we're on the main page let's use our site slogan
if (defined('HOME_FILE')) {
    $newpagetitle = @html_entity_decode($item_delim)." ".@html_entity_decode($evoconfig['slogan']);
}

if (!defined('LOADER') || $simple_header) {
    // We're Done! Place the Title on the page
    echo "<title>".@html_entity_decode(EVO_SERVER_SITENAME)." ".@html_entity_decode($newpagetitle)."</title>\n";
} else {
    echo @html_entity_decode(EVO_SERVER_SITENAME)." ".@html_entity_decode($newpagetitle);
}

?>