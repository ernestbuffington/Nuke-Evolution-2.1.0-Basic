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
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

global $_GETVAR, $evoconfig;
$pagetitle = '- '._SURVEYS;

function format_url($comment) {
    unset($location);
    $comment = $comment;
    $links = array();
    $hrefs = array();
    $pos = 0;
    while (!(($pos = strpos($comment,"<",$pos)) === false)) {
    $pos++;
    $endpos = strpos($comment,">",$pos);
    $tag = substr($comment,$pos,$endpos-$pos);
    $tag = trim($tag);
    if (isset($location)) {
            if (!strcasecmp(strtok($tag," "),"/A")) {
            $link = substr($comment,$linkpos,$pos-1-$linkpos);
            $links[] = $link;
            $hrefs[] = $location;
            unset($location);
            }
        $pos = $endpos+1;
    } else {
        if (!strcasecmp(strtok($tag," "),"A")) {
        if (preg_match("#HREF[ \t\n\r\v]*=[ \t\n\r\v]*\"([^\"]*)\"#i",$tag,$regs));
        else if (preg_match("#HREF[ \t\n\r\v]*=[ \t\n\r\v]*([^ \t\n\r\v]*)#i",$tag,$regs));
        else $regs[1] = "";
        if ($regs[1]) {
                $location = $regs[1];
        }
        $pos = $endpos+1;
        $linkpos = $pos;
        } else {
        $pos = $endpos+1;
        }
    }
    }
    for ($i=0; $i<count($links); $i++) {
    if (!preg_match("#http://#i", $hrefs[$i])) {
        $hrefs[$i] = EVO_SERVER_URL;
    } elseif (!preg_match("#mailto://#i", $hrefs[$i])) {
        $href = explode("/",$hrefs[$i]);
        $href = " [$href[2]]";
        $comment = preg_replace("#>$links[$i]</a>#i", "title='$hrefs[$i]'> $links[$i]</a>$href", $comment);
    }
    }
    return($comment);
}

function modone() {
    global $admin, $evoconfig, $module_name;
    if(((is_mod_admin($module_name)) && ($evoconfig['moderate'] == 1)) || ($evoconfig['moderate']==2)) echo "<form action=\"modules.php?name=$module_name&file=comments\" method=\"post\">";
}

function modtwo($tid, $score, $reason) {
    global $evoconfig;
    if(((is_mod_admin($module_name)) && ($evoconfig['moderate'] == 1)) || (($evoconfig['moderate'] == 2) && (is_user()))) {
    echo " | <select name=dkn$tid>";
    for($i=0,$maxi=count($evoconfig['reasons']); $i<$maxi; $i++) {
        echo "<option value=\"$score:$i\">".$evoconfig['reasons'][$i]."</option>\n";
    }
    echo "</select>";
    }
}

function modthree($pollID, $mode, $order, $thold=0) {
    global $evoconfig, $module_name;
    if(((is_mod_admin($module_name)) && ($evoconfig['moderate'] == 1)) || (($evoconfig['moderate']==2) && (is_user())))
    {
      echo "<center><input type=\"hidden\" name=\"pollID\" value=\"$pollID\" />"
          . "<input type=\"hidden\" name=\"mode\" value=\"$mode\" />"
          . "<input type=\"hidden\" name=\"order\" value=\"$order\" />"
          . "<input type=\"hidden\" name=\"thold\" value=\"$thold\" />"
          . "<br />"
          . "<input type=\"hidden\" name=\"op\" value=\"moderate\" />"
          . "<input type=\"submit\" value=\""._SV_MODERATE."\" /></center></form>";
    }
}

function nocomm() {
    OpenTable();
    echo "<center><span class=\"content\">"._NOCOMMENTSACT."</span></center>";
    CloseTable();
}

function navbar($pollID, $title, $thold, $mode, $order) {
    global $bgcolor1, $bgcolor2, $textcolor1, $textcolor2, $evoconfig, $db, $module_name;
    $query = $db->sql_query('SELECT pollID FROM `'._POLL_COMMENTS_TABLE.'` WHERE `pollID`="'.$pollID.'"');
    if(!$query) {
      $count = 0;
    } else {
      $count = $db->sql_numrows($query);
    }
    $db->sql_freeresult($query);
    $pollID = intval($pollID);
    $query = $db->sql_query("SELECT pollTitle FROM "._POLL_DESC_TABLE." where pollID='$pollID'");
    list($un_title) = $db->sql_fetchrow($query);
    $db->sql_freeresult($query);
    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
        }
        if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
        }
        if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }
    echo "\n\n<!-- COMMENTS NAVIGATION BAR START -->\n\n";
    echo "<a name=\"comments\"></a>\n";
    OpenTable();
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n";
    if($title) {
    echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><span class=\"content\" style=\"color:$textcolor1\">\"".check_words($un_title)."\" | ";
    if(is_user()) {
        echo "<a href=\"modules.php?name=Your_Account&amp;op=editcomm\"><span style=\"color:$textcolor1\">"._CONFIGURE."</span></a>";
    } else {
        echo "<a href=\"modules.php?name=Your_Account\"><span style=\"color:$textcolor1\">"._LOGINCREATE."</span></a>";
    }
    if(($count==1)) {
        echo " | <strong>$count</strong> "._COMMENT."";
    } else {
        echo " | <strong>$count</strong> "._COMMENTS."";
    }
    if ($count > 0 AND is_active("Search")) {
        echo " | <a href='modules.php?name=Search&type=comments&pollID=$pollID'>"._SEARCHDIS."</a>";
    }
    echo "</span></td></tr>\n";
    }
    echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\" width=\"100%\">\n";
    if ($evoconfig['anonpost']==1 OR is_mod_admin($module_name) OR is_user()) {
        echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">"
            ."<input type=\"hidden\" name=\"pid\" value=\"$pollID\" />"
            ."<input type=\"hidden\" name=\"pollID\" value=\"$pollID\" />"
            ."<input type=\"hidden\" name=\"op\" value=\"Reply\" />"
            ."<input type=\"submit\" value=\""._REPLYMAIN."\" /></form>";
    }
    echo "</td></tr>\n";
    echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><span class=\"tiny\">"._COMMENTSWARNING."</span></td></tr></table>"
    ."\n\n<!-- COMMENTS NAVIGATION BAR END -->\n\n";
    CloseTable();
    if ($evoconfig['anonpost'] == 0 AND !is_user()) {
        echo "<br />";
        OpenTable();
        echo "<center>"._NOANONCOMMENTS."</center>";
        CloseTable();
    }
}

function DisplayKids ($tid, $mode, $order=0, $thold=0, $level=0, $dummy=0, $tblwidth=99) {
    global $bgcolor1, $evoconfig, $textcolor2, $db, $module_name, $userinfo;
    $comments = 0;
    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }
    $tid = intval($tid);
    $result = $db->sql_query('SELECT * FROM `'._POLL_COMMENTS_TABLE.'` WHERE `pid`='.$tid.' ORDER BY `date`, `tid`');
    if ($mode == 'nested') {
        /* without the tblwidth variable, the tables run of the screen with netscape */
        /* in nested mode in long threads so the text can't be read. */
        while ($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
            $datetime = formatTimestamp($row['date']);
            $r_name = stripslashes($row['name']);
            $r_email = stripslashes($row['email']);
            $r_host_name = $row['host_name'];
            $r_subject = check_words(stripslashes(check_html($row['subject'], 'nohtml')));
            $r_comment = check_words(stripslashes($row['comment']));
            $r_score = intval($row['score']);
            $r_reason = intval($row['reason']);
            if($r_score >= $thold) {
                if (!isset($level)) {
                } else {
                    if (!$comments) {
                        echo "<ul>";
                        $tblwidth -= 5;
                    }
                }
                $comments++;
                if (!preg_match("#[a-z0-9]#i",$r_name)) {
                    $r_name = _ANONYMOUS;
                }
                if (!preg_match("#[a-z0-9]#i",$r_subject)) {
                    $r_subject = "["._NOSUBJECT."]";
                }
                // HIJO enter hex color between first two appostrophe for second alt bgcolor
                $r_bgcolor = ($dummy%2)?"":"#E6E6D2";
                echo "<a name=\"$r_tid\">";
                echo "<table border=\"0\"><tr bgcolor=\"$bgcolor1\"><td>";
                if ($r_email) {
                    echo "<strong>$r_subject</strong>&nbsp;<span class=\"content\">";
                    if($userinfo['noscore'] == 0) {
                    echo "<br />("._SCORE." $r_score";
                    if($r_reason>0) echo ", ".$evoconfig['reasons'][$r_reason];
                    echo ")";
                    }
                    echo "<br />"._BY." <a href=\"mailto:$r_email\">".UsernameColor($r_name)."</a>&nbsp;<span class=\"content\"><strong>($r_email)</strong></span> "._ON." $datetime";
                } else {
                    echo "<strong>$r_subject</strong>&nbsp;<span class=\"content\">";
                    if($userinfo['noscore'] == 0) {
                    echo "<br />("._SCORE." $r_score";
                    if($r_reason>0) echo ", ".$evoconfig['reasons'][$r_reason];
                    echo ")";
                    }
                    echo "<br />"._BY." ".UsernameColor($r_name)." "._ON." $datetime";
                }
                if ($r_name != _ANONYMOUS) {
                    $row3 = $db->sql_fetchrow($db->sql_query("SELECT user_id, user_website FROM "._USERS_TABLE." WHERE username='$r_name'"));
                    $ruid = intval($row3['user_id']);
                    $url = stripslashes($row3['user_website']);
                    if ($url != "http://" AND $url != "" AND preg_match("#http://#i", $url))
                    {
                      echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$r_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a> | ";
                      echo "<a href=\"$url\" target=\"new\">"._SV_WEBSITE."</a> )";
                    }
                    else
                    {
                      echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$r_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a> ) ";
                    }
                    echo "</span></td></tr><tr><td>";
                }
                if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) {
                    echo substr("$r_comment", 0, $userinfo['commentmax'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                } elseif (strlen($r_comment) > $evoconfig['commentlimit']) {
                    echo substr("$r_comment", 0, $evoconfig['commentlimit'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                } else {
                    echo $r_comment;
                }
                echo "</td></tr></table><br /><br />";
                if ($evoconfig['anonpost']==1 OR is_mod_admin($module_name) OR is_user()) {
                    echo "<span class=\"content\" > [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$r_tid&amp;pollID=$r_pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
                }
                modtwo($r_tid, $r_score, $r_reason);
                echo " ]</span><br /><br />";
                DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
            }
        }
    } elseif ($mode == 'flat') {
        while ($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
            $datetime = formatTimestamp($row['date']);
            $r_name = stripslashes($row['name']);
            $r_email = stripslashes($row['email']);
            $r_host_name = $row['host_name'];
            $r_subject = check_words(stripslashes(check_html($row['subject'], 'nohtml')));
            $r_comment = check_words(stripslashes($row['comment']));
            $r_score = intval($row['score']);
            $r_reason = intval($row['reason']);
            if($r_score >= $thold) {
                if (!preg_match("#[a-z0-9]#i",$r_name)) $r_name = _ANONYMOUS;
                if (!preg_match("#[a-z0-9]#i",$r_subject)) $r_subject = "["._NOSUBJECT."]";
                echo "<a name=\"$r_tid\">";
                echo "<hr /><table width=\"99%\" border=\"0\"><tr bgcolor=\"$bgcolor1\"><td>";
                if ($r_email) {
                echo "<strong>$r_subject</strong>&nbsp;<span class=\"content\">";
                if($userinfo['noscore'] == 0) {
                    echo "<br />("._SCORE." $r_score";
                    if($r_reason>0) echo ", ".$evoconfig['reasons'][$r_reason];
                    echo ")";
                }
                echo "<br />"._BY." <a href=\"mailto:$r_email\">".UsernameColor($r_name)."</a>&nbsp;<span class=\"content\"><strong>($r_email)</strong></span> "._ON." $datetime";
                 } else {
                echo "<strong>$r_subject</strong>&nbsp;<span class=\"content\">";
                if($userinfo['noscore'] == 0) {
                    echo "<br />("._SCORE." $r_score";
                    if($r_reason>0) echo ", ".$evoconfig['reasons'][$r_reason];
                    echo ")";
                }
                echo "<br />"._BY." ".UsernameColor($r_name)." "._ON." $datetime";
                }
                if ($r_name != _ANONYMOUS) {
                  $row3 = $db->sql_fetchrow($db->sql_query("SELECT user_id, user_website FROM "._USERS_TABLE." WHERE username='$r_name'"));
                  $ruid = intval($row3['user_id']);
                  $url = stripslashes($row3['user_website']);
                  if ($url != "http://" AND $url != "" AND preg_match("#http://#i", $url))
                  {
                    echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$r_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a> | ";
                    echo "<a href=\"$url\" target=\"new\">"._SV_WEBSITE."</a> )";
                  }
                  else
                  {
                    echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$r_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a> ) ";
                  }
                  echo "</span></td></tr><tr><td>";
                }
                if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) {
                    echo substr("$r_comment", 0, $userinfo['commentmax'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                } elseif (strlen($r_comment) > $evoconfig['commentlimit']) {
                    echo substr("$r_comment", 0, $evoconfig['commentlimit'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                } else {
                    echo $r_comment;
                }
                echo "</td></tr></table><br /><br />";
                if ($evoconfig['anonpost']==1 OR is_mod_admin($module_name) OR is_user()) {
                    echo "<span class=\"content\" > [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$r_tid&amp;pollID=$r_pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
                }
                modtwo($r_tid, $r_score, $r_reason);
                echo " ]</span><br /><br />";
                DisplayKids($r_tid, $mode, $order, $thold);
            }
          }
        } else {
        while ($row = $db->sql_fetchrow($result)) {
          $r_tid = intval($row['tid']);
          $r_pid = intval($row['pid']);
          $r_pollID = intval($row['pollID']);
          $datetime = formatTimestamp($row['date']);
          $r_name = stripslashes($row['name']);
          $r_email = stripslashes($row['email']);
          $r_host_name = $row['host_name'];
          $r_subject = check_words(stripslashes(check_html($row['subject'], 'nohtml')));
          $r_comment = check_words(stripslashes($row['comment']));
          $r_score = intval($row['score']);
          $r_reason = intval($row['reason']);
          if($r_score >= $thold) {
              if (!isset($level)) {
              } else {
              if (!$comments) {
                  echo "<ul>";
              }
              }
              $comments++;
              if (!preg_match("#[a-z0-9]#i",$r_name)) $r_name = _ANONYMOUS;
              if (!preg_match("#[a-z0-9]#i",$r_subject)) $r_subject = "["._NOSUBJECT."]";
              echo "<li><span class=\"content\" style=\"color:$textcolor2\"><a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=showreply&amp;tid=$r_tid&amp;pollID=$r_pollID&amp;pid=$r_pid&amp;mode=$mode&amp;order=$order&amp;thold=$thold#$r_tid\">$r_subject</a> "._BY." ".UsernameColor($r_name)." "._ON." $datetime</span></li>";
              DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1);
          }
        }
    }
    if ($level && $comments) {
        echo "</ul>";
    }
    $db->sql_freeresult($result);
}

function DisplayBabies ($tid, $level=0, $dummy=0) {
    global $datetime, $db, $module_name;
    $comments = 0;
    $result = $db->sql_query("SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason FROM "._POLL_COMMENTS_TABLE." WHERE pid='$tid' ORDER BY date, tid");
    while ($row = $db->sql_fetchrow($result)) {
        $r_tid = intval($row['tid']);
        $r_pid = intval($row['pid']);
        $r_pollID = intval($row['pollID']);
        $datetime = formatTimestamp($row['date']);
        $r_name = stripslashes($row['name']);
        $r_email = stripslashes($row['email']);
        $r_host_name = $row['host_name'];
        $r_subject = check_words(stripslashes(check_html($row['subject'], 'nohtml')));
        $r_comment = check_words(stripslashes($row['comment']));
        $r_score = intval($row['score']);
        $r_reason = intval($row['reason']);
    if (!isset($level)) {
    } else {
        if (!$comments) {
        echo "<ul>";
        }
    }
    $comments++;
    if (!preg_match("#[a-z0-9]#i",$r_name)) { $r_name = _ANONYMOUS; }
    if (!preg_match("#[a-z0-9]#i",$r_subject)) { $r_subject = "["._NOSUBJECT."]"; }
    echo "<li><a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=showreply&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">$r_subject</a></span><span class=\"content\"> "._BY." ".UsernameColor($r_name)." "._ON." $datetime</li>";
    DisplayBabies($r_tid, $level+1, $dummy+1);
    }
    $db->sql_freeresult($result);
    if ($level && $comments) {
        echo "</ul>";
    }
}

function DisplayTopic($pollID, $pid=0, $tid=0, $mode='thread', $order=0, $thold=0, $level=0, $nokids=0) {
    global $hr, $evoconfig, $db, $module_name,  $admin_file, $userinfo;

    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }

    if(defined('IN_SURVEY')) {
        global $title, $bgcolor1, $bgcolor2, $bgcolor3;
    } else {
        global $title, $bgcolor1, $bgcolor2, $bgcolor3;
        include_once(NUKE_BASE_DIR.'mainfile.php');
        include_once(NUKE_BASE_DIR.'header.php');
    }

    $q = 'SELECT * FROM `'._POLL_COMMENTS_TABLE.'` WHERE `pollID`="'.$pollID.'" AND `pid`="'.$pid.'"';
    if($thold != 0 ) {
      $q .= ' AND `score`>="'.$thold.'" ';
    }
    if ($order==1) {$q .= ' ORDER BY `date` DESC';}
    if ($order==2) {$q .= ' ORDER BY `score` DESC';}
    $something = $db->sql_query($q);
    $num_tid = $db->sql_numrows($something);
    if (($evoconfig['pollcomm'] == 1)) {
      navbar($pollID, $title, $thold, $mode, $order);
    }
    modone();
    while ($row_q = $db->sql_fetchrow($something)) {
      echo "<br />";
      OpenTable();
      $tid = intval($row_q['tid']);
      $pid = intval($row_q['pid']);
      $pollID = intval($row_q['pollID']);
      $datetime = formatTimestamp($row_q['date']);
      $c_name = stripslashes($row_q['name']);
      $email = stripslashes($row_q['email']);
      $host_name = $row_q['host_name'];
      $subject = check_words(stripslashes(check_html($row_q['subject'], 'nohtml')));
      $comment = check_words(set_smilies(decode_bbcode(stripslashes($row_q['comment']), 1, true)));
      $comment = evo_img_tag_to_resize($comment);
      $score = intval($row_q['score']);
      $reason = intval($row_q['reason']);
      if (empty($c_name)) { $c_name = _ANONYMOUS; }
      if (empty($subject)) { $subject = "["._NOSUBJECT."]"; }
      echo "<a name=\"$tid\"></a>";
      echo "<table width=\"99%\" border=\"0\"><tr bgcolor=\"$bgcolor1\"><td width=\"500\">";
      if ($email) {
          echo "<strong>$subject</strong>&nbsp;<span class=\"content\">";
          if($userinfo['noscore'] == 0) {
            echo "<br />("._SCORE." $score";
              if($reason>0) {
                echo ", ".$evoconfig['reasons'][$reason];
                echo ")";
              }
          }
          echo "<br />"._BY." <a href=\"mailto:$email\">".UsernameColor($c_name)."</a>&nbsp;<strong>($email)</strong> "._ON." $datetime";
      } else {
          echo "<strong>$subject</strong>&nbsp;<span class=\"content\">";
          if($userinfo['noscore'] == 0) {
          echo "<br />("._SCORE." $score";
          if($reason>0) echo ", ".$evoconfig['reasons'][$reason];
          echo ")";
          }
          echo "<br />"._BY." ".UsernameColor($c_name)." "._ON." $datetime";
      }

      /* If you are admin you can see the Poster IP address */
      /* with this you can see who is flaming you...*/

      if (is_active('Journal') && ($c_name != _ANONYMOUS)) {
          $row = $db->sql_fetchrow($db->sql_query("SELECT jid FROM "._JOURNAL_TABLE." WHERE aid='$c_name' AND status='yes' ORDER BY pdate,jid DESC LIMIT 0,1"));
          $jid = intval($row['jid']);
          if ($jid != '' AND isset($jid)) {
          $journal = " | <a href=\"modules.php?name=Journal&amp;file=display&amp;jid=$jid\">"._JOURNAL."</a>";
          } else {
          $journal = '';
          }
      }
      if ($c_name != _ANONYMOUS) {
            $row3 = $db->sql_fetchrow($db->sql_query("SELECT user_id, user_website FROM "._USERS_TABLE." WHERE username='$c_name'"));
            $ruid = intval($row3['user_id']);
            $url = stripslashes($row3['user_website']);
            if ($url != "http://" AND $url != "" AND preg_match("#http://#i", $url))
            {
              echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$c_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a> ";
              echo "$journal | <a href=\"$url\" target=\"new\">"._SV_WEBSITE."</a> )";
            }
            else
            {
              echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$c_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a> $journal ) ";
            }
      }
      if(is_mod_admin($module_name)) {
          $row3 = $db->sql_fetchrow($db->sql_query("SELECT host_name FROM "._POLL_COMMENTS_TABLE." WHERE tid='$tid'"));
          $host_name = $row3['host_name'];
          echo "<br /><strong>(IP: $host_name)</strong>";
      }
      echo "</span></td></tr><tr><td>";
      if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr("$r_comment", 0, $userinfo['commentmax'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
      elseif(strlen($comment) > $evoconfig['commentlimit']) echo substr("$comment", 0, $evoconfig['commentlimit'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$pollID&tid=$tid&mode=$mode&order=$order&thold=$thold\">"._READREST."</a></strong>";
      else echo $comment;
      echo "</td></tr></table><br /><br />";
      if ($evoconfig['anonpost']==1 OR is_mod_admin($module_name) OR is_user()) {
          echo "<span class=\"content\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$tid&amp;pollID=$pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
      }
      if ($pid != 0) {
          $row4 = $db->sql_fetchrow($db->sql_query("SELECT pid FROM "._POLL_COMMENTS_TABLE." WHERE tid='$pid'"));
          $erin = intval($row4['pid']);
          echo " | <a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$pollID&amp;pid=$erin&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._PARENT."</a>";
      }
      modtwo($tid, $score, $reason);

      if ($evoconfig['anonpost'] != 0 OR is_mod_admin($module_name) OR is_user()) {
          echo " ]</span><br /><br />";
      }

      DisplayKids($tid, $mode, $order, $thold, $level);
      echo "</ul>";
      if($hr) echo "<hr noshade=\"noshade\" size=\"1\" />";
      $count_times += 1;
      CloseTable();
    }
    $db->sql_freeresult($something);
    if ( $num_tid > 0 ) {
        modthree($pollID, $mode, $order, $thold);
    }
    if ($pid != 0) {
        return array($pollID, $pid, $subject);
    } elseif ( defined('IN_SURVVEY') ) {
        return;
    } else {
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function singlecomment($tid, $pollID, $mode, $order, $thold) {
    global $module_name, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $evoconfig, $textcolor2, $db;
    include_once(NUKE_BASE_DIR.'header.php');
    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
            $mode = $userinfo['umode'];
        } else {
            $mode = "thread";
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
            $order = $userinfo['uorder'];
        } else {
            $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
            $thold = $userinfo['thold'];
        } else {
            $thold = 0;
        }
    }

    $sql = $db->sql_query("SELECT date, name, email, subject, comment, score, reason FROM "._POLL_COMMENTS_TABLE." WHERE tid='$tid' AND pollID='$pollID'");
    $row = $db->sql_fetchrow($sql);
    $num_tid = $db->sql_numrows($sql);
    $db->sql_freeresult($sql);
    $datetime = $row['date'];
    $name = stripslashes($row['name']);
    $email = stripslashes($row['email']);
    $subject = check_words(stripslashes(check_html($row['subject'], 'nohtml')));
    $comment = check_words(stripslashes($row['comment']));
    $score = intval($row['score']);
    $reason = intval($row['reason']);
    $titlebar = "<strong>$subject</strong>";
    if(empty($name)) $name = _ANONYMOUS;
    if(empty($subject)) $subject = "["._NOSUBJECT."]";
    modone();
    OpenTable();
    echo "<table width=\"99%\" border=\"0\"><tr bgcolor=\"$bgcolor1\"><td width=\"500\">";
    if($email) echo "<strong>$subject</strong>&nbsp;<span class=\"content\" color=\"$textcolor2\">("._SCORE." $score)<br />"._BY." <a href=\"mailto:$email\"><span color=\"$bgcolor2\">".UsernameColor($name)."</span></a>&nbsp;<span class=content><strong>($email)</strong></span> "._ON." $datetime";
    else echo "<strong>$subject</strong>&nbsp;<span class=content>("._SCORE." $score)<br />"._BY." ".UsernameColor($name)." "._ON." $datetime";
    echo "</td></tr><tr><td>$comment</td></tr></table><br /><br />";
    if ( (($evoconfig['anonpost']==1 OR is_user()) AND $evoconfig['pollcomm'] == 1) OR is_mod_admin($module_name) ) {
    echo "<span class=content> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$tid&amp;pollID=$pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a> | <a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$pollID&mode=$mode&order=$order&thold=$thold\">"._ROOT."</a>";
    }
    modtwo($tid, $score, $reason);
    echo " ]";
    if ( $num_tid > 0 ) {
        modthree($pollID, $mode, $order, $thold);
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function reply($pid, $pollID, $mode, $order, $thold) {
    include_once(NUKE_BASE_DIR.'header.php');
    global $userinfo, $module_name, $bgcolor1, $bgcolor2, $bgcolor3, $db, $evoconfig, $AllowableHTML;

    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }
    if ( $evoconfig['pollcomm'] == 0 || ($evoconfig['anonpost']==0 && !is_user() && !is_mod_admin($module_name)) ) {
        OpenTable();
        echo "<center><span class=title><strong>"._REPLYMAIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center>"._NOANONCOMMENTS."<br /><br />"._GOBACK."</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        if ($pid != 0) {
            $row = $db->sql_fetchrow($db->sql_query("SELECT date, name, email, subject, comment, score FROM "._POLL_COMMENTS_TABLE." WHERE tid='$pid'"));
            $date = $row['date'];
            $name = stripslashes($row['name']);
            $email = stripslashes($row['email']);
            $subject = check_words(stripslashes(check_html($row['subject'], 'nohtml')));
            $comment = check_words(set_smilies(decode_bbcode(stripslashes($row['comment']), 1, true)));
            $comment = evo_img_tag_to_resize($comment);
            $score = intval($row['score']);
        } else {
            $row2 = $db->sql_fetchrow($db->sql_query("SELECT pollTitle FROM "._POLL_DESC_TABLE." WHERE pollID='$pollID'"));
            $subject = check_words(stripslashes(check_html($row2['pollTitle'], 'nohtml')));
        }
        if(empty($comment)) {
            $comment = "$temp_comment<br /><br />$comment2";
        }
        OpenTable();
        echo "<center><span class=title><strong>"._REPLYMAIN."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        if (empty($name)) $name = _ANONYMOUS;
        if (empty($subject)) $subject = "["._NOSUBJECT."]";
        $datetime = formatTimestamp($date);
        echo "<strong>$subject</strong>&nbsp;<span class=\"content\">";
        if (!$temp_comment && $pid !=0) echo"<br />("._SCORE." $score)";
        if ($email) {
            echo "<br />"._BY." <a href=\"mailto:$email\">".UsernameColor($name)."</a>&nbsp;<span class=\"content\"><strong>($email)</strong></span> "._ON." $datetime";
        } elseif ($pid !=0) {
            echo "<br />"._BY." ".UsernameColor($name)." "._ON." $datetime";
        }
        echo "<br /><br />$comment<br /><br />";
        if ($pid == 0) {
            if ($notes != "") {
            echo "<strong>"._NOTE."</strong>&nbsp;<em>$notes</em><br /><br />";
            } else {
            echo "";
            }
        }
        if (!isset($pid) || !isset($pollID)) { echo "Something is not right. This message is just to keep things from messing up down the road"; exit(); }
        if ($pid == 0) {
            $row3 = $db->sql_fetchrow($db->sql_query("SELECT pollTitle FROM "._POLL_DESC_TABLE." WHERE pollID='$pollID'"));
            $subject = check_words(stripslashes(check_html($row3['pollTitle'], 'nohtml')));
        } else {
            $row4 = $db->sql_fetchrow($db->sql_query("SELECT subject FROM "._POLL_COMMENTS_TABLE." WHERE tid='$pid'"));
            $subject = check_words(stripslashes(check_html($row4['subject'], 'nohtml')));
        }
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" name=\"commentreply\" method=\"post\">";
        echo "<span class=option><strong>"._YOURNAME.":</strong></span> ";
        if (is_user()) {
            echo "<a href=\"modules.php?name=Your_Account\">".$userinfo['username']."</a>&nbsp;<span class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</span><br /><br />";
        } else {
                echo "<span class=\"content\">"._ANONYMOUS;
            echo " [ <a href=\"modules.php?name=Your_Account\">"._BREG."</a> ]<br /><br />";
        }
        echo "<span class=\"option\"><strong>"._SUBJECT.":</strong></span><br />";
        if (!preg_match('#Re:#i',$subject)) $subject = 'Re: '.substr($subject,0,81);
        echo "<input type=\"text\" name=\"subject\" size=\"50\" maxlength=\"85\" value=\"$subject\" /><br /><br />";
        echo "<span class=\"option\"><strong>"._UCOMMENT.":</strong></span><br />";
        echo Make_TextArea('comment','', 'commentreply');
        echo "<br />";
        if (is_user() AND ($evoconfig['anonpost'] == 1)) { echo "<input type=\"checkbox\" name=\"xanonpost\" /> "._POSTANON."<br />"; }
        echo "<input type=\"hidden\" name=\"pid\" value=\"$pid\" />\n"
            ."<input type=\"hidden\" name=\"pollID\" value=\"$pollID\" />\n"
            ."<input type=\"hidden\" name=\"mode\" value=\"$mode\" />\n"
            ."<input type=\"hidden\" name=\"order\" value=\"$order\" />\n"
            ."<input type=\"hidden\" name=\"thold\" value=\"$thold\" />\n"
            ."<input type=\"submit\" name=\"op\" value=\""._PREVIEW."\" />\n"
            ."<input type=\"submit\" name=\"op\" value=\""._OK."\" />\n"
            ."<select name=\"posttype\">\n"
            ."<option value=\"exttrans\">"._EXTRANS."</option>\n"
            ."<option value=\"html\" >"._HTMLFORMATED."</option>\n"
            ."<option value=\"plaintext\" selected='selected'>"._PLAINTEXT."</option>\n"
            ."</select></span></form>\n";
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
}

function replyPreview ($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype) {
    include_once(NUKE_BASE_DIR.'header.php');
    global $module_name, $userinfo, $AllowableHTML, $evoconfig;

    if (!isset($mode) OR empty($mode)) {
                    if(isset($userinfo['umode'])) {
                      $mode = $userinfo['umode'];
                    } else {
                      $mode = "thread";
                    }
    }
    if (!isset($order) OR empty($order)) {
                    if(isset($userinfo['uorder'])) {
                      $order = $userinfo['uorder'];
                    } else {
                      $order = 0;
                    }
    }
    if (!isset($thold) OR empty($thold)) {
                    if(isset($userinfo['thold'])) {
                      $thold = $userinfo['thold'];
                    } else {
                      $thold = 0;
                    }
    }
    OpenTable();
    echo "<center><span class=\"title\"><strong>"._COMREPLYPRE."</strong></span></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    $subject = check_words(stripslashes(check_html($subject, 'nohtml')));
    $comment_show = evo_img_tag_to_resize(check_words(set_smilies(decode_bbcode(stripslashes($comment), 1, true))));
    $comment = check_words(stripslashes(check_html($comment, 'nohtml')));
    if (!isset($pid) || !isset($pollID)) {
        echo ""._NOTRIGHT."";
        exit();
    }
    echo "<strong>$subject</strong>";
    echo "<br /><span class=\"content\">"._BY." ";
    if (is_user()) {
      echo UsernameColor($userinfo['username']);
    } else {
      echo _ANONYMOUS;
    }
    echo " "._ONN."</span><br /><br />";
    if ($posttype=="exttrans") {
        echo nl2br(htmlspecialchars($comment));
    } elseif ($posttype=="plaintext") {
        echo nl2br($comment);
    } else {
        echo $comment_show;
    }
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" name=\"commentpreview\" method=\"post\">";
    echo "<span class=\"option\"><strong>"._YOURNAME.":</strong></span> ";
    if (is_user()) {
        echo "<a href=\"modules.php?name=Your_Account\">".$userinfo['username']."</a>&nbsp;<span class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</span><br /><br />";
    } else {
        echo "<span class=\"content\">"._ANONYMOUS."<br /><br />";
    }
    echo "<span class=\"option\"><strong>"._SUBJECT.":</strong></span><br />"
    ."<input type=\"text\" name=\"subject\" size=\"50\" maxlength=\"85\" value=\"$subject\" /><br /><br />"
    ."<span class=\"option\"><strong>"._UCOMMENT.":</strong></span><br />";
    echo Make_TextArea('comment',$comment, 'commentpreview', '100%', '150px');
    echo "<br />";
    if (($xanonpost) AND ($evoconfig['anonpost'] == 1)){
        echo "<input type=\"checkbox\" name=\"xanonpost\" checked /> "._POSTANON."<br />";
    } elseif ((is_user()) AND ($evoconfig['anonpost'] == 1)) {
        echo "<input type=\"checkbox\" name=\"xanonpost\" /> "._POSTANON."<br />";
    }
    echo "<input type=\"hidden\" name=\"pid\" value=\"$pid\" />"
        ."<input type=\"hidden\" name=\"pollID\" value=\"$pollID\" />"
        ."<input type=\"hidden\" name=\"mode\" value=\"$mode\" />"
        ."<input type=\"hidden\" name=\"order\" value=\"$order\" />"
        ."<input type=\"hidden\" name=\"thold\" value=\"$thold\" />"
        ."<input type=submit name=op value=\""._PREVIEW."\" />"
        ."<input type=submit name=op value=\""._OK."\" />\n"
        ."<select name=\"posttype\"><option value=\"exttrans\"";
    if ($posttype=="exttrans") {
        echo " selected";
    }
    echo ">"._EXTRANS."</option>\n"
    ."<OPTION value=\"html\"";;
    if ($posttype=="html") {
        echo " selected";
    }
    echo ">"._HTMLFORMATED."</option>\n"
    ."<OPTION value=\"plaintext\"";
    if (($posttype!="exttrans") && ($posttype!="html")) {
        echo " selected";
    }
    echo ">"._PLAINTEXT."</option></select></span></form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function CreateTopic ($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype) {
    global $module_name, $userinfo, $EditedMessage, $AllowableHTML, $evoconfig, $db;

    if (!isset($mode) OR empty($mode)) {
      if(isset($userinfo['umode'])) {
        $mode = $userinfo['umode'];
      } else {
        $mode = "thread";
      }
    }
    if (!isset($order) OR empty($order)) {
      if(isset($userinfo['uorder'])) {
        $order = $userinfo['uorder'];
      } else {
        $order = 0;
      }
    }
    if (!isset($thold) OR empty($thold)) {
      if(isset($userinfo['thold'])) {
        $thold = $userinfo['thold'];
      } else {
        $thold = 0;
      }
    }
    $author     = Fix_Quotes($author);
    $subject    = Fix_Quotes(filter_text($subject, 'nohtml'));
    $comment    = format_url($comment);
    if($posttype == 'exttrans') {
        $comment = Fix_Quotes(nl2br(htmlspecialchars(check_words($comment))));
    } elseif($posttype == 'plaintext') {
        $comment = Fix_Quotes(nl2br(filter_text($comment)));
    } else {
        $comment = Fix_Quotes(filter_text($comment));
    }
    if ((is_user()) && (!$xanonpost)) {
        $name   = $userinfo['username'];
        $email  = $userinfo['femail'];
        $url    = $userinfo['user_website'];
        $score  = 1;
    } else {
        $name   = ''; $email = ''; $url = '';
        $score  = 0;
    }
    $ip = identify::get_ip();
    $comment = trim($comment);
    $pid = ($pid > 0 ) ? $pid : 0;
    $result = $db->sql_query("select count(*) from "._POLL_DESC_TABLE." where pollID='$pollID'");
    $fake = $db->sql_numrows($result);
    if (($evoconfig['pollcomm'] == 1) && ($fake == 1)) {
        if (((($evoconfig['anonpost'] == 0) AND (is_user())) OR ($evoconfig['anonpost'] == 1))) {
            $db->sql_query('INSERT INTO `'._POLL_COMMENTS_TABLE.'` (`tid`, `pid`, `pollID`, `date`, `name`, `email`, `url`, `host_name`, `subject`, `comment`, `score`, `reason`)
                      VALUES (NULL, "'.$pid.'", "'.$pollID.'", now(), "'.$name.'", "'.$email.'", "'.$url.'", "'.$ip.'", "'.$subject.'", "'.$comment.'", "'.$score.'","0")');
        } else {
            echo 'Nice try...';
            exit;
        }
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        echo "According to my records, the topic you are trying "
            ."to reply to does not exist. If you're just trying to be "
            ."annoying, well then too bad.";
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
    if (!empty($userinfo['umode'])) { $options .= "&amp;mode=".$userinfo['umode']; } else { $options .= "&amp;mode=thread"; }
    if (!empty($userinfo['uorder'])) { $options .= "&amp;order=".$userinfo['uorder']; } else { $options .= "&amp;order=0"; }
    if (!empty($userinfo['thold'])) { $options .= "&amp;thold=".$userinfo['thold']; } else { $options .= "&amp;thold=0"; }
    redirect("modules.php?name=$module_name&amp;pollID=$pollID$options");
}

if (!defined('IN_SURVEY')) {
    $op         = $_GETVAR->get('op', '_REQUEST');
    $pid        = $_GETVAR->get('pid', '_REQUEST');
    $pollID     = $_GETVAR->get('pollID', '_REQUEST');
    $tid        = $_GETVAR->get('tid', '_REQUEST');
    $mode       = $_GETVAR->get('mode', '_REQUEST');
    $order      = $_GETVAR->get('order', '_REQUEST');
    $thold      = $_GETVAR->get('thold', '_REQUEST');
    $subject    = $_GETVAR->get('subject', '_REQUEST');
    $comment    = $_GETVAR->get('comment', '_REQUEST');
    $xanonpost  = $_GETVAR->get('xanonpost', '_REQUEST');
    $order      = $_GETVAR->get('order', '_REQUEST');
    $posttype   = $_GETVAR->get('posttype', '_REQUEST');
    $host_name  = $_GETVAR->get('host_name', '_REQUEST');
    $tdw        = $_GETVAR->get('dkn', '_POST', 'array');
} else {
    global $pollID, $pid, $tid, $mode, $order, $thold;
}

switch($op) {
    case 'Reply':
        reply($pid, $pollID, $mode, $order, $thold);
        break;
    case _PREVIEW:
        replyPreview ($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype);
        break;
    case _OK:
        CreateTopic($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype);
        break;
    case 'moderate':
        if(!is_mod_admin($module_name)) {
           include_once(NUKE_BASE_DIR.'mainfile.php');
        }
        if((is_mod_admin($module_name)) || ($evoconfig['moderate']==2)) {
            while(list($tdw, $emp) = each($HTTP_POST_VARS)) {
            if (preg_match("#dkn#i",$tdw)) {
                $emp = explode(":", $emp);
                if($emp[1] != 0) {
                $tdw = preg_replace("#dkn#i", "", $tdw);
                $q = 'UPDATE `'._POLL_COMMENTS_TABLE.'` SET ';
                if(($emp[1] == 9) && ($emp[0]>=0)) { # Overrated
                    $q .= ' `score`=`score`-1 WHERE `tid`='.$tdw.'';
                } elseif (($emp[1] == 10) && ($emp[0]<=4)) { # Underrated
                    $q .= ' `score`=`score`+1 WHERE `tid`='.$tdw.'';
                } elseif (($emp[1] > 4) && ($emp[0]<=4)) {
                    $q .= ' `score`=`score`+1, `reason`="'.$emp[1].'" WHERE `tid`='.$tdw.'';
                } elseif (($emp[1] < 5) && ($emp[0] > -1)) {
                    $q .= ' `score`=`score`-1, `reason`="'.$emp[1].'" WHERE `tid`='.$tdw.'';
                } elseif (($emp[0] == -1) || ($emp[0] == 5)) {
                    $q .= ' `reason`="'.$emp[1].'" WHERE `tid`='.$tdw.'';
                }
                if(strlen($q) > 20) $db->sql_query($q);
                }
            }
            }
        }
        redirect("modules.php?name=$module_name&pollID=$pollID&mode=$mode&order=$order&thold=$thold");
        break;
    case 'showreply':
        DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
         break;
    default:
        if ((isset($tid)) && (!isset($pid))) {
            singlecomment($tid, $pollID, $mode, $order, $thold);
        } else {
            if(!isset($pid)) $pid=0;
            DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
        }
        break;
}

?>