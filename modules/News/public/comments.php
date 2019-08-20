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

function ModuleNewsCommentModone() {
    global $admin, $evoconfig, $module_name, $acomm;

    if ($acomm['moderate']) {
        echo "<form action='modules.php?name=".$module_name."&amp;op=comments' method='post'>";
    }
}

function ModuleNewsCommentModtwo($tid, $score, $reason) {
    global $evoconfig, $module_name;

    if(((is_mod_admin($module_name)) && ($evoconfig['moderate'] == 1)) || (($evoconfig['moderate'] == 2) && (is_user()))) {
        echo "&nbsp;|&nbsp;<select name='dkn".$tid."'>\n";
        $reason_count = $evoconfig['reasons'];
        for($i=0; $i < $reason_count; $i++) {
            $selected = ($reason == $i ? "selected='selected'" : '');
            echo "<option value='".$score.":".$i."' ".$selected.">".$evoconfig['reasons'][$i]."</option>\n";
        }
        echo "</select>\n";
    }
}

function ModuleNewsCommentModthree($sid) {
    global $evoconfig, $module_name, $display_ary;

    if(((is_mod_admin($module_name)) && ($evoconfig['moderate'] == 1)) || (($evoconfig['moderate']==2) && (is_user()))) {
        echo "<span style='text-align:center;'><input type='hidden' name='sid' value='".$sid."' /></span>\n";
        echo "<input type='hidden' name='umode' value='".$display_ary['umode']."' />\n";
        echo "<input type='hidden' name='order' value='".$display_ary['order']."' />\n";
        echo "<input type='hidden' name='thold' value='".$display_ary['thold']."' />\n";
        echo "<input type='hidden' name='op' value='moderate' />";
        echo "<span style='text-align:center;'><input type='submit' value='"._NE_MODERATE."' /></span></form>";
    }
}

function ModuleNewsCommentOutput($row) {
    global $db, $module_name, $evoconfig;

    $r['tid']        = intval($row['tid']);
    $r['pid']        = intval($row['pid']);
    $r['sid']        = intval($row['sid']);
    $r['datetime']   = formatTimestamp($row['date']);
    $r['c_name']     = (empty($row['name']) ? _ANONYMOUS : EvoKernel_HtmlEntities($row['name']));
    $r['color_name'] = UsernameColor($r['c_name']);
    $r['email']      = (empty($row['email']) ? '' : $row['email']);
    $r['host_name']  = $row['host_name'];
    $r['subject']    = (!empty($row['subject']) ? EvoKernel_HtmlEntities(check_words(check_html($row['subject'], 'nohtml')), ENT_NOQUOTES) : '[&nbsp;'._NOSUBJECT.'&nbsp;]');
    $r['comment']    = check_words(set_smilies(decode_bbcode($row['comment'], 1, true)));
    $r['comment']    = evo_img_tag_to_resize($r['comment']);
    $r['commentcount'] = strlen($row['comment']);
    $r['score']      = intval($row['score']);
    $r['reason']     = intval($row['reason']);
    if ($r['c_name'] != _ANONYMOUS) {
        $r['uid']    = get_user_field('user_id', $r['c_name'], true);
        $r['url']    = get_user_field('user_website', $r['c_name'], true);
    } else {
        $r['uid'] = ANONYMOUS;
        $r['url'] = '';
    }
    return $r;
}

function ModuleNewsCommentNavbar($sid, $count) {
    global $evoconfig, $db, $module_name, $ThemeInfo, $artinfo;

    OpenTable();
    echo "<a id='commentsnavbar'></a>\n";
    echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>\n";
    if ($artinfo['title'] != '') {
        echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><div class='content' style='text-color:".$ThemeInfo['textcolor1'].";'>'".$artinfo['title']."'<br />";
        if(is_user()) {
            echo "<a href='modules.php?name=Your_Account&amp;op=editcomm'><span style='text-color:".$ThemeInfo['textcolor1'].";'>"._CONFIGURE."</span></a>";
        } else {
            echo "<a href='modules.php?name=Your_Account'><span style='text-color:".$ThemeInfo['textcolor1'].";'>"._LOGINCREATE."</span></a>";
        }
        echo "&nbsp;|&nbsp;<span style='text-weight:bold;'>".$count."</span>&nbsp;".($count == 1 ? _COMMENT : _COMMENTS);
        if ($count > 0 AND is_active('Search')) {
            echo "&nbsp;|&nbsp;<a href='modules.php?name=Search&amp;type=comments&amp;sid=".$sid."'>"._SEARCHDIS."</a>";
        }
        echo "</div></td></tr>\n";
    }
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align='center' width='100%'>\n";
    if ($evoconfig['anonpost'] || is_mod_admin($module_name) || is_user()) {
        echo "<form action='modules.php?name=".$module_name."&amp;op=comments' method='post'>";
        echo "<input type='hidden' name='sid' value='".$sid."' />\n";
        echo "<input type='hidden' name='mode' value='Reply' />\n";
        echo "<input type='submit' value='"._REPLYMAIN."' /></form>\n";
    }
    echo "</td></tr><tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><span class='tiny'><img src='".evo_image('information.png', $module_name)."' width='16' height='16' border='0' alt='' /> "._COMMENTSWARNING."</span></td></tr>\n";
    echo "</table>\n";
    if ($evoconfig['anonpost'] == 0 AND !is_user()) {
        echo "<br />";
        OpenTable2();
        echo "<div style='text-align:center;'>"._NOANONCOMMENTS."</div>\n";
        CloseTable2();
    }
    CloseTable();
}

function ModuleNewsCommentDisplayKids($tid, $level=0, $dummy=0, $tblwidth=100) {
    global $ThemeInfo, $evoconfig, $db, $module_name, $userinfo, $display_ary, $display, $acomm;

    $comments = 0;
    $result1  = $db->sql_query('SELECT * FROM `'._COMMENTS_TABLE.'` WHERE `pid`='.$tid.' ORDER BY `date`, `tid`');
    $numresults = $db->sql_numrows($result1);
    if ($numresults > 0) {
        if ($display_ary['umode'] != 'flat') {
            if ($level == 0) {
                if ($display_ary['umode'] != 'nested') {
                    echo "<div><ul>\n";
                } else {
                    echo "<table id='comment".$level.$tid."' border='0' bgcolor='".$ThemeInfo['bgcolor1']."'>\n<tr>\n<td>\n";
                }
                $tblwidth -= 5;
            }
        }
        while($row = $db->sql_fetchrow($result1)) {
            $cinfo = ModuleNewsCommentOutput($row);
            $r_bgcolor = ($dummy%2) ? '' : $ThemeInfo['bgcolor1'];
            if($cinfo['score'] >= $display_ary['thold']) {
                if ($display_ary['umode'] != 'flat') {
                    if ($level > 0 && $comments == 0) {
                        if ($display_ary['umode'] != 'nested') {
                            echo "<ul>\n";
                        } else {
                            echo "<table width='100%'>\n<tr>\n<td width='".(100 - $tblwidth)."%'></td><td width='".$tblwidth."%' bgcolor='".$ThemeInfo['bgcolor2']."'>\n";
                        }
                        $tblwidth -= 5;
                    }
                }
                $comments++;
                if ($display_ary['umode'] == 'flat') {
                    echo "<hr />\n";
                }
                if ($display_ary['umode'] == 'flat' || $display_ary['umode'] == 'nested') {
                    echo "<table id='comment".$cinfo['tid']."' border='0'>\n<tr>\n<td>\n";
                    echo "<strong>".$cinfo['subject']."</strong>&nbsp;<span class='content'>";
                    if ($userinfo['noscore'] == 0) {
                        echo "<br />("._SCORE."&nbsp;".$cinfo['score'];
                        if ( $cinfo['reason'] > 0 ) {
                            echo ",&nbsp;".$evoconfig['reasons'][$cinfo['reason']];
                        }
                        echo ")";
                    }
                    if ($cinfo['email']) {
                        echo "<br />"._BY."&nbsp;<a href='mailto:".$cinfo['email']."'>".$cinfo['color_name']."</a>&nbsp;<span class='content'><strong>(".$cinfo['email'].")</strong></span>&nbsp;"._ON."&nbsp;".$cinfo['datetime'];
                    } else {
                        echo "<br />"._BY."&nbsp;".$cinfo['color_name']."&nbsp;"._ON."&nbsp;".$cinfo['datetime'];
                    }
                    if ($cinfo['uid'] != ANONYMOUS) {
                        $url = $cinfo['url'];
                        if ($url != "http://" AND $url != "" AND preg_match("#http://#i", $url)) {
                            echo "<br />(<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$cinfo['c_name']."'>"._USERINFO."</a>&nbsp;|&nbsp;<a href='modules.php?name=Private_Messages&amp;mode=post&amp;u=".$cinfo['uid']."'>"._SENDAMSG."</a>&nbsp;|&nbsp;";
                            echo "<a href='".$url."' target='new'>"._NE_WEBSITE."</a> )";
                        } else {
                            echo "<br />(<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$cinfo['c_name']."'>"._USERINFO."</a>&nbsp;|&nbsp;<a href='modules.php?name=Private_Messages&amp;mode=post&amp;u=".$cinfo['uid']."'>"._SENDAMSG."</a>&nbsp;)&nbsp;";
                        }
                        echo "</span></td></tr><tr><td>";
                    }
                    if((isset($userinfo['commentmax'])) && ($cinfo['commentcount'] > $userinfo['commentmax'])) {
                        echo substr($cinfo['comment'], 0, $userinfo['commentmax'])."<br /><br /><strong><a href='modules.php?name=".$module_name."&amp;op=comments&amp;sid=".$cinfo['sid']."&amp;tid=".$cinfo['tid'].$display."'>"._READREST."</a></strong>";
                    } elseif ($cinfo['commentcount'] > $evoconfig['commentlimit']) {
                        echo substr($cinfo['comment'], 0, $evoconfig['commentlimit'])."<br /><br /><strong><a href='modules.php?name=".$module_name."&amp;op=comments&amp;sid=".$cinfo['sid']."&amp;tid=".$cinfo['tid'].$display."'>"._READREST."</a></strong>";
                    } else {
                        echo $cinfo['comment'];
                    }
                    echo "</td>\n</tr>\n</table>\n<br /><br />";
                    if ($acomm['allowed']) {
                        echo "<span class='content' >[&nbsp;<a href='modules.php?name=".$module_name."&amp;op=comments&amp;mode=Reply&amp;pid=".$cinfo['tid']."&amp;sid=".$cinfo['sid'].$display."'>"._REPLY."</a>";
                    }
                    ModuleNewsCommentModtwo($cinfo['tid'], $cinfo['score'], $cinfo['reason']);
                    echo "&nbsp;]</span><br /><br />";
                    if ($display_ary['umode'] != 'flat') {
                        ModuleNewsCommentDisplayKids($cinfo['tid'], $level+1, $dummy+1, $tblwidth);
                    } else {
                        ModuleNewsCommentDisplayKids($cinfo['tid']);
                    }
                } else {
                    echo "<li><span id='comment".$cinfo['tid']."' class='content' style='text-color:".$ThemeInfo['textcolor2'].";'><a href='modules.php?name=".$module_name."&amp;op=article&amp;mode=showreply&amp;tid=".$cinfo['tid']."&amp;sid=".$cinfo['sid']."&amp;pid=".$cinfo['pid'].$display."#".'comment'.$cinfo['tid']."'>".$cinfo['subject']."</a>&nbsp;"._BY."&nbsp;".$cinfo['color_name']." "._ON."&nbsp;".$cinfo['datetime']."</span>\n";
                    ModuleNewsCommentDisplayKids($cinfo['tid'], $level+1, $dummy+1);
                    echo "</li>\n";
                }
                if ($display_ary['umode'] != 'flat') {
                    if ($level > 0 && $comments > 0) {
                        if ($display_ary['umode'] != 'nested') {
                            echo "</ul>\n";
                        } else {
                            echo "</td>\n</tr>\n</table>\n";
                        }
                    }
                }
            }
        }
        $db->sql_freeresult($result1);
        if ($display_ary['umode'] != 'flat') {
            if ($level == 0) {
                if ($display_ary['umode'] == 'nested') {
                    echo "</td>\n</tr>\n</table>\n<br /><br />";
                } else {
                    echo "</ul></div>\n";
                }
            }
        }
    }
}

function ModuleNewsCommentDisplayBabies ($tid, $level=0, $dummy=0) {
    global $datetime, $db, $module_name, $display;

    $comments = 0;
    $result = $db->sql_query("SELECT * FROM "._COMMENTS_TABLE." WHERE pid='".$tid."' ORDER BY date, tid");
    $countrows = $db->sql_numrows($result);
    if ($countrows > 0 ) {
        while ($row = $db->sql_fetchrow($result)) {
            $cinfo = ModuleNewsCommentOutput($row);
            if ($level > 0) {
                if ($comments == 0) {
                    echo "<ul>";
                }
            }
            $comments++;
            echo "<a href='modules.php?name=".$module_name."&amp;op=article&amp;mode=showreply&amp;tid=".$cinfo['tid'].$display."'>".$cinfo['subject']."</a></span><span class='content'>&nbsp;"._BY."&nbsp;".$cinfo['color_name']."&nbsp;"._ON."&nbsp;".$cinfo['datetime']."<br />";
            ModuleNewsCommentDisplayBabies($cinfo['tid'], $level+1, $dummy+1);
        }
        if ( $level > 0 && $comments > 0) {
            echo "</ul>";
        }
    }
    $db->sql_freeresult($result);
}

function ModuleNewsCommentDisplayTopic($sid, $pid=0) {
    global $evoconfig, $db, $module_name, $admin_file, $userinfo, $display_ary, $display, $acomm, $artinfo, $ThemeInfo;

    $tid    = 0;
    $umode  = 'thread';
    $level  = 0;
    $nokids = 0;
    $c      = array();
    $c['subject'] = '';
    $sql    = 'SELECT * FROM `'._COMMENTS_TABLE.'` WHERE `sid`="'.$sid.'" AND `pid`="'.$pid.'"';
    if($display_ary['thold'] != 0 ) {
        $sql .= ' AND `score`>="'.$thold.'" ';
    }
    $sql .= ($display_ary['order'] == 1 ? ' ORDER BY `date` DESC' : ' ORDER BY `score` DESC');
    $something = $db->sql_query($sql);
    $num_tid   = $db->sql_numrows($something);
    if ($pid == 0) {
        ModuleNewsCommentNavbar($sid, $num_tid);
    }
    ModuleNewsCommentModone();
    while ($row_q = $db->sql_fetchrow($something)) {
        echo "<br />";
        OpenTable();
        $c = ModuleNewsCommentOutput($row_q);
        echo "<a id='comment".$c['tid']."'></a>\n";
        echo "<table width='100%' border='0'>\n<tr bgcolor='".$ThemeInfo['bgcolor1']."'>\n";
        echo "<td width='50%'>\n";
        echo "<span style='font-weight:bold;'>".$c['subject']."</span>\n<span class='content'>";
        if($userinfo['noscore'] == 0) {
             echo "<br />("._SCORE."&nbsp;".$c['score'];
             if ( $c['reason'] > 0 ) {
                 echo ",&nbsp;".$evoconfig['reasons'][$reason];
             }
             echo ")";
        }
        if ($c['email']) {
             echo "<br />"._BY."&nbsp;<a href='mailto:".$c['email']."'>".UsernameColor($c['c_name'])."</a>&nbsp;<span style='font-weight:bold;'>(".$c['email'].")</span>&nbsp;"._ON."&nbsp;".$c['datetime'];
        } else {
            echo "<br />"._BY."&nbsp;".UsernameColor($c['c_name'])."&nbsp;"._ON."&nbsp;".$c['datetime'];
        }
        if ($c['uid'] != ANONYMOUS) {
            $url  = $c['url'];
            echo "<br />(<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$c['c_name']."'>"._USERINFO."</a>&nbsp;|&nbsp;<a href='modules.php?name=Private_Messages&amp;mode=post&amp;u=".$c['uid']."'>"._SENDAMSG."</a>\n";
            if ($url != "http://" AND $url != "" AND preg_match("#http://#i", $url)) {
                echo "&nbsp;|&nbsp;<a href='".$url."' target='new'>"._NE_WEBSITE."</a>&nbsp;)\n";
            } else {
                echo '&nbsp;)';
            }
        }
        if(is_mod_admin($module_name)) {
            echo "<br /><span style='font-weight:bold;'>(IP:&nbsp;".$c['host_name']."&nbsp;)</span>\n";
        }
        echo "</span>\n</td>\n</tr>\n";
        echo "<tr>\n<td width='50%'>\n";
        if((isset($userinfo['commentmax'])) && (isset($c['comment']) && $c['commentcount'] > $userinfo['commentmax'])) {
            echo substr($c['comment'], 0, $userinfo['commentmax'])."<br /><br />\n";
            $tolong = 1;
        } elseif ($c['commentcount'] > $evoconfig['commentlimit']) {
            echo substr($comment, 0, $evoconfig['commentlimit'])."<br /><br />\n";
            $tolong = 1;
        } else {
            $tolong = 0;
        }
        echo ($tolong == 0 ? $c['comment'] : "<span style='font-weight:bold;'><a href='modules.php?name=".$module_name."&amp;op=comments&amp;sid=".$c['sid']."&amp;tid=".$c['tid'].$display.">"._READREST."</a></span>");
        echo "</td>\n</tr>\n";
        echo "</table>\n<br /><br />";
        if ($acomm['allowed']) {
            echo "<span class='content'>&nbsp;[&nbsp;<a href='modules.php?name=".$module_name."&amp;op=comments&amp;mode=Reply&amp;pid=".$c['tid']."&amp;sid=".$c['sid'].$display."'>"._REPLY."</a>\n";
        }
        if ($c['pid'] != 0) {
            $row4 = $db->sql_fetchrow($db->sql_query("SELECT pid FROM "._COMMENTS_TABLE." WHERE tid='".$c['pid']."'"));
            $erin = intval($row4['pid']);
            echo "&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=article&amp;sid=".$sid."&amp;pid=".$erin.$display."'>"._PARENT."</a>\n";
        }
        ModuleNewsCommentModtwo($c['tid'], $c['score'], $c['reason']);
        if(is_mod_admin($module_name)) {
            echo "&nbsp;|&nbsp;<a href='".$admin_file.".php?op=RemoveComment&amp;tid=".$c['tid']."&amp;sid=".$c['sid']."'>"._DELETE."</a>&nbsp;]</span>\n<br /><br />";
        } elseif ($acomm['allowed']) {
            echo "&nbsp;]</span>\n<br /><br />";
        }
        ModuleNewsCommentDisplayKids($c['tid'], $level);
        CloseTable();
    }
    $db->sql_freeresult($something);
    if ( $num_tid > 0 ) {
        ModuleNewsCommentModthree($sid);
    }
    if ($pid != 0) {
        return array($sid, $pid, $c['subject']);
    } elseif ( defined('NEWS_INDEX_FILE') ) {
        return;
    } else {
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function ModuleNewsCommentSingle($tid, $sid) {
    global $module_name, $ThemeInfo, $evoconfig, $db, $display, $display_ary, $acomm;
    include_once(NUKE_BASE_DIR.'header.php');

    $sql = $db->sql_query("SELECT * FROM "._COMMENTS_TABLE." WHERE tid='".$tid."' AND sid='".$sid."'");
    $row = $db->sql_fetchrow($sql);
    $c   = ModuleNewsCommentOutput($row);
    $num_tid = $db->sql_numrows($sql);
    $db->sql_freeresult($sql);
    $titlebar = "<strong>".$c['subject']."</strong>";
    ModuleNewsCommentModone();
    OpenTable();
    echo "<table width='99%' border='0'><tr bgcolor='".$ThemeInfo['bgcolor1']."'><td width='50%'>";
    if($c['email']) {
        echo "<strong>".$c['subject']."</strong>&nbsp;<span class='content' style='text-color:".$ThemeInfo['textcolor2'].";'>("._SCORE."&nbsp;".$c['score'].")<br />"._BY."&nbsp;<a href='mailto:".$c['email']."'></span><span style='background-color:".$ThemeInfo['bgcolor2'].";'>".$c['color_name']."</span></a>&nbsp;<span class='content'><strong>(".$c['email'].")</strong></span>&nbsp;"._ON."&nbsp;".$c['datetime']."</span>";
    } else {
        echo "<strong>".$c['subject']."</strong>&nbsp;<span class='content'>("._SCORE."&nbsp;".$c['score'].")<br />"._BY."&nbsp;".$c['color_name']."&nbsp;"._ON."&nbsp;".$c['datetime']."</span>";
    }
    echo "</td></tr><tr><td>".$c['comment']."</td></tr></table><br /><br />";
    if ( $acomm['allowed'] ) {
        echo "<span class='content'>&nbsp;[&nbsp;<a href='modules.php?name=".$module_name."&amp;op=comments&amp;mode=Reply&amp;pid=".$tid."&amp;sid=".$sid.$display."'>"._REPLY."</a>&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=article&amp;sid=".$sid.$display."'>"._ROOT."</a></span>";
    }
    ModuleNewsCommentModtwo($tid, $score, $reason);
    echo "&nbsp;]";
    if ( $num_tid > 0 ) {
        ModuleNewsCommentModthree($sid);
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function ModuleNewsCommentReply($pid=0, $sid=0) {
    include_once(NUKE_BASE_DIR.'header.php');
    global $userinfo, $module_name, $ThemeInfo, $db, $evoconfig, $display_ary, $acomm;

    if ( !$acomm['allowed'] ) {
        OpenTable();
        echo "<center><span class='title'><strong>"._COMMENTREPLY."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center>"._NOANONCOMMENTS."<br /><br />"._GOBACK."</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        if ($pid != 0) {
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM "._COMMENTS_TABLE." WHERE tid='".$pid."'"));
            $c   = ModuleNewsCommentOutput($row);
        } elseif ($sid != 0) {
            $row2     = $db->sql_fetchrow($db->sql_query("SELECT time, title, hometext, bodytext, informant, notes FROM "._STORIES_TABLE." WHERE sid='".$sid."'"));
            $c['datetime']= formatTimestamp($row2['time']);
            $c['subject'] = check_words(stripslashes(check_html($row2['title'], 'nohtml')));
            $temp_comment = check_words(set_smilies(decode_bbcode(stripslashes($row2['hometext']), 1, true)));
            $temp_comment = evo_img_tag_to_resize($temp_comment);
            $comment2     = set_smilies(decode_bbcode(stripslashes($row2['bodytext']), 1, true));
            $comment2     = evo_img_tag_to_resize($comment2);
            $c['name']    = (!empty($row2['informant']) ? stripslashes($row2['informant']) : _ANONYMOUS);
            $c['color_name'] = UsernameColor($c['name']);
            $c['email']   = '';
            $c['notes']   = stripslashes($row2['notes']);
            $c['comment'] = $temp_comment."<br /><br />".$comment2;
        } elseif ( ($pid == 0) && ($sid == 0)) {
            echo "Something is not right. This message is just to keep things from messing up down the road";
            exit();
        }
        OpenTable();
        echo "<center><span class='title'><strong>"._COMMENTREPLY."</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        if ($pid == 0) {
            $row3 = $db->sql_ufetchrow("SELECT title FROM "._STORIES_TABLE." WHERE sid='".$sid."'");
            $c['subject'] = check_words(stripslashes(check_html($row3['title'], 'nohtml')));
        }
        echo "<strong>".$c['subject']."</strong><span class='content'>";
        if ( isset($c['score']) ) {
            echo"<br />("._SCORE."&nbsp;".$c['score'].")";
        }
        if (!empty($c['email'])) {
            echo "<br />"._BY."&nbsp;<a href='mailto:".$c['email']."'>".$c['color_name']."</a>&nbsp;<span class='content'><strong>(".$c['email'].")</strong></span>&nbsp;"._ON."&nbsp;".$c['datetime'];
        } else {
            echo "<br />"._BY."&nbsp;".$c['color_name']."&nbsp;"._ON."&nbsp;".$c['datetime'];
        }
        echo "<br /><br />".$c['comment']."<br /><br />";
        if ($pid == 0) {
            if (isset($c['notes']) && !empty($notes)) {
                echo "<strong>"._NOTE."</strong><em>".$c['notes']."</em><br /><br />";
            }
        }
        echo "</span>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<form action='modules.php?name=".$module_name."&amp;op=comments' name='commentreply' method='post'>";
        echo "<span class='option'><strong>"._YOURNAME.":</strong></span> ";
        if (is_user()) {
            echo "<span class='content'><a href='modules.php?name=Your_Account'>".$userinfo['username']."</a>&nbsp;[&nbsp;<a href='modules.php?name=Your_Account&amp;op=logout'>"._LOGOUT."</a>&nbsp;]</span><br /><br />";
        } else {
            echo "<span class='content'>"._ANONYMOUS."";
            echo "&nbsp;[&nbsp;<a href='modules.php?name=Your_Account'>"._NEWUSER."</a>&nbsp;]</span><br /><br />";
        }
        echo "<span class='option'><strong>"._SUBJECT.":</strong></span><br />";
        if (!preg_match("#Re:#i",$c['subject'])) {
            $subject = "Re:&nbsp;".substr($c['subject'],0,81);
        }
        echo "<input type='text' name='subject' size='50' maxlength='85' value='".$c['subject']."' /><br /><br />";
        echo "<span class='option'><strong>"._UCOMMENT.":</strong></span><br />";
        echo Make_TextArea('comment','', 'commentreply');
        echo "<br />";
        if (is_user() AND ($evoconfig['anonpost'] == 1)) {
            echo "<input type='checkbox' name='xanonpost' /> "._POSTANON."<br />";
        }
        echo "<input type='hidden' name='pid' value='".$pid."' />\n"
            ."<input type='hidden' name='sid' value='".$sid."' />\n"
            ."<input type='hidden' name='umode' value='".$display_ary['umode']."' />\n"
            ."<input type='hidden' name='order' value='".$display_ary['order']."' />\n"
            ."<input type='hidden' name='thold' value='".$display_ary['thold']."' />\n"
            ."<input type='submit' name='CommentPreview' value='"._PREVIEW."' />\n"
            ."<input type='submit' name='CommentSubmit' value='"._OK."' />\n"
            ."<input type='hidden' name='posttype' value='html' />\n"
            ."</form>\n";
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
}

function ModuleNewsCommentReplyPreview ($pid, $sid, $subject, $comment, $xanonpost, $posttype) {
    include_once(NUKE_BASE_DIR.'header.php');
    global $module_name, $userinfo, $evoconfig, $display_ary;

    OpenTable();
    echo "<center><span class='title'><strong>"._COMREPLYPRE."</strong></span></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    $subject = check_words(stripslashes(check_html($subject, 'nohtml')));
    $comment_show = evo_img_tag_to_resize(check_words(set_smilies(decode_bbcode(stripslashes($comment), 1, true))));
    $comment = check_words(stripslashes(check_html($comment, 'nohtml')));
    if (!isset($pid) || !isset($sid)) {
        echo _NOTRIGHT;
        exit();
    }
    echo "<strong>".$subject."</strong>";
    echo "<br /><span class='content'>"._BY." ";
    if (is_user()) {
        echo UsernameColor($userinfo['username']);
    } else {
        echo _ANONYMOUS;
    }
    echo "&nbsp;"._ONN."</span><br /><br />";
    echo $comment_show;
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<form action='modules.php?name=".$module_name."&amp;op=comments' name='commentpreview' method='post'>";
    echo "<span class='option'><strong>"._YOURNAME.":</strong></span> ";
    if (is_user()) {
        echo "<a href='modules.php?name=Your_Account'>".$userinfo['username']."</a>&nbsp;<span class='content'>[&nbsp;<a href='modules.php?name=Your_Account&amp;op=logout'>"._LOGOUT."</a>&nbsp;]</span><br /><br />";
    } else {
        echo "<span class='content'>"._ANONYMOUS."<br /><br /></span>";
    }
    echo "<span class='option'><strong>"._SUBJECT.":</strong></span><br />"
    ."<input type='text' name='subject' size='50' maxlength='85' value='".$subject."' /><br /><br />"
    ."<span class='option'><strong>"._UCOMMENT.":</strong></span><br />";
    echo Make_TextArea('comment',$comment, 'commentpreview', '100%', '150px');
    echo "<br />";
    if (($xanonpost) AND ($evoconfig['anonpost'] == 1)){
        echo "<input type='checkbox' name='xanonpost' checked />"._POSTANON."<br />";
    } elseif ((is_user()) AND ($evoconfig['anonpost'] == 1)) {
        echo "<input type='checkbox' name='xanonpost' />"._POSTANON."<br />";
    }
    echo "<input type='hidden' name='pid' value='".$pid."' />\n"
        ."<input type='hidden' name='sid' value='".$sid."' />\n"
        ."<input type='hidden' name='umode' value='".$display_ary['umode']."' />\n"
        ."<input type='hidden' name='order' value='".$display_ary['order']."' />\n"
        ."<input type='hidden' name='thold' value='".$display_ary['thold']."' />\n"
        ."<input type='submit' name='CommentPreview' value='"._PREVIEW."' />\n"
        ."<input type='submit' name='CommentSubmit' value='"._OK."' />\n"
        ."<input type='hidden' name='posttype' value='html' />\n"
        ."</form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function ModuleNewsCommentCreateTopic ($xanonpost, $subject, $comment, $pid, $sid, $host_name, $posttype) {
    global $module_name, $display, $userinfo, $evoconfig, $db, $acomm;

    if (is_user()) {
        $author = $userinfo['username'];
    } else {
        $author = _ANONYMOUS;
    }
    $subject    = Fix_Quotes(filter_text($subject, 'nohtml'));
    if (empty($subject) || empty($comment) || empty($author)) {
        DisplayError(_NE_NO_EMPTY_COMMENT);
        exit;
    }
    $comment = Fix_Quotes(filter_text($comment));
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
    $fakeresult = $db->sql_query('SELECT `acomm` FROM `'._STORIES_TABLE.'` WHERE `sid`='.$sid.'');
    $fake = $db->sql_numrows($fakeresult);
    $comment = trim($comment);
    $pid = ($pid > 0 ) ? $pid : 0;
    if ( $fake && $acomm['allowed'] ) {
        $fakerow = $db->sql_fetchrow($fakeresult);
        if ($acomm['allowed'] == $fakerow) {
            $db->sql_uquery('INSERT INTO `'._COMMENTS_TABLE.'` (`tid`, `pid`, `sid`, `date`, `name`, `email`, `url`, `host_name`, `subject`, `comment`, `score`, `reason`)
                      VALUES (NULL, "'.$pid.'", "'.$sid.'", now(), "'.$name.'", "'.$email.'", "'.$url.'", "'.$ip.'", "'.$subject.'", "'.$comment.'", "'.$score.'","0")');
            $numcomments = $db->sql_unumrows("SELECT date FROM "._COMMENTS_TABLE." WHERE sid = '".$sid."'");
            $db->sql_uquery('UPDATE `'._STORIES_TABLE.'` SET `comments`='.$numcomments.' WHERE `sid`='.$sid);
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
    $db->sql_freeresult($fakeresult);
    redirect('modules.php?name='.$module_name.'&amp;op=article&amp;sid='.$sid.$display);
}

function ModuleNewsCommentModerate() {
    global $db, $module_name, $evoconfig, $_GETVAR, $display;

    if((is_mod_admin($module_name)) || ($evoconfig['moderate']==2)) {
        while(list($tdw, $emp) = each($HTTP_POST_VARS)) {
            if (preg_match('#dkn#i',$tdw)) {
                $emp = explode(":", $emp);
                if($emp[1] != 0) {
                    $tdw = preg_replace('#dkn#i', '', $tdw);
                    $q = 'UPDATE `'._COMMENTS_TABLE.'` SET ';
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
                    if(strlen($q) > 20) {
                        $db->sql_uquery($q);
                    }
                }
            }
        }
    }
    redirect('modules.php?name='.$module_name.'&amp;op=article&amp;sid='.$sid.$display);
}

// testing if comments are allowed. If not - back to calling prog
if ($acomm['allowed']) {

    $mode       = $_GETVAR->get('mode', '_REQUEST', 'string', '');
    $pid        = $_GETVAR->get('pid', '_REQUEST', 'int', 0);
    $sid        = $_GETVAR->get('sid', '_REQUEST', 'int', 0);
    $tid        = $_GETVAR->get('tid', '_REQUEST', 'int', 0);
    $subject    = $_GETVAR->get('subject', '_REQUEST', 'string', '');
    $comment    = $_GETVAR->get('comment', '_REQUEST', 'string', '');
    $xanonpost  = $_GETVAR->get('xanonpost', '_REQUEST', 'int', 0);
    $posttype   = $_GETVAR->get('posttype', '_REQUEST', 'string', '');
    $host_name  = $_GETVAR->get('host_name', '_REQUEST', 'string', '');
    $tdw        = $_GETVAR->get('dkn', '_POST', 'array', array());
    $CommentPreview = $_GETVAR->get('CommentPreview', '_POST', 'string', '');
    $CommentSubmit  = $_GETVAR->get('CommentSubmit', '_POST', 'string', '');

    if (!empty($CommentPreview)) {
        $mode = 'CommentPreview';
    } elseif (!empty($CommentSubmit)) {
        $mode = 'CommentSubmit';
    }

    switch($mode) {
        case 'Reply':          ModuleNewsCommentReply($pid, $sid); break;
        case 'CommentPreview': ModuleNewsCommentReplyPreview($pid, $sid, $subject, $comment, $xanonpost, $posttype); break;
        case 'CommentSubmit':  ModuleNewsCommentCreateTopic($xanonpost, $subject, $comment, $pid, $sid, $host_name, $posttype); break;
        case 'moderate':       ModuleNewsCommentModerate(); break;
        case 'showreply':      ModuleNewsCommentDisplayTopic($sid, $pid); break;
        case 'SingleComment':  ModuleNewsCommentSingle($tid, $sid); break;
        case 'DisplayTopic':   ModuleNewsCommentDisplayTopic($sid, 0); break;
    }
}

?>