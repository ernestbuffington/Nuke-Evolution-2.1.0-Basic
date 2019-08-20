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

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

$instory = '';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

global $admin, $db, $module_name, $evoconfig, $admin_file, $currentlang, $_GETVAR;

function SearchHeading() {
    global $module_name;
    title(_SEARCH, $module_name, 'search-logo.png');
}


if ($evoconfig['multilingual'] == 1) {
    $queryalang = "AND (s.alanguage='$currentlang' OR s.alanguage='')"; /* stories */
    $queryrlang = "AND (rlanguage='$currentlang' OR rlanguage='')"; /* reviews */
} else {
    $queryalang = '';
    $queryrlang = '';
    $queryslang = '';
}

$query      = $_GETVAR->get('query', '_REQUEST');
$type       = $_GETVAR->get('type', '_REQUEST');
$category   = $_GETVAR->get('category', '_REQUEST', 'int');
$topic      = $_GETVAR->get('topic', '_REQUEST', 'int');
$days       = $_GETVAR->get('days', '_REQUEST', 'int');
$author     = $_GETVAR->get('author', '_REQUEST');
$op         = $_GETVAR->get('op', 'REQUEST');
$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max        = $_GETVAR->get('max', '_REQUEST', 'int');
$sid        = $_GETVAR->get('sid', '_REQUEST', 'int');


switch($op) {

    default:
        $offset = 10;
        if (!$max) $max = $min + $offset;
        $pagetitle = "- "._SEARCH."";
        include_once(NUKE_BASE_DIR.'header.php');

        SearchHeading();
        if ($topic > 0) {
            $row = $db->sql_ufetchrow("SELECT `topicimage`, `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='$topic'");
            $topicimage = stripslashes($row['topicimage']);
            $topictext = stripslashes(check_html($row['topictext'], "nohtml"));
        } else {
            $topictext = _ALLTOPICS;
            $topicimage = evo_image('AllTopics.png', 'topics');
        }
        $alltop = evo_image('AllTopics.png', 'topics');
        OpenTable();
        if ($type == 'users') {
            echo "<center><span class=\"title\"><strong>"._SEARCHUSERS."</strong></span></center><br />\n";
        } elseif ($type == 'comments' AND $sid) {
            $res = $db->sql_query("SELECT `title` FROM "._STORIES_TABLE." WHERE `sid`='$sid'");
            list($st_title) = $db->sql_fetchrow($res);
            $db->sql_freeresult($res);
            $st_title = stripslashes(check_html($st_title, "nohtml"));
            $instory = "AND sid='$sid'";
            echo "<center><span class=\"title\"><strong>"._SEARCHINSTORY." $st_title</strong></span></center><br />\n";
        } else {
            echo "<center><span class=\"title\"><strong>"._SEARCHIN." $topictext</strong></span></center><br />\n";
        }

        echo "<table width=\"100%\" border=\"0\"><tr><td>";
        if (($type == 'users')) {
            echo "<img src=\"$alltop\" align=\"right\" border=\"0\" alt=\"\" />";
        } else {
            echo "<img src=\"$topicimage\" align=\"right\" border=\"0\" alt=\"$topictext\" />";
        }
        echo "<form action=\"modules.php?name=$module_name\" method=\"post\">"
        ."<input size=\"25\" type=\"text\" name=\"query\" value=\"".$query."\" />&nbsp;&nbsp;"
        ."<input type=\"submit\" value=\""._SEARCH."\" /><br /><br />";
        if ($sid) {
            echo "<input type='hidden' name='sid' value='$sid' />";
        }
        echo "<!-- Topic Selection -->\n";
        $toplist = $db->sql_query("SELECT `topicid`, `topictext` FROM `"._TOPICS_TABLE."` ORDER BY `topictext`");
        echo "<select name=\"topic\">";
        echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        while($row2 = $db->sql_fetchrow($toplist)) {
            $topicid = intval($row2['topicid']);
            $topics = stripslashes(check_html($row2['topictext'], "nohtml"));
            if ($topicid == $topic) { $sel = 'selected="selected" '; } else { $sel = ''; }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
        }
        $db->sql_freeresult($toplist);
        echo "</select>\n";
        /* Category Selection */
        $category = intval($category);
        echo "&nbsp;<select name=\"category\">";
        echo "<option value=\"0\">"._ARTICLES."</option>\n";
        $result3 = $db->sql_query("SELECT `catid`, `title` FROM `"._STORIES_CATEGORIES_TABLE."` ORDER BY `title`");
        while ($row3 = $db->sql_fetchrow($result3)) {
            $catid = intval($row3['catid']);
            $title = stripslashes(check_html($row3['title'], "nohtml"));
            if ($catid == $category) { $sel = 'selected="selected" '; } else { $sel = ''; }
            echo "<option $sel value=\"$catid\">$title</option>\n";
        }
        $db->sql_freeresult($result3);
        echo "</select>\n";
        /* Authors Selection */
        $thing = $db->sql_query("SELECT `aid` FROM `"._AUTHOR_TABLE."` ORDER BY `aid`");
        echo "&nbsp;<select name=\"author\">";
        echo "<option value=\"\">"._ALLAUTHORS."</option>\n";
        while($row4 = $db->sql_fetchrow($thing)) {
            $authors = stripslashes($row4['aid']);
            if ($authors==$author) { $sel = 'selected="selected" '; } else { $sel = ''; }
            echo "<option value=\"$authors\" $sel>$authors</option>\n";
        }
        $db->sql_freeresult($thing);
        echo "</select>\n";
        /* Date Selection */
            ?>
            &nbsp;<select name="days">
                            <option <?php echo $days == 0 ? "selected=\"selected\" " : ""; ?> value="0"><?php echo _ALL ?></option>
                            <option <?php echo $days == 7 ? "selected=\"selected\" " : ""; ?> value="7">1 <?php echo _WEEK ?></option>
                            <option <?php echo $days == 14 ? "selected=\"selected\" " : ""; ?> value="14">2 <?php echo _WEEKS ?></option>
                            <option <?php echo $days == 30 ? "selected=\"selected\" " : ""; ?> value="30">1 <?php echo _MONTH ?></option>
                            <option <?php echo $days == 60 ? "selected=\"selected\" " : ""; ?> value="60">2 <?php echo _MONTHS ?></option>
                            <option <?php echo $days == 90 ? "selected=\"selected\" " : ""; ?> value="90">3 <?php echo _MONTHS ?></option>
                    </select><br />
            <?php
            $sel1 = $sel2 = $sel3 = $sel4 = "";
            if (($type == 'stories') || (empty($type))) {
                $sel1 = 'checked="checked"';
            } elseif ($type == 'comments') {
                $sel2 = 'checked="checked"';
            } elseif ($type == 'users') {
                $sel3 = 'checked="checked"';
            }
            echo _SEARCHON;
            echo "<input type=\"radio\" name=\"type\" value=\"stories\" $sel1 /> "._SSTORIES;
            if ($evoconfig['articlecomm'] == 1) {
                echo "<input type=\"radio\" name=\"type\" value=\"comments\" $sel2 /> "._SCOMMENTS;
            }
            echo "<input type=\"radio\" name=\"type\" value=\"users\" $sel3 /> "._SUSERS;
            echo "</form></td></tr></table>";
            if ($type == 'stories' || !$type) {

                if ($category > 0) {
                    $categ = "AND catid='$category' ";
                } else {
                    $categ = '';
                }
                $q = "SELECT s.sid, s.aid, s.informant, s.title, s.time, s.hometext, s.bodytext, a.url, s.comments, s.topic FROM "._STORIES_TABLE." s, "._AUTHOR_TABLE." a WHERE s.aid=a.aid $queryalang $categ";
                if (!empty($query)) $q .= "AND (s.title LIKE '%$query%' OR s.hometext LIKE '%$query%' OR s.bodytext LIKE '%$query%' OR s.notes LIKE '%$query%') ";
                if (!empty($author)) $q .= "AND s.aid='".Fix_Quotes($author)."' ";
                if (!empty($topic)) $q .= "AND s.topic='".Fix_Quotes($topic)."' ";
                if (!empty($days) && $days != 0) $q .= "AND TO_DAYS(NOW()) - TO_DAYS(time) <= '".Fix_Quotes($days)."' ";
                $q .= " ORDER BY s.time DESC LIMIT $min,$offset";
                $t = $topic;
                $result5 = $db->sql_query($q);
                $nrows = $db->sql_numrows($result5);
                $x=0;
                if (!empty($query)) {
                    echo "<br /><hr noshade=\"noshade\" size=\"1\" /><center><strong>"._SEARCHRESULTS."</strong></center><br /><br />";
                    echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
                    if ($nrows>0) {
                        while($row5 = $db->sql_fetchrow($result5)) {
                            $sid = intval($row5['sid']);
                            $aid = UsernameColor(stripslashes($row5['aid']));
                            $informant = stripslashes($row5['informant']);
                            $title = stripslashes(check_html($row5['title'], "nohtml"));
                            $time = $row5['time'];
                            $hometext = stripslashes($row5['hometext']);
                            $bodytext = stripslashes($row5['bodytext']);
                            $url = stripslashes($row5['url']);
                            $comments = intval($row5['comments']);
                            $topic = intval($row5['topic']);
                            $row6 = $db->sql_fetchrow($db->sql_query("SELECT `topictext` FROM `"._TOPICS_TABLE."` WHERE `topicid`='$topic'"));
                            $topictext = stripslashes(check_html($row6['topictext'], "nohtml"));

                            $furl = "modules.php?name=News&amp;op=article&amp;sid=$sid";
                            $datetime = formatTimestamp($time);
                            if (empty($informant)) {
                                $informant = '';
                            } else {
                                $informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">".UsernameColor($informant)."</a>";
                            }
                            if (!empty($query) AND $query != '*') {
                                if (preg_match('#'.quotemeta($query).'#si',$title)) {
                                    $a = 1;
                                }
                                $text = $hometext.$bodytext;
                                if (preg_match('#'.quotemeta($query).'#si',$text)) {
                                    $a = 2;
                                }
                                if (preg_match('#'.quotemeta($query).'#si',$text) AND preg_match('#'.quotemeta($query).'#si',$title)) {
                                    $a = 3;
                                }
                                if ($a == 1) {
                                    $match = _MATCHTITLE;
                                } elseif ($a == 2) {
                                    $match = _MATCHTEXT;
                                } elseif ($a == 3) {
                                    $match = _MATCHBOTH;
                                }
                                if (!isset($a)) {
                                    $match = '';
                                } else {
                                    $match = $match.'<br />';
                                }
                            }
                            printf("<tr><td><img src='".evo_image('folders.png', $module_name)."' border='0' alt='' />&nbsp;<span class=\"option\"><a href=\"%s\"><strong>%s</strong></a></span><br /><span class=\"content\">"._CONTRIBUTEDBY." $informant<br />"._POSTEDBY." <a href=\"%s\">%s</a>",$furl,$title,$url,$aid,$informant);
                            echo " "._ON." $datetime<br />".$match._TOPIC.": <a href=\"modules.php?name=$module_name&amp;query=&amp;topic=$topic\">$topictext</a> ";
                            if ($comments == 0) {
                                echo '('._NOCOMMENTS.')';
                            } elseif ($comments == 1) {
                                echo "($comments "._UCOMMENT.")";
                            } elseif ($comments > 1) {
                                echo "($comments "._UCOMMENTS.")";
                            }
                            if (is_mod_admin($module_name)) {
                                echo " [ <a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a> ]";
                            }
                            echo "</span><br /><br /><br /></td></tr>\n";
                            $x++;
                        }
                        $db->sql_freeresult($result5);
                        echo "</table>\n";
                    } else {
                        echo "<tr><td><center><span class=\"option\"><strong>"._NOMATCHES."</strong></span></center><br /><br />";
                        echo "</td></tr></table>\n";
                    }

                    $prev = $min-$offset;
                    if ($prev >= 0) {
                        print "<br /><br /><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type&amp;category=$category\">";
                        print "<strong>$min "._PREVMATCHES."</strong></a></center>";
                    }

                    $next = $min+$offset;
                    if ($x >= 9) {
                        print "<br /><br /><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type&amp;category=$category\">";
                        print "<strong>"._NEXTMATCHES."</strong></a></center>";
                    }
                }

            } else if ($type == 'comments') {
                $result8 = $db->sql_query("SELECT `tid`, `sid`, `subject`, `date`, `name` FROM `"._COMMENTS_TABLE."` WHERE (`subject` LIKE '%$query%' OR `comment` LIKE '%$query%') ORDER BY `date` DESC LIMIT $min,$offset");
                $nrows = $db->sql_numrows($result8);
                $x = 0;
                if (!empty($query)) {
                    echo "<br /><hr noshade=\"noshade\" size=\"1\" /><center><strong>"._SEARCHRESULTS."</strong></center><br /><br />";
                    echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
                    if ($nrows > 0) {
                        while($row8 = $db->sql_fetchrow($result8)) {
                            $tid = intval($row8['tid']);
                            $sid = intval($row8['sid']);
                            $subject = stripslashes(check_html($row8['subject'], "nohtml"));
                            $date = $row8['date'];
                            $name = stripslashes($row8['name']);
                            $row_res = $db->sql_ufetchrow("SELECT `title` FROM `"._STORIES_TABLE."` WHERE `sid`='$sid'");
                            $title = stripslashes(check_html($row_res['title'], "nohtml"));
                            $reply = $db->sql_unumrows("SELECT * FROM "._COMMENTS_TABLE." WHERE pid='$tid'");
                            $furl = "modules.php?name=News&amp;op=article&amp;thold=-1&amp;mode=flat&amp;order=1&amp;sid=$sid#$tid";
                            if(!$name) {
                                $name = $evoconfig['anonymous'];
                            } else {
                                $name = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$name\">".UsernameColor($name)."</a>";
                            }
                            $datetime = formatTimestamp($date);
                            echo "<tr><td><img src='".evo_image('folders.png', $module_name)."' alt='' border='0' />&nbsp;<span class=\"option\"><a href=\"$furl\"><strong>$subject</strong></a></span><span class=\"content\"><br />"._POSTEDBY." ".UsernameColor($name)
                            ." "._ON." $datetime<br />"
                            ._ATTACHART.": $title<br />";
                            if ($reply == 1) {
                                echo "($reply "._SREPLY.")";
                                if (is_mod_admin($module_name)) {
                                    echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
                                }
                                echo "<br /><br /><br /></td></tr>\n";
                            } else {
                                echo "($reply "._SREPLIES.")";
                                if (is_mod_admin($module_name)) {
                                    echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
                                }
                                echo "<br /><br /><br /></td></tr>\n";
                            }
                            $x++;
                        }
                        $db->sql_freeresult($result8);
                        echo "</table>";
                    } else {
                        echo "<tr><td><center><span class=\"option\"><strong>"._NOMATCHES."</strong></span></center><br /><br />";
                        echo "</td></tr></table>";
                    }

                    $prev = $min-$offset;
                    if ($prev >= 0) {
                        print "<br /><br /><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$prev&amp;query=$query&amp;type=$type\">";
                        print "<strong>$min "._PREVMATCHES."</strong></a></center>";
                    }

                    $next = $min+$offset;
                    if ($x >= 9) {
                        print "<br /><br /><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$max&amp;query=$query&amp;type=$type\">";
                        print "<strong>"._NEXTMATCHES."</strong></a></center>";
                    }
                }
            } elseif ($type == 'users') {
                $res_n3 = $db->sql_query("SELECT user_id, username, name FROM "._USERS_TABLE." WHERE (username LIKE '%$query%' OR name LIKE '%$query%' OR bio LIKE '%$query%') ORDER BY username ASC LIMIT $min,$offset");
                $nrows = $db->sql_numrows($res_n3);
                $x = 0;
                if (!empty($query)) {
                    echo "<br /><hr noshade=\"noshade\" size=\"1\" /><center><strong>"._SEARCHRESULTS."</strong></center><br /><br />";
                    echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
                    if ($nrows > 0) {
                        while($rown3 = $db->sql_fetchrow($res_n3)) {
                            $uid = intval($rown3['user_id']);
                            $uname = stripslashes($rown3['username']);
                            $name = stripslashes($rown3['name']);
                            $furl = "modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname";
                            if (empty($name)) {
                                $name = ""._NONAME."";
                            }
                            echo "<tr><td><img src='".evo_image('folders.png', $module_name)."' alt='' border='0' />&nbsp;<span class=\"option\"><a href=\"$furl\"><strong>".UsernameColor($uname)."</strong></a></span><span class=\"content\"> (".UsernameColor($name).")";
                            if (is_mod_admin($module_name)) {
                                echo " [ <a href=\"".$admin_file.".php?chng_uid=$uid&amp;op=modifyUser\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=delUser&amp;chng_uid=$uid\">"._DELETE."</a> ]";
                            }
                            echo "</span></td></tr>\n";
                            $x++;
                        }
                        $db->sql_freeresult($res_n3);
                        echo "</table>\n";
                    } else {
                        echo "<tr><td><center><span class=\"option\"><strong>"._NOMATCHES."</strong></span></center><br /><br />";
                        echo "</td></tr></table>\n";
                    }

                    $prev = $min-$offset;
                    if ($prev >= 0) {
                        print "<br /><br /><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type\">";
                        print "<strong>$min "._PREVMATCHES."</strong></a></center>";
                    }

                    $next = $min+$offset;
                    if ($x >= 9) {
                        print "<br /><br /><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type\">";
                        print "<strong>"._NEXTMATCHES."</strong></a></center>";
                    }
                }
            }
            CloseTable();
            $mod1 = $mod2 = $mod3 = $mod4 = '';
            if (isset($query) AND !empty($query)) {
                echo "<br />";
                if (is_active('Downloads')) {
                    $dcnt = $db->sql_unumrows("SELECT did FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `title` LIKE '%$query%' OR `description` LIKE '%$query%' OR `submitter` LIKE '%$query%' and `download_active`='0'");
                    $mod1 = "<li>&nbsp;<a href=\"modules.php?name=Downloads&amp;op=search&amp;query=$query\">"._DOWNLOADS."</a> ($dcnt "._SEARCHRESULTS.")</li>";
                }
                if (is_active('Web_Links')) {
                    $lcnt = $db->sql_unumrows("SELECT lid FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `title` LIKE '%$query%' OR `description` LIKE '%$query%' OR `submitter` LIKE '%$query%'");
                    $mod2 = "<li>&nbsp;<a href=\"modules.php?name=Web_Links&amp;op=search&amp;query=$query\">"._WEBLINKS."</a> ($lcnt "._SEARCHRESULTS.")</li>";
                }
                if (is_active('Reviews')) {
                    $rcnt = $db->sql_unumrows("SELECT rid FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `title` LIKE '%$query%' OR `description` LIKE '%$query%' OR `submitter` LIKE '%$query%'");
                    $mod4 = "<li>&nbsp;<a href=\"modules.php?name=Reviews&amp;op=search&amp;query=$query\">"._REVIEWS."</a> ($rcnt "._SEARCHRESULTS.")</li>";
                }
                if (is_active('Encyclopedia')) {
                    $ecnt1 = $db->sql_query("SELECT `eid` FROM `"._ENCYCLOPEDIA_TABLE."` WHERE `active`='1'");
                    $ecnt = 0;
                    while($row_e = $db->sql_fetchrow($ecnt1)) {
                        $eid = intval($row_e['eid']);
                        $ecnt2 = $db->sql_unumrows("SELECT * FROM "._ENCYCLOPEDIA_TABLE." WHERE title LIKE '%$query%' OR description LIKE '%$query%' AND eid='$eid'");
                        $ecnt3 = $db->sql_unumrows("SELECT * FROM "._ENCYCLOPEDIA_TEXT_TABLE." WHERE title LIKE '%$query%' OR text LIKE '%$query%' AND eid='$eid'");
                        $ecnt = $ecnt+$ecnt2+$ecnt3;
                    }
                    $db->sql_freeresult($ecnt1);
                    $mod3 = "<li>&nbsp;<a href=\"modules.php?name=Encyclopedia&amp;file=search&amp;query=$query\">"._ENCYCLOPEDIA."</a> ($ecnt "._SEARCHRESULTS.")</li>";
                }
                OpenTable();
                echo "<span class=\"title\">"._FINDMORE."<br /><br />"
                ._DIDNOTFIND."</span><br /><br />"
                ." \"<strong>$query</strong>\" "._SEARCHIN.":<br /><br />"
                ."<ul>"
                .$mod1
                .$mod2
                .$mod3
                .$mod4
                ."<li>&nbsp;<a href=\"http://www.google.com/search?q=$query\" target=\"new\">Google</a></li>"
                ."<li>&nbsp;<a href=\"http://groups.google.com/groups?q=$query\" target=\"new\">Google Groups</a></li>"
                ."</ul>";
                CloseTable();
            }
            include_once(NUKE_BASE_DIR.'footer.php');
        break;
}

?>