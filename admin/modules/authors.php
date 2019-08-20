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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$adminpoint = @basename(__FILE__,'.php');
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin;

if (is_god_admin() || is_admin('super')) {
    getmodule_lang($adminpoint);

    function out_header($headertext='', $showback=TRUE) {
        global $admin_file, $adminpoint, $lang_admin;

        include_once(NUKE_BASE_DIR . 'header.php');
        OpenTable();
        echo "<center><strong><font size='3'>".$lang_admin[$adminpoint]['HEAD_TITLE']."</font></strong></center><br /><br />";
        echo "<center><strong><a href='".$admin_file.".php'>".$lang_admin['KERNEL']['MAIN_BACK']."</a></strong></center><br />";
        CloseTable();
        OpenTable();
        echo "<center><span class='option'><strong>" .$headertext. "</strong></span></center><br />";
        if ($showback == TRUE) {
            echo "<center><span class='option'>[<a href='".$admin_file.".php?module=".$adminpoint."&amp;op=menue'>" .$lang_admin[$adminpoint]['HEAD_BACK']. "</a>]</span></center><br />";
        }
    }

    function out_footer() {
        CloseTable();
        include_once(NUKE_BASE_DIR . 'footer.php');
    }

    function menue() {
        global $admin_file, $adminpoint, $lang_admin;

        $menue_out = array();
        $menue_out[0] = array('title' => $lang_admin[$adminpoint]['MENUE_ADMIN_SHOW'], 'img' => 'adm_view.png', 'href' => 'showadmins');
        $menue_out[1] = array('title' => $lang_admin[$adminpoint]['MENUE_ADMIN_ADD'], 'img' => 'adm_add.png', 'href' => 'addadmin');
        $menue_out[2] = array('title' => $lang_admin[$adminpoint]['MENUE_ADMIN_PROMOTE'], 'img' => 'adm_promote.png', 'href' => 'promoteuser');
        out_header('', FALSE);
        echo "<div style='text-align: center;'>\n";
        $a = 0;
        echo "<table width='100%'><tr width='100%'>\n";
        foreach ($menue_out as $pos => $content) {
            echo "<td width='25%'><div class='menuepos' style='text-align: center;'>\n";
            echo "<a href='".$admin_file.".php?module=".$adminpoint."&amp;op=".$content['href']."'>";
            if (!empty($content['img'])) {
                echo "<img src='".evo_image($content['img'], 'admin/modules')."' alt='' title='".$content['title']."' width='32' height='32' /><br />";
            }
            echo $content['title'];
            echo "</a>";
            echo "</div></td>\n";
            if ($a == 4) { echo "</tr><tr width='100%'>"; $a=0;}
            $a++;
        }
        for ( $i=0; $i < $a; $i++) {
            echo "<td width='25%'></td>";
        }
        echo "</tr></table>\n";
        echo "</div>\n";
        out_footer();
    }

    function showadmins() {
        global $aid, $admin_file, $db, $adminpoint, $lang_admin, $textcolor1, $bgcolor1, $bgcolor2;;

        out_header($lang_admin[$adminpoint]['HEAD_SUBTITLE_MAIN']);
        echo "<div align='center'>\n";
        echo "<table align='center' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
        echo "<tr bgcolor='$bgcolor2'>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_USERNAME']."</strong></th>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_NAME']."</strong></th>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_EMAIL']."</strong></th>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_LANGUAGE']."</strong></th>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_SUPERUSER']."</strong></th>\n";
        echo "<th align='center' colspan='2'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_ACTION']."</strong></th>\n";
        echo "</tr>\n";
        $result = $db->sql_query("SELECT `aid`, `name`, `email`, `admlanguage`, `radminsuper` FROM " . _AUTHOR_TABLE);
        while ($row = $db->sql_fetchrow($result)) {
            $radminsuper = ((isset($row['radminsuper']) && $row['radminsuper'] == TRUE) ? $lang_admin[$adminpoint]['FIELD_ADMIN_YES'] : $lang_admin[$adminpoint]['FIELD_ADMIN_NO']);
            $admlanguage = (!isset($row['admlanguage']) ? $lang_admin[$adminpoint]['OPTION_ALL_LANGS'] : ucfirst($row['admlanguage']));
            echo "<tr bgcolor='$bgcolor1'>\n";
            echo "<td align='center'>".$row['aid']."</td>\n";
            echo "<td align='center'>".$row['name']."</td>\n";
            echo "<td align='center'>".$row['email']."</td>\n";
            echo "<td align='center'>".$admlanguage."</td>\n";
            echo "<td align='center'>".$radminsuper."</td>\n";
            echo "<td><form method='post' action='".$admin_file.".php'><select name='adminaction'>";
            echo "<option value=''>".$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SELECT']."</option>\n";
            if ($row['name'] == 'God' && is_god_admin()) {
                echo "<option value='showadmin'>".$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SHOW']."</option>\n";
                echo "<option value='changeadmin'>".$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_CHANGE']."</option>\n";
            } else {
                echo "<option value='showadmin'>".$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SHOW']."</option>\n";
                if ($row['aid'] == $aid || is_god_admin()) {
                    echo "<option value='changeadmin'>".$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_CHANGE']."</option>\n";
                }
                echo "<option value='deleteadmin'>".$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_DELETE']."</option>\n";
            }
            echo "</select>\n";
            echo "<input type='hidden' name='chng_aid' value='".$row['aid']."' />\n";
            echo "<input type='hidden' name='module' value = '".$adminpoint."' />\n";
            echo "<input type='hidden' name='op'     value = 'showadmins' />\n";
            echo "<input type='submit' value='".$lang_admin[$adminpoint]['BUTTON_ADMIN_DOIT']."' /></form></td>\n</tr>";
        }
        echo "</table></div><br /><center><span class='tiny'>" . $lang_admin[$adminpoint]['INFO_ADMIN_GOD_NODELETE'] . "</span></center>";
        out_footer();
    }

    function addadmin() {
        global $admin_file, $db, $adminpoint, $lang_admin, $evoconfig, $currentlang, $_GETVAR;

        $addform = array('add_name' => $adminpoint.'[add_name]',
                        'add_aid'  => $adminpoint.'[add_aid]',
                        'add_email'=> $adminpoint.'[add_email]',
                        'add_url'   => $adminpoint.'[add_url]',
                        'add_admlanguage' => $adminpoint.'[add_admlanguage]',
                        'add_pwd' => $adminpoint.'[add_pwd]',
                        'add_pwd2' => $adminpoint.'[add_pwd2]',
                        'add_radminsuper' => $adminpoint.'[add_radminsuper]',
                        'auth_modules' => $adminpoint.'[auth_modules]');
        $user     = $_GETVAR->get('chng_aid', '_POST', 'int');
        $username = $_GETVAR->get('chng_username', '_POST', 'string');
        $ispromot = $_GETVAR->get('ispromoting', '_POST', 'string');
        if (isset($user) && !empty($user) && ($ispromot == 'ispromoting')) {
            // A user has to be promoted to Admin
            $is_admin = $db->sql_ufetchrow('SELECT `aid` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$username.'" LIMIT 0,1');
            if (isset($is_admin['aid']) && $is_admin['aid'] == $username) {
                out_header($lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'], TRUE);
                echo '<center>'.$lang_admin[$adminpoint]['ERROR_USER_ISADMIN'].'<br /><br /><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
                out_footer();
                exit;
            } else {
                out_header($lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'], TRUE);
                $fieldset_head = $lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'];
                define('ADMIN_IS_PROMOTE', TRUE);
                $user = $db->sql_ufetchrow('SELECT username, user_email, user_website, user_password FROM '._USERS_TABLE.' WHERE user_id = '.$user.' LIMIT 0,1');
                $add_name  = $user['username'];
                $add_aid   = $user['username'];
                $add_email = $user['user_email'];
                $add_url   = $user['user_website'];
                $add_pwd   = $user['user_password'];
                $add_pwd2  = $user['user_password'];
            }
        } else {
            out_header();
            $fieldset_head = $lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINADD'];
            unset($user);
            unset($username);
            unset($ispromot);
            $add_name  = '';
            $add_aid   = '';
            $add_email = '';
            $add_url   = '';
            $add_pwd   = '';
            $add_pwd2  = '';
        }
        echo "<script type='text/javascript'>\n";
        echo '<!--\n
                var pwd_strong      = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONG'].'";
                var pwd_stronger    = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGER'].'";
                var pwd_strongest   = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGEST'].'";
                var pwd_notrated    = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED'].'";
                var pwd_med         = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_MEDIUM'].'";
                var pwd_weak        = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_WEAK'].'";
                var pwd_strength    = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_CURRENTSTRENGTH'].'";';
        echo "//-->\n";
        echo "</script>\n\n";
        echo '<script type="text/javascript" src="'.NUKE_HREF_BASE_DIR .'/includes/password_strength.js"></script>';
        echo "<center><fieldset title='".$fieldset_head."'><legend><span class='option'><strong>" . $fieldset_head . "</strong></span></legend>";
        echo "<form action='".$admin_file.".php' method='post' name='addadmin'>\n";
        echo "<table border='0'>\n";
        echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_NAME'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_NAME']. ":</td>\n";
        echo "<td colspan='3'><input type='text' name='".$addform['add_name']."' size='30' maxlength='25' value='".$add_name."'/>&nbsp;<span class='tiny'>".$lang_admin['KERNEL']['REQUIRED']."</span></td>\n</tr>\n";
        if (defined('ADMIN_IS_PROMOTE')) {
            echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME_PROMOTE'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME']. ":</td>\n";
            echo "<td colspan='3'><input type='text' name='".$addform['add_aid']."' size='30' maxlength='25' value='".$add_aid."' readonly='readonly'/>&nbsp;<span class='tiny'>".$lang_admin[$adminpoint]['FIELD_NOTCHANGEABLE']."</span></td>\n</tr>\n";
        } else {
            echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME']. ":</td>\n";
            echo "<td colspan='3'><input type='text' name='".$addform['add_aid']."' size='30' maxlength='25' value='".$add_aid."'/>&nbsp;<span class='tiny'>".$lang_admin['KERNEL']['REQUIRED']."</span></td>\n</tr>\n";
        }
        echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_EMAIL'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL']. ":</td>\n";
        echo "<td colspan='3'><input type='text' name='".$addform['add_email']."' size='30' maxlength='60' value='".$add_email."'/>&nbsp;<span class='tiny'>".$lang_admin['KERNEL']['REQUIRED']."</span></td>\n</tr>\n";
        echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_URL'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_URL']. ":</td>\n";
        echo "<td colspan='3'><input type='text' name='".$addform['add_url']."' size='30' maxlength='60' value='".$add_url."'/>&nbsp;<span class='tiny'>".$lang_admin['KERNEL']['REQUIRED']."</span></td>\n</tr>\n";
        if ($evoconfig['multilingual'] == 1) {
            echo "<tr><td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE']. ":</td><td colspan='3'>";
            echo "<select name='".$addform['add_admlanguage']."'>";
            $languageslist = lang_list();
            for ($i=0, $maxi = count($languageslist); $i < $maxi; $i++) {
                if(!empty($languageslist[$i])) {
                    echo "<option value='".$languageslist[$i]."' ";
                    if($languageslist[$i]==$currentlang) echo "selected='selected'";
                    echo ">".ucwords($languageslist[$i])."</option>\n";
                }
            }
            echo "</select></td></tr>\n";
        } else {
            echo "<tr><td colspan='4'><input type='hidden' name='".$addform['add_admlanguage']."' value='' /></td></tr>\n";
        }
        echo "<tr><td colspan='4'><br /></td></tr>\n";
        echo "<tr><td>" .evo_help_img($lang_admin[$adminpoint]['HELP_FIELDSET_PERMISSIONS'])."&nbsp;".$lang_admin[$adminpoint]['FIELDSET_PERMISSIONS']. ":</td>";
        echo "<td colspan='3'>\n";
        echo "<fieldset><input type='checkbox' name='".$addform['add_radminsuper']."' value='1' />".$lang_admin[$adminpoint]['OPTION_ADMIN_SUPERUSER'].'&nbsp;'. evo_help_img($lang_admin[$adminpoint]['HELP_OPTION_ADMIN_SUPERUSER'])."<span class='tiny'><em>".$lang_admin[$adminpoint]['INFO_ADMIN_SUPERUSER_WARN']."</em></span><br />\n";
        $result = $db->sql_query("SELECT `mid`, `title` FROM "._MODULES_TABLE." ORDER BY `title` ASC");
        $a = 0;
        echo "<table><tr>\n";
        while ($row = $db->sql_fetchrow($result)) {
            $title = str_replace("_", " ", $row['title']);
            if (@file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/index.php') && @file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/links.php') && @file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/case.php')) {
                if ($a == 5) { echo "</tr><tr>"; $a=0;}
                $a++;
                $var = $row['mid'];
                echo "<td><span style='white-space:nowrap;'><input type='checkbox' name='".$adminpoint."[auth_modules][".$var."]' value='".intval($row['mid'])."' />&nbsp;".$title."&nbsp;&nbsp;&nbsp;</span></td>";
            }
        }
        $db->sql_freeresult($result);
        for ($i=0; $i < $a; $i++) {
            echo "<td></td>\n";
        }
        echo "</tr></table>\n";
        echo "</fieldset></td>\n</tr>\n";
        echo "<tr><td colspan='4'><br /></td></tr>\n";
        if (defined('ADMIN_IS_PROMOTE')) {
            echo "<input type='hidden' name='".$addform['add_pwd']."' value='".$add_pwd."' />\n";
            echo "<input type='hidden' name='".$addform['add_pwd2']."' value='".$add_pwd2."' />\n";
            echo "<input type='hidden' name='ispromoting' value='ispromoting' />\n";
            echo "<tr><td colspan='7'>\n";
            echo "<input type='hidden' name='op' value='addadmin' /><br />\n";
            echo "<input type='hidden' name='module' value='".$adminpoint."' /><br />\n";
            echo "</td></tr>\n";
            echo "<tr><td colspan='7'>\n";
            echo "<input type='submit' name='submit' value='" .$lang_admin[$adminpoint]['BUTTON_USER_PROMOTE'] . "' />\n";
            echo "</td></tr>\n";
            echo "</table>\n";
        } else {
            echo "<tr>\n<td align='left'>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD']. ":</td>\n";
            echo "<td colspan='3'><input type='password' id='add_pwd' name='".$addform['add_pwd']."' size='12' maxlength='40' onkeyup='chkpwd(addadmin.add_pwd.value)' onblur='chkpwd(addadmin.add_pwd.value)' onmouseout='chkpwd(addadmin.add_pwd.value)' /></td>\n</tr>\n";
            echo "<tr>\n<td align='left'>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD2'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2']. ":</td>\n";
            echo "<td colspan='3'><input type='password' id='add_pwd2' name='".$addform['add_pwd2']."' size='12' maxlength='40' /></td>\n</tr>\n";
            echo "</table>\n";
            echo "<table width='100%' border='0'>\n";
            echo "<tr>\n";
            echo "<td width='10%'></td>\n";
            echo "<td id='td1' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div1'></div></td>\n";
            echo "<td id='td2' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div2'></div></td>\n";
            echo "<td id='td3' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div3'>".$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED']."</div></td>\n";
            echo "<td id='td4' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div4'></div></td>\n";
            echo "<td id='td5' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div5'></div></td>\n";
            echo "<td width='40%'></td>\n";
            echo "</tr>\n";
            echo "<tr><td width='10%'></td><td colspan='6'><div id='divTEMP'></div></td></tr>\n";
            echo "<tr><td width='10%'></td><td colspan='6'>".$lang_admin[$adminpoint]['INFO_ADMIN_PW_BEFORELINK']." <a href=\"javascript:strengthhelp('".$currentlang."')\">".$lang_admin[$adminpoint]['INFO_ADMIN_PW_LINK']."</a> ".$lang_admin[$adminpoint]['INFO_ADMIN_PW_AFTERLINK']."</td></tr>\n";
            echo "<tr><td colspan='7'>\n";
            echo "<input type='hidden' name='op' value='addadmin' /><br />\n";
            echo "<input type='hidden' name='module' value='".$adminpoint."' /><br />\n";
            echo "</td></tr>\n";
            echo "<tr><td colspan='7'>\n";
            echo "<input type='submit' name='submit' value='" .$lang_admin[$adminpoint]['BUTTON_ADMIN_ADD'] . "' />\n";
            echo "</td></tr>\n";
            echo "</table>\n";
        }
        echo "</form></fieldset></center>";
        out_footer();
    }

    function modifyadmin($show=FALSE) {
        global $admin_file, $db, $adminpoint, $lang_admin, $evoconfig, $currentlang, $_GETVAR;

        $changeaid = $_GETVAR->get('chng_aid', '_POST', 'string');
        $dbaid = $db->sql_ufetchrow('SELECT `admlanguage`, `aid`, `email`, `name`, `radminsuper`, `url`  FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$changeaid.'"');
        if (!isset($dbaid['aid']) || ($dbaid['aid'] != $changeaid)) {
            out_header('', FALSE);
            echo '<center>'.$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'].'<br /><br /><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
            out_footer();
            exit;
        }
        $is_promoted = $db->sql_unumrows('SELECT `username` from `'._USERS_TABLE.'` WHERE `username` = "'.$changeaid.'"');
        if ($dbaid['name'] == 'God') {
            $inputtype = " readonly='readonly' ";
            $inputtext = $lang_admin[$adminpoint]['INFO_FIELD_NOTCHANGEABLE'];
        } else {
            $inputtype = '';
            $inputtext = $lang_admin['KERNEL']['REQUIRED'];
        }
        $headerinfo = ($show ? $lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW'] : $lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE']);
        out_header($headerinfo);
        $addform = array('add_name' => $adminpoint.'[add_name]',
                        'add_aid'  => $adminpoint.'[add_aid]',
                        'old_aid'   => $adminpoint.'[old_aid]',
                        'add_email'=> $adminpoint.'[add_email]',
                        'add_url'   => $adminpoint.'[add_url]',
                        'add_admlanguage' => $adminpoint.'[add_admlanguage]',
                        'add_pwdchange' => $adminpoint.'[add_pwdchange]',
                        'add_pwd' => $adminpoint.'[add_pwd]',
                        'add_pwd2' => $adminpoint.'[add_pwd2]',
                        'add_radminsuper' => $adminpoint.'[add_radminsuper]',
                        'auth_modules' => $adminpoint.'[auth_modules]');
        if (!$show) {
            $readonly = '';
            echo "<script type='text/javascript'>\n";
            echo '<!--\n
                    var pwd_strong      = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONG'].'";
                    var pwd_stronger    = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGER'].'";
                    var pwd_strongest   = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGEST'].'";
                    var pwd_notrated    = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED'].'";
                    var pwd_med         = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_MEDIUM'].'";
                    var pwd_weak        = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_WEAK'].'";
                    var pwd_strength    = "'.$lang_admin[$adminpoint]['INFO_ADMIN_PW_CURRENTSTRENGTH'].'";';
            echo "//-->\n";
            echo "</script>\n\n";
            echo '<script type="text/javascript" src="'.NUKE_HREF_BASE_DIR .'/includes/password_strength.js"></script>';
            echo "<center><fieldset title='".$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE']."'><legend><span class='option'><strong>" . $lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE'] . "</strong></span></legend>";
            echo "<form action='".$admin_file.".php' method='post' name='changeadmin'>\n";
        } else {
            $readonly = "disabled='disabled'";
            echo "<center><fieldset title='".$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW']."'><legend><span class='option'><strong>" . $lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW'] . "</strong></span></legend>";
        }
        echo "<table border='0'>\n";
        echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_NAME'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_NAME']. ":</td>\n";
        echo "<td colspan='3'><input type='text' name='".$addform['add_name']."' size='30' maxlength='25' value='".$dbaid['name']."' ".$inputtype." ".$readonly." />&nbsp;<span class='tiny'>".$inputtext."</span></td>\n</tr>\n";
            echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME']. ":</td>\n";
        if ($is_promoted > 0) {
            echo "<td colspan='3'><input type='text' name='add_aid' size='30' maxlength='25'  value='".$dbaid['aid']."' disabled='disabled' />&nbsp;<span class='tiny'>".$lang_admin[$adminpoint]['INFO_FIELD_NOTCHANGEABLE']."</span></td>\n</tr>\n";
            echo "<input type='hidden' name='".$addform['add_aid']."' value='".$dbaid['aid']."' /><br />\n";
        } else {
            echo "<td colspan='3'><input type='text' name='".$addform['add_aid']."' size='30' maxlength='25'  value='".$dbaid['aid']."' ".$readonly." />&nbsp;<span class='tiny'>".$lang_admin['KERNEL']['REQUIRED']."</span></td>\n</tr>\n";
        }
        echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_EMAIL'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL']. ":</td>\n";
        echo "<td colspan='3'><input type='text' name='".$addform['add_email']."' size='30' maxlength='60'  value='".$dbaid['email']."' ".$readonly." />&nbsp;<span class='tiny'>".$lang_admin['KERNEL']['REQUIRED']."</span></td>\n</tr>\n";
        echo "<tr>\n<td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_URL'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_URL']. ":</td>\n";
        echo "<td colspan='3'><input type='text' name='".$addform['add_url']."' size='30' maxlength='60'  value='".$dbaid['url']."' ".$readonly." />&nbsp;<span class='tiny'>".$lang_admin['KERNEL']['REQUIRED']."</span></td>\n</tr>\n";
        $selectedlang = 0;
        if ($evoconfig['multilingual'] == 1 && !$show) {
            echo "<tr><td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE']. ":</td><td colspan='3'>";
            echo "<select name='".$addform['add_admlanguage']."'>";
            $languageslist = lang_list();
            for ($i=0, $maxi = count($languageslist); $i < $maxi; $i++) {
                if(!empty($languageslist[$i])) {
                    echo "<option value='".$languageslist[$i]."' ";
                    if($languageslist[$i]== $dbaid['admlanguage']) {echo "selected='selected'"; $selectedlang++;}
                    echo ">".ucwords($languageslist[$i])."</option>\n";
                }
            }
            echo "</select></td></tr>\n";
        } elseif ($show) {
            echo "<tr><td>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE']. ":</td><td colspan='3'>";
            echo "<input type='text' name='".$addform['add_admlanguage']."' value='".$dbaid['admlanguage']."' /></td></tr>\n";
        } else {
            echo "<tr><td colspan='4'><input type='hidden' name='".$addform['add_admlanguage']."' value='' /></td></tr>\n";
        }
        echo "<tr><td colspan='4'><br /></td></tr>\n";
        if ($dbaid['name'] == 'God') {
            echo "<tr><td colspan='4'><br /></td></tr>\n";
        } else {
            echo "<tr><td>" .evo_help_img($lang_admin[$adminpoint]['HELP_FIELDSET_PERMISSIONS'])."&nbsp;".$lang_admin[$adminpoint]['FIELDSET_PERMISSIONS']. ":</td>";
            echo "<td colspan='3'>\n";
            $radminselect = ($dbaid['radminsuper'] ? "checked='checked'" : '');
            echo "<fieldset><input type='checkbox' name='".$addform['add_radminsuper']."' value='1' ".$radminselect." ".$readonly." />".$lang_admin[$adminpoint]['OPTION_ADMIN_SUPERUSER'].'&nbsp;'. evo_help_img($lang_admin[$adminpoint]['HELP_OPTION_ADMIN_SUPERUSER'])."<span class='tiny'>&nbsp;&nbsp;<em>".$lang_admin[$adminpoint]['INFO_ADMIN_SUPERUSER_WARN']."</em></span><br />\n";
            $result = $db->sql_query("SELECT `mid`, `title`, `admins` FROM "._MODULES_TABLE." ORDER BY `title` ASC");
            $a = 0;
            echo "<table><tr>\n";
            while ($row = $db->sql_fetchrow($result)) {
                $title = str_replace("_", " ", $row['title']);
                if (@file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/index.php') && @file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/links.php') && @file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/case.php')) {
                    if ($a == 5) { echo "</tr><tr>"; $a=0;}
                    $a++;
                    $is_module_admin = '';
                    if (!empty($row['admins'])) {
                        $module_admins     = explode(',', $row['admins']);
                        $new_module_admins = '';
                        $is_module_admin   = FALSE;
                        if (is_array($module_admins) && !empty($module_admins)) {
                            for ($xy=0, $xmax = count($module_admins); $xy < $xmax; $xy++) {
                                if ($module_admins[$xy] == $dbaid['aid']) {
                                    $is_module_admin = "checked='checked'";
                                }
                            }
                        }
                    }
                    $var = $row['mid'];
                    echo "<td><span style='white-space:nowrap;'><input type='checkbox' name='".$adminpoint."[auth_modules][".$var."]' value='".intval($row['mid'])."' ".$is_module_admin." ".$readonly." />&nbsp;".$title."&nbsp;&nbsp;&nbsp;</span></td>";
                }
            }
            $db->sql_freeresult($result);
            for ($i=0; $i < $a; $i++) {
                echo "<td></td>\n";
            }
            echo "</tr></table>\n";
            echo "</fieldset></td>\n</tr>\n";
            echo "<tr><td colspan='4'><br /></td></tr>\n";
        }
        if (!$show) {
            echo "<tr>\n<td align='left'>".evo_help_img($lang_admin[$adminpoint]['HELP_OPTION_ADMIN_PASSWORDCHANGE'])."&nbsp;".$lang_admin[$adminpoint]['OPTION_ADMIN_PASSWORDCHANGE']. ":</td>\n";
            echo "<td colspan='3'><input type='checkbox' name='".$addform['add_pwdchange']."' value='changeit' onclick='javascript:if(document.changeadmin.add_pwd2.readOnly==false){document.changeadmin.add_pwd2.readOnly=true;document.changeadmin.add_pwd.readOnly=true;document.changeadmin.add_pwd2.value=\"\";document.changeadmin.add_pwd.value=\"\"}else{document.changeadmin.add_pwd2.readOnly=false;document.changeadmin.add_pwd.readOnly=false;}' /></td>\n</tr>\n";
            echo "<tr>\n<td align='left'>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD']. ":</td>\n";
            echo "<td colspan='3'><input type='password' id='add_pwd' name='".$addform['add_pwd']."' size='12' maxlength='40' onkeyup='chkpwd(changeadmin.add_pwd.value)' onblur='chkpwd(changeadmin.add_pwd.value)' onmouseout='chkpwd(changeadmin.add_pwd.value)' readonly='readonly' /></td>\n</tr>\n";
            echo "<tr>\n<td align='left'>".evo_help_img($lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD2'])."&nbsp;".$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2']. ":</td>\n";
            echo "<td colspan='3'><input type='password' id='add_pwd2' name='".$addform['add_pwd2']."' size='12' maxlength='40' readonly='readonly'/></td>\n</tr>\n";
            echo "</table>\n";
            echo "<table width='100%' border='0'>\n";
            echo "<tr>\n";
            echo "<td width='10%'></td>\n";
            echo "<td id='td1' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div1'></div></td>\n";
            echo "<td id='td2' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div2'></div></td>\n";
            echo "<td id='td3' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div3'>".$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED']."</div></td>\n";
            echo "<td id='td4' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div4'></div></td>\n";
            echo "<td id='td5' width='10%' align='center' bgcolor='#EBEBEB' style='border-collapse: collapse;'><div id='div5'></div></td>\n";
            echo "<td width='40%'></td>\n";
            echo "</tr>\n";
            echo "<tr><td width='10%'></td><td colspan='6'><div id='divTEMP'></div></td></tr>\n";
            echo "<tr><td width='10%'></td><td colspan='6'>".$lang_admin[$adminpoint]['INFO_ADMIN_PW_BEFORELINK']." <a href=\"javascript:strengthhelp('".$currentlang."')\">".$lang_admin[$adminpoint]['INFO_ADMIN_PW_LINK']."</a> ".$lang_admin[$adminpoint]['INFO_ADMIN_PW_AFTERLINK']."</td></tr>\n";
            echo "<tr><td colspan='7'>\n";
            echo "<input type='hidden' name='".$addform['old_aid']."' value='".$dbaid['aid']."' /><br />\n";
            echo "<input type='hidden' name='op' value='modifyadmin' /><br />\n";
            echo "<input type='hidden' name='module' value='".$adminpoint."' /><br />\n";
            echo "</td></tr>\n";
            echo "<tr><td colspan='7'>\n";
            echo "<input type='submit' name='submit' value='" .$lang_admin[$adminpoint]['BUTTON_ADMIN_CHANGE'] . "' />\n";
            echo "</td></tr>\n";
            echo "</table>\n";
            echo "</form></fieldset></center>";
        } else {
            echo "</table></fieldset></center>\n";
            echo '<center><br /><br /><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
        }
        out_footer();
    }

    function promoteuser() {
        global $admin_file, $db, $adminpoint, $lang_admin, $currentlang, $_GETVAR, $textcolor1, $bgcolor1, $bgcolor2;

        out_header($lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER']);
        $totalselected = $db->sql_unumrows("SELECT count(user_id) as total FROM "._USERS_TABLE);
        echo "<table align='center' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
        echo "<tr bgcolor='$bgcolor2'>\n<th><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_USERNAME']." (".$lang_admin[$adminpoint]['TABLE_ADMIN_USERID'].")</strong></th>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_NAME']."</strong></th>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_EMAIL']."</strong></th>\n";
        echo "<th align='center'><strong>".$lang_admin[$adminpoint]['TABLE_ADMIN_REGDATE']."</strong></th>\n";
        echo "<th align='center'><strong></strong></th></tr>\n";
        $resultaid = $db->sql_query('SELECT aid FROM '._AUTHOR_TABLE);
        $sql_where = '';
        while ($row = $db->sql_fetchrow($resultaid)) {
            $sql_where .= (!empty($sql_where) ? ", '".$row['aid']."'" : "'".$row['aid']."'");
        }
        $db->sql_freeresult($resultaid);
        $result = $db->sql_query("SELECT user_id, username, name, user_email, user_regdate FROM "._USERS_TABLE." WHERE username NOT IN (".$sql_where.")
                                  AND user_id <> ".ANONYMOUS." AND user_active = 1 ORDER BY username ASC");
        while($chnginfo = $db->sql_fetchrow($result)) {
            echo "<tr bgcolor='$bgcolor1'>\n";
            echo "<td align='center'>".$chnginfo['username']." (".$chnginfo['user_id'].")</td>\n";
            echo "<td align='center'>".$chnginfo['name']."</td>\n";
            echo "<td align='center'>".$chnginfo['user_email']."</td>\n";
            echo "<td align='center'>".$chnginfo['user_regdate']."</td>\n";
            echo "<td><form method='post' action='".$admin_file.".php'>\n";
            echo "<input type='hidden' name='chng_aid' value='".$chnginfo['user_id']."' />\n";
            echo "<input type='hidden' name='chng_username' value='".$chnginfo['username']."' />\n";
            echo "<input type='hidden' name='ispromoting' value='ispromoting' />\n";
            echo "<input type='hidden' name='op' value='addadmin' />\n";
            echo "<input type='hidden' name='module' value='".$adminpoint."' />\n";
            echo "<input type='submit' value='".$lang_admin[$adminpoint]['BUTTON_USER_PROMOTE']."' />\n";
            echo "</form></td>\n</tr>\n";
        }
        $db->sql_freeresult($result);
        echo "</table>\n";
        echo "<br />\n";
        out_footer();
    }

    function deleteadmin() {
        global $admin_file, $db, $adminpoint, $lang_admin, $_GETVAR;

        $deleteaid = $_GETVAR->get('chng_aid', '_POST', 'string');
        $dbaid = $db->sql_ufetchrow('SELECT `aid` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$deleteaid.'"');
        if (!isset($dbaid['aid']) || ($dbaid['aid'] != $deleteaid)) {
            out_header('', FALSE);
            echo '<center>'.$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'].'<br /><br /><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
            out_footer();
            exit;
        } else {
            out_header($lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINDELETE']);
            echo '<br /><br /><center>'.$lang_admin[$adminpoint]['WARNING_ADMIN_DELETE'].'</center><br />';
            echo '<center><strong>'.$deleteaid.'</strong></center><br />';
            echo "<div><form action='".$admin_file.".php' method='post' name='deleteadmin'>\n";
            echo "<input type='hidden' name='chng_aid' value='".$deleteaid."' /><br />\n";
            echo "<input type='hidden' name='module' value='".$adminpoint."' /><br />\n";
            echo "<input type='hidden' name='op' value='deleteadmin' /><br />\n";
            echo "<center><input type='submit' name='submit' value='" .$lang_admin[$adminpoint]['BUTTON_ADMIN_DELETE'] . "' /></center>\n";
            echo "</form></div>\n";
            out_footer();
            exit;
        }
    }

    function addadmin_save() {
        global $admin_file, $db, $_GETVAR, $adminpoint, $lang_admin;

        $variable = $_GETVAR->get($adminpoint, '_POST', 'array');
        $addform = array('add_name'       => $adminpoint.'[add_name]',
                        'add_aid'         => $adminpoint.'[add_aid]',
                        'add_email'       => $adminpoint.'[add_email]',
                        'add_url'         => $adminpoint.'[add_url]',
                        'add_admlanguage' => $adminpoint.'[add_admlanguage]',
                        'add_pwd'         => $adminpoint.'[add_pwd]',
                        'add_radminsuper' => $adminpoint.'[add_radminsuper]',
                        'auth_modules'    => $adminpoint.'[auth_modules]');
        foreach($addform as $field => $fieldname) {
            $$field = (isset($variable[$field]) ? $variable[$field] : '');
        }
        define('ADMIN_IS_NEW', TRUE);
        $ispromoting   = $_GETVAR->get('ispromoting', '_POST', 'string');
        $isradminsuper = (isset($variable['add_radminsuper']) ? TRUE : FALSE);
        if (isset($ispromoting) && ($ispromoting == 'ispromoting')) {
            // User should be promoted to Admin
            define('ADMIN_IS_PROMOTE', TRUE);
            $dbaid = $db->sql_ufetchrow('SELECT username as aid, username as name, user_email as email, user_website as url, user_password as pwd FROM '._USERS_TABLE.' WHERE username = "'.$variable['add_aid'].'" LIMIT 0,1');
        }
        $dbfields = array('add_name'      => 'name',
                        'add_aid'         => 'aid',
                        'add_email'       => 'email',
                        'add_pwd'         => 'pwd',
                        'add_radminsuper' => 'radminsuper',
                        'add_url'         => 'url',
                        'add_admlanguage' => 'admlanguage');
        $error       = '';
        $count_error = 0;
        $var_field   = array();
        reset($addform);
        while(list($funcfield, $value) = each($addform)) {
            $checkvar = '';
            $fieldfunction = 'authorcheck_'.$funcfield;
            $value = (isset($variable[$funcfield]) ? $variable[$funcfield] : '');
            $db_field = (isset($dbfields[$funcfield]) ? $dbfields[$funcfield] : NULL);
            $old_value = (isset($db_field) ? (isset($dbaid[$db_field]) ? $dbaid[$db_field] : '') : '');
            $checkvar = (function_exists($fieldfunction) ? $fieldfunction($value, $old_value) : 'not_valid_field');
            switch ($checkvar) {
                case 'ignore' : $var_field[$funcfield] = 'ignore'; break;
                case 'dbfield': $var_field[$funcfield] = $old_value; break;
                case 'ok'     : $var_field[$funcfield] = $value; break;
                case 'crypt'  : if ($funcfield == 'add_pwd') { $var_field[$funcfield] = EvoCrypt($value); } break;
                case 'undefined': $count_error++; $error .= $checkvar.'&nbsp;'.$funcfield.'<br />'; break;
                default       : $count_error++; $error .= $checkvar.'<br />'; break;
            }
        }
        if ($count_error > 0 ) {
            $error = $error . '<br /><br /><center><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
            out_header('', FALSE);
            echo $error;
            out_footer();
            exit;
        }
        // OK we got back our informations from variable check
        // Now let's build the SQL-Statements
        $sql_field     = '';
        $sql_value     = '';
        $sql_statement = '';
        reset($var_field);
        while (list($inputvar, $dbfield) = each($dbfields)) {
            if (isset($var_field[$inputvar]) && ($var_field[$inputvar] != 'ignore')) {
                $sql_field .= (empty($sql_field) ?  '(`'.$dbfield.'`' : ', `'.$dbfield.'`');
                $sql_value .= (empty($sql_value) ?  '("'.$var_field[$inputvar].'"' : ', "'.$var_field[$inputvar].'"');
            }
        }
        if (!empty($sql_value)) {
            $sql_field = $sql_field .')';
            $sql_value = $sql_value .')';
            $sql_statement = "INSERT INTO `"._AUTHOR_TABLE."` ".$sql_field." VALUES ".$sql_value;
            $result = $db->sql_query($sql_statement);
            if (!$result) {
                $error = $lang_admin[$adminpoint]['ERROR_DB_INSERT_ADMIN'];
                $error = $error . '<br /><br /><center><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
                out_header('', FALSE);
                echo $error;
                out_footer();
                exit;
            } else {
                //Ok .. .new author is inserted into authors table, so make him admin too for phpbb if he is user
                //On promoting a user, no update is made to any other field in the users table
                if (defined('ADMIN_IS_PROMOTE')) {
                    $db->sql_uquery('UPDATE `'._USERS_TABLE.'` SET `user_level` = 2 WHERE `username` = "'.$variable['add_aid'].'"');
                }
                // We update modules table only if author was successfully inserted and Admin is not superadmin
                if  (!$isradminsuper) {
                    $authmodules  = (isset($variable['auth_modules']) ? $variable['auth_modules'] : NULL);
                    if (isset($authmodules) && !empty($authmodules) && is_array($authmodules)) {
                        while (list($modules_mid) = each($authmodules)) {
                            $row = $db->sql_ufetchrow("SELECT admins, title FROM "._MODULES_TABLE." WHERE mid='".intval($modules_mid)."'");
                            if (isset($row['title']) && !empty($row['title'])) {
                                // Ok ... we could go for trust and add the new admin ... we could - but we don't
                                $module_admins     = explode(',', $row['admins']);
                                $new_module_admins = '';
                                $is_module_admin   = FALSE;
                                if (is_array($module_admins) && !empty($module_admins)) {
                                    for ($xy=0, $xmax = count($module_admins); $xy < $xmax; $xy++) {
                                        $new_module_admins .= (!empty($new_module_admins) && !empty($module_admins[$xy]) ? ',' : '');
                                        $new_module_admins .= (!empty($module_admins[$xy]) ? $module_admins[$xy] : '');
                                        if ($module_admins[$xy] == $var_field['add_aid']) {
                                            $is_module_admin = TRUE;
                                        }
                                    }
                                }
                                if (!$is_module_admin) {
                                    $new_module_admins = (empty($new_module_admins) ? $var_field['add_aid'].',' : $new_module_admins.','.$var_field['add_aid'].',');
                                } else {
                                    $new_module_admins = $new_module_admins . ',';
                                }
                                $db->sql_uquery("UPDATE "._MODULES_TABLE." SET admins='".$new_module_admins."' WHERE mid='".intval($modules_mid)."'");
                            }
                        }
                    }
                }
            }
        }
        $link = '<br /><br /><center><a href="'.$admin_file.'.php?module='.$adminpoint.'&amp;op=menue">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
        out_header('', FALSE);
        echo "<center>".$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_ADDED']."</center>\n".$link;
        out_footer();
        exit;
    }

    function modifyadmin_save() {
        global $aid, $admin_file, $db, $adminpoint, $lang_admin, $currentlang, $_GETVAR;

        $variable = $_GETVAR->get($adminpoint, '_POST', 'array');
        $addform = array('add_name' => $adminpoint.'[add_name]',
                        'add_aid'  => $adminpoint.'[add_aid]',
                        'old_aid'   => $adminpoint.'[old_aid]',
                        'add_email'=> $adminpoint.'[add_email]',
                        'add_url'   => $adminpoint.'[add_url]',
                        'add_admlanguage' => $adminpoint.'[add_admlanguage]',
                        'add_pwd' => $adminpoint.'[add_pwd]',
                        'add_radminsuper' => $adminpoint.'[add_radminsuper]',
                        'auth_modules' => $adminpoint.'[auth_modules]');
        while(list($field, $fieldname) = each($addform)) {
            $$field = (isset($variable[$field]) ? $variable[$field] : '');
        }
        $is_pwd_change = (isset($variable['add_pwdchange']) ? $variable['add_pwdchange'] : NULL);
        $add_radminsuper = ((isset($variable['add_name']) && $variable['add_name'] == 'God') ? TRUE : $add_radminsuper);
        if ($add_name == 'God') {
            define('ADMIN_IS_GOD', TRUE);
        }
        $dbfields = array('add_name'      => 'name',
                        'add_aid'         => 'aid',
                        'add_email'       => 'email',
                        'add_pwd'         => 'pwd',
                        'add_radminsuper' => 'radminsuper',
                        'add_url'         => 'url',
                        'add_admlanguage' => 'admlanguage');
        $error       = '';
        $count_error = 0;
        $var_field   = array();
        reset($addform);
        $dbuser = $db->sql_ufetchrow('SELECT username as aid FROM '._USERS_TABLE.' WHERE username = "'.$old_aid.'" LIMIT 0,1');
        if (isset($dbuser['aid']) && !empty($dbuser['aid']) && ($add_name != 'God')) {
            // Admin is user too
            define('ADMIN_IS_PROMOTE', TRUE);
        }
        if ($add_name == 'God') {
            $dbaid = $db->sql_ufetchrow('SELECT `admlanguage`, `aid`, `email`, `name`, `pwd`, `radminsuper`, `url`  FROM `'._AUTHOR_TABLE.'` WHERE `name` = "God"');
        } else {
            $dbaid = $db->sql_ufetchrow('SELECT `admlanguage`, `aid`, `email`, `name`, `pwd`, `radminsuper`, `url`  FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$old_aid.'"');
        }
        if (!isset($dbaid['aid']) || ($dbaid['aid'] != $old_aid)) {
            out_header('', FALSE);
            echo '<center>'.$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'].'<br /><br /><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
            out_footer();
            exit;
        }
        define('ADMIN_IS_UPDATE', TRUE);
        if (isset($dbaid['radminsuper']) && $dbaid['radminsuper'] == TRUE && ($add_radminsuper == TRUE)) {
            define('MODIFY_IS_RADMIN', TRUE);
            $isradminsuper = TRUE;
            $variable['add_radminsuper'] = TRUE;
        } elseif (isset($add_radminsuper) && ($add_radminsuper == TRUE)) {
            define('MODIFY_IS_RADMIN', TRUE);
            $isradminsuper = TRUE;
            $variable['add_radminsuper'] = TRUE;
        } else {
            define('MODIFY_IS_RADMIN', FALSE);
            $isradminsuper = FALSE;
            $variable['add_radminsuper'] = FALSE;
        }
        while(list($funcfield, $value) = each($addform)) {
            if ($funcfield == 'old_aid') {
                continue;
            }
            $checkvar = '';
            $fieldfunction = 'authorcheck_'.$funcfield;
            $value = (isset($variable[$funcfield]) ? $variable[$funcfield] : '');
            $db_field = (isset($dbfields[$funcfield]) ? $dbfields[$funcfield] : NULL);
            $old_value = (isset($db_field) ? (isset($dbaid[$db_field]) ? $dbaid[$db_field] : '') : '');
            $checkvar = (function_exists($fieldfunction) ? $fieldfunction($value, $old_value) : 'not_valid_field');
            switch ($checkvar) {
                case 'ignore' : $var_field[$funcfield] = 'ignore'; break;
                case 'dbfield': $var_field[$funcfield] = $old_value; break;
                case 'ok'     : $var_field[$funcfield] = $value; break;
                case 'crypt'  : if ($funcfield == 'add_pwd') { $var_field[$funcfield] = EvoCrypt($value); } break;
                case 'undefined': $count_error++; $error .= $checkvar.'&nbsp;'.$funcfield.'<br />'; break;
                default       : $count_error++; $error .= $checkvar.'<br />'; break;
            }
        }
        if ($count_error > 0 ) {
            $error = $error . '<br /><br /><center><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
            out_header('', FALSE);
            echo $error;
            out_footer();
            exit;
        }
        // OK we got back our informations from variable check
        // Now let's build the SQL-Statements
        $sql_field     = '';
        $sql_value     = '';
        $sql_statement = '';
        reset($var_field);
        while (list($inputvar, $dbfield) = each($dbfields)) {
            if (isset($var_field[$inputvar]) && ($var_field[$inputvar] != $dbaid[$dbfield]) && ($var_field[$inputvar] != 'ignore')) {
                $sql_field .= (empty($sql_field) ?  "`".$dbfield."` = '".$var_field[$inputvar]."'" : ", `".$dbfield."` = '".$var_field[$inputvar]."'");
            }
        }
        if (!empty($sql_field)) {
            if ( $add_name == 'God') {
                $sql_statement = 'UPDATE `'._AUTHOR_TABLE.'` SET '.$sql_field.' WHERE `name` = "God"';
            } else {
                $sql_statement = 'UPDATE `'._AUTHOR_TABLE.'` SET '.$sql_field.' WHERE `aid` = "'.$old_aid.'"';
            }
            $result = $db->sql_query($sql_statement);
            if (!$result) {
                $error = $lang_admin[$adminpoint]['ERROR_DB_INSERT_ADMIN'];
                $error = $error . '<br /><br /><center><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
                out_header('', FALSE);
                echo $error;
                out_footer();
                exit;
            } 
        }
        //Ok .. .new author is updated in authors table
        //now we have to change users if pwd is changed
        if (defined('ADMIN_IS_PROMOTE')) {
            if ($is_pwd_change) {
                $db->sql_uquery('UPDATE `'._USERS_TABLE.'` SET `user_password` = "'.$var_field['add_pwd'].'" WHERE `username` = '.$variable['add_aid']);
            }
        }
        // We update modules table only if author was successfully inserted and Admin was not superadmin
        if  ($isradminsuper == FALSE) {
            $new_is_super = $isradminsuper;
            $authmodules  = (isset($variable['auth_modules']) ? $variable['auth_modules'] : NULL);
            if (isset($authmodules) && !empty($authmodules) && is_array($authmodules)) {
                $result_mid = $db->sql_query('SELECT `admins`, `title`, `mid` FROM `'._MODULES_TABLE.'`');
                while ($module = $db->sql_fetchrow($result_mid)) {
                    $module_admins     = explode(',', $module['admins']);
                    if (is_array($module_admins) && !empty($module_admins)) {
                        for ($xy=0, $xmax = count($module_admins); $xy < $xmax; $xy++) {
                            
                    while (list($modules_mid) = each($authmodules)) {
                            // Ok ... we could go for trust and add the new admin ... we could - but we don't
                            $new_module_admins = '';
                            $is_module_admin   = FALSE;
                            if (is_array($module_admins) && !empty($module_admins)) {
                                    if (($module_admins[$xy] == $var_field['add_aid']) && !$new_is_super) {
                                        $new_module_admins .= (!empty($new_module_admins) && !empty($module_admins[$xy]) ? ',' : '');
                                        $new_module_admins .= (!empty($module_admins[$xy]) ? $module_admins[$xy] : '');
                                        if ($module_admins[$xy] == $var_field['add_aid']) {
                                            $is_module_admin = TRUE;
                                        }
                                    }
                                }
                            }
                            if (!$is_module_admin && !$new_is_super) {
                                $new_module_admins = (empty($new_module_admins) ? $var_field['add_aid'].',' : $new_module_admins.','.$var_field['add_aid'].',');
                            }
                            $db->sql_uquery("UPDATE "._MODULES_TABLE." SET admins='".$new_module_admins."' WHERE mid='".intval($modules_mid)."'");
                        }
                    }
                }
            }
        }
        if ($aid == $var_field['add_aid'] || (defined('ADMIN_IS_GOD') && ($add_aid != $old_aid))) {
            $link = $lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED_LOGOUT'].'<br /><br /><center><a href="'.$admin_file.'.php?op=logout">['.$lang_admin['KERNEL']['LOGOUT'].']</a></center>';
        } else {
            $link = '<br /><br /><center><a href="'.$admin_file.'.php?module='.$adminpoint.'&amp;op=menue">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
        }
        out_header('', FALSE);
        echo "<center>".$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED']."</center>\n".$link;
        out_footer();
        exit;
    }

    function deleteadmin_save() {
        global $aid, $admin_file, $db, $adminpoint, $lang_admin, $_GETVAR;

        $deleteaid = $_GETVAR->get('chng_aid', '_POST', 'string');
        $dbaid = $db->sql_ufetchrow('SELECT `aid`, `name` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$deleteaid.'"');
        if (!isset($dbaid['aid']) || ($dbaid['aid'] != $deleteaid) || $dbaid['name'] == 'God') {
            out_header('', FALSE);
            echo '<center>'.$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'].'<br /><br /><a href="javascript:history.back()">['.$lang_admin['KERNEL']['GOBACK'].']</a></center>';
            out_footer();
            exit;
        } else {
            //ok .. first let's change all stories where admin is responsible for to god-admin
            $db->sql_uquery("UPDATE `".  _STORIES_TABLE ."` SET `aid` = '".$aid."' WHERE `aid` = '".$deleteaid."'");
            $countstories = $db->sql_unumrows("SELECT `sid` FROM `".  _STORIES_TABLE ."` WHERE `aid` = '".$aid."'");
            if ($countstories > 0) {
                $db->sql_uquery("UPDATE `" . _AUTHOR_TABLE . "` SET `counter`= counter+1 WHERE `aid`='".$aid."'");
            }
            //OK we are ready to delete admin
            $isuser = $db->sql_unumrows("SELECT `user_id` FROM `"._USERS_TABLE."` WHERE `username` = '".$deleteaid."'");
            if ($isuser > 0) {
                // Set user back to normal status - this is only for phpbb part
                // Maybe the user was a moderator before - now he isn't any longer
                $db->sql_uquery("UPDATE `"._USERS_TABLE."` SET `user_level` = 1 WHERE `username` = '".$deleteaid."'");
            }
            // Next is to remove module privileges
            // Because it is important, we do not use a textsearch like %% for the database
            $result = $db->sql_query("SELECT `mid`, `admins` FROM "._MODULES_TABLE);
            while ($row = $db->sql_fetchrow($result)) {
                $module_admins     = explode(',', $row['admins']);
                $new_module_admins = '';
                $is_module_admin   = FALSE;
                if (is_array($module_admins) && !empty($module_admins)) {
                    for ($xy=0, $xmax = count($module_admins); $xy < $xmax; $xy++) {
                        if ($module_admins[$xy] != $deleteaid) {
                            $new_module_admins .= (!empty($new_module_admins) && !empty($module_admins[$xy]) ? ',' : '');
                            $new_module_admins .= (!empty($module_admins[$xy]) ? $module_admins[$xy] : '');
                        } else {
                            $is_module_admin = TRUE;
                        }
                    }
                }
                if ($is_module_admin) {
                    $new_module_admins = (!empty($new_module_admins) ?  $new_module_admins. ',' : '');
                    $db->sql_uquery("UPDATE "._MODULES_TABLE." SET admins='".$new_module_admins."' WHERE mid='".intval($row['mid'])."'");
                }
            }
            $db->sql_uquery("DELETE FROM `" . _AUTHOR_TABLE . "` WHERE `aid` = '".$deleteaid."'");
            out_header($lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINDELETE']);
            echo '<br /><br /><center>'.$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_DELETED'].'</center><br />';
            echo '<center><strong>'.$deleteaid.'</strong></center><br />';
            out_footer();
            exit;
        }
    }

    function deladminconf($del_aid) {
        global $db, $admin_file;

        $del_aid = trim($del_aid);
        $db->sql_uquery("DELETE FROM " . _AUTHOR_TABLE . " WHERE aid='$del_aid' AND name!='God'");
        $result = $db->sql_query("SELECT `mid`, `admins` FROM "._MODULES_TABLE." WHERE `admins`!= ''");
        while ($row = $db->sql_fetchrow($result)) {
            $admins = explode(',', $row['admins']);
            $adm = '';
            for ($a=0, $maxa=count($admins); $a < $maxa; $a++) {
                if ($admins[$a] != $del_aid && !empty($admins[$a])) {
                    $adm .= $admins[$a].',';
                }
            }
            $db->sql_uquery("UPDATE "._MODULES_TABLE." SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
        }
        $db->sql_freeresult($result);
        redirect($admin_file.'.php?op=mod_authors');
    }

    function authorcheck_add_name($add_name='', $old_name='') {
        global $lang_admin, $adminpoint, $ya_config, $db;
        $error = '';
        // All checks must be done - never mind in which mode we operate
        //Check if empty
        if (isset($add_name) && !empty($add_name) && $add_name != 'God') {
            // let's check the length of the name. Should be greater than or equal to 3 and not bigger than 30
            if ((strlen($add_name) <= 3 || strlen($add_name) >= 30)) {
                $error .= sprintf($lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_SIZE'], strlen($add_name)).'&nbsp;:'.$add_name;
                return $error;
            } elseif ( defined('ADMIN_IS_UPDATE') && ($add_name == $old_name)) {
                return 'dbfield';
            } else {
                // central validation of usernames
                $temp_name = check_words($add_name);
                if ($add_name != $temp_name) {
                    $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_BADWORD'].':&nbsp;'.$temp_name;
                    return $error;
                } elseif  (!Validate($add_name, 'username', '', 1, 1)) {
                    $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_INVALID'];
                    return $error;
                } else {
                    if (defined('ADMIN_IS_UPDATE')) {
                        if ($add_name != $old_name) {
                            // update of the name - so we have to check it
                            $count  = $db->sql_unumrows('SELECT `username` FROM `'._USERS_TABLE.'` WHERE `username` = "'.$add_name.'"');
                            $count2 = $db->sql_unumrows('SELECT `aid` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$add_name.'" OR `name` = "'.$add_name.'"');
                            if ( $count > 0  || $count2 > 0 ) {
                                $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EXISTS'];
                                return $error;
                            }
                        } else {
                            //no namechange, so nothing to do
                            return 'dbfield';
                        }
                    } else {
                        //we create a new Admin
                        if (!defined('ADMIN_IS_PROMOTE')) {
                            $count  = $db->sql_unumrows('SELECT `username` FROM `'._USERS_TABLE.'` WHERE `username` = "'.$add_name.'"');
                        } else {
                            // we promote an user, so he MUST be in users table
                            $count = 0;
                        }
                        $count2 = $db->sql_unumrows('SELECT `aid` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$add_name.'" OR `name` = "'.$add_name.'"');
                        if ( $count > 0 || $count2 > 0) {
                            // Useraccount or Admin with same name exists
                            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EXISTS'];
                            return $error;
                        } else {
                            // Now everything seems ok
                            return 'ok';
                        }
                    }
                }
            }
        } elseif ( $add_name == 'God') {
            return 'dbfield';
        } else {
            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EMPTY'];
            return $error;
        }
        return 'undefined';
    }


    function authorcheck_add_aid($add_aid='', $old_aid='') {
        global $lang_admin, $adminpoint, $db;
        $error = '';
        if (isset($add_aid) && !empty($add_aid)) {
            if (defined('ADMIN_IS_PROMOTE')) {
                // If we promote an user to admin, this field is the join to the usertable. So no change is allowed
                // But we have to check if the user exists (so we exclude errors from third site)
                $count = $db->sql_unumrows('SELECT `username` FROM `'._USERS_TABLE.'` WHERE `username` = "'.$add_aid.'"');
                if ($count != 1) {
                    $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_NOT_EXIST'];
                    return $error;
                } else {
                    // Should normally not occur, but on great sites some Admins could do the same
                    $count = $db->sql_unumrows('SELECT `aid` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$add_aid.'"');
                    if ( $count > 0 && !defined('ADMIN_IS_UPDATE') ) {
                        $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EXISTS'];
                        return $error;
                    } else {
                        return 'dbfield';
                    }
                }
            } elseif (defined('ADMIN_IS_UPDATE') && (defined('ADMIN_IS_GOD'))) {
                // We have nothing to change because this field isn't changeable
                return 'dbfield';
            } else {
                // ok ... a new admin is to be created
                $count = $db->sql_unumrows('SELECT `username` FROM `'._USERS_TABLE.'` WHERE `username` = "'.$add_aid.'"');
                $count2 = $db->sql_unumrows('SELECT `aid` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$add_aid.'"');
                if ( $count > 0 || $count2 > 0 ) {
                    $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EXISTS'];
                    return $error;
                } else {
                    // let's check the length of the name. Should be greater than or equal to 3 and not bigger than 30
                    if ((strlen($add_aid) <= 3 || strlen($add_aid) >= 30)) {
                        $error .= sprintf($lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_SIZE'], strlen($add_name)).'&nbsp;:'.$add_aid;
                        return $error;
                    } else {
                        // central validation of usernames
                        $temp_name = check_words($add_aid);
                        if ($add_aid != $temp_name) {
                            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_BADWORD'].':&nbsp;'.$temp_name;
                            return $error;
                        } elseif (!Validate($add_aid, 'username', '', 1, 1)) {
                            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_INVALID'];
                            return $error;
                        } else {
                            // Now everything seems ok
                            return 'ok';
                        }
                    }
                }
            }
        } else {
            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EMPTY'];
            return $error;
        }
        return 'undefined';
    }

    function authorcheck_add_email($add_email='', $old_email='') {
        global $lang_admin, $adminpoint;
        $error = '';
        if (isset($add_email) && !empty($add_email)) {
            // is a simple thing, because we didn't have to check if those email exists
            if (!Validate($add_email, 'email', '', 1, 1)) {
                $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_INVALID'];
                return $error;
            } else {
                return 'ok';
            }
        } else {
            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_EMPTY'];
            return $error;
        }
        return 'undefined';
    }

    function authorcheck_add_url($add_url='') {
        global $lang_admin, $adminpoint;
        $error = '';
        if (isset($add_url) && !empty($add_url)) {
            // is a simple thing, because we didn't have to check anything else
            if (!Validate($add_url, 'url', '', 1, 1)) {
                $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_INVALID'];
                return $error;
            } else {
                return 'ok';
            }
        } else {
            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_EMPTY'];
            return $error;
        }
        return 'undefined';
    }

    function authorcheck_add_admlanguage($add_admlanguage='', $old_admlanguage='') {
        global $lang_admin, $adminpoint;
        $error = '';
        if (isset($add_admlanguage) && !empty($add_admlanguage)) {
            // Ok, we have to check if the field is inside the allowed languages
            $languageslist = lang_list();
            for ($i=0, $maxi = count($languageslist); $i < $maxi; $i++) {
                if(!empty($languageslist[$i])) {
                    if ($languageslist[$i] == $add_admlanguage) {;
                        return 'ok';
                    }
                }
            }
            // Uuups .. we shouldn't be here. Means, that however it happened, a language is submitted which doesn't exists.
            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_LANGUAGE'];
            return $error;
        } else {
            // There is nothing to do
            return 'ok';
        }
        return 'undefined';
    }

    function authorcheck_add_pwd ($add_pwd='', $old_pwd='') {
        global $lang_admin, $adminpoint, $_GETVAR;
        $error    = '';
        $doit     = FALSE;
        $changeit = '';
        $variable = $_GETVAR->get($adminpoint, '_POST', 'array');
        // Do we have to change password ?
        if (defined('ADMIN_IS_PROMOTE') && !defined('ADMIN_IS_UPDATE')) {
            // User should have on start the same Password for Admin and User Account
            return 'dbfield';
        } else {
            $changeit = (isset($variable['add_pwdchange']) ? $variable['add_pwdchange'] : NULL);
            if (isset($changeit) && ($changeit == 'changeit')) {
                $doit = TRUE;
            }
        }
        // Password entry only is possibe if we are in Update-Modus or a new Admin has to be created
        if ((defined('ADMIN_IS_UPDATE') && ($doit == TRUE)) || defined('ADMIN_IS_NEW')) {
            // We have to change the Password or create one
            if (isset($add_pwd) && !empty($add_pwd)) {
                // We have a password in the first field, so check if we have even too one in the second for compare
                $pwd2 = (isset($variable['add_pwd2']) ? $variable['add_pwd2'] : NULL);
                if (!isset($pwd2) || empty($pwd2)) {
                    $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD2_EMPTY'];
                    return $error;
                } elseif ($add_pwd != $pwd2) {
                    // Ok we have two Passwords but they didn't match
                    $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_NOT_MATCH'];
                    return $error;
                } else {
                    // All checks have be done - so the new Password must be crypted
                    // We must not do any other check, because the PW will be crypted - and the crypted PW is database and output safe
                    return 'crypt';
                }
            } else {
                // A Password should be but isn't
                $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_EMPTY'];
                return $error;
            }
        } else {
            // We are neither in Update-Modus with Update PW selected nor in Add Modus, so PW has to be ignored
            return 'ignore';
        }
        return 'undefined';
    }

    function authorcheck_add_radminsuper($add_radminsuper='', $old_radminsuper='') {
        global $lang_admin, $adminpoint;
        $error = '';
        if (isset($add_radminsuper) && !empty($add_radminsuper)) {
            //Ok, normally there is nothing to check - but we want to be shure
            if (!is_god_admin()) {
                $error .= 'Nice try';
                return $error;
            } else {
                if ($add_radminsuper > 1) {
                    // Could only be 0 (FALSE) or 1 (TRUE)
                    $error .= 'Nice try';
                    return $error;
                } else {
                    return 'ok';
                }
            }
        } else {
            // should be ok if field isn't filled
            return 'ok';
        }
        return 'undefined';
    }

    function authorcheck_auth_modules($auth_modules='', $old_auth_modules='') {
        global $lang_admin, $adminpoint, $_GETVAR, $db;
        $error = '';
        $variable = $_GETVAR->get($adminpoint, '_POST', 'array');
        $isradminsuper = (((isset($variable['add_radminsuper']) && $variable['add_radminsuper'] == TRUE) || (defined('MODIFY_IS_RADMIN') && MODIFY_IS_RADMIN == TRUE)) ? TRUE : FALSE);
        $authmodules   = (isset($variable['auth_modules']) ? $variable['auth_modules'] : NULL);
        if (isset($authmodules) && !empty($authmodules) && is_array($authmodules) && !$isradminsuper) {
            while (list($modules_mid) = each($authmodules)) {
                $row = $db->sql_fetchrow($db->sql_query("SELECT title FROM "._MODULES_TABLE." WHERE mid='".intval($modules_mid)."'"));
                if (!isset($row['title']) || empty($row['title'])) {
                    // We break here if the modul doesn't exists - do not check the other ones
                    $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_NOTEXIST'].'&nbsp;'.$modules_mid;
                    return $error;
                }
            }
            // so everything seems ok
            return 'ok';
        } elseif  ($isradminsuper) {
            // Ok, Admin is radminsuper, so no Modulrights have to be filled
            return 'ok';
        } else {
            $error .= $lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_AND_SUPER_EMPTY'];
            return $error;
        }
        return 'undefined';
    }

    $op         = $_GETVAR->get('op', 'REQUEST');
    $submit     = $_GETVAR->get('submit', '_POST', 'string');

    switch ($op) {
        case 'menue':
            menue();
            break;
        case 'showadmins':
            $todo = $_GETVAR->get('adminaction', '_POST', 'string');
            switch ($todo) {
                case 'changeadmin': modifyadmin(); break;
                case 'deleteadmin': deleteadmin(); break;
                case 'showadmin'  : modifyadmin('show'); break;
                default: showadmins(); break;
            }
        case 'addadmin':
            if (isset($submit) && !empty($submit)) {
                addadmin_save();
            } else {
                addadmin();
            }
            break;
        case 'modifyadmin':
            if (isset($submit) && !empty($submit)) {
                modifyadmin_save();
            } else {
                modifyadmin();
            }
            break;
        case 'deleteadmin':
            if (isset($submit) && !empty($submit)) {
                deleteadmin_save();
            } else {
                deleteadmin();
            }
            break;
        case 'promoteuser':
            promoteuser();
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>